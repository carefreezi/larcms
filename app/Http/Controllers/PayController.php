<?php
/*
 * Copyright (c) 2021-2021. The system is a commercial version of Larcms.
 * You cannot use or sell the system without authorization. The system has obtained copyright. If it is flooded or distributed and sold privately, it will be subject to legal sanctions
 * Author: Carefree
 * QQ No.: 869375583
 * Official website: www.nsmao.com
 * This account is the only author account, and others are fake
 */

namespace App\Http\Controllers;

use AlipayNotify;
use AlipaySubmit;
use App\Models\Options;
use App\Models\Order;
use App\Models\Post;
use App\Models\Postorders;
use App\Models\User;
use App\Models\VerifyOrder;
use App\Models\Vip;
use App\Models\VipMeat;
use Endroid\QrCode\QrCode;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use phpDocumentor\Reflection\Types\False_;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller
{
    
    //支付宝
    public function payByAlipay(Request $request)
    {
        $token = $request->cookie("auth__token_local");
        $token = substr($token, 7);
        if (!$token) {
            return response()->json(['status' => 401, 'msg' => '请登录后进行此操作'], 401);
        } else {
            $flight = User::where('api_token', $token)->first();
            if (empty($flight)) {
                return response()->json(['status' => 401, 'msg' => '请重新登录后进行此操作'], 401);
            }
        }

        $order = date('YmdHis') . mt_rand(1000, 9999);
        $amount = $request->input('amount');
        $user_id = $request->input('id');
        $payment = $request->input('payment');
        $types = $request->input('types');
        $alipay_select = Options::where('option_name', 'alipay_select')->first()->option_value;
        $localhost_portal = Options::where('option_name', 'localhost')->first()->option_value;

        if ($alipay_select == 0) {
            //调用支付宝的网页支付
            $result = app('alipay')->web([
                'out_trade_no' => $order, // 订单编号，需保证在商户端不重复
                'total_amount' => $amount,
                'subject' => '支付订单：' . $order, // 订单标题
                'quit_url' => $localhost_portal . '/member',
            ]);
        } else {
            $result = app('alipay')->scan([
                'out_trade_no' => $order, // 订单编号，需保证在商户端不重复
                'total_amount' => $amount, // 订单金额，单位元，支持小数点后两位
                'subject' => '支付订单：' . $order, // 订单标题
            ]);
        }
        if (is_MobileClient()) {
            $result = app('alipay')->wap([
                'out_trade_no' => $order, // 订单编号，需保证在商户端不重复
                'total_amount' => $amount,
                'subject' => '支付订单：' . $order, // 订单标题
                'quit_url' => $localhost_portal . '/member',
            ]);
        }
        //易支付
        if ($payment == 5) {
            $yzf_address = Options::where('option_name', 'yzf_address')->first()->option_value;
            $yzf_id = Options::where('option_name', 'yzf_id')->first()->option_value;
            $yzf_key = Options::where('option_name', 'yzf_key')->first()->option_value;
            $title = Options::where('option_name', 'title')->first()->option_value;
            /**************************请求参数**************************/
            $alipay_config['partner']		= $yzf_id;
            $alipay_config['key']			= $yzf_key;
            $alipay_config['sign_type']    = strtoupper('MD5');
            $alipay_config['input_charset']= strtolower('utf-8');
            $alipay_config['transport']    = 'http';
            $alipay_config['apiurl']    = $yzf_address;
            $notify_url = $localhost_portal.'/api/yzf_notify_url';
            $return_url = $localhost_portal.'/api/yzf_return_url';
            $out_trade_no = $order;
            $type = 'alipay';
            //商品名称
            $name ='支付订单:'.$order;
            //付款金额
            $money = $amount;
            //站点名称
            $sitename = $title;
            $parameter = array(
                "pid" => $yzf_id,
                "type" => 'alipay',
                "notify_url"	=> $notify_url,
                "return_url"	=> $return_url,
                "out_trade_no"	=> $out_trade_no,
                "name"	=> $name,
                "money"	=> $money,
                "sitename"	=> $sitename
            );
            $alipaySubmit = new AlipaySubmit($alipay_config);
            $html_text = $alipaySubmit->buildRequestForm($parameter);
        }
        if ($types == 0) {
            $user = User::where('id', $user_id)->first();
            //获取支付前的用户余额
            $balance_before = $user->balance;
            //获取支付后的用户余额
            $balance_after = $amount + $balance_before;
            $orders = new Order();
            $orders->order = $order;
            $orders->amount = $amount;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->types = $types;
            $orders->state = "0";
            $orders->save();
        } elseif ($types == 1) {
            $user = User::where('id', $user_id)->first();
            $orders = new Order();
            //获取支付前的用户余额
            $balance_before = $user->balance;
            //获取支付后的用户余额
            $balance_after = $balance_before;
            $orders->order = $order;
            $orders->amount = $amount;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->types = $types;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->state = "0";
            $orders->save();
        } else if ($types == 3) {
            $user = VerifyOrder::where('user_id', $user_id)->first();
            if ($user) {
                $user->order = $order;
                $user->money = $amount;
                $user->payment = $payment;
                $user->create_time = date('Y-m-d H:i:s');
                $user->save();
            } else {
                $orders = new VerifyOrder();
                $orders->order = $order;
                $orders->money = $amount;
                $orders->user_id = $user_id;
                $orders->payment = $payment;
                $orders->create_time = date('Y-m-d H:i:s');
                $orders->state = 0;
                $orders->save();
            }
        }

        if ($alipay_select == 0 && $payment==1) {
            //调用支付宝的网页支付
            return $result;
        }else if(is_MobileClient()){
            return $result;
        }else if($payment==5){
            return response()->json(['alipay_url' => $html_text, 'status' => '200']);
        }else {
            return response()->json(['alipay_url' => $result->qr_code, 'status' => '200']);
        }
    }

    // 前端回调页面
    public function alipayReturn()
    {
        $localhost_portal = Options::where('option_name', 'localhost')->first()->option_value;
        // 校验提交的参数是否合法
        $data = app('alipay')->verify();
        return redirect()->to($localhost_portal . '/member');
    }

    // 服务器端回调
    public function alipayNotify()
    {
        $data = app('alipay')->verify();
        $order = $data->out_trade_no;
        $orders = Order::where('order', $order)->first();
        if (!empty($orders)) {
            if ($orders->types == 0) {
                $orders->state = '1';
                $orders->save();
                $this->payment($orders);
            } elseif ($orders->types == 1) {
                $orders->state = '1';
                $orders->save();
                $this->vip_payment($orders);
            }
        }
        $auth_orders = VerifyOrder::where('order', $order)->first();
        if (!empty($auth_orders)) {
            $auth_orders->state = 1;
            $auth_orders->save();
        }

        //文章支付
        $portorders = Postorders::where('order', $order)->first();
        if (!empty($portorders)) {
            $portorders->state = '1';
            $portorders->save();
            $this->payauthor($portorders);
        }

    }
    //支付宝结束

    //微信
    public function payByWechat(Request $request)
    {

        $token = $request->cookie("auth__token_local");
        $token = substr($token, 7);
        if (!$token) {
            return response()->json(['status' => 401, 'msg' => '请登录后进行此操作'], 401);
        } else {
            $flight = User::where('api_token', $token)->first();
            if (empty($flight)) {
                return response()->json(['status' => 401, 'msg' => '请登录后进行此操作'], 401);
            }
        }
        $order = date('YmdHis') . mt_rand(1000, 9999);
        // scan 方法为拉起微信扫码支付
        $fee = $request->input('fee');
        $user_id = $request->input('id');
        $payment = $request->input('payment');
        $types = $request->input('types');
        $localhost_portal = Options::where('option_name', 'localhost')->first()->option_value;

        // 调用微信的网页支付
        if ($payment==0){
            $wechatOrder = app('wechat_pay')->scan([
                'out_trade_no' => $order,
                'total_fee' => $fee,
                'body' => '订单：' . $order,
            ]);
        }
        if (is_MobileClient()) {
            $wechatOrder = app('wechat_pay')->wap([
                'out_trade_no' => time(),
                'total_fee' => $fee,
                'body' => '订单：' . $order,
            ]);
        }
        //易支付
        if ($payment == 4) {
            $yzf_address = Options::where('option_name', 'yzf_address')->first()->option_value;
            $yzf_id = Options::where('option_name', 'yzf_id')->first()->option_value;
            $yzf_key = Options::where('option_name', 'yzf_key')->first()->option_value;
            $title = Options::where('option_name', 'title')->first()->option_value;
            /**************************请求参数**************************/
            $alipay_config['partner']		= $yzf_id;
            $alipay_config['key']			= $yzf_key;
            $alipay_config['sign_type']    = strtoupper('MD5');
            $alipay_config['input_charset']= strtolower('utf-8');
            $alipay_config['transport']    = 'http';
            $alipay_config['apiurl']    = $yzf_address;
            $notify_url = $localhost_portal.'/api/yzf_notify_url';
            $return_url = $localhost_portal.'/api/yzf_return_url';
            $out_trade_no = $order;
            $type = 'wxpay';
            //商品名称
            $name ='支付订单:'.$order;
            //付款金额
            $money = $fee/100;
            //站点名称
            $sitename = $title;
            $parameter = array(
                "pid" => $yzf_id,
                "type" => 'wxpay',
                "notify_url"	=> $notify_url,
                "return_url"	=> $return_url,
                "out_trade_no"	=> $out_trade_no,
                "name"	=> $name,
                "money"	=> $money,
                "sitename"	=> $sitename
            );
            $WechatSubmit = new AlipaySubmit($alipay_config);
            $html_text = $WechatSubmit->buildRequestForm($parameter);
        }
        if ($types == 0) {
            $user = User::where('id', $user_id)->first();
            //获取支付前的用户余额
            $balance_before = $user->balance;
            //获取支付后的用户余额
            $balance_after = ($fee / 100) + $balance_before;
            $orders = new Order();
            $orders->order = $order;
            $orders->amount = $fee / 100;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->types = $types;
            $orders->state = "0";
            $orders->save();
        } else if ($types == 1) {
            $user = User::where('id', $user_id)->first();
            $orders = new Order();
            //获取支付前的用户余额
            $balance_before = $user->balance;
            //获取支付后的用户余额
            $balance_after = $balance_before;
            $orders->order = $order;
            $orders->amount = $fee / 100;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->types = $types;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->state = "0";
            $orders->save();
        } elseif ($types == 2) {
            $user = User::where('id', $user_id)->first();
            //获取支付前的用户余额
            $balance_before = $user->balance;
            //获取支付后的用户余额
            $balance_after = $balance_before;
            $orders = new Postorders();
            $orders->order = $order;
            $orders->amount = $fee / 100;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->state = "0";
            $orders->save();
        } else if ($types == 3) {
            $user = VerifyOrder::where('user_id', $user_id)->first();
            if ($user) {
                $user->order = $order;
                $user->money = $fee / 100;
                $user->payment = $payment;
                $user->create_time = date('Y-m-d H:i:s');
                $user->save();
            } else {
                $orders = new VerifyOrder();
                $orders->order = $order;
                $orders->money = $fee / 100;
                $orders->user_id = $user_id;
                $orders->payment = $payment;
                $orders->create_time = date('Y-m-d H:i:s');
                $orders->state = 0;
                $orders->save();
            }
        }
        if (is_MobileClient() && $payment=="0") {
            return $wechatOrder;
        }else if($payment==4){
            return response()->json(['wechat_url' => $html_text, 'status' => '200']);
        }else {
            return response()->json(['wechat_url' => $wechatOrder->code_url, 'status' => '200']);
        }
    }

    public function wechatNotify()
    {
        // 校验回调参数是否正确

        $data = app('wechat_pay')->verify();
        // 找到对应的订单
        $order = $data->out_trade_no;
        $orders = Order::where('order', $order)->first();
        if (!empty($orders)) {
            $types = $orders->types;
            if ($types == 0) {
                $orders->state = "1";
                $orders->save();
                $this->payment($orders);
            } else if ($types == 1) {
                $orders->state = "1";
                $orders->save();
                $this->vip_payment($orders);
            }
        }
        $auth_orders = VerifyOrder::where('order', $order)->first();
        if (!empty($auth_orders)) {
            $auth_orders->state = 1;
            $auth_orders->save();
        }
        //文章支付
        $portorders = Postorders::where('order', $order)->first();
        if (!empty($portorders)) {
            $portorders->state = 1;
            $portorders->save();
            $this->payauthor($portorders);
        }
    }
    //微信结束

    //用户使用余额充值vip
    public function payByBlance(Request $request)
    {
        $order = date('YmdHis') . mt_rand(1000, 9999);
        $amount = $request->input('amount');
        $user_id = $request->input('id');
        $payment = $request->input('payment');
        $types = $request->input('types');
        $user = User::where('id', $user_id)->first();
        $orders = new Order();
        //获取支付前的用户余额
        $balance_before = $user->balance;
        //获取支付后的用户余额
        $balance_after = $balance_before - $amount;
        if ($balance_after >= 0 && $types == 3) {
            $orders->order = $order;
            $orders->amount = $amount;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->types = $types;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->state = "1";
            $orders->save();
            //用户余额
            $user->balance = $balance_after;
            $user->save();
            $users = VerifyOrder::where('user_id', $user_id)->first();
            if ($users) {
                $users->order = $order;
                $users->money = $amount;
                $users->payment = $payment;
                $users->create_time = date('Y-m-d H:i:s');
                $users->state = 1;
                $users->save();
            } else {
                $auth_order = new VerifyOrder();
                $auth_order->order = $order;
                $auth_order->money = $amount;
                $auth_order->user_id = $user_id;
                $auth_order->payment = $payment;
                $auth_order->create_time = date('Y-m-d H:i:s');
                $auth_order->state = 1;
                $auth_order->save();
            }
            return response()->json(['status' => 200, 'msg' => '购买认证成功']);
        } else if ($balance_after >= 0) {
            $orders->order = $order;
            $orders->amount = $amount;
            $orders->user_id = $user_id;
            $orders->payment = $payment;
            $orders->types = $types;
            $orders->balance_before = $balance_before;
            $orders->balance_after = $balance_after;
            $orders->state = "1";
            $orders->save();
            //用户余额
            $user->balance = $balance_after;
            $user->save();
            $this->vip_payment($orders);
            return response()->json(['status' => 200, 'msg' => '支付成功']);
        } else {
            return response()->json(['status' => 403, 'msg' => '余额不足']);
        }
    }

    public function yzfNotify()
    {
        $yzf_address = Options::where('option_name', 'yzf_address')->first()->option_value;
        $yzf_id = Options::where('option_name', 'yzf_id')->first()->option_value;
        $yzf_key = Options::where('option_name', 'yzf_key')->first()->option_value;
        /**************************请求参数**************************/
        $alipay_config['partner']		= $yzf_id;
        $alipay_config['key']			= $yzf_key;
        $alipay_config['sign_type']    = strtoupper('MD5');
        $alipay_config['input_charset']= strtolower('utf-8');
        $alipay_config['transport']    = 'http';
        $alipay_config['apiurl']    = $yzf_address;
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];
            //彩虹易支付交易号
            $trade_no = $_GET['trade_no'];
            //交易状态
            $trade_status = $_GET['trade_status'];
            //支付方式
            $type = $_GET['type'];
            Log::info($out_trade_no);

            if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
                $order = $out_trade_no;
                $orders = Order::where('order', $order)->first();
                if (!empty($orders)) {
                    if ($orders->types == 0) {
                        $orders->state = '1';
                        $orders->save();
                        $this->payment($orders);
                    } elseif ($orders->types == 1) {
                        $orders->state = '1';
                        $orders->save();
                        $this->vip_payment($orders);
                    }
                }
                $auth_orders = VerifyOrder::where('order', $order)->first();
                if (!empty($auth_orders)) {
                    $auth_orders->state = 1;
                    $auth_orders->save();
                }

                //文章支付
                $portorders = Postorders::where('order', $order)->first();
                if (!empty($portorders)) {
                    $portorders->state = '1';
                    $portorders->save();
                    $this->payauthor($portorders);
                }
            }
            echo "success";		//请不要修改或删除
        }
        else {
            //验证失败
            echo "fail";
        }
    }

    public function yzfReturn(){
        $localhost_portal = Options::where('option_name', 'localhost')->first()->option_value;
        return redirect()->to('http://127.0.0.1:3000/member');
    }


    //用户余额充值
    public function payment($orders)
    {
        $user_id = $orders->user_id;
        $balance = $orders->balance_after;
        $user = User::where('id', $user_id)->first();
        $user->balance = $balance;
        $user->save();
    }

    //用户vip开通
    public function vip_payment($orders)
    {
        $user_id = $orders->user_id;
        $vip_pirce = $orders->amount;
        $vip = Vip::where('vip_price', $vip_pirce)->first();
        $vip_level = $vip->vip_level;
        $vip_day = $vip->vip_day;
        $vip_day = "+ $vip_day day";
        $now_time = date('Y-m-d H:i:s', strtotime("$vip_day"));
        $isvip = VipMeat::where('user_id', $user_id)->first();
        if (!empty($isvip)) {
            $isvip->vip_level = $vip_level;
            $isvip->user_id = $user_id;
            $isvip->vip_times = $now_time;
            $isvip->vip_status = 1;
            $isvip->save();
        } elseif (empty($isvip)) {
            $vip_meta = new VipMeat();
            $vip_meta->vip_level = $vip_level;
            $vip_meta->user_id = $user_id;
            $vip_meta->vip_times = $now_time;
            $vip_meta->vip_status = 1;
            $vip_meta->save();
        }

    }

    //文章作者收款
    public function payauthor($portorders)
    {
        $author_id = $portorders->author_id;
        $author = User::where('id', $author_id)->first();
        $author_balance_after = $portorders->author_balance_after;
        $author->balance = $author_balance_after;
        $author->save();
    }

    //文章支付
    public function post_payment(Request $request)
    {
        if ($request->isMethod('GET')) {
            $amount = $request->input('post_price');
            $integral = $request->input('integral');
            $user_id = $request->input('id');
            $payment = $request->input('payment');
            $types = $request->input('types');
            $post_id = $request->input('post_id');
            $author_id = $request->input('author_id');
            $localhost_portal = Options::where('option_name','localhost')->first()->option_value;
            $post = Post::where('id', $post_id)->first();
            if (!empty($amount) || !empty($integral)) {
                $vip = VipMeat::where('user_id', $user_id)->first();
                if (!empty($vip)) {
                    if ($vip->vip_status == 1) {
                        if ($vip->vip_level >= $post->isvip_level) {
                            if ($post->vip_price == null) {
                                $post_price = $post->price;
                            } else {
                                $post_price = $post->vip_price;
                            }
                        } else {
                            $post_price = $post->price;
                        }
                    } else {
                        $post_price = $post->price;
                    }
                } else {
                    $post_price = $post->price;
                }
                //计算会员免费购买次数
                if ($post_price == 0 && !empty($vip)) {
                    $user_vip_download = Vip::where('vip_level', $vip->vip_level)->first();
                    $date_time_now = date('Y-m-d');
                    $post_order_get = Postorders::whereDate('created_at', '>=', $date_time_now)
                        ->whereDate('created_at', '<=', $date_time_now)
                        ->where('state', 1)
                        ->where('user_id', $user_id)
                        ->count();
                    if ($post_order_get >= $user_vip_download->downloads) {
                        return response()->json(['status' => 401, 'msg' => '您今日下载次数已达上线！'], 401);
                    }
                }
                //会员购买次数END
                if ($post_price == $amount) {
                    //支付宝支付
                    if ($payment == 1) {
                        $order = date('YmdHis') . mt_rand(1000, 9999);
                        // 调用支付宝的网页支付
                        $result = app('alipay')->scan([
                            'out_trade_no' => $order, // 订单编号，需保证在商户端不重复
                            'total_amount' => $amount, // 订单金额，单位元，支持小数点后两位
                            'subject' => '支付订单：' . $order, // 订单标题
                        ]);
                        //获取作者余额
                        $author = User::where('id', $author_id)->first();
                        $author_balance_before = $author->balance;
                        //获取作者收款后余额
                        $author_balance_after = $author_balance_before + $amount;
                        //获取支付前的用户余额
                        $user = User::where('id', $user_id)->first();
                        $balance_before = $user->balance;
                        //获取支付后的用户余额
                        $balance_after = $balance_before;
                        $orders = new Postorders();
                        $orders->order = $order;
                        $orders->post_price = $amount;
                        $orders->user_id = $user_id;
                        $orders->post_title = $post->title;
                        $orders->post_id = $post_id;
                        $orders->author_id = $author_id;
                        $orders->payment = $payment;
                        $orders->balance_before = $balance_before;
                        $orders->balance_after = $balance_after;
                        $orders->author_balance_before = $author_balance_before;
                        $orders->author_balance_after = $author_balance_after;
                        $orders->ip = getClientIp();
                        $orders->state = "0";
                        $orders->save();
                        return response()->json(['alipay_url' => $result->qr_code, 'status' => '200']);
                    }
                    //微信支付
                    if ($payment == 0) {
                        $order = date('YmdHis') . mt_rand(1000, 9999);
                        // scan 方法为拉起微信扫码支付
                        // 调用微信的网页支付
                        $amount = $amount * 100;
                        $result = app('wechat_pay')->scan([
                            'out_trade_no' => $order,
                            'total_fee' => $amount,
                            'body' => '支付订单：' . $order,
                        ]);
                        //获取作者余额
                        $author = User::where('id', $author_id)->first();
                        $author_balance_before = $author->balance;
                        //获取作者收款后余额
                        $author_balance_after = $author_balance_before + $amount / 100;

                        $user = User::where('id', $user_id)->first();
                        //获取支付前的用户余额
                        $balance_before = $user->balance;
                        //获取支付后的用户余额
                        $balance_after = $balance_before;
                        $orders = new Postorders();
                        $orders->order = $order;
                        $orders->post_price = $amount / 100;
                        $orders->user_id = $user_id;
                        $orders->post_id = $post_id;
                        $orders->post_title = $post->title;
                        $orders->author_id = $author_id;
                        $orders->payment = $payment;
                        $orders->balance_before = $balance_before;
                        $orders->balance_after = $balance_after;
                        $orders->author_balance_before = $author_balance_before;
                        $orders->author_balance_after = $author_balance_after;
                        $orders->ip = getClientIp();
                        $orders->state = "0";
                        $orders->save();
                        return response()->json(['wechat_url' => $result->code_url, 'status' => '200']);
                    }
                    //余额支付
                    if ($payment == 2) {
                        $order = date('YmdHis') . mt_rand(1000, 9999);
                        $user = User::where('id', $user_id)->first();
                        //获取支付前的用户余额
                        $balance_before = $user->balance;
                        //获取支付后的用户余额
                        $balance_after = $balance_before - $amount;
                        //用户余额

                        //获取作者余额
                        $author = User::where('id', $author_id)->first();
                        $author_balance_before = $author->balance;
                        //获取作者收款后余额
                        $author_balance_after = $author_balance_before + $amount;

                        if ($balance_after >= 0) {
                            $portorders = new Postorders();
                            $portorders->order = $order;
                            $portorders->post_price = $amount;
                            $portorders->user_id = $user_id;
                            $portorders->post_id = $post_id;
                            $portorders->post_title = $post->title;
                            $portorders->author_id = $author_id;
                            $portorders->payment = $payment;
                            $portorders->balance_before = $balance_before;
                            $portorders->balance_after = $balance_after;
                            $portorders->author_balance_before = $author_balance_before;
                            $portorders->author_balance_after = $author_balance_after;
                            $portorders->state = "1";
                            $portorders->ip = getClientIp();
                            $portorders->save();
                            $user->balance = $balance_after;
                            $user->save();
                            $author->balance = $author_balance_after;
                            $author->save();
                            $portorders = Postorders::where('order', $order)->first();
                            if (!empty($portorders)) {
                                $portorders->state = '1';
                                $portorders->save();
                                $this->payauthor($portorders);
                            }
                            return response()->json(['status' => 200, 'msg' => '支付成功']);
                        } else {
                            return response()->json(['status' => 405, 'msg' => '余额不足']);
                        }
                    }
                    //积分支付
                    if ($payment == 3) {
                        $order = date('YmdHis') . mt_rand(1000, 9999);
                        $user = User::where('id', $user_id)->first();
                        //获取支付前的用户积分
                        $integral_before = $user->integral;
                        //获取支付后的用户积分
                        $integral_after = $integral_before - $integral;

                        //获取作者余额
                        $author = User::where('id', $author_id)->first();
                        $author_integral_before = $author->integral;
                        //获取作者收款后积分
                        $author_integral_after = $author_integral_before + $integral;

                        if ($integral_after >= 0) {
                            $portorders = new Postorders();
                            $portorders->order = $order;
                            $portorders->post_price = $amount;
                            $portorders->user_id = $user_id;
                            $portorders->post_id = $post_id;
                            $portorders->post_title = $post->title;
                            $portorders->author_id = $author_id;
                            $portorders->payment = $payment;
                            $portorders->balance_before = $integral_before;
                            $portorders->balance_after = $integral_after;
                            $portorders->author_balance_before = $author_integral_before;
                            $portorders->author_balance_after = $author_integral_after;
                            $portorders->state = "1";
                            $portorders->ip = getClientIp();
                            $portorders->save();
                            //用户积分
                            $user->integral = $integral_after;
                            $user->save();
                            $author->integral = $author_integral_after;
                            $author->save();
                            $portorders = Postorders::where('order', $order)->first();
                            if (!empty($portorders)) {
                                $portorders->state = '1';
                                $portorders->save();
                                $author->integral = $author_integral_after;
                                $author->save();
                            }
                            return response()->json(['status' => 200, 'msg' => '支付成功']);
                        } else {
                            return response()->json(['status' => 405, 'msg' => '余额不足']);
                        }
                    }else if ($payment==4){
                        $order = date('YmdHis') . mt_rand(1000, 9999);
                        $yzf_address = Options::where('option_name', 'yzf_address')->first()->option_value;
                        $yzf_id = Options::where('option_name', 'yzf_id')->first()->option_value;
                        $yzf_key = Options::where('option_name', 'yzf_key')->first()->option_value;
                        $title = Options::where('option_name', 'title')->first()->option_value;
                        /**************************请求参数**************************/
                        $alipay_config['partner']		= $yzf_id;
                        $alipay_config['key']			= $yzf_key;
                        $alipay_config['sign_type']    = strtoupper('MD5');
                        $alipay_config['input_charset']= strtolower('utf-8');
                        $alipay_config['transport']    = 'http';
                        $alipay_config['apiurl']    = $yzf_address;
                        $notify_url = $localhost_portal.'/api/yzf_notify_url';
                        $return_url = $localhost_portal.'/api/yzf_return_url';
                        $out_trade_no = $order;
                        $type = 'wxpay';
                        //商品名称
                        $name ='支付订单:'.$order;
                        //付款金额
                        $money = $amount;
                        //站点名称
                        $sitename = $title;
                        $parameter = array(
                            "pid" => $yzf_id,
                            "type" => 'wxpay',
                            "notify_url"	=> $notify_url,
                            "return_url"	=> $return_url,
                            "out_trade_no"	=> $out_trade_no,
                            "name"	=> $name,
                            "money"	=> $money,
                            "sitename"	=> $sitename
                        );
                        $WechatSubmit = new AlipaySubmit($alipay_config);
                        $html_text = $WechatSubmit->buildRequestForm($parameter);
                        //获取作者余额
                        $author = User::where('id', $author_id)->first();
                        $author_balance_before = $author->balance;
                        //获取作者收款后余额
                        $author_balance_after = $author_balance_before + $amount / 100;

                        $user = User::where('id', $user_id)->first();
                        //获取支付前的用户余额
                        $balance_before = $user->balance;
                        //获取支付后的用户余额
                        $balance_after = $balance_before;
                        $orders = new Postorders();
                        $orders->order = $order;
                        $orders->post_price = $amount / 100;
                        $orders->user_id = $user_id;
                        $orders->post_id = $post_id;
                        $orders->post_title = $post->title;
                        $orders->author_id = $author_id;
                        $orders->payment = $payment;
                        $orders->balance_before = $balance_before;
                        $orders->balance_after = $balance_after;
                        $orders->author_balance_before = $author_balance_before;
                        $orders->author_balance_after = $author_balance_after;
                        $orders->ip = getClientIp();
                        $orders->state = "0";
                        $orders->save();
                        return response()->json(['wechat_url' => $html_text, 'status' => '200']);
                    }else if ($payment==5){
                        $order = date('YmdHis') . mt_rand(1000, 9999);
                        $yzf_address = Options::where('option_name', 'yzf_address')->first()->option_value;
                        $yzf_id = Options::where('option_name', 'yzf_id')->first()->option_value;
                        $yzf_key = Options::where('option_name', 'yzf_key')->first()->option_value;
                        $title = Options::where('option_name', 'title')->first()->option_value;
                        /**************************请求参数**************************/
                        $alipay_config['partner']		= $yzf_id;
                        $alipay_config['key']			= $yzf_key;
                        $alipay_config['sign_type']    = strtoupper('MD5');
                        $alipay_config['input_charset']= strtolower('utf-8');
                        $alipay_config['transport']    = 'http';
                        $alipay_config['apiurl']    = $yzf_address;
                        $notify_url = $localhost_portal.'/api/yzf_notify_url';
                        $return_url = $localhost_portal.'/api/yzf_return_url';
                        $out_trade_no = $order;
                        $type = 'alipay';
                        //商品名称
                        $name ='支付订单:'.$order;
                        //付款金额
                        $money = $amount;
                        //站点名称
                        $sitename = $title;
                        $parameter = array(
                            "pid" => $yzf_id,
                            "type" => 'alipay',
                            "notify_url"	=> $notify_url,
                            "return_url"	=> $return_url,
                            "out_trade_no"	=> $out_trade_no,
                            "name"	=> $name,
                            "money"	=> $money,
                            "sitename"	=> $sitename
                        );
                        $alipaySubmit = new AlipaySubmit($alipay_config);
                        $html_text = $alipaySubmit->buildRequestForm($parameter);
                        //获取作者余额
                        $author = User::where('id', $author_id)->first();
                        $author_balance_before = $author->balance;
                        //获取作者收款后余额
                        $author_balance_after = $author_balance_before + $amount;
                        //获取支付前的用户余额
                        $user = User::where('id', $user_id)->first();
                        $balance_before = $user->balance;
                        //获取支付后的用户余额
                        $balance_after = $balance_before;
                        $orders = new Postorders();
                        $orders->order = $order;
                        $orders->post_price = $amount;
                        $orders->user_id = $user_id;
                        $orders->post_title = $post->title;
                        $orders->post_id = $post_id;
                        $orders->author_id = $author_id;
                        $orders->payment = $payment;
                        $orders->balance_before = $balance_before;
                        $orders->balance_after = $balance_after;
                        $orders->author_balance_before = $author_balance_before;
                        $orders->author_balance_after = $author_balance_after;
                        $orders->ip = getClientIp();
                        $orders->state = "0";
                        $orders->save();
                        return response()->json(['alipay_url' =>$html_text, 'status' => '200']);
                    }
                }
            } else {
                return response()->json(['msg' => '订单错误', 'status' => '405']);
            }
        }
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    public function createLinkstring($para)
    {
        $arg = "";
        foreach ($para as $key => $val) {
            $arg .= $key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, strlen($arg) - 1);

        //如果存在转义字符，那么去掉转义
        if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        return $arg;
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para 签名参数组
     * return 去掉空值与签名参数后的新签名参数组
     */
    public function paraFilter($para)
    {
        $para_filter = array();
        foreach ($para as $key => $val) {
            if ($key == "sign" || $key == "sign_type" || $val == "" || $key == 'paymethod') continue;
            else    $para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    /**
     * 对数组排序
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    public function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }

}

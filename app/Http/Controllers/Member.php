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

use App\Models\Accounts;
use App\Models\Chat;
use App\Models\Feedback;
use App\Models\Feedbackmeta;
use App\Models\Gift;
use App\Models\Gigtmeta;
use App\Models\Group;
use App\Models\Helpcenter;
use App\Models\Meat;
use App\Models\Message;
use App\Models\Notice;
use App\Models\Options;
use App\Models\Order;
use App\Models\Post;
use App\Models\Postmeta;
use App\Models\Postorders;
use App\Models\Sign;
use App\Models\Signmeta;
use App\Models\User;
use App\Models\Users;
use App\Models\Vip;
use App\Models\VipMeat;
use App\Models\Withdrawal;
use App\Models\Vipquestion;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Top;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\Verification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use App\Models\Birthday;
use GuzzleHttp\Client;
class Member extends Controller
{
    
    //邮箱验证码验证
    public function sendEmailCode(Request $request)
    {

        if ($email = $request->emails) {
            $code = substr(md5(mt_rand(1000, 9999)), 0, 6);
            $content = '你的邮件验证码为：' . $code;

            $key = 'email_' . $request->emails;
            // 验证码
            Cache::put($key, $code, (new Carbon())->addMinutes(10));
            $email = $request->emails;
            Mail::send('emails.verification', [
                'content' => $content,
            ], function ($message) use ($email) {
                $message->subject('邮箱验证');
                $message->to($email);
            });
            return response()->json(['status' => 200, 'msg' => '验证码已发送邮箱'], 200);
        }
        return response()->json(['status' => 401, 'msg' => '发送失败'], 401);
    }

    //绑定手机号
    public function setphone(Request $request)
    {

        $token=auth('api')->user()->api_token;
        $number = $request->input('phone');
        $value = $request->input('phonecode');
        if ($value == '123') {
            $flight = User::where('api_token', $token)->first();
            $flight->phone = $number;
            $flight->save();
            return response()->json(['status' => 200, 'msg' => '填写成功']);
        } else {
            return response()->json(['status' => 403, 'msg' => '验证码错误']);
        }
    }

    //绑定电子邮箱
    public function setemail(Request $request)
    {

        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $number = $request->input('email');
        $value = $request->input('phonecode');
        $key = 'email_' . $request->email;
        // 验证码
        $code = Cache::get($key);
        if ($value == $code) {
            $flight->email = $number;
            $flight->save();
            return response()->json(['status' => 200, 'msg' => '填写成功']);
        } else {
            return response()->json(['status' => 403, 'msg' => '验证码错误']);
        }
    }

    //填写基本资料
    public function setuser(Request $request)
    {
        if ($request->isMethod('POST')) {
            $token = $request->header('Authorization');
            $token = substr($token, 7);
            if ($token) {
                $flight = User::where('api_token', $token)->first();
            } else {
                return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
            }
            $name = $request->input('name');
            $infor = $request->input('infor');
            $birthday = $request->input('birthday');
            $description = $request->input('description');
            if (!empty($name) && !empty($infor) && !empty($birthday)) {
                $flight->name = $name;
                $flight->gender = $infor;
                $flight->birthday = $birthday;
                $flight->description = $description;
                $flight->save();
                return response()->json(['status' => 200, 'msg' => '填写成功']);
            } else {
                return response()->json(['status' => 401, 'msg' => '请填写数据']);
            }
        } else {
            return response()->json(['status' => 401, 'msg' => '网络错误']);
        }
    }

    //修改密码
    public function setpassword(Request $request)
    {

        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $password = $request->input('password');
        $newpassword = $request->input('newpassword');
        $newpassword2 = $request->input('newpassword2');
        $password = md5($password);
        if ($flight->password == $password) {
            if ($newpassword == $newpassword2) {
                $newpassword = md5($newpassword);
                $flight->password = $newpassword;
                $flight->save();
                return response()->json(['status' => 200, 'msg' => '修改成功']);
            } else {
                return response()->json(['status' => 405, 'msg' => '两次密码不一致']);
            }
        } else {
            return response()->json(['status' => 403, 'msg' => '原密码错误']);
        }
    }

    //用户vip
    public function userVip(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $user_id = $flight->id;
        $list = VipMeat::where('user_id', $user_id)->first();
        if (!empty($list)) {
            $vip = Vip::where('vip_level', $list->vip_level)->first();
            $content = Vip::orderBy("vip_level")->get();
        } else {
            $list = ['vip_status' => 0];
            $vip = ['vip_level' => 0];
            $content = Vip::orderBy("vip_level")->get();
        }

        return response()->json(['list' => $list, 'user' => $vip, 'page' => $content, 'status' => 200], 200);
    }

    //获取用户订单信息
    public function usertable(Request $request)
    {

        $urer_id = $request->input('id');
        $list = Order::where('user_id', $urer_id)->orderBy("id", "desc")->limit(10)->get();
        //获取提现记录
        $withdrawal = Withdrawal::where('user_id', $urer_id)->orderBy("id", "desc")->limit(5)->get();
        //获取用户转账记录
        $transfer = Accounts::where('user_id', $urer_id)->orderBy("id", "desc")->limit(5)->get();

        return response()->json(['orders' => $list, 'withdrawal' => $withdrawal, 'transfer' => $transfer, 'status' => 200], 200);
    }

    //获取用户订单信息
    public function usertables(Request $request)
    {

        $urer_id = $request->input('id');
        $list = Order::where('user_id', $urer_id)->orderBy("id", "desc")->get();
        //获取提现记录
        $withdrawal = Withdrawal::where('user_id', $urer_id)->orderBy("id", "desc")->get();
        //获取用户转账记录
        $transfer = Accounts::where('user_id', $urer_id)->orderBy("id", "desc")->get();

        return response()->json(['orders' => $list, 'withdrawal' => $withdrawal, 'transfer' => $transfer, 'status' => 200], 200);
    }

    //提现
    public function Cashwithdrawal(Request $request)
    {

        $order = date('YmdHis') . mt_rand(1000, 9999);
        $amount = $request->input('amount');
        $user_id = $request->input('id');
        $payment = $request->input('payment');
        $number = $request->input('number');
        $name = $request->input('name');

        $user = User::where('id', $user_id)->first();
        //获取提现前的用户余额
        $balance_before = $user->balance;
        //获取提现后的用户余额
        $balance_after = $balance_before - $amount;

        if ($balance_after > 0) {
            $list = new Withdrawal();
            $list->order = $order;
            $list->amount = $amount;
            $list->number = $number;
            $list->name = $name;
            $list->payment = $payment;
            $list->state = 0;
            $list->user_id = $user_id;
            $list->balance_before = $balance_before;
            $list->balance_after = $balance_after;
            $list->save();
            //用户余额
            $user->balance = $balance_after;
            $user->save();
            return response()->json(['status' => 200, 'msg' => '提交成功']);
        } else {
            return response()->json(['status' => 405, 'msg' => '余额不足']);
        }

    }

    //转账
    public function transfer_accounts(Request $request)
    {

        if ($request->isMethod('POST')) {
            $order = date('YmdHis') . mt_rand(1000, 9999);
            $amount = $request->input('amount');
            $number = $request->input('number');
            $token = $request->header('Authorization');
            $token = substr($token, 7);
            if ($token) {
                $flight = User::where('api_token', $token)->first();
            } else {
                return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
            }
            $balance = $flight->balance;
            $balance_after = $balance - $amount;
            if ($balance_after >= 0) {
                $last_user = User::where('username', $number)->first();
                if (!empty($last_user) && $flight->username != $number) {
                    $list = new Accounts();
                    $list->order = $order;
                    $list->amount = $amount;
                    $list->number = $number;
                    $list->state = 1;
                    $list->user_id = $flight->id;
                    $list->balance_before = $balance;
                    $list->balance_after = $balance_after;
                    $list->save();

                    $flight->balance = $balance_after;
                    $flight->save();
                    $last_user->balance += $amount;
                    $last_user->save();
                    return response()->json(['status' => 200, 'msg' => '转账成功'], 200);
                } else {
                    return response()->json(['status' => 401, 'msg' => '转账账号错误'], 401);
                }
            } else {
                return response()->json(['status' => 401, 'msg' => '余额不足'], 401);
            }
        }

    }


    //判读用户是否关注
    public function isfollow(Request $request)
    {
        if ($request->isMethod('POST')) {
            $user_id = $request->input('user_id');
            $post_id = $request->input('author_id');

            $follow = Postmeta::where('user_id', $user_id)->where('author_id', $post_id)->first();
            if (!empty($follow)) {
                return response()->json(['status' => 200, 'state' => '1'], 200);
            } else {
                return response()->json(['status' => 200, 'state' => '0'], 200);
            }
            
            
        }
    }

    //消息记录
    public function messagetable(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $message = Message::where('user_id', $flight->id)->orderBy("id", "desc")->get();
        $notice = Notice::orderBy("id", "desc")->get();
        return response()->json(['message' => $message, 'notice' => $notice, 'status' => 200], 200);
    }

    //左侧获取未读消息
    public function nomessages(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $message = Message::where('user_id', $flight->id)->where('state', 0)->count();
        $notice = Notice::where('state', 0)->count();
        $num = $message + $notice;
        return response()->json(['num' => $num, 'status' => 200], 200);
    }

    //点击阅读
    public function readmessage(Request $request)
    {
        if ($request->isMethod('POST')) {
            $id = $request->input('id');
            $activeName = $request->input('activeName');
            if ($activeName == 'first') {
                if ($id == 'all') {
                    $token = $request->header('Authorization');
                    $token = substr($token, 7);
                    if ($token) {
                        $flight = User::where('api_token', $token)->first();
                    } else {
                        return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
                    }
                    $message = Message::where('user_id', $flight->id)->get();
                    foreach ($message as $key) {
                        $key->state = 1;
                        $key->save();
                    }
                    return response()->json(['status' => 200]);

                } else {
                    $message = Message::where('id', $id)->first();
                    $message->state = 1;
                    $message->save();
                    return response()->json(['status' => 200]);
                }
            } elseif ($activeName == 'second') {
                if ($id == 'all') {
                    $notice = Notice::get();
                    foreach ($notice as $key) {
                        $key->state = 1;
                        $key->save();
                    }
                    return response()->json(['status' => 200]);
                } else {
                    $notice = Notice::where('id', $id)->first();
                    $notice->state = 1;
                    $notice->save();
                    return response()->json(['id' => $notice, 'status' => 200]);
                }


            }
        }
    }

    //获取问题反馈类型+我的反馈
    public function Question_type(Request $request)
    {
        $question = Feedbackmeta::get();
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $user_id = $flight->id;
        $feedback = Feedback::where('user_id', $user_id)->get();
        return response()->json(['question' => $question, 'feedback' => $feedback, 'status' => 200]);
    }

    //图片上传
    public function upload(Request $request)
    {
        if ($request->isMethod('POST')) {
            $files = $request->file('file');
            // 判断文件是否上传成功
            if ($files->getClientOriginalExtension() == 'png' || $files->getClientOriginalExtension() == 'jpg' || $files->getClientOriginalExtension() == 'ico') {
                if ($files->isValid()) {
                    $alioss = Options::where('option_name', 'oss')->first();
                    if ($alioss->option_value == 'alioss') {
                        $path = '/' . date("Ym/d", time());
                        $image_path = upload_image($path, $files);
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                    } else if ($alioss->option_value == 'qiniuoss') {
                        $path = '/' . date("Ym/d", time());
                        $image_path = upload_image($path, $files, 'qiniu');
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                    } else {
                        $api = Options::where('option_name', 'api')->first()->option_value;
                        $originlNmae = $files->getClientOriginalName();//文件名
                        $ext = $files->getClientOriginalExtension();//扩展名
                        $type = $files->getClientMimeType();//文件类型
                        $realPath = $files->getRealPath();//临时绝对目录
                        $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                        $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
                        $filepath = $api . '/app/uploads/' . $filename;
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $filepath], 'status' => 200], 200);
                    }
                    return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                }
            } else {
                return response()->json(['status' => 401, 'msg' => '上传失败,文件格式错误!'], 401);
            }
        }
    }

    //提交问题反馈
    public function upQuestion(Request $request)
    {
        if ($request->isMethod('POST')) {
            $token = $request->header('Authorization');
            $token = substr($token, 7);
            if ($token) {
                $flight = User::where('api_token', $token)->first();
            } else {
                return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
            }
            $user_id = $flight->id;
            $types = $request->input('types');
            $content = $request->input('content');
            $images = $request->input('images');
            if (!empty($types) && !empty($content)) {
                $str = "";
                $cnt = 0;
                foreach ($images as $value) {
                    if ($cnt == 0) {
                        $str = $value;
                    } else {
                        $str = $str . ',' . $value;
                    }
                    $cnt++;
                }
                $list = new Feedback();
                $list->types = $types;
                $list->content = $content;
                $list->img = $str;
                $list->user_id = $user_id;
                $list->save();
                return response()->json(['msg' => '提交成功', 'status' => 200], 200);
            } else {
                return response()->json(['msg' => '信息未填写完整', 'status' => 405], 200);
            }
        }
    }

    //用户头像上传
    public function upuser_pic(Request $request)
    {
        if ($request->isMethod('POST')) {
            $files = $request->file('file');
            // 判断文件是否上传成功
            if ($files->getClientOriginalExtension() == 'png' || $files->getClientOriginalExtension() == 'jpg' || $files->getClientOriginalExtension() == 'ico') {
                if ($files->isValid()) {
                    $alioss = Options::where('option_name', 'oss')->first();
                    if ($alioss->option_value == 'alioss') {
                        $path = '/avatar/' . date("Ym/d", time());
                        $image_path = upload_image($path, $files);
                        $token = $request->header('Authorization');
                        $token = substr($token, 7);
                        if ($token) {
                            $flight = User::where('api_token', $token)->first();
                        } else {
                            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
                        }
                        $flight->pic = $image_path;
                        $flight->save();
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                    } else if ($alioss->option_value == 'qiniuoss') {
                        $path = '/' . date("Ym/d", time());
                        $image_path = upload_image($path, $files, 'qiniu');
                        $token = $request->header('Authorization');
                        $token = substr($token, 7);
                        if ($token) {
                            $flight = User::where('api_token', $token)->first();
                        } else {
                            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
                        }
                        $flight->pic = $image_path;
                        $flight->save();
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                    } else {
                        $api = Options::where('option_name', 'api')->first()->option_value;
                        $originlNmae = $files->getClientOriginalName();//文件名
                        $ext = $files->getClientOriginalExtension();//扩展名
                        $type = $files->getClientMimeType();//文件类型
                        $realPath = $files->getRealPath();//临时绝对目录
                        $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                        $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
                        $filepath = $api . '/app/uploads/' . $filename;
                        $token = $request->header('Authorization');
                        $token = substr($token, 7);
                        if ($token) {
                            $flight = User::where('api_token', $token)->first();
                        } else {
                            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
                        }
                        $flight->pic = $filepath;
                        $flight->save();
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $filepath], 'status' => 200], 200);
                    }
                }
            } else {
                return response()->json(['status' => 401, 'msg' => '上传失败,文件格式错误!'], 401);
            }
        }
    }

    //获取用户头像
    public function getuserpic(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $imgurl = $flight->pic;
        return response()->json(['imgurl' => $imgurl, 'status' => 200]);
    }


    //用户签到
    public function user_sign(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $user_id = $flight->id;
        $sign = Sign::where('user_id', $user_id)->first();
        if (empty($sign)) {
            $list = new Sign();
            $list->user_id = $user_id;
            $list->signcount = 1;
            $list->count = 1;
            $list->save();
            $addintegral = Signmeta::where('day', $list->signcount)->first()->integral;
            $flight->integral += $addintegral;
            $flight->save();
            return response()->json(['msg' => "签到成功", 'signcount' => $list->signcount, 'status' => 200]);
        } else {
            $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
            $endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
            $sign_time = strtotime($sign->nowModifyTime);
            $now_time = strtotime(date("Y-m-d H:i:s", strtotime("-1 day")));
            $last_time = strtotime($sign->lastModifyTime);
            $diff = round(($now_time - $last_time) / 86400);
            if (1 < $diff && $diff < 7) {
                if ($sign_time >= $beginYesterday && $sign_time <= $endYesterday) {
                    $sign->signcount += 1;
                    $sign->count += 1;
                    $sign->lastModifyTime = date("Y-m-d H:i:s");
                    $sign->nowModifyTime = date("Y-m-d H:i:s");
                    $sign->save();
                    $addintegral = Signmeta::where('day', $sign->signcount)->first()->integral;
                    $flight->integral += $addintegral;
                    $flight->save();
                    return response()->json(['msg' => "签到成功", 'status' => 200]);
                } elseif ($sign_time <= $beginYesterday) {
                    $sign->signcount = 1;
                    $sign->count += 1;
                    $sign->nowModifyTime = date("Y-m-d H:i:s");
                    $sign->save();
                    $addintegral = Signmeta::where('day', $sign->signcount)->first()->integral;
                    $flight->integral += $addintegral;
                    $flight->save();
                    return response()->json(['msg' => "签到成功", 'status' => 200]);
                } else {
                    return response()->json(['msg' => "已签到过，请勿重复签到", 'status' => 200]);
                }
            } elseif ($diff >= 7 || $diff <= 1) {
                if ($sign_time >= $beginYesterday && $sign_time <= $endYesterday) {
                    $sign->signcount += 1;
                    $sign->count += 1;
                    $sign->lastModifyTime = date("Y-m-d H:i:s");
                    $sign->nowModifyTime = date("Y-m-d H:i:s");
                    $sign->save();
                    $addintegral = Signmeta::where('day', $sign->signcount)->first()->integral;
                    $flight->integral += $addintegral;
                    $flight->save();
                    return response()->json(['msg' => "签到成功", 'status' => 200]);
                } elseif ($sign_time <= $beginYesterday) {
                    $sign->signcount = 1;
                    $sign->count += 1;
                    $sign->lastModifyTime = date("Y-m-d H:i:s");
                    $sign->nowModifyTime = date("Y-m-d H:i:s");
                    $sign->save();
                    $addintegral = Signmeta::where('day', $sign->signcount)->first()->integral;
                    $flight->integral += $addintegral;
                    $flight->save();
                    return response()->json(['msg' => "签到成功", 'status' => 200]);
                } else {
                    return response()->json(['msg' => "已签到过，请勿重复签到", 'status' => 200]);
                }
            }

        }
    }

    //获取用户签到信息
    public function get_user_sign(Request $request)
    {

        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $user_id = $flight->id;
        $sign = Sign::where('user_id', $user_id)->first();
        $signmeta = Signmeta::get();
        if (!empty($sign)) {
            $now_time = strtotime(date("Y-m-d H:i:s", strtotime("-1 day")));
            $last_time = strtotime($sign->lastModifyTime);
            $diff = round(($now_time - $last_time) / 86400);
            $sign_time = strtotime($sign->nowModifyTime);
            $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
            $endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
            $jifen_bu = Options::where('option_name', 'jifen_bu')->first()->option_value;
            $pay_integral = $diff * $jifen_bu;
            if ($sign_time <= $beginYesterday) {
                $sign->signcount = 0;
                $sign->save();
            }
            return response()->json(['signcounts' => $sign->signcount, 'diffs' => $diff, 'pay_integral' => $pay_integral, 'signmetas' => $signmeta, 'status' => 200], 200);
        } else {
            return response()->json(['signcounts' => 0, 'diffs' => 0, 'pay_integral' => 0, 'signmetas' => $signmeta, 'status' => 200], 200);
        }
    }

    public function birthday_get(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::where('id', $user_id)->first();
        $now_time = date('Y-m-d');
        $user_birthday = date('Y-m-d', strtotime($user->birthday));
        if ($user_birthday == $now_time) {
            $user_birthday_info = Birthday::where('user_id', $user_id)->first();
            if ($user_birthday_info) {
                if (date('Y', strtotime($user->birthday)) == date('Y', strtotime($user_birthday_info->created_time))) {
                    return response()->json(['status' => 401, 'msg' => '您已经领取过生日积分！'], 200);
                } else {
                    $vip_info = VipMeat::where('user_id', $user->id)->join('vip', 'vip.vip_level', '=', 'vip_meta.vip_level')->first();
                    if ($vip_info) {
                        $user->integral = $user->integral + $vip_info->birthday;
                        $user->save();
                    } else {
                        $option_jifen = Options::where('option_name', 'birthday_default')->first()->option_value;
                        $user->integral = $user->integral + $option_jifen;
                        $user->save();
                    }
                    return response()->json(['status' => 200, 'msg' => '积分已入账户，祝您生日快乐！'], 200);
                }
            } else {
                $birthday_add = new Birthday();
                $birthday_add->user_id = $user_id;
                $vip_info = VipMeat::where('user_id', $user->id)->join('vip', 'vip.vip_level', '=', 'vip_meta.vip_level')->first();
                if ($vip_info) {
                    $user->integral = $user->integral + $vip_info->birthday;
                    $birthday_add->get_integral = $vip_info->birthday;
                    $user->save();
                } else {
                    $option_jifen = Options::where('option_name', 'birthday_default')->first()->option_value;
                    $user->integral = $user->integral + $option_jifen;
                    $birthday_add->get_integral = $option_jifen;
                    $user->save();
                }
                $birthday_add->created_time = date('Y-m-d H:i:s');
                $birthday_add->save();
                return response()->json(['status' => 200, 'msg' => '积分已入账户，祝您生日快乐！'], 200);
            }
        } else {
            return response()->json(['msg' => "还未到您的生日！", 'status' => 401, 'user_birthday' => $user_birthday == $now_time], 200);
        }
    }

    //用户补签
    public function signature(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $user_id = $flight->id;
        $sign = Sign::where('user_id', $user_id)->first();
        $sign_time = strtotime(date("Y-m-d H:i:s", strtotime("-1 day")));
        $last_time = strtotime($sign->lastModifyTime);
        $diff = round(($sign_time - $last_time) / 86400);
        if ($diff >= 1) {
            $user_integral = $flight->integral;
            $jifen_bu = Options::where('option_name', 'jifen_bu')->first()->option_value;
            $pay_integral = $diff * $jifen_bu;
            $pirce_integral = $user_integral - $pay_integral;
            if ($pirce_integral > 0) {
                $sign->lastModifyTime = date("Y-m-d H:i:s");
                $sign->signcount += $diff;
                $sign->save();
                $flight->integral = $pirce_integral;
                $flight->save();
                return response()->json(['msg' => "补签成功", 'status' => 200], 200);
            } else {
                return response()->json(['msg' => "积分不够，补签失败", 'status' => 401], 200);
            }
        } else {
            return response()->json(['msg' => "无法补签", 'status' => 401], 200);
        }
    }

    //用户礼物领取
    public function collectgifts(Request $request)
    {
        if ($request->isMethod('POST')) {
            $collect = $request->input('signcount');
            $token = $request->header('Authorization');
            $token = substr($token, 7);
            if ($token) {
                $flight = User::where('api_token', $token)->first();
            } else {
                return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
            }
            $user_id = $flight->id;
            $sign = Sign::where('user_id', $user_id)->first()->signcount;
            if ($sign >= $collect) {
                $isgift = Gigtmeta::where('user_id', $user_id)->where('signcount', $collect)->first();
                if (empty($isgift)) {
                    $gift = Gift::where('signcount', $collect)->first();
                    $flight->integral += $gift->integral;
                    $flight->balance += $gift->balance;
                    $flight->save();
                    $giftmeta = new Gigtmeta();
                    $giftmeta->user_id = $user_id;
                    $giftmeta->signcount = $collect;
                    $giftmeta->save();
                    return response()->json(['msg' => "领取成功", 'status' => 200], 200);
                } else {
                    return response()->json(['msg' => "请勿重复领取", 'status' => 200], 200);
                }
            } else {
                return response()->json(['msg' => "签到天数不够", 'status' => 401], 200);

            }
        }
    }

    //获取礼物表
    public function gifttable(Request $request)
    {
        $gift = Gift::get();
        return response()->json(['gifttable' => $gift, 'status' => 200], 200);
    }

    //获取签到排行榜

    public function Attendance_list(Request $request)
    {
        $list = Sign::with('user')->orderBy("signcount", "desc")->take(6)->get();
        if (!empty($list)) {
            $arr = [];
            $lists = $list->toArray();
            foreach ($lists as $item) {
                foreach ($item['user'] as $s) {
                    $arr[] = ['pic' => $s['pic'], 'name' => $s['name'], 'signcount' => $item['signcount']];
                }
            }
        }
        return response()->json(['gifttable' => $arr, 'status' => 200], 200);
    }

    //获取用户文章
    public function userpost(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
            $user_id = $flight->id;
        } else {
            return response()->json(['status' => 200, 'msg' => '无文章', 'post' => ''], 200);
        }
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page == '' || $limits == '') {
            $page = 1;
            $limits = 8;
        }
        $post = Post::where('post.author_id', $user_id)
            ->join('user', 'user.id', '=', 'post.author_id')
            ->join('meta', 'meta.post_id', '=', 'post.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->select('post.id', 'post.title', 'post.author_id', 'post.view', 'post.likes', 'post.create_time', 'post.cover', 'category.name', 'category.other', 'user.name as userInfo', 'user.pic')
            ->forPage($page, $limits)
            ->orderBy('post.id', 'DESC')
            ->get();
        $number = Post::where('post.author_id', $user_id)->count();
        return response()->json(['post' => $post, 'status' => 200, 'count' => $number], 200);
    }

    public function usercollect(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
            $user_id = $flight->id;
        } else {
            return response()->json(['status' => 200, 'msg' => '无文章', 'post' => ''], 200);
        }
        $post = Post::join('meta', 'meta.post_id', '=', 'post.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->join('collect', 'collect.post_id', '=', 'post.id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name as userInfo', 'user.pic', 'post.author_id', 'post.content', 'post.create_time', 'post.id', 'post.isvip_level', 'post.likes', 'post.price', 'post.show_url', 'post.tags', 'post.title', 'post.view', 'post.cover', 'post.vip_price', 'category.name', 'category.other')
            ->orderBy('post.id', 'DESC')
            ->get();
        return response()->json(['post' => $post, 'status' => 200], 200);
    }

    //获取帮助中心
    public function Help_center(Request $request)
    {
        $help = Helpcenter::get();
        return response()->json(['helps' => $help, 'status' => 200], 200);
    }

    public function get_money_info(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $user_info = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        if (empty($user_info)) {
            return response()->json(['status' => 401, 'msg' => '未查询到该账户信息'], 401);
        } else {
            return response()->json(['status' => 200, 'data' => $user_info->balance, 'integral' => $user_info->integral], 200);
        }
    }

    public function get_user_avatar(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        } else {
            return response()->json(['status' => 200, 'msg' => '无token，请重新登录', 'post' => ''], 200);
        }
        $user_pic = $flight->pic;
        return response()->json(['status' => 200, 'data' => $user_pic], 200);
    }

    public function get_vipqs()
    {
        $vips = Vipquestion::get();
        return response()->json(['status' => 200, 'vips' => $vips], 200);
    }

    public function update_user_invitation(Request $request)
    {
        $user_id = $request->input('user_id');
        $user = User::where('id', $user_id)->first();
        $user->invitation_code = make_coupon_card();
        $user->save();
        return response()->json(['status' => 200, 'msg' => '生成成功', 'data' => $user->invitation_code], 200);
    }

    public function get_user_chat(Request $request)
    {
        $token=auth('api')->user()->api_token;
        if ($token) {
            $flight = User::where('api_token', $token)->first();
        }
        $chat_group = Chat::where(function ($query) use ($flight) {
            $query->where('to_id', $flight->id)
                ->orWhere('from_id',$flight->id);
        })
            ->where('group_id', 0)
            ->select('content', 'created_at', 'id','to_id','from_id','group_id')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $chat_result=[];
        $chats_last=[];
        foreach($chat_group as $c){
            if ($flight->id == $c->from_id) {
                $fromid = $c->to_id;
            } else {
                $fromid = $c->from_id;
            }
            $user=User::where('id',$fromid)->select('id','name','pic')->first();
            $chat_result[]=$user;
            $chat_last = Chat::where('group_id',$c->id)->orWhere('id',$c->id)->orderBy('id','DESC')->select('content')->first();
            $chats_last[]=$chat_last;
        }

        return response()->json(['status' => 200,'chats'=>$chats_last, 'chat_last' => $chat_group,'data'=>$chat_result], 200);
    }

     public function get_connect_chat(Request $request)
     {
         $auth_is = auth('api')->user();
         if ($auth_is) {
             $flight = User::where('api_token', $auth_is->api_token)->first();
         }
         $chat_id = $request->input('chat_id');
         $chat_group = Chat::with('chats:id,name,pic')
             ->where('chat.group_id', $chat_id)
             ->Orwhere('chat.id','=',$chat_id)
             ->join('user', 'user.id', '=', 'chat.to_id')
             ->select('chat.*', 'user.pic', 'user.name')
             ->orderBy('chat.id','ASC')
             ->get();
         $from_info = Chat::where('chat.id', $chat_id)
             ->join('user', 'user.id', '=', 'chat.from_id')
             ->select('user.id', 'user.pic', 'user.name', 'user.description', 'chat.to_id')
             ->first();
         if ($from_info->to_id != $flight->id) {
             $from_info = Chat::where('chat.id', $chat_id)
                 ->join('user', 'user.id', '=', 'chat.to_id')
                 ->select('user.id', 'user.pic', 'user.name', 'user.description')
                 ->first();
         }
         return response()->json(['status' => 200, 'data' => $chat_group, 'from_info' => $from_info], 200);
     }

    public function sub_chat_info(Request $request)
    {
        $chat_id = $request->input('chat_id');
        $from_id = $request->input('from_id');
        $to_id = $request->input('to_id');
        $content = $request->input('content');
        $upimages = $request->input('upimages');
        $chats = new Chat();
        $chats->from_id = $from_id;
        $chats->group_id = $chat_id;
        $chats->to_id = $to_id;
        
        if (!empty($upimages)){
            $upimages=json_encode($upimages);
            $chats->upimages = $upimages;
        }
        $chats->content = $content;
        $chats->save();
        $email = User::where('id',$from_id)->first()->email;
        $content = '奈斯猫温馨提醒您，您在平台收到最新的私信消息，请注意查收！'.date('Y-m-d H:i:s');
        $user_content = $content = '奈斯猫温馨提醒！'.date('Y-m-d H:i:s').'您在平台收到最新的私信消息，请注意查收';
        //邮箱通知
        $mail_address = Options::where('option_name','MAIL_FROM_ADDRESS')->first()->option_value;
        if ($mail_address){
            Mail::send('emails.verification',[
                'content'=>$content,
            ],function($message) use ($mail_address) {
                $message->subject('管理员通知');
                $message->to($mail_address);
            });
            Mail::send('emails.verification',[
                'content'=>$user_content,
            ],function($message) use ($email) {
                $message->subject('奈斯猫温馨提醒');
                $message->to($email);
            });
        }
        return response()->json(['status' => 200, 'msg' => '发送成功'], 200);
    }


    public function get_chatUser(Request $request){
        $nickname = $request->input('nickname');
        $all_user = User::where('name','like','%'.$nickname.'%')->select('id','name')->get();
        return response()->json(['status'=>200,'data'=>$all_user]);
    }

    public function sub_user_dialog(Request $request){
        $from_id = $request->input('from_id');
        $to_id = $request->input('to_id');
        $content = $request->input('content');
        if ($from_id==$to_id){
            return response()->json(['status' => 401, 'msg' => '不能给自己发送消息！'], 200);
        }
        $has_chat = Chat::where('from_id',$from_id)->where('to_id',$to_id)->first();
        if ($has_chat){
            $chats = new Chat();
            $chats->from_id = $from_id;
            $chats->group_id = $has_chat->id;
            $chats->to_id = $to_id;
            $chats->content = $content;
            $chats->save();
        }else{
            $chats = new Chat();
            $chats->from_id = $from_id;
            $chats->group_id = 0;
            $chats->to_id = $to_id;
            $chats->content = $content;
            $chats->save();
        }
        return response()->json(['status' => 200, 'msg' => '发送成功'], 200);
    }

    public function delete_point_chat(Request $request){
        $ids =$request->input('id');
        $chat_is = Chat::where('id',$ids)->first();
        if ($chat_is){
            $auth_is = auth('api')->user()->id;
            if ($auth_is==$chat_is->to_id || $auth_is==$chat_is->from_id ){
                $chat=Chat::where('id',$ids)->delete();
                $chat_group = Chat::where('group_id',$ids)->delete();
                return response()->json(['status'=>200,'msg'=>'删除成功!']);
            }
        }else{
            return response()->json(['status'=>200,'msg'=>'未找到该私信记录!'],200);
        }
    }


}

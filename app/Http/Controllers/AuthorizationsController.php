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

use App\Models\VerifyOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Faker\Generator;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use App\Models\Verify;
use Illuminate\Support\Facades\Auth;
class AuthorizationsController extends Controller{
    public function socialStore($type, Request $request) {
        if (!in_array($type, ['weixin', 'qq', 'weibo'])) {
            return response()->json(['status'=>200,'msg'=>'参数错误'],200);
        }
        if (in_array($type, ['weixin', 'qq', 'weibo' ])) {
            $driver = Socialite::driver($type);
            try {
                if ($code = $request->input('code')) {
                    $response = $driver->getAccessTokenResponse($code);
                    $token = \Arr::get($response, 'access_token');
                } else {
                    $token = $request->access_token;
                    if ($type == 'weixin') {
                        $driver->setOpenId($request->openid);
                    }
                }
                $oauthUser = $driver->userFromToken($token);
            }
            catch(\Exception $e) {
                return response()->json(['status'=>200,'msg'=>'参数错误，未获取用户信息'],200);
            }
        }
        $user = null;
        switch ($type) {
            case 'qq':
                $user = User::where('open_id', $oauthUser->getId())->first();
                if (!$user) {
                    $user = new User();
                    $user->name = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $oauthUser->getNickname());
                    $user->username = 'qquser_'.mt_rand(1000, 9999) . mt_rand(1000, 9999);
                    $user->password = bcrypt('a123456');
                    $user->open_id = $oauthUser->getId();
                    $user->pic =$oauthUser->getAvatar();
                    $user->balance = 0;
                    $user->integral = 0;
                    $user->save();
                    $user = User::where('open_id', $oauthUser->getId())->first();
                    $token =  Auth::guard('api')->fromUser($user);
                    $user->api_token = $this->respondWithToken($token)->original['access_token'];
                    $user->save();
                }else{
                    $token = Auth::guard('api')->fromUser($user);
                    $user->api_token = $this->respondWithToken($token)->original['access_token'];
                    $user->login_ip = getClientIp();
                    $user->save();
                }
                break;

            case 'weixin':
                $user = User::where('open_id', $oauthUser->getId())->first();
                if (!$user) {
                    $user = new User();
                    $user->name = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $oauthUser->getNickname());
                    $user->username = 'weixin_'.mt_rand(1000, 9999) . mt_rand(1000, 9999);
                    $user->password = bcrypt('a123456');
                    $user->open_id = $oauthUser->getId();
                    $user->pic =$oauthUser->getAvatar();
                    $user->gender=$oauthUser['sex'] == 1 ? '男' : '女';
                    $user->balance = 0;
                    $user->integral = 0;
                    $user->save();
                    $user = User::where('open_id', $oauthUser->getId())->first();
                    $token =  Auth::guard('api')->fromUser($user);
                    $user->api_token = $this->respondWithToken($token)->original['access_token'];
                    $user->save();
                }else{
                    $token = Auth::guard('api')->fromUser($user);
                    $user->api_token = $this->respondWithToken($token)->original['access_token'];
                    $user->login_ip = getClientIp();
                    $user->save();
                }
                break;

            case 'weibo':
                $user = User::query()->where('open_id', $oauthUser->getId())->first();
                if (!$user) {
                    $user = new User();
                    $user->name = preg_replace('/[\x{10000}-\x{10FFFF}]/u', '', $oauthUser->getNickname());
                    $user->username = 'weibo_'.mt_rand(1000, 9999) . mt_rand(1000, 9999);
                    $user->password = bcrypt('a123456');
                    $user->open_id = $oauthUser->getId();
                    $user->pic =$oauthUser->getAvatar();
                    $user->balance = 0;
                    $user->integral = 0;
                    $user->save();
                    $user = User::where('open_id', $oauthUser->getId())->first();
                    $token =  Auth::guard('api')->fromUser($user);
                    $user->api_token = $this->respondWithToken($token)->original['access_token'];
                    $user->save();
                }else{
                    $token = Auth::guard('api')->fromUser($user);
                    $user->api_token = $this->respondWithToken($token)->original['access_token'];
                    $user->login_ip = getClientIp();
                    $user->save();
                }
                break;
        }
        return response()->json(['status'=>200,'data'=>$this->respondWithToken($token)],200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }



    public function qq()
    {
        return \Socialite::with('qq')->redirect();
    }

    public function weixin()
    {
        return \Socialite::with('wechat_web')->redirect();
    }

    public function weibo()
    {
        return \Socialite::with('weibo')->redirect();
    }

    public function get_verify_auth(Request $request){
        $token = $request->header('Authorization');
        $token = substr($token, 7);
        if ($token){
            $flight = User::where('api_token', $token)->first();
        }else{
            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
        }
        $verify = Verify::where('user_id',$flight->id)->first();
        return response()->json(['status'=>200,'data'=>$verify],200);
    }

    public function get_verify_auth_is(Request $request){
        $token = $request->header('Authorization');
        $token = substr($token, 7);
        if ($token){
            $flight = User::where('api_token', $token)->first();
        }else{
            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
        }
        $verify = VerifyOrder::where('user_id',$flight->id)->first();
        return response()->json(['status'=>200,'data'=>$verify],200);
    }

    //sfrz
    public function verify_auth(Request $request){
        $name = $request->input('name');
        $user_id = $request->input('user_id');
        $sfz_number = $request->input('sfz_number');
        $web_name = $request->input('web_name');
        $sfz_before = $request->input('sfz_before');
        $sfz_after = $request->input('sfz_after');
        $sfzIs = Verify::where('sfz_number',$sfz_number)->first();
        $web_nameIs = Verify::where('web_name',$web_name)->first();
        $auth = Verify::where('user_id',$user_id)->first();
        if ($auth){
            if ($auth->state!=2){
                return response()->json(['status'=>401,'msg'=>'您已经提交过申请！'],401);
            }else{
                $auth->name = $name;
                $auth->user_id = $user_id;
                $auth->sfz_number = $sfz_number;
                $auth->web_name = $web_name;
                $auth->sfz_before = $sfz_before;
                $auth->sfz_after = $sfz_after;
                $auth->state = 0;
                $auth->save();
                return response()->json(['status'=>200,'msg'=>'提交审核成功，请等待审核完成！'],200);
            }
        }else{
            if ($sfzIs){
                return response()->json(['status'=>401,'msg'=>'该身份证号已经存在！'],401);
            }else if($web_nameIs){
                return response()->json(['status'=>401,'msg'=>'该称号已存在！'],401);
            }else{
                $verify = new Verify();
                $verify->name = $name;
                $verify->user_id = $user_id;
                $verify->sfz_number = $sfz_number;
                $verify->web_name = $web_name;
                $verify->sfz_before = $sfz_before;
                $verify->sfz_after = $sfz_after;
                $verify->state = 0;
                $verify->save();
                return response()->json(['status'=>200,'msg'=>'提交审核成功，请等待审核完成！'],200);
            }
        }
    }

    public function verify_auth_money(Request $request){
        $web_name = $request->input('web_name');
        $user_id = $request->input('user_id');
        $web_nameIs = Verify::where('web_name',$web_name)->where('user_id','!=',$user_id)->first();
        $users = Verify::where('user_id',$user_id)->first();
        if($web_nameIs){
            return response()->json(['status'=>401,'msg'=>'该称号已存在！'],401);
        }else if($users){
            $users->web_name = $web_name;
            $users->state = 1;
            $users->user_id =$user_id;
            $users->save();
            return response()->json(['status'=>200,'msg'=>'提交认证成功！'],200);
        }else{
            $verify = new Verify();
            $verify->web_name = $web_name;
            $verify->state = 1;
            $verify->user_id =$user_id;
            $verify->save();
            return response()->json(['status'=>200,'msg'=>'提交认证成功！'],200);
        }
    }

}

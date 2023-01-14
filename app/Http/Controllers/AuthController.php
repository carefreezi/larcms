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

use App\Models\Options;
use App\Models\User;
use App\Models\VipMeat;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * 用户使用邮箱密码获取JWT Token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);
        $username = $request->input('username');
        $captcha = $request->input('captcha');
        $key = $request->input('key');
        if ($captcha==''){
            return response()->json(['status' => 401, 'msg' => '验证码为空' ],401);
        }else if (!captcha_api_check($captcha,$key)){
            return response()->json(['status' => 401, 'msg' => '验证码不匹配' ],401);
        }else if (! $token = auth('api')->attempt($credentials)){
            return response()->json(['status'=>401,'msg' => '账号或密码错误'],401);
        }
        $flight = User::where('username', $username)->first();
        $flight->api_token = $token;
        $flight->login_ip = getClientIp();
        $flight->save();
        $vip_info = VipMeat::where('user_id',$flight->id)->first();
        if($vip_info){
            $vip_time = strtotime($vip_info->vip_times);
            if($vip_time<strtotime(date('Y-m-d H:i:s'))){
                $vip_info->delete();
            }
        }
        return response()->json(['status'=>200,'msg'=>'登录成功','data'=>$this->respondWithToken($token)]);
    }

    /**
     * 注册新用户
     */
    public function register(Request $request)
    {
        // 数据校验
        // 数据验证
        $validator = Validator::make($request->all(), [
            'username'       => 'required',
            'email'      => 'required|email',
            'password'   => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>401,'msg'=>$validator->errors()], 401);
        }
        $captcha = $request->input('captcha');
        $key = $request->input('key');
        $username = $request->input('username');
        $email = $request->input('email');
        $is_username = User::where('username',$username)->first();
        $is_email = User::where('email',$email)->first();
        $invitation_code = $request->input('invitation_code');
    
        if ($captcha==''){
            return response()->json(['status' => 401, 'msg' => '验证码为空' ],401);
        }else if (!captcha_api_check($captcha,$key)){
            return response()->json(['status' => 401, 'msg' => '验证码不匹配' ],401);
        }else if ($is_username){
            return response()->json(['status' => 401, 'msg' => '用户名已存在' ],401);
        }else if ($is_email){
            return response()->json(['status' => 401, 'msg' => '邮箱已存在' ],401);
        }else if (!empty($invitation_code)){
            $parent_user = User::where('invitation_code',$invitation_code)->first();
            if ($parent_user){
                $vip_info = VipMeat::where('user_id',$parent_user->id)->join('vip','vip.vip_level','=','vip_meta.vip_level')->first();
                if ($vip_info){
                    $parent_user->integral = $parent_user->integral+$vip_info->invitation;
                    $parent_user->save();
                }else{
                    $option_jifen = Options::where('option_name','invitation_default')->first()->option_value;
                    $parent_user->integral = $parent_user->integral+$option_jifen;
                    $parent_user->save();
                }

            }else{
                return response()->json(['status' => 401, 'msg' => '邀请码不存在' ],401);
            }
        }
        // 读取参数并保存数据
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $defaults = Options::where('option_name','api')->first()->option_value;
        $input['pic']='https://new-epmao.oss-cn-beijing.aliyuncs.com/avatar/202208/28/ysahWbXGUEdLJiCLhahUnnqtvppEHD611A1LDDsJ.png';
        $input['reg_ip']=getClientIp();
        $input['invitation_code'] = make_coupon_card();
        $input['integral']=0;
        $user = User::create($input);

        $content = '温馨提醒！'.date('Y-m-d H:i:s').'新注册用户'.$user->username.'注册IP为：'.getClientIp();
        $user_content = $content = '温馨提醒！'.date('Y-m-d H:i:s').'您新注册的账号'.$user->username.'，请保管好您的账户信息！';
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
                $message->subject('温馨提醒');
                $message->to($email);
            });
        }

        // 创建Token并返回
        return response()->json(['status'=>200,'msg'=>'注册成功','data'=>$user]);
    }

    /**
     * 获取经过身份验证的用户.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(['status'=>200,'data'=>auth()->user()],200);
    }

    /**
     * 刷新Token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

}

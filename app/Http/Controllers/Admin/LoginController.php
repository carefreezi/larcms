<?php
/*
 * Copyright (c) 2021-2021. The system is a commercial version of Larcms.
 * You cannot use or sell the system without authorization. The system has obtained copyright. If it is flooded or distributed and sold privately, it will be subject to legal sanctions
 * Author: Carefree
 * QQ No.: 869375583
 * Official website: www.nsmao.com
 * This account is the only author account, and others are fake
 */

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    /**
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['username', 'password']);
        $username = $request->input('username');
        if (! $token = auth('admin')->attempt($credentials)){
            return response()->json(['status'=>401,'msg' => '账号或密码错误','error' => 'Unauthorized'],401);
        }
        $flight = Admin::where('username', $username)->first();
        $flight->api_token = $token;
        $flight->save();
        return response()->json(['status'=>200,'msg'=>'登录成功','data'=>$this->respondWithToken($token),'access_token'=>$token]);

    }

    public function me()
    {
        return response()->json(['infos'=>auth('admin')->user(),'status'=>200]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out','status'=>200]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}

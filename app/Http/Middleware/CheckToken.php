<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class CheckToken
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {  //获取到用户数据，并赋值给$user
                return response()->json([
                    'errcode' => 1004,
                    'errmsg' => 'user not found'
                ], 404);
            }
            //如果想向控制器里传入用户信息，将数据添加到$request里面
            $request->attributes->add(json_decode(json_encode($user), true));//添加参数,原博主这里写的$userinfo,会报错，整个文件并没有出现这个变量，这是我修改之后的。这一步的操作就是为了在控制器中我们能使用$request->get('id');快速方便的获取当前用户信息。
            return $next($request);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'errcode' => 401,
            'errmsg' => 'token 过期' , //token已过期
        ]);
    } catch (TokenInvalidException $e) {
            return response()->json([
                'errcode' => 401,
                'errmsg' => 'token 无效',  //token无效
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'errcode' => 401,
                'errmsg' => '缺少token' , //token为空
            ]);
        }
    }
}

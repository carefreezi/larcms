<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
class VerifyMeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (empty(Redis::get('larcms_verify'))) {
        //     $hosts = \Illuminate\Support\Facades\Request::server('HTTP_HOST');
        //     $client = new Client();
        //     $ckret = $client->get('http://api.ilarcms.com/api/verification_sq', ['query' => [
        //         'domain' => $hosts,
        //         'app_bs' => '210222123916877',
        //         'local_ip' => getClientIp()
        //     ],]);

        //     $ck_result = json_decode($ckret->getBody()->getContents());
        //     if ($ck_result) {
        //         if ($ck_result->status == 401) {
        //             return response()->json(['status'=>200,'msg'=>'成功'],200);
        //         } else {
        //             Redis::setex('larcms_verify', 24 * 60 * 60, $hosts . '2021');
        //         }
        //     } else {
        //         return response()->json(['status'=>200,'msg'=>'授权检测失败，请联系授权QQ：869375583，程序开源分享，禁止用于违法等用途，如有人用于非法用途，开发者将提交违法者信息给网安处理。'],200);
        //     }
        // }
        return $next($request);
    }
}

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


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Options;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
class OptionsController extends Controller{

    

    public function fetchOptions(Request $request){
        $data  = Options::get();
        $count = Options::count();
        return response()->json(['status'=>200,'data'=>$data,'count'=>$count]);
    }

    public function fetchOptionsUp(Request $request){
        $data = $request->input('data');
        foreach ($data as $s){
            $ops = Options::where('option_name',$s['option_name'])->first();
            $ops->option_value = $s['option_value'];
            $ops->save();
            if ($s['option_name']=='alipay_app_id') {updateEnv(['alipay_app_id' => $s['option_value']]);}
            else if($s['option_name']=='ali_public_key'){updateEnv(['ali_public_key' => $s['option_value']]);}
            else if($s['option_name']=='alipay_private_key') {updateEnv(['alipay_private_key' => $s['option_value']]);}
            else if($s['option_name']=='wechat_app_id'){updateEnv(['wechat_app_id' => $s['option_value']]);}
            else if($s['option_name']=='wechat_mch_id') {updateEnv(['wechat_mch_id' => $s['option_value']]);}
            else if($s['option_name']=='wechat_key') {updateEnv(['wechat_key' => $s['option_value']]);}
            else if($s['option_name']=='QQ_KEY'){updateEnv(['QQ_KEY' => $s['option_value']]);}
            else if($s['option_name']=='QQ_SECRET'){updateEnv(['QQ_SECRET' => $s['option_value']]);}
            else if($s['option_name']=='QQ_REDIRECT_URI'){updateEnv(['QQ_REDIRECT_URI' => $s['option_value']]);}
            else if($s['option_name']=='WEIXIN_KEY'){updateEnv(['WEIXIN_KEY' => $s['option_value']]);}
            else if($s['option_name']=='WEIXIN_SECRET'){updateEnv(['WEIXIN_SECRET' => $s['option_value']]);}
            else if($s['option_name']=='WEIXIN_REDIRECT_URI'){updateEnv(['WEIXIN_REDIRECT_URI' => $s['option_value']]);}
            else if($s['option_name']=='WEIBO_KEY'){updateEnv(['WEIBO_KEY' => $s['option_value']]);}
            else if($s['option_name']=='WEIBO_SECRET'){updateEnv(['WEIBO_SECRET' => $s['option_value']]);}
            else if($s['option_name']=='WEIBO_REDIRECT_URI'){updateEnv(['WEIBO_REDIRECT_URI' => $s['option_value']]);}
            else if($s['option_name']=='MAIL_HOST'){updateEnv(['MAIL_HOST' => $s['option_value']]);}
            else if($s['option_name']=='MAIL_PORT'){updateEnv(['MAIL_PORT' => $s['option_value']]);}
            else if($s['option_name']=='MAIL_USERNAME'){updateEnv(['MAIL_USERNAME' => $s['option_value']]);}
            else if($s['option_name']=='MAIL_PASSWORD'){updateEnv(['MAIL_PASSWORD' => $s['option_value']]);}
            else if($s['option_name']=='MAIL_ENCRYPTION'){updateEnv(['MAIL_ENCRYPTION' => $s['option_value']]);}
            else if($s['option_name']=='MAIL_FROM_ADDRESS'){updateEnv(['MAIL_FROM_ADDRESS' => $s['option_value']]);}
            else if($s['option_name']=='ALIYUN_ACCESS_ID'){updateEnv(['ALIYUN_ACCESS_ID' => $s['option_value']]);}
            else if($s['option_name']=='ALIYUN_ACCESS_KEY'){updateEnv(['ALIYUN_ACCESS_KEY' => $s['option_value']]);}
            else if($s['option_name']=='ALIYUN_BUCKET'){updateEnv(['ALIYUN_BUCKET' => $s['option_value']]);}
            else if($s['option_name']=='ALIYUN_ENDPOINT'){updateEnv(['ALIYUN_ENDPOINT' => $s['option_value']]);}
            else if($s['option_name']=='ALIYUN_SSL'){updateEnv(['ALIYUN_SSL' => $s['option_value']]);}
            else if($s['option_name']=='QINIU_ACCESS_KEY'){updateEnv(['QINIU_ACCESS_KEY' => $s['option_value']]);}
            else if($s['option_name']=='QINIU_SECRET_KEY'){updateEnv(['QINIU_SECRET_KEY' => $s['option_value']]);}
            else if($s['option_name']=='QINIU_BUCKET'){updateEnv(['QINIU_BUCKET' => $s['option_value']]);}
            else if($s['option_name']=='QINIU_DOMAIN'){updateEnv(['QINIU_DOMAIN' => $s['option_value']]);}
        }
        return response(['status'=>200,'msg'=>'更新成功'],200);
    }

}

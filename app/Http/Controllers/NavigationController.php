<?php
namespace App\Http\Controllers;
/*
 * Copyright (c) 2021. The system is a commercial version of Larcms.
 * You cannot use or sell the system without authorization. The system has obtained copyright. If it is flooded or distributed and sold privately, it will be subject to legal sanctions
 * Author: Carefree
 * QQ No.: 869375583
 * Official website: www.nsmao.com
 * This account is the only author account, and others are fake
 */
use App\Models\Navigation;
use App\Models\Navcate;
use App\Models\Navsearch;
use App\Models\Options;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class NavigationController extends Controller{
    public function index() {
        $nav_search = Navsearch::get();
        $hot = Navigation::where('is_hot',1)->where('status',1)->limit(30)->get();
        $all_nav = Navcate::with("navAll")->limit(14)->get();
        $cates = Navcate::where('is_hot',1)->get();
        $baidu_resou =  getUrlContentBaidu();
        $weibo_resou =  getUrlContent();
        return response()->json(['status'=>200,'search'=>$nav_search,'hot'=>$hot,'data'=>$all_nav,'cates'=>$cates,'baidu'=>$baidu_resou,'weibo'=>$weibo_resou],200);
    }

    public function hot_normal(){
        
        
        $hot = Navigation::where('is_hot',1)->where('status',1)->get();
        return response()->json(['status'=>200,'hot'=>$hot],200);
    }

    public function hot_select(Request $request){
        $cate_id = $request->input('active_id');
        $hot_list = Navigation::where('cate_id',$cate_id)->where('status',1)->get();
        return response()->json(['status'=>200,'hot'=>$hot_list],200);
    }

    public function get_meta(Request $request){
        $url = $request->input('url');
        $meta = get_sitemeta($url);
        $ico_url = get_ico_is($url);
        if($ico_url){
            $ext = strrchr($ico_url, ".");
            $filename = date("dMYHis") . '.png';
            ob_start();//打开输出
            $stream_opts = [
                "ssl" => [
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ]
            ];
            @readfile($ico_url, false, stream_context_create($stream_opts));//输出图片文件
            $img = ob_get_contents();//得到浏览器输出
            ob_end_clean();//清除输出并关闭
            $fp2 = @fopen($filename, "a");
            fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
            fclose($fp2);
            $alioss = Options::where('option_name', 'oss')->first();
            if ($alioss->option_value == 'alioss') {
                $path = '/navigation/' . date("Ym/d", time());
                $image_path = upload_image_ico($path, $filename);
                unlink($filename); //unlink方法删除文件
                return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'data'=>$meta,'status' => 200], 200);
            } else if ($alioss->option_value == 'qiniuoss') {
                $path = '/navigation/' . date("Ym/d", time());
                $image_path = upload_image_ico($path, $filename, 'qiniu');
                unlink($filename); //unlink方法删除文件
                return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'data'=>$meta,'status' => 200], 200);
            } else {
                $api = Options::where('option_name', 'api')->first()->option_value;
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . 'png';
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($url)); //上传到指定路径
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
                unlink($filename); //unlink方法删除文件
                return response()->json(['msg' => '上传成功', 'files' => ['file' => $filepath],'data'=>$meta, 'status' => 200], 200);
            }
        }
        return response()->json(['msg' => '上传成功', 'files' => ['file' => ''],'data'=>$meta, 'status' => 200], 200);


      
    }
    
    public function ico_upload(Request $request){
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
    
    
    public function get_hot(){
        $baidu_resou =  getUrlContentBaidu();
        $weibo_resou =  getUrlContent();
        return response()->json(['status'=>200,'baidu'=>$baidu_resou,'weibo'=>$weibo_resou],200);
    }

    public function add_web(Request $request){
        $name=$request->input("name");
        $url=$request->input("url");
        $ico=$request->input("ico");
        $des=$request->input("des");
        $region=$request->input("region");
        if(!empty($name) && !empty($url) && !empty($ico)){
            $nav = new Navigation();
            $nav->name = $name;
            $nav->ico = $ico;
            $nav->description = $des;
            $nav->url=$url;
            $nav->cate_id=$region;
            $nav->view=0;
            $nav->zan=0;
            $nav->is_hot=0;
            $nav->status=0;
            $nav->save();
            return response()->json(['status' =>200,'msg'=>'添加成功'],200);
        }else{
            return response()->json(['status' =>403,'msg'=>'添加失败'],403);
        }

    }



}



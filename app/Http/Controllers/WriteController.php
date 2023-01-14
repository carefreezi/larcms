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

use App\Models\Banner;
use App\Models\Friendly;
use App\Models\Meat;
use App\Models\Options;
use App\Models\Post;
use App\Models\Postmeta;
use App\Models\Special;
use App\Models\Specialmeta;
use App\Models\User;
use App\Models\Verify;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Top;
use App\Models\Service;
use App\Models\Layout;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\Verification;
use App\Models\Vip;
use App\Models\VipMeat;
use Carbon\Carbon;
class WriteController extends Controller{

    public function get_cate(){
        $category = Top::get();
        return response()->json(['status'=>200,'cates'=>$category],200);
    }

    public function get_vip(){
        $vips = Vip::get();
        return response()->json(['status'=>200,'vips'=>$vips],200);
    }

    public function get_special(){
        $specials = Special::get();
        return response()->json(['status'=>200,'specials'=>$specials],200);
    }

    public function post_upload(Request $request){
        if ($request->isMethod('POST')) {
            $files = $request->file('file');
            if ($files->getClientOriginalExtension()=='png' || $files->getClientOriginalExtension()=='jpg' || $files->getClientOriginalExtension()=='ico') {
                // 判断文件是否上传成功
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
                    return response()->json(['msg' => '上传成功', 'files' => ['file' => $filepath], 'status' => 200], 200);
                }
            }else{
                return response()->json(['status' => 401, 'msg' => '上传失败,文件格式错误!'], 401);
            }
        }
    }

    public function create_article(Request $request){
        $all_post = $request->input();
        $posts = new Post();
        $cate = new Meat();
        $special = new Specialmeta();
        $posts->title = $all_post['title'];
        $posts->author_id = $all_post['author'];
        $posts->content = $all_post['content'];
        $posts->price = $all_post['price'];
        $posts->vip_price = $all_post['vip_price'];
        $posts->tags = json_encode($all_post['dynamicTags']);
        $posts->isvip_level = $all_post['isvip_level'];
        $posts->create_time = date('Y-m-d H:i:s');
        $posts->show_url = $all_post['source_uri'];
        $posts->download_url = $all_post['dw_url'];
        $posts->extraction_code = $all_post['traction'];
        $posts->extract_code = $all_post['trac'];
        if (empty($all_post['cover'])){
            $first_img = '';
            $output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU',$all_post['content'] , $matches);
            if(empty($output)){
                $default_pic = Options::where('option_name','post_default_cover')->first()->option_value;
                $first_img = $default_pic;
            }else {
                $first_img = $matches [1][0];
            }
            $posts->cover = $first_img;
        }else{
            $posts->cover = $all_post['cover'];
        }
        $posts->style_type = $all_post['style_type'];
        $posts->view = 0;
        $posts->likes = 0;
        $posts->integral = $all_post['integral'];
        $post_is_draft = Options::where('option_name','post_is_draft')->first()->option_value;
        if ($post_is_draft=='yes'){
            $posts->status=0;
        }else{
            $posts->status=1;
        }
        $posts->save();
        $cate->cate_id = $all_post['category'];
        $cate->post_id = $posts->id;
        $cate->save();
        foreach ($all_post['special'] as $v){
            $is_special = new Specialmeta();
            $is_special->post_id = $posts->id;
            $is_special->special_id = $v;
            $is_special->save();
        }

        if ($posts){
            return response()->json(['status'=>200,'msg'=>'新增文章成功'],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'发布失败'],401);
        }
    }

    public function get_vip_info(Request $request){
        $user_id = $request->input('user_id');
        $is_vip = VipMeat::where('user_id',$user_id)->where('vip_status',1)->first();
        if ($is_vip){
            return response()->json(['status'=>200,'data'=>'yes','vip_times'=>$is_vip->vip_times],200);
        }else{
            return response()->json(['status'=>200,'data'=>'no'],200);
        }
    }

    public function fetch_edit_post(Request $request){
        $ids = $request->input('ids');
        $post = Post::where('post.id',$ids)
            ->join('meta','meta.post_id','=','post.id')
            ->first(['post.*','meta.cate_id']);
        $post_special = Post::where('post.id',$ids)->join('specialmeta','specialmeta.post_id','=','post.id')->select('specialmeta.special_id')->get();
        $post_s = [];
        foreach ($post_special as $p){
            $post_s[]=$p->special_id;
        }
        return response()->json(['status'=>200,'data'=>$post,'specials'=>$post_s],200);
    }

    public function update_article(Request $request){
        $all_post = $request->input();
        $posts = Post::find($all_post['id']);
        $cates = Meat::where('post_id',$all_post['id'])->first();
        $specials = Specialmeta::where('post_id',$all_post['id'])->first();
        $posts->title = $all_post['title'];
        $posts->author_id = $all_post['author'];
        $posts->content = $all_post['content'];
        $posts->price = $all_post['price'];
        $posts->vip_price = $all_post['vip_price'];
        $posts->tags = json_encode($all_post['dynamicTags']);
        $posts->isvip_level = $all_post['isvip_level'];
        $posts->create_time = date('Y-m-d H:i:s');
        $posts->show_url = $all_post['source_uri'];
        $posts->download_url = $all_post['dw_url'];
        $posts->extraction_code = $all_post['traction'];
        $posts->extract_code = $all_post['trac'];
        if (empty($all_post['cover'])){
            $first_img = '';
            $output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU',$all_post['content'] , $matches);
            if(empty($output)){
                $default_pic = Options::where('option_name','post_default_cover')->first()->option_value;
                $first_img = $default_pic;
            }else {
                $first_img = $matches [1][0];
            }
            $posts->cover = $first_img;
        }else{
            $posts->cover = $all_post['cover'];
        }
        $posts->style_type = $all_post['style_type'];
        $posts->integral = $all_post['integral'];
        $posts->save();
        $cates->cate_id=$all_post['category'];
        $cates->save();
        $special_select = Specialmeta::where('post_id',$all_post['id'])->select('special_id')->get();
        $post_s = [];
        foreach ($special_select as $p){
            $post_s[]=$p->special_id;
        }
        if (empty(array_diff($post_s,$all_post['special']))){
            //增加进入
            foreach (array_diff($all_post['special'],$post_s) as $s){
                $add_special = new Specialmeta();
                $add_special->post_id = $all_post['id'];
                $add_special->special_id = $s;
                $add_special->save();
            }
        }else{
            $is_special = Specialmeta::where('special_id',array_diff($post_s,$all_post['special']))->where('post_id',$all_post['id'])->delete();
        }

        if ($posts){
            return response()->json(['status'=>200,'msg'=>'修改文章成功'],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'修改失败'],401);
        }
    }

    public function is_writer(Request $request){
        $post_id = $request->input('id');
        $token = $request->header('Authorization');
        $token = substr($token, 7);
        if ($token){
            $user = User::where('api_token', $token)->first();
        }else{
            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
        }
        $is_post = Post::where('id',$post_id)->where('author_id',$user->id)->first();
        if ($is_post){
            return response()->json(['status'=>200,'data'=>true],200);
        }else{
            return response()->json(['status'=>200,'data'=>false],200);
        }
    }
    
    public function create_caiji(Request $request){
        $all_post = $request->input();
        $posts = new Post();
        $cate = new Meat();
        $special = new Specialmeta();
        $posts->title = $all_post['title'];
        $posts->author_id = $all_post['author'];
        $posts->content = $all_post['content'];
        $posts->price = $all_post['price'];
        $posts->vip_price = $all_post['vip_price'];
        $chuli_shuzu = $all_post['dynamicTags'];
        $posts->tags =json_encode(explode(",",$chuli_shuzu));
        $posts->isvip_level =null;
        $posts->create_time = date('Y-m-d H:i:s');
        $posts->show_url = $all_post['source_uri'];
        $posts->download_url = $all_post['dw_url'];
        $posts->extraction_code = $all_post['traction'];
        $posts->extract_code = $all_post['trac'];
        if (empty($all_post['cover'])){
            $first_img = '';
            $output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU',$all_post['content'] , $matches);
            if(empty($output)){
                $default_pic = Options::where('option_name','post_default_cover')->first()->option_value;
                $first_img = $default_pic;
            }else {
                $first_img = $matches [1][0];
            }
            $posts->cover = $first_img;
        }else{
            $posts->cover = $all_post['cover'];
        }
        $posts->style_type = 1;
        $posts->view = 0;
        $posts->likes = 0;
        $posts->integral = $all_post['integral'];
        $post_is_draft = Options::where('option_name','post_is_draft')->first()->option_value;
        if ($post_is_draft=='yes'){
            $posts->status=0;
        }else{
            $posts->status=1;
        }
        $posts->save();
        $cate->cate_id = $all_post['category'];
        $cate->post_id = $posts->id;
        $cate->save();
      

        if ($posts){
            return response()->json(['status'=>200,'msg'=>'新增文章成功'],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'发布失败'],401);
        }
    }
}

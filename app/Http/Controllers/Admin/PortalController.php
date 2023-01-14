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

use App\Models\Accounts;
use App\Models\Comment;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Special;
use App\Models\Specialmeta;
use App\Models\Verify;
use App\Models\VerifyOrder;
use App\Models\Vip;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Message;
use App\Models\Post;
use App\Models\Postorders;
use App\Models\Options;
use App\Models\Meat;
use App\Models\Postmeta;
use App\Models\Sign;
use App\Models\VipMeat;
use App\Models\Gigtmeta;
use App\Models\Top;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Collect;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
use App\Models\Chat;
class PortalController extends Controller
{
    public function portal(){
        $users = User::count();
        $users_vip = VipMeat::count();
        $Message = Message::count();
        $Post = Post::count();
        $Postorders = Postorders::where('state',1)->sum('post_price');
        $post_order = Postorders::count();
        $notice = Notice::count();
        $orders = Order::count();
        $order_no = Order::where('state',0)->count();
        $order_yes = Order::where('state',1)->count();
        $account = Accounts::where('state',1)->count();
        $withdrawal  =Withdrawal::where('state',0)->count();
        $today_recharge = Order::where('state',1)
            ->where('types',0)
            ->where('data', '<', date('Y-m-d 23:59:59', time()))
            ->where('data', '>', date('Y-m-d 00:00:00', time()))
            ->sum('amount');
        $today_refuse = Accounts::where('state',1)
            ->where('data', '<', date('Y-m-d 23:59:59', time()))
            ->where('data', '>', date('Y-m-d 00:00:00', time()))
            ->sum('amount');
        $today_sign = Sign::
            where('nowModifyTime', '<', date('Y-m-d 23:59:59', time()))
            ->where('nowModifyTime', '>', date('Y-m-d 00:00:00', time()))
            ->count();
        $today_reg = User::
            where('created_at', '<', date('Y-m-d 23:59:59', time()))
            ->where('created_at', '>', date('Y-m-d 00:00:00', time()))
            ->count();
        return response()->json([
            'status'=>200,
            'users'=>$users,
            'message'=>$Message,
            'post'=>$Post,
            'postorders'=>$Postorders,
            'notice' => $notice,
            'post_order'=>$post_order,
            'user_vip' =>$users_vip,
            'orders' => $orders,
            'order_no' => $order_no,
            'order_yes' => $order_yes,
            'account' => $account,
            'withdrawal'=> $withdrawal,
            'today_recharge' =>$today_recharge,
            'today_refuse' =>$today_refuse,
            'today_sign' => $today_sign,
            'today_reg' =>$today_reg
        ],200);
    }

    public function list(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $Post = Post::join('meta', 'post.id', '=', 'meta.post_id')
            ->join('user','post.author_id','=','user.id')
            ->join('category','meta.cate_id','=','category.id')
            ->select('post.*','user.name as username','category.name as catename')
            ->where('post.status',1)
            ->orderBy('post.id','DESC')
            ->forPage($page,$limits)
            ->get();
        $postcount = Post::where('status',1)->count();
        return response()->json(['status'=>200,'post'=>$Post,'counts'=>$postcount],200);
    }

    public function list_two(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $Post = Post::join('meta', 'post.id', '=', 'meta.post_id')
            ->join('user','post.author_id','=','user.id')
            ->join('category','meta.cate_id','=','category.id')
            ->select('post.*','user.name as username','category.name as catename')
            ->where('post.status',0)
            ->orderBy('post.id','DESC')
            ->forPage($page,$limits)
            ->get();
        $postcount = Post::where('status',0)->count();
        return response()->json(['status'=>200,'post'=>$Post,'counts'=>$postcount],200);
    }

    public function PassPostId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'文章不存在'],401);
        }
        $num = Post::where('id',$id)->first();
        $num->status=1;
        $num->save();
        return response()->json(['status'=>200,'data'=>'审核成功'],200);
    }

    public function FailPostId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'文章不存在'],401);
        }
        $num = Comment::where('id',$id)->first();
        $num->status=2;
        $num->save();
        return response()->json(['status'=>200,'msg'=>'审核不通过'],200);
    }

    public function SelectCate(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $ids = $request->input('id');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        if ($ids==0){
            $Post = Post::join('meta', 'post.id', '=', 'meta.post_id')
                ->join('user','post.author_id','=','user.id')
                ->join('category','meta.cate_id','=','category.id')
                ->select('post.*','user.name as username','category.name as catename')
                ->where('post.status',1)
                ->orderBy('post.id','DESC')
                ->forPage($page,$limits)
                ->get();
            $postcount = Post::join('meta', 'post.id', '=', 'meta.post_id')
                ->join('user','post.author_id','=','user.id')
                ->join('category','meta.cate_id','=','category.id')
                ->select('post.*','user.name as username','category.name as catename')
                ->where('post.status',1)->count();
        }else{
            $Post = Post::join('meta', 'post.id', '=', 'meta.post_id')
                ->join('user','post.author_id','=','user.id')
                ->join('category','meta.cate_id','=','category.id')
                ->select('post.*','user.name as username','category.name as catename')
                ->where('category.id',$ids)
                ->where('post.status',1)
                ->orderBy('post.id','DESC')
                ->forPage($page,$limits)
                ->get();
            $postcount = Post::join('meta', 'post.id', '=', 'meta.post_id')
                ->join('user','post.author_id','=','user.id')
                ->join('category','meta.cate_id','=','category.id')
                ->where('category.id',$ids)
                ->where('post.status',1)->count();
        }

        return response()->json(['status'=>200,'post'=>$Post,'counts'=>$postcount],200);
    }

    public function SearchPost(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $content = $request->input('content');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $Post = Post::join('meta', 'post.id', '=', 'meta.post_id')
            ->join('user', 'post.author_id', '=', 'user.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->select('post.*', 'user.name as username', 'category.name as catename')
            ->where('post.title', 'like', '%' . $content . '%')
            ->where('post.status', 1)
            ->orderBy('post.id', 'DESC')
            ->forPage($page, $limits)
            ->get();
        $postcount = Post::join('meta', 'post.id', '=', 'meta.post_id')
            ->join('user', 'post.author_id', '=', 'user.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->where('post.title', 'like', '%' . $content . '%')
            ->where('post.status', 1)
            ->count();
        return response()->json(['status'=>200,'post'=>$Post,'counts'=>$postcount],200);
    }


    public function del_detail(Request $request){
        $post_id = $request->input('id');
        $num = Post::where('id',$post_id)->delete();
        $cates = Meat::where('post_id',$post_id)->delete();
        $post_meta = Postmeta::where('post_id',$post_id)->delete();
        $post_comment = Comment::where('post_id',$post_id)->delete();
        $collect = Collect::where('post_id',$post_id)->delete();
        $post_special = Specialmeta::where('post_id',$post_id)->delete();
        if (!empty($num) && !empty($cates)){
            return response()->json(['status'=>200,'msg'=>'删除成功'],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'删除失败'],401);
        }
    }

    public function search_user(Request $request){
        $keywords = $request->input('name');
        $user = User::where('name','like','%'.$keywords.'%')->get();
        return response()->json(['status'=>200,'user'=>$user],200);
    }

    public function create_post(Request $request){
        $all_post = $request->input();
        $posts = new Post();
        $cate = new Meat();
        $special = new Specialmeta();
        $posts->title = $all_post['title'];
        $posts->author_id = $all_post['author'];
        $posts->content = $all_post['content'];
        $posts->price = $all_post['price'];
        $posts->vip_price = $all_post['vip_price'];
        $posts->tags = json_encode($all_post['tags']);
        $posts->isvip_level = $all_post['isvip_level'];
        $posts->create_time = date('Y-m-d H:i:s');
        $posts->show_url = $all_post['web_url'];
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
        $posts->status = $all_post['status'];
        $posts->save();
        $cate->cate_id = $all_post['cate_id'];
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

    public function update_post(Request $request){
        $all_post = $request->input();
        $posts = Post::find($all_post['id']);
        $cates = Meat::where('post_id',$all_post['id'])->first();
        $specials = Specialmeta::where('post_id',$all_post['id'])->first();
        $posts->title = $all_post['title'];
        $posts->author_id = $all_post['author'];
        $posts->content = $all_post['content'];
        $posts->price = $all_post['price'];
        $posts->vip_price = $all_post['vip_price'];
        $posts->tags = json_encode($all_post['tags']);
        $posts->isvip_level = $all_post['isvip_level'];
        $posts->create_time = date('Y-m-d H:i:s');
        $posts->show_url = $all_post['web_url'];
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
        $posts->status = $all_post['status'];
        $posts->save();
        $cates->cate_id=$all_post['cate_id'];
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

    public function upload_img(Request $request){
        $files = $request->file('file');
        if ($files->getClientOriginalExtension()=='png' || $files->getClientOriginalExtension()=='jpg' || $files->getClientOriginalExtension()=='ico'){
            $options = Options::where('option_name','api')->first();
            if($files->isValid()){
                $alioss = Options::where('option_name','oss')->first();
                if ($alioss->option_value=='alioss'){
                    $path = '/' . date("Ym/d", time());
                    $image_path = upload_image($path, $files);
                    return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                }else if ($alioss->option_value=='qiniuoss'){
                    $path = '/' . date("Ym/d", time());
                    $image_path = upload_image($path, $files,'qiniu');
                    return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                }else {
                    $originlNmae = $files->getClientOriginalName();//文件名
                    $ext = $files->getClientOriginalExtension();//扩展名
                    $type = $files->getClientMimeType();//文件类型
                    $realPath = $files->getRealPath();//临时绝对目录
                    $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
                    return response()->json(['status' => 200, 'msg' => '上传成功', 'files' => ['file' => $options->option_value . '/app/uploads/' . $filename]], 200);
                }
            }
        }else{
            return response()->json(['status' => 401, 'msg' => '上传失败,文件格式错误!'], 401);
        }

    }

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

    public function get_author(){
        $author_info = Verify::where('state',1)->join('user','auth.user_id','=','user.id')->select('user.name','user.id')->get();
        return response()->json(['status'=>200,'author_info'=>$author_info],200);
    }

    public function fetchArticle(Request $request){
        $ids = $request->input('ids');
        $special = Specialmeta::where('post_id',$ids)->first();
        if ($special){
            $post = Post::where('post.id',$ids)
                ->join('meta','meta.post_id','=','post.id')
                ->join('specialmeta','specialmeta.post_id','=','post.id')
                ->select('post.*','meta.cate_id','specialmeta.special_id')
                ->first();
        }else{
            $post = Post::where('post.id',$ids)
                ->join('meta','meta.post_id','=','post.id')
                ->select('post.*','meta.cate_id')
                ->first();
        }
        $post_special = Post::where('post.id',$ids)->join('specialmeta','specialmeta.post_id','=','post.id')->select('specialmeta.special_id')->get();
        $post_s = [];
        foreach ($post_special as $p){
            $post_s[]=$p->special_id;
        }
        return response()->json(['status'=>200,'data'=>$post,'specials'=>$post_s],200);
    }

    public function deleteListPost(Request $request){
        $ids = $request->input('allId');
        foreach ($ids as $s){
            $post = Post::where('id',$s['id'])->delete();
            $Meat = Meat::where('post_id',$s['id'])->delete();
            $post_meta = Postmeta::where('post_id',$s['id'])->delete();
            $post_special = Specialmeta::where('post_id',$s['id'])->delete();
            $post_comment = Comment::where('post_id',$s['id'])->delete();
            $collect = Collect::where('post_id',$s['id'])->delete();
        }
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchuser(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $user = User::orderBy('id','DESC')->forPage($page,$limits)->get();
        $count = User::count();
        return response()->json(['status'=>200,'data'=>$user,'count'=>$count],200);
    }

    public function SearchUserName(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $content = $request->input('content');
        $choose = $request->input('choose');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        if ($choose==1){
            $user =  User::where('id', 'like', '%' . $content . '%')
                ->orderBy('id', 'DESC')
                ->forPage($page, $limits)
                ->get();
            $count = User::where('id', 'like', '%' . $content . '%')
                ->count();
        }else if ($choose==2){
            $user =  User::where('name', 'like', '%' . $content . '%')
                ->orderBy('id', 'DESC')
                ->forPage($page, $limits)
                ->get();
            $count = User::where('name', 'like', '%' . $content . '%')
                ->count();
        }else if($choose==3){
            $user =  User::where('username', 'like', '%' . $content . '%')
                ->orderBy('id', 'DESC')
                ->forPage($page, $limits)
                ->get();
            $count = User::where('username', 'like', '%' . $content . '%')
                ->count();
        }else if($choose==4){
            $user =  User::where('email', 'like', '%' . $content . '%')
                ->orderBy('id', 'DESC')
                ->forPage($page, $limits)
                ->get();
            $count = User::where('email', 'like', '%' . $content . '%')
                ->count();
        }else{
            $user =  User::orderBy('id', 'DESC')
                ->forPage($page, $limits)
                ->get();
            $count = User::count();
        }

        return response()->json(['status'=>200,'data'=>$user,'counts'=>$count],200);
    }

    public function fetchDelUser(Request $request){
        $user_id = $request->input('id');
        $num = User::where('id',$user_id)->delete();
        $cates = Postmeta::where('user_id',$user_id)->delete();
        $sign = Sign::where('user_id',$user_id)->delete();
        $vip = VipMeat::where('user_id',$user_id)->delete();
        $Gigtmeta = Gigtmeta::where('user_id',$user_id)->delete();
        $Comment = Comment::where('user_id',$user_id)->delete();
        $Collect = Collect::where('user_id',$user_id)->delete();
        $sign = Sign::where('user_id',$user_id)->delete();
        $auth = Verify::where('user_id',$user_id)->delete();
        $auths = VerifyOrder::where('user_id',$user_id)->delete();
        $chats = Chat::where('to_id',$user_id)->orWhere('from_id',$user_id)->delete();
        if (!empty($num)){
            return response()->json(['status'=>200,'msg'=>'删除成功'],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'删除失败'],401);
        }
    }

    public function deleteListUser(Request $request){
        $user_id = $request->input('allId');
        foreach ($user_id as $s){
            $num = User::where('id',$s['id'])->delete();
            $cates = Postmeta::where('user_id',$s['id'])->delete();
            $sign = Sign::where('user_id',$s['id'])->delete();
            $vip = VipMeat::where('user_id',$s['id'])->delete();
            $Gigtmeta = Gigtmeta::where('user_id',$s['id'])->delete();
            $Comment = Comment::where('user_id',$s['id'])->delete();
            $Collect = Collect::where('user_id',$s['id'])->delete();
            $sign = Sign::where('user_id',$s['id'])->delete();
            $auth = Verify::where('user_id',$s['id'])->delete();
            $auths = VerifyOrder::where('user_id',$s['id'])->delete();
            $chats = Chat::where('to_id',$s['id'])->orWhere('from_id',$s['id'])->delete();
        }
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function upload_userpic(Request $request){
        $files = $request->file('file');
        $options = Options::where('option_name','api')->first();
        if($files->isValid()){
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

    public function fetchCreateUser(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $price = $request->input('price');
        $integral = $request->input('integral');
        $pic = $request->input('pic');
        $cx = User::where('username',$username)->first();
        if (!empty($cx)){
            return response()->json(['status'=>401,'msg'=>'账号已存在'],401);
        }
        if (empty($pic)){
            $defaults = Options::where('option_name','api')->first()->option_value;
            $pic =$defaults.'/app/default/pic.png';
        }
        User::create([
            'username'=>$username,
            'name'=> $name,
            'email'=>$email,
            'password'=>bcrypt($password),
            'phone'=>$phone,
            'balance'=>$price,
            'integral'=>$integral,
            'pic'=>$pic
        ]);
        return response()->json(['status'=>200,'msg'=>'创建成功'],200);
    }

    public function fetchUserId(Request $request){
        $id = $request->input('id');
        $userinfo = User::where('id',$id)->first();
        return response()->json(['status'=>200,'userinfo'=>$userinfo],200);
    }

    public function fetchUpdataUser(Request $request){
        $id = $request->input('id');
        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $price = $request->input('price');
        $integral = $request->input('integral');
        $pic = $request->input('pic');
        $cx = User::where('id',$id)->first();
        if (empty($cx)){
            return response()->json(['status'=>401,'msg'=>'未查询到该账号'],401);
        }
        if (empty($pic)){
            $defaults = Options::where('option_name','api')->first()->option_value;
            $pic =$defaults.'/app/default/pic.png';
        }
        $cx->name = $name;
        $cx->email = $email;
        $cx->phone = $phone;
        $cx->balance = $price;
        $cx->integral = $integral;
        $cx->pic = $pic;
        if (!empty($password)){
            $cx->password = bcrypt($password);
        }
        $cx->save();
        return response()->json(['status'=>200,'msg'=>'更新用户信息成功'],200);
    }


    public function fetchCate(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if (empty($page) || $limits){
            $cate = Top::orderBy('id','DESC')->get();
        }else{
            $cate = Top::orderBy('id','DESC')->forPage($page,$limits)->get();
        }
        $count = Top::count();
        return response()->json(['status'=>200,'data'=>$cate,'count'=>$count],200);
    }

    public function fetchDelCate(Request $request){
        $cate_id = $request->input('id');
        $num = Top::where('id',$cate_id)->first();
        $is_parent = Top::where('parent_id',$cate_id)->first();
        $is_post_bind = Meat::where('cate_id',$cate_id)->first();
        if (!empty($is_parent)){
            return response()->json(['status'=>401,'msg'=>'该分类为父级分类，请删除他的子分类'],401);
        }else if (!empty($is_post_bind)){
            return response()->json(['status'=>401,'msg'=>'该分类绑定了文章！'],401);
        }
        if (!empty($num)){
            $num = Top::where('id',$cate_id)->delete();
            return response()->json(['status'=>200,'msg'=>'删除成功'],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'删除失败'],401);
        }
    }

    public function fetchCreateCate(Request $request){
        $name = $request->input('name');
        $other = $request->input('other');
        $description = $request->input('description');
        $parent_id = $request->input('parent_id');
        $type = $request->input('type');
        $icon = $request->input('icon');
        $sel = Top::where('other',$other)->first();
        if (!empty($sel)){
            return response()->json(['status'=>401,'msg'=>'别名已存在'],401);
        }
        $tops = new Top();
        $tops->name = $name;
        $tops->other = $other;
        $tops->description = $description;
        $tops->parent_id  = $parent_id;
        $topmax = Top::max('order_id');
        $tops->order_id = $topmax+1;
        if (empty($type)){
            $tops->type = 1;
        }else{
            $tops->type = $type;
        }
        if (empty($icon)){
            $icon = "<i class='el-icon-delete'></i>";
        }else{
            $tops->icon=$icon;
        }
        $tops->save();
        return response()->json(['status'=>200,'msg'=>'创建成功'],200);
    }

    public function fetchCateId(Request $request){
        $id = $request->input('id');
        $cateinfo = Top::where('id',$id)->first();
        return response()->json(['status'=>200,'cateinfo'=>$cateinfo],200);
    }

    public function fetchUpdataCate(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $other = $request->input('other');
        $description = $request->input('description');
        $parent_id = $request->input('parent_id');
        $type = $request->input('type');
        $icon = $request->input('icon');
        $tops = Top::where('id',$id)->first();
        if (empty($tops)){
            return response()->json(['status'=>401,'msg'=>'更新失败，分类不存在'],401);
        }
        if ($tops->id == $parent_id){
            return response()->json(['status'=>401,'msg'=>'不得以当前分类作为父级分类'],401);
        }
        $tops->name = $name;
        $tops->other = $other;
        $tops->description = $description;
        if (empty($icon)){
            $icon = "<i class='el-icon-delete'></i>";
        }else{
            $tops->icon=$icon;
        }
        $tops->parent_id  = $parent_id;
        if (empty($type)){
            $tops->type = 1;
        }else{
            $tops->type = $type;
        }
        $tops->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }


}

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
use App\Models\Chat;
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
use App\Models\VipMeat;
use App\Models\Notice;
use App\Models\Helpcenter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\Verification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
class Cms extends Controller
{

    public function details_portal(Request $request)
    {
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $top = Top::where('other', $other)->first();
        if ($top == '') {
            return response()->json(['msg' => '没找到数据', 'status' => 401], 401);
        }
        $list = Top::with('allChildren')->where('other', $other)->first();
        if (!empty($list)) {
            $arr = [];
            $lists = $list->toArray();
            foreach ($lists['all_children'] as $item) {
                foreach ($item['all_children'] as $s) {
                    $arr[] = $s['id'];
                }
                $arr[] = $item['id'];
            }
        }
        $arr[] = $top->id;
        $content = Meat::with('postGet')
            ->whereIn('cate_id', $arr)
            ->with('category:id,name,other')
            ->join('post','post.id','=','meta.post_id')
            ->where('post.status',1)
            ->select('meta.*')
            ->forPage($page,$limits)
            ->orderBy("post.id", "desc")
            ->get();
        $childer_cate = Top::where('parent_id',$top->parent_id)->orderBy('id','ASC')->get();
        $childer_tags = [];
        foreach ($content as $c){
            if(json_decode($c->postGet[0]->tags)!=null){
                foreach (json_decode($c->postGet[0]->tags) as $s){
                    if(!empty($s)){
                        $childer_tags[] = $s;
                    }
                }
            }else{
                $childer_tags[]='';
            }

        }
        $number = Meat::with('goods')->whereIn('cate_id', $arr)->count();
        $hot_post_ban = Meat::with('goods')->whereIn('cate_id', $arr)->join('post','post.id','=','meta.post_id')->orderBy('post.view','desc')->limit(3)->get();
        
        return response()->json(['top' => $top, 'content' => $content, 'number' => $number,'children_cate'=>$childer_cate, 'children_tags'=>$childer_tags,'hot_post_banner'=>$hot_post_ban , 'status' => 200], 200);
    }

    public function details_portal_select(Request $request)
    {
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $types = $request->input('types');
        $top = Top::where('other', $other)->first();
        if ($top == '') {
            return response()->json(['msg' => '没找到数据', 'status' => 401], 401);
        }
        $list = Top::with('allChildren')->where('other', $other)->first();
        if (!empty($list)) {
            $arr = [];
            $lists = $list->toArray();
            foreach ($lists['all_children'] as $item) {
                foreach ($item['all_children'] as $s) {
                    $arr[] = $s['id'];
                }
                $arr[] = $item['id'];
            }
        }
        $arr[] = $top->id;
        if ($types == 'most') {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->orderBy("post.likes", "desc")
                ->forPage($page,$limits)
                ->get();
        } else if ($types == 'hot') {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->orderBy("post.view", "desc")
                ->forPage($page,$limits)
                ->get();
        } else {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
        }
        $number = Meat::with('goods')->whereIn('cate_id', $arr)->join('post','post.id','=','meta.post_id')->where('post.status',1)->count();
        return response()->json(['top' => $top, 'content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function details_portal_Vipselect(Request $request)
    {
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $types = $request->input('types');
        $top = Top::where('other', $other)->first();
        if ($top == '') {
            return response()->json(['msg' => '没找到数据', 'status' => 401], 401);
        }
        $list = Top::with('allChildren')->where('other', $other)->first();
        if (!empty($list)) {
            $arr = [];
            $lists = $list->toArray();
            foreach ($lists['all_children'] as $item) {
                foreach ($item['all_children'] as $s) {
                    $arr[] = $s['id'];
                }
                $arr[] = $item['id'];
            }
        }
        $arr[] = $top->id;
        if ($types == 'free') {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->where('post.price','=','')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();

            $number =  Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->where('post.price','=','')
                ->count();
        } else if ($types == 'money') {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->where('post.price','!=','')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->whereIn('cate_id', $arr)
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'vipFree') {
            $content =Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->where('post.vip_price','=','0')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->whereIn('cate_id', $arr)
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->where('post.vip_price','=','0')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'vipDiscount') {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->where('post.vip_price','!=','')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->whereIn('cate_id', $arr)
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->where('post.vip_price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else {
            $content = Meat::with('postGet')
                ->whereIn('cate_id', $arr)
                ->with('category:id,name,other')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->select('meta.*')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->whereIn('cate_id', $arr)
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.status',1)
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        }

        return response()->json(['top' => $top, 'content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function captcha()
    {
        return response()->json([
            'status' => '200',
            'message' => 'created succeed',
            'url' => app('captcha')->create('default', true)
        ]);
    }

    //首页轮播图
    public function banner()
    {
        $types = Options::where('option_name', 'banner_types')->first()->option_value;
        $banner = Banner::where('type', $types)->get();
        return response()->json(['banner_pic' => $banner, 'type' => $types, 'status' => 200], 200);
    }


    //获取底部信息
    public function bottominformation()
    {
        $friend =Friendly::get();
        $about = Options::where('option_name', 'about_us')->first()->option_value;
        $weibo = Options::where('option_name', 'weibo')->first()->option_value;
        $wechat = Options::where('option_name', 'wechat')->first()->option_value;
        $copyright = Options::where('option_name','copyright')->first()->option_value;
        $peoples = User::count();
        $sevice =Service::get(['id','title','types']);
        return response()->json(['friend' => $friend,'about'=>$about,'weibo'=>$weibo,'wechat'=>$wechat, 'sevice'=>$sevice,'copyright'=>$copyright,'peoples'=>$peoples,'status' => 200], 200);
    }
    //single网页
    public function single_page(Request $request)
    {
        $ids = $request->input('id');
        $sevice =Service::where('id',$ids)->first();
        return response()->json(['sevice' => $sevice,'status' => 200], 200);
    }


    //首页分类排序
    public function categorydesc()
    {
        $gory = Top::with('allChildren')->orderBy("order_id", "asc")->where('order_id','>',0)->get();
        if (!empty($gory)) {
            $arr = [];
            $arr_id=[];
            $lists = $gory->toArray();
            foreach ($lists as $item) {
                $arr_id[]=$item['id'];
                foreach($item['all_children'] as $s){
                        $arr_id[] = $s['id'];
                }
                $Design = Meat::with('goods')
                    ->whereIn('cate_id', $arr_id)
                    ->join('category','category.id','=','meta.cate_id')
                    ->join('post','post.id','=','meta.post_id')
                    ->join('user','user.id','=','post.author_id')
                    ->orderBy("meta.id", "desc")
                    ->where('post.status',1)
                    ->select('user.name as userInfo','user.pic','meta.*','category.name','category.id','category.other')
                    ->take(8)
                    ->get();
                $arr[] = $Design;
                $arr_id=[];
            }
        }
        return response()->json(['gory' => $gory, 'post'=>$arr,'status' => 200], 200);
    }

    public function getLayout(){
        $showlist = Layout::get();
        return response()->json(['status'=>200,'data'=>$showlist],200);
    }

    public function config(){
        $config = Options::where('option_name','!=','alipay_app_id')
            ->where('option_name','!=','ali_public_key')
            ->where('option_name','!=','alipay_private_key')
            ->where('option_name','!=','wechat_app_id')
            ->where('option_name','!=','wechat_mch_id')
            ->where('option_name','!=','wechat_key')
            ->where('option_name','!=','QQ_KEY')
            ->where('option_name','!=','QQ_SECRET')
            ->where('option_name','!=','QQ_REDIRECT_URI')
            ->where('option_name','!=','WEIXIN_KEY')
            ->where('option_name','!=','WEIXIN_SECRET')
            ->where('option_name','!=','WEIXIN_REDIRECT_URI')
            ->where('option_name','!=','WEIBO_KEY')
            ->where('option_name','!=','WEIBO_SECRET')
            ->where('option_name','!=','WEIBO_REDIRECT_URI')
            ->where('option_name','!=','MAIL_HOST')
            ->where('option_name','!=','MAIL_PORT')
            ->where('option_name','!=','MAIL_ENCRYPTION')
            ->where('option_name','!=','MAIL_USERNAME')
            ->where('option_name','!=','MAIL_PASSWORD')
            ->where('option_name','!=','MAIL_FROM_ADDRESS')
            ->where('option_name','!=','ALIYUN_ACCESS_ID')
            ->where('option_name','!=','ALIYUN_ACCESS_KEY')
            ->where('option_name','!=','ALIYUN_BUCKET')
            ->where('option_name','!=','ALIYUN_ENDPOINT')
            ->where('option_name','!=','ALIYUN_SSL')
            ->where('option_name','!=','QINIU_ACCESS_KEY')
            ->where('option_name','!=','QINIU_SECRET_KEY')
            ->where('option_name','!=','QINIU_BUCKET')
            ->where('option_name','!=','QINIU_DOMAIN')
            ->orderBy('option_id','ASC')
            ->get();
        return response()->json(['status'=>200,'data'=>$config],200);
    }

    public function search(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $other = $request->input('other');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $content = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.title','like','%'.$other.'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
            ->forPage($page,$limits)
            ->orderBy("post.id", "desc")
            ->get();
        $number = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.title','like','%'.$other.'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function search_page(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $other = $request->input('other');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $content = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.title','like','%'.$other.'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
            ->forPage($page,$limits)
            ->orderBy("post.id", "desc")
            ->get();
        $number = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.title','like','%'.$other.'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function search_select(Request $request)
    {
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $types = $request->input('types');
        if ($types == 'most') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.likes", "desc")
                ->get();
        } else if ($types == 'hot') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.view", "desc")
                ->get();
        } else {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.id", "desc")
                ->get();
        }
        $number = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.title','like','%'.$other.'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function search_Vipselect(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $types = $request->input('types');
        if ($types == 'free') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->where('post.price','=','')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.id", "desc")
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'money') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'vipFree') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','=','0')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','=','0')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'vipDiscount') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.title','like','%'.$other.'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        }
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }
    
    public function changeUnicode($other){
        $is_english = preg_match("/^[A-Za-z]+$/",$other);
        if($is_english){
            return $other;
        }else{
            return $other = addslashes($this->ascll_encode($other));
        }
    }

    public function tags(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $other = $request->input('other');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $content = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
            ->forPage($page,$limits)
            ->orderBy("post.id", "desc")
            ->get();
        $number = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    function ascll_encode($strLong) {
        $strArr = preg_split('/(?<!^)(?!$)/u', $strLong);//拆分字符串为数组(含中文字符)
        $resUnicode = '';
        foreach ($strArr as $str)
        {
            $bin_str = '';
            $arr = is_array($str) ? $str : str_split($str);//获取字符内部数组表示,此时$arr应类似array(228, 189, 160)
            foreach ($arr as $value)
            {
                $bin_str .= decbin(ord($value));//转成数字再转成二进制字符串,$bin_str应类似111001001011110110100000,如果是汉字"你"
            }
            $bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/', '$1$2$3', $bin_str);//正则截取, $bin_str应类似0100111101100000,如果是汉字"你"
            $unicode = dechex(bindec($bin_str));//返回unicode十六进制
            $_sup = '';
            for ($i = 0; $i < 4 - strlen($unicode); $i++)
            {
                $_sup .= '0';//补位高字节 0
            }
            $str =  '\\u' . $_sup . $unicode; //加上 \u  返回
            $resUnicode .= $str;
        }
        return $resUnicode;
    }

    public function tags_page(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $other = $request->input('other');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $content = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
            ->forPage($page,$limits)
            ->orderBy("post.id", "desc")
            ->get();
        $number = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function tags_select(Request $request)
    {
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $types = $request->input('types');
        if ($types == 'most') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.likes", "desc")
                ->get();
        } else if ($types == 'hot') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.view", "desc")
                ->get();
        } else {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.id", "desc")
                ->get();
        }
        $number = Meat::with('goods')
            ->join('category','category.id','=','meta.cate_id')
            ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function tags_Vipselect(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $other = $request->input('other');
        $types = $request->input('types');
        if ($types == 'free') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->where('post.price','=','')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->forPage($page,$limits)
                ->orderBy("post.id", "desc")
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'money') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'vipFree') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','=','0')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','=','0')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else if ($types == 'vipDiscount') {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->where('post.vip_price','!=','')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        } else {
            $content = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->select('user.name','user.pic','meta.*','category.name as catename','category.id as cateid')
                ->orderBy("post.id", "desc")
                ->forPage($page,$limits)
                ->get();
            $number = Meat::with('goods')
                ->join('category','category.id','=','meta.cate_id')
                ->where('post.tags','like','%'.$this->changeUnicode($other).'%')
                ->join('post', 'post.id', '=', 'meta.post_id')
                ->join('user', 'user.id', '=', 'post.author_id')
                ->count();
        }
        return response()->json(['content' => $content, 'number' => $number, 'status' => 200], 200);
    }

    public function getUserId(Request $request){
        $id = $request->input('id');
        $userInfo = User::where('id',$id)->select('id','pic','integral','description','created_at','name','gender','cover')->first();
        if (!empty($userInfo)){
            $fans = Postmeta::where('types','0')->where('author_id',$id)->count();
            $bfans = Postmeta::where('types','0')->where('user_id',$id)->count();
            return response()->json(['status'=>200,'userInfo'=>$userInfo,'fans'=>$fans,'bfans'=>$bfans],200);
        }else{
            return response()->json(['status'=>401,'msg'=>'未找到该用户信息！'],401);
        }
    }

    public function sub_chat_dialog(Request $request){
        $from_id = $request->input('from_id');
        $to_id = $request->input('to_id');
        $content = $request->input('content');
        $auth_is = auth('api')->user();
        if (empty($auth_is)){
            return response()->json(['status' => 401, 'msg' => '请先登录后发布私信内容！'], 200);
        }
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

    public function getUserPost(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $id = $request->input('id');
        $post = Post::where('post.author_id', $id)
            ->join('user','user.id','=','post.author_id')
            ->join('meta', 'meta.post_id', '=', 'post.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->select('post.id','post.title','post.vip_price','post.author_id','post.view','post.likes','post.create_time','post.cover', 'category.name', 'category.other','user.name as userInfo','user.pic')
            ->forPage($page,$limits)
            ->orderBy('post.id','DESC')
            ->get();
        $collect_post = Post::join('meta', 'meta.post_id', '=', 'post.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->join('collect','collect.post_id','=','post.id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name as userInfo','user.pic','post.author_id','post.create_time','post.id','post.likes','post.vip_price','post.title','post.view','post.cover', 'category.name', 'category.other')
            ->forPage($page,$limits)
            ->orderBy('post.id','DESC')
            ->get();
        $count = Post::where('post.author_id', $id)
            ->join('user','user.id','=','post.author_id')
            ->join('meta', 'meta.post_id', '=', 'post.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->count();
        $collect_count = Post::where('post.author_id', $id)
            ->join('meta', 'meta.post_id', '=', 'post.id')
            ->join('category', 'meta.cate_id', '=', 'category.id')
            ->join('collect','collect.post_id','=','post.id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->count();
        return response()->json(['status'=>200,'posts'=>$post,'collect'=>$collect_post,'count'=>$count,'collect_count'=>$collect_count],200);
    }

    public function getUserBfans(Request $request){
        $id = $request->input('id');
        $arr= [];
        $arrs= [];
        $bfans = Postmeta::where('user_id',$id)
            ->where('types',0)
            ->join('user','user.id','=','postmeta.author_id')
            ->select('user.id','user.name','user.pic')
            ->get();
        foreach ($bfans as $s){
            $bfans_fans = Postmeta::where('author_id',$s->id)
                ->where('types',0)
                ->join('user','user.id','=','postmeta.author_id')
                ->count();
            $arr[] = $bfans_fans;
        }

        $fans = Postmeta::where('author_id',$id)
            ->where('types',0)
            ->join('user','user.id','=','postmeta.user_id')
            ->select('user.id','user.name','user.pic')
            ->get();
        foreach ($fans as $s){
            $fans_fans = Postmeta::where('author_id',$s->id)
                ->where('types',0)
                ->join('user','user.id','=','postmeta.user_id')
                ->count();
            $arrs[] = $fans_fans;
        }
        return response()->json(['status'=>200,'bfans'=>$bfans,'bfans_fans'=>$arr,'fans'=>$fans,'fans_fans'=>$arrs],200);
    }

    public function getUserVerify(Request $request){
        $id = $request->input('id');
        $verify = Verify::where('user_id',$id)->first();
        return response(['status'=>200,'data'=>$verify],200);
    }

    public function follow_me(Request $request){
        $id = $request->input('id');
        $userid = $request->input('userid');
        $metas = Postmeta::where('user_id',$userid)->where('author_id',$id)->where('types',0)->first();
        if (empty($userid)){
            return response()->json(['status'=>201,'msg'=>'请先登录!'],201);
        }else if ($id==$userid){
            return response()->json(['status'=>201,'msg'=>'你不能关注你自己!'],201);
        }else if (!empty($metas)){
            $metas->delete();
            return response()->json(['status'=>200,'msg'=>'已取消关注!'],200);
        }else{
            $postmeta = new Postmeta();
            $postmeta->user_id = $userid;
            $postmeta->author_id = $id;
            $postmeta->types= 0;
            $postmeta->save();
            return response()->json(['status'=>200,'msg'=>'关注成功!'],200);
        }
    }

    public function isFollo(Request $request){
        $id = $request->input('id');
        $userid = $request->input('userid');
        $metas = Postmeta::where('user_id',$userid)->where('author_id',$id)->where('types',0)->first();
        if (!empty($metas)){
            return response()->json(['status'=>200,'is'=>'yes'],200);
        }else{
            return response()->json(['status'=>200,'is'=>'no'],200);
        }
    }

    public function coverIs(Request $request){
        $id = $request->input('id');
        $userid = $request->input('userid');

        if ($id==$userid){
            return response()->json(['status'=>200,'is'=>'yes'],200);
        }else{
            return response()->json(['status'=>200,'is'=>'no'],200);
        }
    }

    public function change_cover(Request $request){
        if ($request->isMethod('POST')) {
            $files = $request->file('file');
            if ($files->getClientOriginalExtension()=='png' || $files->getClientOriginalExtension()=='jpg' || $files->getClientOriginalExtension()=='ico') {
                // 判断文件是否上传成功
                if ($files->isValid()) {
                    $alioss = Options::where('option_name', 'oss')->first();
                    if ($alioss->option_value == 'alioss') {
                        $path = '/' . date("Ym/d", time());
                        $image_path = upload_image($path, $files);
                        $token = $request->cookie("auth__token_local");
                        $token = substr($token, 7);
                        if ($token){
                            $flight = User::where('api_token', $token)->first();
                            $flight->cover = $image_path;
                        }else{
                            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
                        }
                        $flight->save();
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $image_path], 'status' => 200], 200);
                    } else if ($alioss->option_value == 'qiniuoss') {
                        $path = '/' . date("Ym/d", time());
                        $image_path = upload_image($path, $files, 'qiniu');
                        $token = $request->header('Authorization');
                        $token = substr($token, 7);
                        if ($token){
                            $flight = User::where('api_token', $token)->first();
                            $flight->cover = $image_path;
                        }else{
                            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
                        }
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
                        if ($token){
                            $flight = User::where('api_token', $token)->first();
                            $flight->cover = $filepath;
                        }else{
                            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
                        }
                        $flight->save();
                        return response()->json(['msg' => '上传成功', 'files' => ['file' => $filepath], 'status' => 200], 200);
                    }
                    return response()->json(['msg' => '上传成功', 'files' => ['file' => $filepath], 'status' => 200], 200);
                }
            }else{
                return response()->json(['status' => 401, 'msg' => '上传失败,文件格式错误!'], 401);
            }
        }
    }

    public function special(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $special = Special::withCount("posts")->orderBy('id','DESC')->forPage($page,$limits)->get();
        $count = Special::count();
        return response()->json(['status'=>200,'special'=>$special,'count'=>$count]);
    }

    public function special_other(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=20;
        }
        $id = $request->input('id');
        $content = Specialmeta::join('special','specialmeta.special_id','=','special.id')
            ->where('special.other','=',$id)
            ->join('post', 'post.id', '=', 'specialmeta.post_id')
            ->join('meta', 'post.id', '=', 'meta.post_id')
            ->join('category', 'category.id', '=', 'meta.cate_id')
            ->join('user', 'user.id', '=', 'post.author_id')
            ->select('user.name as userinfo','user.pic','category.name','category.other','post.author_id','post.content','post.create_time','post.id','post.isvip_level','post.likes','post.price','post.show_url','post.title','post.view','post.vip_price','post.cover as postcover','special.name as spename','special.description','special.cover')
            ->forPage($page,$limits)
            ->orderBy("post.id", "desc")
            ->get();
        $special_detail = Special::where('other',$id)->first();
        $number = Specialmeta::with('posts')->count();
        return response()->json(['status'=>200,'special'=>$content,'count'=>$number,'special_detail'=>$special_detail],200);
    }

    public function send_email(Request $request){
        if ($email = $request->emails) {
            $code = substr(md5(mt_rand(1000, 9999)), 0, 6);
            $content = '你的邮件验证码为：' . $code;

            $key = 'email_forget_' . $request->emails;
            // 验证码
            Cache::put($key, $code, (new Carbon())->addMinutes(10));
            $email = $request->emails;
            Mail::send('emails.verification',[
                'content'=>$content,
            ],function($message) use ($email) {
                $message->subject('邮箱验证');
                $message->to($email);
            });
            return response()->json(['status' => 200, 'msg' => '验证码已发送邮箱'], 200);
        }
        return response()->json(['status' => 401, 'msg' => '发送失败'], 401);
    }

    public function reset_pass(Request $request){
        $emails = $request->input('emails');
        $pass = $request->input('pass');
        $email_code = $request->input('email_code');
        $get_user = User::where('email',$emails)->first();
        if (empty($get_user)){
            return response()->json(['status' => 401, 'msg' => '邮箱不存在'], 401);
        }
        $key = 'email_forget_' . $emails;
        // 验证码
        $code = Cache::get($key);
        if ($email_code == $code) {
            $get_user->password = bcrypt($pass);
            $get_user->save();
            return response()->json(['status' => 200, 'msg' => '重设密码成功！请使用新密码登录！']);
        }
        return response()->json(['status' => 401, 'msg' => '邮箱验证码错误！'], 401);
    }

    public function new_posts(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=8;
        }
        $post = Meat::with('postGet')
            ->with('category:id,name,other')
            ->join('post', 'post.id', '=', 'meta.post_id')
            ->select('meta.*')
            ->where('post.status',1)
            ->forPage($page,$limits)
            ->orderBy("id", "desc")
            ->get();
        if (sizeof($post)<1){
            $have_post = 'no';
        }else{
            $have_post = 'yes';
        }
        $hot = Post::orderBy('view')
            ->take(5)
            ->select(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','cover','vip_price','style_type'])
            ->get();
        $cate = Top::select('other','name')->get();
        return response()->json(['status' => 200, 'new_posts' => $post,'cate'=>$cate,'have_post'=>$have_post,'hot'=>$hot],200);
    }

    public function hot_post(){
        $hot = Post::orderBy('view')
            ->take(5)
            ->select(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','cover','vip_price','style_type'])
            ->get();
        return response()->json(['status' => 200,'hot'=>$hot], 200);

    }

    public function all_post_sitemap(Request $request){
        $posts = Post::select('id','title','create_time')->get();
        return response()->json(['status' => 200,'data'=>$posts], 200);
    }

    public function all_category_sitemap(Request $request){
        $cate = Top::select('id','name','other')->get();
        return response()->json(['status' => 200,'data'=>$cate], 200);
    }

    public function notice(Request $request)
    {
        $notice = Notice::orderBy("id", "desc")->get();
        $help = Helpcenter::orderBy("id", "desc")->get();
        return response()->json(['data' => $notice,'help'=>$help, 'status' => 200], 200);
    }
}

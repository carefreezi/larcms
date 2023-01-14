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

use App\Models\Collect;
use App\Models\Comment;
use App\Models\Meat;
use App\Models\Options;
use App\Models\Post;
use App\Models\Postmeta;
use App\Models\Postorders;
use App\Models\User;
use App\Models\Vip;
use App\Models\VipMeat;
use PhpOption\Option;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Top;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
class Details extends Controller{

    public function details_page(Request $request){

        $ids = $request->input('id');
        $token = $request->header('Authorization');
        $token = substr($token, 7);
        $flight = User::where('api_token', $token)->first();

        $post_vip = Post::where('id',$ids)->first();
        if (empty($post_vip)){
            return response()->json(['status' => 401,'msg'=>'无该文章信息'], 401);
        }
        if (!empty($post_vip->isvip_level)){
            $Design = Post::where('post.id',$ids)
                ->join('vip','post.isvip_level','=','vip.vip_level')
                ->where('post.status',1)
                ->first(['post.author_id','post.content','post.create_time','post.id','post.isvip_level','post.likes','post.price','post.integral','post.show_url','post.tags','post.title','post.view','post.cover','post.vip_price','post.style_type','vip.vip_name']);
                // $hide_content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view jz jc ys">此处内容需要评论回复后（审核通过）方可阅读</div>',$Design->content);
        }else{
            $Design = Post::where('id',$ids)
                ->where('status',1)
                ->first(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','vip_price','integral','cover','style_type']);
        }

        if (!empty($flight)){
            $state = Postorders::where('user_id',$flight->id)->where('post_id',$ids)->where('state',1)->first('state');
        }
        if (!empty($state)){
            $Design = Post::where('id',$ids)->where('status',1)->first(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','vip_price','integral','cover','style_type','download_url','extraction_code','extract_code']);
        }
        
        $Design->view+=1;
        $Design->save();
        $author_id = $Design->author_id;
        $author  = User::where('id',$author_id)->first(['name','pic','description','cover']);
        $hot = Post::orderBy('view')
            ->where('status',1)
            ->take(5)
            ->select(['author_id','content','create_time','id','isvip_level','likes','price','show_url','tags','title','view','cover','vip_price','style_type'])
            ->get();
        $comment = Comment::with('allChildren')
            ->where('parent_id','=',0)
            ->where('post_id',$ids)
            ->where('status',1)
            ->join('user','comment.user_id','=','user.id')
            ->select('comment.*','user.name as userinfo','user.pic')
            ->get();
        $cates = Meat::where('post_id',$ids)
            ->join('category','category.id','=','meta.cate_id')
            ->select('category.id','category.name','category.other')
            ->first();
        //摘要截取
        $content = preg_replace("@<script(.*?)</script>@is", "", $Design->content);
        $content = preg_replace("@<iframe(.*?)</iframe>@is", "", $content);
        $content = preg_replace("@<style(.*?)</style>@is", "", $content);
        $content = preg_replace("@<(.*?)>@is", "", $content);
        $content = str_replace(PHP_EOL, '', $content);
        $space = array(" ", "　", "  ", " ", " ");
        $go_away = array("", "", "", "", "");
        $content = str_replace($space, $go_away, $content);
        $res = mb_substr($content, 0, 100, 'UTF-8');
        if (mb_strlen($content, 'UTF-8') > 100) {
            $res = $res . "...";
        }
        return response()->json(['design' => $Design,'author'=>$author,'cates'=>$cates,'hot'=>$hot,'comment'=>$comment,'abstract'=>$res,'status' => 200], 200);
    }

    //判断是否是vip输出文章price
    public function isvip_price(Request $request){
        if ($request->isMethod('POST')){
            $vip_id = $request->input('vip_id');
            $post_id = $request->input('post_id');
            $vip = VipMeat::where('id',$vip_id)->first();
            $post  = Post::where('id',$post_id)->first();
            if ($vip){
                if ($vip->vip_status==1){
                    if ($vip->vip_level>=$post->isvip_level){
                        if ($post->vip_price==null){
                            return response()->json(['post_price'=>$post->price,'status' => 200]);
                        }
                        return response()->json(['post_price'=>$post->vip_price,'status' => 200]);
                    }
                }
            }else{
                return response()->json(['post_price'=>$post->price,'status' => 200]);
            }
            return response()->json(['post_price'=>$post->price,'status' => 200]);
        }
    }
    //判断文章是否被购买
    public function ispaypost(Request $request){
        if ($request->isMethod('POST')){
            $user_id = $request->input('user_id');
            $post_id = $request->input('post_id');
            $state = Postorders::where('user_id',$user_id)->where('post_id',$post_id)->where('state',1)->first('state');
            if (!empty($state)){
                return response()->json(['state'=>$state->state,'status' => 200]);
            }else{
                return response()->json(['state'=>0,'status' => 200]);
            }
        }
    }

    //文章点赞与关注
    public function likeinfor(Request $request){
        if ($request->isMethod('POST')){
            $user_id = $request->input('user_id');
            $post_id = $request->input('post_id');
            $author_id = $request->input('author_id');
            $types = $request->input('types');
            if ($types==0){
                $follow = Postmeta::where('user_id',$user_id)->where('author_id',$author_id)->first();
                if (!empty($follow)){
                    $follow->delete();
                    return response()->json(['status' => 200, 'msg' => '已取消关注']);
                }else if ($user_id == $author_id){
                    return response()->json(['status' => 200, 'msg' => '不能关注自己！'],200);
                }else{
                    $follows =new Postmeta();
                    $follows->user_id = $user_id;
                    $follows->author_id = $author_id;
                    $follows->types = $types;
                    $follows->save();
                    return response()->json(['status' => 200, 'msg' => '关注成功']);
                }
            }elseif ($types==1){
                $like = Postmeta::where('user_id',$user_id)->where('post_id',$post_id)->first();
                $post  = Post::where('id',$post_id)->first();
                if (!empty($like)){
                    $like->delete();
                    $post->likes-=1;
                    $post->save();
                    return response()->json(['status' => 200, 'msg' => '已取消点赞']);
                }else{
                    $follows =new Postmeta();
                    $follows->user_id = $user_id;
                    $follows->post_id = $post_id;
                    $follows->types = $types;
                    $follows->save();
                    $post->likes+=1;
                    $post->save();
                    return response()->json(['status' => 200, 'msg' => '点赞成功']);
                }
            }elseif ($types==2){
                $collect = Collect::where('post_id',$post_id)->where('user_id',$user_id)->first();
                if (!empty($collect)){
                    $collect->delete();
                    return response()->json(['status' => 200, 'msg' => '已取消收藏']);
                }else{
                    $collects =new Collect();
                    $collects->user_id = $user_id;
                    $collects->post_id = $post_id;
                    $collects->save();
                    return response()->json(['status' => 200, 'msg' => '收藏成功']);
                }
            }
        }
    }
    //文章交易订单
    public  function postordes(Request $request){
        $token = $request->header('Authorization');
        $token = substr($token, 7);
        if ($token){
            $flight = User::where('api_token', $token)->first();
        }else{
            return response()->json(['status'=>200,'msg'=>'无token，请重新登录','post'=>''],200);
        }
        $page = $request->input('page');
        $limits = $request->input('limit');
        if ($page==''||$limits==''){
            $page = 1;
            $limits=10;
        }
        $postorders = Postorders::where('user_id',$flight->id)->forPage($page,$limits)->orderBy('id','DESC')->get();
        $number =  Postorders::where('user_id',$flight->id)->count();
        return response()->json(['orders' => $postorders, 'count' => $number, 'status' => 200], 200);
    }

    //提交评论
    public function subComment(Request $request){
        $post_is_comment = Options::where('option_name','post_is_comment')->first()->option_value;
        $user_id = $request->input('id');
        $post_id = $request->input('post_id');
        $content = $request->input('contents');
        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->post_id = $post_id;
        $comment->content = $content;
        $comment->parent_id = 0;
        if ($post_is_comment=='yes'){
            $comment->status=0;
        }else{
            $comment->status=1;
        }
        $comment->create_time = date('Y-m-d H:i:s');
        $comment->save();
        if ($comment){
            if ($post_is_comment=='yes'){
                return response()->json(['status'=>200,'msg'=>'评论成功，等待审核！'],200);
            }else{
                return response()->json(['status'=>200,'msg'=>'评论成功！'],200);
            }
        }else{
            return response()->json(['status'=>401,'msg'=>'评论失败！'],401);
        }
    }

    //回复评论
    public function replyComment(Request $request){
        $post_is_comment = Options::where('option_name','post_is_comment')->first()->option_value;
        $parent_id = $request->input('parent_id');
        $user_id = $request->input('id');
        $post_id = $request->input('post_id');
        $content = $request->input('contents');
        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->post_id = $post_id;
        $comment->content = $content;
        $comment->parent_id = $parent_id;
        if ($post_is_comment=='yes'){
            $comment->status=0;
        }else{
            $comment->status=1;
        }
        $comment->create_time = date('Y-m-d H:i:s');
        $comment->save();
        if ($comment){
            if ($post_is_comment=='yes'){
                return response()->json(['status'=>200,'msg'=>'回复成功，等待审核！'],200);
            }else{
                return response()->json(['status'=>200,'msg'=>'回复成功！'],200);
            }
        }else{
            return response()->json(['status'=>401,'msg'=>'回复失败！'],401);
        }
    }

    public function detail_author(Request $request){
        $author = $request->input('author_id');
        $post = Post::where('author_id',$author)->count();
        $fans = Postmeta::where('types','0')->where('author_id',$author)->count();
        $bfans = Postmeta::where('types','0')->where('user_id',$author)->count();
        return response()->json(['status'=>200,'data'=>$post,'fans'=>$fans,'bfans'=>$bfans],200);
    }

    public function details_all_comment(Request $request){
        $ids = $request->input('id');
        $comment = Comment::where('post_id',$ids)
                ->join('user','user.id','=','comment.user_id')
                ->select('comment.*','user.name as userinfo','user.id as user_parent_id')
                ->get();
        return response()->json(['status'=>200,'data'=>$comment],200);
    }

}

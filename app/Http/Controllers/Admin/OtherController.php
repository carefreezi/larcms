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
use App\Models\Banner;
use App\Models\Chat;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Feedbackmeta;
use App\Models\Friendly;
use App\Models\Gift;
use App\Models\Helpcenter;
use App\Models\Layout;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Service;
use App\Models\Signmeta;
use App\Models\Special;
use App\Models\Specialmeta;
use App\Models\Topurl;
use App\Models\User;
use App\Models\Verify;
use App\Models\VerifyOrder;
use App\Models\Vip;
use App\Models\Withdrawal;
use App\Models\Vipquestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Postorders;
use App\Models\Options;
use App\Models\VipMeat;
use App\Models\Top;
use Illuminate\Support\Facades\Hash;
class OtherController extends Controller{

    public function fetchLink(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $links = Friendly::orderBy('id','DESC')->forPage($page,$limits)->get();
        $count = Friendly::count();
        return response()->json(['status'=>200,'data'=>$links,'count'=>$count],200);
    }

    public function fetchCreateLink(Request $request){
        $friends = new Friendly();
        $friends->name = $request->input('name');
        $friends->link = $request->input('link');
        $friends->save();
        return response()->json(['status'=>200,'msg'=>'创建成功'],200);
    }

    public function fetchDelLink(Request $request){
        $link_id = $request->input('id');
        $num = Friendly::where('id',$link_id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchLinkId(Request $request){
        $id = $request->input('id');
        $linkinfo = Friendly::where('id',$id)->first();
        return response()->json(['status'=>200,'Linkinfo'=>$linkinfo],200);
    }

    public function fetchUpdataLink(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $link = $request->input('link');
        $friend= Friendly::where('id',$id)->first();
        if (empty($friend)){
            return response()->json(['status'=>401,'msg'=>'更新失败，友链不存在'],401);
        }
        $friend->name = $name;
        $friend->link = $link;
        $friend->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchSign(){
        $signmeta = Signmeta::get();
        return response()->json(['status'=>200,'sign'=>$signmeta],200);
    }

    public function fetchSignBu(){
        $ops = Options::where('option_name','jifen_bu')->first()->option_value;
        return response()->json(['status'=>200,'signs'=>$ops],200);
    }

    public function fetchUpdataSign(Request $request){
        $signs = $request->input('signs');
        $jifen_bu = $request->input('jifen_bu');
        foreach ($signs as $s){
            $sign = Signmeta::where('id',$s['id'])->first();
            $sign->integral = $s['integral'];
            $sign->save();
        }
        $ops = Options::where('option_name','jifen_bu')->first();
        $ops->option_value = $jifen_bu;
        $ops->save();
        return response()->json(['status'=>200,'msg'=>'更新成功']);
    }

    public function fetchGift(){
        $giftmeta = Gift::get();
        return response()->json(['status'=>200,'gift'=>$giftmeta],200);
    }

    public function fetchUpdataGift(Request $request){
        $gifts = $request->input('gifts');
        foreach ($gifts as $s){
            $gift = Gift::where('id',$s['id'])->first();
            $gift->balance = $s['balance'];
            $gift->integral = $s['integral'];
            $gift->save();
        }
        return response()->json(['status'=>200,'msg'=>'更新成功']);
    }

    public function fetchVip(){
        $vips = Vip::get();
        return response()->json(['status'=>200,'vips'=>$vips],200);
    }

    public function fetchUpdataVip(Request $request){
        $vips = $request->input('query');
        $vip_levels = Vip::max('vip_level');
        foreach ($vips as $s){
            if (empty($s['id'])){
                $add_vip = new Vip();
                $add_vip->vip_name = $s['vip_name'];
                $add_vip->vip_level = $vip_levels+1;
                $add_vip->vip_price = $s['vip_price'];
                $add_vip->vip_day = $s['vip_day'];
                $add_vip->withdrawal = $s['withdrawal'];
                $add_vip->downloads = $s['downloads'];
                $add_vip->invitation = $s['invitation'];
                $add_vip->birthday = $s['birthday'];
                $add_vip->save();
            }else{
                $vip = Vip::where('id',$s['id'])->first();
                $vip->vip_name = $s['vip_name'];
                $vip->vip_level = $s['vip_level'];
                $vip->vip_price = $s['vip_price'];
                $vip->vip_day = $s['vip_day'];
                $vip->withdrawal = $s['withdrawal'];
                $vip->downloads = $s['downloads'];
                $vip->invitation = $s['invitation'];
                $vip->birthday = $s['birthday'];
                $vip->save();
            }
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchDelVip(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'已删除'],200);
        }
        $sel_vip = Vip::where('id', $id)->first();
        $is_vip_bind = VipMeat::where('vip_level', $sel_vip->vip_level)->first();
        if (!empty($is_vip_bind)){
            return response()->json(['status'=>401,'msg'=>'删除失败，已有用户绑定此VIP等级']);
        }else if (empty($sel_vip)){
            return response()->json(['status'=>401,'msg'=>'删除失败'],401);
        }else{
            $num = Vip::where('id',$id)->delete();
            return response()->json(['status'=>200,'msg'=>'删除成功'],200);
        }
    }

    public function fetchVipQs(){
        $vips = Vipquestion::get();
        return response()->json(['status'=>200,'vips'=>$vips],200);
    }

    public function fetchUpdataVipQs(Request $request){
        $vips = $request->input('query');
        foreach ($vips as $s){
            if (empty($s['id'])){
                $add_vip = new Vipquestion();
                $add_vip->title = $s['title'];
                $add_vip->description = $s['description'];
                $add_vip->save();
            }else{
                $vip = Vipquestion::where('id',$s['id'])->first();
                $vip->title = $s['title'];
                $vip->description = $s['description'];
                $vip->save();
            }
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchDelVipQs(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'已删除'],200);
        }
        $sel_vip = Vipquestion::where('id', $id)->first();
        if (empty($sel_vip)){
            return response()->json(['status'=>401,'msg'=>'删除失败'],401);
        }else{
            $num = Vipquestion::where('id',$id)->delete();
            return response()->json(['status'=>200,'msg'=>'删除成功'],200);
        }
    }

    public function fetchPostOrders(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $orders = Postorders::join('user','user.id','=','postorders.user_id')
            ->orderBy('id','DESC')
            ->forPage($page,$limits)
            ->select('postorders.*','user.name as userinfo')
            ->get();
        $count = Postorders::count();
        return response()->json(['status'=>200,'data'=>$orders,'count'=>$count],200);
    }

    public function fetchDelPosts(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'订单不存在'],200);
        }
        $num = Postorders::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }


    public function fetchOrders(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $orders = Order::join('user','user.id','=','order.user_id')
            ->orderBy('id','DESC')
            ->forPage($page,$limits)
            ->select('order.*','user.name as userinfo')
            ->get();
        $count = Order::count();
        return response()->json(['status'=>200,'data'=>$orders,'count'=>$count],200);
    }

    public function fetchDelOrders(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'订单不存在'],200);
        }
        $num = Order::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchAccounts(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $orders = Accounts::join('user','user.id','=','accounts.user_id')
            ->orderBy('id','DESC')
            ->forPage($page,$limits)
            ->select('accounts.*','user.name as userinfo')
            ->get();
        $count = Accounts::count();
        return response()->json(['status'=>200,'data'=>$orders,'count'=>$count],200);
    }

    public function fetchDelAccounts(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'订单不存在'],200);
        }
        $num = Accounts::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function addNotice(Request $request){
        $notice = new Notice();
        $notice->title = $request->input('title');
        $notice->content  = $request->input('content');
        $notice->state = 0;
        $notice->data = date('Y-m-d H:i:s');
        $notice->save();
        return response()->json(['status'=>200,'msg'=>'添加成功'],200);
    }

    public function fetchNotice(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $notice = Notice::
            orderBy('id','DESC')
            ->forPage($page,$limits)
            ->get();
        $count = Notice::count();
        return response()->json(['status'=>200,'data'=>$notice,'count'=>$count],200);
    }

    public function fetchDelNotice(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'公告不存在'],200);
        }
        $num = Notice::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchNoticeId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'公告不存在'],200);
        }
        $num = Notice::where('id',$id)->first();
        return response()->json(['status'=>200,'data'=>$num],200);
    }

    public function updataNotice(Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'公告不存在'],200);
        }
        $notice = Notice::where('id',$id)->first();
        $notice->title = $title;
        $notice->content = $content;
        $notice->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function addMessage(Request $request){
        $message = new Message();
        $message->title = $request->input('title');
        $message->content  = $request->input('content');
        $message->user_id  = $request->input('user_id');
        $message->state = 0;
        $message->data = date('Y-m-d H:i:s');
        $message->save();
        return response()->json(['status'=>200,'msg'=>'添加成功'],200);
    }

    public function fetchMessage(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $message = Message::
            join('user','user.id','=','message.user_id')
            ->orderBy('id','DESC')
            ->forPage($page,$limits)
            ->select('message.*','user.name as username')
            ->get();
        $count = Message::count();
        return response()->json(['status'=>200,'data'=>$message,'count'=>$count],200);
    }

    public function fetchDelMessage(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'信息不存在'],200);
        }
        $num = Message::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchMessageId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'信息不存在'],200);
        }
        $num = Message::where('id',$id)->first();
        return response()->json(['status'=>200,'data'=>$num],200);
    }

    public function updataMessage(Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');
        $user_id = $request->input('user_id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'信息不存在'],200);
        }
        $message = Message::where('id',$id)->first();
        $message->title = $title;
        $message->content = $content;
        $message->user_id = $user_id;
        $message->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function addHelp(Request $request){
        $help = new Helpcenter();
        $help->title = $request->input('title');
        $help->content  = $request->input('content');
        $help->save();
        return response()->json(['status'=>200,'msg'=>'添加成功'],200);
    }

    public function fetchHelp(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $help = Helpcenter::
            orderBy('id','DESC')
            ->forPage($page,$limits)
            ->get();
        $count = Message::count();
        return response()->json(['status'=>200,'data'=>$help,'count'=>$count],200);
    }

    public function fetchDelHelp(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'信息不存在'],200);
        }
        $num = Helpcenter::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchHelpId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'帮助不存在'],200);
        }
        $num = Helpcenter::where('id',$id)->first();
        return response()->json(['status'=>200,'data'=>$num],200);
    }

    public function updataHelp(Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'帮助不存在'],200);
        }
        $notice = Helpcenter::where('id',$id)->first();
        $notice->title = $title;
        $notice->content = $content;
        $notice->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchFeed(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $feed = Feedback::
            join('user','user.id','=','feedback.user_id')
            ->join('feedbackmeta','feedbackmeta.id','=','feedback.types')
            ->orderBy('id','DESC')
            ->forPage($page,$limits)
            ->select('feedback.*','user.name as username','feedbackmeta.question_types as qsname')
            ->get();
        $count = Feedback::count();
        return response()->json(['status'=>200,'data'=>$feed,'count'=>$count],200);
    }

    public function fetchDelFeed(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'反馈不存在'],200);
        }
        $num = Feedback::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchFeedId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'反馈不存在'],200);
        }
        $feed = Feedback::
            where('feedback.id',$id)
            ->join('user','user.id','=','feedback.user_id')
            ->join('feedbackmeta','feedbackmeta.id','=','feedback.types')
            ->select('feedback.*','user.name as username','feedbackmeta.question_types as qsname')
            ->first();
        return response()->json(['status'=>200,'data'=>$feed],200);
    }

    public function createFoot(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');
        $type_id = $request->input('type_id');
        $service = new Service();
        $service->title = $title;
        $service->content = $content;
        $service->types = $type_id;
        $service->save();
        return response()->json(['status'=>200,'msg'=>'创建成功'],200);
    }

    public function fetchFoot(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $feed = Service::
            orderBy('id','DESC')
            ->forPage($page,$limits)
            ->get();
        $count = Service::count();
        return response()->json(['status'=>200,'data'=>$feed,'count'=>$count],200);
    }

    public function fetchDelFoot(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'模块信息不存在'],200);
        }
        $num = Service::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchFootId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'底部信息不存在'],200);
        }
        $foot = Service::where('id',$id)->first();
        return response()->json(['status'=>200,'data'=>$foot],200);
    }

    public function updataFoot(Request $request){
        $id = $request->input('id');
        $title = $request->input('title');
        $content = $request->input('content');
        $type_id = $request->input('type_id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'底部信息不存在'],200);
        }
        $foot = Service::where('id',$id)->first();
        $foot->title = $title;
        $foot->content = $content;
        $foot->types = $type_id;
        $foot->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchWithdrawal(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $feed = Withdrawal::
        orderBy('id','DESC')
            ->forPage($page,$limits)
            ->get();
        $count = Withdrawal::count();
        return response()->json(['status'=>200,'data'=>$feed,'count'=>$count],200);
    }

    public function acceptWithdrawal(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'提现记录不存在'],200);
        }
        $withdrawal = Withdrawal::where('id',$id)->first();
        $withdrawal->state = 1;
        $withdrawal->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function refuseWithdrawal(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'提现记录不存在'],200);
        }
        $withdrawal = Withdrawal::where('id',$id)->first();
        $withdrawal->state = 2;
        $withdrawal->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function delsWithdrawal(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'提现记录不存在'],200);
        }
        $withdrawal = Withdrawal::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchBanner(Request $request){
        $br_type = $request->input('banner_type');
        $banners = Banner::where('type',$br_type)->get();
        return response()->json(['status'=>200,'data'=>$banners],200);
    }

    public function fetchDelBanner(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'轮播图不存在'],401);
        }
        $banners = Banner::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchUpdataBanner(Request $request){
        $banners = $request->input('banners');
        foreach ($banners as $s){
            if (empty($s['id'])){
                $add_banner= new Banner();
                $add_banner->title = $s['title'];
                $add_banner->pic = $s['pic'];
                $add_banner->type = $s['type'];
                $add_banner->title_color = $s['title_color'];
                $add_banner->title_size = $s['title_size'];
                $add_banner->link = $s['link'];
                $add_banner->target = '_blank';
                $add_banner->save();
            }else{
                $banner = Banner::where('id',$s['id'])->first();
                $banner->title = $s['title'];
                $banner->pic = $s['pic'];
                $banner->type = $s['type'];
                $banner->title_color = $s['title_color'];
                $banner->title_size = $s['title_size'];
                $banner->link = $s['link'];
                $banner->target = '_blank';
                $banner->save();
            }
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchCateOrid(){
        $cates = Top::orderBy('order_id','DESC')->get();
        return response()->json(['status'=>200,'data'=>$cates],200);
    }

    public function UpdataCates(Request $request){
        $cates = $request->input('cates');
        foreach ($cates as $s){
            if ($s['order_id']<0 || $s['order_id']===NULL){
                return response()->json(['status'=>401,'msg'=>'数据不得为空'],200);
            }
                $cate = Top::where('id',$s['id'])->first();
                $cate->order_id = $s['order_id'];
                $cate->save();
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchLayout(){
        $hidelist = Layout::where('is_show',0)->get();
        $showlist = Layout::where('is_show',1)->orderBy('order_id','DESC')->get();
        return response()->json(['status'=>200,'hidelist'=>$hidelist,'showlist'=>$showlist],200);
    }

    public function fetchUpLayout(Request $request){
        $hidelist = $request->input('hidelist');
        $showlist = $request->input('showlist');
        $i=1;
        foreach ($hidelist as $s){
            if (!empty($s['id'])){
                $banner = Layout::where('id',$s['id'])->first();
                $banner->title = $s['title'];
                $banner->order_id = 0;
                $banner->is_show = 0;
                $banner->save();
            }
        }
        foreach ($showlist as $s){

            if (!empty($s['id'])){
                $banner = Layout::where('id',$s['id'])->first();
                $banner->title = $s['title'];
                $banner->order_id = $i;
                $banner->is_show = 1;
                $banner->save();
            }
            $i++;
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function resetPassword(Request $request){
        $password = $request->input('password');
        $tpassword = $request->input('tpassword');
        $trpassword = $request->input('trpassword');
        $token = $request->input('token');
        $admins = Admin::where('api_token',$token)->first();
        $check_pass = Hash::check($password,$admins->password);
        if ($check_pass==false){
            return response()->json(['status'=>401,'msg'=>'原密码错误'],401);
        }else if ($tpassword!=$trpassword){
            return response()->json(['status'=>401,'msg'=>'两次密码不一致'],401);
        }else{
            $admins->password = bcrypt($tpassword);
            $admins->save();
            return response()->json(['status'=>200,'msg'=>'修改成功'],200);
        }
    }

    public function fetchTopurl(){
        $Topurl = Topurl::get();
        return response()->json(['status'=>200,'topurl'=>$Topurl],200);
    }

    public function fetchUpdataTopurl(Request $request){
        $vips = $request->input('query');
        foreach ($vips as $s){
            if (empty($s['id'])){
                $add_top = new Topurl();
                $add_top->title = $s['title'];
                $add_top->url = $s['url'];
                $add_top->save();
            }else{
                $add_tops = Topurl::where('id',$s['id'])->first();
                $add_tops->title = $s['title'];
                $add_tops->url = $s['url'];
                $add_tops->save();
            }
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchDelTopurl(Request $request)
    {
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'已删除'],200);
        }
        $sel_vip = Topurl::where('id', $id)->first();
        if (empty($sel_vip)){
            return response()->json(['status'=>401,'msg'=>'删除失败'],401);
        }else{
            $num = Topurl::where('id',$id)->delete();
            return response()->json(['status'=>200,'msg'=>'删除成功'],200);
        }
    }

    public function fetchComment(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $comment = Comment::with('allChildren')
            //->where('parent_id','=',0)
            ->join('post','post.id','=','comment.post_id')
            ->join('user','comment.user_id','=','user.id')
            ->forPage($page,$limits)
            ->select('post.id','post.title','comment.*','user.name as userinfo','user.pic')
            ->get();
        $count = Comment::count();
        $locals = Options::where('option_name','localhost')->first()->option_value;
        return response()->json(['status'=>200,'data'=>$comment,'count'=>$count,'locals'=>$locals],200);
    }

    public function fetchCommentId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'评论不存在'],401);
        }
        $num = Comment::where('id',$id)->first();
        return response()->json(['status'=>200,'data'=>$num],200);
    }

    public function PassCommentId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'评论不存在'],401);
        }
        $num = Comment::where('id',$id)->first();
        $num->status=1;
        $num->save();
        return response()->json(['status'=>200,'data'=>'审核成功'],200);
    }

    public function FailCommentId(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'评论不存在'],401);
        }
        $num = Comment::where('id',$id)->first();
        $num->status=2;
        $num->save();
        return response()->json(['status'=>200,'msg'=>'审核不通过'],200);
    }

    public function deleteListComment(Request $request){
        $ids = $request->input('allId');
        foreach ($ids as $s){
            $comment = Comment::where('id',$s['id'])->delete();
            $comment_parent = Comment::where('parent_id',$s['id'])->delete();
        }
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchDelComment(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'评论不存在'],401);
        }
        $num = Comment::where('id',$id)->delete();
        $comment_parent = Comment::where('parent_id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchCreateSpecial(Request $request){
        $name = $request->input('name');
        $other = $request->input('other');
        $description = $request->input('description');
        $cover = $request->input('cover');
        $special = new Special();
        $special->name = $name;
        $special->other = $other;
        $special->description = $description;
        $special->cover = $cover;
        $special->save();
        return response()->json(['status'=>200,'msg'=>'新增成功！'],200);
    }

    public function fetchSpecial(Request $request){
        $special = Special::get();
        $specials = Special::count();
        return response()->json(['status'=>200,'data'=>$special,'count'=>$specials],200);
    }

    public function fetchDelSpe(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'专题不存在'],401);
        }
        $num = Special::where('id',$id)->delete();
        $spe = Specialmeta::where('special_id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchSpeId(Request $request){
        $id = $request->input('id');
        $spe = Special::where('id',$id)->first();
        if (empty($spe)){
            return response()->json(['status'=>401,'msg'=>'查找不到该专题！'],401);
        }
        return response()->json(['status'=>200,'data'=>$spe],200);
    }

    public function fetchUpdataSpe(Request $request){
        $id = $request->input('id');
        $name = $request->input('name');
        $other = $request->input('other');
        $description = $request->input('description');
        $cover = $request->input('cover');
        if (empty($id)){
            return response()->json(['status'=>401,'msg'=>'专题不存在'],401);
        }
        $special = Special::where('id',$id)->first();
        $special->name = $name;
        $special->other = $other;
        $special->description = $description;
        $special->cover = $cover;
        $special->save();
        return response()->json(['status'=>200,'msg'=>'更新成功！'],200);
    }

    public function fetchFeedMeta(){
        $Feedbackmeta = Feedbackmeta::orderBy('id','DESC')->get();
        return response()->json(['status'=>200,'feed'=>$Feedbackmeta],200);
    }


    public function fetchUpFeedMeta(Request $request){
        $feeds = $request->input('feeds');
        foreach ($feeds as $s){
            if (empty($s['id'])){
                $add_feed = new Feedbackmeta();
                $add_feed->question_types = $s['question_types'];
                $add_feed->save();
            }else{
                $feedback = Feedbackmeta::where('id',$s['id'])->first();
                $feedback->question_types = $s['question_types'];
                $feedback->save();
            }
        }
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function fetchDelFeeds(Request $request){
        $feed_id = $request->input('ids');
        $num = Feedbackmeta::where('id',$feed_id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchVerify(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $feed = VerifyOrder::join('user','user.id','=','auth_order.user_id')->select('auth_order.*','user.name')->orderBy('auth_order.id','DESC')->forPage($page,$limits)->get();
        $count = VerifyOrder::count();
        return response()->json(['status'=>200,'data'=>$feed,'count'=>$count],200);
    }

    public function acceptVerify(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'认证付费记录不存在'],200);
        }
        $Verify = VerifyOrder::where('id',$id)->first();
        $Verify->state = 1;
        $Verify->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function refuseVerify(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'认证付费记录不存在'],200);
        }
        $Verify = VerifyOrder::where('id',$id)->first();
        $Verify->state = 2;
        $Verify->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function delsVerify(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'认证付费记录不存在'],200);
        }
        $Verify = VerifyOrder::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function fetchAuthUser(Request $request){
        $page = $request->input('page');
        $limits = $request->input('limit');
        $feed = Verify::join('user','user.id','=','auth.user_id')->select('auth.*','user.name')->orderBy('auth.id','DESC')->forPage($page,$limits)->get();
        $count = Verify::count();
        return response()->json(['status'=>200,'data'=>$feed,'count'=>$count],200);
    }

    public function acceptAuthUser(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'用户认证记录不存在'],200);
        }
        $Verify = Verify::where('id',$id)->first();
        $Verify->state = 1;
        $Verify->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function refuseAuthUser(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'用户认证记录不存在'],200);
        }
        $Verify = Verify::where('id',$id)->first();
        $Verify->state = 2;
        $Verify->save();
        return response()->json(['status'=>200,'msg'=>'更新成功'],200);
    }

    public function delsAuthUser(Request $request){
        $id = $request->input('id');
        if (empty($id)){
            return response()->json(['status'=>200,'msg'=>'用户认证记录不存在'],200);
        }
        $Verify = Verify::where('id',$id)->delete();
        return response()->json(['status'=>200,'msg'=>'删除成功'],200);
    }

    public function getChats(Request $request){
        $chat_group = Chat::where('group_id', 0)
            ->select('content', 'created_at', 'id','to_id','from_id')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $chat_result=[];
        foreach($chat_group as $c){
            $user=User::where('id',$c->to_id)->Orwhere('id',$c->from_id)->select('id','name','pic')->get();
            $chat_result[]=array('chat_id'=>$c->id,'created_at'=>$c->created_at->format('Y-m-d H:i:s'),$user);
        }
        return response()->json(['status' => 200,'data'=>$chat_result], 200);
    }

    public function getPointChat(Request $request){
        $ids = $request->input('id');
        $chat_group = Chat::with('chats')
            ->where('chat.group_id', $ids)
            ->Orwhere('chat.id','=',$ids)
            ->join('user', 'user.id', '=', 'chat.to_id')
            ->select('chat.*','user.name','user.pic','user.id as user_id')
            ->orderBy('updated_at', 'DESC')
            ->get();
        return response()->json(['status' => 200, 'data' => $chat_group], 200);
    }

    public function delPointChat(Request $request){
        $ids = $request->input('id');
        $chat_is = Chat::where('id',$ids)->first();
        if ($chat_is){
                $chat=Chat::where('id',$ids)->delete();
                $chat_group = Chat::where('group_id',$ids)->delete();
                return response()->json(['status'=>200,'msg'=>'删除成功!']);
        }else{
            return response()->json(['status'=>200,'msg'=>'未找到该私信记录!'],200);
        }
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'], function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'api'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
Route::group(['middleware' => 'jwt.api.auth'], function () {
    //个人中心
    Route::any('setphone', ['uses' => 'Member@setphone']);
    Route::any('setemail', ['uses' => 'Member@setemail']);
    Route::any('setuser', ['uses' => 'Member@setuser']);
    Route::any('setpassword', ['uses' => 'Member@setpassword']);
    Route::any('userVip', ['uses' => 'Member@userVip']);
    Route::any('usertable', ['uses' => 'Member@usertable']);
    Route::any('usertables', ['uses' => 'Member@usertables']);
    Route::post('sendEmailCode','Member@sendEmailCode');
    Route::post('subComment','Details@subComment');
    Route::post('replyComment','Details@replyComment');

    //余额充值
    Route::any('Cashwithdrawal', ['uses' => 'Member@Cashwithdrawal']);
    //转账
    Route::any('transfer_accounts', ['uses' => 'Member@transfer_accounts']);
    //余额充值vip
    Route::any('payByBlance', ['uses' => 'PayController@payByBlance']);
    //文章支付
    Route::any('post_payment', ['uses' => 'PayController@post_payment']);
    //判断是否是vip并输出文章价格
    Route::any('isvip_price', ['uses' => 'Details@isvip_price']);
    //判断文章是否被购买
    Route::any('ispaypost', ['uses' => 'Details@ispaypost']);
    //文章点赞和关注
    Route::any('likeinfor', ['uses' => 'Details@likeinfor']);
    //获取文章交易记录
    Route::any('postordes', ['uses' => 'Details@postordes']);
    //判断是否关注
    Route::any('isfollow', ['uses' => 'Member@isfollow']);
    //获取消息记录
    Route::any('messagetable', ['uses' => 'Member@messagetable']);
    //获取未读消息
    Route::any('nomessages', ['uses' => 'Member@nomessages']);
    //点击阅读
    Route::any('readmessage', ['uses' => 'Member@readmessage']);
    //意见反馈——问题类型
    Route::any('Question_type', ['uses' => 'Member@Question_type']);
    //上传图片
    Route::any('upload', ['uses' => 'Member@upload']);
    //提交问题反馈
    Route::any('upQuestion', ['uses' => 'Member@upQuestion']);
    //上传用户头像
    Route::any('upuser_pic', ['uses' => 'Member@upuser_pic']);
    //获取用户头像
    Route::any('getuserpic', ['uses' => 'Member@getuserpic']);
    //用户签到
    Route::any('user_sign', ['uses' => 'Member@user_sign']);
    //获取用户签到
    Route::any('get_user_sign', ['uses' => 'Member@get_user_sign']);
    //用户补签
    Route::any('signature', ['uses' => 'Member@signature']);
    //礼物领取
    Route::any('collectgifts', ['uses' => 'Member@collectgifts']);
    //获取礼物表
    Route::any('gifttable', ['uses' => 'Member@gifttable']);
    //获取排行榜
    Route::any('Attendance_list', ['uses' => 'Member@Attendance_list']);
    //获取用户文章
    Route::any('userpost', ['uses' => 'Member@userpost']);
    Route::any('usercollect', ['uses' => 'Member@usercollect']);
    //获取帮助中心
    Route::any('Help_center', ['uses' => 'Member@Help_center']);

    Route::get('get_verify_auth','AuthorizationsController@get_verify_auth');
    Route::get('get_verify_auth_is','AuthorizationsController@get_verify_auth_is');
    Route::post('verify_auth','AuthorizationsController@verify_auth');
    Route::post('verify_auth_money','AuthorizationsController@verify_auth_money');
    Route::post('get_cate','WriteController@get_cate');
    Route::post('get_vip','WriteController@get_vip');
    Route::post('get_special','WriteController@get_special');
    Route::post('post_upload','WriteController@post_upload');
    Route::post('create_article','WriteController@create_article');
    Route::post('get_vip_info','WriteController@get_vip_info');
    Route::post('fetch_edit_post','WriteController@fetch_edit_post');
    Route::post('update_article','WriteController@update_article');
    Route::post('is_writer','WriteController@is_writer');
    Route::get('get_vipqs','Member@get_vipqs');
    Route::get('get_money_info','Member@get_money_info');
    Route::post('get_user_avatar','Member@get_user_avatar');
    Route::post('update_user_invitation','Member@update_user_invitation');
    Route::post('birthday_get','Member@birthday_get');
    //chat online
    Route::post('get_user_chat','Member@get_user_chat');
     Route::post('get_connect_chat','Member@get_connect_chat');
    Route::post('sub_chat_info','Member@sub_chat_info');
    Route::post('sub_user_dialog','Member@sub_user_dialog');
    Route::post('get_chatUser','Member@get_chatUser');
    Route::post('delete_point_chat','Member@delete_point_chat');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout');
    Route::post('refresh', 'LoginController@refresh');
    Route::post('me', 'LoginController@me')->middleware(['jwt.role:admin'])->name('me');
    //后台文章
    Route::get('portal','PortalController@portal')->middleware(['jwt.role:admin'])->name('portal');
    Route::get('list','PortalController@list')->middleware(['jwt.role:admin'])->name('list');
    Route::get('list_two','PortalController@list_two')->middleware(['jwt.role:admin'])->name('list_two');
    Route::post('PassPostId','PortalController@PassPostId')->middleware(['jwt.role:admin'])->name('PassPostId');
    Route::post('FailPostId','PortalController@FailPostId')->middleware(['jwt.role:admin'])->name('FailPostId');
    Route::post('SelectCate','PortalController@SelectCate')->middleware(['jwt.role:admin'])->name('SelectCate');
    Route::post('SearchPost','PortalController@SearchPost')->middleware(['jwt.role:admin'])->name('SearchPost');
    Route::post('del_detail','PortalController@del_detail')->middleware(['jwt.role:admin'])->name('del_detail');
    Route::post('search_user','PortalController@search_user')->middleware(['jwt.role:admin'])->name('search_user');
    Route::post('create_post','PortalController@create_post')->middleware(['jwt.role:admin'])->name('create_post');
    Route::post('upload_img','PortalController@upload_img')->middleware(['jwt.role:admin'])->name('upload_img');
    Route::post('get_cate','PortalController@get_cate')->middleware(['jwt.role:admin'])->name('get_cate');
    Route::post('get_vip','PortalController@get_vip')->middleware(['jwt.role:admin'])->name('get_vip');
    Route::post('get_special','PortalController@get_special')->middleware(['jwt.role:admin'])->name('get_special');
    Route::post('get_author','PortalController@get_author')->middleware(['jwt.role:admin'])->name('get_author');
    Route::post('fetchArticle','PortalController@fetchArticle')->middleware(['jwt.role:admin'])->name('fetchArticle');
    Route::post('update_post','PortalController@update_post')->middleware(['jwt.role:admin'])->name('update_post');
    Route::post('deleteListPost','PortalController@deleteListPost')->middleware(['jwt.role:admin'])->name('deleteListPost');
    //后台文章结束
    //后台用户
    Route::get('fetchuser','PortalController@fetchuser')->middleware(['jwt.role:admin'])->name('fetchuser');
    Route::post('fetchDelUser','PortalController@fetchDelUser')->middleware(['jwt.role:admin'])->name('fetchDelUser');
    Route::post('SearchUserName','PortalController@SearchUserName')->middleware(['jwt.role:admin'])->name('SearchUserName');
    Route::post('upload_userpic','PortalController@upload_userpic')->middleware(['jwt.role:admin'])->name('upload_userpic');
    Route::post('fetchCreateUser','PortalController@fetchCreateUser')->middleware(['jwt.role:admin'])->name('fetchCreateUser');
    Route::post('fetchUpdataUser','PortalController@fetchUpdataUser')->middleware(['jwt.role:admin'])->name('fetchUpdataUser');
    Route::post('fetchUserId','PortalController@fetchUserId')->middleware(['jwt.role:admin'])->name('fetchUserId');
    Route::post('deleteListUser','PortalController@deleteListUser')->middleware(['jwt.role:admin'])->name('deleteListUser');
    //后台用户结束
    //后台分类
    Route::get('fetchCate','PortalController@fetchCate')->middleware(['jwt.role:admin'])->name('fetchCate');
    Route::post('fetchDelCate','PortalController@fetchDelCate')->middleware(['jwt.role:admin'])->name('fetchDelCate');
    Route::post('fetchCreateCate','PortalController@fetchCreateCate')->middleware(['jwt.role:admin'])->name('fetchCreateCate');
    Route::post('fetchCateId','PortalController@fetchCateId')->middleware(['jwt.role:admin'])->name('fetchCateId');
    Route::post('fetchUpdataCate','PortalController@fetchUpdataCate')->middleware(['jwt.role:admin'])->name('fetchUpdataCate');
    //后台分类结束
    //后台友情链接
    Route::get('fetchLink','OtherController@fetchLink')->middleware(['jwt.role:admin'])->name('fetchLink');
    Route::post('fetchCreateLink','OtherController@fetchCreateLink')->middleware(['jwt.role:admin'])->name('fetchCreateLink');
    Route::post('fetchDelLink','OtherController@fetchDelLink')->middleware(['jwt.role:admin'])->name('fetchDelLink');
    Route::post('fetchLinkId','OtherController@fetchLinkId')->middleware(['jwt.role:admin'])->name('fetchLinkId');
    Route::post('fetchUpdataLink','OtherController@fetchUpdataLink')->middleware(['jwt.role:admin'])->name('fetchUpdataLink');
    //后台友情链接结束
    //会员中心开始
    Route::get('fetchSign','OtherController@fetchSign')->middleware(['jwt.role:admin'])->name('fetchSign');
    Route::get('fetchSignBu','OtherController@fetchSignBu')->middleware(['jwt.role:admin'])->name('fetchSignBu');
    Route::post('fetchUpdataSign','OtherController@fetchUpdataSign')->middleware(['jwt.role:admin'])->name('fetchUpdataSign');
    Route::get('fetchGift','OtherController@fetchGift')->middleware(['jwt.role:admin'])->name('fetchGift');
    Route::post('fetchUpdataGift','OtherController@fetchUpdataGift')->middleware(['jwt.role:admin'])->name('fetchUpdataGift');
    Route::get('fetchVip','OtherController@fetchVip')->middleware(['jwt.role:admin'])->name('fetchVip');
    Route::post('fetchUpdataVip','OtherController@fetchUpdataVip')->middleware(['jwt.role:admin'])->name('fetchUpdataVip');
    Route::post('fetchDelVip','OtherController@fetchDelVip')->middleware(['jwt.role:admin'])->name('fetchDelVip');
    Route::get('fetchVipQs','OtherController@fetchVipQs')->middleware(['jwt.role:admin'])->name('fetchVipQs');
    Route::post('fetchUpdataVipQs','OtherController@fetchUpdataVipQs')->middleware(['jwt.role:admin'])->name('fetchUpdataVipQs');
    Route::post('fetchDelVipQs','OtherController@fetchDelVipQs')->middleware(['jwt.role:admin'])->name('fetchDelVipQs');
    //会员中心结束
    //订单中心
    Route::get('fetchPostOrders','OtherController@fetchPostOrders')->middleware(['jwt.role:admin'])->name('fetchPostOrders');
    Route::post('fetchDelPosts','OtherController@fetchDelPosts')->middleware(['jwt.role:admin'])->name('fetchDelPosts');
    Route::get('fetchOrders','OtherController@fetchOrders')->middleware(['jwt.role:admin'])->name('fetchOrders');
    Route::post('fetchDelOrders','OtherController@fetchDelOrders')->middleware(['jwt.role:admin'])->name('fetchDelOrders');
    Route::get('fetchAccounts','OtherController@fetchAccounts')->middleware(['jwt.role:admin'])->name('fetchAccounts');
    Route::post('fetchDelAccounts','OtherController@fetchDelAccounts')->middleware(['jwt.role:admin'])->name('fetchDelAccounts');
    //订单中心结束
    //资讯中心
    Route::post('addNotice','OtherController@addNotice')->middleware(['jwt.role:admin'])->name('addNotice');
    Route::get('fetchNotice','OtherController@fetchNotice')->middleware(['jwt.role:admin'])->name('fetchNotice');
    Route::post('fetchDelNotice','OtherController@fetchDelNotice')->middleware(['jwt.role:admin'])->name('fetchDelNotice');
    Route::post('fetchNoticeId','OtherController@fetchNoticeId')->middleware(['jwt.role:admin'])->name('fetchNoticeId');
    Route::post('updataNotice','OtherController@updataNotice')->middleware(['jwt.role:admin'])->name('updataNotice');
    Route::post('addMessage','OtherController@addMessage')->middleware(['jwt.role:admin'])->name('addMessage');
    Route::get('fetchMessage','OtherController@fetchMessage')->middleware(['jwt.role:admin'])->name('fetchMessage');
    Route::post('fetchDelMessage','OtherController@fetchDelMessage')->middleware(['jwt.role:admin'])->name('fetchDelMessage');
    Route::post('fetchMessageId','OtherController@fetchMessageId')->middleware(['jwt.role:admin'])->name('fetchMessageId');
    Route::post('updataMessage','OtherController@updataMessage')->middleware(['jwt.role:admin'])->name('updataMessage');
    Route::post('addHelp','OtherController@addHelp')->middleware(['jwt.role:admin'])->name('addHelp');
    Route::get('fetchHelp','OtherController@fetchHelp')->middleware(['jwt.role:admin'])->name('fetchHelp');
    Route::post('fetchDelHelp','OtherController@fetchDelHelp')->middleware(['jwt.role:admin'])->name('fetchDelHelp');
    Route::post('fetchHelpId','OtherController@fetchHelpId')->middleware(['jwt.role:admin'])->name('fetchHelpId');
    Route::post('updataHelp','OtherController@updataHelp')->middleware(['jwt.role:admin'])->name('updataHelp');
    Route::get('fetchFeed','OtherController@fetchFeed')->middleware(['jwt.role:admin'])->name('fetchFeed');
    Route::post('fetchDelFeed','OtherController@fetchDelFeed')->middleware(['jwt.role:admin'])->name('fetchDelFeed');
    Route::post('fetchFeedId','OtherController@fetchFeedId')->middleware(['jwt.role:admin'])->name('fetchFeedId');
    Route::get('fetchComment','OtherController@fetchComment')->middleware(['jwt.role:admin'])->name('fetchComment');
    Route::post('fetchDelComment','OtherController@fetchDelComment')->middleware(['jwt.role:admin'])->name('fetchDelComment');
    Route::post('fetchCommentId','OtherController@fetchCommentId')->middleware(['jwt.role:admin'])->name('fetchCommentId');
    Route::post('PassCommentId','OtherController@PassCommentId')->middleware(['jwt.role:admin'])->name('PassCommentId');
    Route::post('FailCommentId','OtherController@FailCommentId')->middleware(['jwt.role:admin'])->name('FailCommentId');
    Route::post('deleteListComment','OtherController@deleteListComment')->middleware(['jwt.role:admin'])->name('deleteListComment');

    //资讯中心
    //全局配置
    Route::get('fetchOptions','OptionsController@fetchOptions')->middleware(['jwt.role:admin'])->name('fetchOptions');
    Route::post('fetchOptionsUp','OptionsController@fetchOptionsUp')->middleware(['jwt.role:admin'])->name('fetchOptionsUp');
    //网页模块
    Route::post('createFoot','OtherController@createFoot')->middleware(['jwt.role:admin'])->name('createFoot');
    Route::get('fetchFoot','OtherController@fetchFoot')->middleware(['jwt.role:admin'])->name('fetchFoot');
    Route::post('fetchDelFoot','OtherController@fetchDelFoot')->middleware(['jwt.role:admin'])->name('fetchDelFoot');
    Route::post('fetchFootId','OtherController@fetchFootId')->middleware(['jwt.role:admin'])->name('fetchFootId');
    Route::post('updataFoot','OtherController@updataFoot')->middleware(['jwt.role:admin'])->name('updataFoot');
    Route::get('fetchWithdrawal','OtherController@fetchWithdrawal')->middleware(['jwt.role:admin'])->name('fetchWithdrawal');
    Route::post('acceptWithdrawal','OtherController@acceptWithdrawal')->middleware(['jwt.role:admin'])->name('acceptWithdrawal');
    Route::post('refuseWithdrawal','OtherController@refuseWithdrawal')->middleware(['jwt.role:admin'])->name('refuseWithdrawal');
    Route::post('delsWithdrawal','OtherController@delsWithdrawal')->middleware(['jwt.role:admin'])->name('delsWithdrawal');
    Route::get('fetchBanner','OtherController@fetchBanner')->middleware(['jwt.role:admin'])->name('fetchBanner');
    Route::post('fetchDelBanner','OtherController@fetchDelBanner')->middleware(['jwt.role:admin'])->name('fetchDelBanner');
    Route::post('fetchUpdataBanner','OtherController@fetchUpdataBanner')->middleware(['jwt.role:admin'])->name('fetchUpdataBanner');
    Route::get('fetchCateOrid','OtherController@fetchCateOrid')->middleware(['jwt.role:admin'])->name('fetchCateOrid');
    Route::post('UpdataCates','OtherController@UpdataCates')->middleware(['jwt.role:admin'])->name('UpdataCates');
    Route::get('fetchLayout','OtherController@fetchLayout')->middleware(['jwt.role:admin'])->name('fetchLayout');
    Route::post('fetchUpLayout','OtherController@fetchUpLayout')->middleware(['jwt.role:admin'])->name('fetchUpLayout');
    Route::get('fetchTopurl','OtherController@fetchTopurl')->middleware(['jwt.role:admin'])->name('fetchTopurl');
    Route::post('fetchUpdataTopurl','OtherController@fetchUpdataTopurl')->middleware(['jwt.role:admin'])->name('fetchUpdataTopurl');
    Route::post('fetchDelTopurl','OtherController@fetchDelTopurl')->middleware(['jwt.role:admin'])->name('fetchDelTopurl');
    Route::post('fetchCreateSpecial','OtherController@fetchCreateSpecial')->middleware(['jwt.role:admin'])->name('fetchCreateSpecial');
    Route::get('fetchSpecial','OtherController@fetchSpecial')->middleware(['jwt.role:admin'])->name('fetchSpecial');
    Route::post('fetchDelSpe','OtherController@fetchDelSpe')->middleware(['jwt.role:admin'])->name('fetchDelSpe');
    Route::post('fetchSpeId','OtherController@fetchSpeId')->middleware(['jwt.role:admin'])->name('fetchSpeId');
    Route::post('fetchUpdataSpe','OtherController@fetchUpdataSpe')->middleware(['jwt.role:admin'])->name('fetchUpdataSpe');
    Route::get('fetchFeedMeta','OtherController@fetchFeedMeta')->middleware(['jwt.role:admin'])->name('fetchFeedMeta');
    Route::post('fetchUpFeedMeta','OtherController@fetchUpFeedMeta')->middleware(['jwt.role:admin'])->name('fetchUpFeedMeta');
    Route::post('fetchDelFeeds','OtherController@fetchDelFeeds')->middleware(['jwt.role:admin'])->name('fetchDelFeeds');
    Route::get('fetchVerify','OtherController@fetchVerify')->middleware(['jwt.role:admin'])->name('fetchVerify');
    Route::post('acceptVerify','OtherController@acceptVerify')->middleware(['jwt.role:admin'])->name('acceptVerify');
    Route::post('refuseVerify','OtherController@refuseVerify')->middleware(['jwt.role:admin'])->name('refuseVerify');
    Route::post('delsVerify','OtherController@delsVerify')->middleware(['jwt.role:admin'])->name('delsVerify');
    Route::get('fetchAuthUser','OtherController@fetchAuthUser')->middleware(['jwt.role:admin'])->name('fetchAuthUser');
    Route::post('acceptAuthUser','OtherController@acceptAuthUser')->middleware(['jwt.role:admin'])->name('acceptAuthUser');
    Route::post('refuseAuthUser','OtherController@refuseAuthUser')->middleware(['jwt.role:admin'])->name('refuseAuthUser');
    Route::post('delsAuthUser','OtherController@delsAuthUser')->middleware(['jwt.role:admin'])->name('delsAuthUser');
    //私信
    Route::post('getChats','OtherController@getChats')->middleware(['jwt.role:admin'])->name('getChats');
    Route::post('getPointChat','OtherController@getPointChat')->middleware(['jwt.role:admin'])->name('getPointChat');
    Route::post('delPointChat','OtherController@delPointChat')->middleware(['jwt.role:admin'])->name('delPointChat');
    //管理员权限
    Route::post('resetPassword','OtherController@resetPassword')->middleware(['jwt.role:admin'])->name('resetPassword');
    //管理员权限结束
});
Route::get('alipay/return', 'PayController@alipayReturn')->name('pay.alipay.return');
Route::post('alipay/notify', 'PayController@alipayNotify')->name('pay.alipay.notify');
//微信支付
Route::post('wechat/notify', 'PayController@wechatNotify')->name('pay.wechat.notify');
Route::get('yzf_notify_url', 'PayController@yzfNotify')->name('pay.yzf.notify');
Route::get('yzf_return_url', 'PayController@yzfReturn')->name('pay.yzf.notify');

//首页
Route::any('headGet', ['uses' => 'Header@headGet']);
Route::any('topUrl', ['uses' => 'Header@topUrl']);
Route::any('captcha', ['uses' => 'Cms@captcha']);
Route::any('portal', ['uses' => 'Cms@portal']);
Route::any('details_portal', ['uses' => 'Cms@details_portal']);
Route::any('details_portal_select', ['uses' => 'Cms@details_portal_select']);
Route::any('details_portal_Vipselect', ['uses' => 'Cms@details_portal_Vipselect']);
Route::get('new_posts', ['uses' => 'Cms@new_posts']);
Route::get('hot_post', ['uses' => 'Cms@hot_post']);
Route::get('all_post_sitemap', ['uses' => 'Cms@all_post_sitemap']);
Route::get('all_category_sitemap', ['uses' => 'Cms@all_category_sitemap']);

//轮播图
Route::any('banner', ['uses' => 'Cms@banner']);
//首页分类排序
Route::any('categorydesc', ['uses' => 'Cms@categorydesc']);
//轮播图
Route::post('getLayout','Cms@getLayout');
Route::post('config','Cms@config');
Route::any('bottominformation', ['uses' => 'Cms@bottominformation']);
//single
Route::any('single_page', ['uses' => 'Cms@single_page']);
//文章页
Route::any('details_page', ['uses' => 'Details@details_page']);
Route::post('detail_author','Details@detail_author');

//搜索
Route::get('search', ['uses' => 'Cms@search']);
Route::get('search_page', ['uses' => 'Cms@search_page']);
Route::get('search_select', ['uses' => 'Cms@search_select']);
Route::get('search_Vipselect', ['uses' => 'Cms@search_Vipselect']);
//标签
Route::get('tags', ['uses' => 'Cms@tags']);
Route::get('tags_page', ['uses' => 'Cms@tags_page']);
Route::get('tags_select', ['uses' => 'Cms@tags_select']);
Route::get('tags_Vipselect', ['uses' => 'Cms@tags_Vipselect']);
Route::get('getUserId', ['uses' => 'Cms@getUserId']);
Route::post('sub_chat_dialog', ['uses' => 'Cms@sub_chat_dialog']);
Route::get('getUserPost', ['uses' => 'Cms@getUserPost']);
Route::get('getUserBfans', ['uses' => 'Cms@getUserBfans']);
Route::get('getUserVerify',['uses'=>'Cms@getUserVerify']);
Route::post('follow_me', ['uses' => 'Cms@follow_me']);
Route::get('isFollo', ['uses' => 'Cms@isFollo']);
Route::get('coverIs', ['uses' => 'Cms@coverIs']);
Route::post('change_cover', ['uses' => 'Cms@change_cover']);
Route::get('special', ['uses' => 'Cms@special']);
Route::get('special_other', ['uses' => 'Cms@special_other']);
Route::post('send_email', ['uses' => 'Cms@send_email']);
Route::post('reset_pass', ['uses' => 'Cms@reset_pass']);
Route::get('details_all_comment', 'Details@details_all_comment');

//第三方登录
Route::post('socials/{social_type}/authorizations', ['uses' => 'AuthorizationsController@socialStore']); // 第三方登录
// QQ登录
Route::get('qq', 'AuthorizationsController@qq');
// QQ回调
Route::get('qq_callback', 'AuthorizationsController@qq_callback');

// 微信登录
Route::get('weixin', 'AuthorizationsController@weixin');
// 微信回调
Route::get('weixin_callback', 'AuthorizationsController@weixin_callback');

// 微博登录
Route::get('weibo', 'AuthorizationsController@weibo');
// 微博回调
Route::get('weibo_callback', 'AuthorizationsController@weibo_callback');

//支付宝支付
Route::get('alipay', 'PayController@payByAlipay')->name('pay.alipay');
//微信支付
Route::get('wechat', 'PayController@payByWechat')->name('pay.wechat');

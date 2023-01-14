<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset("/static/frame/bootstrap-4.4.1-dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("/static/frame/icon/iconfont.css")}}">
    <link rel="stylesheet" href="{{asset("/static/frame/toastr/toastr.min.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/public.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/public.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/member.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/left.css")}}">
    <link rel="stylesheet" href="{{asset("/static/frame/swiper5.3.6/css/swiper.min.css")}}">
    <link rel="stylesheet" href="{{asset("/static/frame/share/css/share.min.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/index.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/datepicker.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/music_details.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/design_details.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/video_details.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/code.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/design.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/music.css")}}">
    <link rel="stylesheet" href="{{asset("/static/index/css/video.css")}}">
    <script src="{{asset("/static/frame/js/vue.js")}}"></script>
    <script src="{{asset("/static/frame/axios/axios.min.js")}}"></script>
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{asset('/static/frame/elementui/element.css')}}">
    <!-- 引入组件库 -->
    <script src="{{asset('/static/frame/elementui/element_js.js')}}"></script>
    <!-- App css -->
</head>
<body>
@section('header')
<header>
    <div class="main fontcolor">
        <div class="meunlist clearfix">
            <div class="logo" title="回到主页">
                <a href="/">
                    <img src="/static/Test/logo.png" class="logoi"
                         alt="">
                </a>
            </div>
            <!-- <div class="logo" title="回到主页">
                 <a href="/">
                     <img src="/static/Test/logo.gif" class="logoi"
                          alt="">
                 </a>
             </div>-->
            <div class="meun">
                <ul class="clearfix">
                    <!--<li><a href="/" class="{$action_name=='index' ? 'active' : ''}">首页</a></li>-->
                    <li><a href="/code" class="{$action_name=='code' ? 'active' : ''}">源码下载</a></li>
                    <li><a href="/design" class="{$action_name=='design' ? 'active' : ''}">设计</a></li>
                    <li><a href="/video" class="{$action_name=='video' ? 'active' : ''}">视频</a></li>
                    <li><a href="/music" class="{$action_name=='music' ? 'active' : ''}">音频</a></li>
                    <li class="child-list">
                        <a href="">软件 <i class="iconfont icon-xiala"></i></a>
                        <dl>
                            <dd><a href="">MacOS</a></dd>
                            <dd><a href="">破解版</a></dd>
                            <dd><a href="">系统工具</a></dd>
                            <dd><a href="">图形设计</a></dd>
                        </dl>
                    </li>
                    <li class="child-list">
                        <a href="">专题 <i class="iconfont icon-xiala"></i></a>
                        <dl>
                            <dd><a href="">专题：第一期</a></dd>
                            <dd><a href="">专题：第二期</a></dd>
                            <dd><a href="">专题：第三期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四期</a></dd>
                            <dd><a href="">专题：第四2期</a></dd>
                        </dl>
                    </li>
                    <li><a href="">文章·资讯</a></li>
                </ul>
            </div>
            <div>
                <form action="" method="post">

                    <div class="formsearch">
                        <div class="input-group">
                            <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="iconfont icon-sousuo"></i>
                        </span>
                            </div>
                            <input type="text" name="keywords" class="form-control iinputres" placeholder="在这里寻找你想要的资源"
                                   aria-label="Username"
                                   aria-describedby="basic-addon1">
                        </div>
                        <div class="tipsvip">
                            <a href="" target="_blank"> <i class="iconfont icon-VIP vipfit"></i> 会员低至3折,立即购买</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="userBox">
                <!--<div class="noLoginBox">
                    <span>登录</span> | <span>注册</span>
                </div>-->
                <div class="isLoginbox child-list">
                    <div class="userBoxImagesG clearfix">
                        <a href="">
                            <div class="userpicT">
                                <img src="https://pic.xiami.net/images/album/img38/97438/5366591465290955.jpg?x-oss-process=image/resize,limit_0,m_fill,s_390/quality,q_80"
                                     alt="" class="userI">
                                <span class="vipi"><i class="iconfont icon-vip-crown--fill"></i></span>
                            </div>
                            <div class="boxUserDesc">
                                <div class="text-hd user-h-nick">
                                    <span title="一只小仓鼠两只小仓鼠"> 一只小仓鼠两只小仓鼠</span>
                                </div>
                                <div class="accutMS">
                                    <!-- <span>
                                        <svg class="iconsvg" aria-hidden="true">
                                            <use xlink:href="#icon-qq"></use>
                                         </svg>
                                         腾讯QQ登录
                                     </span>-->
                                    <!--<span>
                                       <svg class="iconsvg" aria-hidden="true">
                                           <use xlink:href="#icon-weixin1"></use>
                                        </svg>
                                        微信用户
                                    </span>
                                    <span>
                                       <svg class="iconsvg" aria-hidden="true">
                                           <use xlink:href="#icon-weibo"></use>
                                        </svg>
                                        微博用户
                                    </span>-->
                                    <span>
                                       <svg class="iconsvg" aria-hidden="true">
                                           <use xlink:href="#icon-iconzhengli_shouji"></use>
                                        </svg>
                                        186****1234
                                    </span>
                                </div>

                            </div>
                            <div>
                                <i class="iconfont icon-xiala"></i>
                            </div>
                        </a>
                        <div class="loginOutBtn">
                            退出登录
                        </div>
                    </div>
                    <dl>
                        <dd>
                            <div class="vipMS">
                                <span class="vipi"><i class="iconfont icon-vip-crown--fill"></i></span> 会员： 2021-03-12 到期
                            </div>
                        </dd>
                        <dd>
                            <a href="/person">个人中心</a>
                        </dd>
                        <dd>
                            <a href="">安全中心</a>
                        </dd>
                    </dl>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@show

@yield('content')

@section('footer')
<footer>
    <div class="footerTop">
        <div class="main">
            <div class="row d-flex justify-content-between">
                <div class="col-4">
                    <div class="tit-footer">
                        关于我们
                    </div>
                    <div class="desc-footer">
                        我们是一个牛逼到炸天的团队，我们打造了中国最牛逼最具性价比的资源下载CMS。我们是一个牛逼到炸天的团队，我们打造了中国最牛逼最具性价比的资源下载CMS。我们是一个牛逼到炸天的团队，我们打造了中国最牛逼最具性价比的资源下载CMS。
                    </div>
                </div>
                <div class="col-1">
                    <div class="tit-footer">
                        网站协议
                    </div>
                    <div class="desc-footer">
                        <div><a href="" target="_blank">用户协议</a></div>
                        <div><a href="" target="_blank">会员协议</a></div>
                        <div><a href="" target="_blank">版权说明</a></div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="tit-footer">
                        支持服务
                    </div>
                    <div class="desc-footer">
                        <div><a href="" target="_blank">联系我们</a></div>
                        <div><a href="" target="_blank">广告投放</a></div>
                        <div><a href="" target="_blank">作者入驻</a></div>
                        <div><a href="" target="_blank">意见反馈</a></div>
                        <div><a href="" target="_blank">投稿说明</a></div>
                    </div>
                </div>
                <div class="col-1">
                    <div class="tit-footer">
                        热门推荐
                    </div>
                    <div class="desc-footer">
                        <div><a href="" target="_blank">站长推荐</a></div>
                        <div><a href="" target="_blank">免费资源</a></div>
                        <div><a href="" target="_blank">资源专题</a></div>
                        <div><a href="" target="_blank">精品资源</a></div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="footerIocnbox clearfix">
                        <div>
                            <div>
                                <i class="iconfont icon-weibo-copy wbi"></i>
                            </div>
                            资源微博
                        </div>
                        <div>
                            <div>
                                <i class="iconfont icon-weixin wxi"></i>
                            </div>
                            资源微信
                        </div>
                    </div>
                    <div class="vippeorbox">
                        <div>
                            优秀会员
                        </div>
                        <div class="vipcountbox">
                            <span class="vipcount timer" data-to="286742" data-speed="1500">286742</span><span>人</span>
                        </div>
                    </div>

                    <div class="qunjion">
                        <div class="tipsqqmsg">
                            官方交流：
                        </div>
                        <div class="dropdown joingroup">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                点击加入QQ群
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="https://jq.qq.com/?_wv=1027&k=5eXu4Q8" target="_blank">官方一群：19374221</a>
                                <a class="dropdown-item" href="https://jq.qq.com/?_wv=1027&k=5eXu4Q8" target="_blank">官方二群：19374222</a>
                                <a class="dropdown-item" href="https://jq.qq.com/?_wv=1027&k=5eXu4Q8" target="_blank">官方三群：19374223</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footerBottom">
        <div class="main">
            <div class="fLink">
                友情链接:
                <span><a href="" target="_blank">百度</a></span><span><a href="" target="_blank">腾讯</a></span><span><a
                        href="" target="_blank">阿里云</a></span><span><a href="" target="_blank">千图网</a></span><span><a
                        href="" target="_blank">千库网</a></span>
                <span><a href="" target="_blank">百度</a></span><span><a href="" target="_blank">腾讯</a></span><span><a
                        href="" target="_blank">阿里云</a></span><span><a href="" target="_blank">千图网</a></span><span><a
                        href="" target="_blank">千库网</a></span>
                <span><a href="" target="_blank">百度</a></span><span><a href="" target="_blank">腾讯</a></span><span><a
                        href="" target="_blank">阿里云</a></span><span><a href="" target="_blank">千图网</a></span><span><a
                        href="" target="_blank">千库网</a></span>
            </div>
            <div class="Copyright">
                Copyright © 2015-2020 资源下载CMS. All rights reserved. 南天门ICP备18069271号-1
            </div>
        </div>
    </div>
</footer>
@show
<script src="{{asset("/static/frame/js/jquery3.4.1.slim.min.js")}}"></script>
<script src="{{asset("/static/frame/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("/static/frame/icon/iconfont.js")}}"></script>
<script src="{{asset("/static/frame/layer/layer.js")}}"></script>
<script src="{{asset("/static/frame/toastr/toastr.js")}}"></script>
<script src="{{asset("/static/frame/numbercount/count.js")}}"></script>
<script src="{{asset("/static/index/scripts/public.js")}}"></script>
</body>
</html>

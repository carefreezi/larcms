@extends('public.public')
@section('content')

    <!--中部 start-->
    <div class="boxTop">
        <div class="main">
            <div class="row topshowbox">
                <div class="col-6">
                    <div class="ListTit">
                        视频资源 <span class="badge badge-pill badge-primary timer" data-to="12035">12035</span>
                    </div>
                    <div class="ListTitTips">
                        给我一张图，换你一套！为你的设计加分，升职加薪必备，大神光环加持！
                    </div>
                </div>
                <div class="col-6">
                    <div class="alert alert-secondary alert-dismissible fade show tipsTopImgbox" role="alert">
                        <div class="cover-img-center-max tipsTopImg">
                            <img src="/static/Test/c9bf8aba4945b31d4b2da26496b32f8b.jpg">
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row CheckBoxM">
                <div class="col-6">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            语言
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item">PHP</a>
                            <a class="dropdown-item">JAVA</a>
                            <a class="dropdown-item">Python</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            平台
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item">网页</a>
                            <a class="dropdown-item">APP</a>
                            <a class="dropdown-item">小程序</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            分类
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item">精选配乐</a>
                            <a class="dropdown-item">设计资源</a>
                            <a class="dropdown-item">外卖</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            标签
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item">WordPress</a>
                            <a class="dropdown-item">BootStrap</a>
                            <a class="dropdown-item">TP5</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="rankorderbox">
                        <span class="active">热门</span>
                        <span>精选</span>
                        <span>最新</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="main">
        <ul class="video-list clearfix">
            <li>

                <div class="video-gif-box" data-src="/video/96m888piCP82.mp4_10s.mp4">
                    <div class="cover-img-center-max video-voer-img">
                        <img src="/static/Test/a3b9a93147ff0cb2cc2ca66fbe3d34b2.png"
                             alt="">
                    </div>
                    <video loop="loop" id="video1{$i}"></video>
                    <div class="toolbar-desc">
                        <div class="tag-span-tool">
                            <span>AE模版</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-6 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-6 vip-desc">
                                <span class="vipi"><i class="iconfont icon-vip-crown--fill"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-tit">
                    <a href="/index/Details/video.html">抗击肺炎AE模板</a>
                </div>
            </li>
            <li>
                <div class="video-gif-box" data-src="/video/39E888piC3kc.mp4_10s.mp4">
                    <div class="cover-img-center-max video-voer-img">
                        <img src="/static/Test/a3b9a93147ff0cb2cc2ca66fbe3d34b2.png"
                             alt="">
                    </div>
                    <video loop="loop" id="video2{$i}"></video>
                    <div class="toolbar-desc">
                        <div class="tag-span-tool">
                            <span>AE模版</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-6 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-6 vip-desc">
                                <span class="disi"><i class="iconfont icon-yduizhekou"></i> <span
                                        class="dis-num">7折</span></span>
                                <span><span class="munsrcoe">125</span>积分</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-tit">
                    一米阳光写真AE模版
                </div>
            </li>

            <li>
                <div class="video-gif-box" data-src="/video/30j888piCkXy.mp4_10s.mp4">
                    <div class="cover-img-center-max video-voer-img">
                        <img src="/static/Test/a3b9a93147ff0cb2cc2ca66fbe3d34b2.png"
                             alt="">
                    </div>
                    <video loop="loop" id="video3{$i}"></video>
                    <div class="toolbar-desc">
                        <div class="tag-span-tool">
                            <span>AE模版</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-6 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-6 vip-desc">
                                <span><span class="munsrcoe">125</span>积分</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-tit">
                    一米阳光写真AE模版
                </div>
            </li>

            <li>
                <div class="video-gif-box" data-src="/video/83f888piCs9E.mp4_10s.mp4">
                    <div class="cover-img-center-max video-voer-img">
                        <img src="/static/Test/a3b9a93147ff0cb2cc2ca66fbe3d34b2.png"
                             alt="">
                    </div>
                    <video loop="loop" id="video4{$i}"></video>
                    <div class="toolbar-desc">
                        <div class="tag-span-tool">
                            <span>AE模版</span>
                            <span>10分钟前</span>
                        </div>
                        <div class="row desc-li">
                            <div class="col-6 cont-bar">
                                <span><i class="iconfont icon-liulan"></i>1234</span>
                                <span><i class="iconfont icon-zaixianliuyan"></i>234</span>
                            </div>
                            <div class="col-6 vip-desc">
                                <span class="downi"><i class="iconfont icon-xiazai"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video-tit">
                    一米阳光写真AE模版
                </div>
            </li>




        </ul>
    </div>

    <!--中部 end-->
    <script src="{{asset("/static/index/scripts/video.js")}}"></script>

@endsection

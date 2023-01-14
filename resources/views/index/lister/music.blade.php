@extends('public.public')
@section('content')

    <!--中部 start-->
    <div class="boxTop">
        <div class="main">
            <div class="row topshowbox">
                <div class="col-6">
                    <div class="ListTit">
                        音频资源 <span class="badge badge-pill badge-primary timer" data-to="1346">1346</span>
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
        <ul class="CD-list clearfix">

            <li>
                <div class="row">
                    <div class="col-4">
                        <div class="CdPlayerBox"
                             data-src="https://s128.xiami.net/381/85381/2108165156/1900676876_1584258326440_178.mp3?ccode=xiami_web_web&expire=86400&duration=162&psid=4a68dac9653312e40a624c3f608a30dd&ups_client_netip=117.61.243.23&ups_ts=1584373855&ups_userid=0&utid=FiChFbD0cVICAW/JPTWkBn7o&vid=1900676876&fn=1900676876_1584258326440_178.mp3&vkey=B989022837f13aeef6924322383f06658">
                            <span class="CD-icon"></span>
                            <span class="ibtntool">
                                <i class="iconfont icon-bofang btnCD active"></i>
                                <i class="iconfont icon-bofangqi-zanting btnCD"></i>
                            </span>
                            <audio id="Music1{$i}"></audio>
                        </div>
                        <div class="cont-bar">
                            <span><i class="iconfont icon-liulan"></i>12324</span>
                            <span><i class="iconfont icon-zaixianliuyan"></i>972</span>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="CD-tit">
                            <a href="/index/Details/music.html">轻松明快的背景音乐轻松明快的背景音乐</a>
                        </div>
                        <div class="tag-span-tool">
                            <span>AE模版</span>
                            <span>10分钟前</span>
                            <span class="durationtimexc ">02:35</span>
                        </div>
                        <div class="row progressbox">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar  progress-bar-striped" role="progressbar"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 progress-timebox">
                                <span class="progress-time">00:00</span>
                            </div>
                        </div>
                        <div class="DownTool">
                                <span class="disi"><i class="iconfont icon-yduizhekou"></i> <span
                                        class="dis-num">7折</span></span>
                            <span><span class="munsrcoe">125</span>积分</span>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-4">
                        <div class="CdPlayerBox"
                             data-src="https://s128.xiami.net/381/85381/2108165156/1900676876_1584258326440_178.mp3?ccode=xiami_web_web&expire=86400&duration=162&psid=4a68dac9653312e40a624c3f608a30dd&ups_client_netip=117.61.243.23&ups_ts=1584373855&ups_userid=0&utid=FiChFbD0cVICAW/JPTWkBn7o&vid=1900676876&fn=1900676876_1584258326440_178.mp3&vkey=B989022837f13aeef6924322383f06658">
                            <span class="CD-icon"></span>
                            <span class="ibtntool">
                                <i class="iconfont icon-bofang btnCD active"></i>
                                <i class="iconfont icon-bofangqi-zanting btnCD"></i>
                            </span>
                            <audio id="Music2{$i}"></audio>
                        </div>
                        <div class="cont-bar">
                            <span><i class="iconfont icon-liulan"></i>12324</span>
                            <span><i class="iconfont icon-zaixianliuyan"></i>972</span>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="CD-tit">
                            <a href="">轻松明快的背景音乐轻松明快的背景音乐</a>
                        </div>
                        <div class="tag-span-tool">
                            <span>配乐</span>
                            <span>10天前</span>
                            <span class="durationtimexc ">03:23</span>
                        </div>
                        <div class="row progressbox">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar  progress-bar-striped" role="progressbar"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 progress-timebox">
                                <span class="progress-time">00:00</span>
                            </div>
                        </div>
                        <div class="DownTool">
                            <span class="vipi"><i class="iconfont icon-vip-crown--fill"></i></span>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-4">
                        <div class="CdPlayerBox"
                             data-src="https://s128.xiami.net/381/85381/2108165156/1900676876_1584258326440_178.mp3?ccode=xiami_web_web&expire=86400&duration=162&psid=4a68dac9653312e40a624c3f608a30dd&ups_client_netip=117.61.243.23&ups_ts=1584373855&ups_userid=0&utid=FiChFbD0cVICAW/JPTWkBn7o&vid=1900676876&fn=1900676876_1584258326440_178.mp3&vkey=B989022837f13aeef6924322383f06658">
                            <span class="CD-icon"></span>
                            <span class="ibtntool">
                                <i class="iconfont icon-bofang btnCD active"></i>
                                <i class="iconfont icon-bofangqi-zanting btnCD"></i>
                            </span>
                            <audio id="Music3{$i}"></audio>
                        </div>
                        <div class="cont-bar">
                            <span><i class="iconfont icon-liulan"></i>12324</span>
                            <span><i class="iconfont icon-zaixianliuyan"></i>972</span>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="CD-tit">
                            <a href="">轻松明快的背景音乐轻松明快的背景音乐</a>
                        </div>
                        <div class="tag-span-tool">
                            <span>AE模版</span>
                            <span>10分钟前</span>
                            <span class="durationtimexc ">05:25</span>
                        </div>
                        <div class="row progressbox">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar  progress-bar-striped" role="progressbar"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 progress-timebox">
                                <span class="progress-time">00:00</span>
                            </div>
                        </div>
                        <div class="DownTool">
                            <span class="downi"><i class="iconfont icon-xiazai"></i></span>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="row">
                    <div class="col-4">
                        <div class="CdPlayerBox"
                             data-src="https://s128.xiami.net/381/85381/2108165156/1900676876_1584258326440_178.mp3?ccode=xiami_web_web&expire=86400&duration=162&psid=4a68dac9653312e40a624c3f608a30dd&ups_client_netip=117.61.243.23&ups_ts=1584373855&ups_userid=0&utid=FiChFbD0cVICAW/JPTWkBn7o&vid=1900676876&fn=1900676876_1584258326440_178.mp3&vkey=B989022837f13aeef6924322383f06658">
                            <span class="CD-icon"></span>
                            <span class="ibtntool">
                                <i class="iconfont icon-bofang btnCD active"></i>
                                <i class="iconfont icon-bofangqi-zanting btnCD"></i>
                            </span>
                            <audio id="Music4{$i}"></audio>
                        </div>
                        <div class="cont-bar">
                            <span><i class="iconfont icon-liulan"></i>12324</span>
                            <span><i class="iconfont icon-zaixianliuyan"></i>972</span>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="CD-tit">
                            WinXP开机系统声音
                        </div>
                        <div class="tag-span-tool">
                            <span>系统声音</span>
                            <span class="durationtimexc ">00:04</span>
                        </div>
                        <div class="row progressbox">
                            <div class="col-9">
                                <div class="progress">
                                    <div class="progress-bar  progress-bar-striped" role="progressbar"
                                         aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 progress-timebox">
                                <span class="progress-time">00:00</span>
                            </div>
                        </div>
                        <div class="DownTool">
                            <span class="downi"><i class="iconfont icon-xiazai"></i></span>
                        </div>
                    </div>
                </div>
            </li>


        </ul>
    </div>

    <!--中部 end-->
    <script src="{{asset("/static/index/scripts/music.js")}}"></script>

@endsection

@extends('public.public')
@section('content')

    <!--中部 start-->
    <div class="main">
        <div class="clearfix detailsmain">
            <!--Left-->
            <div>
                <div class="row">
                    <div class="col-12">
                        <div class="CDPlayerMax CD-list">
                            <div class="CdPlayerBox waves"
                                 data-src="https://s320.xiami.net/210/1210/6213/76280_1511595092734.mp3?ccode=xiami_web_web&expire=86400&duration=255&psid=065460ee5d6e550938aa48616d14f744&ups_client_netip=223.223.199.195&ups_ts=1586757960&ups_userid=74092144&utid=DdRwFkf7TywCAd/fx8Mr32mk&vid=76280&fn=76280_1511595092734.mp3&vkey=Bfc1573faee2f0af8660cdf5e192f99d9">
                                <span class="CD-icon"></span>
                                <span class="ibtntool">
                                        <i class="iconfont icon-bofang btnCD active"></i>
                                        <i class="iconfont icon-bofangqi-zanting btnCD"></i>
                                    </span>
                                <audio id="MusicMAX"></audio>
                            </div>
                            <div class="row progressbox">
                                <div class="col-1 progress-timebox">
                                    <span class="progress-time">00:00</span>
                                </div>

                                <div class="col-10">
                                    <div class="progress">
                                        <div class="progress-bar  progress-bar-striped" role="progressbar"
                                             aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-1">
                                    <span class="durationtimexc ">02:35</span>
                                </div>
                            </div>
                            <div class="DownTool">
                                <span class="disi"><i class="iconfont icon-yduizhekou"></i> <span
                                        class="dis-num">7折</span></span>
                                <span><span class="munsrcoe">125</span>积分</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="GiTit text-hd">
                            FSHU 时尚电商应用界面FSHU 时尚电商应用界面FSHU 时尚电商应用界面FSHU 时尚电商应用界面FSHU 时尚电商应用界面FSHU 时尚电商应用界面
                        </div>
                        <div class="auther-box">
                            <div class="desmsg-box clearfix">
                                <div>
                                    <img src="https://www.ziyedh.com/uploads/UserPic/20191101/af33f824558bd4d7e4905656df2983b8.jpeg"
                                         class="authericon-small">
                                </div>
                                <div class="anther-nick">
                                    小upSetyono Dwi
                                </div>
                                <div class="tagguanzhubox">
                                    <span class="tag-guanzhu tag-guanzhu-yes "> <i class="iconfont icon-yiguanzhuren"></i> 已关注</span>
                                    <!--<span class="tag-guanzhu tag-add"> <i class="iconfont icon-jiaguanzhuren"></i> 关注</span>-->
                                </div>
                                <div class="desl-time">
                                    2020-03-23 12:20:12
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 IlikeBar">
                        <div>
                            <i class="iconfont icon-shoucang ilikei"></i>
                        </div>
                        <div class="ilikesum">
                            12383
                        </div>
                    </div>
                </div>

                <!--分享点赞-->
                <div class="row  d-flex justify-content-center share-ilike-tool">
                    <div class="col-1">
                        <div>
                            <i class="iconfont icon-tupian"></i>
                        </div>
                        <div>
                            生成海报
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="icon-zan-content clearfix">
                            <i class="iconfont icon-dianzan zan-btn-i"><span class="zan-numver">364</span></i>
                        </div>
                    </div>
                    <div class="col-1 div-sharebox">
                        <div>
                            <i class="iconfont icon-share-fill"></i>
                        </div>
                        <div>
                            乐于分享
                        </div>
                        <div class="shareBox social-share clearfix">

                        </div>
                    </div>
                </div>
            </div>
            <!--Right-->
            <div class="Rightmeun">
                <div class="Right-Top">
                    <div class="btn-groupdown">
                        <div class="download-jifen-btn">
                            <i class="iconfont icon-jifen"></i> 立即下载 150积分
                        </div>

                        <div class="download-jifen-btn vip-down-btn">
                            <i class="iconfont icon-huiyuan"></i> VIP 会员免费下载
                        </div>
                    </div>
                    <div class="suicai-tips">
                        素材有问题？<a href="">请通知我们</a>
                    </div>
                    <div class="parameter-box">
                        <p>素材编号：19446777</p>
                        <p>颜色模式：RGB</p>
                        <p>图片尺寸像素：3543x5315px</p>
                        <p>文件大小：19.02M</p>
                        <p>文件格式：PSD</p>
                        <p>推荐软件：Photoshop CC</p>
                        <p>上传时间：2020-01-03 15:38:29</p>
                    </div>
                    <div class="tag-shucai-box">
                <span class="tag-b">
                    APP
                </span>
                        <span class="tag-b">
                    UIkit
                </span>
                        <span class="tag-b">
                    PSD
                </span>
                        <span class="tag-b">
                    PhotoShop
                </span>
                    </div>
                </div>

                <!--AD-->
                <div>

                    <img src="//img.tuguaishou.com/ips_templ_preview/w432_q100/00/f3/a2/lg_2805434_1581828911_5e48cb2feb155.jpg?auth_key=2217340800-0-0-7e645f8c8f6e9c95b8f110761ce7f361"
                         alt="">
                </div>
            </div>
        </div>
    </div>
    <!--相关推荐-->
    <div class="Boottom-box">
        <div class="main">
            <div class="tag-tit">
                相关推荐
            </div>
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
    </div>
    <!--中部 end-->

    <script src="{{asset("/static/frame/share/js/social-share.min.js")}}"></script>
    <script src="{{asset("/static/index/scripts/design_details.js")}}"></script>
@endsection

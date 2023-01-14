@extends('public.public')
@section('content')
    <div class="main_cont_box clearfix">
        @include('public.person_left')
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <div class="news-alert">
                    <i class="ico-closed"></i>
                    <i class="ico-alert"></i>2020年04月04日 19:30--22:00，消息通知：各位用户尽早更改初始密码
                    <a href="#" target="_blank"> 点击查看 </a>
                </div>
                <div class="personal-home">
                    <div class="record-middle">
                        <div class="w_bor record-user">
                            <h3 class="hd-title">个人数据</h3>
                            <div class="my-record">
                                <div class="data_box">
                                    <div class="tix_data_box">
                                        <img src="/static/index/images/wallet.png"
                                             class="yue_qianb">
                                        <div>
                                            <span>0.80</span>
                                            <span>账户余额</span>
                                        </div>
                                        <div>
                                            <span>0.00</span>
                                            <span>今日收益</span>
                                        </div>
                                        <div>
                                            <span>0.00</span>
                                            <span>提现金额</span>
                                        </div>
                                        <div>
                                            <span>0</span>
                                            <span>订单数量</span>
                                        </div>
                                        <div>
                                            <span>100.00</span>
                                            <span>成交金额</span>
                                        </div>
                                        <div>
                                            <span>100.00</span>
                                            <span>总收益</span>
                                        </div>
                                        <img src="/static/index/images/wallet_t.png"
                                             class="toubm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w_bor record-course">
                            <h3 class="hd-title">我的订单</h3>
                            <div class="my-record">
                                <div class="no-data-con">
                                    <div class="no-data-icon course_img"></div>
                                    <div class="no-data-text">
                                        <p class="texta">暂无订单记录</p>
                                        <div class="no-data-btn">
                                            <a href="/" class="btn-tink">找感兴趣的订单</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w_bor record-tiku">
                            <h3 class="hd-title">我的交易</h3>
                            <div class="my-record">
                                <!-- 源码类型 -->
                                <div class="re-con">
                                    <h4 class="re-con-title">正在交易<i class="re-con-date">2019-06-03</i></h4>
                                    <div class="re-con-tiku">
                                        <div class="retiku-title">
                                            源码
                                            <span>&gt;</span>Carefreecms
                                        </div>
                                        <div class="pracl-dalist">
                                            <i class="pracl-icon">源</i>
                                            <h5>2020年最牛逼的cms系统开源系统</h5>
                                            <p><span>0人购买</span></p>
                                        </div>
                                    </div>
                                    <span class="dal-but"> <a target="_blank" href="/my" class="btn_blue exam-go">一键购买</a> </span>
                                </div>
                                <!-- 源码类型结束 -->
                                <!-- 素材类型 -->
                                <div class="re-con">
                                    <h4 class="re-sucai-title">正在交易<i class="re-con-date">2019-06-03</i></h4>
                                    <div class="re-con-tiku">
                                        <div class="retiku-title sucai-title">
                                            素材
                                            <span>&gt;</span>红灯结彩psd素材
                                        </div>
                                        <div class="sucai-dalist">
                                            <i class="sucai-icon ">素</i>
                                            <h5>红灯结彩psd素材</h5>
                                            <p><span>0人购买</span></p>
                                        </div>
                                    </div>
                                    <span class="dal-but"> <a target="_blank" href="/my"
                                                              class="btn_red exam-go">一键购买</a> </span>
                                </div>
                                <!-- 素材类型结束 -->
                                <div class="my_practice_main">
                                    <ul>
                                        <li class="zql"><p><span class="report_num"><i>0</i>%</span> <span
                                                    class="report_info">成功率</span></p></li>
                                        <li class="erro"><p><span class="report_num"><i>0</i>个</span> <span
                                                    class="report_info">订单总数</span></p></li>
                                        <li class="favorites"><p><span class="report_num"><i>0</i>个</span> <span
                                                    class="report_info">收藏订单</span></p></li>
                                    </ul>
                                    <div class="report-text">
                                        <a href="/my/message.html" class="report-btn">查看公告&gt;</a>~~全网最牛逼的cms系统资源源码素材一体化~~
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="record-right">
                        <div class="w_bor daily-practice">
                            <div class="daily-title">
                                <div class="daily-h3">
                                    每日一签
                                    <span>每天进步一点点</span>
                                </div>
                                <div class="daily-message">
                                    坚持签到
                                    <br/>
                                    <span>0</span>天
                                </div>
                            </div>
                            <div class="daily-cont">
                                <a href="javascript:;" class="daily-a">
                                    <div class="daily-date">
                                        周六
                                        <span>04.04</span>
                                    </div>
                                    <i class="daily-icon"></i> <span class="daily-btn" data-toggle="modal"
                                                                     data-target="#qiandao">进入签到</span> </a>
                            </div>
                        </div>
                        <!-- 签到弹窗 -->
                        <div class="modal fade" id="qiandao" tabindex="-1" role="dialog" aria-labelledby="qiandao"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <!-- 签到内开始 -->
                                    <div class="container">
                                        <div class="row">
                                            <div class="qiandao-all">
                                                <div class=""><img src="/static/index/images/qiandao/qdBanner.jpg" class="img-responsive">
                                                </div>
                                                <div class="calendar">
                                                    <div class="wrapper">
                                                        <div class="list acea-row row-between-wrapper">
                                                            <div class="item">
                                                                <div class="">
                                                                    第一天
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +10
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="">
                                                                    第二天
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +20
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="">
                                                                    第三天
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +30
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="">
                                                                    第四天
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +40
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="">
                                                                    第五天
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +50
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="">
                                                                    第六天
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +60
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="rewardTxt">
                                                                    奖励
                                                                </div>
                                                                <div class="venus"></div>
                                                                <div class="num">
                                                                    +110
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="but bg-color-red" onclick="signIn()">
                                                            立即签到
                                                        </div>
                                                        <div class="lock"></div>
                                                    </div>
                                                    <div class="wrapper wrapper2">
                                                        <div class="tip">已累计签到</div>
                                                        <div class="list2 acea-row row-center row-bottom">
                                                            <div class="item">
                                                                0
                                                            </div>
                                                            <div class="item">
                                                                0
                                                            </div>
                                                            <div class="item">
                                                                0
                                                            </div>
                                                            <div class="item">
                                                                0
                                                            </div>
                                                            <div class="data">天</div>
                                                        </div>
                                                        <div class="tip2">
                                                            据说连续签到第七天可获得超额积分，一定要坚持签到哦~~~
                                                        </div>
                                                        <div class="list3">
                                                            <div class="item acea-row row-between-wrapper">
                                                                <div>
                                                                    <div class="name line1">签到奖励</div>
                                                                    <div class="data">2020-04-01</div>
                                                                </div>
                                                                <div class="num font-color-red">+10.00</div>
                                                            </div>
                                                            <a href="javascript:;"
                                                               class="Loads acea-row row-center-wrapper">
                                                                点击加载更多
                                                                <div class="iconfont icon-gengduo acea-row row-center-wrapper"></div>
                                                            </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 签到内结束 -->
                                </div>
                            </div>
                        </div>
                        <!-- 签到弹窗结束 -->
                        <div class="w_bor my-order">
                            <h3 class="hd-title">我的订单</h3>
                            <ul class="payment-ul">
                                <li class="order-one"><a href="javascript:;"> <i class="order-icon"></i> 待付款订单 </a></li>
                                <li class="order-two"><a href="/my/order.html"> <i class="all-icon"></i> 全部订单 </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    右侧结束-->
    </div>
    </div>
        <!--中部 end-->
        <script>
            function signIn() {
                var i = $(".list2  .item").eq(3).text();
                i++;
                $('.list2 .item').eq(3).text(i);
                $('.qdbox .pt10 .text-green').text(i);
                var count = 0;
                $(".wrapper .list .item .venus").eq(count).addClass('venusSelect');
                $(".wrapper .list .item .num").eq(count).addClass('on');
                console.log(count);
            }
            $(".ico-closed").click(function () {
                $(".news-alert").remove();
            })
        </script>
@endsection

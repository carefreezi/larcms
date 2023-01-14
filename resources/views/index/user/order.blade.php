@extends('public.public')
@section('content')

    <div class="main_cont_box clearfix">
        @include("public.person_left")
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="tab-nav clearfix">
                <div class="hd clearfix">
                    <div class="fl-blk tab">
                        <a href="javascript:;" class="this" data-val="0" data-num="0">全部<span>(0)</span></a>
                        <a href="javascript:;" data-val="1" data-num="0" class="">待支付<span>(0)</span></a>
                        <a href="javascript:;" data-val="2" data-num="0" class="">已开通<span>(0)</span></a>
                    </div>
                </div>
            </div>

            <div class="right-personal personal-news clearfix">
                <div class="personal-bd">
                    <div class="dingd_navHd clearfix"><span class="cz"></span><span class="ddxq">订单详情</span><span
                            class="jey">金额/元</span><span class="ddzt">订单状态</span></div>
                    <div class="orders-list-con">
                        <div id="order-no-open" style="display: none;">
                            <!-- 订单未付款 -->
                            <div class="trade-order-main">
                                <div class="order-wpay">
                                    <ul>
                                        <li class="trade-order-head">
                                            <label>
                                                <strong>2020-04-05</strong>
                                            </label>
                                            <span>
                                                        订单号：<i>202004055896874</i>
                                                        <strong class="font-jf">源码类型</strong>
                                                    </span>
                                            <a href="javascript:;" class="newdel del">删除订单</a>
                                            <a class="f-fr zxkf_a" href="javascript:;"><i
                                                    class="kefu iconfont icon-kefu3"></i><em
                                                    class="var">咨询客服</em></a>
                                        </li>
                                    </ul>
                                    <div class="trade-order-body">
                                        <li class="l1">
                                            <div class="order-info clearfix">
                                                <a href="javascript:;" class="order-img">
                                                    <img src="/static/index/images/avater/default1.png">
                                                </a>
                                                <div class="order-tit">
                                                    <a href="javascript:;">第三方支付系统，pdd支付，支付宝支付</a>
                                                    <p class="order-tit-price">
                                                        <span>￥5280.00</span>
                                                    </p>
                                                    <p><span>类型：PHP</span></p>
                                                    <p><span>数据库：MYSQL</span></p>
                                                    <p><span>框架：Thinkphp</span></p>
                                                    <p><span>大小：21MB</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="prace bor-left l2">
                                            <span><b>会员价格</b>￥4700.00</span>
                                            <p>
                                                <del>(原￥5280.00)</del>
                                            </p>
                                            <div class="prace_time"><i
                                                    class="ico iconfont icon-shijian"></i>还剩<span>1</span>天<span>23</span>时
                                            </div>
                                        </li>
                                        <li class="wait-pay bor-left l3">等待付款</li>
                                        <li class="pay-it bor-left l4">
                                            <a href="javascript:;" target="_blank">去结算</a>
                                        </li>
                                    </div>

                                </div>
                            </div>
                            <!-- 订单未付款结束 -->
                            <!-- 订单购买成功 -->
                            <div class="trade-order-main">
                                <div class="order-wpay">
                                    <ul>
                                        <li class="trade-order-head">
                                            <label>
                                                <strong>2020-04-05</strong>
                                            </label>
                                            <span>
                                                        订单号：<i>202004055896874</i>
                                                        <strong class="font-jf">源码类型</strong>
                                                    </span>
                                            <a href="javascript:;" class="newdel del">删除订单</a>
                                            <a class="f-fr zxkf_a" href="javascript:;"><i
                                                    class="kefu iconfont icon-kefu3"></i><em
                                                    class="var">咨询客服</em></a>
                                        </li>
                                    </ul>
                                    <div class="trade-order-body">
                                        <li class="l1">
                                            <div class="order-info clearfix">
                                                <a href="javascript:;" class="order-img">
                                                    <img src="/static/index/images/avater/default1.png">
                                                </a>
                                                <div class="order-tit">
                                                    <a href="javascript:;">第三方支付系统，pdd支付，支付宝支付</a>
                                                    <p class="order-tit-price">
                                                        <span>￥5280.00</span>
                                                    </p>
                                                    <p><span>类型：PHP</span></p>
                                                    <p><span>数据库：MYSQL</span></p>
                                                    <p><span>框架：Thinkphp</span></p>
                                                    <p><span>大小：21MB</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="prace bor-left l2">
                                            <span><b>会员价格</b>￥4700.00</span>
                                            <p>
                                                <del>(原￥5280.00)</del>
                                            </p>
                                            <div class="prace_time"><i
                                                    class="ico iconfont icon-shijian"></i>订单已结算成功
                                            </div>
                                        </li>
                                        <li class="wait-pay bor-left l3">购买成功</li>
                                        <li class="pay-it bor-left l4">
                                            <a href="javascript:;" target="_blank">去下载</a>
                                        </li>
                                    </div>

                                </div>
                            </div>
                            <!-- 订单购买成功结束 -->
                            <!-- 素材购买 -->
                            <div class="trade-order-main">
                                <div class="order-wpay">
                                    <ul>
                                        <li class="trade-order-head">
                                            <label>
                                                <strong>2020-04-05</strong>
                                            </label>
                                            <span>
                                                        订单号：<i>202004055896874</i>
                                                        <strong class="font-jf">素材类型</strong>
                                                    </span>
                                            <a href="javascript:;" class="newdel del">删除订单</a>
                                            <a class="f-fr zxkf_a" href="javascript:;"><i
                                                    class="kefu iconfont icon-kefu3"></i><em
                                                    class="var">咨询客服</em></a>
                                        </li>
                                    </ul>
                                    <div class="trade-order-body">
                                        <li class="l1">
                                            <div class="order-info clearfix">
                                                <a href="javascript:;" class="order-img">
                                                    <img src="/static/index/images/avater/default1.png">
                                                </a>
                                                <div class="order-tit">
                                                    <a href="javascript:;">红灯结彩psd素材</a>
                                                    <p class="order-tit-price">
                                                        <span>￥100.00</span>
                                                    </p>
                                                    <p><span>类型：PSD</span></p>
                                                    <p><span>制作：Phptoshop</span></p>
                                                    <p><span>大小：21MB</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="prace bor-left l2">
                                            <span><b>无优惠价</b>￥100.00</span>
                                            <div class="prace_time"><i
                                                    class="ico iconfont icon-shijian"></i>还剩<span>1</span>天<span>23</span>时
                                            </div>
                                        </li>
                                        <li class="wait-pay bor-left l3">等待付款</li>
                                        <li class="pay-it bor-left l4">
                                            <a href="javascript:;" target="_blank">去结算</a>
                                        </li>
                                    </div>

                                </div>
                            </div>
                            <!-- 素材购买结束 -->
                        </div>

                        <div id="order-open" style="display: block;">
                            <div class="no-data-con">
                                <div class="no-data-icon"></div>
                                <div class="no-data-text">
                                    <p class="texta">您没有任何订单</p>
                                    <p class="textb">~学习没有终点，任何时候都是一个起点。</p>
                                    <div class="no-data-btn"><a href="#" class="btn-tink">开始去购买</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    右侧结束-->
    </div>
    <script>
        $(".tab-nav a").on("click", function () {
            var val = $(this).attr("data-val");
            $(this).addClass("this").siblings().removeClass();
            if (val == "1") {
                $("#order-no-open").show().siblings().hide();
            } else if (val == "2") {
                $("#order-open").show().siblings().hide();
            } else if (val == "3") {
                $("#order-open").hide();
                $("#order-no-open").hide();
                $("#divBill").show();
            } else {
                $("#order-open,#order-no-open").hide();
            }
        })
    </script>
@endsection

@extends('public.public')

@section('content')

    <!--中部 start-->
    <div class="main_cont_box clearfix">
    @include('public.person_left')

    <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="tab-nav clearfix">
                <div class="hd clearfix">
                    <div class="fl-blk tab">
                        <a href="javascript:;" class="this" data-val="0" data-num="0">全部<span>(1)</span></a>
                        <a href="javascript:;" data-val="1" data-num="0" class="">审核中<span>(1)</span></a>
                    </div>
                </div>
            </div>

            <div class="right-personal personal-news clearfix">
                <div class="personal-bd">
                    <div class="dingd_navHd clearfix"><span class="cz"></span><span class="ddxq">源码详情</span>
                        <span class="jey">金额/元</span><span class="ddzt">审核状态</span><span class="codedit">操作</span></div>
                    <div class="orders-list-con">
                        <div id="order-no-open" style="display: none;">
                            <div class="trade-order-main">
                                <div class="order-wpay">
                                    <ul>
                                        <li class="trade-order-head">
                                            <label>
                                                <strong>2020-04-05</strong>
                                            </label>
                                            <span>
                                                源码编号：<i>32</i>
                                                <strong class="font-jf">分类：会员专享</strong> </span>

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
                                                        <span>￥4700.00</span>
                                                    </p>
                                                    <p><span>类型：PHP</span></p>
                                                    <p><span>数据库：MYSQL</span></p>
                                                    <p><span>框架：Thinkphp</span></p>
                                                    <p><span>大小：21MB</span></p>

                                                </div>
                                            </div>
                                        </li>
                                        <li class="prace bor-left l2">
                                            <span class="course-price">￥4700.00</span>
                                            <p>
                                            </p>

                                        </li>
                                        <li class="wait-pay bor-left l3">审核中</li>
                                        <li class="pay-it bor-left l4 course-tech">
                                            <a href="#" target="_blank">编辑商品</a>
                                            <a href="#" target="_blank" class="shop_delete">删除商品</a>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="order-open" style="display: block;">
                            <div class="no-data-con">
                                <div class="no-data-icon"></div>
                                <div class="no-data-text">
                                    <p class="texta">您没有任何商品</p>
                                    <p class="textb">~学习没有终点，任何时候都是一个起点。</p>
                                    <div class="no-data-btn"><a href="#" class="btn-tink">开始去发布</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    右侧结束-->
    </div>
    <!--中部 end-->

    <script>
        $(".tab-nav a").on("click", function () {
            var val = $(this).attr("data-val");
            $(this).addClass("this").siblings().removeClass();
            if (val == "1") {
                $("#order-no-open").show().siblings().hide();
            } else if (val == "2") {
                $("#order-open").show().siblings().hide();
            } else {
                $("#order-open,#order-no-open").hide();
            }
        })

    </script>
@endsection

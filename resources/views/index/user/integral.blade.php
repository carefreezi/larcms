@extends('public.public')
@section('content')

    <div class="main_cont_box clearfix">
        @include("public.person_left")
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <!--积分详情-->
                <div class="jf-details-box">
                    <div class="jf-details">
                        <!-- 用户积分 -->
                        <div class="jf-group">
                            <div class="jf-num-box">
                                <span class="jf-num-tit"><i></i>可用积分</span>
                                <p class="jf-number">208</p>
                            </div>
                            <div class="arrow-right"></div>
                            <div class="jf-buy-btn"><a href="/" class="btn"><i></i>积分兑换源码</a></div>
                        </div>
                        <!-- 用户积分结束 -->
                        <!-- 用户等级 -->
                        <div class="jf-level-group">
                            <div class="jf-level-box">
                                <span class="jf-level-tit"><i></i>用户等级</span>
                                <p class="jf-level">LV.5</p>
                            </div>
                            <div class="arrow-right"></div>
                            <div class="jf-level-btn"><a href="/" class="btn" data-toggle="modal"
                                                         data-target="#levelup"><i></i>等级说明</a></div>
                            <!-- 等级说明开始 -->
                            <div class="modal fade" id="levelup" tabindex="-1" role="dialog" aria-labelledby="levelup"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="levelup">等级说明</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            用户等级依照积分来判定，等级可在积分商城换取仅限同等级的商品。
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 等级说明结束 -->
                        </div>
                        <!-- 用户等级结束 -->
                    </div>
                    <ul class="jf-oprea-box">
                        <li class="zjf"><span class="ico"></span> <a href="/my/task.html">赚积分<i class="arrow"></i></a>
                        </li>
                        <li class="jfgz"><span class="ico"></span> <a href="javascript:;" data-toggle="modal"
                                                                      data-target="#exampleModalCenter">积分规则<i
                                    class="arrow"></i></a></li>
                    </ul>
                </div>
                <!-- 积分规则 -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">积分规则</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                积分是cms系统用户在网校平台完成指定的行为给予的奖励。用户通过完成注册、签到、学习课程等指定行为会获得相应的积分。
                                积分可以在cms系统网站以及APP使用，积分可直接用于网校购买课程时抵现，题库下载试卷，社区下载资料，以及APP内兑换下载币。
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 积分规则结束 -->
                <!--积分详情 end-->
                <div class="today-task-box">
                    <div class="jf-change my_ntegral_page">
                        <h2 class="h2-box">
                            <em class="fl">
                                <a target="_blank" href="/my/task.html">今日任务</a>
                            </em>
                            <a class="fr more" target="_blank" href="/my/task.html">更多任务赚取积分&gt;&gt;</a>
                        </h2>
                        <ul class="do-list my-ntegral clearfix">
                            <li class="">
                                <span class="fl"><img src="/static/index/images/jifen/qiandao.png" alt=""></span>
                                <span class="fr" style="float: left; ">
                                    <h2 class="h2-t"><i>今日签到<span class="add_gift">+2分</span></i></h2>
                                    <p>待完成...</p>
                                    <a href="/my" target="_blank" class="button">去签到</a>
                                </span>
                            </li>
                            <li class="">
                                <span class="fl"><img src="/static/index/images/jifen/person.png" alt=""></span>
                                <span class="fr" style="float: left; ">
                                    <h2 class="h2-t"><i>修改资料<span class="add_gift">+10分</span></i></h2>
                                    <p>待完成...</p>
                                    <a href="/my/user.html" target="_blank" class="button">去完成</a>
                                </span>
                            </li>
                            <li class="">
                                <span class="fl"><img src="/static/index/images/jifen/avater.png" alt=""></span>
                                <span class="fr" style="float: left; ">
                                    <h2 class="h2-t"><i>设置头像<span class="add_gift">+10分</span></i></h2>
                                    <p>待完成...</p>
                                    <a href="/my/user.html" target="_blank" class="button">去完成</a>
                                </span>
                            </li>
                            <li class="conplete">
                                <span class="fl"><img src="/static/index/images/jifen/mobile.png" alt=""></span>
                                <span class="fr" style="float: left; ">
                                    <h2 class="h2-t"><i>绑定手机号<span class="add_gift">+10分</span></i></h2>
                                    <p>已完成</p>
                                    <a href="javascript:;" class="button complete-on">已完成</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- 今日任务 结束 -->
                <div class="right-personal personal-set jifen-set">
                    <div class="personal-hd">
                        <a href="javascript:;" data-value="0" class="this">积分明细</a>
                        <a href="javascript:;" data-value="1">积分收入</a>
                        <a href="javascript:;" data-value="-1">积分支出</a>
                    </div>
                    <div class="personal-bd">
                        <div class="my-info">
                            <ul class="search-box clearfix">
                                <li>
                                    <em>所有类型：</em>
                                    <a href="javascript:;" data-id="0" class="search-hover">全部</a>
                                    <a href="javascript:;" data-id="1">基本任务</a>
                                    <a href="javascript:;" data-id="7">积分</a>
                                    <a href="javascript:;" data-id="8">资讯</a>
                                </li>
                                <li>
                                    <em>赚消时间：</em>
                                    <a href="javascript:;" class="search-hover">全部</a>
                                    <a href="javascript:;">当天</a>
                                    <a href="javascript:;">近一周</a>
                                    <a href="javascript:;">近一月</a>
                                    <em class="search-right">
                                        <div class="mt40">
                                            <div class="c-datepicker-date-editor  J-datepicker-range-day mt10">
                                                <i class="c-datepicker-range__icon kxiconfont icon-clock"></i>
                                                <input placeholder="开始日期" name=""
                                                       class="c-datepicker-data-input only-date" value="">
                                                <span class="c-datepicker-range-separator">-</span>
                                                <input placeholder="结束日期" name=""
                                                       class="c-datepicker-data-input only-date" value="">
                                            </div>
                                        </div>
                                    </em>
                                </li>
                            </ul>
                            <div class="message-cont">
                                <ul class="message-head">
                                    <li>来源/用途</li>
                                    <li>积分变化</li>
                                    <li>备注</li>
                                    <li>日期</li>
                                </ul>
                                <div class="message-body">
                                    <ul>
                                        <li><span>勋章奖励</span></li>
                                        <li class="red">+10</li>
                                        <li align="center">勋章奖励：初出茅庐（积分值更新成功）</li>
                                        <li>
                                            <font class="grey-color" >2019-08-26 18:26:00
                                            </font>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li><span>勋章奖励</span></li>
                                        <li class="red">+10</li>
                                        <li align="center">勋章奖励：学有小成（积分值更新成功）</li>
                                        <li>
                                            <font class="grey-color" >2019-08-26 18:26:00
                                            </font>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li><span>绑定手机</span></li>
                                        <li class="red">+100</li>
                                        <li align="center">绑定手机奖励积分!</li>
                                        <li>
                                            <font class="grey-color ">2019-05-08 22:49:00
                                            </font>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li><span>发布违规商品扣除</span></li>
                                        <li class="green">-20</li>
                                        <li align="center">发布违规商品扣除（积分值更新成功）</li>
                                        <li>
                                            <font class="grey-color ">2019-05-08 22:49:00
                                            </font>
                                        </li>
                                    </ul>
                                    <ul>
                                        <li><span>注册</span></li>
                                        <li class="red">+100</li>
                                        <li align="center">新用户注册积分奖励</li>
                                        <li>
                                            <font class="grey-color ">2019-05-08 22:48:00
                                            </font>
                                        </li>
                                    </ul>
                                </div>
                                <div id="pageBar">
                                    <div class="ui-page ui-page-center page-ui-page-bar" data-container="#pageBar"><a
                                            class="ui-page-turn page-prev" href="javascript:void(0)">上一页</a><a
                                            class="page-num z-on" href="javascript:void(0)" data-page="1">1</a><a
                                            class="ui-page-turn page-next" href="javascript:void(0)">下一页</a><span
                                            class="ui-page-skip"><b>第 1/1 页</b></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--    右侧结束-->
    </div>

    <script src="/static/index/scripts/moment.min.js"></script>
    <script src="/static/index/scripts/datepicker.all.min.js"></script>
    <script src="/static/index/scripts/datepicker.en.js"></script>
    <script>//年月日范围
        $('.J-datepicker-range-day').datePicker({
            hasShortcut: true,
            format: 'YYYY-MM-DD',
            isRange: true,
            shortcutOptions: [{
                name: '最近一周',
                day: '-7,0'
            }, {
                name: '最近一个月',
                day: '-30,0'
            }, {
                name: '最近三个月',
                day: '-90, 0'
            }]
        });

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

        $(".do-list li a").click(function () {
            $(this).addClass("complete-on");
        })
    </script>
@endsection

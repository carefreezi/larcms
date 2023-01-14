@extends('public.public')
@section('content')

    <div class="main_cont_box clearfix">
        @include("public.person_left")
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <div class="tab-nav clearfix">
                    <div class="hd clearfix">
                        <div class="fl-blk tab">
                            <a href="javascript:;" class="this">
                                公告
                            </a>
                            <a href="javascript:;">
                                消息
                            </a>
                        </div>
                    </div>
                </div>
                <div id="m__messageList" class="personal-news personal-bd">
                    <div class="hd-info">
                        <div class="fl">
                            共<span id="e__messageCount" data-count="1">1</span>条
                        </div>
                        <div id="m__dateLimitLine" class="fr">
                            <div class="hd-control">
                                <a href="javascript:;" id="btn__cleanAll"><i class="empty"></i>清空</a>
                                <a href="javascript:;" id="btn__refreshMsg"><i class="refresh"></i>刷新</a>
                            </div>
                            <a href="javascript:;" class="asearch this" data-date="0" id="asearch0">全部</a>
                            <a href="javascript:;" class="asearch" data-date="7" id="asearch7">最近7天</a>
                        </div>
                    </div>
                    <div class="bd-new-cont">
                        <dl class="m__messageItem" data-messageid="504019" data-idx="0">
                            <dt class="xz"></dt>

                            <dd>
                                <div class="bt">
                                    <div class="info"><span>消息通知</span>2020-04-07 09:57:09
                                    </div>
                                    管理员通知
                                    <a href="javascript:;" class="btn__del del" title="删除"></a>
                                </div>
                                <div class="date">
                                    尊敬的thinkto cms用户，您的授权即将过期，请尽快使用.
                                    <a href="#" class="xq_a btn__moreInfo">详情请戳：<i>https://www.epmao.com</i></a>
                                </div>
                            </dd>
                        </dl>
                        <div id="pageBar" class="ui-page"></div>
                    </div>
                </div>
            </div>

            <!--    右侧结束-->
        </div>
        <!--中部 end-->

        {/block}
        {block name="script"}
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
        {/block}

@endsection

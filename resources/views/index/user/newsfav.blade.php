@extends('public.public')
@section('content')

    <div class="main_cont_box clearfix">
        @include("public.person_left")<!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <div class="tab-nav clearfix">
                    <div class="hd clearfix">
                        <div class="fl-blk tab">
                            <a href="javascript:;" class="this">文章收藏</a>
                        </div>
                    </div>
                </div>
                <div class="content datumgifts">
                    <div class="share-content">
                        <ul class="share-post">
                            <li class="post-one"><b class="img-ico zixun"></b></li>
                            <li class="post-two">
                                <p class="top-title"> <a target="_blank" class="downclick "
                                                         href="javascript:;">怎么开发一套CMS系统呢</a>
                                </p>
                                <p>
                                    <font class="grey">怎么开发一套CMS系统呢？需要专业的团队运作</font>
                                </p>
                            </li>
                            <li class="post-three" style="text-align: right">
                                <p class="top-date">
                                    <font class="grey">2020-04-07 22:40:56</font>
                                </p>
                                <p class="cancle-hover"><a href="javascript:void(0);" class="grey aCancel"
                                                           data-id="814200"><i class="img-ico cancle-btn"></i>取消收藏</a> </p>
                            </li>
                        </ul>
                        <div id="pageBar">
                            <div class="ui-page ui-page-center page-ui-page-bar"><a
                                    class="ui-page-turn page-prev" href="javascript:void(0)">上一页</a><a
                                    class="page-num z-on" href="javascript:void(0)" data-page="1">1</a><a
                                    class="ui-page-turn page-next" href="javascript:void(0)">下一页</a><span
                                    class="ui-page-skip"><b>第 1/1 页</b></span></div>
                        </div>
                        <div id="divNoData" style="display: block;">
                            <div class="content">
                                <div class="no-data-con">
                                    <div class="no-data-icon"></div>
                                    <div class="no-data-text">
                                        <p class="texta">你还没有收藏过文章哦</p>
                                    </div>
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

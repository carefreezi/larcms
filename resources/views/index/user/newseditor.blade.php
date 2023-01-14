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
                            <a href="javascript:;" class="this">我的关注</a>
                        </div>
                    </div>
                </div>
                <div class="content datumgifts">
                    <div class="share-content">
                        <div class="author-page">
                            <div id="author-following" data-paged="1" class="author-follow"><ul><li>
                                        <div class="following-avatar">
                                            <img src="https://qzapp.qlogo.cn/qzapp/101570847/541E8CBB3DED0A8ABD8741CD4B538A35/100" class="avatar cms-radius">
                                        </div>
                                        <div class="following-info">
                                            <div class="following-name">
                                                <a href="#">Carefree888</a>
                                            </div>

                                            <div class="following-info-count">
                                                <span>0文章</span>
                                                <span>1关注</span>
                                                <span>1粉丝</span>
                                            </div>
                                        </div>
                                        <div class="following-cancel">
                                            <button class="empty">取消关注</button>
                                        </div>

                                    </li></ul> <div class="cms-pagenav"><div class="ajax-pager" style="display: none;"><div class="ajax-pagenav"><div class="btn-group"><button disabled="disabled" class="empty button selected">1</button> <label class="pager-center" style="display: none;"><input type="text" autocomplete="off">/1 页</label></div> <div class="btn-pager"><button disabled="disabled" class="empty button">❮</button> <button disabled="disabled" class="empty button">❯</button></div></div></div></div></div>
                        </div>
                        <div id="pageBar">
                            <div class="ui-page ui-page-center page-ui-page-bar"><a class="ui-page-turn page-prev"
                                                                                    href="javascript:void(0)">上一页</a><a class="page-num z-on" href="javascript:void(0)"
                                                                                                                        data-page="1">1</a><a class="ui-page-turn page-next"
                                                                                                                                              href="javascript:void(0)">下一页</a><span class="ui-page-skip"><b>第 1/1 页</b></span>
                            </div>
                        </div>
                        <div id="divNoData" style="display: block;">
                            <div class="content">
                                <div class="no-data-con">
                                    <div class="no-data-icon"></div>
                                    <div class="no-data-text">
                                        <p class="texta">你还没有关注的人哦~</p>
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

@extends('public.public')
@section('content')
    <div class="main_cont_box clearfix">
        @include("public.person_left")
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <div class="tab-nav clearfix">
                    <div class="hd clearfix">
                        <div class="fl-blk tab"><a href="javascript:" class="this">我的会员</a></div>
                    </div>
                    <div class="xunz_allNum">会员到期时间<span id="txtMyMedal">31</span>天</div>
                </div>
                <div class="content xunzhang_contBox">
                    <a href="javascript:;" class="xunzhang_gl" data-toggle="modal" data-target="#vipshop">会员攻略</a>
                    <!-- 会员攻略弹窗 -->
                    <div class="modal fade" id="vipshop" tabindex="-1" role="dialog" aria-labelledby="vipshop" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">会员攻略</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <span>开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员开通会员</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 会员攻略弹窗结束 -->
                    <div class="ts_xunzhangBox">
                        <h4 class="xunzhangBox_h4">开通会员<span id="txtSpecalMedal">(您目前是年费会员)</span></h4>
                        <ul class="xunzhangBox_ul clearfix">
                            <li data-type="特殊会员" data-id="10008">
                                <p class="xunzhang_ico"><img src="/static/index/images/vip/default0.png" alt="">
                                </p>
                                <p class="xunzhang_name">1天会员</p>
                                <p class="xunzhang_price">￥1元</p>
                                <p class="xunz_getTip">欢迎使用[TkTo CMS]，和你一起进步</p>
                            </li>
                            <li data-type="特殊会员" data-id="10009">
                                <p class="xunzhang_ico"><img src="/static/index/images/vip/default1.png" alt="">
                                </p>
                                <p class="xunzhang_name">月会员</p>
                                <p class="xunzhang_price">￥30元</p>
                                <p class="xunz_getTip">你在TkTo CMS购买30天，加油努力</p>
                            </li>
                            <li data-type="特殊会员" data-id="10005">
                                <p class="xunzhang_ico"><img src="/static/index/images/vip/default2.png"
                                                             alt=""></p>
                                <p class="xunzhang_name">年会员</p>
                                <p class="xunzhang_price">￥365元</p>
                                <p class="xunz_getTip">365天有限期TkTo CMS</p>
                            </li>
                            <li data-type="特殊会员" data-id="10006">
                                <p class="xunzhang_ico"><img src="/static/index/images/vip/default3.png"
                                                             alt=""></p>
                                <p class="xunzhang_name">终身会员</p>
                                <p class="xunzhang_price">￥999元</p>
                                <p class="xunz_getTip">终身成为本站会员</p>
                            </li>
                        </ul>
                        <p class="xz_popup_bigBtn"><a href="javascript:;">开通会员</a></p>

                    </div>
                </div>
            </div>
        </div>
        <!--右部 end-->
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

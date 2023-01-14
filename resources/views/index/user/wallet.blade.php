@extends('public.public')
@section('content')
    <div class="main_cont_box clearfix">
        @include("public.person_left")
        <!--    右侧-->
        <div class="main_cont_rightBox">
            <div class="main_cont_right">
                <!--钱包-->
                <div class="w_bor record-user user-demand">
                    <h3 class="hd-title">我的钱包</h3>
                    <div class="my-record">
                        <div class="data_box">
                            <div class="tix_data_box">
                                <img src="/static/index/images/wallet.png" class="yue_qianb">
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
                                    <span>昨日收益</span>
                                </div>
                                <div>
                                    <span>0.00</span>
                                    <span>总收益</span>
                                </div>
                                <div>
                                    <span>0.00</span>
                                    <span>推广佣金</span>
                                </div>
                                <div>
                                    <span>0</span>
                                    <span>成交订单</span>
                                </div>
                                <div>
                                    <span>0.00</span>
                                    <span>提现总额</span>
                                </div>
                                <img src="/static/index/images/wallet_t.png" class="toubm">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 钱包结束 -->
                <!-- 充值开始 -->
                <div class="w_bor record-user user-demand user-charge">
                    <h3 class="hd-title">在线充值</h3>
                    <div class="my-record">
                        <div class="czje">
                            <label class="cms_xz">
                                <div class="cms_zffs">
                                    <input type="number" id="ice_money" name="ice_money" required=""
                                           placeholder="输入充值金额,如：199 / 1元=1人民币">
                                    <input type="submit" value="在线充值" class="btn alipay">
                                </div>
                            </label>
                            <div class="cms_zhfu">
                                <li><input type="radio" id="paytype1" class="paytype demo--radio" checked=""
                                           name="paytype" value="1" onclick="checkCard()">
                                    <span class="demo--radioInput"></span>
                                    <label for="paytype1" class="zfbico"><em>支付宝</em></label>
                                </li>
                                <li><input type="radio" id="paytype2" class="paytype demo--radio" name="paytype"
                                           value="2" onclick="checkCard()">
                                    <span class="demo--radioInput"></span>
                                    <label for="paytype2" class="zfbface"><em>当面付</em></label>
                                </li>
                                <li><input type="radio" id="paytype3" class="paytype demo--radio1" name="paytype"
                                           value="3" onclick="checkCard()">
                                    <span class="demo--radioInput"></span>
                                    <label for="paytype3" class="wxzfico"><em>微信支付</em></label>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 充值结束 -->
                <div class="right-personal personal-set wallet-set">
                    <div class="personal-hd">
                        <a href="javascript:;" data-value="0" class="this">充值明细</a>
                        <a href="javascript:;" data-value="1">提现明细</a>
                        <a href="javascript:;" data-value="-1">推广明细</a>
                    </div>
                    <div class="personal-bd">
                        <div class="my-info">

                            <ul class="search-box clearfix">
                                <li>
                                    <em>所有类型：</em>
                                    <a href="javascript:;" data-id="0" class="search-hover">全部</a>
                                    <a href="javascript:;" data-id="1">支付宝</a>
                                    <a href="javascript:;" data-id="5">微信</a>
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
                                                <input placeholder="开始日期" name="" class="c-datepicker-data-input only-date"
                                                       value="">
                                                <span class="c-datepicker-range-separator">-</span>
                                                <input placeholder="结束日期" name="" class="c-datepicker-data-input only-date"
                                                       value="">
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
                                        <li><span>支付宝</span></li>

                                        <li class="red">+10.00</li>

                                        <li align="center">支付宝充值</li>
                                        <li>
                                            <font class="grey-color">2019-08-26 18:26:00</font>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li><span>支付宝</span></li>


                                        <li class="red">+10.00</li>

                                        <li align="center">支付宝充值</li>
                                        <li>
                                            <font class="grey-color">2019-08-26 18:26:00</font>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li><span>微信</span></li>
                                        <li class="red">+10.00</li>

                                        <li align="center">微信充值</li>
                                        <li>
                                            <font class="grey-color">2019-08-26 18:26:00</font>
                                        </li>
                                    </ul>

                                    <ul>
                                        <li><span>支付宝当面付</span></li>


                                        <li class="red">+1.00</li>

                                        <li align="center">支付宝当面付扫码充值</li>
                                        <li>
                                            <font class="grey-color">2019-05-08 22:48:00</font>
                                        </li>
                                    </ul>
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
        </div>
        <!--    右侧结束-->
    </div>
    <!--中部 end-->
    {/block}
    {block name="script"}
    <script src="/static/index/scripts/moment.min.js"></script>
    <script src="/static/index/scripts/datepicker.all.min.js"></script>
    <script src="/static/index/scripts/datepicker.en.js"></script>
    <script>
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
    </script>
@endsection

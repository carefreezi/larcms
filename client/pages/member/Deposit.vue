<template>
    <div style="">
        <div style="width: 100%; height: auto;">
            <div class="centerHead__users_main__1fT82 undefined">
                <!--mobile show-->
                <div class="mobile_hide w-100">
                    <div class="userInformation" @click="drawer=true">
                        <i class="el-icon el-icon-user-solid el-icon-minus_font"></i>
                    </div>
                    <el-drawer
                            class="mobile_draw"
                            title="用户中心"
                            :visible.sync="drawer"
                        >
                        <person_left :message_info="member" :verify="verify_info" :user_pic="user_pic"></person_left>
                    </el-drawer>
                </div>
                <!--mobile show end-->
                <div class="centerHead__users_content__3jK8m">
                    <!--                        left-->
                    <person_left :message_info="member" :verify="verify_info" :user_pic="user_pic"></person_left>
                    <!--                        left end-->
                    <div class="centerHead__centerContent__1K_n0">
                        <div class="transiton_container" style="height: auto;">
                            <section class="style__depositWrap__1w3eu style__smallHeight__1I6MP">
                                <div class="style__depositWrap_left__2kiSP">
                                    <div class="style__depositWrap_left_top__1XR5t"><h3>存款</h3>
                                        <div class="style__payMethod__2RSGj">
                                            <article><p class="style__titleFont__1wHCQ">支付方式</p>

                                                <el-popover
                                                    placement="top-start"
                                                    title="存款教程"
                                                    width="200"
                                                    trigger="hover"
                                                    content="输入金额，弹窗支付宝或微信支付，扫码支付等待5秒点击完成支付即可。">
                                                    <div class="style__depositRule__3ehwK" slot="reference"><img
                                                        class="style__mark_question__28wC3"
                                                        style="width: 20px;height:20px"
                                                        src="@/assets/images/prompt.png">存款教程
                                                    </div>
                                                </el-popover>
                                            </article>
                                            <div class="style__payMethodList__1a7BT">
                                                <ul v-if="zf_way=='gf'">
                                                    <li data-analytics="button" data-label="存款-undefined"
                                                        :class="{'style__listItemActive__1Jc29':payment==0}"
                                                        @click="changtypes(0)">
                                                        <img src="~/assets/images/wechat_pay.jpg"
                                                             class="style__payicon__iQGrl">
                                                        <p>微信充值</p></li>
                                                    <li data-analytics="button" data-label="存款-undefined"
                                                        :class="{'style__listItemActive__1Jc29':payment==1}"
                                                        @click="changtypes(1)">
                                                        <img src="~/assets/images/ali_pay.png"
                                                             class="style__payicon__iQGrl">
                                                        <p>支付宝充值</p></li>
                                                </ul>
                                                <ul v-else>
                                                    <li data-analytics="button" data-label="存款-undefined"
                                                        :class="{'style__listItemActive__1Jc29':payment==4}"
                                                        @click="changtypes(4)">
                                                        <img src="~/assets/images/wechat_pay.jpg"
                                                             class="style__payicon__iQGrl">
                                                        <p>微信充值</p></li>
                                                    <li data-analytics="button" data-label="存款-undefined"
                                                        :class="{'style__listItemActive__1Jc29':payment==5}"
                                                        @click="changtypes(5)">
                                                        <img src="~/assets/images/ali_pay.png"
                                                             class="style__payicon__iQGrl">
                                                        <p>支付宝充值</p></li>
                                                </ul>
                                                <div class="style__maxpromo__3VjU4">
                                                    每日最高可享优惠：元
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="style__depositType_box__14K2D">
                                        <el-form label-position="top" label-width="80px"
                                                 :rules="rules" ref="form" :model="form">
                                            <div>
                                                <div class="style__whiteBox__Ebttm style__mergeNextDiv__3tCpq">
                                                    <el-form-item label="存款金额" prop="amount">
                                                        <div class="style__usdtDeposit__2a3lN">
                                                            <div class="style__flexInput__3lWcP">
                                                                <el-input v-model="form.amount" maxlength="10"
                                                                          placeholder="请输入充值金额"
                                                                          value="">
                                                                </el-input>
                                                                <span class="style__inputSuffix__3YFW2">元</span>
                                                            </div>
                                                        </div>
                                                    </el-form-item>
                                                </div>
                                            </div>
                                            <div class="style__whiteBox__Ebttm style__bottomvir__3JYQL">
                                                <div class="style__deposi_but_warp__3tDJ5">
                                                    <el-button type="primary" @click="payOrder('form')">立即存款</el-button>
                                                    <el-dialog
                                                        width="20%"
                                                        @close="handleClose"
                                                        :visible.sync="innerVisible"
                                                        :close-on-click-modal="false" center
                                                        append-to-body>
                                                        <div slot="title"><span> {{ payment | paymentFilter }}支付</span>
                                                        </div>
                                                        <div class="paycode" v-loading="pays_loading">
                                                            <vue-qr class="bicode" :logoScale="20" :margin="0"
                                                                    :dotScale="1"
                                                                    :text="payment_image" style="margin-left: 20%">
                                                            </vue-qr>
                                                        </div>
                                                        <span slot="footer" class="dialog-footer">
                                                        <el-button @click="handleClose">支付成功</el-button>
                                                    </span>
                                                    </el-dialog>
                                                </div>
                                            </div>
                                        </el-form>
                                    </div>
                                </div>
                                <div class="style__depositWrap_right__2wZgV">
                                    <div class="style__centerright_container__2f0dG ">
                                        <div class="style__sidepanel_container__33Bxf" v-loading="loadings">
                                            <div class="style__header_warp__2szlM">
                                                <span class="style__title__1TRfa">存款记录</span>
                                            </div>
                                            <div class="style__content_warp__fhV-L">
                                                <el-timeline>
                                                    <el-timeline-item
                                                        v-for="(item, i) in Paytable"
                                                        :key="i"
                                                        :timestamp="timeago(item.data)">
                                                        存款{{ item.amount }}元
                                                    </el-timeline-item>
                                                </el-timeline>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-html="frame_yzfs" class="display-none">
        </div>
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import {me} from '~/plugins/index';
import Cookies from "js-cookie";
import {payByAlipay} from '~/plugins/index';
import {payByWechat} from '~/plugins/index';
import {usertable} from '~/plugins/index';
import axios from "axios";

const paymentMap = {
    0: {
        text: "微信"
    },
    1: {
        text: "支付宝"
    },
    2: {
        text: "余额"
    },
    4: {
        text: "微信"
    },
    5: {
        text: "支付宝"
    }
};
function checkForm(){
    document.getElementById('alipaysubmit').submit();
}
export default {
    auth:true,
    name: "Deposit",
    components: {
        person_left,
    },
    filters: {
        paymentFilter(type) {
            return paymentMap[type] ? paymentMap[type].text : "";
        },
    },
    data() {
        return {
            //用户信息
            member: {},
            //选择支付方式
            payment: '0',
            //充值金额
            form: {
                amount: '',
            },
            //充值类型
            types: '0',
            //微信充值二维码
            payment_image: '',
            innerVisible: false,
            rules: {
                amount: [
                    {required: true, message: '请输入充值金额', trigger: 'blur'},
                    {pattern: /^((0{1}\.\d{1,2})|([1-9]\d*\.{1}\d{1,2})|([1-9]+\d*)|0)$/, message: '请输入正确的充值金额'}
                ],
            },
            pays_loading: true,
            Paytable: [],
            loadings: true,
            drawer:false,
            verify_info:"",
            user_pic:'',
            frame_yzfs:'',
            title: '存款中心',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico'),
            zf_way:this.WebConfigs('pay_is_lar'),
        }
    },
    async asyncData({app, params}) {
        try{
            let [listA,listB] = await Promise.all([
                app.$axios.$get(`/api/get_verify_auth`),
                app.$axios.$post("/api/get_user_avatar"),
            ])
            return {
                verify_info:listA.data,
                user_pic:listB.data
            }
        }catch (error) {
            return{
                verify_info: '',
            }
        }
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.member = users;
            const a = await usertable(this.member.id);
            this.Paytable = a.orders;
            this.loadings = false;
        }
        if (this.WebConfigs('pay_is_lar')=='gf'){
            this.payment =0;
        }else{
            this.payment=4;
        }

    },

    methods: {
        changtypes(value) {
            this.payment = value;
        },
        _isMobile() {
            let flag = navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i)
            return flag;
        },
        // 展示二维码
        payOrder(formName) {
            if (this._isMobile() && this.payment==1) {
                window.location.href=this.WebConfigs('localhost')+'/api/alipay?amount='+this.form.amount+'&id='+ this.member.id+'&payment='+ this.payment+'&types='+ this.types
            }else if (this._isMobile() && this.payment==0){
                const number = this.form.amount * 100;
                window.location.href=this.WebConfigs('localhost')+'/api/wechat?fee='+number+'&id='+ this.member.id+'&payment='+ this.payment+'&types='+ this.types
            }
            if (this.WebConfigs('alipay_select')==0 && this.payment==1){
                window.location.href=this.WebConfigs('localhost')+'/api/alipay?amount='+this.form.amount+'&id='+ this.member.id+'&payment='+ this.payment+'&types='+ this.types
            }else if(this.payment==4 || this.payment==5){
                this.$message.success({
                    dangerouslyUseHTMLString: true,
                    message: '请求加载中，请稍后~',
                    duration:5000
                });
                this.pays_loading = true;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        // 使用$nextTick确保数据渲染
                        this.$nextTick(() => {
                            this.crateQrcode()
                        })
                    } else {
                        return false;
                    }
                })
            }else{
                this.pays_loading = true;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.innerVisible = true;
                        // 使用$nextTick确保数据渲染
                        this.$nextTick(() => {
                            this.crateQrcode()
                        })
                    } else {
                        return false;
                    }
                })
            }

        },
        // 生成二维码
        async crateQrcode() {
            if (this.payment == 1) {
                const Alipay = await payByAlipay(this.form.amount, this.member.id, this.payment, this.types)
                this.payment_image = Alipay.alipay_url;
                this.pays_loading = false;
            } else if (this.payment == 0) {
                const number = this.form.amount * 100;
                const wechat = await payByWechat(number, this.member.id, this.payment, this.types)
                this.payment_image = wechat.wechat_url;
                this.pays_loading = false;
            }else if (this.payment==5){
                const Alipay = await payByAlipay(this.form.amount, this.member.id, this.payment, this.types)
                this.frame_yzfs = Alipay.alipay_url;
                setInterval(checkForm,1000);
                this.pays_loading = false;
            }else if (this.payment==4){
                const number = this.form.amount * 100;
                const wechat = await payByWechat(number, this.member.id, this.payment, this.types)
                this.frame_yzfs = wechat.wechat_url;
                setInterval(checkForm,1000);
                this.pays_loading = false;
            }
        },
        // 关闭弹框,清除已经生成的二维码
        handleClose() {
            this.form = [];
            this.innerVisible = false
        },
        timeago(dateTimeStamp) {
            var minute = 1000 * 60;      //把分，时，天，周，半个月，一个月用毫秒表示
            var hour = minute * 60;
            var day = hour * 24;
            var week = day * 7;
            var halfamonth = day * 15;
            var month = day * 30;
            var now = new Date().getTime();   //获取当前时间毫秒
            var end = new Date(dateTimeStamp).getTime();
            var diffValue = now - end;//时间差
            if (diffValue < 0) {
                return;
            }
            var minC = diffValue / minute;  //计算时间差的分，时，天，周，月
            var hourC = diffValue / hour;
            var dayC = diffValue / day;
            var weekC = diffValue / week;
            var monthC = diffValue / month;
            if (monthC >= 1 && monthC <= 3) {
                var result = " " + parseInt(monthC) + "月前"
            } else if (weekC >= 1 && weekC <= 4) {
                var result = " " + parseInt(weekC) + "周前"
            } else if (dayC >= 1 && dayC <= 6) {
                var result = " " + parseInt(dayC) + "天前"
            } else if (hourC >= 1 && hourC <= 23) {
                var result = " " + parseInt(hourC) + "小时前"
            } else if (minC >= 1 && minC <= 59) {
                var result = " " + parseInt(minC) + "分钟前"
            } else if (diffValue >= 0 && diffValue <= minute) {
                var result = "刚刚"
            } else if (monthC >= 0.9 && monthC <= 3) {
                var result = "1月前"
            }
            return result;
        }

    },
    head() {
        return {
            title: this.title + "-" + this.title_for,
            meta: [
                {name: 'keywords', content: this.keywords},
                {hid: 'description', name: 'description', content: this.description}
            ],
            link: [
                { rel: 'icon', type: 'image/x-icon', href: this.ico }
            ]
        }
    }

}
</script>

<style scoped>
.style__content_warp__fhV-L .el-timeline {
    margin-top: 10px;
}
</style>

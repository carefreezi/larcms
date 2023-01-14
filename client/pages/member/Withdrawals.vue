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
                            <div class="styles__userContent__2pqRV ">
                                <div class="styles__my_wallet_container__SlDxO">
                                    <div class="styles__my_wallet_container_center__389x-">
                                        <div class="styles__my_wallet_wrap__2ExCC"><h2
                                            class="styles__page_title__YH53h">取款</h2>
                                            <div class="styles__banner__2K3He"></div>
                                            <div class="styles__my_wallet_box__2NzcO">
                                                <div class="styles__money_box__2qHx9">
                                                    <div class="styles__top_balance_container__3YP8u">
                                                        <div class="styles__top_balance_title__15CjC">钱包金额<i></i></div>
                                                        <div class="styles__top_balance_content__2SWUQ">
                                                            <div class="styles__top_balance_money__1Zd_X">
                                                                <div class=" styles__money_content_row__2uxH1">
                                                                    <div class="styles__money_container__3Vpnb"><i
                                                                        class="styles__wallet_withdraw_center__3ZWrm"></i>
                                                                        <div class="styles__money_right__1_ZkM">
                                                                            <div class="styles__money_right_top__2Ki7l">
                                                                                <span>账户余额</span>
                                                                            </div>
                                                                            <div class="styles__money_text__2RQM-">
                                                                                <span>¥</span><b>{{
                                                                                    member_money
                                                                                }}</b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" styles__money_content_row__2uxH1">
                                                                    <div class="styles__money_container__3Vpnb"><i
                                                                        class="styles__wallet_withdraw_lock__1hczq"></i>
                                                                        <div class="styles__money_right__1_ZkM">
                                                                            <div class="styles__money_right_top__2Ki7l">
                                                                                <span>用户积分</span></div>
                                                                            <div class="styles__money_text__2RQM-">
                                                                                <b>{{ member_integral }}</b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="styles__top_balance_border__3piNU"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="styles__withdrawal_way_content__3_3g0">
                                            <div class="styles__title__9Akaq">取款方式</div>
                                            <div class="styles__button_group__3Q8uW">
                                                <div :class="{'styles__active__1DnYl':payment==0}"
                                                     @click=" withdrawal(0)"><i></i><span>微信</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==1}"
                                                     @click=" withdrawal(1)"><i></i><span>支付宝</span></div>
                                            </div>
                                            <div class="style__deposi_but_warp__3tDJ5">
                                                <el-button type="primary" @click="withdrawalOrder = true">立即取款
                                                </el-button>
                                                <el-dialog
                                                    width="30%"
                                                    :visible.sync="withdrawalOrder"
                                                    :close-on-click-modal="false" center
                                                >
                                                    <div slot="title"><span> {{ payment | paymentFilter }}提现</span>
                                                    </div>
                                                    <el-form :label-position="labelPosition" label-width="80px"
                                                             :rules="rules" ref="form" :model="form">
                                                        <el-form-item label="提现账户" prop="number">
                                                            <el-input v-model="form.number">
                                                                <template slot="prepend"><i
                                                                    class="el-icon-s-promotion"></i></template>
                                                            </el-input>
                                                        </el-form-item>
                                                        <el-form-item label="提现姓名" prop="name">
                                                            <el-input v-model="form.name">
                                                                <template slot="prepend"><i
                                                                    class="el-icon-user-solid"></i></template>
                                                            </el-input>
                                                        </el-form-item>
                                                        <el-form-item label="提现金额" prop="amount">
                                                            <el-input v-model="form.amount">
                                                                <template slot="prepend"><i class="el-icon-warning"></i>
                                                                </template>

                                                            </el-input>
                                                        </el-form-item>
                                                    </el-form>
                                                    <p class="style__tip1__39SAi">预计支付手续费&nbsp;&nbsp;<span>0.00</span>
                                                    </p>
                                                    <div slot="footer" class="dialog-footer">
                                                        <el-button @click="withdrawalOrder = false">取 消</el-button>
                                                        <el-button type="primary" @click="submitForm('form')">确 定
                                                        </el-button>
                                                    </div>
                                                </el-dialog>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="style__centerright_container__2f0dG styles__withdrawalCenterRight__SfmU3">
                                    <div class="style__sidepanel_container__33Bxf" v-loading="loadings">
                                        <div class="style__header_warp__2szlM">
                                            <span class="style__title__1TRfa">取款记录</span>
                                        </div>
                                        <div class="style__content_warp__fhV-L">
                                            <el-timeline>
                                                <el-timeline-item
                                                    v-for="(item, i) in Paytable"
                                                    v-if="i<=4"
                                                    :key="i"
                                                    :timestamp="timeago(item.data)">
                                                    取款{{ item.amount }}元
                                                </el-timeline-item>
                                            </el-timeline>

                                        </div>
                                    </div>

                                    <div
                                        class="style__sidepanel_container__33Bxf styles__helper_center_withdrawal__1ZB2r ">
                                        <div class="style__header_warp__2szlM">
                                            <span class="style__title__1TRfa">帮助中心</span>
                                        </div>
                                        <div class="style__content_warp__fhV-L">
                                            <div class="YBSidebarHelper">
                                                <div class="item" v-for="(item,i) in helpcenter" @click="readhelps(i)">
                                                    <p>{{ item.title }}</p><span></span></div>
                                            </div>
                                            <el-dialog
                                                :visible.sync="centerDialogVisibles"
                                                width="30%"
                                                center>
                                                <div slot="title">{{ message_title }}</div>
                                                <div v-html="message_content"></div>
                                                <span slot="footer" class="dialog-footer">
                                                    <el-button type="primary"
                                                               @click="centerDialogVisibles = false">确 认</el-button>
                                                </span>
                                            </el-dialog>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import {me} from '~/plugins/index';
import Cookies from "js-cookie";
import {Cashwithdrawal} from '~/plugins/index';
import {usertable} from '~/plugins/index';
import {Help_center} from '~/plugins/index';


const paymentMap = {
    0: {
        text: "微信"
    },
    1: {
        text: "支付宝"
    },
    2: {
        text: "余额"
    }
};
export default {
    auth:true,
    name: "Withdrawals",
    components: {
        person_left
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
            //提现方式
            payment: '0',
            //弹窗
            withdrawalOrder: false,
            verify_info:'',
            member_money:'',
            member_integral:'',
            //提现表单
            form: {
                number: '',
                name: '',
                amount: '',
            },
            labelPosition: 'left',
            rules: {
                number: [
                    {required: true, message: '请输入提现账号', trigger: 'blur'},
                    {pattern: /^[0-9a-zA-Z_]{1,}$/, message: '存在非法字符', trigger: 'blur'}

                ],
                name: [
                    {required: true, message: '请输入提现姓名', trigger: 'blur'},
                    {pattern: /^[\u4E00-\u9FA5A-Za-z]+$/, message: '只能输入中文和英文', trigger: 'blur'}
                ],
                amount: [
                    {required: true, message: '请输入提现金额', trigger: 'blur'},
                    {pattern: /^((0{1}\.\d{1,2})|([1-9]\d*\.{1}\d{1,2})|([1-9]+\d*)|0)$/, message: '请输入正确的金额'}
                ],
            },
            Paytable: [],
            loadings: true,
            helpcenter: [],
            centerDialogVisibles: false,
            message_title: '',
            message_content: '',
            user_pic:'',
            drawer:false,
            title: '取款中心',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.member = users;
            const a = await usertable(this.member.id);
            this.Paytable = a.withdrawal;
            this.loadings = false;
        }
    },
    async asyncData({app}) {
        let [listA,listB,listC,listD] = await Promise.all([
            app.$axios.$post("/api/Help_center"),
            app.$axios.$get(`/api/get_verify_auth`),
            app.$axios.$get(`/api/get_money_info`),
            app.$axios.$post("/api/get_user_avatar"),
        ])
        return {
            helpcenter: listA.helps,
            verify_info:listB.data,
            member_money:listC.data,
            member_integral:listC.integral,
            user_pic:listD.data
        }
    },
    methods: {
        // 点击帮助中心
        async readhelps(i) {
            this.centerDialogVisibles = true;
            this.message_title = this.helpcenter[i].title;
            this.message_content = this.helpcenter[i].content;
        },
        //选择提款方式
        withdrawal(value) {
            this.payment = value;
        },

        // 关闭弹框,清除已经生成的二维码
        handleClose() {
            this.withdrawalOrder = false
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.getwithdrawal();
                } else {
                    return false;
                }
            })
        },
        async getwithdrawal() {
            this.withdrawalOrder = false
            const w = await Cashwithdrawal(this.form.amount, this.member.id, this.payment, this.form.name, this.form.number)
            const d = await me()
            this.member = d.data;
            this.form = [];
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

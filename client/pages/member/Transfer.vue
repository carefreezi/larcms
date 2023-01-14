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
                        <div class="transiton_container">
                            <div class="styles__userContent__xnZs6 " style="overflow: unset;">
                                <div class="styles__my_wallet_container__Sw2O2">
                                    <div class="styles__my_wallet_container_center__13gFr">
                                        <div class="styles__my_wallet_wrap__2Fvz5"><h2
                                            class="styles__page_title__2qT9s">转账</h2>
                                            <div class="styles__my_wallet_box__3CaHw">
                                                <div class="styles__money_box__3TqGl">
                                                    <div class="styles__top_balance_container__3YP8u">
                                                        <div class="styles__top_balance_content__2SWUQ">
                                                            <div class="styles__top_balance_money__1Zd_X">
                                                                <div
                                                                    class="styles__wallet_top_balance__3jDCZ styles__money_content__1c_qg">
                                                                    <div
                                                                        class="styles__money_container_transfer__1Jb5r">
                                                                        <div class="styles__money_top__1QHym"><i
                                                                            class="styles__trans_withdraw_center__2z_5L"></i>账户余额
                                                                        </div>
                                                                    </div>
                                                                    <div class="styles__money_text__2RQM-">
                                                                        <span>¥</span><b>{{ member_money}}</b>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="styles__wallet_top_balance__3jDCZ styles__money_content__1c_qg">
                                                                    <div
                                                                        class="styles__money_container_transfer__1Jb5r">
                                                                        <div class="styles__money_top__1QHym"><i
                                                                            class="styles__trans_withdraw_lock__6eenr"></i>用户积分
                                                                        </div>
                                                                    </div>
                                                                    <div class="styles__money_text__2RQM-">
                                                                        <b>{{ member_integral }}</b>
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
                                            <div class="styles__title__9Akaq">转账方式</div>
                                            <div class="styles__button_group__3Q8uW">
                                                <div :class="{'styles__active__1DnYl':payment==2}" class="transfer"
                                                     @click=" recharge(2)"><i></i><span>余额</span>
                                                </div>
                                            </div>
                                            <div class="style__deposi_but_warp__3tDJ5">
                                                <el-button type="primary" @click="rechargeorder = true">立即转账
                                                </el-button>
                                                <el-dialog
                                                    width="30%"
                                                    :visible.sync="rechargeorder"
                                                    :close-on-click-modal="false" center
                                                >
                                                    <div slot="title"><span>转账</span>
                                                    </div>
                                                    <el-form label-position="left" label-width="80px"
                                                             :rules="rules" ref="form" :model="form">
                                                        <el-form-item label="转账账号" prop="number">
                                                            <el-input v-model="form.number" placeholder="请输入转账账号">
                                                                <template slot="prepend"><i
                                                                    class="el-icon-s-promotion"></i></template>
                                                            </el-input>
                                                        </el-form-item>
                                                        <el-form-item label="转账金额" prop="amount">
                                                            <el-input v-model="form.amount" placeholder="请输入转账金额">
                                                                <template slot="prepend"><i class="el-icon-warning"></i>
                                                                </template>
                                                            </el-input>
                                                        </el-form-item>
                                                    </el-form>
                                                    <!--                                                    <p class="style__tip1__39SAi">预计支付&nbsp;&nbsp;<span>0.00</span>元</p>-->
                                                    <div slot="footer" class="dialog-footer">
                                                        <el-button @click="rechargeorder = false">取 消</el-button>
                                                        <el-button type="primary" @click="submitForm('form')">确 定
                                                        </el-button>
                                                    </div>
                                                </el-dialog>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="style__centerright_container__2f0dG styles_withdrawals__withdrawalCenterRight__3yVGs">
                                    <div class="style__sidepanel_container__33Bxf" v-loading="loadings">
                                        <div class="style__header_warp__2szlM">
                                            <span class="style__title__1TRfa">转账记录</span>
                                        </div>
                                        <div class="style__content_warp__fhV-L">
                                            <el-timeline>
                                                <el-timeline-item
                                                    v-for="(item, i) in Paytable"
                                                    v-if="i<=4 && item.state==1"
                                                    :key="i"
                                                    :timestamp="timeago(item.data)">
                                                    转账{{ item.amount }}元
                                                </el-timeline-item>
                                            </el-timeline>
                                        </div>
                                    </div>
                                    <div
                                        class="style__sidepanel_container__33Bxf styles_withdrawals__helper_center_withdrawal__3OTeT ">
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
                                                               @click="centerDialogVisibles = false">确 定</el-button>
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
import {transfer_accounts} from '~/plugins/index';
import {usertable} from '~/plugins/index';
import {Help_center} from '~/plugins/index';

export default {
    auth:true,
    name: "Transfer",
    components: {
        person_left
    },
    data() {
        return {
            //用户信息
            member: {},
            member_money:'',
            member_integral:'',
            payment: '2',
            rechargeorder: false,
            form: {},
            loadings: true,
            rules: {
                number: [
                    {required: true, message: '请输入转账账号', trigger: 'blur'},
                    {pattern: /^[0-9a-zA-Z_]{1,}$/, message: '存在非法字符', trigger: 'blur'}

                ],
                amount: [
                    {required: true, message: '请输入转账金额', trigger: 'blur'},
                    {pattern: /^((0{1}\.\d{1,2})|([1-9]\d*\.{1}\d{1,2})|([1-9]+\d*)|0)$/, message: '请输入正确的金额'}
                ],
            },
            Paytable: [],
            helpcenter: [],
            centerDialogVisibles: false,
            message_title: '',
            message_content: '',
            drawer:false,
            verify_info:'',
            user_pic:'',
            title: '转账中心',
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
            this.Paytable = a.transfer;
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
        //选择转账方式
        recharge(value) {
            this.payment = value;
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.transfer_accountsd();
                } else {
                    return false;
                }
            })
        },
        async transfer_accountsd() {
            this.rechargeorder = false;
            const w = await transfer_accounts(this.form.amount, this.form.number)
            const ma = await me();
            this.member = ma.data;
            this.form = [];
            const a = await usertable(this.member.id);
            this.Paytable = a.transfer;
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
.style__sidepanel_container__33Bxf .el-timeline {
    margin-top: 10px;
}
</style>

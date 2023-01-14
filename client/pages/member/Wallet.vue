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
                            <div class="styles__userContent__3LLra route-fade-enter-done">
                                <div class="styles__my_wallet_container__1bGSw">
                                    <div class="styles__my_wallet_container_center__ptix2" v-loading="loadings">
                                        <div class="styles__my_wallet_wrap__2zdU8"><h2
                                            class="styles__page_title__1ZRSe">我的钱包</h2>
                                            <div class="styles__banner__1aIus">
                                            </div>
                                            <div class="styles__my_wallet_box__3DWQQ">
                                                <div class="styles__money_box__Cm_Aa">
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
                                                                        <span>¥</span><b>{{ member_money }}</b>
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
                                                                        <b>{{ member_integral }}</b></div>
                                                                </div>
                                                                <div class="styles__top_balance_border__3piNU"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="styles__my_card_wrap__3plUt">
                                            <el-tabs class="styles__tab_wrap__1ZuAL" v-model="activeName"
                                                     @tab-click="handleClick">
                                                <el-tab-pane label="充值记录" name="first">
                                                    <div class="banks__componentWrap__26L1y false">
                                                        <el-table
                                                            :data="Paytable.slice((currentPage-1)*pagesize,currentPage*pagesize)"
                                                            style="width: 100%"
                                                            align="center"
                                                        >
                                                            <el-table-column
                                                                prop="data"
                                                                label="日期"
                                                                width="180px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="order"
                                                                label="订单号"
                                                                width="180px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="amount"
                                                                label="金额"
                                                                width="120px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="types"
                                                                label="类型"
                                                                width="95px"
                                                                align="center"
                                                            >
                                                                <template slot-scope="scope">
                                                                    <span>{{ scope.row.types | paytypeFilter }}</span>
                                                                </template>
                                                            </el-table-column>

                                                            <el-table-column prop="status" align="center" label="支付方式"
                                                                             width="105px">
                                                                <template slot-scope="scope">
                                                                    <span>{{ scope.row.payment | paymentFilter }}</span>
                                                                </template>
                                                            </el-table-column>
                                                            <el-table-column
                                                                label="订单支付状态"
                                                                width="105px"
                                                                align="center"
                                                            >
                                                                <template slot-scope="scope">
                                                                    <span>{{ scope.row.state | statusFilter }}</span>
                                                                </template>
                                                            </el-table-column>
                                                        </el-table>
                                                    </div>
                                                    <el-pagination
                                                        @size-change="handleSizeChange"
                                                        @current-change="handleCurrentChange"
                                                        background
                                                        layout="prev, pager, next"
                                                        :total="Paytable.length"
                                                        hide-on-single-page
                                                        align="center"
                                                        :page-size="pagesize"
                                                    >
                                                    </el-pagination>
                                                </el-tab-pane>
                                                <el-tab-pane label="提现记录" name="second">
                                                    <div class="banks__componentWrap__26L1y false">
                                                        <el-table
                                                            :data="CashData.slice((currentPage-1)*pagesize,currentPage*pagesize)"
                                                            style="width: 100%"
                                                            align="center"
                                                        >
                                                            <el-table-column
                                                                prop="data"
                                                                label="日期"
                                                                width="100px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="order"
                                                                label="订单号"
                                                                width="170px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="number"
                                                                label="账号"
                                                                width="105px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="name"
                                                                label="姓名"
                                                                width="100px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column
                                                                prop="amount"
                                                                label="金额"
                                                                width="105px"
                                                                align="center"
                                                            >
                                                            </el-table-column>
                                                            <el-table-column prop="status" align="center" label="提现方式"
                                                                             width="80px">
                                                                <template slot-scope="scope">
                                                                    <span>{{ scope.row.payment | paymentFilter }}</span>
                                                                </template>
                                                            </el-table-column>
                                                            <el-table-column
                                                                label="提现状态"
                                                                width="105px"
                                                                align="center"
                                                            >
                                                                <template slot-scope="scope">
                                                                    <span>{{ scope.row.state | statusFilter }}</span>
                                                                </template>
                                                            </el-table-column>
                                                        </el-table>
                                                    </div>

                                                    <el-pagination
                                                        @size-change="handleSizeChange"
                                                        @current-change="handleCurrentChange"
                                                        background
                                                        layout="prev, pager, next"
                                                        :total="CashData.length"
                                                        hide-on-single-page
                                                        align="center"
                                                        :page-size="pagesize"
                                                    >
                                                    </el-pagination>
                                                </el-tab-pane>
                                            </el-tabs>
                                        </div>
                                    </div>
                                    <div class="style__centerright_container__2f0dG">
                                        <div class="style__sidepanel_container__33Bxf">
                                            <div class="style__header_warp__2szlM">
                                            <span class="style__title__1TRfa">连续签到 <span
                                                class="jinsom-sign-page-btn-span">{{ signcount }}</span> 天</span>
                                            </div>
                                            <div class="style__content_warp__fhV-L">
                                                <el-button class="jinsom-sign-page-btn" type="primary"
                                                           @click="dialogVisible = true">点击签到
                                                </el-button>
                                                <el-dialog
                                                    :visible.sync="dialogVisible"
                                                    width="30%"
                                                >
                                                    <div class="ivu-modal-content">
                                                        <div class="ivu-modal-header">
                                                            <div><h5>在线签到<span class="qiandao_day">{{
                                                                    signcount
                                                                }}</span>天
                                                            </h5></div>
                                                        </div>
                                                        <div class="ivu-modal-body">
                                                            <div class="insign-date-line">
                                                                <div class="qiandao-row no-gutters text-center">
                                                                    <div class="col  " v-for="(item , rol) in signmeta">
                                                                        <div class="text-xs text-muted mb-1">
                                                                            +{{ item.integral }}
                                                                        </div>
                                                                        <span
                                                                            class="current btn btn-icon btn-light btn-circle "
                                                                            :class="{'btnlin':signcount>=item.day}">
                                                                        <span>{{ item.day }}</span>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span slot="footer" class="dialog-footer">
                                                    <el-button @click="buqain">补 签</el-button>
                                                    <el-button type="primary" @click="sign">签 到</el-button>
                                                </span>
                                                </el-dialog>
                                                <el-dialog
                                                    title="提示"
                                                    :visible.sync="dialogbuqain"
                                                    width="30%"
                                                >
                                                    <span>您一共漏签{{ diff }}天，确定要花费{{ pay_integrals }}积分进行补签吗？</span>
                                                    <span slot="footer" class="dialog-footer">
                                                        <el-button @click="dialogbuqain = false">取 消</el-button>
                                                        <el-button type="primary" @click="signatures">确 定</el-button>
                                                        </span>
                                                </el-dialog>
                                                <div class="jinsom-sign-page-btn" v-for="(item,los) in gifts">
                                                    <img class="jinsom-sign-page-btn-img" src="~/assets/images/liwu.png"
                                                         alt=""><span>{{ item.signcount }}天</span>
                                                    <el-button class="jinsom-sign-page-btn-button" type="primary"
                                                               @click="Collect_gifts(item.signcount)">领取
                                                    </el-button>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="style__sidepanel_container__33Bxf styles__panel_full__Wb-9L ">
                                            <div class="style__header_warp__1HNjV">
                                                <div class="style__activityTab__1ryaQ">签到排行榜 - TOP6</div>
                                            </div>
                                            <div class="style__content_warp__3Ec1V-item"
                                                 v-for="(item,lol) in Attendancelist">
                                                <p><span class="style__content_warp__3Ec1V-top">{{ lol + 1 }}</span>
                                                    <img
                                                        class="style__content_warp__3Ec1V-img" :src="item.pic"> <span
                                                        class="style__content_warp__3Ec1V-span">{{ item.name }}</span>
                                                    <span
                                                        class="style__content_warp__3Ec1V-spans">{{ item.signcount }}天</span>
                                                </p>
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
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import {me} from '~/plugins/index';
import Cookies from "js-cookie";
import {usertables} from '~/plugins/index';
import {user_sign} from '~/plugins/index';
import {get_user_sign} from '~/plugins/index';
import {signature} from '~/plugins/index';
import {collectgifts} from '~/plugins/index';
import {gifttable} from '~/plugins/index';
import {Attendance_list} from '~/plugins/index';
const paytypes = {
    0: {
        text: "充值余额"
    },
    1: {
        text: "购买VIP"
    },
    3: {
        text: "用户认证"
    },
};
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
    4:{
        text:"微信"
    },
    5:{
        text:"支付宝"
    },
};
const stateMap = {
    0: {
        text: "未支付"
    },
    1: {
        text: "已支付"
    },
};
export default {
    auth:true,
    name: "Wallet",
    components: {
        person_left
    },
    filters: {
        paymentFilter(type) {
            return paymentMap[type] ? paymentMap[type].text : "";
        },
        statusFilter(type) {
            return stateMap[type] ? stateMap[type].text : "";
        },
        paytypeFilter(type) {
            return paytypes[type] ? paytypes[type].text : "";
        },
    },
    data() {
        return {
            //用户信息
            member: {},
            member_money:'',
            member_integral:'',
            //充值订单表格
            currentPage: 1, //初始页
            pagesize: 9,    //    每页的数据
            Paytable: [{
                date: '',
                order: '',
                amount: '',
                types: '',
                payment: '',
                state: '',
            }],
            CashData: [{}],
            //标签页
            activeName: 'first',
            loadings: true,
            //右侧
            dialogVisible: false,
            dialogbuqain: false,
            signcount: 0,
            diff: '',
            pay_integrals: '',
            signmeta: [],
            gifts: [],
            drawer:false,
            Attendancelist: [],
            verify_info:'',
            user_pic:'',
            title: '我的钱包',
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
            const a = await usertables(this.member.id);
            this.Paytable = a.orders;
            this.CashData = a.withdrawal;
            this.loadings = false;
        }
    },

    async asyncData({app}) {
        let [listA, listB, listC,listD,listE,listF] = await Promise.all([
            app.$axios.$post("/api/get_user_sign"),
            app.$axios.$post("/api/gifttable"),
            app.$axios.$post("/api/Attendance_list"),
            app.$axios.$get(`/api/get_verify_auth`),
            app.$axios.$get(`/api/get_money_info`),
            app.$axios.$post("/api/get_user_avatar"),
        ])
        return {
            signcount: listA.signcounts,
            diff: listA.diffs,
            pay_integrals: listA.pay_integral,
            signmeta: listA.signmetas,
            gifts: listB.gifttable,
            Attendancelist: listC.gifttable,
            verify_info:listD.data,
            member_money:listE.data,
            member_integral:listE.integral,
            user_pic:listF.data
        }
    },
    methods: {
        // 标签页
        handleClick(tab, event) {
            // console.log(tab, event);
        },
        // 初始页currentPage、初始每页数据数pagesize和数据data
        handleSizeChange: function (size) {
            this.pagesize = size;
        },
        handleCurrentChange: function (currentPage) {
            this.currentPage = currentPage;
        },


        //签到
        async sign() {
            const qian = await user_sign();
            const signs = await get_user_sign();
            this.signcount = signs.signcounts;
            this.diff = signs.diffs;
        },
        async signatures() {
            this.dialogbuqain = false;
            const signatured = await signature()
            const signs = await get_user_sign();
            this.signcount = signs.signcounts;
            this.diff = signs.diffs;
        },
        buqain() {
            if (this.diff >= 1) {
                this.dialogbuqain = true
            } else {
                this.$message({
                    message: '您不需要补签',
                    type: 'error',
                });
            }
        },
        //礼物领取
        async Collect_gifts(signcount) {
            const Collect_gifts = await collectgifts(signcount);
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

</style>

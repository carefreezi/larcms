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
                            <section class="record__record_wrap__2mgJr">
                                <div class="record__topWrap__1tQ54">
                                    <div class="record__title__12946">
                                        <h3>交易记录</h3><span>当前系统支持查询最近30日的交易记录</span>
                                    </div>
                                    <div class="record__recordSelect__1_7OW">
                                        <div class="record__timeChooseBox__29zOD">
                                            <div class="recordDateChoose__timeEver__yETur">
                                                <div class="block">
                                                    <el-date-picker
                                                        v-model="value1"
                                                        type="daterange"
                                                        range-separator="—"
                                                        start-placeholder="开始日期"
                                                        end-placeholder="结束日期"
                                                    >
                                                    </el-date-picker>
                                                </div>
                                                <div class="recordDateChoose__dayChoose__2yCgM">
                                                    <div class="recordDateChoose__dayItem__1YHII "
                                                         :class="{'recordDateChoose__dayItemActive__2poTi':num==0}"
                                                         @click="selectDate(0)">
                                                        今日
                                                    </div>
                                                    <div class="recordDateChoose__dayItem__1YHII "
                                                         :class="{'recordDateChoose__dayItemActive__2poTi':num==1}"
                                                         @click="selectDate(1)">昨日
                                                    </div>
                                                    <div class="recordDateChoose__dayItem__1YHII "
                                                         :class="{'recordDateChoose__dayItemActive__2poTi':num==7}"
                                                         @click="selectDate(7)">近7日
                                                    </div>
                                                    <div class="recordDateChoose__dayItem__1YHII "
                                                         :class="{'recordDateChoose__dayItemActive__2poTi':num==30}"
                                                         @click="selectDate(30)">近30日
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="record__btnArr__2kqIo">

                                                <el-button style="width: 120px; height: 40px;" type="primary"
                                                           @click="imtScreen">查询
                                                </el-button>

                                                <el-button style="width: 120px; height: 40px; margin-left: 20px;" plain
                                                           @click="Reset">
                                                    重置
                                                </el-button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="YBTransition" v-loading="loadings">
                                    <div class="record__tableWrap__23J92">
                                        <el-table
                                            :data="CashData"
                                            style="width: 100%"
                                        >
                                            <el-table-column
                                                label="日期"
                                                width="200px"
                                                align="center"
                                            >
                                                <template slot-scope="scope">
                                                    <span>{{ rTime(scope.row.created_at) }}</span>
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                prop="order"
                                                label="订单号"
                                                width="200px"
                                                align="center"
                                            >
                                            </el-table-column>
                                            <el-table-column
                                                prop=""
                                                label="文章名"
                                                width="200px"
                                                align="center"
                                            >
                                                <template slot-scope="scope">
                                                    <nuxt-link :to="'/post/'+scope.row.post_id">
                                                        <span>{{ scope.row.post_title }}</span>
                                                    </nuxt-link>
                                                </template>

                                            </el-table-column>

                                            <el-table-column
                                                prop="post_price"
                                                label="金额"
                                                width="115px"
                                                align="center"
                                            >
                                            </el-table-column>
                                            <el-table-column align="center" label="支付方式"
                                                             width="105px">
                                                <template slot-scope="scope">
                                                    <span>{{ scope.row.payment | paymentFilter }}</span>
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                label="订单支付状态"
                                                width="200px"
                                                align="center"
                                            >
                                                <template slot-scope="scope">
                                                    <span>{{ scope.row.state | statusFilter }}</span>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                        <div class="order-yema">
                                            <el-pagination background
                                                           layout="prev, pager, next"
                                                           v-show="total>0"
                                                           :total="total"
                                                           :page-size="limit"
                                                           @size-change="handleSizeChange"
                                                           @current-change="handleCurrentChange">
                                            </el-pagination>
                                        </div>

                                    </div>
                                </div>
                            </section>
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
import {postordes} from '~/plugins/index';
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
    3:{
      text:"积分"
    },
    4: {
        text: "微信"
    },
    5: {
        text: "支付宝"
    }
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
    name: "order",
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
    },
    data() {
        return {
            //用户信息
            member: {},
            //日期选择器
            value1: [],
            total:0,
            CashData: [{}],
            allCashData: [{}],
            num: null,
            loadings: true,
            title: '交易记录',
            drawer:false,
            verify_info:'',
            user_pic:'',
            page: 1,
            limit: 10,
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
            const order = await postordes();
            this.CashData = order.orders;
            this.allCashData = order.orders;
            this.total = order.count;
            this.loadings = false;
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
    methods: {
        // 初始页currentPage、初始每页数据数pagesize和数据data
        handleSizeChange: function (size) {
            this.pagesize = size;
        },
        handleCurrentChange: function (val) {
            this.loadings = true;
            this.page = val;
            return axios.get(`/api/postordes`, {
                params: {
                    page: this.page,
                    limit: this.limit,
                }
            }).then(res => {
                this.loadings = false;
                this.CashData = res.data.orders;
                this.total = res.data.count
            })
        },
        //时间戳转化
        rTime(date) {
            var json_date = new Date(date).toJSON();
            return new Date(+new Date(json_date) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '')
        },
        // 选择时间快捷键
        selectDate(num) {
            this.num = num;
            this.value1 = []
            const end = new Date();
            const start = new Date();
            start.setTime(start.setHours(0, 0, 0, 0) - 3600 * 1000 * 24 * num);
            end.setTime(end.getTime());
            if (num == 1) {
                end.setTime(end.setHours(0, 0, 0, 0) - 1);
            }
            if (num == 0) {
                start.setHours(0, 0, 0, 0);
            }
            this.value1.push(start)
            this.value1.push(end)
        },

        //查询
        async imtScreen() {
            this.loadings=true;
            //判断是否输入时间区间
            if (!this.value1[0] || !this.value1[1]) {
                this.$message({
                    type: 'warning',
                    message: "请选择时间区间！"
                })
            } else {
                //获取全部表格数据
                const order = await postordes();
                this.allCashData = order.orders;

                const stime = this.value1[0].getTime();
                const etime = this.value1[1].getTime();

                //将筛选后的数据赋值给 allTableDate
                this.CashData = this.allCashData.filter(item => {
                    //筛选后得到的数据 item 中包含数据日期 date
                    //创建一个数组 date，存储得到的item.date
                    let date = new Date(item.created_at);
                    let time = date.getTime();
                    return time >= stime && time <= etime;
                });
            }
            this.loadings=false;

        },
        async Reset() {
            this.num = null;
            this.value1 = [];
            this.CashData = this.allCashData
        },
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

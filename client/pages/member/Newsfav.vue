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
                            <section class="record__record_wrap__2mgJr route-fade-enter-done">
                                <div class="record__topWrap__1tQ54">
                                    <div class="record__title__12946">
                                        <h3>我的文章</h3><span>当前系统支持查询最近30日的文章</span>
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
                                <div class="YBTransition">
                                    <div class="record__tableWrap__23J92">
                                        <div class="record__tableWrap__23J92-span" v-if="posttable==''">
                                            <p><img src="@/assets/images/empty.png" alt=""></p>
                                            <span>暂未发布文章</span>
                                        </div>
                                        <ul class="box-list clearfix code-list mybox-list">
                                            <el-row :gutter="20"  v-loading="loadings">
                                                <el-col :xs="12" :sm="12" :md="4" :lg="6" :xl="6" :span="6"
                                                        v-for="(item,k) in posttable">
                                                    <li class="my_edit">
                                                        <el-button icon="el-icon-edit" circle @click="edit(item.id)"></el-button>
                                                        <nuxt-link :to="'/post/'+item.id">
                                                            <div class="cover-img-center-max coverimg-li">
                                                                    <img :src="item.cover" alt="">
                                                            </div>
                                                        </nuxt-link>
                                                        <nuxt-link :to="'/category/'+item.other">
                                                            <div class="tag-span-tool">
                                                                <nuxt-link :to="'/category/'+item.other">
                                                                    <span class="el-tooltip today-update v-3 item"></span>
                                                                    <span class="cate_name">{{ item.name }}</span>
                                                                </nuxt-link>
                                                                <span class="float-right">{{ formatDate(item.create_time) }}</span>                                                            </div>
                                                        </nuxt-link>
                                                        <nuxt-link :to="'/post/'+item.id">
                                                            <div class="li-tit">
                                                                {{ item.title }}
                                                            </div>
                                                        </nuxt-link>
                                                        <div class="desc-li">
                                                            <div class="author-bar">
                                                                <nuxt-link :to="'/user/'+item.author_id">
                                                                    <span><img :src="item.pic" alt=""></span>
                                                                    <span>{{ item.userInfo }}</span>
                                                                </nuxt-link>
                                                            </div>
                                                            <div class="cont-bar">
                                                                <span><i class="iconfont icon-liulan"></i>{{
                                                                        item.view
                                                                    }}</span>
                                                                <span><i class="iconfont icon-shoucang4"></i>{{
                                                                        item.likes
                                                                    }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </el-col>
                                            </el-row>
                                        </ul>
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
import {userpost} from '~/plugins/index';
import axios from "axios";

const
    s = 1000,
    m = 60 * s,
    h = 60 * m,
    d = 24 * h,
    mo = 30 * d,
    y = 365 * d

const fdate = [
    {
        time: y,
        text: '年'
    }, {
        time: mo,
        text: '月'
    }, {
        time: d,
        text: '天'
    }, {
        time: h,
        text: '小时'
    }, {
        time: m,
        text: "分钟"
    }, {
        time: s,
        text: '秒'
    }
];
export default {
    auth:true,
    name: "Newsfav",
    components: {
        person_left
    },
    data() {
        return {
            //用户信息
            member: {},
            //日期选择器
            value1: [],
            posttable: [],
            all_posttable: [],
            num: null,
            title: '我的文章',
            drawer:false,
            verify_info:'',
            user_pic:'',
            page: 1,
            limit: 8,
            total:0,
            loadings:false,
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
        }
    },
    async asyncData({app}) {
        let [listA,listB,listC] = await Promise.all([
            app.$axios.$post("/api/userpost"),
            app.$axios.$get(`/api/get_verify_auth`),
            app.$axios.$post("/api/get_user_avatar"),
        ])
        return {
            posttable: listA.post,
            all_posttable: listA.post,
            total:listA.count,
            verify_info:listB.data,
            user_pic:listC.data
        }
    },
    methods: {
        edit(ids){
            this.$router.push('/member/edit/'+ids);
        },
        formatDate(value) {
            const time = Date.now() - new Date(value)
            for (let i = 0; i < fdate.length; i++) {
                const t = time / fdate[i].time
                if (t >= 1) {
                    return Math.floor(t) + fdate[i].text + '前'
                }
            }
        },
        // 初始页currentPage、初始每页数据数pagesize和数据data
        handleSizeChange: function (size) {
            this.pagesize = size;
        },
        handleCurrentChange: function (val) {
            this.loadings = true;
            this.page = val;
            return axios.get(`/api/userpost`, {
                params: {
                    page: this.page,
                    limit: this.limit,
                }
            }).then(res => {
                this.loadings = false;
                this.posttable = res.data.post;
                this.total = res.data.count
            })
            this.loadings=false;
        },
        //时间戳转化
        rTime(date) {
            var json_date = new Date(date).toJSON();
            return new Date(+new Date(json_date) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '')
        },
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
                const stime = this.value1[0].getTime();
                const etime = this.value1[1].getTime();
                //将筛选后的数据赋值给 posttable
                this.posttable = this.all_posttable.filter(item => {
                    //筛选后得到的数据 item 中包含数据日期 date
                    //创建一个数组 date，存储得到的item.date
                    let date = new Date(item.create_time);
                    let time = date.getTime();
                    return time >= stime && time <= etime;
                });
            }
            this.loadings=false;
        },
        async Reset() {
            this.num = null;
            this.value1 = [];
            this.posttable = this.all_posttable;
            this.handleCurrentChange(1);
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

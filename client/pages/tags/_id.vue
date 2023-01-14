<template>
    <div>
        <div class="boxTop">
            <div class="circle-info">
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div class="main">
                <div class="row topshowbox">
                    <div class="col-12">
                        <div class="ListTit">
                            {{ '标签内容：'+tops }} <span class="badge badge-pill badge-primary timer"
                                                  :data-to="{total}">{{ total }}</span>
                        </div>
                        <div class="ListTitTips">
                            查询精准1比1的标签字符串，输出带有该标签的文章！
                        </div>
                    </div>
                    <div class="col-6">

                    </div>
                </div>
                <div class="row CheckBoxM">
                    <div class="col-6">
                        <el-radio v-model="selradio" label="1" @click="vip_select(selradio)">全部</el-radio>
                        <el-radio v-model="selradio" label="2" @click="vip_select(selradio)">免费</el-radio>
                        <el-radio v-model="selradio" label="3" @click="vip_select(selradio)">付费</el-radio>
                        <el-radio v-model="selradio" label="4" @click="vip_select(selradio)">会员免费</el-radio>
                        <el-radio v-model="selradio" label="5" @click="vip_select(selradio)">会员优惠</el-radio>
                    </div>
                    <div class="col-6">
                        <div class="rankorderbox">
                            <span v-for='(data,key,index) in datas' @click="addClassFun(index)"
                                  :class='{active:index==datas_index}'>{{ data.data }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main">
            <ul class="box-list" v-loading="loadings">
                <Notfound v-if="content==''"></Notfound>
                <el-row :gutter="20">
                    <el-col :xs="12" :sm="6" :md="4" :lg="6" :xl="6" :span="6" v-for="(item,k) in content" :key="k" :class="delay(k)"
                            class="list-animation-leftIn">
                        <li>
                            <nuxt-link :to="'/post/'+item.goods[0].id">
                                <div class="cover-img-center-max coverimg-li">
                                    <div class="cover-img-center-max coverimg-li">
                                        <img :src="item.goods[0].cover" alt="" :class="delay(k)">
                                    </div>
                                </div>
                            </nuxt-link>
                            <div class="tag-span-tool">
                                <nuxt-link :to="'/category/'+item.cateid">
                                    <span class="el-tooltip today-update v-3 item"></span>
                                    <span class="cate_name">{{ item.catename }}</span>
                                </nuxt-link>
                                <span class="float-right">{{ formatDate(item.goods[0].create_time) }}</span>
                            </div>
                            <nuxt-link :to="'/post/'+item.goods[0].id">
                                <div class="li-tit">
                                    {{ item.goods[0].title }}
                                </div>
                            </nuxt-link>
                            <div class="desc-li">
                                <div class="author-bar">
                                    <span><img :src="item.pic" alt=""></span>
                                    <span>{{ item.name }}</span>
                                </div>
                                <div class="cont-bar">
                                    <span><i class="iconfont icon-liulan8"></i>{{ item.goods[0].view }}</span>
                                    <span><i class="iconfont icon-shoucang4"></i>{{ item.goods[0].likes }}</span>
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
        <!--details_two -->
    </div>
</template>

<script>
import {tags_page} from '~/plugins/index'
import {details_portal_select} from '~/plugins/index'
import axios from 'axios'
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
    auth:false,
    name: "tags",
    data() {
        return {
            tops: '',
            content: [],
            total: 0,
            loadings: false,
            datas: {
                data1: {
                    data: "最新",
                    ifAdd: 0
                },
                data2: {
                    data: "精选",
                    ifAdd: 1
                },
                data3: {
                    data: "热门",
                    ifAdd: 2
                }
            },
            selradio: "1",
            datas_index: "0",
            title: '',
            page: 1,
            limit: 20,
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app, params}) {
        let [listA] = await Promise.all([
            app.$axios.$get(`/api/tags`, {params: {other: params.id}}),
        ])
        return {
            content: listA.content,
            total: listA.number,
            title: '标签内容:'+params.id,
            tops:params.id
        }
    },

    watch: {
        selradio(val, newval) {
            this.vip_select(val);
        }
    },
    methods: {
        handleSizeChange(val) {
            console.log(`每页 ${val} 条`);
        },
        handleCurrentChange(val) {
            this.loadings = true;
            this.page = val;
            if (this.selradio == 1) {
                tags_page(this.$route.params.id, this.page, this.limit).then(response => {
                    this.content = response.content;
                    this.total = response.number;
                    this.loadings = false
                })
            } else if (this.selradio == 2) {
                this.vip_select(2, this.page);
            } else if (this.selradio == 3) {
                this.vip_select(3, this.page);
            } else if (this.selradio == 4) {
                this.vip_select(4, this.page);
            } else if (this.selradio == 5) {
                this.vip_select(5, this.page);
            } else if (this.datas_index == 0) {
                this.addClassFun(0, this.page);
            } else if (this.datas_index == 1) {
                this.addClassFun(1, this.page);
            } else if (this.datas_index == 2) {
                this.addClassFun(2, this.page);
            }

        },
        delay(index) {
            return 'delay-' + index;
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
        async addClassFun(index, page) {
            if (page == '') {
                this.page = 1;
            }
            this.page = page;
            this.datas_index = index;
            if (index == 0) {
                this.loadings = true;
                return axios.get(`/api/tags`, {
                    params: {
                        other: this.$route.params.id,
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;

                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 1) {
                this.loadings = true;
                return axios.get(`/api/tags_select`, {
                    params: {
                        other: this.$route.params.id,
                        page: this.page,
                        limit: this.limit,
                        types: 'most'
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 2) {
                this.loadings = true;
                return axios.get(`/api/tags_select`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'hot',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            }
        },
        // vip select
        async vip_select(index, page) {
            if (page == '') {
                this.page = 1;
            }
            this.page = page;
            this.datas_index = index;
            if (index == 1) {
                this.loadings = true;
                return axios.get(`/api/tags_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'alls',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 2) {
                this.loadings = true;
                return axios.get(`/api/tags_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'free',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 3) {
                this.loadings = true;
                return axios.get(`/api/tags_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'money',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 4) {
                this.loadings = true;
                return axios.get(`/api/tags_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'vipFree',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 5) {
                this.loadings = true;
                return axios.get(`/api/tags_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'vipDiscount',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            }
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

<style>
.el-radio {
    margin-right: 15px;
}

.el-pagination {
    text-align: center;
    margin: 10px;
}

.el-col-6 {
    margin-bottom: 20px;
}
</style>


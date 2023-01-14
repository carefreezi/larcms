<template>
    <div>
        <div class="cateAll" v-if="is_shows">
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
                                {{ tops.name }} <span class="badge badge-pill badge-primary timer"
                                                      :data-to="{total}">{{ total }}</span>
                            </div>
                            <div class="ListTitTips">
                                {{ tops.description }}
                            </div>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                    <div class="row CheckBoxM">
                        <div class="col-12">
                            <div is-tempatecenter="true" class="template-label-filtering">
                                <div class="lar-search-template-filters__tags" v-if="children_cate.length>0"> <i class="el-icon-menu"></i><span
                                    class="lar-tags_label"> 选择分类： </span>
                                    <div class="lar-tags_groups" style="height:38px;">
                                        <ul class="lar-tags_groups-con">
                                            <nuxt-link :to="'/category/'+item.other" class="lar-tags_item" :class="item.other==other?'active':''" v-for="(item,index) in children_cate">
                                                {{item.name}}
                                            </nuxt-link>
                                        </ul>
                                    </div>
                                </div>
                                <div class="filters_line" v-if="children_tags.length>0 && children_cate.length>0"></div>
                                <div class="lar-search-template-filters__tags" v-if="children_tags.length>0"><i class="iconfont icon-tag-fill1"></i><span
                                    class="lar-tags_label"> 选择标签： </span>
                                    <div class="lar-tags_groups" style="height:38px;">
                                        <ul class="lar-tags_groups-con">
                                            <nuxt-link :to="'/tags/'+item" class="lar-tags_item" :class="item.other==other?'active':''" v-for="(item,index) in children_tags">
                                                {{item}}
                                            </nuxt-link>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row CheckBoxM">
                        <div class="col-6">
                            <div class="mobile_show">
                                <el-radio v-model="selradio" label="1" @click="vip_select(selradio)">全部</el-radio>
                                <el-radio v-model="selradio" label="2" @click="vip_select(selradio)">免费</el-radio>
                                <el-radio v-model="selradio" label="3" @click="vip_select(selradio)">付费</el-radio>
                                <el-radio v-model="selradio" label="4" @click="vip_select(selradio)">会员免费</el-radio>
                                <el-radio v-model="selradio" label="5" @click="vip_select(selradio)">会员优惠</el-radio>
                            </div>
                            <el-dropdown class="mobile_hide category_selects">
                                  <span class="el-dropdown-link">
                                    筛选数据<i class="el-icon-arrow-down el-icon--right"></i>
                                  </span>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item @click.native="change_sel('1')">全部</el-dropdown-item>
                                    <el-dropdown-item @click.native="change_sel('2')">免费</el-dropdown-item>
                                    <el-dropdown-item @click.native="change_sel('3')">付费</el-dropdown-item>
                                    <el-dropdown-item @click.native="change_sel('4')">会员免费</el-dropdown-item>
                                    <el-dropdown-item @click.native="change_sel('5')">会员优惠</el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
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
                <div class="choose_type code" v-if="tops.type==1">
                    <ul class="box-list" v-loading="loadings" >
                        <Notfound v-if="content==''"></Notfound>
                        <el-row :gutter="20">
                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6" :span="6" v-for="(item,k) in content" :key="k" :class="delay(k)"
                                    class="list-animation-leftIn">
                                <li>
                                    <nuxt-link :to="'/post/'+item.post_get[0].id">
                                        <div class="cover-img-center-max coverimg-li">
                                            <span class="pack_p_rt" v-if="parseFloat(item.post_get[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                            <img v-lazy="item.post_get[0].cover" alt="" :class="delay(k)">
                                        </div>
                                    </nuxt-link>
                                    <div class="tag-span-tool">
                                        <nuxt-link :to="'/category/'+item.category[0].other">
                                            <span class="el-tooltip today-update v-3 item"></span>
                                            <span class="cate_name">{{ item.category[0].name }}</span>
                                        </nuxt-link>
                                        <span class="float-right">{{ formatDate(item.post_get[0].create_time) }}</span>
                                    </div>
                                    <nuxt-link :to="'/post/'+item.post_get[0].id">
                                        <div class="li-tit">
                                            {{ item.post_get[0].title }}
                                        </div>
                                    </nuxt-link>
                                    <div class="desc-li">
                                        <div class="author-bar">
                                            <nuxt-link :to="'/user/'+item.post_get[0].author_id">
                                                <span><img v-lazy="item.post_get[0].pic" alt=""></span>
                                                <span>{{ item.post_get[0].user_info }}</span>
                                            </nuxt-link>
                                        </div>
                                        <div class="cont-bar">
                                            <span><i class="iconfont icon-liulan8"></i>{{ item.post_get[0].view }}</span>
                                            <span><i class="iconfont icon-shoucang4"></i>{{ item.post_get[0].likes }}</span>
                                        </div>
                                    </div>
                                </li>

                            </el-col>

                        </el-row>
                    </ul>
                </div>
                <div class="choose_type sucai" v-if="tops.type==2">
                    <ul class="box-list" v-loading="loadings" >
                        <Notfound v-if="content==''"></Notfound>
                        <el-row :gutter="20">
                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6" :span="6" v-for="(item,k) in content" :key="k" :class="delay(k)"
                                    class="list-animation-leftIn">
                                <li>
                                    <nuxt-link :to="'/post/'+item.post_get[0].id">
                                        <div class="cover-img-center-max coverimg-li">
                                            <span class="pack_p_rt" v-if="parseFloat(item.post_get[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                            <img v-lazy="item.post_get[0].cover" alt="" :class="delay(k)">
                                        </div>
                                    </nuxt-link>
                                    <div class="tag-span-tool">
                                        <nuxt-link :to="'/category/'+item.category[0].other">
                                            <span class="el-tooltip today-update v-3 item"></span>
                                            <span class="cate_name">{{ item.category[0].name }}</span>
                                        </nuxt-link>
                                        <span class="float-right">{{ formatDate(item.post_get[0].create_time) }}</span>
                                    </div>
                                    <nuxt-link :to="'/post/'+item.post_get[0].id">
                                        <div class="li-tit">
                                            {{ item.post_get[0].title }}
                                        </div>
                                    </nuxt-link>
                                    <div class="desc-li">
                                        <div class="author-bar">
                                            <nuxt-link :to="'/user/'+item.post_get[0].author_id">
                                                <span><img v-lazy="item.post_get[0].pic" alt=""></span>
                                                <span>{{ item.post_get[0].user_info }}</span>
                                            </nuxt-link>

                                        </div>
                                        <div class="cont-bar">
                                            <span><i class="iconfont icon-liulan8"></i>{{ item.post_get[0].view }}</span>
                                            <span><i class="iconfont icon-shoucang4"></i>{{ item.post_get[0].likes }}</span>
                                        </div>
                                    </div>
                                </li>

                            </el-col>

                        </el-row>
                    </ul>
                </div>
                <div class="choose_type blog" v-if="tops.type==5">
                    <ul class="box-list" v-loading="loadings" >
                        <Notfound v-if="content==''"></Notfound>
                        <el-row :gutter="20">
                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12" :span="12" v-for="(item,k) in content" :key="k" :class="delay(k)"
                                    class="list-animation-leftIn">
                                <article
                                    class="post post-list type-post status-publish format-standard hentry category-blog"
                                >
                                    <div class="entry-media">
                                        <div class="placeholder">
                                            <nuxt-link ref="nofollow" :to="'/post/'+item.post_get[0].id">
                                                <span class="pack_p_rt" v-if="parseFloat(item.post_get[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                                <img
                                                    height="200"
                                                    width="300"
                                                    v-lazy="item.post_get[0].cover"
                                                    :alt="item.post_get[0].title"
                                                    class="thumb"
                                                    style="opacity: 1"
                                                />
                                            </nuxt-link>
                                        </div>
                                    </div>
                                    <div class="entry-wrapper">
                                        <div class="entry-header">
                                            <div class="entry-meta">
                                                <div class="d-none d-lg-block text-xs mb-1">
                                                    <nuxt-link ref="nofollow" :to="'/category/'+item.category[0].other" class="text-muted">
                                                        <span class="el-tooltip today-update v-3 item"></span>
                                                        {{ item.category[0].name }}
                                                    </nuxt-link>
                                                    <span class="post-date fr">{{ formatDate(item.post_get[0].create_time) }} </span>
                                                </div>
                                                <div class="list-body pl-3 pr-3">
                                                    <nuxt-link ref="nofollow" :to="'/post/'+item.post_get[0].id" class="list-title text-sm text-hidden">
                                                        <span class="badge badge-primary"></span>{{ item.post_get[0].title }}
                                                    </nuxt-link>
                                                </div>
                                                <div class="mb-2 mb-md-3 pl-3 pr-3 post-width">
                                                    <div class="d-flex flex-fill align-items-center text-muted text-xs">
                                                        <div class="author-bar">
                                                            <nuxt-link :to="'/user/'+item.post_get[0].author_id">
                                                                <span><img v-lazy="item.post_get[0].pic" alt=""></span>
                                                                <span>{{ item.post_get[0].user_info }}</span>
                                                            </nuxt-link>
                                                        </div>
                                                        <div class="flex-fill"></div>
                                                    </div>
                                                    <div class="d-flex d-flex-middle order-3 text-muted text-xs">
                                                        <div class="d-flex-full"></div>
                                                        <div class="d-flex text-nowrap d-flex-middle">
                                                          <span class="mr-2"
                                                          ><i class="heimao hm-eyepageview"></i>
                                                            {{ item.post_get[0].view }}
                                                          </span>
                                                            <span class="mr-2"
                                                            ><i class="heimao hm-aixin-"></i>
                                                            {{ item.post_get[0].likes }}
                                                          </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            </el-col>

                        </el-row>
                    </ul>
                </div>
                <el-pagination background
                               layout="prev, pager, next"
                               v-show="total>0"
                               :total="total"
                               :page-size="limit"
                               :pager-count="5"
                               @size-change="handleSizeChange"
                               @current-change="handleCurrentChange">
                </el-pagination>
            </div>
        </div>
        <Notfound v-if="is_shows==false"></Notfound>
        <!--details_two -->
    </div>
</template>

<script>
import {details_portal} from '~/plugins/index'
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
    name: "Code",
    data() {
        return {
            tops: [],
            content: [],
            children_cate:[],
            children_tags:[],
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
            is_shows:true,
            other:'',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app, params}) {
        try{
            let [listA] = await Promise.all([
                app.$axios.$get(`/api/details_portal`, {params: {other: params.id}}),
            ])
            return {
                tops: listA.top,
                content: listA.content,
                total: listA.number,
                title: listA.top.name,
                other:listA.top.other,
                children_cate:listA.children_cate,
                children_tags:listA.children_tags,
            }
        }catch (error) {
            return{
                is_shows: false
            }
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
                details_portal(this.$route.params.id, this.page, this.limit).then(response => {
                    this.tops = response.top;
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
                return axios.get(`/api/details_portal`, {
                    params: {
                        other: this.$route.params.id,
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 1) {
                this.loadings = true;
                return axios.get(`/api/details_portal_select`, {
                    params: {
                        other: this.$route.params.id,
                        page: this.page,
                        limit: this.limit,
                        types: 'most'
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 2) {
                this.loadings = true;
                return axios.get(`/api/details_portal_select`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'hot',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            }
        },
        change_sel(val){
            this.vip_select(val);
            this.selradio=val;
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
                return axios.get(`/api/details_portal_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'alls',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 2) {
                this.loadings = true;
                return axios.get(`/api/details_portal_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'free',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 3) {
                this.loadings = true;
                return axios.get(`/api/details_portal_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'money',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 4) {
                this.loadings = true;
                return axios.get(`/api/details_portal_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'vipFree',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
                    this.content = res.data.content;
                    this.total = res.data.number
                })
            } else if (index == 5) {
                this.loadings = true;
                return axios.get(`/api/details_portal_Vipselect`, {
                    params: {
                        other: this.$route.params.id,
                        types: 'vipDiscount',
                        page: this.page,
                        limit: this.limit,
                    }
                }).then(res => {
                    this.loadings = false;
                    this.tops = res.data.top;
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


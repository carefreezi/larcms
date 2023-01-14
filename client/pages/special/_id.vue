<template>
    <div>
        <div class="branding">
            <div class="showcase"
                 :style="{backgroundImage:'url(' + special_detail.cover + ')'}"></div>
            <div class="branding-text"><i>「</i>
                <h1>{{ special_detail.name }}</h1> <i>」</i>
                <p>{{ special_detail.description }}</p></div>
        </div>
        <div class="main special-all mt-5 to-top">
            <ul class="box-list clearfix">
                <el-row :gutter="20">
                    <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6" :span="6" v-for="(item,k) in special"
                            class="list-animation-leftIn" :key="k"
                            :class="delay(k)">
                        <li>
                            <nuxt-link ref="nofollow" :to="'/post/'+item.id">
                                <div class="cover-img-center-max coverimg-li">
                                    <div class="cover-img-center-max coverimg-li">
                                        <img :src="item.postcover" :alt="item.title">
                                    </div>
                                </div>
                            </nuxt-link>
                            <div class="tag-span-tool">
                                <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                    <span class="el-tooltip today-update v-3 item"></span>
                                    <span class="cate_name">{{ item.name }}</span>
                                </nuxt-link>
                                <span class="float-right">{{ formatDate(item.create_time) }}</span>
                            </div>
                            <nuxt-link ref="nofollow" :to="'/post/'+item.id">
                                <div class="li-tit">
                                    {{ item.title }}
                                </div>
                            </nuxt-link>
                            <div class="desc-li">
                                <div class="author-bar">
                                    <nuxt-link :to="'/user/'+item.author_id">
                                        <span><img :src="item.pic" :alt="item.title"></span>
                                        <span>{{ item.userinfo }}</span>
                                    </nuxt-link>
                                </div>
                                <div class="cont-bar">
                                    <span><i class="iconfont icon-liulan8"></i>{{ item.view }}</span>
                                    <span><i class="iconfont icon-shoucang4"></i>{{
                                            item.likes
                                        }}</span>
                                </div>
                            </div>
                        </li>
                    </el-col>
                </el-row>
            </ul>
        </div>
    </div>

</template>

<script>

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
    auth: false,
    name: "special",
    data() {
        return {
            special_detail: '',
            special: '',
            total: 0,
            page: 1,
            limit: 20,
            is_shows: true,
            title: "专题列表",
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app, params}) {
        try {
            let [listA] = await Promise.all([
                app.$axios.$get(`/api/special_other`, {params: {id: params.id}}),
            ])
            return {
                special: listA.special,
                total: listA.count,
                special_detail: listA.special_detail
            }
        } catch (error) {
            return {
                is_shows: false
            }
        }
    },
    methods: {
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

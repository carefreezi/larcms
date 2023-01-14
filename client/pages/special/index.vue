<template>
    <div class="main special-all mt-5">
        <el-row :gutter="10" v-if="special">
            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6" v-for="(item,index) in special">
                <nuxt-link :to="'/special/'+item.other" class="cursor-pointer">
                    <div class="single-special-member">
                        <div class="wrapper">
                            <div class="img-box">
                                <img :src="item.cover" lazy="loaded">
                            </div>
                            <div class="info-meta"><h6 class="name">
                                {{item.name}}
                                <span class="ml-2 text-muted fs-16">
                        ({{item.posts_count}}款)
                      </span></h6></div>
                        </div>
                    </div>
                </nuxt-link>
            </el-col>
        </el-row>
        <Notfound v-if="special.length<=0"></Notfound>
    </div>
</template>

<script>
export default {
    auth:false,
    name: "index",
    data() {
        return {
            special:'',
            total:0,
            page: 1,
            limit: 20,
            is_shows:true,
            title:"专题中心",
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app, params}) {
        try{
            let [listA] = await Promise.all([
                app.$axios.$get(`/api/special`),
            ])
            return {
                special: listA.special,
                total: listA.count,
            }
        }catch (error) {
            return{
                is_shows: false
            }
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

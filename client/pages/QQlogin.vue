<template>
    <div class="main view-1180" style="text-align:center;padding:200px;">
        <i class="el-icon-loading" style="font-size: 40px;"></i>
        <p style="line-height: 60px;">QQ登录正在授权中...</p></div>
</template>
<script>
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
    auth: false,
    name: 'Index',
    layout: 'default',
    data() {
        return {
            state: 0,
            loadings: true,
            title: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    created() {
        if (this.$store.state.auth.loggedIn) {
            this.$router.push('/');
        }
        return axios.post(`/api/socials/qq/authorizations`, {
            code: this.$route.query.code,
            state: this.$route.query.state
        }).then((res) => {
            this.$auth.setToken('local', 'Bearer ' + res.data.data.original.access_token)
            this.$axios.setHeader('Authorization', 'Bearer ' + res.data.data.original.access_token)
            this.$auth.ctx.app.$axios.setHeader('Authorization', 'Bearer ' + res.data.data.original.access_token)
        })
            .then(() => {
                this.$axios.post('/api/me')
                    .then((resp) => {
                        this.$auth.setUser(resp.data);
                        this.$router.go(0)
                    })
            })
            .catch((err) => {
                console.log(err)
            })
    },
    head() {
        return {
            title: this.title,
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
.el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 1;
    margin: 0;
    text-align: center;
    line-height: 0px;
    text-align: center;
    position: absolute;
    top: 50%;
    width: 100%;
    text-align: center;
    z-index: 100;
}

.el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
}

.el-col {
    margin-bottom: 20px;
}
</style>

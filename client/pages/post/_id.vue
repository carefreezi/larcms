<template>
    <div>
        <div v-if="is_shows">
            <details_one v-if="designs.style_type == 1"
                         :title="title"
                         :title_for="title_for"
                         :keywords="keywords"
                         :description="description"
                         :designs = "designs"
                         :authors = "authors"
                         :hot_post="hot_post"
                         :relevants="relevants"
                         :comments="comments"
                         :abstract="abstract"
                         :comment_all="list"
                         @newDesign="newDesign"
                         @newRelevants="newRelevants"
                         @newComment = "newComment"
            ></details_one>
        </div>
        <div v-if="is_shows">
        <!--two style-->
            <details_two v-if="designs.style_type == 2"
                         :title="title"
                         :title_for="title_for"
                         :keywords="keywords"
                         :description="description"
                         :designs = "designs"
                         :authors = "authors"
                         :hot_post="hot_post"
                         :relevants="relevants"
                         :comments="comments"
                         :abstract="abstract"
                         :comment_all="list"
                         @newDesign="newDesign"
                         @newRelevants="newRelevants"
                         @newComment = "newComment"
            >
        </details_two>
        </div>
        <!--two style end-->
        <Notfound v-if="is_shows==false"></Notfound>
    </div>
</template>

<script>
import details_one from './Details_one'
import details_two from './Details_two'
import axios from 'axios'
import {userVip} from '~/plugins/index';
import {payByAlipay} from '~/plugins/index';
import {payByWechat} from '~/plugins/index';
import {payByBlance} from '~/plugins/index';
import {post_payment} from '~/plugins/index';
import {isvip_price} from '~/plugins/index';
import {ispaypost} from '~/plugins/index';
import {likeinfor} from '~/plugins/index';
import {isfollow} from '~/plugins/index';

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
    name: "Details",
    components:{
        details_one,
        details_two
    },
    data() {
        return {
            //用户信息
            is_shows:true,
            member: {},
            designs: {},
            relevants: [],
            dialogLogin: false,
            //作者
            authors: {},
            //用户vip
            vip: {},
            //购买对话框
            dialogVisible: false,
            //支付方式
            payment: '2',
            payment_image: '',
            pays_loading: true,
            types: '2',
            post_prices: '0.00',
            isposts: '',
            is_price_info: true,
            downloading: false,
            loadings: true,
            inurl: '',
            isfollows: '',
            islogin: false,
            wechat_qr: '',
            list:[],
            web: '',
            title:'',
            hot_post:'',
            comments:'',
            abstract:'',
            title_for:this.WebConfigs('title'),
            keywords:this.WebConfigs('keywords'),
            description:this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },


    mounted() {
        this.web = window.location.href;
    },
    async asyncData({app, params}) {
        try {
            let [listA,listB] = await Promise.all([
                app.$axios.$get(`/api/details_page`, {params: {id: params.id}}),
                app.$axios.$get(`/api/details_all_comment`, {params: {id: params.id}}),
            ])
            return {
                designs: listA.design,
                relevants: listA.relevant,
                authors: listA.author,
                title:listA.design.title,
                hot_post:listA.hot,
                comments:listA.comment,
                abstract:listA.abstract,
                list : listB.data,
            }
        } catch (error) {
            return{
                is_shows: false
            }
        }
    },

    methods: {
        newComment(data){
          this.comments = data;
        },
        newDesign(data){
            this.designs = data;
        },
        newRelevants(data){
            this.relevants = data;
        },
        async shareHandle() {
            const opts = {
                useCORS: true
            }
            const ele = this.$refs.screenshot
            const canvas = await html2canvas(this.$refs.screenshot, opts)
            this.screenshotImage = canvas.toDataURL('image/jpg')
        },
        success(src) {
            this.img = src
        },
        fail(err) {
            console.log('fail', err)
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
        async isbay() {
            this.dialogVisible = false;
            this.downloading = false;
            const ispost = await ispaypost(this.member.id, this.designs.id);
            this.isposts = ispost.state;
            return axios.get(`/api/details_page`, {params: {id: this.$route.params.id}}).then(res => {
                this.designs = res.data.design;
                this.relevants = res.data.relevant;
                this.authors = res.data.author;
            })
        },
        //关闭对话框
        handleClose(done) {
            done();
            this.isbay()
        },
        recharge(value) {
            this.pays_loading = true;
            this.payment = value;
            //展示二维码
            this.$nextTick(() => {
                this.crateQrcode()
            })
        },
        // 生成二维码
        async crateQrcode() {
            if (this.payment == 1) {
                this.innerVisible = true;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id)
                this.payment_image = Alipay.alipay_url;
                this.pays_loading = false;
            } else if (this.payment == 0) {
                this.innerVisible = true;
                const wechat = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id)
                this.payment_image = wechat.wechat_url;
                this.pays_loading = false;
            } else if (this.payment == 2) {
                this.payment_image = '';
                this.pays_loading = false;
            }
        },
        //
        async weindowurl() {
            //展示二维码
            this.$nextTick(() => {
                this.innerVisible = true;
                this.inurl = window.location.href;
            })
        },
        async wechat_ka() {
            this.$nextTick(() => {
                this.innerVisible = true;
                this.wechat_qr = window.location.href;
            })
        },
        //余额支付
        async payblance() {
            if (this.payment == 2) {
                const that = this;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id);
                this.isbay();
            }

        },
        // 充值会员跳转
        Vips() {
            if (this.$store.state.auth.loggedIn) {
                this.$router.push('/vip')
            } else {
                this.$message.warning('请先登录！')
            }
        },
        async likeinfors(value) {
            if (this.$store.state.auth.loggedIn) {
                const like = await likeinfor(this.member.id, this.designs.id, this.designs.author_id, value)
                if (like.msg == "已取消点赞") {
                    this.designs.likes -= 1;
                } else if (like.msg == "点赞成功") {
                    this.designs.likes += 1;
                }
                const isf = await isfollow(this.member.id, this.designs.author_id)
                this.isfollows = isf.state
            } else {
                this.$message.warning('请先登录!')
            }
        }


    },
    head () {
        return {
            title: this.title+"-"+this.title_for,
            meta: [
                { name: 'keywords', content: this.keywords},
                { hid: 'description', name: 'description', content: this.description}
            ],
            link: [
                { rel: 'icon', type: 'image/x-icon', href: this.ico }
            ]
        }
    }

}
</script>

<style>
.styles__button_group__3Q8uW {
    display: flex;
}

.post-social {
    text-align: right;
}

.btn-light {
    color: #8a92a9;
    background-color: #f4f5f9;
    border-color: #f4f5f9;
}

.btn-rounded {
    border-radius: 4rem;
}

.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}


.btn-icon {
    text-align: center;
    width: 3rem;
    height: 3rem;
    padding: 0 !important;
    position: relative;
    font-size: 1.125rem;
}

.btn-icon.btn-md {
    width: 2.5rem;
    height: 2.5rem;
    font-size: 1rem;
}

.btn-icon span {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
}

.hm-weixin1 {
    font-size: 22px;
}

.tags {
    line-height: 5px;
    display: block;
    padding: 5px;
    background: #fff;
    border-top: 1px solid #f0f0f0;
}

.tags i {
    font-size: 18px;
    color: #409eff;
    padding: 3px;
    transform: rotate(
        45deg
    );
}

.tags span {
    padding: 5px;
    margin: 3px;
    position: relative;
    font-size: 14px;
    color: #4f4f4f;
}

.tags span:before {
    content: '#';
    width: 6px;
    height: 6px;
    position: absolute;
    left: -6px;
    top: 90%;
    margin-top: -14px;
    border-radius: 12px;
    color: #949494;
}
.share-ilike-tool i{
    font-size: 18px;
}
</style>


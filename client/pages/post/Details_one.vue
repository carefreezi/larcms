<template>
    <div>
        <div class="one_style">
            <div class="boxTop">
                <div class="main">
                    <el-row :gutter="20">
                        <el-col :xs="24" :sm="16" :md="4" :lg="18" :xl="18">
                            <h1 class="GiTit text-hd">
                                {{ designs.title }}
                            </h1>
                            <div class="auther-box">
                                <div class="desmsg-box clearfix">
                                    <div>
                                        <img
                                            :src="authors.pic"
                                            class="authericon-small">
                                    </div>
                                    <div class="anther-nick">
                                        {{ authors.name }}
                                    </div>
                                    <div class="tagguanzhubox" @click="likeinfors(0)">
                                        <span v-if="isfollows==1" class="tag-guanzhu tag-guanzhu-yes "><i
                                            class="iconfont icon-yiguanzhuren"></i> 已关注</span>
                                        <span v-if="isfollows==0" class="tag-guanzhu tag-add"> <i
                                            class="iconfont icon-jiaguanzhuren"></i> 关注</span>
                                    </div>
                                    <div class="desl-time">
                                        {{ designs.create_time }}
                                    </div>
                                    <div class="desc-msg">
                                        {{ abstract }}
                                    </div>
                                </div>
                            </div>
                            <div class="price-box">
                                <span class="vip-so" v-if="designs.vip_price && designs.vip_price!=0">会员￥<span class="bue">{{
                                        designs.vip_price
                                    }}</span></span>
                                <span class="vip-so" v-if="designs.vip_price==0">会员￥<span class="bue">免费</span></span>
                                <span class="novip-so" v-if="designs.price !=null">原价￥<span class="bue">{{
                                        designs.price
                                    }}</span></span>
                                <span class="novip-so" v-if="designs.integral !=null">积分￥<span class="bue">{{
                                        designs.integral
                                    }}</span></span>
                            </div>
                            <el-row :gutter="20">
                                <el-col :xs="8" :sm="6" :md="4" :lg="20" :xl="20" class="tool-view">
                                    <el-link :underline="false" target="_blank" :href="designs.show_url"
                                             v-if="designs.show_url!=null">
                                        <i class="iconfont icon-lianjie"></i> 演示网站
                                    </el-link>
                                    <el-popover
                                        placement="bottom"
                                        width="125"
                                        trigger="hover"
                                    >
                                        <div class="paycode" style="text-align: center">
                                            <vue-qr class="bicode" :logoScale="20" :margin="0" :dotScale="1"
                                                    :text="inurl" :size="125">
                                            </vue-qr>
                                        </div>
                                        <a slot="reference" target="_blank" class="phoneCode" @mousemove="weindowurl()">
                                            <i class="iconfont icon-ico"></i>手机扫码
                                        </a>
                                    </el-popover>

                                </el-col>
                                <el-col :xs="8" :sm="6" :md="4" :lg="4" :xl="4" class="IlikeBar">
                                    <div>
                                        <i class="iconfont icon-shoucang ilikei"></i>
                                    </div>
                                    <div class="ilikesum">
                                        {{ designs.likes }}
                                    </div>
                                </el-col>
                            </el-row>
                        </el-col>
                        <el-col :xs="24" :sm="8" :md="4" :lg="6" :xl="6">
                            <div class="btn-down-box">
                                <div class="btn-groupdown">
                                    <el-button class="download-jifen-btn" :loading="downloading" type="primary"
                                               @click="dialogLogin = true ;" v-if="islogin==false">
                                        <i class="el-icon el-icon-wallet"></i> 请登录后购买
                                    </el-button>
                                    <el-button class="download-jifen-btn" :loading="downloading" type="primary"
                                               @click="downloading=true;dialogVisible = true ;recharge(payment)"
                                               v-if="post_prices!=0&&isposts!=1&&post_prices!=null&&islogin==true">
                                        <i class="el-icon el-icon-wallet"></i> 立即购买 {{ post_prices }}元
                                    </el-button>
                                    <el-button type="primary" class="download-jifen-btn" @click="payblance(2)" :loading="downloading"
                                               v-if="post_prices==0&&isposts!=1&&islogin==true">
                                        <i class="el-icon el-icon-wallet"></i> 立即购买 {{ post_prices }}元
                                    </el-button>
                                    <el-button type="primary" class="download-jifen-btn" @click="payblance(3)" :loading="downloading"
                                               v-if="designs.integral!=null&&isposts!=1&&post_prices==null&&islogin==true">
                                        <i class="el-icon el-icon-wallet"></i> 立即购买 {{ designs.integral }}积分
                                    </el-button>
                                    <el-popover
                                        placement="top-start"
                                        title="扩展内容"
                                        width="200"
                                        trigger="hover"
                                        v-if="isposts==1"
                                    >
                                        <span>提取码：{{ designs.extraction_code }}</span><br>
                                        <span>解压码：{{ designs.extract_code }}</span>
                                        <el-link slot="reference" :underline="false" target="_blank"
                                                 :href="designs.download_url" style="display: block">
                                            <el-button type="primary" class="download-jifen-btn">
                                                <i class="iconfont icon-xiazai"></i> 立即下载
                                            </el-button>
                                        </el-link>
                                    </el-popover>
                                    <el-button type="primary" class="download-jifen-btn"
                                               v-if="post_prices==null&&designs.vip_price==null&&designs.integral==null&&isposts!=1">
                                        <i class="iconfont icon-xiazai"></i> 无资源下载
                                    </el-button>

                                    <el-dialog
                                        title="立即购买"
                                        :visible.sync="dialogVisible"
                                        width="30%"
                                        :before-close="handleClose"
                                        :close-on-click-modal="false" center
                                        append-to-body
                                    >
                                        <div class="paycode" v-loading="pays_loading" style="text-align: center">
                                            <vue-qr class="bicode" :logoScale="20" :margin="0" :dotScale="1"
                                                    :text="payment_image" v-if="payment_image!=''">
                                            </vue-qr>
                                        </div>
                                        <div class="styles__withdrawal_way_content__3_3g0">
                                            <div class="styles__title__9Akaq">支付方式</div>
                                            <div class="styles__button_group__3Q8uW">
                                                <div :class="{'styles__active__1DnYl':payment==0}"
                                                     v-if="zf_way=='gf'"
                                                     @click=" recharge(0)"><i></i><span>微信</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==1}"
                                                     v-if="zf_way=='gf'"
                                                     @click=" recharge(1)"><i></i><span>支付宝</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==4}"
                                                     v-if="zf_way=='yzf'"
                                                     @click=" recharge(4)"><i></i><span>微信</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==5}"
                                                     v-if="zf_way=='yzf'"
                                                     @click=" recharge(5)"><i></i><span>支付宝</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==2}"
                                                     @click=" recharge(2)"><i></i><span>余额</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==3}"
                                                     v-if="designs.integral!=null"
                                                     @click=" recharge(3)"><i></i><span>积分</span></div>
                                            </div>
                                        </div>
                                        <span slot="footer" class="dialog-footer">
                                            <el-button @click="isbay()">取消支付</el-button>
                                            <el-button type="primary" @click="isbay();payblance()">支付成功</el-button>
                                        </span>
                                    </el-dialog>
                                    <el-button type="warning" class="download-jifen-btn vip-down-btn" @click="Vips"
                                               style="margin-left: 0;">
                                        <i class="iconfont icon-huiyuan"></i> 充值 VIP 会员
                                    </el-button>
                                </div>
                                <div class="suicai-tips" v-if="designs.vip_name">
                                    <p>仅限{{ designs.vip_name }}以上享受会员价</p>
                                </div>
                            </div>
                        </el-col>
                    </el-row>
                </div>
            </div>

            <div class="main content-main">
                <el-row :gutter="10">
                    <el-col :xs="24" :sm="24" :md="4" :lg="18" :xl="18">
                        <div class="leftContent">
                            <div class="main_content_left">
                                <viewer>
                                    <div class="content-deatils" v-html="designs.content"></div>
                                </viewer>
                                <!--分享点赞-->
                                <div class="row  d-flex justify-content-center share-ilike-tool">
                                    <div class="col-1" @click="likeinfors(2)">
                                        <div>
                                            <i class="el-icon el-icon-star-off"></i>
                                        </div>
                                        <div>
                                            收藏文章
                                        </div>
                                    </div>
                                    <div class="col-1" @click="likeinfors(1)">
                                        <div class="icon-zan-content clearfix">
                                            <i class="iconfont icon-dianzan zan-btn-i">
                                                <span class="zan-numver">{{ designs.likes }}</span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="col-1 div-sharebox">
                                        <el-popover
                                            placement="top-start"
                                            title=""
                                            width="100%"
                                            trigger="hover"
                                            align="center"
                                        >
                                            <div class="shareBox social-share clearfix">
                                                <!--share content-->
                                                <div class="api" slot="content">
                                                    <div class="post-social">
                                                        <a :href="'https://connect.qq.com/widget/shareqq/index.html?url='+web+'&title='+designs.title+'&summary=内容'"
                                                           target="_blank"
                                                           class="btn btn-light btn-icon btn-qq btn-rounded btn-md"><span><i
                                                            class="heimao hm-icon"></i></span></a>
                                                        <a :href="'http://v.t.sina.com.cn/share/share.php?url='+web+'&title='+designs.title+'&summary=内容'"
                                                           target="_blank"
                                                           class="btn btn-light btn-icon btn-weibo btn-rounded btn-md"><span><i
                                                            class="heimao hm-weibo1"></i></span></a>
                                                        <el-popover
                                                            placement="top-start"
                                                            title="扫码分享到微信"
                                                            width="100%"
                                                            trigger="hover"
                                                        >
                                                            <div>
                                                                <div slot="title" style="text-align: center;">
                                                                    <div
                                                                        class="ivu-modal-confirm-head-icon ivu-modal-confirm-head-icon-success">
                                                                        <i class="ivu-icon ivu-icon-ios-checkmark-circle"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="api" slot="content">
                                                                    <vue-qr class="bicode" :logoScale="20" :margin="0"
                                                                            :dotScale="1"
                                                                            :text="web" :size="125">
                                                                    </vue-qr>
                                                                </div>
                                                            </div>
                                                            <a href="javascript:;" @mouseover="wechat_ka"
                                                               slot="reference"
                                                               class="btn btn-light btn-icon btn-weixin btn-rounded btn-md"><span><i
                                                                class="heimao hm-weixin1"></i></span></a>
                                                        </el-popover>
                                                        <a :href="'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+web+'&title='+designs.title+'&summary=内容'"
                                                           class="btn btn-light btn-icon btn-qzone single-popup btn-rounded btn-md"><span><i
                                                            class="heimao hm-qqkongjian"></i></span></a>
                                                        <a :href="'https://www.facebook.com/sharer.php?u='+web+'&title='+designs.title+'&summary=内容'"
                                                           target="_blank"
                                                           class="btn btn-light btn-icon btn-facebook btn-rounded btn-md"><span><i
                                                            class="heimao hm-Facebook1"></i></span></a>
                                                        <a :href="'https://twitter.com/intent/tweet?url='+web+'&title='+designs.title+'&summary=内容'"
                                                           target="_blank"
                                                           class="btn btn-light btn-icon btn-twitter btn-rounded btn-md"><span><i
                                                            class="heimao hm-ttww"></i></span></a>
                                                        <a :href="'https://www.linkedin.com/shareArticle?mini=true&amp;url='+web+'&title='+designs.title+'&summary=内容'"
                                                           target="_blank"
                                                           class="btn btn-light btn-icon btn-linkedin btn-rounded btn-md"><span><i
                                                            class="heimao hm-LinkedinIn"></i></span></a>
                                                    </div>
                                                </div>
                                                <!--share content-->
                                            </div>
                                            <div slot="reference">
                                                <div slot="reference">
                                                    <i class="el-icon el-icon-position"></i>
                                                </div>
                                                <div>
                                                    乐于分享
                                                </div>
                                            </div>
                                        </el-popover>
                                    </div>
                                </div>
                            </div>
                            <div class="tags" v-if="designs.tags!='[]'&&designs.tags!=null">
                                <i class="el-icon el-icon-discount"></i>
                                <span v-for="(element, index) in JSON.parse(designs.tags)" rel="tag">
                                            <nuxt-link :to="'/tags/'+element">
                                                {{ element }}
                                            </nuxt-link>
                                        </span>
                            </div>
                            <!--comment user-->
                            <div class="comments">
                                <div class="app-comments">
                                    <el-form ref="form" :model="comment" label-width="0px" id="app-comment-form">
                                        <img v-if="islogin==false" id="user-avatar"
                                             src="@/assets/index/images/avater/default1.png">
                                        <img v-else id="user-avatar"
                                             :src="member.pic">
                                        <div class="app-group">
                                            <div class="comment-box">
                                                <div class="emoji-box">
                                                    <el-form-item>
                                                        <el-input type="textarea" :rows="4"
                                                                  placeholder="说点什么吧~"
                                                                  class="app-control reply-comment-textarea"
                                                                  v-model="comment.contents"></el-input>
                                                    </el-form-item>
                                                    <el-button size="small" type="primary" @click="commit_sub"
                                                               placeholder="说点什么吧~">提交评论
                                                    </el-button>
                                                </div>
                                            </div>
                                        </div>
                                    </el-form>
                                    <div class="comment-box">
                                        <ul class="comment">
                                            <ul class="comments-list">
                                                <detail-list :list="comments" :member="member" :comment_all="list" :designs="designs"/>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--comment user end-->
                        </div>

                    </el-col>
                    <el-col :xs="24" :sm="24" :md="8" :lg="6" :xl="6">
                        <div class="rightContent">
                            <section class="widget widget_authorinfo mg-b box b2-radius">
                                <div class="author_box">
                                    <div id="user-widget" class="author_info">
                                        <div class="author-widget-cover">
                                            <img :alt="authors.name"
                                                 :src="authors.cover"
                                                 v-if="authors.cover"
                                                 class="avatar" height="80" width="80" loading="lazy">
                                            <img :alt="authors.name"
                                                 src="@/assets/images/topbanner.png"
                                                 v-else
                                                 class="avatar" height="80" width="80" loading="lazy">
                                        </div>
                                        <div class="author_avatar">
                                            <img :alt="authors.name" :src="authors.pic"
                                                 class="avatar avatar-80 photo"
                                                 height="80" width="80"
                                                 loading="lazy">
                                        </div>
                                        <div class="author_name">
                                            {{ authors.name }}
                                            <span>作者</span>
                                        </div>
                                        <div class="author_des">
                                            {{ authors.description }}
                                        </div>
                                        <div class="author_tongji skt-loading">
                                            <el-row :gutter="10">
                                                <el-col :xs="8" :sm="8" :md="8" :lg="8" :xl="8">
                                                    <div class="author_card">
                                                        <span class="author_card_n" :class="{skeleton:loadings}">{{ author_info }}</span>
                                                        <span class="author_card_t">文章数</span>
                                                    </div>
                                                </el-col>
                                                <el-col :xs="8" :sm="8" :md="8" :lg="8" :xl="8">
                                                    <div class="author_card">
                                                        <span class="author_card_n" :class="{skeleton:loadings}">{{ author_bfans }}</span>
                                                        <span class="author_card_t">关注</span>
                                                    </div>
                                                </el-col>
                                                <el-col :xs="8" :sm="8" :md="8" :lg="8" :xl="8">
                                                    <div class="author_card">
                                                        <span class="author_card_n" :class="{skeleton:loadings}">{{ author_fans }}</span>
                                                        <span class="author_card_t">粉丝</span>
                                                    </div>
                                                </el-col>
                                            </el-row>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="mobile-hidden widget lar-widget-hot mg-b box lar-radius">
                                <div class="lar-widget-title"><h2 class="widget-title"><i
                                    class="larfont lar-yuancircle94 "></i>热门资源
                                </h2></div>
                                <div class="lar-widget-box">
                                    <ul class="lar-widget-list-ul">
                                        <li class="lar-widget-box widget-post" v-for="(item,index) in hot_post">
                                            <div class="lar-widget-post-thumb">
                                                <div class="lar-widget-post-thumb-img">
                                                    <picture class="picture">
                                                        <img class="lar-radius lazy loaded"
                                                             :alt="item.title"
                                                             :src="item.cover"
                                                             data-was-processed="true"></picture>
                                                </div>
                                                <div class="lar-widget-post-title">
                                                    <h2>{{ item.title }}</h2>
                                                    <time>{{ item.create_time }}</time>
                                                </div>
                                            </div>
                                            <nuxt-link ref="nofollow" class="link-overlay"
                                                       :to="'/post/'+item.id"></nuxt-link>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </el-col>
                </el-row>
            </div>
            <Logins :loginto="dialogLogin" @newlogin="newslog"></Logins>
            <div v-html="frame_yzfs" class="display-none">
            </div>
        </div>
    </div>
</template>

<script>
import {details_page} from '~/plugins/index'
import {me} from '~/plugins/index';
import axios from 'axios'
import {userVip} from '~/plugins/index';
import {payByAlipay} from '~/plugins/index';
import {payByWechat} from '~/plugins/index';
import {payByBlance} from '~/plugins/index';
import {post_payment} from '~/plugins/index';
import {isvip_price} from '~/plugins/index';
import {ispaypost} from '~/plugins/index';
import {likeinfor} from '~/plugins/index';
import {isfollow, subComment, replyComment, detail_author} from '~/plugins/index';
import Prism from 'prismjs';
import DetailList from '~/pages/post/comment'
function checkForm(){
    document.getElementById('alipaysubmit').submit();
}
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
    name: "Details_one",
    props: [
        "title",
        "title_for",
        "keywords",
        "description",
        "designs",
        "authors",
        "hot_post",
        "relevants",
        "comments",
        "abstract",
        "comment_all"
    ],
    components: {
        DetailList
    },
    data() {
        return {
            //用户信息
            member: {},
            dialogLogin: false,
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
            downloading: true,
            loadings: true,
            inurl: '',
            isfollows: '',
            islogin: false,
            wechat_qr: '',
            web: '',
            author_info: '',
            author_bfans: '',
            author_fans: '',
            comment: {
                name: '',
                contents: '',
                reply: ''
            },
            click_reply: 0,
            zf_way:this.WebConfigs('pay_is_lar'),
            frame_yzfs:'',
            list:this.comment_all,
        }
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            this.islogin = true;
            const users = this.$store.state.auth.user;
            this.member = users;
            const lavel = await userVip();
            this.vip = lavel.list;
            const ispost = await ispaypost(this.member.id, this.designs.id)
            this.isposts = ispost.state
            const isf = await isfollow(this.member.id, this.designs.author_id)
            this.isfollows = isf.state
            const prcies = await isvip_price(this.vip.id, this.designs.id)
                .catch(() => {
                    this.end = true;
                })
                .finally(() => {
                    this.downloading = false;
                });
            this.post_prices = prcies.post_price;
        } else {
            this.islogin = false;
            this.downloading = false;
        }
        const auth_info = await detail_author(this.designs.author_id)
        this.author_info = auth_info.data;
        this.author_bfans = auth_info.bfans;
        this.author_fans = auth_info.fans;
        this.loadings=false;
    },
    mounted() {
        this.web = window.location.href;
        Prism.highlightAll()

    },

    methods: {
        newslog(data) {
            this.dialogLogin = data
        },
        rTime(date) {
            let json_date = new Date(date).toJSON();
            return new Date(+new Date(json_date) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '')
        },
        show_reply(ids) {
            this.click_reply = ids;
        },
        cancel_res() {
            this.click_reply = 0;
        },
        async reply_sub(ids) {
            if (this.islogin == false) {
                this.$message.warning('请先登录再进行评论!')
            } else if (this.comment.reply == '') {
                this.$message.warning('请填写评论内容!')
            } else {
                const comments = await replyComment(ids, this.member.id, this.designs.id, this.comment.reply);
                this.comment.reply = '';
                return axios.get(`/api/details_page`, {params: {id: this.$route.params.id}}).then(res => {
                    this.$emit('newComment', res.data.comment);
                })
            }
        },
        async commit_sub() {
            if (this.islogin == false) {
                this.$message.warning('请先登录再进行评论!')
            } else if (this.comment.contents == '') {
                this.$message.warning('请填写评论内容!')
            } else {
                const comments = await subComment(this.member.id, this.designs.id, this.comment.contents);
                this.comment.contents = '';
                return axios.get(`/api/details_page`, {params: {id: this.$route.params.id}}).then(res => {
                    this.$emit('newComment', res.data.comment);
                })
            }
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
                this.$emit('newDesign', res.data.design);
                this.$emit('newRelevants', res.data.relevant);
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
            } else if (this.payment == 3) {
                this.payment_image = '';
                this.pays_loading = false;
            }if (this.payment == 5) {
                this.$message.success({
                    dangerouslyUseHTMLString: true,
                    message: '请求加载中，请稍后~',
                    duration:5000
                });
                this.innerVisible = true;
                this.pays_loading = false;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id)
                this.frame_yzfs = Alipay.alipay_url;
                setInterval(checkForm,1000);
            } else if (this.payment == 4) {
                this.$message.success({
                    dangerouslyUseHTMLString: true,
                    message: '请求加载中，请稍后~',
                    duration:5000
                });
                this.pays_loading = false;
                this.innerVisible = true;
                const wechat = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id)
                this.frame_yzfs = wechat.wechat_url;
                setInterval(checkForm,1000);
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
        async payblance(value) {
            if (value == 2) {
                this.payment = 2;
                const that = this;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id, this.designs.integral);
                this.isbay();
            } else if (value == 3) {
                this.payment = 3;
                const that = this;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id, this.designs.integral);
                this.isbay();
            } else if (this.payment == 2) {
                const that = this;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id, this.designs.integral);
                this.isbay();
            } else if (this.payment == 3) {
                const that = this;
                const Alipay = await post_payment(this.post_prices, this.member.id, this.payment, this.types, this.designs.id, this.designs.author_id, this.designs.integral);
                this.isbay();
            }
        },
        // 充值会员跳转
        Vips() {
            if (this.$store.state.auth.loggedIn) {
                this.$router.push('/member/vip')
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
.content-main {
    background: none;
    padding: 0px;
}

.leftContent {
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 3rem;
    width: 100%;
    margin-right: 20px;
    float: left;
}

.rightContent {
    width: 100%;
    float: left;
    border-radius: 4px;
}

.one_style .el-dialog__wrapper {
    line-height: 70px;
}
.one_style .el-col{
    margin-bottom: 0px;
}
</style>

<template>
    <div>
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
                    <div class="centerHead__centerContent__1K_n0" v-loading="loadings">
                        <div class="transiton_container" style="height: auto;">
                            <div class="vip__mainWrap__1vxi4">
                                <section class="vip__headerWrap__1wjFB">
                                    <div class="vip__headerTop__1qsgH">
                                        <div class="vip__userInfo__3qgvo">
                                            <div class="vip__badge__1fC1_ vip__badgeReached"></div>
                                            <div class="vip__user__3Qmiw">
                                                <div class="vip__currentLevel__1EfJY">当前等级:
                                                    {{ vipstatus.vip_status == 0 ? '普通用户' : vip.vip_name }}
                                                </div>
                                                <div class="vip__statistic__3CB7F">
                                                    <span>存款：¥{{ member.balance }}</span></div>
                                            </div>
                                        </div>
                                        <div class="vip__linkToDetail__16g1E" @click="dialog_vip=true">查看VIP介绍</div>

                                        <el-dialog
                                            title="VIP介绍"
                                            :visible.sync="dialog_vip"
                                            width="30%"
                                        >
                                            <el-collapse v-model="activeName" accordion>
                                                <el-collapse-item :title="item.title" :name="index"
                                                                  v-for="(item,index) in vips">
                                                    <div>{{ item.description }}</div>
                                                </el-collapse-item>
                                            </el-collapse>
                                            <span slot="footer" class="dialog-footer">
                                            <el-button type="primary" @click="dialog_vip = false">已查阅</el-button>
                                          </span>
                                        </el-dialog>

                                    </div>
                                    <div class="vip__progressBox__34fli">
                                        <el-steps :active="active" align-center>
                                            <el-step :title="item.vip_name" v-for="(item,index) in page"
                                                     @click.native="invip(item.vip_level,index+1)"></el-step>
                                        </el-steps>
                                    </div>
                                </section>
                                <div class="YBTransition">
                                    <section class="vip__privilegeWrap__2j1JB" v-for="(item ,k) in page"
                                             v-if="atvip==item.vip_level">
                                        <div class="vip__sectionTitle__zvzuf">{{ item.vip_name }}尊享</div>
                                        <div class="vip__privilegeGroup__1jJ18">
                                            <div class="vip__privilegeItem__1HWJj"><img
                                                src="@/assets/images/icon-other-withdrawal.png"
                                                width="60px" height="60px" class="vip__countIcon__3hDBf" style="">
                                                <div class="vip__value__2uQzF">{{ item.downloads }}</div>
                                                <div class="vip__text__3sQH_">每日下载次数</div>
                                            </div>
                                            <div class="vip__privilegeItem__1HWJj"><img
                                                src="@/assets/images/icon-other-withdrawal-amount.png?x-oss-process=image/resize,m_fixed,w_120,h_120/quality,Q_100/format,webp"
                                                width="60px" height="60px" class="vip__limitedIcon__1O3Mc" style="">
                                                <div class="vip__value__2uQzF">{{ item.withdrawal }}</div>
                                                <div class="vip__text__3sQH_">每日提现次数</div>
                                            </div>
                                            <div class="vip__privilegeItem__1HWJj"><img
                                                src="@/assets/images/icon-other-shengjilijin.png?x-oss-process=image/resize,m_fixed,w_120,h_120/quality,Q_100/format,webp"
                                                width="60px" height="60px" class="vip__upgradeIcon__3_Ohm" style="">
                                                <div class="vip__value__2uQzF">{{ item.invitation }}</div>
                                                <div class="vip__text__3sQH_">邀请积分</div>
                                            </div>
                                            <div class="vip__privilegeItem__1HWJj"><img
                                                src="@/assets/images/icon-other-shenglilijin.png?x-oss-process=image/resize,m_fixed,w_120,h_120/quality,Q_100/format,webp"
                                                width="60px" height="60px" class="vip__birthdayIcon__2-77B" style="">
                                                <div class="vip__value__2uQzF">{{ item.birthday }}</div>
                                                <div class="vip__text__3sQH_">生日积分</div>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="vip__upGradeWrap__3gcd_">
                                        <div class="vip__sectionTitle__zvzuf"><span class="vip__titleContent__1ZmLo">VIP充值</span>
                                            <el-popover
                                                placement="top-start"
                                                title="充值说明"
                                                width="200"
                                                trigger="hover"
                                                content="选择需要开通的VIP等级，每个等级有特定的提现次数以及下载次数，超过限制不可下载或提现">
                                                <div class="vip__question__31Jqp" slot="reference"></div>
                                            </el-popover>
                                        </div>
                                        <div class="goods">
                                            <div class="goods-items" v-for="(item ,k) in page"
                                                 :class="{'checked':check==k}"
                                                 @click="chang(k)">
                                                <div class="total">
                                                    <em class="money">{{ item.vip_price }}</em>
                                                    <span class="unit">元</span>
                                                    <span class="unit-price">{{ item.vip_name }}</span>
                                                </div>
                                                <div class="relative-to-total">
                                                    {{ vip_mouthstate(item.vip_day) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="styles__withdrawal_way_content__3_3g0">
                                            <div class="styles__title__9Akaq">充值方式</div>
                                            <div class="styles__button_group__3Q8uW">
                                                <div :class="{'styles__active__1DnYl':payment==0}"
                                                     v-if="zf_way=='gf'"
                                                     @click="recharge(0)"><i></i><span>微信</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==1}"
                                                     v-if="zf_way=='gf'"
                                                     @click="recharge(1)"><i></i><span>支付宝</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==4}"
                                                     v-if="zf_way=='yzf'"
                                                     @click="recharge(4)"><i></i><span>微信</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==5}"
                                                     v-if="zf_way=='yzf'"
                                                     @click="recharge(5)"><i></i><span>支付宝</span></div>
                                                <div :class="{'styles__active__1DnYl':payment==2}"
                                                     @click="recharge(2)"><i></i><span>余额</span></div>
                                            </div>
                                        </div>
                                        <div class="style__whiteBox__Ebttm style__bottomvir__3JYQL">
                                            <el-button type="primary" @click="payOrder()">立即购买</el-button>
                                        </div>
                                        <el-dialog
                                            width="20%"
                                            @close="handleClose"
                                            :visible.sync="innerVisible"
                                            :close-on-click-modal="false" center
                                            append-to-body>
                                            <div slot="title"><span> {{ payment | paymentFilter }}支付</span></div>
                                            <div class="paycode" v-loading="pays_loading" style="text-align: center">
                                                <vue-qr class="bicode" :logoScale="20" :margin="0" :dotScale="1"
                                                        :text="payment_image">
                                                </vue-qr>
                                            </div>
                                            <span slot="footer" class="dialog-footer">
                                                        <el-button @click="handleClose">支付成功</el-button>
                                                    </span>
                                        </el-dialog>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-html="frame_yzfs" class="display-none">
        </div>
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import {me} from '~/plugins/index';
import Cookies from "js-cookie";
import {userVip} from '~/plugins/index';
import {payByAlipay} from '~/plugins/index';
import {payByWechat} from '~/plugins/index';
import {payByBlance} from '~/plugins/index';
import axios from "axios";

function checkForm() {
    document.getElementById('alipaysubmit').submit();
}

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
    4: {
        text: "微信"
    },
    5: {
        text: "支付宝"
    }
};

export default {
    auth: true,
    name: "Vip",
    components: {
        person_left
    },
    filters: {
        paymentFilter(type) {
            return paymentMap[type] ? paymentMap[type].text : "";
        },

    },
    data() {
        return {
            //用户信息
            member: {},
            //
            vip: {},
            page: [],
            vipstatus: '',
            level: '',
            vip_total: '',
            atvip: 0,
            //充值方式
            payment: '0',
            //选择充值vip
            check: '0',
            vipchoice: {},
            //充值二维码
            innerVisible: false,
            payment_image: '',
            //充值类型
            types: '1',
            loadings: true,
            pays_loading: true,
            value2: 0,
            title: 'Vip开通',
            active: 1,
            dialog_vip: false,
            activeName: '1',
            verify_info: '',
            user_pic: '',
            vips: '',
            drawer: false,
            frame_yzfs: '',
            zf_way: this.WebConfigs('pay_is_lar'),
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico: this.WebConfigs('ico')
        }
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.member = users;
            if (this.atvip == 0) {
                this.atvip = 1;
            }
        }
        if (this.WebConfigs('pay_is_lar') == 'gf') {
            this.payment = 0;
        } else {
            this.payment = 4;
        }
    },
    async asyncData({app}) {
        let [listA, listB, listC, listD] = await Promise.all([
            app.$axios.$post("/api/userVip"),
            app.$axios.$get(`/api/get_verify_auth`),
            app.$axios.$get(`/api/get_vipqs`),
            app.$axios.$post("/api/get_user_avatar"),
        ])
        return {
            vipstatus: listA.list,
            page: listA.page,
            vip: listA.user,
            vip_total: listA.page.length,
            atvip: listA.user.vip_level,
            vipchoice: listA.page[0],
            loadings: false,
            verify_info: listB.data,
            vips: listC.vips,
            user_pic: listD.data
        }
    },
    methods: {
        vip_mouthstate(value) {
            let month = value % 30;
            let year = value % 365;
            if (month == 0) {
                let months = value / 30;
                return months + "个月";
            } else if (year == 0) {
                let years = value / 365;
                return years + "年";
            } else if (value == 999999) {
                return '终身会员'
            } else {
                return value + '天';
            }
        },
        //vip计算
        getvip(value) {
            const a = 1 / (this.vip_total - 1);
            return value = value * a * 100;
        },
        invip(value, index) {
            this.active = index;
            return this.atvip = value;
        },
        setvip(value) {
            const a = 1 / (this.vip_total - 1);
            for (var i = 0; i < this.vip_total; i++) {
                if (value == this.page[i].vip_level) {
                    var value2 = i;
                }
            }
            return value2 * a * 100;
        },
        //选择充值方式
        recharge(value) {
            this.payment = value;
        },
        chang(value) {
            this.check = value;
            this.vipchoice = this.page[value];
        },
        _isMobile() {
            let flag = navigator.userAgent.match(/(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i)
            return flag;
        },
        // 展示二维码
        payOrder() {
            this.pays_loading = true;
            if (this.vipstatus.vip_status == 0 || this.vip.vip_level - 1 < this.vipchoice.vip_level) {
                if (this._isMobile() && this.payment == 1) {
                    window.location.href = this.WebConfigs('localhost') + '/api/alipay?amount=' + this.vipchoice.vip_price + '&id=' + this.member.id + '&payment=' + this.payment + '&types=' + this.types
                } else if (this._isMobile() && this.payment == 0) {
                    const number = this.vipchoice.vip_price * 100;
                    window.location.href = this.WebConfigs('localhost') + '/api/wechat?fee=' + number + '&id=' + this.member.id + '&payment=' + this.payment + '&types=' + this.types
                }
                if (this.WebConfigs('alipay_select') == 0 && this.payment == 1) {
                    window.location.href = this.WebConfigs('localhost') + '/api/alipay?amount=' + this.vipchoice.vip_price + '&id=' + this.member.id + '&payment=' + this.payment + '&types=' + this.types
                } else if (this.payment == 4 || this.payment == 5) {
                    this.$message.success({
                        dangerouslyUseHTMLString: true,
                        message: '请求加载中，请稍后~',
                        duration: 5000
                    });
                    this.pays_loading = true;
                    this.$nextTick(() => {
                        this.crateQrcode()
                    })
                } else {
                    // 使用$nextTick确保数据渲染
                    this.$nextTick(() => {
                        this.crateQrcode()
                    })
                }

            } else {
                this.$message({
                    type: 'warning',
                    message: '您的vip等级大于当前购买等级'
                });
            }
        },
        // 生成二维码
        async crateQrcode() {
            if (this.payment == 1) {
                this.innerVisible = true;
                const Alipay = await payByAlipay(this.vipchoice.vip_price, this.member.id, this.payment, this.types)
                this.payment_image = Alipay.alipay_url;
                this.pays_loading = false;
            } else if (this.payment == 0) {
                this.innerVisible = true;
                const number = this.vipchoice.vip_price * 100;
                const wechat = await payByWechat(number, this.member.id, this.payment, this.types)
                this.payment_image = wechat.wechat_url;
                this.pays_loading = false;
            } else if (this.payment == 5) {
                const Alipay = await payByAlipay(this.vipchoice.vip_price, this.member.id, this.payment, this.types)
                this.frame_yzfs = Alipay.alipay_url;
                setInterval(checkForm, 1000);
                this.pays_loading = false;
            } else if (this.payment == 4) {
                const number = this.vipchoice.vip_price * 100;
                const wechat = await payByWechat(number, this.member.id, this.payment, this.types)
                this.frame_yzfs = wechat.wechat_url;
                setInterval(checkForm, 1000);
                this.pays_loading = false;
            } else if (this.payment == 2) {
                this.$confirm('确认使用余额充值VIP?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                }).then(() => {
                    this.payblance();
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消充值'
                    });
                });
            }
        },
        //余额支付
        async payblance() {
            const that = this;
            const Alipay = await payByBlance(this.vipchoice.vip_price, this.member.id, this.payment, this.types)
                .then(function (msg) {
                    that.vipdata();
                    if (msg.data.status == 403) {
                        that.$message({
                            message: '余额不足',
                            type: 'error',
                        });
                    }
                })
        },
        // 关闭弹框,清除已经生成的二维码
        handleClose() {
            this.innerVisible = false
            this.vipdata();
        },
        //重新获取vip数据
        async vipdata() {
            const users = await me();
            this.member = users.data;
            const lavel = await userVip();
            this.vipstatus = lavel.list;
            this.vip = lavel.user;
            this.atvip = lavel.user.vip_level;
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
                {rel: 'icon', type: 'image/x-icon', href: this.ico}
            ]
        }
    }

}
</script>

<style scoped>
.goods {
    display: flex;
    justify-content: center;
    margin-top: 20px;

}

.goods-items.checked, .goods-items:hover {
    border: 1px solid #4d7cff;
    transition: all 0.3s ease;
}

.goods-items:hover {
    border: 1px solid #4d7cff;
    box-shadow: 0 10px 20px rgb(44 62 161 / 6%), 0 20px 40px rgb(27 35 80 / 5%);
    transform: translateY(-10px);
}

.goods-items {
    float: left;
    width: 15%;
    margin-left: 25px;
    margin-bottom: 10px;
    border: 1px solid #e5e5e5;
    background-color: #fff;
    cursor: pointer;
    text-align: center;
    transition: all 0.3s ease;
    border-radius: 4px;
}

.goods-items .total {
    height: 108px;
    border-bottom: 1px dashed #e3e3e3;

}

.goods-items .total .money {
    font-style: normal;

    font-size: 38px;
    font-weight: 300;
}

.goods-items .total .unit {
    font-size: 14px;
    color: #969696;
}

.goods-items .total .unit-price {
    margin-top: 4px;
    display: block;
    color: #409eff;
    font-weight: 500;
}

.goods-items .relative-to-total {
    position: relative;
    font-size: 16px;
    height: 40px;
    line-height: 40px;
}

.styles__button_group__3Q8uW {
    display: flex;
    justify-content: center;
}

.style__whiteBox__Ebttm {
    text-align: center;
}
</style>

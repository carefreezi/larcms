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
                        <div class="right_auth">
                            <el-alert
                                v-if="state==1"
                                title="友好的通知您："
                                type="success"
                                description="您已经通过认证审核，可以前往发布资源赚取您的资金！"
                                show-icon>
                            </el-alert>
                            <el-alert
                                v-else-if="state==2"
                                title="遗憾的通知您："
                                type="error"
                                description="您未通过本站认证，请重新提交！"
                                show-icon>
                            </el-alert>
                            <el-alert
                                v-else
                                title="温馨提醒您："
                                type="warning"
                                description="称号认证后，即可发布资源赚取资源金额。"
                                show-icon>
                            </el-alert>

                            <div class="verity_auth">
                                <el-tabs v-model="activeName">
                                    <el-tab-pane label="免金额认证" name="no_money">
                                        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" v-if="state!=0 && state!=1">
                                            <el-form-item label="真实姓名" prop="name">
                                                <el-input v-model="ruleForm.name" placeholder="请输入真实姓名"></el-input>
                                            </el-form-item>
                                            <el-form-item label="身份证号码" prop="sfz_number">
                                                <el-input v-model="ruleForm.sfz_number" placeholder="请输入真实身份证号码"></el-input>
                                            </el-form-item>
                                            <el-form-item label="专属称号" prop="web_name">
                                                <el-input v-model="ruleForm.web_name" placeholder="显示的称号，例如：最酷的站长，最帅的程序员"></el-input>
                                            </el-form-item>
                                            <el-form-item label="身份证正面" prop="sfz_before">
                                                <el-upload
                                                    action="/api/upload"
                                                    ref="upload"
                                                    accept=".jpg,.png"
                                                    :show-file-list="false"
                                                    :before-upload="beforeSfzUpload"
                                                    :on-success="handleSfzSuccess"
                                                    :auto-upload="true"
                                                    :headers="auths"
                                                    :multiple="false"
                                                >
                                                    <img v-if="ruleForm.sfz_before" :src="ruleForm.sfz_before" class="index__user_icon__apusI">
                                                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                                </el-upload>
                                            </el-form-item>
                                            <el-form-item label="身份证反面" prop="sfz_after">
                                                <el-upload
                                                    action="/api/upload"
                                                    ref="upload"
                                                    accept=".jpg,.png"
                                                    :show-file-list="false"
                                                    :before-upload="beforeSfzsUpload"
                                                    :on-success="handleSfzsSuccess"
                                                    :auto-upload="true"
                                                    :headers="auths"
                                                    :multiple="false"
                                                >
                                                    <img v-if="ruleForm.sfz_after" :src="ruleForm.sfz_after" class="index__user_icon__apusI">
                                                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                                </el-upload>
                                            </el-form-item>

                                            <el-form-item>
                                                <el-button type="primary" @click="submitForm('ruleForm')">提交认证</el-button>
                                                <el-button @click="resetForm('ruleForm')">重置</el-button>
                                            </el-form-item>
                                        </el-form>
                                        <div class="verify_state" v-if="state==0">
                                            <img src="@/assets/images/verify.png" alt="审核中">
                                            <p>身份认证正在审核中！通过将发送邮箱通知！</p>
                                        </div>
                                        <div class="verify_state" v-else-if="state==1">
                                            <img src="@/assets/images/verify_1.png" alt="已通过认证">
                                            <p>您已经通过用户认证！并获得专属称号以及发布文章资格！</p>
                                        </div>
                                    </el-tab-pane>
                                    <el-tab-pane label="金额认证" name="money">
                                        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" v-if="state!=0 && state!=1">
                                            <el-form-item label="专属称号" prop="web_name">
                                                <el-input v-model="ruleForm.web_name" placeholder="显示的称号，例如：最酷的站长，最帅的程序员"></el-input>
                                            </el-form-item>
                                            <el-form-item label="认证支付">

                                                <el-alert
                                                    title="支付成功"
                                                    type="success"
                                                    description="您已经通过支付认证！请提交您的专属名称至后台审核！"
                                                    show-icon
                                                    :closable="false"
                                                    v-if="pay_state==1">
                                                </el-alert>
                                                <el-alert
                                                    title="消息提示的文案"
                                                    type="info"
                                                    :closable="false"
                                                    center
                                                    v-else
                                                >
                                                    <div slot="title">
                                                        <div class="verify_tips">
                                                            <p class="verify_get_money">
                                                                <el-badge value="认证费用" class="item">
                                                                    <el-button round size="small">￥{{verify_money}}</el-button>
                                                                </el-badge>
                                                            </p>
                                                            <el-button type="primary" @click="dialogVisible=true;payOrder()">立即支付</el-button>
                                                        </div>
                                                        <div class="verify_me">
                                                            提示：{{ tips }}
                                                        </div>
                                                    </div>
                                                </el-alert>
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
                                                                 @click=" recharge(0)"><i></i><span>微信</span></div>
                                                            <div :class="{'styles__active__1DnYl':payment==1}"
                                                                 @click=" recharge(1)"><i></i><span>支付宝</span></div>
                                                            <div :class="{'styles__active__1DnYl':payment==2}"
                                                                 @click=" recharge(2)"><i></i><span>余额</span></div>
                                                        </div>
                                                    </div>
                                                    <span slot="footer" class="dialog-footer">
                                                        <el-button @click="dialogVisible=false">取消支付</el-button>
                                                        <el-button type="primary" @click="handleClose()">支付成功</el-button>
                                                    </span>
                                                </el-dialog>
                                            </el-form-item>
                                            <el-form-item>
                                                <el-button type="primary" @click="submitForms('ruleForm')">提交认证</el-button>
                                                <el-button @click="resetForms('ruleForm')">重置</el-button>
                                            </el-form-item>
                                        </el-form>
                                        <div class="verify_state" v-if="state==0">
                                            <img src="@/assets/images/verify.png" alt="审核中">
                                            <p>身份认证正在审核中！通过将发送邮箱通知！</p>
                                        </div>
                                        <div class="verify_state" v-else-if="state==1">
                                            <img src="@/assets/images/verify_1.png" alt="已通过认证">
                                            <p>您已经通过用户认证！并获得专属称号以及发布文章资格！</p>
                                        </div>
                                    </el-tab-pane>
                                </el-tabs>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import axios from "axios";
import {payByAlipay} from '~/plugins/index';
import {payByWechat} from '~/plugins/index';
import {payByBlance} from '~/plugins/index';

export default {
    auth:true,
    name: "Verify",
    components: {
        person_left
    },
    data(){
        return{
            member: {},
            drawer:false,
            loadings:false,
            state:'',
            auths: {},
            activeName:'no_money',
            dialogVisible:false,
            payment:0,
            payment_image:'',
            pays_loading:false,
            verify_money:this.WebConfigs('verify_money'),
            tips:this.WebConfigs('verify_tips'),
            types:3,
            pay_state:0,
            verify_info:"",
            user_pic:'',
            ruleForm: {
                name: '',
                sfz_number:'',
                web_name:'',
                sfz_before:'',
                sfz_after:'',
            },
            rules: {
                name: [
                    { required: true, message: '请输入真实姓名', trigger: 'blur' },
                ],
                sfz_number: [
                    { required: true, message: '请输入身份证号码', trigger: 'blur' },
                    { min: 18, max: 18, message: '长度为18个位数', trigger: 'blur' }
                ],
                web_name: [
                    { required: true, message: '请输入专属名称', trigger: 'blur' },
                ],
                sfz_before: [
                    { required: true, message: '请上传身份证正面图', trigger: 'blur' },
                ],
                sfz_after: [
                    { required: true, message: '请上传身份证反面图', trigger: 'blur' },
                ],
            },
            title:'用户认证',
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
            this.auths = {Authorization: "Bearer " + this.$store.state.auth.user.api_token};
        }
        this.get_auth_pay_is();
    },
    async asyncData({app, params}) {
        try{
            let [listA,listB] = await Promise.all([
                app.$axios.$get(`/api/get_verify_auth`),
                app.$axios.$post("/api/get_user_avatar"),
            ])
            return {
                state:listA.data.state,
                verify_info:listA.data,
                user_pic:listB.data
            }
        }catch (error) {
            return{
                state: null,
            }
        }
    },
    methods: {
        get_auth_pay_is(){
            return axios.get(`/api/get_verify_auth_is`).then(res => {
                this.loadings = false;
                this.pay_state = res.data.data.state;
            })
        },
        recharge(value) {
            clearInterval(this.timer)
            this.pays_loading=true;
            this.payment = value;
            this.$nextTick(() => {
                this.crateQrcode()
            })
            this.timer = setInterval(()=>{
                this.get_auth_pay_is();
                if(this.pay_state==1){
                    clearInterval(this.timer)
                    this.dialogVisible=false;
                }
            },3000)
        },
        // 展示二维码
        payOrder() {
            this.pays_loading = true;
                // 使用$nextTick确保数据渲染
                this.$nextTick(() => {
                    this.crateQrcode()
                })
            this.timer = setInterval(()=>{
                this.get_auth_pay_is();
                if(this.pay_state==1){
                    clearInterval(this.timer)
                    this.dialogVisible=false;
                }
            },3000)
        },
        // 生成二维码
        async crateQrcode() {
            if (this.payment == 1) {
                this.dialogVisible = true;
                const Alipay = await payByAlipay(this.verify_money, this.member.id, this.payment, this.types)
                this.payment_image = Alipay.alipay_url;
                this.pays_loading = false;
            } else if (this.payment == 0) {
                this.dialogVisible = true;
                const number = this.verify_money * 100;
                const wechat = await payByWechat(number, this.member.id, this.payment, this.types)
                this.payment_image = wechat.wechat_url;
                this.pays_loading = false;
            } else if (this.payment == 2) {
                this.$confirm('确认使用余额购买认证?', '提示', {
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
            const Alipay = await payByBlance(this.verify_money, this.member.id, this.payment, this.types)
                .then(function (msg) {
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
            this.dialogVisible = false
        },
        get_verify(){
            return axios.get(`/api/get_verify_auth`).then(res => {
                this.loadings = false;
                this.state = res.data.data.state;
            })
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.loadings=true;
                    return axios.post(`/api/verify_auth`, {
                            name:this.ruleForm.name,
                            user_id:this.$store.state.auth.user.id,
                            sfz_number:this.ruleForm.sfz_number,
                            web_name:this.ruleForm.web_name,
                            sfz_before:this.ruleForm.sfz_before,
                            sfz_after:this.ruleForm.sfz_after,
                    }).then(res => {
                        this.$message.success(res.data.msg)
                        this.loadings = false;
                        this.get_verify();
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        },
        submitForms(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.loadings=true;
                    if (this.pay_state==0){
                        this.$message.warning('请先完成支付！');
                        this.loadings=false;
                        return false
                    }
                    return axios.post(`/api/verify_auth_money`, {
                        web_name:this.ruleForm.web_name,
                        user_id :this.member.id
                    }).then(res => {
                        this.$message.success(res.data.msg)
                        this.loadings = false;
                        this.get_verify();
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        resetForms(formName) {
            this.$refs[formName].resetFields();
        },
        // sfz_before
        handleSfzSuccess(res, file) {
            this.ruleForm.sfz_before = res.files.file;
            if (res.status == 200) {
                this.$message.success(res.msg)
            }
        },
        beforeSfzUpload(file) {
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png' || file.type === 'image/PNG' || file.type === 'image/JPG';
            const isLt2M = file.size / 1024 / 1024 < 2;
            if (!isJPG) {
                this.$message.error("上传头像图片只能是 JPG或PNG 格式!");
                return isJPG && isLt2M;
            }
            if (!isLt2M) {
                this.$message.error("上传头像图片大小不能超过 2MB!");
                return isJPG && isLt2M;
            }
            this.limt += 1;
        },
        // sfz_after
        handleSfzsSuccess(res, file) {
            this.ruleForm.sfz_after = res.files.file;
            if (res.status == 200) {
                this.$message.success(res.msg)
            }
        },
        beforeSfzsUpload(file) {
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png' || file.type === 'image/PNG' || file.type === 'image/JPG';
            const isLt2M = file.size / 1024 / 1024 < 2;
            if (!isJPG) {
                this.$message.error("上传头像图片只能是 JPG或PNG 格式!");
                return isJPG && isLt2M;
            }
            if (!isLt2M) {
                this.$message.error("上传头像图片大小不能超过 2MB!");
                return isJPG && isLt2M;
            }
            this.limt += 1;
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
.el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.el-upload:hover {
    border-color: #409EFF;
}
.el-upload img{
    width: 400px;
    height: 178px;
}
.avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 400px;
    height: 178px;
    line-height: 178px;
    text-align: center;
}
.avatar {
    width: 400px;
    height: 178px;
    display: block;
}
.verify_state{
    width: 100%;
    text-align: center;
}
.verify_state p{
    color: #4e4e4e;
}
</style>

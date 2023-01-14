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
                            <div class="YBTransition">
                                <div class="suggestion__wrapper__28Ssg">
                                    <div class="suggestion__addSuggesWrapper__2nBsn">
                                        <div class="suggestion__addSuggesContent__1Di_f"><h2>意见反馈</h2>
                                            <div
                                                class="suggestion__users_layout_form__aynTQ suggestion__users_send__368mT">
                                                <div class="suggestion__users_layout_form_item__2ow4N">
                                                    <div class="suggestion__users_layout_form_label__zCmoA">问题类型</div>
                                                    <el-select v-model="value" placeholder="请选择">
                                                        <el-option
                                                            v-for="item in options"
                                                            :key="item.id"
                                                            :label="item.question_types"
                                                            :value="item.id">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                                <div class="suggestion__users_layout_form_item__2ow4N">
                                                    <div class="suggestion__users_layout_form_label__zCmoA">问题描述<span>内容介于20～400字</span>
                                                    </div>
                                                    <el-input
                                                        type="textarea"
                                                        placeholder="请输入内容"
                                                        v-model="textarea"
                                                        minlegth="20"
                                                        maxlength="400"
                                                        :autosize="{ minRows: 10, maxRows: 10}"
                                                        show-word-limit
                                                    >
                                                    </el-input>
                                                </div>
                                                <div class="suggestion__users_layout_form_item__2ow4N">
                                                    <div class="suggestion__users_layout_form_label__zCmoA">问题截图<span>文件格式为png、jpg、jpeg，且大小不超过15MB</span><span>0/3</span>
                                                    </div>
                                                    <div class="suggestion__users_layout_form_input__3aa2v">
                                                        <div class="suggestion__uploadWrap__2VpxY">
                                                            <el-upload
                                                                action="/api/upload"
                                                                ref="upload"
                                                                accept=".jpg,.png"
                                                                list-type="picture-card"
                                                                :file-list="fileList"
                                                                :on-preview="handlePictureCardPreview"
                                                                :before-upload="beforeUpload"
                                                                :on-remove="handleRemove"
                                                                :on-success="uploadSuccess"
                                                                :headers="auths"
                                                                :auto-upload="false"
                                                                :multiple="true"
                                                            >
                                                                <i class="el-icon-plus"></i>
                                                            </el-upload>
                                                            <el-dialog :visible.sync="dialogVisible">
                                                                <img width="100%" :src="dialogImageUrl" alt=""/>
                                                            </el-dialog>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="suggestion__users_layout_form_item__2ow4N">
                                                    <el-button type="primary" class="suggestion__unSubmitBtn__14qdl"
                                                               @click="onSubmit">
                                                        提交
                                                    </el-button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="suggestion__rightSuggesList__id7TV">
                                            <div class="suggestion__title__2zObe"><span>我的反馈</span>
                                            </div>
                                            <p class="suggestion__center__3YaRz" v-if="activities==''">暂无反馈记录</p>
                                            <div class="block" v-if="activities!=''">
                                                <div class="radio">
                                                    <el-radio-group v-model="reverse">
                                                        <el-radio :label="true">倒序</el-radio>
                                                        <el-radio :label="false">正序</el-radio>
                                                    </el-radio-group>
                                                </div>

                                                <el-timeline :reverse="reverse">
                                                    <el-timeline-item
                                                        v-for="(activity, index) in activities"
                                                        :key="index"
                                                        :timestamp="activity.create_time">
                                                        {{ activity.content }}
                                                    </el-timeline-item>
                                                </el-timeline>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="suggestion__suggModal__2enFr" style="display: none;">
                                        <div class="suggestion__previewImageContent__Uen7i">
                                            <div class="suggestion__previewImageCloseBtn__2ME8u"></div>
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper"></div>
                                                <div class="swiper-button-prev"></div>
                                                <div class="swiper-button-next"></div>
                                            </div>
                                            <div class="suggestion__previewImageCount__1tpCd">1/0</div>
                                        </div>
                                    </div>
                                </div>
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
import {me} from '~/plugins/index';
import {Question_type} from '~/plugins/index';
import {upQuestion} from '~/plugins/index';
import Cookies from "js-cookie";
import axios from "axios";


export default {
    auth:true,
    name: "Suggestion",
    components: {
        person_left
    },
    data() {
        return {
            //用户信息
            member: {},
            options: [],
            value: '',
            textarea: '',
            // 图片上传
            fileList: [],
            dialogImageUrl: [],
            dialogVisible: false,
            images: false,
            upimages: [],
            reverse: true,
            activities: [],
            auths: {},
            limt: 0,
            drawer:false,
            verify_info:'',
            user_pic:'',
            title: '意见反馈',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.auths = {Authorization: "Bearer" + users.api_token};
            this.member = users;
            const questions = await Question_type();
            this.options = questions.question;
            this.activities = questions.feedback;
        }
    },
    async asyncData({app, params}) {
        try{
            let [listA,listB] = await Promise.all([
                app.$axios.$get(`/api/get_verify_auth`),
                app.$axios.$post("/api/get_user_avatar"),
            ])
            return {
                verify_info:listA.data,
                user_pic:listB.data
            }
        }catch (error) {
            return{
                verify_info: '',
            }
        }
    },
    methods: {
        handleRemove(file, fileList) {
        },
        handlePictureCardPreview(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        beforeUpload(file) {
            // 文件类型进行判断
            console.log(file)
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png' || file.type === 'image/PNG' || file.type === 'image/JPG';
            const isLt2M = file.size / 1024 / 1024 < 2;
            if (!isJPG) {
                this.$message.error("上传图片只能是 JPG/PNG 格式!");
                return isJPG && isLt2M;
            }
            if (!isLt2M) {
                this.$message.error("上传图片大小不能超过 2MB!");
                return isJPG && isLt2M;
            }
            this.limt += 1;
        },
        async onSubmit() {
            this.$refs.upload.submit();
        },
        async handleAvatarSuccess() {
            const questions = await upQuestion(this.value, this.textarea, this.upimages);
        },
        uploadSuccess(res, file, filelist) {
            this.upimages = this.upimages.concat(res.files.file);
            if (this.upimages.length == this.limt) {
                this.handleAvatarSuccess();
                this.value = '';
                this.textarea = '';
                this.upimages = [];
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

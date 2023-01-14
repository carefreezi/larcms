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
                    <person_left :message_info="member" :message="messages.length+notices.length" :verify="verify_info" :user_pic="user_pic"></person_left>
                    <!--                        left end-->
                    <div class="centerHead__centerContent__1K_n0">
                        <div class="transiton_container" style="height: auto;">
                            <div class="YBTransition" v-loading="loadings">
                                <div class="v4_mail__message_box__3tJM7">
                                    <div class="v4_mail__header__2U2fD">
                                        <div class="v4_mail__title__2xW4t">消息中心</div>
                                        <el-tabs v-model="activeName" @tab-click="handleClick">
                                            <el-tab-pane label="通知" name="first">
                                                <div class="YBTransition">
                                                    <div class="v4_mail__content_wrap__ysqlz">
                                                        <div class="v4_mail__edit_wrap__3Fk3J">
                                                            <span
                                                                class="v4_mail__all_read_btn__diRr6 v4_mail__active__21ncW"
                                                                @click="readmessages('all')">
                                                                <i class="v4_mail__activeAllReadIcon__15T0B"></i>全部已读</span>
                                                        </div>
                                                        <Notfound v-if="messages.length<1"></Notfound>
                                                        <ul class="v4_mail__table_wrap__2vd3w">
                                                            <li data-analytics="button" data-label="消息中心-消息详情"
                                                                v-for="(item,k) in messages.slice((currentPage-1)*pagesize,currentPage*pagesize)">
                                                                <div class="v4_mail__left__1EhwJ">
                                                                    <div class="v4_mail__icon__3ue_x"><img
                                                                        src="@/assets/images/notice.png"><em
                                                                        v-if="item.state==0"></em>
                                                                    </div>
                                                                    <p class="v4_mail__hoverUnderline__F27bk"
                                                                       @click="readmessages(item.id,k)">
                                                                        {{ item.title }}</p>
                                                                </div>
                                                                <div class="v4_mail__center__1Or3a">
                                                                    {{ replaceContent(item.content) }}
                                                                </div>
                                                                <div class="v4_mail__right__2w0W9">
                                                                    {{ rTime(item.data) }}
                                                                </div>
                                                            </li>
                                                            <el-dialog
                                                                :visible.sync="centerDialogVisible"
                                                                width="30%"
                                                                center>
                                                                <div slot="title">{{ message_title }}</div>
                                                                <div v-html="message_content"></div>
                                                                <span slot="footer" class="dialog-footer">
                                                                        <el-button type="primary"
                                                                                   @click="centerDialogVisible = false">已阅读</el-button>
                                                                    </span>
                                                            </el-dialog>
                                                        </ul>
                                                        <el-pagination
                                                            @size-change="handleSizeChange"
                                                            @current-change="handleCurrentChange"
                                                            background
                                                            layout="prev, pager, next"
                                                            :total="messages.length"
                                                            hide-on-single-page
                                                            align="center"
                                                            :page-size="pagesize"
                                                        >
                                                        </el-pagination>
                                                    </div>
                                                </div>
                                            </el-tab-pane>
                                            <el-tab-pane label="公告" name="second">
                                                <div class="YBTransition">
                                                    <div class="v4_mail__content_wrap__ysqlz">
                                                        <div class="v4_mail__edit_wrap__3Fk3J"><span
                                                            class="v4_mail__all_read_btn__diRr6 v4_mail__active__21ncW"
                                                            @click="readmessages('all')"><i
                                                            class="v4_mail__activeAllReadIcon__15T0B"></i>全部已读</span>
                                                            <span class="v4_mail__edit_btn__2JM3G"></span>
                                                        </div>
                                                        <ul class="v4_mail__table_wrap__2vd3w">
                                                            <li data-analytics="button" data-label="消息中心-消息详情"
                                                                v-for="(item,k) in notices.slice((currentPage-1)*pagesize,currentPage*pagesize)">
                                                                <div class="v4_mail__left__1EhwJ">
                                                                    <div class="v4_mail__icon__3ue_x"><img
                                                                        src="@/assets/images/notice.png"><em
                                                                        v-if="item.state==0"></em>
                                                                    </div>
                                                                    <p class="v4_mail__hoverUnderline__F27bk"
                                                                       @click="readmessages(item.id,k)">
                                                                        {{ item.title }}</p>
                                                                </div>
                                                                <div class="v4_mail__center__1Or3a">
                                                                    {{ replaceContent(item.content) }}
                                                                </div>
                                                                <div class="v4_mail__right__2w0W9">
                                                                    {{ rTime(item.data) }}
                                                                </div>
                                                            </li>
                                                            <el-dialog
                                                                :visible.sync="centerDialogVisibles"
                                                                width="30%"
                                                                center>
                                                                <div slot="title">{{ message_title }}</div>
                                                                <div v-html="message_content"></div>
                                                                <span slot="footer" class="dialog-footer">
                                                                        <el-button type="primary"
                                                                                   @click="centerDialogVisibles = false">已阅读</el-button>
                                                                    </span>
                                                            </el-dialog>
                                                        </ul>
                                                        <el-pagination
                                                            @size-change="handleSizeChange"
                                                            @current-change="handleCurrentChange"
                                                            background
                                                            layout="prev, pager, next"
                                                            :total="notices.length"
                                                            hide-on-single-page
                                                            align="center"
                                                            :page-size="pagesize"
                                                        >
                                                        </el-pagination>

                                                    </div>
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
        </div>
    </div>
</template>

<script>
import person_left from '~/pages/member/Left';
import {messagetable} from '~/plugins/index';
import {readmessage} from '~/plugins/index';
import {me} from '~/plugins/index';
import Cookies from "js-cookie";

export default {
    auth:true,
    name: "Message",
    components: {
        person_left
    },
    data() {
        return {
            //用户信息
            member: {},
            activeName: 'first',
            messages: [],
            notices: [],
            centerDialogVisible: false,
            centerDialogVisibles: false,
            message_title: '',
            message_content: '',
            currentPage: 1, //初始页
            pagesize: 10,    //    每页的数据
            loadings: true,
            drawer:false,
            verify_info:'',
            user_pic:'',
            title: '信息中心',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')

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
    async created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.member = users;
            const mes = await messagetable()
            this.messages = mes.message
            this.notices = mes.notice
            this.loadings = false;
        }

    },
    methods: {
        replaceContent(value) {
            let content = value.replace(/<.+?>/g, '');
            content = content.replace(/&nbsp;/ig, '');
            content = content.replace(/\s/ig, '');
            return content;
        },
        handleClick(tab, event) {
            // console.log(tab, event);
        },
        //时间戳转化
        rTime(date) {
            var json_date = new Date(date).toJSON();
            return new Date(+new Date(json_date) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '')
        },
        //点击消息
        async readmessages(id, k) {
            if (id != 'all') {
                if (this.activeName == "first") {
                    this.centerDialogVisible = true;
                    this.message_title = this.messages[k].title;
                    this.message_content = this.messages[k].content;
                } else if (this.activeName == 'second') {
                    this.centerDialogVisibles = true;
                    this.message_title = this.notices[k].title;
                    this.message_content = this.notices[k].content;
                }
            }
            const dd = await readmessage(id, this.activeName)
            const mes = await messagetable()
            this.messages = mes.message
            this.notices = mes.notice
        },
        // 初始页currentPage、初始每页数据数pagesize和数据data
        handleSizeChange: function (size) {
            this.pagesize = size;
        },
        handleCurrentChange: function (currentPage) {
            this.currentPage = currentPage;
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

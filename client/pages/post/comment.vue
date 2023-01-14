<template>
    <div>
        <li :id="'#comment-'+item.id" class="comment-body"
            v-for="(item,index) in list">
            <div :id="'#comment-'+item.id" class="comment-wrapper u-clearfix"  :class="{is_parent:item.parent_id==''}">
                <div class="avatar"><img alt=""
                                         :src="item.pic"
                                         height="50" width="50" loading="lazy"
                                         class="avatar avatar-50 photo"></div>
                <div class="comment">
                    <h6>{{ item.userinfo }}</h6>
                    <!--<div class="dev-user-info-detail-vip"-->
                    <!--     v-if="item.vip_status!=1">-->
                    <!--    <svg t="1622099557741" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7460" width="48" height="48"><path d="M536.149333 896H222.037333L661.802667 128h314.112L536.149333 896zM384 464.128V213.333333H128v85.333334h85.333333v463.488l170.666667-298.026667z" p-id="7461"></path></svg>-->
                    <!--    <span>普通用户</span>-->
                    <!--</div>-->
                    <!--<div class="dev-user-info-detail-vip" v-else>-->
                    <!--    <svg t="1622099565827" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7603" width="48" height="48"><path d="M536.149333 896H222.037333L661.802667 128h314.112L536.149333 896zM384 464.128V213.333333H128v85.333334h85.333333v463.488l170.666667-298.026667z" p-id="7604" fill="#409eff"></path></svg>-->
                    <!--    <span>会员</span>-->
                    <!--</div>-->
                    <a rel="nofollow" :href="'#comment-'+item.id"
                       @click="show_reply(item.id)"
                       class="comment-reply-link"><i
                        class="heimao hm-pinglun"></i> 回复</a>
                    <p v-if="item.parent_id!=''">回复 <nuxt-link :to="'/user/'+computedUserId(item.parent_id)">{{computedSiteType(item.parent_id)}}</nuxt-link> ：{{ item.content }}</p>
                    <p v-else>{{ item.content }}</p>
                    <div class="date">{{ rTime(item.create_time) }}</div>
                    <el-form ref="form" :model="comment" label-width="0px"
                             v-if="click_reply==item.id">
                        <el-form-item>
                            <el-input type="textarea" :rows="4"
                                      placeholder="说点什么吧~"
                                      class="app-control reply-comment-textarea"
                                      v-model="comment.reply"></el-input>
                        </el-form-item>
                        <div class="emoji-box">
                            <el-button type="primary"
                                       size="small"
                                       @click="reply_sub(item.id)"
                                       placeholder="说点什么吧~">回复评论
                            </el-button>
                            <el-button type="info"
                                       size="small"
                                       @click="cancel_res"
                                       placeholder="说点什么吧~">取消评论
                            </el-button>
                        </div>
                    </el-form>
                </div>
            </div>
            <ul class="children" v-if="item.all_children.length>0" >
                <detail-list :list="item.all_children" :member="member" :designs="designs" :comment_all="comment_all"/>
            </ul>
        </li>
    </div>
</template>

<script>
import axios from "axios";
import {isfollow, subComment, replyComment, detail_author} from '~/plugins/index';

export default {
    name: "DetailList",
    props: {
        list: Array,
        member: {},
        designs:{},
        comment_all:{}
    },
    data(){
        return{
            of_member:this.member,
            of_designs:this.designs,
            comment: {
                name: '',
                contents: '',
                reply: ''
            },
            click_reply: 0,
        }
    },
    methods:{
        computedSiteType(siteType) {
                for (var i = 0; i < this.comment_all.length; i++) {
                    if (this.comment_all[i].id == siteType) {
                        return this.comment_all[i].userinfo;
                    }
                }
        },
        computedUserId(siteType) {
            for (var i = 0; i < this.comment_all.length; i++) {
                if (this.comment_all[i].id == siteType) {
                    return this.comment_all[i].user_parent_id;
                }
            }
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
                const comments = await replyComment(ids, this.of_member.id, this.of_designs.id, this.comment.reply);
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
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="centerHead__users_content__3jK8m">
        <div class="layout_chat">
            <!-- content -->
            <div class="content">

                <!-- sidebar group -->
                <div class="sidebar-group" :class="choose_chat==''?'mobile-open':''">

                    <!-- Chats sidebar -->
                    <div id="chats" class="sidebar active">
                        <header len="2087">
                            <span len="5" lang="zh-CHS">私信聊天</span>
                            <ul class="list-inline">
                                <li class="list-inline-item" @click="chat_with()">
                                    <span class="btn btn-outline-light" data-toggle="tooltip" title="" data-navigation-target="friends" data-original-title="New chat" len="413">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle" len="128"><circle cx="12" cy="12" r="10" len="0"></circle><line x1="12" y1="8" x2="12" y2="16" len="0"></line><line x1="8" y1="12" x2="16" y2="12" len="0"></line></svg>
                                    </span>
                                </li>

                            </ul>
                        </header>
                        <el-dialog
                            title="发送私信"
                            :visible.sync="dialogChatPeople"
                            width="30%"
                        >
                            <el-form :model="chatForm" :rules="Chatrules" ref="chatForm" label-width="80px" v-loading="dialog_loadings">
                                <el-form-item label="选择用户"  prop="user_id">
                                    <el-select
                                        v-model="chatForm.user_id"
                                        filterable
                                        remote
                                        reserve-keyword
                                        placeholder="请搜索用户昵称"
                                        :remote-method="remoteMethod"
                                        :loading="loading">
                                        <el-option
                                            v-for="item in all_user"
                                            :key="item.id"
                                            :label="item.name"
                                            :value="item.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item label="私信内容" prop="desc">
                                    <el-input type="textarea" v-model="chatForm.desc" placeholder="说点什么吧~"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-button size="small" @click="dialogChatPeople = false">取消</el-button>
                                    <el-button size="small" type="primary" @click="sendMessage_user('chatForm')">发送私信</el-button>
                                </el-form-item>
                            </el-form>

                        </el-dialog>
                        <div class="sidebar-body" tabindex="2" style=" outline: none;">
                            <ul class="list-group list-group-flush" v-if="chat_group!=''">
                                <li class="list-group-item" @click="chat_get(chat_last[index].id,index)" :class="choose_chat==chat_last[index].id?'open-chat':''" v-for="(item,index) in chat_group" len="2208">
                                    <div>
                                        <figure class="avatar">
                                            <img :src=item.pic class="rounded-circle" alt="image">
                                        </figure>
                                    </div>
                                    <div class="users-list-body">
                                        <div len="179">
                                            <h5 len="13">{{item.name==null?'该用户暂未设置昵称':item.name}}</h5>
                                            <p len="43">{{ chatin_last[index].content }}</p>
                                        </div>
                                        <div class="users-list-action">
                                            <small class="text-muted">{{chat_last[index].created_at}}</small>
                                            <div class="action-toggle" style="text-align: right;">
                                                <div class="dropdown">
                                                    <el-dropdown>
                                                      <span class="el-dropdown-link">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                      </span>
                                                        <el-dropdown-menu slot="dropdown">
                                                            <el-dropdown-item @click.native="delete_chat(chat_last[index].id)">删除</el-dropdown-item>
                                                        </el-dropdown-menu>
                                                    </el-dropdown>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="list-group" v-else>
                                <el-empty :image-size="200" description="暂无私信"></el-empty>
                            </div>
                        </div>
                    </div>
                    <!-- ./ Chats sidebar -->
                </div>
                <!-- ./ sidebar group -->

                <!-- chat -->
                <div class="chat" v-if="chatInfo!=''" v-loading="chat_loadings">
                    <div class="chat-header">
                        <div class="chat-header-user">
                            <figure class="avatar">
                                <el-skeleton style="width: 37px" :loading="chat_loadings" animated>
                                    <template slot="template">
                                        <el-skeleton-item
                                            variant="image"
                                            style="width: 37px; height: 37px;"
                                        />
                                    </template>
                                    <template>
                                        <img :src=chatInfo.pic class="rounded-circle" alt="image">
                                    </template>
                                </el-skeleton>
                            </figure>
                            <div len="200">
                                <h5 len="13">{{ chatInfo.name }}</h5>
                                <small class="text-success">
                                    <i>{{ chatInfo.description }}</i>
                                </small>
                            </div>
                        </div>
                        <div class="chat-header-action">
                            <ul class="list-inline">
                                <li class="list-inline-item d-xl-none d-inline">
                                    <span @click="go_chatAll()" class="btn btn-outline-light mobile-navigation-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu" len="130"><line x1="3" y1="12" x2="21" y2="12" len="0"></line><line x1="3" y1="6" x2="21" y2="6" len="0"></line><line x1="3" y1="18" x2="21" y2="18" len="0"></line></svg>
                                    </span>
                                </li>

                                <li class="list-inline-item">
                                    <el-dropdown>
                                        <span class="btn btn-outline-light" data-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal" len="116"><circle cx="12" cy="12" r="1" len="0"></circle><circle cx="19" cy="12" r="1" len="0"></circle><circle cx="5" cy="12" r="1" len="0"></circle></svg>
                                        </span>
                                        <el-dropdown-menu slot="dropdown">
                                            <el-dropdown-item @click.native="delete_chat(chat_last[index].id)">删除</el-dropdown-item>
                                        </el-dropdown-menu>
                                    </el-dropdown>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-body" tabindex="1" style=" outline: none;"  ref="table-container"> <!-- .no-message -->
                        <div class="messages" len="10459">
                            <!--to your-->
                            <div class="message-item" :class="item.to_id==member.id?'outgoing-message':''"  v-for="(item,indexs) in chat_online">
                                    <div class="message-avatar" len="460">
                                    <figure class="avatar" len="143">
                                        <img :src=item.pic class="rounded-circle" alt="image" len="0" v-if="item.to_id!=member.id">
                                        <img :src=member.pic class="rounded-circle" alt="image" len="0" v-else>
                                    </figure>
                                    <div len="191">
                                        <h5 v-if="item.to_id!=member.id">{{ item.name }}</h5>
                                        <h5 v-else>{{ member.name }}</h5>
                                        <div class="time"><span>{{ item.created_at }} </span></div>
                                    </div>
                                    </div>
                                <div class="message-content">
                                    {{ item.content }}
                                    <div class="message-images" v-if="item.upimages!=''">
                                        <el-image v-for="(imgs,indexof) in JSON.parse(item.upimages)" :src="imgs" :preview-src-list="JSON.parse(item.upimages)"></el-image>
                                    </div>
                                </div>

                            </div>
                            <!--to your end-->
                        </div>
                    </div>
                    <div class="chat-footer">
                        <el-form :model="ruleForm" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                            <el-form-item label-width="0px">
                                <el-input type="textarea"
                                          :autosize="{ minRows: 2, maxRows: 4}"
                                          v-model="ruleForm.content"
                                          placeholder="说点什么吧~"></el-input>
                            </el-form-item>
                            <el-form-item label-width="0px">
                                <div class="form-buttons">
                                        <el-upload
                                            action="/api/upload"
                                            ref="upload"
                                            accept=".jpg,.png"
                                            list-type="picture-card"
                                            :on-preview="handlePictureCardPreview"
                                            :before-upload="beforeUpload"
                                            :on-remove="handleRemove"
                                            :on-success="uploadSuccess"
                                            :headers="auths"
                                            :auto-upload="true"
                                            :multiple="true"
                                        >
                                            <svg t="1626502575903" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2404" width="24" height="24"><path d="M291.221333 410.688c65.877333 0 119.488-53.589333 119.509333-119.488 0-65.877333-53.610667-119.488-119.509333-119.488-65.877333 0-119.488 53.610667-119.488 119.488C171.733333 357.098667 225.365333 410.688 291.221333 410.688zM291.221333 214.464c42.304 0 76.757333 34.432 76.778667 76.757333 0 42.346667-34.453333 76.757333-76.778667 76.757333s-76.757333-34.453333-76.757333-76.757333C214.464 248.896 248.896 214.464 291.221333 214.464z" p-id="2405"></path><path d="M855.424 0 168.554667 0C75.605333 0 0 75.626667 0 168.554667l0 637.696c0 0.085333 0 0.170667 0 0.234667L0 855.466667C0 948.373333 75.605333 1024 168.554667 1024L855.466667 1024c92.906667 0 168.533333-75.626667 168.533333-168.533333L1024 168.554667C1024 75.626667 948.373333 0 855.424 0zM168.554667 42.730667 168.554667 42.730667l686.869333 0.021333c69.376 0 125.824 56.448 125.824 125.802667l0 463.616L698.816 349.696c-8.362667-8.341333-21.845333-8.341333-30.208 0l-279.253333 279.253333-95.253333-95.253333c-8.384-8.384-21.866667-8.384-30.229333 0L42.730667 754.794667 42.730667 168.533333C42.730667 99.178667 99.178667 42.730667 168.554667 42.730667zM42.730667 855.424l0-40.213333 236.245333-236.16 402.218667 402.218667L168.554667 981.269333C99.178667 981.248 42.730667 924.8 42.730667 855.424zM855.424 981.248l-113.792 0L419.562667 659.178667 683.733333 395.029333l297.514667 297.536 0 162.858667C981.248 924.8 924.8 981.248 855.424 981.248z" p-id="2406"></path></svg>
                                            <el-dialog :visible.sync="dialogVisible">
                                                <img width="100%" :src="dialogImageUrl" alt="">
                                            </el-dialog>
                                        </el-upload>

                                    <el-button type="primary" size="mini" @click="submitForm('ruleForm')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send" len="98"><line x1="22" y1="2" x2="11" y2="13" len="0"></line><polygon points="22 2 15 22 11 13 2 9 22 2" len="0"></polygon></svg>
                                    </el-button>
                                </div>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
                <!-- ./ chat -->
                <div class="chat" v-else>
                    <el-empty :image-size="200"></el-empty>
                </div>

            </div>
            <!-- ./ content -->

        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    auth:true,
    name: "Chat",
    data(){
        return{
            ruleForm: {
                content: '',
            },
            chatForm: {
                user_id:'',
                desc: ''
            },
            Chatrules: {
                user_id:[
                    { required: true, message: '请选择用户', trigger: 'blur' }
                ],
                desc: [
                    { required: true, message: '请填写私信内容', trigger: 'blur' }
                ]
            },
            ws:null,
            chat_group:'',
            chat_online:[],
            choose_chat:'',
            memeber:'',
            timer:'',
            chatInfo:'',
            chat_last:'',
            chat_loadings:false,
            fileList: [],
            chatin_last:[],
            chat_index:0,
            limt:0,
            upimages: [],
            auths: {},
            dialogImageUrl: '',
            dialogChatPeople:false,
            dialogVisible: false,
            all_user:[],
            loading: false,
            dialog_loadings:false,
            title:'私信聊天',
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app}) {
        let [listA] = await Promise.all([
            app.$axios.$post("/api/get_user_chat"),
        ])
        return {
            chat_group: listA.data,
            chat_last:listA.chat_last,
            chatin_last:listA.chats
        }
    },
    created() {
        if (this.$store.state.auth.loggedIn) {
            const users = this.$store.state.auth.user;
            this.member = users;
            this.auths = {Authorization: "Bearer" + users.api_token};
            if (this.chat_last.length>0){
                this.chat_loadings = true;
                this.choose_chat=this.chat_last[0].id;
            }
            this.timer = setInterval(this.get_user_chat, 3000);
        }
    },
    beforeDestroy() {    //页面关闭时清除定时器
        clearInterval(this.timer);
    },
    mounted(){
        this.get_user_chat();
        // this.ws = new WebSocket('ws://127.0.0.1:9502');
        // this.ws.onopen = () =>{
        //     console.log("连接成功");
        //     this.ws.send('{"mode":"chat","chat_id":'+1+',"from_id":'+this.chat_group[this.chat_index].id+',"to_id":'+this.member.id+'}');
        // }
        //
        // this.ws.onmessage = (data) =>{
        //     var new_infomation = JSON.parse(data.data);
        //     this.chat_online = new_infomation.data;
        //     this.chatInfo = new_infomation.from_info;
        //     this.chat_loadings = false;
        //     this.go_down();
        // }
        //
        // this.ws.onclose = () =>{
        //
        // }

    },
    methods:{
        go_chatAll(){
          this.choose_chat='';
        },
        delete_chat(ids){
            return axios.post(`/api/delete_point_chat`,{id:ids}).then(res => {
                this.$message.success(res.data.msg);
                this.get_user_chat();
            })
        },
        remoteMethod(query) {
            if (query !== '') {
                this.loading = true;
                return axios.post(`/api/get_chatUser`,{nickname:query}).then(res => {
                    this.all_user=res.data.data;
                    this.loading=false;
                })
            } else {
                this.all_user = [];
            }
        },
        sendMessage_user(formName){
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.dialog_loadings=true;
                    return axios.post(`/api/sub_user_dialog`,{
                        from_id:this.chatForm.user_id,
                        to_id:this.member.id,
                        content:this.chatForm.desc,
                    }).then(res => {
                        if (res.data.status==401){
                            this.$message.warning(res.data.msg);
                        }else{
                            this.$message.success(res.data.msg);
                        }
                        this.dialog_loadings=false;
                        this.get_user_chat();
                        this.get_me_chat(this.choose_chat);
                    })
                } else {
                    this.$message.warning('请选择用户以及填写内容!');
                    return false;
                }
            });

        },
        chat_with(){
            this.dialogChatPeople=true;
        },
        go_down(){
            this.$nextTick(() => {
                let tablePar = this.$refs["table-container"];
                const timeTop = setInterval(() => {
                tablePar.scrollTop += 50;
                    if (tablePar.scrollTop >= tablePar.scrollHeight-490) {
                      clearInterval(timeTop); //清除定时器
                    }
                }, 10);
            });
        },
        get_user_chat(){
            this.get_me_chat();

            return axios.post(`/api/get_user_chat`).then(res => {
                this.chat_group=res.data.data;
                this.chat_last=res.data.chat_last;
                this.chatin_last = res.data.chats;
            })
        },
        chat_get(val_id,index){
            this.chat_index=index;
            this.chat_loadings =true;
            this.choose_chat = val_id;
            this.get_me_chat(val_id);
        },
        get_me_chat(ids){
            // this.ws.send('{"mode":"chat","chat_id":'+ids+',"from_id":'+this.chat_group[this.chat_index].id+',"to_id":'+this.member.id+'}');
            // this.ws.onmessage = (data) =>{
            //     var new_infomation = JSON.parse(data.data);
            //     this.chat_online = new_infomation.data;
            //     this.chatInfo = new_infomation.from_info;
            //     this.chat_loadings = false;
            //     this.go_down();
            // }
            return axios.post(`/api/get_connect_chat`,{
                chat_id: this.choose_chat,
            }).then(res => {
                this.chatInfo = res.data.from_info;
                this.chat_online = res.data.data;
                this.chat_loadings=false;
                this.go_down();
            })
        },
        sub_chat_info(){
            if (this.ruleForm.content=='' && this.upimages.length<=0){
                this.$message.warning('必须发布内容或上传图片');
            }else{
                this.chat_loadings=true;
                this.get_user_chat();
                return axios.post(`/api/sub_chat_info`,{
                    chat_id: this.choose_chat,
                    from_id:this.chatInfo.id,
                    to_id:this.member.id,
                    content:this.ruleForm.content,
                    upimages:this.upimages
                }).then(res => {
                    this.$message.success(res.data.msg);
                    this.ruleForm.content='';
                    this.upimages='';
                    this.chat_loadings=false;
                    this.get_user_chat();
                    this.get_me_chat(this.choose_chat);

                })
            }

        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.sub_chat_info();
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleRemove(file, fileList) {
        },
        handlePictureCardPreview(file) {
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        beforeUpload(file) {
            // 文件类型进行判断
            const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/png' || file.type === 'image/PNG' || file.type === 'image/JPG';
            const isLt2M = file.size / 1024 / 1024 < 5;
            if (!isJPG) {
                this.$message.error("上传图片只能是 JPG/PNG 格式!");
                return isJPG && isLt2M;
            }
            if (!isLt2M) {
                this.$message.error("上传图片大小不能超过 5MB!");
                return isJPG && isLt2M;
            }
            this.limt += 1;
        },

        uploadSuccess(res, file, filelist) {
            this.upimages = this.upimages.concat(res.files.file);
            console.log(res.files.file);
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
                { rel: 'icon', type: 'image/x-icon', href: this.ico },
            ]
        }
    }

}
</script>

<style>
.form-buttons .el-upload{
    background: #fff;
    width: 56px;
    height: 40px;
    line-height: 36px;
    border-radius: 4px;
    border: 1px solid #ddd;
    margin-right: 5px;
}
.form-buttons .el-upload-list--picture-card .el-upload-list__item{
    height: 100px;
    width: 100px;
}
.form-buttons .el-button{
    width: 56px;
    height: 40px;
}
.message-images .el-image{
    height: 120px;
    width: 120px;
}
</style>

<template>
    <div class="main mt-3 mb-3">
        <div id="authorhead" class="author-head mar20-b" v-if="is_shows">
            <div class="author-back" :style="{backgroundImage: 'url(' + userInfo.cover + ')'}" v-if="userInfo.cover">
                <div class="croppa-container  croppa--disabled-cc">
                    <canvas width="2280" height="480" style="width: 1140px; height: 240px; background-color: transparent;"></canvas>
                </div>
                <el-upload
                    v-if="is_author"
                    class="avatar-uploader"
                    action="/api/change_cover"
                    :show-file-list="false"
                    :on-success="handleAvatarSuccess"
                    :before-upload="beforeAvatarUpload">
                    <span class="changeback cu-poi"><i class="el-icon-camera mar5-r"></i>编辑封面</span>
                </el-upload>
            </div>
            <div class="author-back" v-else>
                <img src="@/assets/images/topbanner.png" alt="顶部图">
                <div class="croppa-container  croppa--disabled-cc">
                    <canvas width="2280"  height="480" style="width: 1140px; height: 240px; background-color: transparent;"></canvas>
                </div>
            </div>
            <div class="auther-info">
                <div class="auther-ava"><img alt="用户头像" :src="userInfo.pic"
                                             height="160" width="160" class="avatar avatar-160 photo gravatar"
                                             style="opacity: 1;"></div>
                <div class="auther-meta">
                    <h1>
                        <span>{{ userInfo.name }}</span>
                        <span v-if="userInfo.gender=='男'">
                            <svg t="1619329521725" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="11251" width="32" height="32"><path d="M874 120H622c-3.3 0-6 2.7-6 6v56c0 3.3 2.7 6 6 6h160.4L583.1 387.3c-50-38.5-111-59.3-175.1-59.3-76.9 0-149.3 30-203.6 84.4S120 539.1 120 616s30 149.3 84.4 203.6C258.7 874 331.1 904 408 904s149.3-30 203.6-84.4C666 765.3 696 692.9 696 616c0-64.1-20.8-124.9-59.2-174.9L836 241.9V402c0 3.3 2.7 6 6 6h56c3.3 0 6-2.7 6-6V150c0-16.5-13.5-30-30-30zM408 828c-116.9 0-212-95.1-212-212s95.1-212 212-212 212 95.1 212 212-95.1 212-212 212z" p-id="11252" fill="#409eff"></path></svg>
                        </span>
                        <span v-if="userInfo.gender=='女'">
                            <svg t="1619329849021" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="12726" width="32" height="32"><path d="M826.569697 197.042424C759.59596 130.19798 670.771717 93.349495 576.258586 93.349495s-183.466667 36.719192-250.311111 103.692929C259.10303 263.886869 222.254545 352.711111 222.254545 447.353535c0 84.428283 29.349495 164.331313 83.264647 228.072728L245.010101 735.935354l-101.624242-101.624243c-11.248485-11.248485-29.99596-10.860606-41.761617 0.905051-11.765657 11.765657-12.153535 30.513131-0.90505 41.761616L202.343434 778.60202l-91.668687 91.79798c-11.765657 11.765657-11.765657 30.90101 0 42.537374 11.765657 11.765657 30.90101 11.765657 42.537374 0L245.139394 821.010101l101.624242 101.624242c11.248485 11.248485 29.99596 10.860606 41.761617-0.90505 11.765657-11.765657 12.153535-30.513131 0.90505-41.761616L287.806061 778.343434l60.509091-60.509091c63.741414 53.915152 143.644444 83.264646 228.072727 83.264647 94.513131 0 183.337374-36.719192 250.311111-103.692929s103.692929-155.79798 103.692929-250.311112c-0.129293-94.513131-36.848485-183.337374-103.822222-250.052525zM576.258586 740.977778C414.383838 740.977778 282.634343 609.228283 282.634343 447.353535c0-162.00404 131.749495-293.753535 293.753536-293.753535S870.012121 285.349495 870.012121 447.353535c0 161.874747-131.749495 293.624242-293.753535 293.624243z m0 0" fill="#fe1f02" p-id="12727"></path></svg>
                        </span>
                        <span v-if="userInfo.gender==null">
                            <svg t="1619329926798" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="14186" width="32" height="32"><path d="M467.6608 572.8256H352.8704v-89.8048c74.6496-10.0352 132.1984-73.9328 132.1984-151.2448 0-84.2752-68.3008-152.6784-152.6784-152.6784S179.712 247.5008 179.712 331.776c0 77.312 57.5488 141.312 132.1984 151.2448v89.8048H197.0176c-11.264 0-20.48 9.216-20.48 20.48s9.216 20.48 20.48 20.48h114.8928v210.6368c0 11.264 9.216 20.48 20.48 20.48s20.48-9.216 20.48-20.48V613.7856h114.8928c11.264 0 20.48-9.216 20.48-20.48-0.1024-11.264-9.3184-20.48-20.5824-20.48zM332.3904 443.4944c-29.7984 0-57.856-11.5712-78.9504-32.6656s-32.6656-49.152-32.6656-78.9504c0-29.7984 11.5712-57.856 32.6656-78.9504s49.152-32.6656 78.9504-32.6656 57.856 11.5712 78.9504 32.6656 32.6656 49.152 32.6656 78.9504c0 29.7984-11.5712 57.856-32.6656 78.9504s-49.152 32.6656-78.9504 32.6656zM715.1616 540.8768v-291.84l93.696 93.696c7.9872 7.9872 20.992 7.9872 28.9792 0 7.9872-7.9872 7.9872-20.992 0-28.9792L710.144 185.9584c-0.3072-0.3072-0.512-0.6144-0.8192-0.9216-3.9936-3.9936-9.216-5.9392-14.5408-5.9392h-0.6144c-0.512 0-1.024 0-1.536 0.1024-0.3072 0-0.7168 0.1024-1.024 0.1024-0.3072 0-0.6144 0.1024-0.9216 0.1024-0.3072 0.1024-0.6144 0.1024-0.9216 0.2048-0.4096 0.1024-0.7168 0.2048-1.1264 0.3072-0.2048 0.1024-0.4096 0.1024-0.6144 0.2048-0.512 0.2048-0.9216 0.3072-1.3312 0.512-0.1024 0-0.1024 0.1024-0.2048 0.1024-2.3552 1.024-4.5056 2.4576-6.3488 4.3008-0.3072 0.3072-0.512 0.6144-0.8192 0.9216L551.7312 313.6512c-7.9872 7.9872-7.9872 20.992 0 28.9792 7.9872 7.9872 20.992 7.9872 28.9792 0l93.4912-93.4912v291.84c-74.5472 10.0352-132.096 73.9328-132.096 151.2448 0 84.2752 68.3008 152.6784 152.6784 152.6784S847.4624 776.4992 847.4624 692.224c0-77.4144-57.5488-141.312-132.3008-151.3472z m58.5728 230.2976c-21.0944 21.0944-49.152 32.6656-78.9504 32.6656-29.7984 0-57.856-11.5712-78.9504-32.6656s-32.6656-49.152-32.6656-78.9504 11.5712-57.856 32.6656-78.9504 49.152-32.6656 78.9504-32.6656c29.7984 0 57.856 11.5712 78.9504 32.6656 21.0944 21.0944 32.6656 49.152 32.6656 78.9504s-11.4688 57.856-32.6656 78.9504z" p-id="14187" fill="#707070"></path></svg>
                        </span>
                        <!--<img src="https://www.hmbk8.com/wp-content/themes/blackcat/assets/images/svg/level6.svg" class="user_level_set">-->
                    </h1>
                    <p v-if="verify_state!=0" class="author_verify">
                        <img src="@/assets/images/is_verify.png" :alt="web_name">
                        <span>{{web_name}}</span>
                    </p>
                    <p v-if="userInfo.description">{{ userInfo.description }}</p>
                    <p v-else>这个人很懒，啥也没有留下！</p>
                    <p class="info"><span>关注</span>
                        <span class="num mar5-l">{{ bfans }}</span>
                        <span class="mar10-l">粉丝</span>
                        <span class="num mar5-l">{{ fans }}</span>
                        <span class="mar10-l">积分</span>
                        <span class="num mar5-l">{{userInfo.integral}}</span></p>
                    <div class="auther-btn">
                        <el-button @click="dialogMessage=true" :loading="sub_loadng">
                            发送私信
                        </el-button>
                        <el-button type="primary" @click="follow_me" :loading="btn_loading" v-if="is_follow">
							关注
                        </el-button>
                        <el-button type="primary" @click="follow_me" :loading="btn_loading" v-else>
                            取消关注
                        </el-button>
                        <!--<el-button type="primary">-->
                        <!--     <span>-->
						<!--    发私信-->
						<!--    </span>-->
                        <!--</el-button>-->
                    </div>
                </div>
            </div>
        </div>
        <el-dialog
            title="发送私信"
            :visible.sync="dialogMessage"
            width="30%"
            >
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
                <el-form-item label="私信内容" prop="desc">
                    <el-input type="textarea" v-model="ruleForm.desc" :rows="4" placeholder="说点什么吧~"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitForm('ruleForm')">立即发送</el-button>
                </el-form-item>
            </el-form>

        </el-dialog>
        <!--tab to me-->
        <div class="author_me"  v-if="is_shows">
            <el-row :gutter="10">
                <el-col :xs="24" :sm="18" :md="18" :lg="18" :xl="18">
                    <el-tabs v-model="activeName">
                        <el-tab-pane label="文章发布" name="first">
                            <ul class="box-list clearfix code-list mybox-list" v-loading="loadings"  v-if="posts">
                                <el-row :gutter="20">
                                <el-col :xs="12" :sm="6" :md="4" :lg="6" :xl="6" :span="6" v-for="(item,k) in posts"
                                        class="list-animation-leftIn" :key="k"
                                        :class="delay(k)">
                                    <li>
                                        <nuxt-link ref="nofollow" :to="'/post/'+item.id">
                                            <div class="cover-img-center-max coverimg-li">
                                                <div class="cover-img-center-max coverimg-li">
                                                    <span class="pack_p_rt" v-if="parseFloat(item.vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                                    <img :src="item.cover" :alt="item.title">
                                                </div>
                                            </div>
                                        </nuxt-link>
                                        <div class="tag-span-tool">
                                            <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                                <span class="el-tooltip today-update v-3 item"></span>
                                                <span class="cate_name">{{ item.name }}</span>
                                            </nuxt-link>
                                            <span class="float-right">{{ formatDate(item.create_time) }}</span>
                                        </div>
                                        <nuxt-link ref="nofollow" :to="'/post/'+item.id">
                                            <div class="li-tit">
                                                {{ item.title }}
                                            </div>
                                        </nuxt-link>
                                        <div class="desc-li">
                                            <div class="author-bar">
                                                <nuxt-link :to="'/user/'+item.author_id">
                                                    <span><img :src="item.pic" :alt="item.title"></span>
                                                    <span>{{ item.userInfo }}</span>
                                                </nuxt-link>

                                            </div>
                                            <div class="cont-bar">
                                                <span><i class="iconfont icon-liulan8"></i>{{ item.view }}</span>
                                                <span><i class="iconfont icon-shoucang4"></i>{{
                                                        item.likes
                                                    }}</span>
                                            </div>
                                        </div>
                                    </li>
                                </el-col>
                            </el-row>
                            </ul>
                            <el-pagination background
                                           layout="prev, pager, next"
                                           v-show="total>0"
                                           :total="total"
                                           :page-size="limit"
                                           @size-change="handleSizeChange"
                                           @current-change="handleCurrentChange">
                            </el-pagination>
                            <Notfound v-if="posts.length <= 0"></Notfound>
                        </el-tab-pane>
                        <el-tab-pane label="收藏文章" name="second">
                            <ul class="box-list clearfix code-list mybox-list" v-if="collect" v-loading="loadings">
                                <el-row :gutter="20">
                                    <el-col :xs="12" :sm="6" :md="4" :lg="6" :xl="6" :span="6" v-for="(item,k) in collect"
                                            class="list-animation-leftIn" :key="k"
                                            :class="delay(k)">
                                        <li>
                                            <nuxt-link ref="nofollow" :to="'/post/'+item.id">
                                                <div class="cover-img-center-max coverimg-li">
                                                    <div class="cover-img-center-max coverimg-li">
                                                        <span class="pack_p_rt" v-if="parseFloat(item.vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                                        <img :src="item.cover" :alt="item.title">
                                                    </div>
                                                </div>
                                            </nuxt-link>
                                            <div class="tag-span-tool">
                                                <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                                    <span class="el-tooltip today-update v-3 item"></span>
                                                    <span class="cate_name">{{ item.name }}</span>
                                                </nuxt-link>
                                                <span class="float-right">{{ formatDate(item.create_time) }}</span>
                                            </div>
                                            <nuxt-link ref="nofollow" :to="'/post/'+item.id">
                                                <div class="li-tit">
                                                    {{ item.title }}
                                                </div>
                                            </nuxt-link>
                                            <div class="desc-li">
                                                <div class="author-bar">
                                                    <nuxt-link :to="'/user/'+item.author_id">
                                                        <span><img :src="item.pic" :alt="item.title"></span>
                                                        <span>{{ item.userInfo }}</span>
                                                    </nuxt-link>
                                                </div>
                                                <div class="cont-bar">
                                                    <span><i class="iconfont icon-liulan8"></i>{{ item.view }}</span>
                                                    <span><i class="iconfont icon-shoucang4"></i>{{
                                                            item.likes
                                                        }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    </el-col>
                                </el-row>
                            </ul>
                            <el-pagination background
                                           layout="prev, pager, next"
                                           v-show="totals>0"
                                           :total="totals"
                                           :page-size="limit"
                                           @size-change="handleSizeChange"
                                           @current-change="handleCurrentChange">
                            </el-pagination>
                            <Notfound v-if="collect.length <= 0"></Notfound>
                        </el-tab-pane>
                        <el-tab-pane label="关注人群" name="third">
                            <div id="user_like" v-if="bfans_user">
                                <el-row :gutter="20">
                                    <el-col :xs="12" :sm="6" :md="4" :lg="6" :xl="6" :span="6" v-for="(item,index) in bfans_user"
                                            class="list-animation-leftIn">
                                    <li class="pic-btn-li">
                                        <div class="li-pic">
                                            <nuxt-link :to="'/user/'+item.id">
                                                <img :alt="item.name" :src="item.pic">
                                            </nuxt-link>
                                            <nuxt-link :to="'/user/'+item.id">
                                            </nuxt-link>
                                        </div>
                                        <div class="li-dec">
                                            <p class="dec-name">
                                                <nuxt-link :to="'/user/'+item.id" class="dec-name-link">
                                                    {{item.name}}
                                                </nuxt-link>
                                            </p>
                                            <p class="dec-sub"><span class="dec-fans">粉丝 {{ bfans_user_count[index] }}</span>
                                            </p>
                                        </div>
                                    </li>
                                    </el-col>
                                </el-row>
                            </div >
                            <Notfound v-if="bfans_user.length <= 0"></Notfound>
                        </el-tab-pane>
                        <el-tab-pane label="粉丝人群" name="fourth">
                            <div id="bguanzhu" v-if="fans_user">
                                <el-row :gutter="20">
                                    <el-col :xs="12" :sm="6" :md="4" :lg="6" :xl="6" :span="6" v-for="(item,index) in fans_user"
                                            class="list-animation-leftIn">
                                        <li class="pic-btn-li">
                                            <div class="li-pic">
                                                <nuxt-link :to="'/user/'+item.id">
                                                    <img :alt="item.name" :src="item.pic">
                                                </nuxt-link>
                                                <nuxt-link :to="'/user/'+item.id">
                                                </nuxt-link>
                                            </div>
                                            <div class="li-dec">
                                                <p class="dec-name">
                                                    <nuxt-link :to="'/user/'+item.id" class="dec-name-link">
                                                        {{item.name}}
                                                    </nuxt-link>
                                                </p>
                                                <p class="dec-sub"><span class="dec-fans">粉丝 {{ fans_user_count[index] }}</span>
                                                </p>
                                            </div>
                                        </li>
                                    </el-col>
                                </el-row>
                            </div>
                            <Notfound v-if="fans_user.length <= 0"></Notfound>
                        </el-tab-pane>
                    </el-tabs>
                </el-col>
                <el-col :xs="24" :sm="6" :md="6" :lg="6" :xl="6">
                    <div class="dev-user-aside-footer">
                        <img src="@/assets/images/zuji.png">
                        <span class="dev-time dev-time-normal ivu-time">
							该用户于{{ rTime(userInfo.created_at) }}加入本站
                        </span>
                    </div>
                    <div class="Card FollowshipCard mt-3">
                        <div class="NumberBoard FollowshipCard-counts NumberBoard--divider">
                            <div  type="button" class="Button NumberBoard-item Button--plain" >
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">文章数</div>
                                <strong class="NumberBoard-itemValue" :title="total">{{ total }}</strong>
                            </div>
                        </div>
                            <div type="button" class="Button NumberBoard-item Button--plain">
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">收藏数</div>
                                <strong class="NumberBoard-itemValue" :title="totals">{{ totals }}</strong></div>
                        </div>
                        </div>
                    </div>
                </el-col>
            </el-row>
        </div>


        <!--tab to me end-->
        <Notfound v-if="is_shows==false"></Notfound>
    </div>
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
    auth:false,
    name: "user",
    data(){
        return{
            is_shows:true,
            userInfo:'',
            fans:'',
            bfans:'',
            activeName: 'first',
            posts:'',
            collect:'',
            page: 1,
            limit: 20,
            total:0,
            totals:0,
            loadings:false,
            bfans_user:'',
            bfans_user_count:'',
            fans_user:'',
            fans_user_count:'',
            btn_loading:false,
            is_follow:true,
            is_author:false,
            dialogMessage:false,
            verify_state:0,
            web_name:'',
            title: '',
            login_userid:'',
            sub_loadng:false,
            ruleForm: {
                desc: ''
            },
            rules: {
                desc: [
                    { required: true, message: '请填写私信内容', trigger: 'blur' }
                ]
            },
            title_for: this.WebConfigs('title'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico:this.WebConfigs('ico')
        }
    },
    async asyncData({app,params,store}) {
        try {
            let [listA,listB,listC,listD]=await Promise.all([
                app.$axios.$get(`/api/getUserId`, {params: {id: params.id}}),
                app.$axios.$get(`/api/getUserPost`, {params: {id: params.id}}),
                app.$axios.$get(`/api/getUserBfans`, {params: {id: params.id}}),
                app.$axios.$get(`/api/getUserVerify`, {params: {id: params.id}}),
            ]);
            if (listD.data !=null){
                return {
                    userInfo:listA.userInfo,
                    fans:listA.fans,
                    bfans:listA.bfans,
                    posts:listB.posts,
                    total:listB.count,
                    collect:listB.collect,
                    totals:listB.collect_count,
                    bfans_user:listC.bfans,
                    bfans_user_count:listC.bfans_fans,
                    fans_user:listC.fans,
                    fans_user_count:listC.fans_fans,
                    title:listA.userInfo.name,
                    verify_state:listD.data.state,
                    web_name:listD.data.web_name
                };
            }else{
                return {
                    userInfo:listA.userInfo,
                    fans:listA.fans,
                    bfans:listA.bfans,
                    posts:listB.posts,
                    total:listB.count,
                    collect:listB.collect,
                    totals:listB.collect_count,
                    bfans_user:listC.bfans,
                    bfans_user_count:listC.bfans_fans,
                    fans_user:listC.fans,
                    fans_user_count:listC.fans_fans,
                    title:listA.userInfo.name,
                };
            }

        } catch (error) {
            return{
                is_shows: false,
            }
        }
    },
    created() {
        if (this.$store.state.auth.loggedIn) {
            this.login_userid = this.$store.state.auth.user.id;
        }
        this.isTofollow();
        this.coverIs();
    },
    methods:{
        submitForm(formName) {
            this.sub_loadng=true;
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    return axios.post(`/api/sub_chat_dialog`, {
                        to_id:this.$store.state.auth.user.id,
                        from_id:this.userInfo.id,
                        content:this.ruleForm.desc
                    }).then(res => {
                        if (res.data.status==201){
                            this.$message.warning(res.data.msg)
                        }else if(res.data.status==401){
                            this.$message.warning(res.data.msg)
                        }else if (res.data.status==200){
                            this.$message.success(res.data.msg)
                        }
                        this.sub_loadng = false;
                    })
                } else {
                    this.sub_loadng = false;
                    console.log('error submit!!');
                    return false;
                }
            });
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
        delay(index) {
            return 'delay-' + index;
        },
        rTime(date) {
            let json_date = new Date(date).toJSON();
            return new Date(+new Date(json_date) + 8 * 3600 * 1000).toISOString().replace(/T/g, ' ').replace(/\.[\d]{3}Z/, '')
        },
        handleSizeChange(val) {
            console.log(`每页 ${val} 条`);
        },
        handleCurrentChange(val) {
            this.loadings = true;
            this.page = val;
            return axios.get(`/api/getUserPost`, {
                params: {
                    id: this.$route.params.id,
                    page: this.page,
                    limit: this.limit,
                }
            }).then(res => {
                this.loadings = false;
                this.posts = res.data.posts;
                this.total = res.data.count
            })
        },
        coverIs(){
            return axios.get(`/api/coverIs`, {
                params: {
                    id: this.$route.params.id,
                    userid:this.login_userid
                }
            }).then(res => {
                if (res.data.status==200 && res.data.is=='yes'){
                    this.is_author=true;
                }else{
                    this.is_author=false;
                }
            })
        },
        follow_me(){
            this.btn_loading = true;
            return axios.post(`/api/follow_me`, {
                    id: this.$route.params.id,
                    userid:this.$store.state.auth.user.id
            }).then(res => {
                if (res.data.status==201){
                    this.$message.warning(res.data.msg)
                }else if (res.data.status==200){
                    this.$message.success(res.data.msg)
                    this.isTofollow()
                }
                this.btn_loading = false;
            })
        },
        handleAvatarSuccess(res, file) {
            this.userInfo.cover = res.files.file;
            if (res.status == 200) {
                this.$message.success(res.msg)
            }
        },
        beforeAvatarUpload(file) {
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
        },
        isTofollow(){
            this.btn_loading=true;
            return axios.get(`/api/isFollo`, {
                params: {
                    id: this.$route.params.id,
                    userid:this.login_userid
                }
            }).then(res => {
                this.btn_loading=false;
                if (res.data.is == 'yes'){
                    this.is_follow=false
                }else{
                    this.is_follow=true
                }
            })
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

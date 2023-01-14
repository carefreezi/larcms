<template>
    <footer>
        <div class="footerTop">
            <div class="main">
                <el-row :gutter="10" justify="center">
                    <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8">
                        <div class="tit-footer">
                            关于我们
                        </div>
                        <img :src="this.$store.state.webConfig[12].option_value" alt="">
                        <div class="desc-footer" v-html="abouts">
                        </div>
                    </el-col>
                    <el-col :xs="8" :sm="5" :md="4" :lg="4" :xl="4">
                        <div class="tit-footer">
                            网站协议
                        </div>
                        <div class="desc-footer">
                            <nuxt-link :to="'/announcement/'+item.id" v-for="item in servces" v-if="item.types ==1">
                                <div >{{ item.title }}</div>
                            </nuxt-link>
                        </div>
                    </el-col>
                    <el-col :xs="8" :sm="5" :md="4" :lg="4" :xl="4">
                        <div class="tit-footer">
                            支持服务
                        </div>
                        <div class="desc-footer">
                            <nuxt-link :to="'/announcement/'+item.id" v-for="item in servces" v-if="item.types ==2">
                                <div >{{ item.title }}</div>
                            </nuxt-link>
                        </div>
                    </el-col>
                    <el-col :xs="8" :sm="5" :md="5" :lg="5" :xl="5">
                        <div class="tit-footer">
                            热门推荐
                        </div>
                        <div class="desc-footer">
                            <nuxt-link :to="'/announcement/'+item.id" v-for="item in servces" v-if="item.types ==3">
                                <div >{{ item.title }}</div>
                            </nuxt-link>
                        </div>
                    </el-col>
                    <el-col :xs="8" :sm="5" :md="3" :lg="3" :xl="3" class="mobile_show">
                        <div class="footerIocnbox clearfix">
                            <div>
                                <div>
                                    <i class="iconfont icon-weibo-copy wbi"></i>
                                </div>
                                <a :href="weibos" target="_blank">联系微博</a>
                            </div>
                            <div>
                                <div>
                                    <i class="iconfont icon-weixin wxi"></i>
                                </div>
                                <a :href="wechats" target="_blank">联系微信</a>
                            </div>
                        </div>
                        <div class="vippeorbox">
                            <div>
                                优秀会员
                            </div>
                            <div class="vipcountbox">
                                <span class="vipcount timer">{{ peoples }}</span><span>人</span>
                            </div>
                        </div>
                    </el-col>
                </el-row>
            </div>
        </div>
        <div class="footerBottom">
            <div class="main">
                <div class="fLink">
                    友情链接:
                    <span v-for="item in friends"><a :href="item.link" target="_blank">{{ item.name }}</a></span>
                </div>
                <div class="Copyright">
                    {{ copyright }}
                </div>
            </div>
        </div>
        <!--bottom tabs-->
        <div class="foot_tabs mobile_hide" :class="down?'foot_down':''">
            <el-row :gutter="20">
                <el-col :span="5">
                    <div class="tabs_index">
                        <nuxt-link to="/">
                            <span>
                                <i class="iconfont icon-daohanglan_kongzhitaiicon_moren" ></i>
                            </span>
                            <b>
                                首页
                            </b>
                        </nuxt-link>
                    </div>
                </el-col>
                <el-col :span="5">
                    <div class="tabs_index">
                        <nuxt-link to="/special">
                            <span>
                                <i class="el-icon el-icon-copy-document" ></i>
                            </span>
                            <b>
                                专题
                            </b>
                        </nuxt-link>
                    </div>
                </el-col>

                <el-col :span="4">
                    <div class="tabs_index write_foot" v-if="userToken==''" @click="dialogLogin = true">
                            <span>
                                <i class="el-icon el-icon-plus" ></i>
                            </span>
                    </div>
                    <div class="tabs_index write_foot" v-else>
                        <nuxt-link to="/member/write">
                            <span>
                                <i class="el-icon el-icon-plus" ></i>
                            </span>
                        </nuxt-link>
                    </div>
                </el-col>
                <el-col :span="5">
                    <div class="tabs_index" @click="dialogS=true">
                            <span>
                                <i class="el-icon el-icon-search"></i>
                            </span>
                        <b>
                            搜索
                        </b>
                    </div>
                </el-col>
                <el-col :span="5">
                    <div class="tabs_index" v-if="userToken==''" @click="dialogLogin = true">
                            <span>
                                <i class="iconfont icon-daohanglan_zhanghaoguanliicon_moren" ></i>
                            </span>
                            <b>
                                我的
                            </b>
                    </div>
                    <div class="tabs_index" v-else>
                        <nuxt-link to="/member">
                            <span>
                                <i class="iconfont icon-daohanglan_zhanghaoguanliicon_moren" ></i>
                            </span>
                        <b>
                            我的
                        </b>
                        </nuxt-link>
                    </div>
                </el-col>
            </el-row>

        </div>
        <!--bottom tabs end-->
        <el-backtop></el-backtop>
        <Logins :loginto="dialogLogin" :regto="dialogReg" @newlogin="newslog" @newreg="newsreg"></Logins>

        <el-dialog
            :visible.sync="dialogS"
            width="90%"
            center
            class="search-dialog"
        >
            <span slot="title">搜索一下可能来得更快</span>
            <el-form ref="form" @submit.native.prevent>
                <el-form-item>
                    <el-input v-model="search_title" placeholder="想搜索点什么？"
                              @keyup.enter.native="search_go"></el-input>
                </el-form-item>
            </el-form>
            <div class="search_button">
                <el-button type="primary" @click="search_go">立即搜索</el-button>
            </div>
        </el-dialog>
    </footer>
</template>

<script>
import {bottominformation} from '~/plugins/index';
export default {
    name: "Footer",
    data() {
        return {
            friends:[],
            abouts:'',
            wechats:'',
            weibos:'',
            servces:[],
            copyright:'',
            peoples:'',
            down:false,
            dialogS: false,
            down_top:0,
            search_title: '',
            dialogLogin: false,
            dialogReg: false,
            userToken:'',
        }
    },
    async created() {
        if (this.$store.state.auth.loggedIn) {
            this.userToken = this.$store.state.auth.user.api_token;
        }
        const footers = await bottominformation();
        this.friends = footers.friend;
        this.abouts = footers.about;
        this.weibos =footers.weibo;
        this.wechats =footers.wechat;
        this.servces =footers.sevice;
        this.copyright = footers.copyright;
        this.peoples = footers.peoples;

    },
    watch:{
      down_top(newVal,oldVal){
          if(oldVal>newVal){
              this.down=false;
          }else{
              this.down=true;
          }
      }
    },
    mounted() {
        // 滚动条的获取
        window.addEventListener('scroll', this.handleScrollx, true)
    },
    methods:{
        search_go() {
            if (this.search_title == '') {
                this.$message({
                    message: '请输入搜索内容！',
                    type: 'warning',
                });
            } else {
                this.$router.push("/search/" + this.search_title);
                this.search_title == '';
                this.dialogS = false;
            }
        },
        newsreg(data) {
            this.dialogReg = data
        },
        newslog(data) {
            this.dialogLogin = data
        },
        handleScrollx() {
            this.down_top=window.pageYOffset;
        }
    }
}
</script>

<style>
.footerIocnbox clearfix a{
    color: #979797;
}
.logins{
    line-height:70px;
}
.regs{
    line-height:70px;
}
</style>

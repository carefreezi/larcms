<template>
    <header>
        <div class="app-header-topbar dk pc-model black">
            <div class="app-header-main">
                <nav class="nav top-bar-nav flex pc_nav">
                    <a :href="item.url" class="nav-link" v-for="(item,index) in topUrls" target="_blank">{{
                            item.title
                        }}</a>
                </nav>
                <el-dropdown trigger="click" class="mobile_hide">
                      <span class="el-dropdown-link">
                        传送门<i class="el-icon-arrow-down el-icon--right"></i>
                      </span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item v-for="(item,index) in topUrls">
                            <a :href="item.url" target="_blank">{{ item.title }}</a>
                        </el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
                <nav class="nav justify-content-end">
                    <a class="nav-link px-2" :class="$colorMode.value == 'light' ? 'active' : '' "
                       @click="theme('light')">
                        <i class="fs-14 v-m-1 mr-1 iconfont icon-check-circle" v-if="$colorMode.value == 'light'"></i>
                        明亮
                    </a>
                <!--    <a class="nav-link px-2" :class="$colorMode.value == 'old' ? 'active' : '' "-->
                <!--           @click="theme('old')">-->
                <!--    <i class="fs-14 v-m-1 mr-1 iconfont icon-check-circle" v-if="$colorMode.value == 'old'"></i>-->
                <!--    复古-->
                <!--</a><a class="nav-link px-2" :class="$colorMode.value == 'eyes' ? 'active' : '' "-->
                <!--       @click="theme('eyes')">-->
                <!--    <i class="fs-14 v-m-1 mr-1 iconfont icon-check-circle" v-if="$colorMode.value == 'eyes'"></i>-->
                <!--    护眼-->
                <!--</a><a class="nav-link px-2" :class="$colorMode.value == 'sea' ? 'active' : '' " @click="theme('sea')">-->
                <!--    <i class="fs-14 v-m-1 mr-1 iconfont icon-check-circle" v-if="$colorMode.value == 'sea'"></i>-->
                <!--    海天-->
                <!--</a><a class="nav-link px-2" :class="$colorMode.value == 'long' ? 'active' : '' "-->
                <!--       @click="theme('long')">-->
                <!--    <i class="fs-14 v-m-1 mr-1 iconfont icon-check-circle" v-if="$colorMode.value == 'long'"></i>-->
                <!--    深邃-->
                <!--</a>-->
                    <a class="nav-link px-2" :class="$colorMode.value == 'dark' ? 'active' : '' "
                       @click="theme('dark')">
                        <i class="fs-14 v-m-1 mr-1 iconfont icon-check-circle" v-if="$colorMode.value == 'dark'"></i>
                        暗黑
                    </a>
                    <a class="nav-link px-2" :class="$colorMode.value == 'system' ? 'active' : '' "
                       @click="theme('system')">
                        自动
                    </a> <span></span></nav>
            </div>
        </div>

        <div class="main fontcolor mar-4">
            <div class="meunlist clearfix">
                <!--mobile menu-->
                <div class="mobile_hide">
                    <div @click="isopen" class="hor-menu">
                        <svg t="1629791141763" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="28944" width="200" height="200"><path d="M920.1 291.8h-820c-18.8 0-34-15.2-34-34s15.2-34 34-34h820c18.8 0 34 15.2 34 34s-15.2 34-34 34zM549.1 547.2h-449c-18.8 0-34-15.2-34-34s15.2-34 34-34h449c18.8 0 34 15.2 34 34s-15.2 34-34 34zM783.4 812.4H100.1c-18.8 0-34-15.2-34-34s15.2-34 34-34h683.3c18.8 0 34 15.2 34 34s-15.2 34-34 34z" fill="#606266" p-id="28945"></path></svg>
                    </div>
                    <el-drawer
                        title="导航中心"
                        :visible.sync="drawer"
                        :direction="direction"
                    >
                        <el-menu
                            default-active="0"
                            class="el-menu-vertical-demo"
                            @close="handleClose"
                        >
                            <el-menu-item index="0">
                                <i class="el-icon-menu"></i>
                                <nuxt-link to="/">
                                    首页
                                </nuxt-link>
                            </el-menu-item>
                            <el-submenu v-if="item.all_children.length>0" v-for="(item,k) in heads"
                                        :index="item.id.toString()" :key="k" class="123">
                                <template slot="title">
                                    <nuxt-link :to="'/category/'+item.other">
                                        {{ item.name }}
                                    </nuxt-link>
                                </template>
                                <el-menu-item v-if="lat.all_children==undefined||lat.all_children.length<=0"
                                              v-for="(lat,d) in item.all_children"
                                              :index="lat.id.toString()" :key="d">
                                    <nuxt-link :to="'/category/'+lat.other">
                                        {{ lat.name }}
                                    </nuxt-link>
                                </el-menu-item>

                                <el-submenu v-if="lat.all_children.length>0" v-for="(lat,s) in item.all_children"
                                            :index="lat.id.toString()" :key="s">
                                    <template slot="title">
                                        <nuxt-link :to="'/category/'+lat.other">
                                            {{ lat.name }}
                                        </nuxt-link>
                                    </template>
                                    <el-menu-item v-for="(less,f) in lat.all_children"
                                                  :index="less.id.toString()" :key="f">
                                        <nuxt-link :to="'/category/'+less.other">
                                            {{ less.name }}
                                        </nuxt-link>
                                    </el-menu-item>
                                </el-submenu>
                            </el-submenu>
                            <el-menu-item v-if="item.all_children==undefined||item.all_children.length<=0"
                                          v-for="(item,k) in heads" :index="item.id.toString()" :key="k">
                                <nuxt-link :to="'/category/'+item.other">
                                    {{ item.name }}
                                </nuxt-link>
                            </el-menu-item>
                        </el-menu>
                    </el-drawer>
                </div>
                <!--mobile menu end-->
                <div class="logo" title="回到主页" @click="homeBack">
                    <img :src="this.WebConfigs('logo_light')" class="logoi"
                         alt="logo">
                </div>
                <div class="meun">
                    <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal">
                        <!--一级-->
                        <el-menu-item v-if="item.all_children==undefined||item.all_children.length<=0"
                                      v-for="(item,k) in heads" :index="item.id.toString()" :key="k"
                                      :style="'order:'+item.id">
                            <nuxt-link :to="'/category/'+item.other">
                                {{ item.name }}
                            </nuxt-link>
                        </el-menu-item>
                        <!--一级结束-->
                        <el-submenu v-if="item.all_children.length>0" v-for="(item,k) in heads"
                                    :index="item.id.toString()" :key="k" :style="'order:'+item.id">
                            <template slot="title">
                                <nuxt-link :to="'/category/'+item.other">
                                    {{ item.name }}
                                </nuxt-link>
                            </template>
                            <el-menu-item v-if="lat.all_children==undefined||lat.all_children.length<=0"
                                          v-for="(lat,d) in item.all_children"
                                          :index="lat.id.toString()" :key="d">
                                <nuxt-link :to="'/category/'+lat.other">
                                    {{ lat.name }}
                                </nuxt-link>
                            </el-menu-item>
                            <el-submenu v-if="lat.all_children.length>0" v-for="(lat,s) in item.all_children"
                                        :index="lat.id.toString()" :key="s">
                                <template slot="title">
                                    <nuxt-link :to="'/category/'+lat.other">
                                        {{ lat.name }}
                                    </nuxt-link>
                                </template>
                                <el-menu-item v-for="(less,f) in lat.all_children"
                                              :index="less.id.toString()" :key="f">
                                    <nuxt-link :to="'/category/'+less.other">
                                        {{ less.name }}
                                    </nuxt-link>
                                </el-menu-item>
                            </el-submenu>
                        </el-submenu>
                    </el-menu>
                </div>
                <div class="userBox">
                    <!--login before-->
                    <div class="noLoginBox" v-if="userToken == null">
                        <div class="toSearch" @click="dialogS=true">
                            <i class="el-icon el-icon-search"></i>
                        </div>
                        <el-dialog
                            :visible.sync="dialogS"
                            width="30%"
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
                        <el-button icon="el-icon-user" circle @click="dialogLogin = true"
                                   class="mobile_hide"></el-button>
                        <el-button icon="el-icon-user" size="small" @click="dialogLogin = true" class="pc_nav">登录
                        </el-button>
                        <el-button type="primary" icon="el-icon-edit" size="small" @click="dialogReg = true"
                                   class="pc_nav">注册
                        </el-button>
                        <Logins :loginto="dialogLogin" :regto="dialogReg" @newlogin="newslog" @newreg="newsreg"
                                @newToken="get_token" @newpic="new_pic"></Logins>
                    </div>

                    <!--login before-->
                    <!--login after-->
                    <div class="isLoginbox child-list" v-if="userToken != null">
                        <div class="userBoxImagesG clearfix">
                            <div class="toSearch" @click="dialogS=true">
                                <i class="el-icon el-icon-search"></i>
                            </div>
                            <el-dialog
                                :visible.sync="dialogS"
                                width="30%"
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
                            <el-popover
                                placement="bottom"
                                width="300"
                                trigger="hover"
                            >
                                <el-avatar :src="user_pic" slot="reference" alt="用户头像"></el-avatar>
                                <!--avatar infos-->
                                <div id="hub_user_sign_div" class="user_sign_div">
                                    <a href="javascript: void(0)" class="qiandaobtn click-qiandao" @click="sign">
                                        <div v-if="qiandao_status">
                                            <i class="el-icon el-icon-loading"></i>
                                            签到中
                                        </div>
                                        <div v-else>
                                            <i class="el-icon el-icon-position"></i>
                                            签到领积分
                                        </div>

                                    </a>
                                </div>
                                <div class="head-user-ava-cen b-b">

                                    <img alt=""
                                         :src="user_pic"
                                         height="96" width="96"
                                         style="opacity: 1;">
                                    <div class="users_head_info">
                                        <span>{{ user_name }}</span>
                                        <div>
                                            <el-tooltip class="item" effect="dark" :content="'到期时间：'+vip_info"
                                                        placement="top" v-if="is_vip">
                                                <div class="dev-user-info-detail-vip">
                                                    <svg t="1622099565827" viewBox="0 0 1024 1024" version="1.1"
                                                         xmlns="http://www.w3.org/2000/svg" p-id="7603" width="48"
                                                         height="48">
                                                        <path
                                                            d="M536.149333 896H222.037333L661.802667 128h314.112L536.149333 896zM384 464.128V213.333333H128v85.333334h85.333333v463.488l170.666667-298.026667z"
                                                            p-id="7604" fill="#409eff"></path>
                                                    </svg>
                                                    <span>会员</span>
                                                </div>
                                            </el-tooltip>
                                            <el-tooltip class="item" effect="dark" content="暂未开通会员" placement="top"
                                                        v-else>
                                                <div class="dev-user-info-detail-vip">
                                                    <svg t="1622099557741" viewBox="0 0 1024 1024" version="1.1"
                                                         xmlns="http://www.w3.org/2000/svg" p-id="7460" width="48"
                                                         height="48">
                                                        <path
                                                            d="M536.149333 896H222.037333L661.802667 128h314.112L536.149333 896zM384 464.128V213.333333H128v85.333334h85.333333v463.488l170.666667-298.026667z"
                                                            p-id="7461"></path>
                                                    </svg>
                                                    <span>普通用户</span>
                                                </div>
                                            </el-tooltip>
                                            <div class="userlv">
                                                <div class="mar5-r">余额</div>
                                                <span>{{ user_balance }}</span>
                                                <div class="mar5-r">积分</div>
                                                <span>{{ user_integral }}</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="head-user-other">
                                    <nuxt-link to="/member/message">
                                        <img src="@/assets/images/infos/tongzhi.svg">
                                        <span class="mar10-l">消息</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <nuxt-link to="/member/wallet">
                                        <img src="@/assets/images/infos/qianbao.svg">
                                        <span class="mar10-l">钱包</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <nuxt-link to="/member/vip">
                                        <img src="@/assets/images/infos/vip.svg">
                                        <span class="mar10-l">会员</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <nuxt-link to="/member/write">
                                        <img src="@/assets/images/infos/write.svg">
                                        <span class="mar10-l">发布</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <nuxt-link to="/member">
                                        <img src="@/assets/images/infos/setting.svg">
                                        <span class="mar10-l">设置</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <nuxt-link to="/member/verify">
                                        <img src="@/assets/images/infos/ver.svg">
                                        <span class="mar10-l">认证</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <nuxt-link to="/member/suggestion">
                                        <img src="@/assets/images/infos/suggestion.svg">
                                        <span class="mar10-l">反馈</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </nuxt-link>
                                    <a href="javascript:;" @click="logouts">
                                        <img src="@/assets/images/infos/tuichu.svg">
                                        <span class="mar10-l">退出</span>
                                        <i class="el-icon el-icon-arrow-right"></i>
                                    </a>
                                </div>
                                <!--avatar infos end-->
                            </el-popover>
                        </div>
                    </div>
                    <!--login after end-->
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import {headGet, topUrl} from '~/plugins/index'
import {captcha} from '~/plugins/index'
import {login} from '~/plugins/index';
import {register} from '~/plugins/index';
import {me} from '~/plugins/index';
import {mapActions} from "vuex";
import cookie from "js-cookie";
import axios from 'axios'

import {user_sign} from '~/plugins/index';
import {get_user_sign} from '~/plugins/index';

export default {
    name: "Header",
    data() {
        return {
            heads: [],
            activeIndex: '',
            dialogLogin: false,
            dialogReg: false,
            wechat_out: true,
            wechat_on: false,
            userToken: null,
            loading: true,
            usersInfo: '',
            me: '',
            user_pic: '',
            dialogS: false,
            //侧边栏
            search_title: '',
            topUrls: '',
            drawer: false,
            direction: 'ltr',
            user_balance: '',
            user_integral: '',
            user_name: '',
            qiandao_status: false,
            is_vip: false,
            vip_info: ''
        }
    },

    async mounted() {
        if (this.$store.state.auth.loggedIn) {
            this.userToken = this.$store.state.auth.user.api_token;
            this.user_pic = this.$store.state.auth.user.pic;
            this.user_balance = this.$store.state.auth.user.balance;
            this.user_integral = this.$store.state.auth.user.integral;
            this.user_name = this.$store.state.auth.user.name;
            this.get_vip_info();
        }
        const header = await headGet();
        this.heads = header.data;
        const topUrlGet = await topUrl();
        this.topUrls = topUrlGet.data;
    },
    methods: {
        get_vip_info() {
            return axios.post(`/api/get_vip_info`, {
                user_id: this.$store.state.auth.user.id,
            }).then(res => {
                if (res.data.data == 'yes') {
                    this.is_vip = true;
                    this.vip_info = res.data.vip_times
                }
            })
        },
        //签到
        async sign() {
            this.qiandao_status = true;
            const qian = await user_sign();
            const signs = await get_user_sign();
            this.qiandao_status = false;
        },
        isopen() {
            this.drawer = true;
        },
        //侧边栏

        handleClose(key, keyPath) {
            // console.log(key, keyPath);
        },
        theme(data) {
            this.$colorMode.preference = data;
        },
        new_pic(data) {
            this.user_pic = data;
        },
        newsreg(data) {
            this.dialogReg = data
        },
        newslog(data) {
            this.dialogLogin = data
        },
        get_token(data) {
            this.userToken = data;
        },
        cateGo(others) {
            this.$router.push("/category/" + others);
        },
        homeBack() {
            this.activeIndex = '';
            this.$router.push("/");
        },
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

        async logouts() {
            this.$message({
                message: '退出成功!',
                type: 'success'
            })
            await this.$auth.logout('local');
            this.userToken = null;
            this.dialogLogin = false;
            this.$router.push('/');
        }
    },

}
</script>

<style>
.el-menu--horizontal > .el-menu-item {
    height: 70px;
    line-height: 70px;
}

.meun .el-menu--horizontal > .el-menu-item a:hover {
    color: #409eff;
}

.el-submenu__title a, .el-menu--horizontal .el-menu .el-menu-item a {
    width: 80%;
    display: inline-block;
}

.el-menu--horizontal > .el-menu-item.is-active {
    border-bottom: 0px;
}

.el-menu--horizontal > .el-submenu .el-submenu__icon-arrow {
    margin-top: 0px;
}

.meun .el-menu--horizontal > .el-menu-item a.nuxt-link-active {
    color: #409eff;
}

.el-menu--horizontal > .el-submenu.is-active .el-submenu__title {
    border-bottom: 0px;
}

.meun .el-menu--horizontal > .el-submenu div.el-submenu__title a.nuxt-link-active {
    color: #409eff;
}

.el-menu--horizontal .el-menu .el-menu-item a.nuxt-link-active {
    color: #409eff;
}

.meun .el-menu--horizontal > .el-submenu div.el-submenu__title a:hover {
    color: #409eff;
}

.el-menu--horizontal > .is-active div a {
    color: #409eff;
}

.el-dropdown-menu__item i {
    font-size: 16px;
}

.el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 200px;
    min-height: 400px;
}

.hor-menu {
    height: 71px;
    line-height: 71px;
}

.app-header-topbar .el-dropdown {
    color: #fff;
    padding-left: 5px;
    line-height: 100%;
}

.el-menu--horizontal > .el-menu-item {
    border-bottom: 0px;
}
</style>

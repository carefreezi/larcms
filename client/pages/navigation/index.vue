<template>
    <div class="navigation">
        <div class="indexWrapper">
            <!--top panel-->
            <div class="panel card-opacity engine-wrapper">
                <div class="engine-header">
                    <ul id="engineShortcutList" class="shortcut-list">
                        <li v-for="(item,index) in tabs"><a href="Javascript:void(0)" class="engine-item"
                                                            :class="tabs_select==index?'active':''"
                                                            @click="change_tab(index,item.src)">
                            <div class="icon"><img
                                :src="item.src" :alt="item.name"
                            ></div>
                            <span class="text-darker text-ellipsis">{{ item.name }}</span></a>
                        </li>

                    </ul>
                    <el-input placeholder="请输入内容" v-model="search_input" class="input-with-select">
                        <template slot="prepend">
                            <div class="engine-dropdown">
                                <img width="20"
                                     :src="is_select"
                                     alt="">
                            </div>
                        </template>
                        <el-button slot="append" icon="el-icon-search" @click="search_go()">搜索</el-button>
                    </el-input>
                </div>
            </div>
            <!--top panel end-->
            <!--hot panel-->
            <div class="panel card-opacity index-website__wrapper">
                <div class="web-header">
                    <ul class="tab-menu">
                        <li>
                            <a href="Javascript:void(0);"><i class="iconfont nav-dian"
                                                             style="color:#72CC57;"></i>购物旅游</a>
                        </li>
                    </ul>
                </div>
                <div class="simple-link-box empty-closed">
                    <div class="lists link-layout-card">
                        <div class="link-item-box">
                            <el-row :gutter="10">
                                <el-col :xs="6" :sm="4" :md="4" :lg="4" :xl="4" v-for="(item,index) in hot_list">
                                    <div class="link-item">
                                        <span class="el-dropdown">
                                            <i class="el-icon-more"></i>
                                        </span>
                                        <a :href="item.url" target="_blank" class="text-darker">
                                            <div class="cover sprite1" style="background-position:0 0;">
                                                <img :src="item.src" alt="">
                                            </div>
                                            <h4 :title="item.name" class="substr">
                                                {{ item.name }}
                                            </h4>
                                        </a>
                                    </div>
                                </el-col>

                            </el-row>
                        </div>
                    </div>
                </div>

            </div>
            <!--hot panel end-->
            <div id="centerModuleWrapper" class="source-wrapper">
                <el-row :gutter="10">
                    <el-col :xs="24" :sm="16" :md="16" :lg="16" :xl="16">
                        <div class="main-wrapper">
                            <div class="index-module__nav">
                                <div>
                                    <div class="nav-lists clearfix">
                                        <div class="panel card-opacity">
                                            <div id="navListsBox">
                                                <div class="group line-opacity nav-lists__title">
                                                    <div class="panel-grey line-opacity slider-title higher">
                                                        <p class="icon">
                                                            <i class="el-icon el-icon-eleme"></i>
                                                        </p>
                                                        <h3 class="text-dark">
                                                            <span>购物</span>
                                                        </h3>
                                                    </div>
                                                    <div class="link-layout-default link-item-box">
                                                        <div class="link-item">

                                                            <a href="https://union-click.jd.com/jdc?e=0&amp;p=AyIPZRprFDJWWA1FBCVbV0IUWVALHFRBEwQAQB1AWQkFa15aQmcQTj93Z1d5EmEnRnAVfBRjPnUOHmlWGlscHhMOSRhTBAIbDFYfUBEHIgdXH1MRAxMGUR5rFQMTBlQYWxUDFTdlG1olSXwGZRteFgUTBl0aXxcyEgNXH18XCxADUBteFjIVN4Ky9cOamdPdkYOGpSI3ZStrJQISN1UrBFFfTw%3D%3D&amp;t=W1dCFFlQCxxUQRMEAEAdQFkJBQ%3D%3D"
                                                               target="_blank" class="text-darker">
                                                                <div class="cover">
                                                                    <img alt=""
                                                                         data-src="https://img.bidianer.com/website/201810/24/5bd0346267def4etcyQx0PgZwkRoK.svg"
                                                                         src="https://img.bidianer.com/website/201810/24/5bd0346267def4etcyQx0PgZwkRoK.svg">
                                                                </div>
                                                                <h4 title="京东商城" class="substr">
                                                                    京东商城
                                                                </h4>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-col>
                    <el-col :xs="24" :sm="8" :md="8" :lg="8" :xl="8">
                        <!--right sidebar-->
                        <div class="sidebar-wrapper">
                            <div class="sidebar-wrapper">
                                <div>
                                    <div class="panel card-opacity sidebar-item">
                                        <ul class="tab-menu">
                                            <li class="text-default active">日历
                                            </li>
                                            <li class="text-default">便签
                                            </li>
                                            <li class="text-default">二维码
                                            </li>
                                        </ul>
                                        <div class="calendar">
                                            <el-calendar v-model="value">
                                            </el-calendar>
                                        </div>
                                    </div>
                                    <div class="panel card-opacity sidebar-item">
                                        <ul class="tab-menu">
                                            <li class="text-default active">热搜榜
                                            </li>
                                        </ul>
                                        <div class="hot-search">
                                            <div class="tool-bar"><p class="text-lighter"
                                            ><i
                                                class="el-icon-warning-outline"></i>热搜榜每2个小时更新一次</p>
                                                <a href="Javascript:void(0);" class="refresh-btn text-light"
                                                ><i class="el-icon-refresh"></i>刷新
                                                </a></div>
                                            <el-carousel height="150px">
                                                <el-carousel-item>
                                                    <p><em>1.</em> <a
                                                        href="javascript:void(0);"
                                                        title="31省区市新增本土确诊87例"
                                                        class="text-ellipsis text-darker">31省区市新增本土确诊87例</a>
                                                        <span>4924870<i
                                                            class="iconfont"></i></span></p>
                                                </el-carousel-item>
                                            </el-carousel>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--right sidebar end-->
                    </el-col>
                </el-row>

            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "index",
    data() {
        return {
            activeName: 'first',
            backs: 'https://epmao.oss-cn-beijing.aliyuncs.com/202111/03/HPRn89aSHkOm9EUaDmX3shpFl0cOiPLyjEhZFEA3.jpg',
            search_input: '',
            tabs_select: 0,
            value: new Date(),
            is_select: 'https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg',
            tabs: [
                {name: "百度", src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg"},
                {name: "视频", src: "https://img.bidianer.com/engine/201904/14/5cb34ca75d587y5HCF01hkaYdV7cV.svg"},
                {name: "音乐", src: "https://img.bidianer.com/engine/201904/14/5cb34424d14e6HcH59ZkZZEe8ND-7.svg"},
            ],
            hot_list: [
                {
                    name: "百度",
                    src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg",
                    url: "https://www.baidu.com"
                },
                {
                    name: "百度",
                    src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg",
                    url: "https://www.baidu.com"
                },
                {
                    name: "百度",
                    src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg",
                    url: "https://www.baidu.com"
                },
                {
                    name: "百度",
                    src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg",
                    url: "https://www.baidu.com"
                },
                {
                    name: "百度",
                    src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg",
                    url: "https://www.baidu.com"
                },
                {
                    name: "百度",
                    src: "https://img.bidianer.com/engine/201905/06/5ccffcbb848d1_6VmFZFyC397EDMO.svg",
                    url: "https://www.baidu.com"
                },
            ]
        };
    },
    methods: {
        change_tab(index, src) {
            this.tabs_select = index;
            this.is_select = src;
        },
        search_go() {
            this.$message.success(this.search_input);
        }
    }
}
</script>

<style scoped>

</style>

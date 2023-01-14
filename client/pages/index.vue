<template>
    <div class="main boxmain">
        <!--banner-->
        <div class="portal-banner" v-if="index_order[0].is_show" :style="'order:'+index_order[0].order_id">
            <el-carousel :interval="5000" arrow="always" v-if="types==1" :height="banner_height">
                <el-carousel-item v-for="item in banners_pic">
                    <a ref="nofollow" :href="item.link" :target="item.target">
                        <img
                            style="width: 100%; height: auto"
                            :src="item.pic"
                            :fit="item.pic"
                            :alt="item.title"
                            ref="img" @load="imagesLoad"
                        >
                        <h3 :style="{color: item.title_color, fontSize: item.title_size + 'px'}">{{
                                item.title
                            }}</h3>
                    </a>
                </el-carousel-item>
            </el-carousel>
            <el-carousel :interval="4000" type="card" v-if="types==2" :height="banner_height">
                <el-carousel-item v-for="item in banners_pic">
                    <a ref="nofollow" :href="item.link" :target="item.target">
                        <img
                            style="width: 100%; height: auto"
                            :src="item.pic"
                            :fit="item.pic"
                            :alt="item.title"
                            ref="img" @load="imagesLoad"
                        >
                        <h3 :style="{color: item.title_color, fontSize: item.title_size + 'px'}">{{
                                item.title
                            }}</h3>
                    </a>
                </el-carousel-item>
            </el-carousel>
            <el-carousel direction="vertical" :autoplay="false" v-if="types==3" :height="banner_height">
                <el-carousel-item v-for="item in banners_pic">
                    <a ref="nofollow" :href="item.link" :target="item.target">
                        <img
                            style="width: 100%; height: auto"
                            :src="item.pic"
                            :fit="item.pic"
                            :alt="item.title"
                            ref="img" @load="imagesLoad"
                        >
                        <h3 :style="{color: item.title_color, fontSize: item.title_size + 'px'}">{{
                                item.title
                            }}</h3>
                    </a>
                </el-carousel-item>
            </el-carousel>
        </div>
        <!--banner end-->
        <!--cate-->
        <div class="index_cate" v-if="index_order[1].is_show" :style="'order:'+index_order[1].order_id">
            <div v-for="(item,i) in gorys">
                <!--code start-->
                <div v-if="item.type==1">
                    <div class="TitBox">
                        <div class="row w1370">
                            <div class="icon-tit-gp">
                                <div class="d-flex app-content-header mb-6">
                                    <div class="icon-top" v-html="item.icon"></div>
                                    <div>
                                        <span class="tipsTit">{{ item.name }}</span>
                                    </div>
                                    <nav class="nav nav-title flex-grow-1">
                                        <nuxt-link v-for="(list , k) in  item.all_children" v-if="k<=3" ref="nofollow"
                                                   :to="'/category/'+list.other" class="nav-link">
                                            {{ list.name }}
                                        </nuxt-link>
                                    </nav>
                                    <div class="more-action right-muen">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            更多<i class="iconfont icon-gengduo"></i>
                                        </nuxt-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Notfound v-if="posts[i].length<=0"></Notfound>
                    <ul class="box-list clearfix code-list">
                        <el-row :gutter="20">
                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6" :span="6" v-for="(item,k) in posts[i]"
                                    :key="k" :class="delay(k)"
                                    class="list-animation-leftIn ">
                                <li>
                                    <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                        <div class="cover-img-center-max coverimg-li">
                                            <span class="pack_p_rt" v-if="parseFloat(item.goods[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                            <img v-lazy="item.goods[0].cover" :alt="item.goods[0].title">
                                        </div>
                                    </nuxt-link>
                                    <div class="tag-span-tool">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            <span class="el-tooltip today-update v-3 item"></span>
                                            <span class="cate_name">{{ item.name }}</span>
                                        </nuxt-link>
                                        <span class="float-right">{{ formatDate(item.goods[0].create_time) }}</span>
                                    </div>
                                    <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                        <div class="li-tit">
                                            {{ item.goods[0].title }}
                                        </div>
                                    </nuxt-link>
                                    <div class="desc-li">
                                        <div class="author-bar">
                                            <nuxt-link :to="'/user/'+item.goods[0].author_id">
                                                <span><img v-lazy="item.pic" :alt="item.goods[0].title"></span>
                                                <span>{{ item.userInfo }}</span>
                                            </nuxt-link>
                                        </div>
                                        <div class="cont-bar">
                                            <span><i class="iconfont icon-liulan8"></i>{{ item.goods[0].view }}</span>
                                            <span><i class="iconfont icon-shoucang4"></i>{{
                                                    item.goods[0].likes
                                                }}</span>
                                        </div>
                                    </div>
                                </li>
                            </el-col>
                        </el-row>
                    </ul>
                </div>
                <!--code end-->
                <!--design start-->
                <div v-if="item.type==2" class="sucai">
                    <div class="TitBox">
                        <div class="row w1370">
                            <div class="icon-tit-gp">
                                <div class="d-flex app-content-header mb-6">
                                    <div class="icon-top" v-html="item.icon"></div>
                                    <div>
                                        <span class="tipsTit">{{ item.name }}</span>
                                    </div>
                                    <nav class="nav nav-title flex-grow-1">
                                        <nuxt-link v-for="(list , k) in  item.all_children" v-if="k<=3" ref="nofollow"
                                                   :to="'/category/'+list.other" class="nav-link">
                                            {{ list.name }}
                                        </nuxt-link>
                                    </nav>
                                    <div class="more-action right-muen">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            更多<i class="iconfont icon-gengduo"></i>
                                        </nuxt-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Notfound v-if="posts[i].length<=0"></Notfound>
                    <ul class="box-list clearfix" v-loading="loadings">
                        <el-row :gutter="20">
                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6" :span="6" v-for="(item,k) in posts[i]"
                                    class="list-animation-leftIn" :key="k"
                                    :class="delay(k)">
                                <li>
                                    <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                        <div class="cover-img-center-max coverimg-li">
                                            <span class="pack_p_rt" v-if="parseFloat(item.goods[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                            <img v-lazy="item.goods[0].cover" :alt="item.goods[0].title">
                                        </div>
                                    </nuxt-link>
                                    <div class="tag-span-tool">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            <span class="el-tooltip today-update v-3 item"></span>
                                            <span class="cate_name">{{ item.name }}</span>
                                        </nuxt-link>
                                        <span class="float-right">{{ formatDate(item.goods[0].create_time) }}</span>
                                    </div>
                                    <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                        <div class="li-tit">
                                            {{ item.goods[0].title }}
                                        </div>
                                    </nuxt-link>
                                    <div class="desc-li">
                                        <div class="author-bar">
                                            <nuxt-link :to="'/user/'+item.goods[0].author_id">
                                                <span><img v-lazy="item.pic" :alt="item.goods[0].title"></span>
                                                <span>{{ item.userInfo }}</span>
                                            </nuxt-link>
                                        </div>
                                        <div class="cont-bar">
                                            <span><i class="iconfont icon-liulan8"></i>{{ item.goods[0].view }}</span>
                                            <span><i class="iconfont icon-shoucang4"></i>{{
                                                    item.goods[0].likes
                                                }}</span>
                                        </div>
                                    </div>
                                </li>
                            </el-col>
                        </el-row>
                    </ul>
                </div>
                <!--design end-->
                <!--video start-->
                <div v-if="item.type==3">
                    <div class="TitBox">
                        <div class="row w1370">
                            <div class="icon-tit-gp">
                                <div class="d-flex app-content-header mb-6">
                                    <div class="icon-top" v-html="item.icon"></div>
                                    <div>
                                        <span class="tipsTit">{{ item.name }}</span>
                                    </div>
                                    <nav class="nav nav-title flex-grow-1">
                                        <nuxt-link v-for="(list , k) in  item.all_children" v-if="k<=3" ref="nofollow"
                                                   :to="'/category/'+list.other" class="nav-link">
                                            {{ list.name }}
                                        </nuxt-link>
                                    </nav>
                                    <div class="more-action right-muen">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            更多<i class="iconfont icon-gengduo"></i>
                                        </nuxt-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Notfound v-if="posts[i].length<=0"></Notfound>

                    <ul class="video-list clearfix">
                        <li v-for="(item,k) in posts[i]" class="list-animation-leftIn">
                            <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                <div class="video-gif-box" data-src="video/96m888piCP82.mp4_10s.mp4">
                                    <div class="cover-img-center-max video-voer-img">
                                        <img v-lazy="item.goods[0].cover" :alt="item.goods[0].title">
                                    </div>
                                    <video loop="loop" id="video1"></video>
                                    <div class="toolbar-desc">
                                        <div class="tag-span-tool">
                                            <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                                <span>{{ item.name }} /</span>
                                            </nuxt-link>
                                            <span>{{ item.goods[0].create_time }}</span>
                                        </div>
                                        <div class="row desc-li">
                                            <div class="col-6 cont-bar">
                                                <span><i class="iconfont icon-liulan8"></i>{{
                                                        item.goods[0].view
                                                    }}</span>
                                                <span><i
                                                    class="iconfont icon-shoucang4"></i>{{ item.goods[0].likes }}</span>
                                            </div>
                                            <div class="col-6 vip-desc">
                                                <span class="vipi"><i class="iconfont icon-vip-crown--fill"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-tit">
                                    {{ item.goods[0].title }}
                                </div>
                            </nuxt-link>

                        </li>
                    </ul>
                </div>
                <!--video end-->

                <!--music start-->
                <div v-if="item.type==4">
                    <div class="TitBox">
                        <div class="row w1370">
                            <div class="icon-tit-gp">
                                <div class="d-flex app-content-header mb-6">
                                    <div class="icon-top" v-html="item.icon"></div>
                                    <div>
                                        <span class="tipsTit">{{ item.name }}</span>
                                    </div>
                                    <nav class="nav nav-title flex-grow-1">
                                        <nuxt-link v-for="(list , k) in  item.all_children" v-if="k<=3" ref="nofollow"
                                                   :to="'/category/'+list.other" class="nav-link">
                                            {{ list.name }}
                                        </nuxt-link>
                                    </nav>
                                    <div class="more-action right-muen">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            更多<i class="iconfont icon-gengduo"></i>
                                        </nuxt-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Notfound v-if="posts[i].length<=0"></Notfound>

                    <ul class="CD-list clearfix">
                        <li v-for="(item,k) in posts[i]">
                            <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="CdPlayerBox"
                                             data-src="https://s128.xiami.net/381/85381/2108165156/1900676876_1584258326440_178.mp3?ccode=xiami_web_web&expire=86400&duration=162&psid=4a68dac9653312e40a624c3f608a30dd&ups_client_netip=117.61.243.23&ups_ts=1584373855&ups_userid=0&utid=FiChFbD0cVICAW/JPTWkBn7o&vid=1900676876&fn=1900676876_1584258326440_178.mp3&vkey=B989022837f13aeef6924322383f06658">
                                            <span class="CD-icon"></span>
                                            <span class="ibtntool">
                                            <i class="iconfont icon-bofang btnCD active"></i>
                                            <i class="iconfont icon-bofangqi-zanting btnCD"></i>
                                        </span>
                                            <audio id="Music1"></audio>
                                        </div>
                                        <div class="cont-bar">
                                            <span><i class="iconfont icon-liulan8"></i>{{ item.goods[0].view }}</span>
                                            <span><i class="iconfont icon-shoucang4"></i>{{
                                                    item.goods[0].likes
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="CD-tit">
                                            {{ item.goods[0].title }}

                                        </div>
                                        <div class="tag-span-tool">
                                            <!--                                <span>AE模版</span>-->
                                            <span>{{ item.goods[0].create_time }}</span>
                                            <span class="durationtimexc ">02:35</span>
                                        </div>
                                        <div class="row progressbox">
                                            <div class="col-9">
                                                <div class="progress">
                                                    <div class="progress-bar  progress-bar-striped" role="progressbar"
                                                         aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-3 progress-timebox">
                                                <span class="progress-time">00:00</span>
                                            </div>
                                        </div>
                                        <div class="DownTool">
                                <span class="disi"><i class="iconfont icon-yduizhekou"></i> <span
                                    class="dis-num">7折</span></span>
                                            <span><span class="munsrcoe">125</span>积分</span>
                                        </div>
                                    </div>
                                </div>
                            </nuxt-link>

                        </li>

                    </ul>
                </div>
                <!--music end-->

                <!--blog start-->
                <div v-if="item.type==5" class="blog">
                    <div class="TitBox">
                        <div class="row w1370">
                            <div class="icon-tit-gp">
                                <div class="d-flex app-content-header mb-6">
                                    <div class="icon-top" v-html="item.icon"></div>
                                    <div>
                                        <span class="tipsTit">{{ item.name }}</span>
                                    </div>
                                    <nav class="nav nav-title flex-grow-1">
                                        <nuxt-link v-for="(list , k) in  item.all_children" v-if="k<=3" ref="nofollow"
                                                   :to="'/category/'+list.other" class="nav-link">
                                            {{ list.name }}
                                        </nuxt-link>
                                    </nav>
                                    <div class="more-action right-muen">
                                        <nuxt-link ref="nofollow" :to="'/category/'+item.other">
                                            更多<i class="iconfont icon-gengduo"></i>
                                        </nuxt-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <Notfound v-if="posts[i].length<=0"></Notfound>
                    <ul class="box-list clearfix" v-loading="loadings">
                        <el-row :gutter="20">
                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12" :span="12" v-for="(item,k) in posts[i]"
                                    class="list-animation-leftIn" :key="k"
                                    :class="delay(k)">
                                <article
                                    class="post post-list type-post status-publish format-standard hentry category-blog"
                                >
                                    <div class="entry-media">
                                        <div class="placeholder">
                                            <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id">
                                                <span class="pack_p_rt" v-if="parseFloat(item.goods[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                                <img
                                                    height="200"
                                                    width="300"
                                                    v-lazy="item.goods[0].cover"
                                                    :alt="item.goods[0].title"
                                                    class="thumb"
                                                    style="opacity: 1"
                                                />
                                            </nuxt-link>
                                        </div>
                                    </div>
                                    <div class="entry-wrapper">
                                        <div class="entry-header">
                                            <div class="entry-meta">
                                                <div class="d-none d-lg-block text-xs mb-1">
                                                    <nuxt-link ref="nofollow" :to="'/category/'+item.other"
                                                               class="text-muted">
                                                        <span class="el-tooltip today-update v-3 item"></span>
                                                        {{ item.name }}
                                                    </nuxt-link>
                                                    <span class="post-date fr">{{
                                                            formatDate(item.goods[0].create_time)
                                                        }} </span>
                                                </div>
                                                <div class="list-body pl-3 pr-3">
                                                    <nuxt-link ref="nofollow" :to="'/post/'+item.goods[0].id"
                                                               class="list-title text-sm text-hidden">
                                                        <span class="badge badge-primary"></span>{{
                                                            item.goods[0].title
                                                        }}
                                                    </nuxt-link>
                                                </div>
                                                <div class="mb-2 mb-md-3 pl-3 pr-3 post-width">
                                                    <div class="d-flex flex-fill align-items-center text-muted text-xs">
                                                        <div class="author-bar">
                                                            <nuxt-link :to="'/user/'+item.goods[0].author_id">
                                                                <span><img v-lazy="item.pic"
                                                                           :alt="item.goods[0].title"></span>
                                                                <span>{{ item.userInfo }}</span>
                                                            </nuxt-link>
                                                        </div>
                                                        <div class="flex-fill"></div>
                                                    </div>
                                                    <div class="d-flex d-flex-middle order-3 text-muted text-xs">
                                                        <div class="d-flex-full"></div>
                                                        <div class="d-flex text-nowrap d-flex-middle">
                                                          <span class="mr-2"
                                                          ><i class="iconfont icon-liulan8"></i>
                                                            {{ item.goods[0].view }}
                                                          </span>
                                                            <span class="mr-2"
                                                            ><i class="iconfont icon-shoucang4"></i>
                                                            {{ item.goods[0].likes }}
                                                          </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </el-col>
                        </el-row>
                    </ul>
                </div>
                <!--blog end-->
            </div>
        </div>
        <!--cate end-->
        <!--special-->
        <div class="special_index" v-if="index_order[2].is_show" :style="'order:'+index_order[2].order_id">
            <el-row :gutter="20">
                <el-col :xs="12" :sm="6" :md="6" :lg="6" :xl="6" :span="6" v-for="(item,k) in special"
                        :key="k" :class="delay(k)"
                        class="list-animation-leftIn ">
                    <div class="list-item overlay-hover rounded">
                        <div class="media">
                            <div class="media-content"
                                 :style="{backgroundImage:'url(' + item.cover + ')'}">
                                <div class="overlay-1"></div>
                            </div>
                        </div>
                        <div class="list-content">
                            <div class="list-body text-center h-1x text-sm"> {{ item.name }}</div>
                        </div>
                        <nuxt-link :to="'/special/'+item.other" class="list-goto"></nuxt-link>
                    </div>
                </el-col>
            </el-row>
        </div>
        <!--special end-->
        <!--blog-->
        <div class="index_blog" v-if="index_order[3].is_show" :style="'order:'+index_order[3].order_id">
            <el-row :gutter="10">
                <!--left content-->
                <el-col :xs="24" :sm="24" :md="18" :lg="18" :xl="18">
                    <div class="post-blog post-item-post-3-1-1 box">
                        <div class="post-modules-top">
                            <div class="modules-title-box">
                                <h2 class="module-title">最新文章</h2>
                                <div class="module-tags">
                                    <span class="module-desc" v-for="(item,index) in cates">
                                    <nuxt-link :to="'/category/'+item.other" class="i-con-h-a">
                                        {{ item.name }}
                                    </nuxt-link>
                                </span>
                                </div>

                            </div>
                        </div>
                        <div class="hidden-line">
                            <ul class="lar_gap">
                                <Notfound v-if="blogs.length<1"></Notfound>
                                <li class="post-3-li post-list-item" v-for="(item,index) in blogs" :key="index">
                                    <div class="item-in ">
                                        <div class="post-module-thumb  mobile-show" style="">
                                            <nuxt-link :to="'/post/'+item.post_get[0].id" rel="nofollow"
                                                       class="thumb-link">
                                                <span class="pack_p_rt" v-if="parseFloat(item.post_get[0].vip_price)>=0"><span class="pack_pack_tag pack_tag_vip">VIP</span></span>
                                                <img class="post-thumb lazy"
                                                     :alt="item.post_get[0].title"
                                                     v-lazy="item.post_get[0].cover">
                                            </nuxt-link>
                                        </div>
                                        <div class="post-info">
                                            <h2>
                                                <nuxt-link :to="'/post/'+item.post_get[0].id">{{ item.post_get[0].title }}</nuxt-link>
                                            </h2>
                                            <div class="post-excerpt">
                                                {{ replaceContent(item.post_get[0].content) }}
                                            </div>

                                            <div class="post-list-meta-box ">
                                                <ul class="post-list-meta">
                                                    <li class="post-list-meta-user">
                                                        <nuxt-link class="post-list-meta-avatar"
                                                                   :to="'/user/'+item.post_get[0].author_id">
                                                            <img
                                                                class="avatar  lazy loaded"
                                                                :alt="item.post_get[0].user_info"
                                                                v-lazy="item.post_get[0].pic"
                                                            >
                                                            <span>{{ item.post_get[0].user_info }}</span>
                                                        </nuxt-link>
                                                        <div class="tag-span-tool">
                                                            <nuxt-link ref="nofollow" :to="'/category/'+item.category[0].other">
                                                                <div class="el-tooltip today-update v-3 item"></div>
                                                                <span class="cate_name">{{ item.category[0].name }}</span>
                                                            </nuxt-link>
                                                        </div>
                                                    </li>
                                                    <li class="post-list-meta-date">
                                                        <span><time class="lartimeago"
                                                                    :datetime="formatDate(item.post_get[0].create_time)">{{
                                                                formatDate(item.post_get[0].create_time)
                                                            }}</time></span>
                                                    </li>
                                                    <div class="cont-bar">
                                                        <span><i class="iconfont icon-liulan8"></i>{{
                                                                item.post_get[0].view
                                                            }}</span>
                                                        <span><i class="iconfont icon-shoucang4"></i>{{
                                                                item.post_get[0].likes
                                                            }}</span>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="get_more">
                                <el-button :loading="load_loading" v-if="load_text" @click="load_more">加载更多</el-button>
                                <el-button :loading="load_loading" v-else>没有更多的文章了！</el-button>
                            </div>
                        </div>
                    </div>
                </el-col>
                <!--left content end-->
                <el-col :xs="24" :sm="24" :md="6" :lg="6" :xl="6">
                    <div class="rightContent">
                        <section class="mobile-hidden widget lar-widget-hot mg-b box lar-radius">
                            <div class="lar-widget-title">
                                <h2 class="widget-title">
                                    <i class="larfont lar-yuancircle94 "></i>热门资源
                                </h2>
                            </div>
                            <div class="lar-widget-box">
                                <ul class="lar-widget-list-ul">
                                    <li class="lar-widget-box widget-post" v-for="(item,index) in hot_post">
                                        <div class="lar-widget-post-thumb">
                                            <div class="lar-widget-post-thumb-img">
                                                <picture class="picture">
                                                    <img class="lar-radius lazy loaded"
                                                         :alt="item.title"
                                                         v-lazy="item.cover"
                                                         data-was-processed="true"></picture>
                                            </div>
                                            <div class="lar-widget-post-title">
                                                <h2>{{ item.title }}</h2>
                                                <time>{{ item.create_time }}</time>
                                            </div>
                                        </div>
                                        <nuxt-link ref="nofollow" class="link-overlay"
                                                   :to="'/post/'+item.id"></nuxt-link>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <section class="mobile-hidden widget lar-widget-hot mg-b box lar-radius">
                            <div class="lar-widget-title">
                                <h2 class="widget-title">
                                    <i class="larfont lar-yuancircle94 "></i>专栏推荐
                                </h2>
                            </div>
                            <div class="lar-widget-box">
                                <div class="list-overlay">
                                    <div class="list-item overlay-hover rounded-sm"
                                         v-for="(item,index) in special_right">
                                        <div class="media">
                                            <div class="media-content"
                                                 :style="{backgroundImage:'url('+item.cover+')'}">
                                                <div class="overlay-1"></div>
                                            </div>
                                        </div>
                                        <div class="list-content">
                                            <div class="list-body">
                                                <div class="list-title h6 text-white h-1x">{{ item.name }}<sup
                                                    class="mx-1">{{ item.posts_count }}</sup></div>
                                            </div>
                                        </div>
                                        <nuxt-link :to="'/special/'+item.other" class="list-goto"
                                                   :title="item.name"></nuxt-link>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </el-col>
            </el-row>
        </div>
        <!--blog end-->
    </div>
</template>
<script>
import axios from 'axios'

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
    auth: false,
    name: 'Index',
    layout: 'default',
    data() {
        return {
            special: '',
            loadings: true,
            banners_pic: [],
            types: 1,
            gorys: [],
            posts: [],
            index_order: [],
            blogs: [],
            cates: [],
            hot_post: [],
            special_right: [],
            banner_height:'',
            page: 1,
            limit: 8,
            load_text: true,
            load_loading: false,
            title: this.WebConfigs('title') + '-' + this.WebConfigs('subtitle'),
            keywords: this.WebConfigs('keywords'),
            description: this.WebConfigs('description'),
            ico: this.WebConfigs('ico'),
        }
    },
    async asyncData({app}) {
        let [listA, listB, listC, listD, listE] = await Promise.all([
            app.$axios.$post("/api/categorydesc"),
            app.$axios.$post("/api/banner"),
            app.$axios.$post("/api/getLayout"),
            app.$axios.$get(`/api/special`),
            app.$axios.$get('/api/new_posts'),
        ])
        return {
            gorys: listA.gory,
            posts: listA.post,
            banners_pic: listB.banner_pic,
            types: listB.type,
            loadings: false,
            index_order: listC.data,
            special: listD.special,
            blogs: listE.new_posts,
            cates: listE.cate,
            hot_post: listE.hot,
            special_right: listD.special
        }
    },
    mounted() {
        this.imagesLoad();
        window.addEventListener(
            "resize",
            () => {
                this.banner_height = this.$refs.img[0].height+'px';
                this.imagesLoad();
            },
            false
        );
    },
    methods: {
        imagesLoad(){
            this.$nextTick(()=>{
                this.banner_height = this.$refs.img[0].height+'px';
            })
        },
        replaceContent(value) {
            let content = value.replace(/<.+?>/g, '');
            content = content.replace(/&nbsp;/ig, '');
            content = content.replace(/\s/ig, '');
            return content;
        },
        load_more() {
            this.load_loading = true;
            this.page += 1;
            return axios.get(`/api/new_posts`, {
                params: {
                    page: this.page,
                    limit: this.limit,
                }
            }).then(res => {
                this.load_loading = false;
                for (let i = 0; i < res.data.new_posts.length; i++) {
                    this.blogs.push(res.data.new_posts[i])
                }
                if (res.data.have_post == 'no') {
                    this.load_text = false
                }
            })
        },
        delay(index) {
            return 'delay-' + index;
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
    },
    head() {
        return {
            title: this.title,
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
<style>
.el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 1;
    margin: 0;
    text-align: center;
    line-height: 0px;
    text-align: center;
    position: absolute;
    top: 50%;
    width: 100%;
    text-align: center;
    z-index: 100;
}

.el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
}

.el-col {
    margin-bottom: 20px;
}
</style>

@section('c')
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>-首页</title>
    <!-- import CSS -->
    <link rel="stylesheet" href="{{asset("/static/frame/elementui/element.css")}}">
    <link rel="stylesheet" href="{{asset("/static/frame/toastr/toastr.min.css")}}">
    <link rel="stylesheet" href="{{asset("/static/admin/css/public.css")}}">
</head>
<body>
@section('header')
<div id="app">
    <!--头部-->
    <header main class="clearfix">
        <div>
            <img src="https://coderthemes.com/hyper/modern/assets/images/logo-light.png" alt="" class="logo-hed">
        </div>
        <div>
            <div class="ToolBox">
                <el-carousel height="50px" direction="vertical" indicator-position="none">
                    <el-carousel-item>
                        <a href="" target="_blank">官方公告1</a>
                    </el-carousel-item>
                    <el-carousel-item>
                        <a href="" target="_blank">官方公告2</a>
                    </el-carousel-item>
                    <el-carousel-item>
                        <a href="" target="_blank">官方公告3</a>
                    </el-carousel-item>
                    <el-carousel-item>
                        <a href="" target="_blank">官方公告4</a>
                    </el-carousel-item>
                    <el-carousel-item>
                        <a href="" target="_blank">官方公告5</a>
                    </el-carousel-item>
                </el-carousel>
            </div>
            <div class="userbosd">
                <el-dropdown placement="bottom-start">
                        <span class="el-dropdown-link">
                           <div class="user-nick-b clearfix">
                               <div>
                                   <el-avatar class="hold-logo" size="large"
                                              src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"></el-avatar>
                               </div>
                               <div class="des-msg">
                                   <div class="des-msg-nick"> Wing pc admin </div>
                                   <div class="tag-qxuz"><span class="tag-qxuz-t tag-qxuz-t-white">狗管理</span></div>
                               </div>
                           </div>
                       </span>
                    <el-dropdown-menu slot="dropdown" class="linkmenu">
                        <a href="{:url('adminuser/mydesc')}">
                            <el-dropdown-item>
                                <i class="el-icon-user"></i> 我的信息
                            </el-dropdown-item>
                        </a>
                        <a href="{:url('adminuser/password')}">
                            <el-dropdown-item>
                                <i class="el-icon-key"></i> 修改密码
                            </el-dropdown-item>
                        </a>
                        <a href="{:url('adminuser/editadmin')}">
                            <el-dropdown-item>
                                <i class="el-icon-help"></i> 编辑管理员
                            </el-dropdown-item>
                        </a>
                        <a href="{:url('adminuser/log')}">
                            <el-dropdown-item>
                                <i class="el-icon-document-copy"></i> 查看管理日志
                            </el-dropdown-item>
                        </a>
                        <el-dropdown-item divided class="red-font" @click.native="this.login_out()">
                            <i class="el-icon-switch-button"></i> 退出登录
                        </el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </div>
        </div>
    </header>
    <!--头部 end-->
    <section main class="clearfix">
        <!--左-->
        <div>
            <div class="leftbar-user">
                <el-avatar class="hold-logo" size="large"
                           src="https://cube.elemecdn.com/0/88/03b0d39583f48206768a7534e55bcpng.png"
                           class="rounded-circle shadow-sm">

                </el-avatar>
                <span class="leftbar-user-name text-hd">Wing PC Admin</span>
                <div class="LeftMenu Min-H scroll-sm">
                    <el-menu :default-openeds="openMenu" :default-active="activeMenu">

                        <el-submenu index="setW">
                            <template slot="title"><i class="el-icon-setting"></i><span class="font-b">网站设置</span>
                            </template>
                            <el-menu-item index="webcount">
                                <span slot="title"><a href="{:url('/admin/index/index')}">数据统计</a></span>
                            </el-menu-item>
                            <el-menu-item index="setPram">
                                <span slot="title"><a href="{:url('Setting/index')}">配置参数</a></span>
                            </el-menu-item>
                            <el-menu-item index="setPramLink">
                                <span slot="title"><a href="{:url('Setting/link')}">友情链接</a></span>
                            </el-menu-item>
                        </el-submenu>
                        <el-menu-item index="userList">
                            <span slot="title"><a href="{:url('user/index')}"><i class="el-icon-user"></i>用户管理</a></span>
                        </el-menu-item>
                        <el-menu-item index="orderList">
                            <span slot="title"><i class="el-icon-printer"></i>订单管理</span>
                        </el-menu-item>
                        <el-submenu index="Windcontrol">
                            <template slot="title">
                                <el-badge :value="125" :max="99" class="bag-item"><i class="el-icon-aim"></i><span
                                        class="font-b">风控系统</span></el-badge>
                            </template>
                            <el-menu-item index="down">
                                <a href="">下载频繁 <span class="tips-nums">49</span></a></a>
                            </el-menu-item>
                            <el-menu-item index="pay">
                                <a href="">订单异常 <span class="tips-nums">113</span></a></a>
                            </el-menu-item>
                            <el-menu-item index="login">
                                <a href="">登录频繁 <span class="tips-nums">13</span></a>
                            </el-menu-item>
                        </el-submenu>
                        <el-submenu index="Content">
                            <template slot="title">
                                <el-badge :value="125" :max="99" type="primary" class="bag-item"><i
                                        class="el-icon-document-copy"></i><span class="font-b">内容管理</span></el-badge>
                            </template>
                            <el-menu-item index="down">
                                <a href="">视频 <span class="tips-nums">23</span></a></a>
                            </el-menu-item>
                            <el-menu-item index="down">
                                <a href="">音频 <span class="tips-nums">18</span></a></a>
                            </el-menu-item>
                            <el-menu-item index="pay">
                                <a href="">源码 <span class="tips-nums">13</span></a></a>
                            </el-menu-item>
                            <el-menu-item index="login">
                                <a href="">文章 <span class="tips-nums">49</span></a>
                            </el-menu-item>
                            <el-menu-item index="login">
                                <a href="">设计 <span class="tips-nums">67</span></a>
                            </el-menu-item>

                        </el-submenu>
                    </el-menu>
                </div>
                <div class="LeftMenu">
                    <div class="sq-time-bvx">授权管理</div>
                    <el-menu
                        :default-openeds="openMenu">

                        <el-menu-item index="webset">
                            <span slot="title">授权详情 <span class="tips-nums cm-mid">剩余364天</span></span>
                        </el-menu-item>
                        <el-menu-item index="adminset">
                            <span slot="title"><a href="" target="_blank">我要续费</a></span>
                        </el-menu-item>
                    </el-menu>
                </div>
                <div class="allring">
                    <a href="">By Thinkto CMS</a>
                </div>
            </div>
        </div>
        <!--右-->
        <div class="Aito-scorll scroll-sm">
            @yield('content')
        </div>
    </section>

</div>
@show
<!-- import Vue before Element -->
<script src="{{asset("/static/admin/scripts/apexcharts.min.js")}}"></script>
<script src="{{asset("/static/frame/js/jquery3.4.1.slim.min.js")}}"></script>
<script src="{{asset("/static/frame/js/vue.js")}}"></script>
<!-- import JavaScript -->
<script src="{{asset("/static/frame/elementui/element.js")}}"></script>
<script src="{{asset("/static/frame/toastr/toastr.js")}}"></script>
<script src="{{asset("/static/admin/scripts/public.js")}}"></script>
</body>
</html>

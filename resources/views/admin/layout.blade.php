<!doctype html>
<html class="no-js h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>互动数据管理系统</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/static/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" id="main-stylesheet" data-version="1.1.0"
          href="/static/styles/shards-dashboards.1.1.0.min.css">
    <link rel="stylesheet" href="/static/styles/extras.1.1.0.min.css">
    <link rel="stylesheet" href="/static/toastr/toastr.min.css">
    <script async defer src="/static/js/buttons.js"></script>
    <style type="text/css">
        .main-sidebar .nav li[class*="{$active}"] {
            box-shadow: inset 0.1875rem 0 0 #007bff;
            background-color: #fbfbfb;
        }

        .main-sidebar .nav li[class*="{$active}"] .nav-link i, .main-sidebar .nav li[class*="{$active}"] .nav-link span {
            background-color: #fbfbfb;
            color: #007bff;
        }
        .card-small{
            overflow-y: auto;
        }
    </style>
</head>
@section()
<body class="h-100">


<div class="color-switcher animated">
    <h5>Accent Color</h5>
    <ul class="accent-colors">
        <li class="accent-primary active" data-color="primary">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-secondary" data-color="secondary">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-success" data-color="success">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-info" data-color="info">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-warning" data-color="warning">
            <i class="material-icons">check</i>
        </li>
        <li class="accent-danger" data-color="danger">
            <i class="material-icons">check</i>
        </li>
    </ul>
    <div class="actions mb-4">
        <a class="mb-2 btn btn-sm btn-primary w-100 d-table mx-auto extra-action" href="#">
            <i class="material-icons">cloud</i> Download</a>
        <a class="mb-2 btn btn-sm btn-white w-100 d-table mx-auto extra-action" href="#">
            <i class="material-icons">book</i> Documentation</a>
    </div>
    <div class="social-wrapper">
        <div class="social-actions">
            <h5 class="my-2">Help us Grow</h5>
            <div class="inner-wrapper">
                <a class="github-button" href="#" data-icon="octicon-star" data-show-count="true"
                   aria-label="Star DesignRevision/shards-dashboard on GitHub">Star</a>

            </div>
        </div>
        <div id="social-share" data-url="#"
             data-text="🔥 Check out Shards Dashboard Lite, a free and beautiful Bootstrap 4 admin dashboard template!"
             data-title="share"></div>
        <div class="loading-overlay">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="close">
        <i class="material-icons">close</i>
    </div>
</div>


<div class="color-switcher-toggle animated pulse infinite">
    <i class="material-icons">settings</i>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Main Sidebar -->
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            <div class="main-navbar">
                <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
                    <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                        <div class="d-table m-auto">
                            <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                                 src="/static/images//shards-dashboards-logo.svg" alt="Shards Dashboard">
                            <span class="d-none d-md-inline ml-1">互动平台管理系统</span>
                        </div>
                    </a>
                    <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                        <i class="material-icons">&#xE5C4;</i>
                    </a>
                </nav>
            </div>
            <form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="text" placeholder="搜索任务..." aria-label="Search">
                </div>
            </form>
            <div class="nav-wrapper">
                <ul class="nav flex-column">
                    <li class="nav-item index">
                        <a class="nav-link" href="/admin/index/index.html">
                            <i class="material-icons">assessment</i>
                            <span>控制台</span>
                        </a>
                    </li>
                    <li class="nav-item task">
                        <a class="nav-link " href="/admin/task/index.html">
                            <i class="material-icons">vertical_split</i>
                            <span>任务</span>
                        </a>
                    </li>
                    <li class="nav-item community">
                        <a class="nav-link" href="/admin/community/index.html">
                            <i class="material-icons">settings</i>
                            <span>对接配置</span>
                        </a>
                    </li>
                    <li class="nav-item setting">
                        <a class="nav-link" href="/admin/setting/index.html">
                            <i class="material-icons">table_chart</i>
                            <span>任务配置</span>
                        </a>
                    </li>
                    <li class="nav-item pay">
                        <a class="nav-link" href="/admin/pay/index.html">
                            <i class="material-icons">account_balance_wallet</i><!--payment-->
                            <span>账户充值</span>
                        </a>
                    </li>
                    <li class="nav-item money">
                        <a class="nav-link " href="/admin/money/index.html">
                            <i class="material-icons">list</i>
                            <span>充值记录</span>
                        </a>
                    </li>


                    <li class="nav-item query">
                        <a class="nav-link " href="/admin/query/index.html">
                            <i class="material-icons">data_usage</i>
                            <span>查询</span>
                        </a>
                    </li>


                    <li class="nav-item message">
                        <a class="nav-link " href="/admin/message/index.html">
                            <i class="material-icons">message</i>
                            <span>消息通知</span>
                        </a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--<a class="nav-link " href="errors.html">-->
                    <!--<i class="material-icons">error</i>-->
                    <!--<span>Errors</span>-->
                    <!--</a>-->
                    <!--</li>-->
                </ul>
            </div>
        </aside>
        <!-- End Main Sidebar -->
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            <div class="main-navbar sticky-top bg-white">
                <!-- Main Navbar -->
                <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
                    <form action="{:url('task/index')}" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                        <div class="input-group input-group-seamless ml-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                            <input class="navbar-search form-control" type="text" name="order_id" placeholder="搜索点什么..."
                                   aria-label="Search"></div>
                    </form>
                    <ul class="navbar-nav border-left flex-row ">
                        <li class="nav-item border-right dropdown notifications">
                            <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <div class="nav-link-icon__wrapper">
                                    <i class="material-icons">&#xE7F4;</i>
                                    <!--<span class="badge badge-pill badge-danger">0</span>-->
                                </div>

                            </a>
                            <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">
                                    <div class="notification__icon-wrapper">
                                        <div class="notification__icon">
                                            <i class="material-icons">&#xE6E1;</i>
                                        </div>
                                    </div>
                                    <div class="notification__content">
                                        <span class="notification__category">Analytics</span>
                                        <p>Your website’s active users count increased by
                                            <span class="text-success text-semibold">28%</span> in the last week. Great
                                            job!</p>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <div class="notification__icon-wrapper">
                                        <div class="notification__icon">
                                            <i class="material-icons">&#xE8D1;</i>
                                        </div>
                                    </div>
                                    <div class="notification__content">
                                        <span class="notification__category">Sales</span>
                                        <p>Last week your store’s sales count decreased by
                                            <span class="text-danger text-semibold">5.52%</span>. It could have been
                                            worse!</p>
                                    </div>
                                </a>
                                <a class="dropdown-item notification__all text-center" href="#"> View all
                                    Notifications </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                               role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle mr-2" src="{$user.avatar}" alt="User Avatar">
                                <span class="d-none d-md-inline-block">{$user.nick_name}</span>
                            </a>
                            <!--菜单-->
                            <div class="dropdown-menu dropdown-menu-small">
                                <!--   <a class="dropdown-item" href="user-profile-lite.html">
                                     <i class="material-icons">&#xE7FD;</i> 接口</a>-->
                                <a class="dropdown-item" href="javaScript:click_pay();">
                                    <i class="material-icons">local_atm</i>一键支付</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#PasswordModel" href="javaScript:void(0);">
                                    <i class="material-icons">report</i>修改密码</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="javaScript:login_out();">
                                    <i class="material-icons text-danger">&#xE879;</i> 注销登录 </a>
                            </div>

                        </li>
                    </ul>
                    <nav class="nav">
                        <a href="#"
                           class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                           data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                           aria-controls="header-navbar">
                            <i class="material-icons">&#xE5D2;</i>
                        </a>
                    </nav>
                </nav>
            </div>
            <!-- / .main-navbar -->
            @yield('content')
        </main>
    </div>
</div>


<div class="modal fade" id="PasswordModel">
    <div class="modal-dialog   modal-dialog-centered  modal-sm">
        <div class="modal-content">
            <!-- 模态框 -->
            <form action="{:url('index/reset_password')}" onsubmit="return false" autocomplete="off">
                <!--头部 -->
                <div class="modal-header border-0">
                    <h4 class="modal-title">修改密码</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--主体 -->
                <div class="modal-body">

                    <!--<strong class="text-muted d-block mb-2">Form Validation</strong>-->
                    <div class="form-group">
                        <input type="text" class="form-control" name="old_password" id="old_password"
                               placeholder="请输入原密码" value=""/>
                        <div class="invalid-feedback">请输入原密码!</div>
                    </div>

                    <div class="form-group  ">
                        <input type="text" class="form-control" name="password" id="password"
                               placeholder="请输入新密码" value=""/>
                        <div class="invalid-feedback">请输入新密码！</div>
                    </div>

                </div>

                <!--底部 -->
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="promo-popup animated">
    <a href="#" class="pp-cta extra-action">
        <img src="https://dgc2qnsehk7ta.cloudfront.net/uploads/sd-blog-promo-2.jpg"> </a>
    <div class="pp-intro-bar"> Need More Templates?
        <span class="close">
          <i class="material-icons">close</i>
        </span>
        <span class="up">
          <i class="material-icons">keyboard_arrow_up</i>
        </span>
    </div>
    <div class="pp-inner-content">
        <h2>Shards Dashboard Pro</h2>
        <p>A premium & modern Bootstrap 4 admin dashboard template pack.</p>
        <a class="pp-cta extra-action" href="#">Download</a>
    </div>
</div>


<script src="/static/scripts/jquery-3.3.1.min.js"></script>
<script src="/static/scripts/popper.min.js"></script>
<script src="/static/scripts/bootstrap.min.js"></script>
<script src="/static/toastr/toastr.js"></script>
<script src="/static/layer/layer.js"></script>
<script src="/static/js/common.js"></script>

<script src="/static/scripts/shards.min.js"></script>
<!--<script src="/static/scripts/jquery.sharrre.min.js"></script>-->
<!--<script src="/static/scripts/extras.1.1.0.min.js"></script>-->
<script src="/static/scripts/Chart.min.js"></script>
<script src="/static/scripts/shards-dashboards.1.1.0.min.js"></script>
</body>
@show

</html>

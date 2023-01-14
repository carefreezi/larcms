@extends("admin.public")
@section('content')

    <link rel="stylesheet" href="{{asset("/static/admin/css/index.css")}}">

    <el-row :gutter="20">
        <el-col :span="12" :lg="10">
            <el-row :gutter="20">
                <el-col :span="12" class="gird-b">
                    <div>
                        <div class="float-right">
                            <i class="el-icon-user-solid widget-icon"></i>
                        </div>
                        <div class="text-muted font-weight-normal">用户</div>
                        <h3 class="count-num">36,254<span class="tips-cdoe">位</span></h3>
                        <p class="text-muted">
                            <span class="Top-C"><i class="el-icon-caret-top"></i> 5.27%</span>
                            <span class="text-nowrap">新增用户<span class="moeny-n">2</span>位</span></p>
                    </div>
                </el-col>
                <el-col :span="12" class="gird-b">
                    <div>
                        <div class="float-right">
                            <i class="el-icon-printer widget-icon"></i>
                        </div>
                        <div class="text-muted font-weight-normal">订单</div>
                        <h3 class="count-num">1234<span class="tips-cdoe">份</span></h3>
                        <p class="text-muted">
                            <span class="Top-C Down-C"><i class="el-icon-caret-top"></i> 1.27%</span>
                            <span class="text-nowrap">今日已支付订单<span class="moeny-n">172</span>份</span></p>
                    </div>
                </el-col>
                <el-col :span="12" class="gird-b">
                    <div>
                        <div class="float-right">
                            <i class="el-icon-coin widget-icon"></i>
                        </div>
                        <div class="text-muted font-weight-normal">销售金额</div>
                        <h3 class="count-num">￥1843<span class="tips-cdoe">元</span></h3>
                        <p class="text-muted">
                            <span class="Top-C"><i class="el-icon-caret-top"></i> 1.27%</span>
                            <span class="text-nowrap">今日已支付<span class="moeny-n">95</span>RMB</span></p>
                    </div>
                </el-col>
                <el-col :span="12" class="gird-b">
                    <div>
                        <div class="float-right">
                            <i class="el-icon-pie-chart widget-icon"></i>
                        </div>
                        <div class="text-muted font-weight-normal">精品资源</div>
                        <h3 class="count-num">18347<span class="tips-cdoe">份</span></h3>
                        <p class="text-muted">
                            <span class="Top-C"><i class="el-icon-caret-top"></i> 1.27%</span>
                            <span class="text-nowrap">今日新增<span class="moeny-n">15</span>份</span></p>
                    </div>
                </el-col>
            </el-row>
        </el-col>
        <el-col :span="12" :lg="14">
            <div class="card-shadow-map">
                <div id="OrderNumB" class="OrderNumB"></div>
            </div>
        </el-col>
    </el-row>
    <el-row :gutter="20">
        <el-col :span="12" :lg="10">
            <el-row :gutter="20">

                <el-col :span="12">
                    <div class="card-shadow-map Scqruip-Count">
                        <div id="PayNunMap" class="OrderNumB "></div>
                    </div>
                </el-col>

                <el-col :span="12">
                    <div class="card-shadow-map Scqruip-Count">
                        <div id="UserSexMap" class="OrderNumB "></div>
                    </div>
                </el-col>

            </el-row>
        </el-col>
        <el-col :span="12" :lg="14">
            <div class="card-shadow-map">
                <div id="PayMoenyMap" class="OrderNumB "></div>
            </div>
        </el-col>
    </el-row>
    <el-row :gutter="20" class="mg-t20">


        <el-col :span="10">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>值得关注的用户</span>
                </div>
                <div>
                    <template>
                        <el-table :data="worthUserData">

                            <el-table-column
                                label="昵称"
                                width="180">
                                <template slot-scope="scope">
                                    <el-popover trigger="hover" placement="top">
                                        <p>注册时间: </p>
                                        <p>用户ID: </p>
                                        <div slot="reference" class="name-wrapper">
                                            <el-avatar :src="scope.row.Avatar" class="user-c-p"></el-avatar>
                                            <span class="user-c-nick"></span>
                                        </div>
                                    </el-popover>
                                </template>
                            </el-table-column>
                            <el-table-column label="原因">
                                <template slot-scope="scope">
                                    <el-tag size="medium" :type="scope.row.type"></el-tag>
                                </template>
                            </el-table-column>
                            <el-table-column label="数量" prop="num">
                            </el-table-column>
                            <el-table-column label="操作" width="100">
                                <template slot-scope="scope">
                                    <el-link href="/" target="_blank">
                                        <el-button size="mini">查看</el-button>
                                    </el-link>
                                </template>
                            </el-table-column>
                        </el-table>
                    </template>

                </div>
            </el-card>
        </el-col>

        <el-col :span="14">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>值得关注的资源</span>
                </div>
                <div class="worthResdData">
                    <template>
                        <el-table :data="worthResdData">

                            <el-table-column
                                label="封面"
                                width="180">
                                <template slot-scope="scope">
                                    <el-image :src="scope.row.cover" class="order-pic"></el-image>
                                </template>
                            </el-table-column>
                            <el-table-column label="名称" prop="name">
                            </el-table-column>
                            <el-table-column label="分类">
                                <template slot-scope="scope">
                                    <span class="typeResT"><span class="dv-span">/</span></span>
                                </template>
                            </el-table-column>
                            <el-table-column label="原因">
                                <template slot-scope="scope">
                                    <el-tag size="medium" :type="scope.row.type"></el-tag>
                                </template>
                            </el-table-column>
                            <el-table-column label="数量" prop="num">
                            </el-table-column>
                            <el-table-column label="操作" width="100">
                                <template slot-scope="scope">
                                    <el-link href="/" target="_blank">
                                        <el-button size="mini">查看</el-button>
                                    </el-link>
                                </template>
                            </el-table-column>
                        </el-table>
                    </template>

                </div>
            </el-card>
        </el-col>
    </el-row>

    <script src="{{asset("/static/admin/scripts/index.js")}}"></script>

@endsection

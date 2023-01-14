@extends('admin.layout')
@section('content')
<style>
    td .mr-2, td .mr-1 {
        padding: 5px !important;
        margin-bottom: 0 !important;
    }

    .card-header {
        position: relative;
    }

    #add_config {
        position: absolute;
        right: 15px;
        top: 11px;
    }
</style>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <span class="text-uppercase page-subtitle">Overview</span>
            <h3 class="page-title mb-2">社区配置</h3>
            <font style="font-size: x-small; color: #007bff">注：请将本机IP （<span style="color:red; padding: 0 3px;">{$server_ip}</span>）加入社区白名单,以免抓取任务被目标服务器限制 </font>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">社区授权配置</h6>
                    <button type="button" class="mb-2 btn btn-primary mr-2" data-toggle="modal" data-target="#myModal"
                            id="add_config">添加配置
                    </button>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table class="table mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-0"># ID</th>
                            <th scope="col" class="border-0">平台名称</th>
                            <th scope="col" class="border-0">接口地址</th>
                            <th scope="col" class="border-0">TokenId</th>
                            <th scope="col" class="border-0">全局KEY</th>
                            <th scope="col" class="border-0">创建时间</th>
                            <th scope="col" class="border-0">操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr data-json='{:json_encode($vo,JSON_UNESCAPED_UNICODE)}'>
                            <td># {$vo.id}</td>
                            <td>{$vo['community_type']=="JW"?"95社区":"亿乐社区"}</td>
                            <td>{$vo.api_address}</td>
                            <td>{$vo.token_id|default='-'}</td>
                            <td>{$vo.global_api_key|msk}</td>

                            <td>{if $vo.create_time}{$vo.create_time|date="Y-m-d H:i:s"}{else/} - {/if}</td>

                            <td data-id="{$vo.id}">
                                <button class="mb-2 btn btn-primary mr-2 edit">编辑</button>
                                <button class="mb-2 btn btn-sm btn-white mr-1 delete">删除</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->
</div>

<button style="display: none" data-toggle="modal" id="update" data-target="#myModal"></button>
<!-- 模态框 -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" onsubmit="return false" autocomplete="off">
                <!--头部 -->
                <div class="modal-header border-0">
                    <h4 class="modal-title">添加配置</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--主体 -->
                <div class="modal-body">
                    <div class="col-sm-12">
                        <strong class="text-muted d-block mb-2">以下参数仅本人可见 </strong>
                        <div class="form-group">
                            <input type="text" class="form-control" name="api_address" id="api_address"
                                   placeholder="请输入社区接口地址，如：“www.baidu.com”" data-rep="^\w+\.\w+\.\w+$" value=""/>
                            <div class="invalid-feedback">请输入从社区接口域名地址，如：www.95sq.com</div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="token_id" style="display: none"
                                   data-rep="^\d{2,32}$"
                                   id="token_id"
                                   placeholder="请输入社区TokenId" value=""/>
                            <div class="invalid-feedback">请输入社区TokenId ,由纯数字组成！</div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="global_api_key" data-rep="^\w{2,32}$"
                                   id="global_api_key"
                                   placeholder="请输入社区全局授权key" value=""/>
                            <div class="invalid-feedback">请输入从社区获取的全局授权key！</div>
                        </div>

                        <div class="form-group community_type">
                            <select class="form-control" name="community_type" id="community_type">
                                <option selected value="">选择平台</option>
                                {volist name="select" id="v"}
                                <option value="{$key}">{$v}</option>
                                {/volist}
                            </select>
                            <div class="invalid-feedback">请选择绑定平台！</div>
                        </div>


                    </div>
                </div>
                <!--底部 -->
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">

    _form = $("#myModal form");

    /**
     *添加配置
     * */
    $("#add_config").on("click", function (e) {
        _form.find(".modal-title").data("id", 0).html("添加配置");
        reset_form();
    });

    /**
     *初始化表单
     **/
    function reset_form() {

        _form.get(0).reset();
        $(".community_type").show();
        $("#token_id").hide();
        _form.find(".is-invalid").removeClass("is-invalid");
    }


    /**
     * 是否显示TOKENID 输入框
     * */
    $("#community_type").change(function () {

        console.log($(this).val());
        ck_sel($(this).val())
    });


    /**
     * 提交数据
     * **/
    _form.submit(function (e) {

        var id = _form.find(".modal-title").data("id");
        var community_type = _form.find(".modal-title").data("community_type");
        var data = $(this).formData();

        if (!verify(data)) {
            return;
        }

        var btn = $(this).find("button[type=submit]");
        var url = "{:url('add')}";

        if (id) {

            url = "{:url('update')}";
            data.id = id;
            data.community_type = community_type;
        }

        request({
            url: url,
            data: data,
            btn: btn,
            reload: 1,
            done: function (res) {
                res.code && $("#myModal").click();
            }
        });

    });


    /**
     * 删除配置
     * */
    $(".delete").on("click", function () {

        var id = $(this).parent("td").data("id");
        var that = $(this);
        layer.confirm("删除后将会影响对接，确定要删除此条数据吗?", function (idx) {
            request({
                btn: ".layui-layer-btn0",
                url: "{:url('delete')}",
                data: {id: id},
                done: function (res) {
                    if (res.code) {
                        that.parents("tr").fadeOut(1000);
                        setTimeout(function () {
                            that.parents("tr").remove();
                            location.reload()
                        }, 1010);
                        layer.close(idx);
                    }
                }
            });
        });

    });

    /**
     * 编辑配置
     **/

    $(".edit").on("click", function () {

        reset_form();
        var id = $(this).parent("td").data("id");
        var that = $(this);
        var data = that.parents("tr").data("json");
        _form.find(".form-control").each(function (i, e) {
            var k = e.id;
            e.value = data[k];
        });

        $(".community_type").hide();
        $("#update").click();

        ck_sel(data.community_type);

        _form.find(".modal-title")
            .data("id", id)
            .data("community_type", data.community_type)
            .html("编辑配置");

    });


    /**
     * 验证提示
     * */
    _form.find(".form-control").blur(function (e) {
        $(this).removeClass("is-invalid");
        var data = $(this).formData();
        verify(data);
    });


    function ck_sel(v) {
        if (v === 'YL') {
            $("#token_id").prop("disabled", false).show();
        } else {
            $("#token_id").prop("disabled", true).hide().removeClass("is-invalid");
        }
    }


</script>
@endsection

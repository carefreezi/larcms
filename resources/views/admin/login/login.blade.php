<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录 - 云CMS管理系统</title>
    <link rel="stylesheet" href="/static/frame/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/frame/toastr/toastr.min.css">
    <style>
        * {  box-sizing: border-box;  }
        body {  background-color: #f5f5f5;  }
        #embed-captcha {  width: 300px;  margin: 0 auto;  }
        .login {  background: #fff;  border-radius: 10px;  max-width: 500px;  height: 500px;    padding-top: 40px;  margin: 0 auto;  margin-top: 70px;  }

        .login form {  width: 300px;  margin: auto;  }
        .login-logo {  display: block;  width: 240px;  margin: 0 auto;  margin-bottom: 40px;  }
        .input-logo {  display: block;  height: 46px;  line-height: 46px;  width: 100%;  border: 0px solid #efefef;  background: #f8f8f8;  border-radius: 3px;  font-size: 15px;  padding: 0px 18px;  margin-bottom: 19px;  }
        .login-btn {  background-image: linear-gradient(180deg, #007bff 0, #0075f3);;  height: 45px; /*line-height: 45px;*/  width: 100%;  display: block;  color: #FFF;  font-size: 16px;  border-radius: 3px;  cursor: pointer;  border: 0;  }
        .input-felx{position: relative;}
        .input-felx .code-fl{position: absolute;right: 1px;top: 1px;height: 44px}
        .input-felx .code-fl img{ height: 100%}

    </style>
</head>
<body>

<div class="login">
    <form action="login.html" id="_form" autocomplete="off" onsubmit="return false">
        <img src="/static/admin/images/logo.png" class="login-logo">
        <input type="text" name="username" placeholder="请输入账号" class="input-logo">
        <input type="password" name="password" placeholder="请输入密码" class="input-logo">
        <div class="input-felx">
            <input type="text" autocomplete="no" maxlength="6" name="captcha" placeholder="请输入验证码" class="input-logo">
            <div class="code-fl">
                <img src="/admin/captcha"  onclick='this.src=this.src+"?_t="+Math.random()' id="captcha" alt="captcha">
            </div>
        </div>
        <button class="btn btn-primary login-btn" >登 录</button>
    </form>
</div>
<script src="/static/frame/js/jquery3.4.1.slim.min.js"></script>
<script src="/static/frame/bootstrap-4.4.1-dist/js/bootstrap.bundle.min.js"></script>
<script src="/static/frame/toastr/toastr.js"></script>
<script src="/static/admin/scripts/public.js"></script>
<script>

    $("#_form").submit(function () {
        var data = $(this).formData();

        if ($("input[name='username']").val() && $("input[name='password']").val()) {
            request({
                btn: ".login-btn",
                url: "/admin/login/login_post",
                data: data,
                done: function (rs) {
                    if( !rs.code ){
                        $("#captcha").attr("src",'/admin/captcha?_t='+Math.random());
                    }
                }
            });
        } else {
            toastr.warning("请输入完信息！");
        }
        return false;
    });

</script>
</body>
</html>

<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>邮件系统</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.css"/>
    <!--<link rel="stylesheet" type="text/css" href="/Public/Admin/css/layout.css"/>-->
    <script type="text/javascript" src="/Public/static/jquery-1.8.3.min.js"></script>
</head>
<body>
<style type="text/css">
    .l-con {
        height: 600px;
        position: relative
    }

    .login {
        width: 400px;
        height: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -200px;
        margin-top: -100px;
    }

    .btn1 {
        background: #549FCC;
        border: none;
        border-radius: 5px;
        color: #FFFFFF;
        cursor: pointer;
        font-size: 20px;
        height: 38px;
        line-height: 38px;
        margin: 0;
        overflow: visible;
        padding: 0;
        vertical-align: middle;
        width: 248px;
    }

    .input {
        border: 1px solid #DFDFDF;
        height: 25px;
        line-height: 25px;
    }

    .lg li {
        float: left;
        height: 40px;
        line-height: 40px;
        width: 100%;
    }

    .lg li .msg {
        float: left;
        width: 50px;
    }

    .lg li .in {
        float: left;
    }

    .lg li .code-img {
        float: left;
        padding: 5px 0 0 10px
    }
</style>
<script>
    $(function ($) {
        var wh = $(window).height();
        var hh = $(".header").height();
        var fh = $(".footer").height();
        var ch = wh - hh - fh - 52;
        $(".l-con").height(ch);
        //刷新验证码
        var verifyimg = $(".verifyimg").attr("src");
        $(".verifyimg").click(function () {
//            if( verifyimg.indexOf('?')>0){
//                $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
//            }else{
            $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            // }
        });
    });
</script>
<div class="c-con">
    <div class="l-con">
        <div class="login">
            <div class=" ">
                <h2 class="text-center">邮件管理系统</h2>
            </div>
            <form class="form-horizontal" role="form" name="login" method="post" name="login" onsubmit="return sub()">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">用户名：</label>

                    <div class="col-sm-7">
                        <input type="text" name="username" class="form-control" placeholder="长度为3-30位的用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">密&nbsp;&nbsp;&nbsp;码：</label>

                    <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" placeholder="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">验证码：</label>

                    <div class="col-sm-3">
                        <input type="text" name="code" maxlength="8" class="form-control">
                    </div>
                    <div class="col-sm-2">
                        <img class="verifyimg" src="<?php echo U('Public/verify');?>" alt="点击刷新"
                             style="cursor:pointer;"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <button type="submit" class="btn btn-primary">登陆</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function sub() {
        var form = document.login;
        var username = form.username.value;
        var password = form.password.value;
        var code = form.code.value;
        if (username.length == 0) {
            alert("用户名为空");
            form.username.focus();
            return false;
        }
        if (password.length == 0) {
            alert("密码为空");
            form.password.focus();
            return false;
        }
        if (code.length != 4) {
            alert("请输入5位数的验证码");
            form.code.focus();
            return false;
        }
    }
</script>
</body>
</html>
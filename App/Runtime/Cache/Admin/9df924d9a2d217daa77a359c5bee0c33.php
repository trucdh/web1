<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/layout.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/admin.css"/>
    <script type="text/javascript" src="/Public/static/jquery-1.8.3.min.js"></script>
    <script language="javascript" type="text/javascript" src="/Public/static/date/WdatePicker.js"></script>
    <script language="javascript" type="text/javascript" src="/Public/static/datetimepicker.min.js"></script>
    <!--<![endif]-->
    
</head>
<body>
<!-- 头部 -->
<div class="clearfix">
    <div class="col-md-12 column" style="padding:0;">
        <nav class="navbar navbar-default" role="navigation" style="margin:0;">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo U('Index/index');?>">后台首页</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">邮件信息<strong
                                class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo U('Email/index');?>">邮件列表</a></li>
                            <li><a href="<?php echo U('Email/addEmail');?>">添加邮件</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">邮件模板<strong
                                class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo U('Email/emailTemplate');?>">模板列表</a></li>
                            <li><a href="<?php echo U('Email/addTemplate');?>">添加模板</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo U('Index/index');?>"></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">个人中心<strong
                                class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="w-a mt">
    <script src="/Public/static/bootstrap-dropdown.js"></script>
    <script>
        $(function () {
            $('.dropdown-toggle').dropdown();
        })

    </script>
</div>
<ul class="breadcrumb" style="margin:0;">
    <li><a href="<?php echo U('Index/index');?>">首页</a> <span class="divider"></span></li>
    <li><a href="<?php echo U('Email/index');?>">邮件列表</a> <span class="divider"></span></li>
    <li><a href="<?php echo U('Email/addEmail');?>">添加邮件</a> <span class="divider"></span></li>
    <li><a href="<?php echo U('Email/emailTemplate');?>">模板列表</a> <span class="divider"></span></li>
    <li><a href="<?php echo U('Email/addTemplate');?>">添加模板</a> <span class="divider"></span></li>
</ul>
<!-- 内容区 -->
<div id="content" style="padding:0 10px;">
    
        <h5> 用户名：<?php echo ($user['username']); ?></h5>
        <h5>姓名：<?php echo ($user['realName']); ?></h5>
        <h5>邮箱：<?php echo ($user['email']); ?></h5>
        <h5>登陆ip：<?php echo ($user['lastIp']); ?></h5>
        <h5>登陆时间：<?php echo (date('Y-m-d H:i:s',$user['lastTime'])); ?></h5>
    
</div>
</body>
</html>
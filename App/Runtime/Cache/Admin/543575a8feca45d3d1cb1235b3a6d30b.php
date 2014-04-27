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
    
    <script charset="utf-8" src="/Public/static/kindeditor/kindeditor-all-min.js"></script>
    <script charset="utf-8" src="/Public/static/kindeditor/lang/zh_CN.js"></script>
    <script>
        var editor;
        KindEditor.ready(function (K) {
            editor = K.create('textarea[name="content"]', {
                resizeType: 1,
                allowPreviewEmoticons: false,
                allowImageUpload: false,
                items: [
                    'source', 'redo', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
            });
        });
    </script>
    <div class="c-con">
        <div class="add_email">
            <form class="form-horizontal" role="form" name="login" method="post"  name="login" onsubmit="return sub()">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">模板名称：</label>

                    <div class="col-sm-8">
                        <input type="text" name="title" class="form-control" value="<?php echo ($read['title']); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">模板内容：</label>

                    <div class="col-sm-8">
                        <textarea class="form-control" rows="10" name="content"><?php echo ($read['content']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button type="submit" class="btn btn-primary">修改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
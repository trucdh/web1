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
    
    <style type="text/css">
        .ui-dialog {
            overflow: auto;
        }
    </style>
    <script src="/Public/static/lib/sea.js"></script>
    <script>
        seajs.config({
            alias: {
                "jquery": "jquery-1.10.2.js"
            }
        });
    </script>
    <script>
        seajs.use(['jquery', '/Public/static/src/dialog'], function ($, dialog) {
            $('.read').on('click', function () {
                var id = $(this).attr('readid');
                $.post("<?php echo U('Email/templateOne');?>", { id: id},
                        function (data) {
                            var da = jQuery.parseJSON(data)
                            var title = da.title;
                            var content = da.content;
                            var d = dialog({
                                title: title,
                                content: content,
                                okValue: '确认',
                                ok: function () {
                                }
                            });
                            d.show();
                        });
            });
        });
    </script>
    <div class="w-a mt">
        <table border="1" class="table table-bordered table-condensed table-hover mt" width="100%">
            <thead>
            <tr>
                <td>ID</td>
                <td>标题</td>
                <td>内容</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list)): foreach($list as $k=>$v): ?><tr>
                    <td><?php echo ($v['id']); ?></td>
                    <td><?php echo ($v['title']); ?></td>
                    <td><a href="javascript:void(0)" class="read" readid="<?= $v['id'] ?>">预览</a></td>
                    <td><a href="/Admin/Email/templateEdit/id/<?php echo ($v['id']); ?>">编辑</a>-
                        <a href="/Admin/Email/templateDel/id/<?php echo ($v['id']); ?>">删除</a></td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
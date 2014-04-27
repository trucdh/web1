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
                    'source', 'fontname', 'redo', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
            });
        });
    </script>
    <script type="text/javascript">
        $(function ($) {
            $("#template").change(function () {
                var id = $(this).val();
                $.post("<?php echo U('Email/templateOne');?>", { id: id},
                        function (data) {
                            var da = jQuery.parseJSON(data)
                            var title = da.title;
                            var content = da.content;
                            editor.html(content);
                            $("#title").attr({value: title});
                        });
            });
            $("#isTiming").change(function () {
                $("#timing").removeClass("hidden");
            });
            $("#noTiming").change(function () {
                $("#timing").addClass("hidden");
                $("#timingValue").attr({value: ""});
            });
            $("#import").toggle(
                    function () {
                        $(this).html("取消xls、xlsx");
                        $("#batch").removeClass("hidden");
                        $("#recipient").attr({disabled: "disabled", value: ""});
                        $("#batch").attr({value: ""});
                    },
                    function () {
                        $(this).html("导入xls、xlsx");
                        $("#batch").addClass("hidden");
                        $("#recipient").removeAttr("disabled");
                    }
            );
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('#timing').datetimepicker({
                language: 'zh-CN',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        });
    </script>
    <div class="c-con">
        <div class="add_email">
            <form enctype="multipart/form-data" class="form-horizontal" role="form" name="login" method="post"
                  name="login"
                  onsubmit="return sub()">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮件模板：</label>

                    <div class="col-sm-8">
                        <select class="form-control" id="template">
                            <option>请选择邮件模板</option>
                            <?php if(is_array($list)): foreach($list as $k=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v['title']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮件标题：</label>

                    <div class="col-sm-8">
                        <input type="text" name="title" class="form-control" id="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">收件人：</label>

                    <div class="col-sm-4">
                        <input type="text" name="email" id="recipient" class="form-control" placeholder="多个邮箱使用英文逗号隔开">
                    </div>
                    <div class="col-sm-1" style="margin-right: 50px;">
                        <button type="button" id="import" class="btn btn-default">导入xls、xlsx</button>
                    </div>
                    <div class="col-sm-3">
                        <input type="file" name="batch" id="batch" class="hidden" style="padding: 6px 0 0 0">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">是否定时：</label>

                    <div class="col-sm-2">
                        <label class="radio-inline">
                            <input type="radio" value="0" name="isTiming" checked="checked" id="noTiming"> 否
                        </label>
                        <label class="radio-inline">
                            <input type="radio" value="1" name="isTiming" id="isTiming"> 是
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <div id="timing" class="input-append date hidden">
                            <input data-format="yyyy-MM-dd hh:mm:ss" name="timing" id="timingValue" type="text"
                                   class="form-control"
                                   placeholder="格式如2014-01-01 12:00:00">
                            <span class="add-on">
                              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                              </i>
                            </span>
                        </div>
                        <!--<input type="text" name="timing" id="timing" class="form-control hidden">-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">邮件内容：</label>

                    <div class="col-sm-8">
                        <textarea class="form-control" rows="15" name="content" id="content"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button type="submit" class="btn btn-primary">添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Css/style.css"/>
    <script type="text/javascript" src="/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>

    <link rel="stylesheet" href="/Public//kindeditor/themes/default/default.css"/>
    <link rel="stylesheet" href="/Public//kindeditor/plugins/code/prettify.css"/>
    <script charset="utf-8" src="/Public//kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/Public//kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/Public//kindeditor/plugins/code/prettify.js"></script>
    <script type="text/javascript">

        KindEditor.ready(function (K) {
            var editor = K.editor({
                allowFileManager: true
            });
            K('#image3').click(function () {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        showRemote: false,
                        imageUrl: K('#url3').val(),
                        clickFn: function (url, title, width, height, border, align) {
                            K('#url3').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });


            K.create('textarea[name="content"]', {
                cssPath: '/Public//kindeditor/plugins/code/prettify.css',
                themeType: 'simple',
                resizeType: 1,
                uploadJson: '/Public//kindeditor/php/upload_json.php',
                fileManagerJson: '/Public//kindeditor/php/file_manager_json.php',
                allowFileManager: true,
                //afterCreate: function(){this.sync();}
                //下面这行代码就是关键的所在，当失去焦点时执行 this.sync();
                afterBlur: function () {
                    this.sync();
                }
            });
        });
    </script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }

        textarea{
            width:800px;
        }

    </style>
</head>
<body>
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">网站信息添加</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Setting/infoaddsubmit');?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">名称</td>
            <td><input type="text" name="title"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">英文名称</td>
            <td><input type="text" name="name"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">简介</td>
            <td><textarea name="excerpt" id="excerpt" cols="80" rows="5"></textarea>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">内容</td>
            <td><textarea name="content" id="content" cols="80" rows="15"><?php echo htmlspecialchars(""); ?></textarea>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>

        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>
    $(function () {
        $('#backid').click(function () {
            window.location.href = "infoset.html";
        });
    });

    $("form").submit(function () {

        if ($("input[name='title']").val().length == 0) {
            alert("请输入名称！");
            $("input[name='title']").focus();
            return false;
        }
        if ($("input[name='name']").val().length == 0) {
            alert("请输入英文名称！");
            $("input[name='author']").focus();
            return false;
        }
        if ($("#excerpt").val().length == 0) {
            alert("请输入简介！");
            $("#excerpt").focus();
            return false;
        }
        if ($("#content").val().length == 0) {
            alert("请输入内容！");
            $("#content").focus();
            return false;
        }
    });
</script>
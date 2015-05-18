<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/style.css" />
    <script type="text/javascript" src="/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>



    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<body>
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">修改个人信息</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/User/updateinfo');?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">登录名称</td>
            <input type="hidden" name="username" value="<?php echo ($list["username"]); ?>"/>
            <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>"/>
            <td><?php echo ($list["username"]); ?></td>
        </tr>
        <tr>
            <td class="tableleft">最后登录时间</td>
            <td><?php echo (date("Y-m-d H:i:s",$list["ldate"])); ?></td>
        </tr>
        <tr>
            <td class="tableleft">最后登录ip</td>
            <td><?php echo ($list["cip"]); ?></td>
        </tr>
        <tr hidden>
            <td class="tableleft">密码</td>
            <td><input type="password" name="password" value=""/></td>
        </tr>

        <tr>
            <td class="tableleft">真实姓名</td>
            <td><input type="text" name="name" value="<?php echo ($list["name"]); ?>" /></td>
        </tr>

        <tr>
            <td class="tableleft">联系手机</td>
            <td><input type="text" name="tel" value="<?php echo ($list["tel"]); ?>" />&nbsp;&nbsp;<span class="label label-success">选填</span></td>
        </tr>
        <tr>
            <td class="tableleft">联系QQ</td>
            <td><input type="text" name="qq" value="<?php echo ($list["qq"]); ?>" />&nbsp;&nbsp;<span class="label label-success">选填</span></td>
        </tr>
        <tr>
            <td class="tableleft">E-mail</td>
            <td><input type="text" name="email" value="<?php echo ($list["email"]); ?>" />&nbsp;&nbsp;<span class="label label-success">选填</span></td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>
    $(function () {
        $('#backid').click(function(){
            window.location.href="index.html";
        });

    });
</script>
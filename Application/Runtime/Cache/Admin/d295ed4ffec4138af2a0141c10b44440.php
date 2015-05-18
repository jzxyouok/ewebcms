<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public/Css/style.css" />
    <script type="text/javascript" src="/ewebcms/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcms/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcms/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcms/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcms/Public/Js/common.js"></script>

 

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
    <a class="brand">用户编辑</a>
  </div>
</div>
</div>
<form action="<?php echo U('Admin/Main/updatepasswordsubmit');?>" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">登录名称</td>
        <input type="hidden" name="username" value="<?php echo ($list["username"]); ?>"/>
        <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>"/>
        <td><span class="input-xlarge uneditable-input"><?php echo ($list["username"]); ?></span></td>
    </tr>
    <tr>
        <td class="tableleft">密码</td>
        <td><input type="password" name="password" value=""/></td>
    </tr>
    <tr>
        <td class="tableleft">真实姓名</td>
        <td><input type="text" name="name" value="<?php echo ($list["name"]); ?>" /></td>
    </tr>

    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
    $(function () {       
        $('#backid').click(function(){
                window.location.href="datashow.html";
         });

    });
</script>
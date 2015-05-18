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
            <a class="brand">连接微信公众号</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Wechat/connectsubmit');?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">appID</td>
            <td><input type="text" name="appid" value = "<?php echo ($list["appid"]); ?>"  style="width:400px;"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">appSecret</td>
            <td><input type="text" name="appsecret" value = "<?php echo ($list["appsecret"]); ?>"  style="width:400px;"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">access_token</td>
            <td><?php echo ($access_token); ?></td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button>
                &nbsp;&nbsp;
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>

    $("form").submit(function () {

        if ($("input[name='appid']").val().length == 0) {
            alert("请输入appID！");
            $("input[name='appid']").focus();
            return false;
        }
        if ($("input[name='appsecret']").val().length == 0) {
            alert("请输入appsecret！");
            $("input[name='appsecret']").focus();
            return false;
        }
    });
</script>
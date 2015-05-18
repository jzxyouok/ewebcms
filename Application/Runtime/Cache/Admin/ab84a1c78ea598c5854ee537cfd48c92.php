<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/style.css"/>
    <script type="text/javascript" src="/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/Public//Js/common.js"></script>

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
            <a class="brand">角色添加</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Role/addsubmit');?>" method="post" class="definewidth m20">
    <input type="hidden" name="id" value="<?php echo ($role["id"]); ?>"/>
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">角色名称</td>
            <td><input type="text" name="name" value=""/></td>
        </tr>

        <tr>
            <td class="tableleft">文档管理权限</td>
            <td><select name="doclevel" style="width:200px">
                <option id="option1" value="8">无</option>
                <option id="option1" value="6">查看</option>
                <option id="option1" value="4">查看、修改</option>
                <option id="option1" value="2">查看、修改、新增</option>
                <option id="option1" value="0">查看、修改、新增、删除</option>
            </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">留言管理权限</td>
            <td><select name="messlevel" style="width:200px">
                <option id="option1" value="8">无</option>
                <option id="option1" value="6">查看</option>
                <option id="option1" value="2">查看、回复</option>
                <option id="option1" value="0">查看、回复、删除</option>
            </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">新闻分类管理权限</td>
            <td><select name="classlevel" style="width:200px">
                <option id="option1" value="8">无</option>
                <option id="option1" value="6">查看</option>
                <option id="option1" value="4">查看、修改</option>
                <option id="option1" value="2">查看、修改、新增</option>
                <option id="option1" value="0">查看、修改、新增、删除</option>
            </select>
            </td>
        </tr>
        <tr>
            <td class="tableleft">用户管理权限</td>
            <td><select name="memblevel" style="width:200px">
                <option id="option1" value="8">无</option>
                <option id="option1" value="6">查看</option>
                <option id="option1" value="4">查看、修改</option>
                <option id="option1" value="2">查看、修改、新增</option>
                <option id="option1" value="0">查看、修改、新增、删除</option>
            </select>
            </td>
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
        $(':checkbox[name="group[]"]').click(function () {
            $(':checkbox', $(this).closest('li')).prop('checked', this.checked);
        });

        $('#backid').click(function () {
            window.location.href = "index.html";
        });

    });
</script>
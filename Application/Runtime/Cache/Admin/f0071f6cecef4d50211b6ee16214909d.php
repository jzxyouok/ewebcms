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

        .cont {
            padding: 4px;
            width: 840px;
            border: 1px solid #d1dee2;
            border: 1px solid #d1dee2;
            background: #fff;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -moz-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            -webkit-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            box-shadow: rgba(24, 108, 162, 0.6) 4px;
        }

    </style>
</head>
<div class="definewidth m10">
    <div class="navbar definewidth m10">
        <div class="navbar-inner">
            <a class="brand">留言回复</a>

        </div>
    </div>
</div>
<body>
<form action="<?php echo U('Admin/Message/replysubmit');?>" method="post" class="definewidth m20">
    <input type="hidden" name="id" value="<?php echo ($role["id"]); ?>"/>
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">留言标题</td>
            <td><span class="input-xlarge uneditable-input"><?php echo ($list["title"]); ?></span>
                <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>"/>
            </td>
        </tr>
        <tr>
            <td class="tableleft">状态
            <td>

                <?php if($list["display"] == 0): ?><input type="checkbox" name="display"/> 可见
                    <?php else: ?>
                    <input type="checkbox" name="display" checked/>可见<?php endif; ?>

            </td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">姓名</td>
            <td><span class="input-xlarge uneditable-input"><?php echo ($list["name"]); ?></span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">电话</td>
            <td><span class="input-xlarge uneditable-input"><?php echo ($list["phone"]); ?></span></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">内容</td>
            <td>
                <div class="cont"><?php echo ($list["content"]); ?></div>
            </td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">回复</td>
            <td><textarea name="reply" style="width:850px;height:150px;"><?php echo ($list["reply"]); ?></textarea>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">回复</button>
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
            window.location.href = "<?php echo U('Admin/Message/index');?>?type=1";
        });

    });
</script>
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

        .pagination a, .pagination .current {
            float: left;
            padding: 4px 12px;
            line-height: 20px;
            text-decoration: none;
            background-color: #ffffff;
            border: 1px solid #dddddd;

        }

    </style>
</head>
<body>
<div class="navbar definewidth m10">
    <div class="navbar-inner">
        <a class="brand">所有用户列表</a>&nbsp; <a class="brand">关注数:<?php echo ($count); ?></a>&nbsp; <a class="brand">取消关注数:<?php echo ($ucount); ?></a>
    </div>
</div>
<form action="<?php echo U('Admin/Wechat/delall');?>" method="post">
    <table class="table table-bordered table-hover definewidth m10">
        <thead>
        <tr>
            <th width="5%">用户头像</th>
            <th width="10%">openID</th>
            <th width="10%">用户昵称</th>
            <th width="10%">用户地区</th>
            <th width="10%">关注时间</th>
        </tr>
        </thead>
        <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><center><img src="<?php echo ($vo["headimgurl"]); ?>" alt="<?php echo ($vo["nickname"]); ?>" width="40px" height="40px"/></center></td>
                <td><?php echo ($vo["openid"]); ?></td>
                <td><?php echo ($vo["nickname"]); ?></td>
                <td><?php echo ($vo["city"]); ?></td>
                <td><?php echo (date("Y-m-d H:i",$vo["subscribe_time"])); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <p>&nbsp;</p>

    <div class="row">
        <div class="pagination pagination-centered">
            <ul>
                <?php echo ($page); ?>
            </ul>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
</form>


</body>
</html>

<script>
    $(function () {

        $('#addnew').click(function () {

            window.location.href = "add.html";
        });
    });

    function del(id) {

        if (confirm("确定要删除吗？")) {
            window.location.href = "<?php echo ($delurl); ?>?id=" + id;

        }
    }

    function reply(id) {
        window.location.href = "<?php echo ($replyurl); ?>?id=" + id;

    }
    function check(id) {
        window.location.href = "<?php echo ($checkurl); ?>?id=" + id;
    }

    function selectall(choose) {
        if (choose) {
            //alert(choose);
            $("input[type='checkbox']").each(function () {
                this.checked = true;
            });
        } else {

            $("input[type='checkbox']").removeAttr("checked");
        }
    }

</script>
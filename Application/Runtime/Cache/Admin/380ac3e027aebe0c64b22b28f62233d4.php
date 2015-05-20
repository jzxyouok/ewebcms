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
<div class="navbar definewidth m10">
    <div class="navbar-inner">
        <a class="brand">导航列表</a>
        <button style="float:right;" type="button" class="btn btn-success" onclick="javasript:add()">添加导航</button>
    </div>
</div>

<div>
    <form action="<?php echo U('Admin/NewsClass/DelallOrSort');?>">
        <table class="table table-bordered table-hover definewidth m10" classid="class_1">
            <thead>
            <tr>
                <th width="7%">导航序号</th>
                <th width="40%" colspan="2">导航名称</th>
                <th width="40%">导航描述</th>
                <th>操作</th>
            </tr>
            </thead>
            <?php if(is_array($navlist)): $i = 0; $__LIST__ = $navlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td colspan="2"><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["remark"]); ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-mini btn-info" onclick="javasript:edit(<?php echo ($vo["id"]); ?>)">编辑
                            </button>
                            <button type="button" class="btn btn-mini btn-danger" onclick="javasript:del(<?php echo ($vo["id"]); ?>)">删除
                            </button>
                        </div>
                    </td><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </form>


</div>
</body>
</html>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo ($addurl); ?>";
        });
    });
    function add() {
        window.location.href = "<?php echo ($addurl); ?>";
    }

    function edit(id) {
        window.location.href = "<?php echo ($editurl); ?>?id=" + id;
    }
    function del(id) {
        if (confirm("确定要删除吗?同时会删除导航下的全部菜单")) {
            window.location.href = "<?php echo ($delurl); ?>?id=" + id;
        }
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

    function show(id, choose) {
        if (choose) {
            window.location.href = "<?php echo ($showurl); ?>?id=" + id + "&choose=1";
        } else {
            window.location.href = "<?php echo ($showurl); ?>?id=" + id + "&choose=0";
        }
    }
</script>
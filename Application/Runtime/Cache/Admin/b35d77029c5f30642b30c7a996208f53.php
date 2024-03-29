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

<div class="navbar definewidth m10">
    <div class="navbar-inner">
        <a class="brand">角色列表</a>
        <button style="float:right" type="button" class="btn btn-success" id="addnew">添加角色</button>
    </div>
</div>

<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th width="5%">序号</th>
        <th width="15%">角色名称</th>
        <th width="15%">文档权限</th>
        <th width="15%">分类权限</th>
        <th width="15%">留言权限</th>
        <th width="15%">用户权限</th>
        <th width="10%">操作</th>
    </tr>
    </thead>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["name"]); ?></td>
            <td>
                <?php echo $p1[$vo[doclevel]] ?>
            </td>
            <td>
                <?php echo $p1[$vo[classlevel]] ?>
            </td>
            <td>
                <?php echo $p2[$vo[messlevel]] ?>
            </td>
            <td>
                <?php echo $p1[$vo[memblevel]] ?>
            </td>
            <td>
                <button type="button" class="btn btn-mini btn-info" id="addnew" onclick="javasript:edit(<?php echo ($vo["id"]); ?>)">编辑
                </button>
                <button type="button" class="btn btn-mini btn-danger" id="addnew" onclick="javasript:del(<?php echo ($vo["id"]); ?>)">删除
                </button>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
</body>
</html>

<script>
    $(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo U('Admin/Role/add');?>";
        });


    });

    function edit(id) {
        window.location.href = "<?php echo ($editurl); ?>?id=" + id;
    }
    function del(id) {
        if (confirm("确定要删除吗？")) {
            window.location.href = "<?php echo ($delurl); ?>?id=" + id;
        }
    }
</script>
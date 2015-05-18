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
    <script type="text/javascript" src="/Public/Js/ckform .js"></script>
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
        <a class="brand">部门列表</a>
        <button style="float:right" type="button" class="btn btn-success" id="addnew">添加部门</button>
    </div>
</div>
<div class="clearfix"></div>
<div style="margin-top:0px;">
    <form action="<?php echo U('Admin/NewsClass/DelallOrSort');?>">
        <table class="table table-bordered table-hover definewidth m10" classid="class_1">
            <thead>
            <tr>
                <th width="7%">分类序号</th>
                <th width="25%" colspan="2">分类名称</th>
                <th width="20%">文章数量</th>
                <th>操作</th>
            </tr>
            </thead>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["f"]["id"]); ?></td>
                    <td colspan="2"><?php echo ($vo["f"]["name"]); ?></td>
                    <td><?php echo ($vo["f"]["fnumber"]); ?></td>

                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-mini btn-primary" onclick="javasript:add()">新增</button>
                            <button type="button" class="btn btn-mini btn-info" id="addnew"
                                    onclick="javasript:edit(<?php echo ($vo["f"]["id"]); ?>)">编辑
                            </button>
                            <button type="button" class="btn btn-mini btn-danger" id="addnew"
                                    onclick="javasript:del(<?php echo ($vo["f"]["id"]); ?>)">删除
                            </button>
                        </div>
                    </td>
                    <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($chd["id"]); ?></td>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;└─<?php echo ($chd["name"]); ?></td>
                            <td><?php echo ($chd["cnumber"]); ?></td>
                            <td>
                                <button type="button" class="btn btn-mini btn-info" onclick="javasript:edit(<?php echo ($chd["id"]); ?>)">
                                    编辑
                                </button>
                                <button type="button" class="btn btn-mini btn-danger"
                                        onclick="javasript:del(<?php echo ($chd["id"]); ?>)">删除
                                </button>

                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </form>


</div>
</body>
</html>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo U('Admin/Depart/add');?>";
        });
    });
    function add() {
        window.location.href = "<?php echo U('Admin/Depart/add');?>";
    }

    function edit(id) {
        window.location.href = "<?php echo ($editurl); ?>?id=" + id;
    }
    function del(id) {
        if (confirm("确定要删除吗？")) {
            window.location.href = "<?php echo ($delurl); ?>?id=" + id;
        }
    }
</script>

<script>
    $(function () {

        $("#navcid_select").change(function () {
            $("#mainform").submit();
        });
    });
</script>
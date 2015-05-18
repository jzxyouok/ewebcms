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
        <a class="brand">分类列表</a>
        <button style="float:right" type="button" class="btn btn-success" id="addnew">添加分类</button>
    </div>
</div>
<div class="pull-left" style="margin-left:25px; height:30px;">
    <form id="mainform" action="<?php echo U('NewsClass/index');?>" method="post">
        <select id="navcid_select" name="navid" style="height:30px;margin-top:5px;">
            <?php if(is_array($navcats)): foreach($navcats as $key=>$vo): $navcid_selected=$navid==$vo['id']?"selected":""; ?>
                <option value="<?php echo ($vo["id"]); ?>" <?php echo ($navcid_selected); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
        </select>
    </form>
</div>
<div class="clearfix"></div>
<div style="margin-top:0px;">
    <form action="<?php echo U('Admin/NewsClass/DelallOrSort');?>">
        <table class="table table-bordered table-hover definewidth m10" classid="class_1">
            <thead>
            <tr>
                <th width="8%">选择</th>
                <th width="7%">排序</th>
                <th width="7%">分类序号</th>
                <th width="25%" colspan="2">分类名称</th>
                <th width="10%">栏目类型</th>
                <th width="20%">文章数量</th>
                <th width="20%">状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <center><input name="ids[]" type="checkbox" value="<?php echo ($vo["f"]["id"]); ?>" class="np"></center>
                    </td>
                    <td>
                        <center><input type="text" value="<?php echo ($vo["f"]["listorder"]); ?>" name="listorder[<?php echo ($vo["f"]["id"]); ?>]"
                                       style="width:30px"/></center>
                    </td>
                    <td><?php echo ($vo["f"]["id"]); ?></td>
                    <td colspan="2"><?php echo ($vo["f"]["name"]); ?></td>
                    <?php if($vo['f']['typeid']==2): ?><td style="color:red;"><?php echo ($vo["f"]["type"]); ?></td>
                        <?php elseif($vo['f']['typeid']==3): ?>
                        <td style="color:blue;"><?php echo ($vo["f"]["type"]); ?></td>
                        <?php else: ?>
                        <td><?php echo ($vo["f"]["type"]); ?></td><?php endif; ?>
                    <td></td>
                    <?php if($vo['f']['display'] == 1): ?><td>
                            <button type="button" class="btn btn-mini btn-success"
                                    onclick="javasript:show(<?php echo ($vo["f"]["id"]); ?>,false)">可见
                            </button>
                        </td>
                        <?php else: ?>
                        <td>
                            <button type="button" class="btn btn-mini btn-inverse"
                                    onclick="javasript:show(<?php echo ($vo["f"]["id"]); ?>,true)">不可见
                            </button>
                        </td><?php endif; ?>

                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-mini btn-primary" onclick="javasript:add()">新增</button>
                            <button type="button" class="btn btn-mini btn-info" id="addnew"
                                    onclick="javasript:edit(<?php echo ($vo["f"]["id"]); ?>,<?php echo ($vo["f"]["typeid"]); ?>)">编辑
                            </button>
                            <button type="button" class="btn btn-mini btn-danger" id="addnew"
                                    onclick="javasript:del(<?php echo ($vo["f"]["id"]); ?>)">删除
                            </button>
                        </div>
                    </td>
                    <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i;?><tr>
                            <td>
                                <center><input name="ids[]" type="checkbox" id="mid" value="<?php echo ($chd["id"]); ?>" class="np">
                                </center>
                            </td>
                            <td>
                                <center><input type="text" value="<?php echo ($chd["listorder"]); ?>" name="listorder[<?php echo ($chd["id"]); ?>]"
                                               style="width:30px"/></center>
                            </td>
                            <td><?php echo ($chd["id"]); ?></td>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;└─<?php echo ($chd["name"]); ?></td>
                            <?php if($chd['typeid']==2): ?><td style="color:red;"><?php echo ($chd["type"]); ?></td>
                                <?php elseif($chd['typeid']==3): ?>
                                <td style="color:blue;"><?php echo ($chd["type"]); ?></td>
                                <?php else: ?>
                                <td><?php echo ($chd["type"]); ?></td><?php endif; ?>
                            <td><?php echo ($chd["0"]); ?></td>
                            <?php if($chd['display'] == 1): ?><td>
                                    <button type="button" class="btn btn-mini btn-success"
                                            onclick="javasript:show(<?php echo ($chd["id"]); ?>,false)">可见
                                    </button>
                                </td>
                                <?php else: ?>
                                <td>
                                    <button type="button" class="btn btn-mini btn-inverse"
                                            onclick="javasript:show(<?php echo ($chd["id"]); ?>,true)">不可见
                                    </button>
                                </td><?php endif; ?>
                            <td>
                                <button type="button" class="btn btn-mini btn-info"
                                        onclick="javasript:edit(<?php echo ($chd["id"]); ?>,<?php echo ($chd["typeid"]); ?>)">编辑
                                </button>
                                <button type="button" class="btn btn-mini btn-danger"
                                        onclick="javasript:del(<?php echo ($chd["id"]); ?>)">删除
                                </button>

                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <td colspan="9">
                    <button type="button" class="btn btn-mini btn-primary" onclick="javasript:selectall(true)">全选
                    </button>
                    <button type="button" class="btn btn-mini " onclick="javasript:selectall(false)">取消</button>
                    <input type="submit" class="btn btn-mini btn-success" name="sort" value="排序"/>
                    <input type="submit" class="btn btn-mini btn-danger" name="delall" value="删除(请谨慎使用全选删除功能!">
                </td>
            </tr>
        </table>
    </form>


</div>
</body>
</html>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo U('Admin/NewsClass/add');?>";
        });
    });
    function add() {
        window.location.href = "<?php echo U('Admin/NewsClass/add');?>";
    }

    function edit(id, typeid) {
        window.location.href = "<?php echo ($editurl); ?>?id=" + id + "&typeid=" + typeid;
    }
    function del(id) {
        if (confirm("确定要删除吗？")) {
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

<script>
    $(function () {

        $("#navcid_select").change(function () {
            $("#mainform").submit();
        });
    });
</script>
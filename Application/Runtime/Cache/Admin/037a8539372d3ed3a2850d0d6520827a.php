<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>文档查看</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/style.css"/>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/common.js"></script>

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
        <a class="brand">新闻列表</a>
        <button style="float:right" type="button" class="btn btn-success" id="addnew">添加<?php echo ($nname); ?></button>
    </div>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<form action="<?php echo U('Admin/Doc/DelallOrSort');?>">
    <table class="table table-bordered table-hover definewidth">
        <thead>
        <tr>
            <th width="4%">选择</th>
            <th width="3%">排序</th>
            <th width="4%">序号</th>
            <th width="42%">文章标题</th>
            <th width="10%">更新时间</th>
            <th width="7%">类目</th>
            <th width="6%">点击</th>
            <th width="7%">发布人</th>
            <th width="8%">操作</th>
        </tr>
        </thead>
        <?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><input name="ids[]" type="checkbox" id="mid" value="<?php echo ($vo["id"]); ?>" class="np"></td>
                <td width="6%"><input type="text" name="listorder[<?php echo ($vo["id"]); ?>]" id="listorder" value="<?php echo ($vo["listorder"]); ?>"
                                      style="width: 30px;"/></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td><a href="<?php echo U('Home/News/show',array('id' => $vo['id']));?>" target="main"><u><?php echo ($vo["title"]); ?></u></a></td>
                <td><?php echo (date("y-m-d H:i:s",$vo["date"])); ?></td>
                <td><?php echo ($type["name"]); ?></td>
                <td>
                    <a href="#"><?php echo ($vo["clickrate"]); ?></a>
                </td>
                <td align="center"><?php echo ($vo["author"]); ?></td>
                <td align="center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-mini btn-info" id="addnew"
                                onclick="javasript:edit(<?php echo ($vo["id"]); ?>)">编辑
                        </button>
                        <button type="button" class="btn btn-mini btn-danger" id="addnew"
                                onclick="javasript:del(<?php echo ($vo["id"]); ?>)">删除
                        </button>
                    </div>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
            <td colspan="9">
                <button type="button" class="btn btn-mini btn-primary" id="addnew" onclick="javasript:selectall(true)">
                    全选
                </button>
                <button type="button" class="btn btn-mini " id="addnew" onclick="javasript:selectall(false)">取消</button>
                <input type="submit" class="btn btn-mini btn-success" name="sort" value="排序"/>
                <input type="submit" class="btn btn-mini btn-danger" name="delall" value="删除(请谨慎使用全选删除功能!">
            </td>
        </tr>

    </table>
</form>
<div class="pagination pagination-centered">
    <ul>
        <?php echo ($page); ?>
    </ul>
</div>
</body>
</html>

<script>
    $(function () {

        $('#addnew').click(function () {

            window.location.href = "<?php echo ($addurl); ?>?nid=<?php echo ($nid); ?>";
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
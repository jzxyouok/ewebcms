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
        <a class="brand">所有留言列表</a>
    </div>
</div>
<form action="<?php echo U('Admin/Wechat/delall');?>" method="post">
    <table class="table table-bordered table-hover definewidth m10">
        <thead>
        <tr>
            <th width="4%">选择</th>
            <th width="4%">序号</th>
            <th width="10%">标题</th>
            <th width="6%">姓名</th>
            <th width="8%">电话</th>
            <th width="10%">时间</th>
            <th width="25%">内容</th>
            <th width="10%">回复内容</th>
            <th width="10%">状态</th>
            <th width="12%">操作</th>
        </tr>
        </thead>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>"></td>
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo (msubstr($vo["title"],0,6,'utf8',true)); ?></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td><?php echo ($vo["phone"]); ?></td>
                <td><?php echo (date("Y-m-d H:i",$vo["date"])); ?></td>
                <td><?php echo (msubstr($vo["content"],0,20,'utf8',true)); ?></td>
                <td><?php echo (msubstr($vo["reply"],0,6,'utf8',true)); ?></td>
                <td>
                    <?php if($vo["status"] == 0): ?><span class="label label-important">未回复</span>
                        <?php else: ?>
                        <span class="label label-success">已回复</span><?php endif; ?>
                </td>
                </td>
                <td>
                    <button type="button" class="btn btn-mini btn-info"
                            onclick="javasript:reply(<?php echo ($vo["id"]); ?>)">
                        <?php if($vo["status"] == 0): ?>回复
                            <?php else: ?>
                            查看<?php endif; ?>
                    </button>
                    <button type="button" class="btn btn-mini btn-danger" onclick="javasript:del(<?php echo ($vo["id"]); ?>)">
                        删除
                    </button>

                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <p>&nbsp;</p>

    <div class="row">
        <div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-small btn-primary" onclick="javasript:selectall(true)">全选</button>
            <button type="button" class="btn btn-small " onclick="javasript:selectall(false)">取消</button>
            <input type="submit" class="btn btn-small btn-danger" name="delall" value="删除(请谨慎使用全选删除功能!">
        </div>

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
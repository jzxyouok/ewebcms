<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
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


    </style>
</head>
<body>
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">权限添加</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Rbac/updateNode');?>" method="post" class="definewidth m20">
    <input type="hidden" name="id" value="<?php echo ($node["id"]); ?>"/>
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">英文名称</td>
            <td><input type="text" name="name" value="<?php echo ($node["name"]); ?>"/></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">中文名称</td>
            <td><input type="text" name="title" value="<?php echo ($node["title"]); ?>"/></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">权限描述</td>
            <td><input type="text" name="remark" value="<?php echo ($node["remark"]); ?>"/></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">状态</td>
            <td><input type="radio" class="form-control" name="status" value="1" checked/>&nbsp;&nbsp;开启 &nbsp;&nbsp;
                <input type="radio" class="form-control" name="status" value="0"/>&nbsp;&nbsp;关闭</td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">类型</td>
            <td>
                <select name="level">
                    <?php $level1 = $node['level']==1?"selected":""; $level2 = $node['level']==2?"selected":""; $level3 = $node['level']==3?"selected":""; ?>
                    <option value="1" <?php echo ($level1); ?>>项目</option>
                    <option value="2" <?php echo ($level2); ?>>模块</option>
                    <option value="3" <?php echo ($level3); ?>>操作</option>
                </select>
            </td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">根节点</td>
            <td>
                <select name="pid">
                    <option value="0">根节点</option>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $selected = $node['pid']==$vo['id']?"selected":""; ?>
                        <option value="<?php echo ($vo["id"]); ?>" <?php echo ($selected); ?>>
                            <?php if($vo["level"] == 1): echo ($vo["title"]); ?>
                            <?php else: ?> &nbsp; &nbsp;┗<?php echo ($vo["title"]); endif; ?>
                        </option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">排序</td>
            <td><input type="text" name="sort" value="<?php echo ($node["sort"]); ?>"/></td>
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
            window.location.href = "nodeList.html";
        });

    });
</script>
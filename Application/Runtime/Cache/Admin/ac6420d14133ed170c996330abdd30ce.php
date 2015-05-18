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
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">编辑外部链接</a>
        </div>
    </div>
</div>
<div class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <form id="mainform" action="<?php echo U('Admin/NewsClass/edit');?>?typeid=2" method="post">
            <input type="hidden" name="id" value="<?php echo ($newsclass["id"]); ?>">
            <tr>
                <td class="tableleft">所属导航：</td>
                <td align="left">

                    <select id="navcid_select" name="navid" style="">
                        <?php if(is_array($navcats)): foreach($navcats as $key=>$vo): $navcid_selected=$navid==$vo['id']?"selected":""; ?>
                            <option value="<?php echo ($vo["id"]); ?>" <?php echo ($navcid_selected); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </td>
            </tr>
        </form>
        <form action="<?php echo U('Admin/NewsClass/update');?>?type=2" method="post">
            <input type="hidden" value="<?php echo ($navid); ?>" name="navid" id="navid1"/>
            <tr>
                <td width="10%" class="tableleft">分类名称</td>
                <input type="hidden" name="id" value="<?php echo ($newsclass["id"]); ?>">
                <td><input type="text" name="name" value="<?php echo ($newsclass["name"]); ?>"/>&nbsp;&nbsp;<span
                        class="label label-important">必填</span></td>
            </tr>
            <tr>
                <td class="tableleft">所属分类：</td>
                <td align="left"><select name="fid" style="width:200px">
                    <option value="0">顶级栏目</option>
                    <?php if(is_array($classlist)): $i = 0; $__LIST__ = $classlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($newsclass["fid"]) == $vo["id"]): ?><option selected="selected" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option>
                            <?php else: ?>
                            <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </select>&nbsp;&nbsp;<span class="label label-important">必填</span>
                </td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">链接地址</td>
                <td><input type="text" name="href" style="width:400px;" value="<?php echo ($newsclass["href"]); ?>"/>&nbsp;&nbsp;<span
                        class="label label-important">必填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">备注</td>
                <td><input type="text" value="<?php echo ($newsclass["remark"]); ?>" name="remark"/>&nbsp;&nbsp;<span
                        class="label label-success">选填</span></td>
            </tr>

            <tr>
                <td class="tableleft"></td>
                <td>
                    <button type="submit" class="btn btn-primary" type="button">保存</button>
                    &nbsp;&nbsp;
                    <button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
                </td>
            </tr>
        </form>
    </table>
</div>
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

        $("form").submit(function () {

            if ($("input[name='name']").val().length == 0) {
                alert("请输入分类名称！");
                $("input[name='name']").focus();
                return false;
            }

            if ($("input[name='href']").val().length == 0) {
                alert("请输入链接地址！");
                $("input[name='href']").focus();
                return false;
            }
        });
    });
</script>


<script>
    $(function () {

        $("#navcid_select").change(function () {
            $("#navid1").value = $("#navcid_select").value;
            $("#mainform").submit();
        });
    });
</script>
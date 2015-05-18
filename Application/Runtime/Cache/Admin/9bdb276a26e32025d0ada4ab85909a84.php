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
            <a class="brand">新类别添加</a>
        </div>
    </div>
</div>
<div class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">

        <form id="mainform" action="<?php echo U('Admin/NewsClass/add');?>" method="post">
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
        <form id="form1" action="<?php echo U('Admin/NewsClass/addsubmit',array('type' => 1));?>" method="post">
            <input type="hidden" value="<?php echo ($navid); ?>" name="navid" id="navid1"/>

            <tr>
                <td class="tableleft">上级菜单：</td>
                <td align="left"><select name="fid" style="width:200px">
                    <option id="option1" value="0">顶级栏目</option>
                    <?php if(is_array($classlist)): $i = 0; $__LIST__ = $classlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option id="option1" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>&nbsp;&nbsp;<span class="label label-important">必填</span>
                </td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">分类名称</td>
                <td><input type="text" name="name"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
            </tr>

            <tr>
                <td width="10%" class="tableleft">备注</td>
                <td><input type="text" name="remark"/>&nbsp;&nbsp;<span class="label label-success">选填</span></td>
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

        $("#navcid_select").change(function () {
            $("#navid1").value = $("#navcid_select").value;
            $("#mainform").submit();

        });
    });
</script>
<script>
    $(function () {
        $(':checkbox[name="group[]"]').click(function () {
            $(':checkbox', $(this).closest('li')).prop('checked', this.checked);
        });

        $('#backid').click(function () {
            window.location.href = "index.html";
        });


        $("#form1").submit(function () {

            if ($("input[name='name']").val().length == 0) {
                alert("请输入分类名称！");
                $("input[name='name']").focus();
                return false;
            }
        });
    });
</script>
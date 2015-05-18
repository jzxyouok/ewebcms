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

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }

        textarea{
            width:800px;
        }

    </style>
</head>
<body>
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">网站页脚修改</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Setting/footersubmit');?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <input type="hidden" value="footer" name="name"/>
        <input type="hidden" value="页脚设置" name="title"/>
        <tr>
            <td width="10%" class="tableleft">示例</td>
            <td>

                    <center><code>
                        &lt;center&gt;
                        &lt;p sytle="color:red;"&gt;版权所有：哈尔滨工业大学(威海)&lt;/p&gt;
                        <br/>
                        &lt;p style="color:blue;"&gt;山东省威海市文化西路2号 电话：0631-5685917 邮箱30xq@hitwh.edu.cn&lt;/p&gt;
                        &lt;/center&gt;</code>
                    </center>


            </td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">输出演示</td>
            <td>
                <center>
                    <p style="color:red;">版权所有：哈尔滨工业大学(威海)</p>
                    <p style="color:blue;">山东省威海市文化西路2号 电话：0631-5685917 邮箱30xq@hitwh.edu.cn</p>
                </center>
            </td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">页脚代码</td>
            <td><textarea name="content" id="content" cols="80" rows="7"><center>
<p style="color:red;">版权所有：哈尔滨工业大学(威海)</p>
<p style="color:blue;">山东省威海市文化西路2号 电话：0631-5685917 邮箱30xq@hitwh.edu.cn</p>
</center></textarea>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
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
        $('#backid').click(function () {
            window.location.href = "infoset.html";
        });
    });

    $("form").submit(function () {

        if ($("input[name='title']").val().length == 0) {
            alert("请输入名称！");
            $("input[name='title']").focus();
            return false;
        }
        if ($("input[name='name']").val().length == 0) {
            alert("请输入英文名称！");
            $("input[name='author']").focus();
            return false;
        }
        if ($("input[name='excerpt']").val().length == 0) {
            alert("请输入简介！");
            $("input[name='excerpt']").focus();
            return false;
        }
        if ($("input[name='content']").val().length == 0) {
            alert("请输入内容！");
            $("input[name='content']").focus();
            return false;
        }
    });
</script>
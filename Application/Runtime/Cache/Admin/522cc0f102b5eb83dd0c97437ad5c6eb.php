<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link href="http://g.alicdn.com/bui/bui/1.1.16/css/bs3/dpl.css" rel="stylesheet">
    <link href="http://g.alicdn.com/bui/bui/1.1.16/css/bs3/bui.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/style.css"/>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/common.js"></script>
    <link rel="stylesheet" href="/ewebcmsxgc/Public//kindeditor/themes/default/default.css"/>
    <link rel="stylesheet" href="/ewebcmsxgc/Public//kindeditor/plugins/code/prettify.css"/>
    <script charset="utf-8" src="/ewebcmsxgc/Public//kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/ewebcmsxgc/Public//kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/ewebcmsxgc/Public//kindeditor/plugins/code/prettify.js"></script>
    <!--显示calendar-->
    <script src="http://a.tbcdn.cn/s/bui/seed-min.js?t=201212261326"></script>

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

        textarea {
            width: 90%;
        }


    </style>
    <script type="text/javascript">

        KindEditor.ready(function (K) {
            var editor = K.editor({
                allowFileManager: true
            });
            K('#image3').click(function () {
                editor.loadPlugin('image', function () {
                    editor.plugin.imageDialog({
                        showRemote: false,
                        imageUrl: K('#url3').val(),
                        clickFn: function (url, title, width, height, border, align) {
                            K('#url3').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });


            K.create('textarea[name="myconten"]', {
                cssPath: '/ewebcmsxgc/Public//kindeditor/plugins/code/prettify.css',
                themeType: 'simple',
                resizeType: 1,
                uploadJson: '/ewebcmsxgc/Public//kindeditor/php/upload_json.php',
                fileManagerJson: '/ewebcmsxgc/Public//kindeditor/php/file_manager_json.php',
                allowFileManager: true,
                //afterCreate: function(){this.sync();}
                //下面这行代码就是关键的所在，当失去焦点时执行 this.sync();
                afterBlur: function () {
                    this.sync();
                }
            });
        });
    </script>
</head>
<body>
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">单网页添加</a>
        </div>
    </div>
</div>
<div class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <form id="mainform" action="<?php echo U('Admin/NewsClass/edit');?>?typeid=3" method="post">
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
        <form id="form1" action="<?php echo U('Admin/NewsClass/update');?>?type=3" method="post">
            <input type="hidden" value="<?php echo ($navid); ?>" name="navid" id="navid1"/>
            <tr>
                <td width="10%" class="tableleft">标题</td>
                <input type="hidden" name="id" value="<?php echo ($listcon["id"]); ?>">
                <td><input type="text" name="title" value="<?php echo ($listcon["title"]); ?>"/>&nbsp;&nbsp;<span
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
                <td width="10%" class="tableleft">发布时间</td>
                <td><input type="text" name="updatetime" class="calendar span2"
                           value="<?php $time=time(); echo date('Y-m-d',$time); ?>"/>&nbsp;&nbsp;<span
                        class="label label-important">必填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">备注</td>
                <td><input type="text" name="remark" value="<?php echo ($listcon["remark"]); ?>"/>&nbsp;&nbsp;<span
                        class="label label-success">选填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">关键字</td>
                <td><input type="text" name="keyword" value="<?php echo ($listcon["keyword"]); ?>"/>&nbsp;&nbsp;<span
                        class="label label-success">选填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">摘要</td>
                <td><textarea name="excerpt" id="excerpt" width="300px" rows="3"><?php echo ($listcon["excerpt"]); ?></textarea>&nbsp;&nbsp;<span
                        class="label label-success">选填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">内容：</td>
                <td align="left">
            <textarea name="myconten" style="width:100%;height:500px;visibility:hidden;">
                    <?php echo ($listcon["content"]); ?>
            </textarea>
                </td>
            </tr>
            <tr>
                <td class="tableleft"></td>
                <td>
                    <button type="submit" class="btn btn-primary" type="button">保存</button>
                </td>
            </tr>
        </form>
    </table>
</div>
</body>
</html>
<script type="text/javascript">
    BUI.use('bui/calendar', function (Calendar) {
        var datepicker = new Calendar.DatePicker({
            trigger: '.calendar',
            autoRender: true
        });
    });
</script>
<script type="javascript">
    $(function () {
        $("form").submit(function () {

            if ($("input[name='title']").val().length == 0) {
                alert("请输入文章标题！");
                $("input[name='title']").focus();
                return false;
            }
            if ($("input[name='author']").val().length == 0) {
                alert("请输入作者！");
                $("input[name='author']").focus();
                return false;
            }
            var verifycode = $("input[name='verifycode']").val();
            var vs = false;
            $.ajax({
                data: {verify: verifycode},
                type: "post",
                url: "<?php echo U('Admin/Doc/verify_check');?>",
                async: false,
                success: function (result) {
                    if (result == "false") {

                        alert("验证码错误！");
                    } else {
                        vs = true;
                    }
                }
            });

            if (!vs) return false;
        });

        $("#pic_c").click(function () {
            if ($(this).attr("checked") == "checked") {
                $(".pic_input").css("display", "table-row");
            }
            if (!($(this).attr("checked") == "checked")) {
                $(".pic_input").css("display", "none");
            }

        });

        $('#backid').click(function () {
            window.location.href = "index.html";
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
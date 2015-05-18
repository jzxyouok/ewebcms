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
            <a class="brand">新闻修改</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Doc/update');?>" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">新闻标题</td>
        <td><input type="hidden" value="<?php echo ($news["id"]); ?>" name="id"/>
            <input value="<?php echo ($news["title"]); ?>" type="text" name="title"/>&nbsp;&nbsp;<span
                    class="label label-important">必填</span></td>
    </tr>
    <tr>
        <td class="tableleft">选项</td>
        <td>
            <input type="checkbox" name="listtop" <?php echo ($listtop); ?>/> 首页置顶 &nbsp;&nbsp;
            <input type="checkbox" name="highlight" <?php echo ($highlight); ?>/> 高亮 &nbsp;&nbsp;
            <input type="checkbox" name="ispic" id="pic_c" <?php echo ($photo); ?>/> 首页图片&nbsp;&nbsp;
            <input type="checkbox" name="iswechat" <?php echo ($iswechat); ?>/> 微信推送
        </td>
    </tr>

    <?php if($photo == 'checked' ): ?><tr class="pic_input">
            <?php else: ?>
        <tr class="pic_input" style="display:none;"><?php endif; ?>
    <td width="10%" class="tableleft">首页图片</td>
    <td>
        <input name="photo" type="text" id="url3" value="<?php echo ($news["photo"]); ?>"/>
        <input style="margin-top:-10px;" type="button" id="image3" value="选择图片" class="btn btn-mini"/>
    </td>
    </tr>

    <tr>
        <td width="10%" class="tableleft">作者</td>
        <td><input value="<?php echo ($news["author"]); ?>" type="text" name="author"/>&nbsp;&nbsp;<span
                class="label label-important">必填</span></td>
    </tr>

    <tr>
        <td width="10%" class="tableleft">来源</td>
        <td><input value="<?php echo ($news["copyfrom"]); ?>" type="text" name="copyfrom"/>&nbsp;&nbsp;<span class="label label-success">选填</span>
        </td>
    </tr>

    <tr>
        <td class="tableleft">所属分类：</td>
        <td align="left">
            <select name="nid" style="width:200px">

                <?php if(is_array($classlist)): $i = 0; $__LIST__ = $classlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="" disabled>
                        -------------<?php echo ($vo1["nav"]["name"]); ?>-------------
                    </option>
                    <?php if(is_array($vo1["navlist"])): $i = 0; $__LIST__ = $vo1["navlist"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $selected=$vo['f']['id']==$news['nid']?"selected":""; ?>
                        <option value="<?php echo ($vo["f"]["id"]); ?>" <?php echo ($selected); ?>><?php echo ($vo["f"]["name"]); ?></option>

                        <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i; $selected1=$chd['id']==$news['nid']?"selected":""; ?>
                            <option value="<?php echo ($chd["id"]); ?>" <?php echo ($selected1); ?>>&nbsp;&nbsp;┊--<?php echo ($chd["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
            &nbsp;&nbsp;<span class="label label-important">必填</span>
        </td>
    </tr>

    <tr>
        <td width="10%" class="tableleft">发布时间</td>
        <td><input type="text" name="updatetime" class="calendar span2" value="<?php echo (date('Y-m-d', $news["updatetime"])); ?>"/>&nbsp;&nbsp;<span
                class="label label-success">选填</span></td>
    </tr>

    <tr>
        <td width="10%" class="tableleft">关键字</td>
        <td><input type="text" value="<?php echo ($news["keyword"]); ?>" name="keyword"/>&nbsp;&nbsp;<span
                class="label label-success">选填</span></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">摘要</td>
        <td><textarea name="excerpt" id="excerpt" width="300px" rows="3"><?php echo ($news['excerpt']); ?></textarea>&nbsp;&nbsp;<span
                class="label label-success">选填</span></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">新闻内容：</td>
        <td align="left">
            <textarea name="myconten" style="width:100%;height:500px;visibility:hidden;">
                    <?php echo ($news['content']); ?>
            </textarea>
        </td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">验证码</td>
        <td><input type="text" name="verifycode"/>&nbsp;&nbsp;<span class="label label-important">必填</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <img id="verifycode" alt="点击换一张" src="<?php echo U('Admin/Index/verify_c');?>"></td>
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
<script type="text/javascript">
    BUI.use('bui/calendar', function (Calendar) {
        var datepicker = new Calendar.DatePicker({
            trigger: '.calendar',
            autoRender: true
        });
    });
</script>
<script>
    $(function () {
        $("#verifycode").click(function () {
            var time = new Date().getTime();
            var imgurl = $(this).attr('src');
            $(this).attr('src', imgurl + "?" + time);

        });

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
                url: "<?php echo U('Admin/Index/verify_check');?>",
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
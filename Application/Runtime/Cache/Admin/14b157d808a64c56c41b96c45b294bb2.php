<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link href="http://g.alicdn.com/bui/bui/1.1.16/css/bs3/dpl.css" rel="stylesheet">
    <link href="http://g.alicdn.com/bui/bui/1.1.16/css/bs3/bui.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/Public//Css/style.css"/>
    <script type="text/javascript" src="/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/Public//Js/common.js"></script>
    <link rel="stylesheet" href="/Public//kindeditor/themes/default/default.css"/>
    <link rel="stylesheet" href="/Public//kindeditor/plugins/code/prettify.css"/>
    <script charset="utf-8" src="/Public//kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/Public//kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/Public//kindeditor/plugins/code/prettify.js"></script>
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
                cssPath: '/Public//kindeditor/plugins/code/prettify.css',
                themeType: 'simple',
                resizeType: 1,
                uploadJson: '/Public//kindeditor/php/upload_json.php',
                fileManagerJson: '/Public//kindeditor/php/file_manager_json.php',
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
            <a class="brand">新闻添加</a>
        </div>
    </div>
</div>
<div class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <form action="<?php echo U('Admin/Doc/addsubmit');?>" method="post">
            <tr>
                <td width="10%" class="tableleft">新闻标题</td>
                <td><input type="text" name="title"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
            </tr>
            <tr>
                <td class="tableleft">选项</td>
                <td>
                    <input type="checkbox" name="listtop"/> 首页置顶 &nbsp;&nbsp;
                    <input type="checkbox" name="highlight"/> 高亮 &nbsp;&nbsp;
                    <input type="checkbox" name="ispic" id="pic_c"/> 首页图片&nbsp;&nbsp;
                    <input type="checkbox" name="iswechat"/> 微信推送
                </td>
            </tr>

            <tr class="pic_input" style="display:none;">
                <td width="10%" class="tableleft">首页图片</td>
                <td>
                    <input name="photo" type="text" id="url3" value=""/>
                    <input style="margin-top:-10px;" type="button" id="image3" value="选择图片" class="btn btn-mini"/>
                </td>
            </tr>

            <tr>
                <td width="10%" class="tableleft">作者</td>
                <td><input type="text" name="author"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>

            </tr>

            <tr>
                <td width="10%" class="tableleft">来源</td>
                <td><input value="<?php echo ($news["copyfrom"]); ?>" type="text" name="copyfrom"/>&nbsp;&nbsp;<span
                        class="label label-success">选填</span></td>
            </tr>


            <tr>
                <td class="tableleft">所属分类：</td>
                <td align="left">
                    <select name="nid" style="width:200px">
                        <?php if(is_array($newslist)): $i = 0; $__LIST__ = $newslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="" disabled>
                                <center>-------------<?php echo ($vo1["nav"]["name"]); ?>-------------</center>
                            </option>
                            <?php if(is_array($vo1["navlist"])): $i = 0; $__LIST__ = $vo1["navlist"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $selected=$vo['f']['id']==$nid?"selected":""; ?>
                                <option value="<?php echo ($vo["f"]["id"]); ?>" <?php echo ($selected); ?>><?php echo ($vo["f"]["name"]); ?></option>

                                <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i; $selected1=$chd['id']==$nid?"selected":""; ?>
                                    <option value="<?php echo ($chd["id"]); ?>" <?php echo ($selected1); ?>>&nbsp;&nbsp;┊--<?php echo ($chd["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    &nbsp;&nbsp;<span class="label label-important">必填</span>
                </td>
            </tr>

            <tr>
                <td width="10%" class="tableleft">发布时间</td>
                <td><input type="text" name="updatetime" class="calendar span2"
                           value="<?php $time=time(); echo date('Y-m-d',$time); ?>"/>&nbsp;&nbsp;<span
                        class="label label-important">必填</span></td>
            </tr>

            <tr>
                <td width="10%" class="tableleft">关键字</td>
                <td><input type="text" name="keyword"/>&nbsp;&nbsp;<span class="label label-success">选填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">摘要</td>
                <td><textarea name="excerpt" id="excerpt" width="300px" rows="3"></textarea>&nbsp;&nbsp;<span
                        class="label label-success">选填</span></td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">新闻内容：</td>
                <td align="left">
            <textarea name="myconten" style="width:100%;height:500px;visibility:hidden;">
                    <?php echo htmlspecialchars(""); ?>
            </textarea>
                </td>
            </tr>
            <tr>
                <td width="10%" class="tableleft">所属部门</td>
                <td>
                    <select name="dptid">
                        <?php if(is_array($dptlist)): $i = 0; $__LIST__ = $dptlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["f"]["id"]); ?>"><?php echo ($vo["f"]["name"]); ?></option>
                            <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i;?><option value="<?php echo ($chd["id"]); ?>">&nbsp;&nbsp;┊--<?php echo ($chd["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    </select>&nbsp;&nbsp;<span class="label label-important">必填</span>
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
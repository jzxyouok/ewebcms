<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public//Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public//Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public//Css/style.css" />
    <script type="text/javascript" src="/ewebcms/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/common.js"></script>
    <link rel="stylesheet" href="/ewebcms/Public//kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="/ewebcms/Public//kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="/ewebcms/Public//kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/ewebcms/Public//kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/ewebcms/Public//kindeditor/plugins/code/prettify.js"></script>

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
    <script type="text/javascript">

KindEditor.ready(function(K){
	var editor = K.editor({
					allowFileManager : true
				});
    K('#image3').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#url3').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#url3').val(url);
								editor.hideDialog();
							}
						});
					});
				});


    K.create('textarea[name="myconten"]', {
        cssPath : '/ewebcms/Public//kindeditor/plugins/code/prettify.css',
        themeType: 'simple',
        resizeType: 1,
        uploadJson: '/ewebcms/Public//kindeditor/php/upload_json.php',
        fileManagerJson: '/ewebcms/Public//kindeditor/php/file_manager_json.php',
        allowFileManager: true,
        //afterCreate: function(){this.sync();}
        //下面这行代码就是关键的所在，当失去焦点时执行 this.sync();
        afterBlur: function(){this.sync();}
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
<form action="<?php echo U("Admin/Doc/add") ?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td width="10%" class="tableleft">新闻标题</td>
            <td><input type="text" name="title"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>
        <tr>
            <td class="tableleft">选项</td>
            <td>
                <input type="checkbox" name="listtop" /> 置顶 &nbsp;&nbsp;
                <input type="checkbox" name="highlight" /> 高亮 &nbsp;&nbsp;
                <input type="checkbox" name="ispic"/> 首页图片
            </td>
        </tr>
       
        <tr>
            <td width="10%" class="tableleft">首页图片</td>
            <td> 
            	 <input name="photo" type="text" id="url3" value="" /> 
            	 <input style="margin-top:-10px;" type="button" id="image3" value="选择图片" class="btn btn-mini" />
            </td>
        </tr>

        <tr>
            <td width="10%" class="tableleft">作者</td>
            <td><input type="text" name="author"/>&nbsp;&nbsp;<span class="label label-important">必填</span></td>
        </tr>

        <tr>
            <td class="tableleft">所属分类：</td>
            <td align="left"><select name="nid" style="width:200px">
                        <option id="option1" value="1">新闻快讯</option>
                          <option id="option2" value="2">通知公告</option>
                          <option id="option3" value="3">行业动态</option>
                          <option id="option4" value="4">驾校新闻</option>
                          <option id="option5" value="5">学车指南</option>
                          <option id="option6" value="6">考试技巧</option>
                          <option id="option7" value="7">交通标志</option>
                          <option id="option8" value="8">驾校图片</option>
                          <option id="option9" value="9">图片新闻</option>
                          <option id="option10" value="10">交通标志</option>
                          <option id="option11" value="11">政策法规</option>
                          <option id="option12" value="12">文明驾车</option>
                          <option id="option18" value="18">机构介绍</option>
                          <option id="option19" value="19">快讯头条</option>
                          <option id="option20" value="20">表格下载</option>
                    </select>&nbsp;&nbsp;<span class="label label-important">必填</span>
            </td>
          </tr>

          <tr>
            <td width="10%" class="tableleft">关键字</td>
            <td><input type="text" name="keyword"/>&nbsp;&nbsp;<span class="label label-success">选填</span></td>
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
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

<script>
    $(function () {
        
		$('#backid').click(function(){
				window.location.href="index.html";
		 });
    });
</script>
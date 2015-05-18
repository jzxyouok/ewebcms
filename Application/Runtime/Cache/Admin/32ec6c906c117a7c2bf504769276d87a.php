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
    <style type="text/css">
        body {
            padding-bottom: 40px;
            background-color: #2F7FB2;
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
        .login
        {
            width: 457px;
            height: 407px;
            background: #fff;
            margin: 0 auto;
            border: 1px solid #d1dee2;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -moz-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            -webkit-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            box-shadow: rgba(24, 108, 162, 0.6) 4px;
            padding: 0;
            margin-top: 100px;

        }
        form{
             width: 417px;
             height: 327px;
             font-size: 14px;
             color: #666;
             padding: 0;
        }
        .input_h{
            width:280px;
        }
        .strong{
            font-size: 17px;
            color: #666;
        }

    </style>
    <script>
    $(document).ready(function(){
     $("#verifycode").click(function(){
          var time = new Date().getTime();
          var imgurl=$(this).attr('src');
          $(this).attr('src',imgurl+"?"+time);         
        });
     });
    </script>
</head>
<body>
<div class="login">
<form method="post" action="<?php echo U('Admin/Login/logincheck');?>" class="form-actions">
<span class="strong">用户名：</span></br>
<input name="username" class="input-block-level"  type="text" placeholder="请输入用户名"/></br>
<span class="strong">密码：</span></br>
<input name="password" class=" input-block-level" type="password" placeholder="请输入密码"/></br>
<span class="strong">验证码：</span></br>
<input name="verifycode" class="input-block-level input_h"  type="text" placeholder="请输入验证码"/>
<img id="verifycode" alt="点击换一张" src="<?php echo U('Admin/Doc/verify_c');?>">
</br>
<button type="submit" class="btn-large btn-block btn btn-primary m10">登录</button>
<button type="button" class="btn btn-large btn-block m10" id="addnew" onclick="javasript:selectall(false)">取消</button>
</form>
</div>
</body>
</html>
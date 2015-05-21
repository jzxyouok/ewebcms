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
            height: 500px;
            text-align: center;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }

        form {
            margin: 50px auto;
            width: 500px;
            padding: 20px 30px;
            font-size: 14px;
            border: 1px solid #ebebeb;
            text-align: center;
            background-color: #f5f5f5;
            padding-bottom: 20px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            -moz-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            -webkit-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            box-shadow: rgba(24, 108, 162, 0.6) 4px;
        }

        .input_h {
            width: 250px;
        }

        .alert {
            background: #edebe1;
            border-color: #e0d9cb;
            color: #a77b58;
        }

    </style>
    <script>
        $(document).ready(function () {
            $("#verifycode").click(function () {
                var time = new Date().getTime();
                var imgurl = $(this).attr('src');
                $(this).attr('src', imgurl + "?" + time);
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">

        <h2 style="margin-top:100px;">Welcome to EwebCMS</h2>

        <form method="post" class="" action="<?php echo U('Admin/Index/logincheck');?>" class="form-actions">
            <div class="alert alert-warning" id="notice">
                请输入用户名和密码
            </div>

            <div class="input-prepend" title="Username" data-rel="tooltip">
                <span class="add-on"><i class="icon-user"></i></span>
                <input autofocus class="input-block-level  input_h" name="username" id="username" type="text"
                       placeholder="Username"/>
            </div>
            <div class="clearfix"></div>
            <div class="input-prepend" title="Password" data-rel="tooltip">
                <span class="add-on"><i class="icon-lock"></i></span>
                <input class="input-block-level  input_h" name="password" id="password" type="password"
                       placeholder="Password"/>
            </div>
            <div class="clearfix"></div>

            <div class="input-prepend" title="Password" data-rel="tooltip">
                <span class="add-on"><i class="icon-picture"></i></span>
                <input class="input-block-level input_h" name="verifycode" type="text" placeholder="Verification Code"/>
            </div>
            <div class="clearfix"></div>

            <img id="verifycode" alt="点击换一张" src="<?php echo U('Admin/Index/verify_c');?>">
            </br>
            <input type="button" class="btn span6" style="margin-top:10px;" id="tologin" value="登    录">

        </form>
    </div>
    <!--/fluid-row-->

</div>
<!--/.fluid-container-->


<script language='javascript'>
    $('#tologin').click(function () {
        var $action = $('form').attr('action');//获取form表单的action属性
        var $form_data = $('form').serialize(); //关键函数
        $.post($action, $form_data, function (data) {
            if (data.info == 'SUCC') {
                window.location.href = "<?php echo ($mainurl); ?>";
            } else {
                $('#notice').html(data.info);//返回数组的info
            }
        });
    });
</script>


</body>
</html>
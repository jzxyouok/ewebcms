<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <style>
        body{
            font-size:18px;
            padding-right:3%;
            padding-top:5%;
        }
        label{
            text-align: right;
            line-height: 2.5;
        }
    </style>
    <title>哈工大威海学生工作处-我要留言</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <form class="form-horizontal" method="post" action="<?php echo U('Home/Page/msgsubmit');?>">
            <div class="form-group">
                <label for="name" class="col-xs-3 control-label">姓名:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control  block  input-lg" id="name" name="name" placeholder="请输入您的姓名...">
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-xs-3 control-label">手机:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control  block input-lg" id="phone" name="phone" placeholder="请输入您的号码...">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="control-label col-xs-3">标题:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control block input-lg" id="title" name="title" placeholder="请输入标题...">
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-xs-3 control-label">留言:</label>
                <div class="col-xs-9">
                    <textarea class="form-control  block " rows="8" id="content" name="content" placeholder="请输入留言内容..."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-xs-3 control-label">验证码:</label>
                <div class="col-xs-9">
                    <input type="text" class="form-control  block input-lg" name="verifycode" placeholder="请输入您的验证码...">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-9 col-xs-offset-3">
                    <img id="verifycode" alt="点击换一张" src="<?php echo U('Home/Index/verify_c');?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-offset-4">
                    <button type="submit" class="btn btn-lg btn-info">提 交</button>
                    <button type="reset" class="btn btn-lg btn-default">取 消</button>
                </div>
            </div>
        </form>
    </div>
</div>



            <script type="text/javascript" src="/Public//Js/jquery.js"></script>
            <script>
                        $(document).ready(function () {
                            $("#verifycode").click(function () {
                                var time = new Date().getTime();
                                var imgurl = $(this).attr('src');
                                $(this).attr('src', imgurl + "?" + time);
                            });
                        });


                        $("form").submit(function () {
                            if ($("input[name='name']").val().length == 0) {
                                alert("请输入姓名！");
                                $("input[name='name']").focus();
                                return false;
                            }
                            if ($("input[name='title']").val().length == 0) {
                                alert("请输入标题！");
                                $("input[name='title']").focus();
                                return false;
                            }
                            if ($("#content").val().length == 0) {
                                alert("请输入留言内容！");
                                $("#content").focus();
                                return false;
                            }
                            var verifycode = $("input[name='verifycode']").val();
                            var vs = false;
                            $.ajax({
                                data: {verify: verifycode},
                                type: "post",
                                url: "<?php echo U('Home/Index/verify_check');?>",
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
            </script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>哈尔滨工业大学（威海）学生工作处</title>
    <link href="/Public//Home/css/header.css" type=text/css rel=stylesheet>
    <link href="/Public//Home/css/footer.css" type=text/css rel=stylesheet>
    <link href="/Public//Home/css/list.css" type=text/css rel=stylesheet>

    <script type="text/javascript" src="/Public//Home/js/xgc.js"></script>


</head>
<body>
<div class="top">
    <div class="top_center">
        <div class="logo">
            <img src="/Public//Home/images/aa.png"/>
        </div>

        <div class="top_right">
            <div id="top_time" onload="updateTime()">
                <?php
$text = file_get_contents('http://www.hitwh.edu.cn/'); $regex4 = "/<div id=\"top_nav_left\".*?>.*?<\/div>/ism"; preg_match($regex4, $text, $match); echo "$match[0]"; ?>
            </div>

            <div class="search_box">
                <form id="search_from" target="blank" onsubmit="return go(this)">
                    <input type="image" src="/Public//Home/images//btn_search_box.png" width="78px" height="31px"
                           id="go" alt="search" onclick="document.search_from.submit()">
                    <input type="text" id="word" value="请在此输入检索关键字"
                           onclick="if(this.value=='请在此输入检索关键字') this.value=''"></form>
            </div>
        </div>
    </div>
</div>
<div class="top_menu_bg_home">
    <div id="top_menu">
        <ul>
            <?php if(is_array($navlist[0])): $i = 0; $__LIST__ = $navlist[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <?php if($vo.f.fid == 0): if($vo['f']['typeid'] == 2): ?><a href="<?php echo ($vo["f"]["href"]); ?>"><?php echo ($vo["f"]["name"]); ?></a>
                            <?php else: ?>
                            <a href="<?php echo U($vo['f']['href']);?>"><?php echo ($vo["f"]["name"]); ?></a><?php endif; endif; ?>
                    <ul>
                        <?php if(is_array($vo['c'])): $i = 0; $__LIST__ = $vo['c'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i;?><li>
                                <?php if($chd['typeid'] == 2): ?><a href="<?php echo ($chd["href"]); ?>" target="_blank"><?php echo ($chd["name"]); ?></a>
                                    <?php else: ?>
                                    <a href="<?php echo U($chd['href']);?>"><?php echo ($chd["name"]); ?></a><?php endif; ?>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>




<div class="list_center">
    <div class="con_left">
        
    <div class="con_left_top"><?php echo ($current["name"]); ?></div>
    <div class="con_left_list">
        <ul>
            <?php if(empty($sidec)): ?><li><a href="">
                    <?php echo ($sidef["name"]); ?>
                </a></li><?php endif; ?>
            <?php if(is_array($sidec)): $i = 0; $__LIST__ = $sidec;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <?php if($vo['typeid'] == 2): ?><a href="<?php echo ($vo["href"]); ?>"><?php echo ($vo["name"]); ?></a>
                        <?php else: ?>
                        <a href="<?php echo U($vo['href']);?>"><?php echo ($vo["name"]); ?></a><?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>

    </div>
    <div class="con_right">
        
    <h3>|&nbsp;&nbsp;&nbsp;<?php echo ($sidef["name"]); ?></h3>

    <div class="news">
        <form action="<?php echo U('Home/Page/msgsubmit');?>" method="post" name="myform" id="myform" class="myform">
            <table cellspacing="1" cellpadding="0" class="table_form">
                <tbody>

                <tr>
                    <th>姓名</th>
                    <td><input type="text" value="" id="name" name="name" class="input-text" placeholder="请输入您的姓名"></td>
                </tr>

                <tr>
                    <th>手机</th>
                    <td>
                        <input type="text" size="40" value="" name="phone" id="phone" class="input-text"
                               placeholder="请输入您的联系手机">(选填)
                    </td>
                </tr>
                <tr>
                    <th>标题</th>
                    <td><input type="text" value="" id="title" name="title" class="input-text" placeholder="请输入标题"></td>
                </tr>
                <tr>
                    <th>留言内容</th>
                    <td><textarea name="content" cols="40" rows="5" class="input-text" id="content"
                                  placeholder="在此输入您的留言.."></textarea></td>
                </tr>


                <tr>
                    <th>验证码：</th>
                    <td>
                        <input name="verifycode" type="text" id="code" size="9" class="input-text"
                               placeholder="请输入验证码"/>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <img id="verifycode" alt="点击换一张" src="<?php echo U('Home/Index/verify_c');?>">
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value=" 提 交 " class="button orange">
                        <input type="reset" value=" 取 消 " class="button orange"></td>
                </tr>
                </tbody>
            </table>
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
        </form>
        <!--right_bar-->
    </div>


    </div>


</div>

    <div class="clearfix"></div>

<div class="listfooter">
    <div class="footer_container">
        <div class="footer_link">

            <?php if(is_array($navlist[1])): $i = 0; $__LIST__ = $navlist[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['f']['typeid'] == 2): ?><a href="<?php echo ($vo["f"]["href"]); ?>"><?php echo ($vo["f"]["name"]); ?></a>
                    <?php else: ?>
                    <a href="<?php echo U($vo['f']['href']);?>"><?php echo ($vo["f"]["name"]); ?></a><?php endif; ?>
                &nbsp;&nbsp;|&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="footer_address">
			<span>
				版权所有&nbsp;&nbsp;&nbsp;&nbsp;&copy;2015-2018&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;哈尔滨工业大学（威海）学生工作处
				<br>通讯地址：山东省威海市文化西路2号H楼221室 &nbsp;&nbsp;电话：86-0631-5687637</span>
        </div>
    </div>
</div>

</body>
</html>
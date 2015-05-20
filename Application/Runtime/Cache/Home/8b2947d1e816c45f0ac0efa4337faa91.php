<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
					<img src="/Public//Home/images/aa.png" />
				</div>

				<div class="top_right">
					<div id="top_time" onload="updateTime()">
						<?php
$text = file_get_contents('http://www.hitwh.edu.cn/'); $regex4 = "/<div id=\"top_nav_left\".*?>.*?<\/div>/ism"; preg_match($regex4, $text, $match); echo "$match[0]"; ?>
					</div>

					<div class="search_box">
						<form id="search_from" target="blank" onsubmit="return go(this)">
							<input type="image" src="/Public//Home/images//btn_search_box.png" width="78px" height="31px" id="go" alt="search" onclick="document.search_from.submit()" >
							<input type="text" id="word" value="请在此输入检索关键字" onclick="if(this.value=='请在此输入检索关键字') this.value=''"></form>
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
                                        <?php if($chd['typeid'] == 2): ?><a href="<?php echo ($chd["href"]); ?>"  target="_blank"><?php echo ($chd["name"]); ?></a>
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
        
            <div class="con_left_top"><?php echo ($sidef["name"]); ?></div>
            <div class="con_left_list">
                <ul>
                    <?php if(empty($sidec)): ?><li><a href="">
                            <?php echo ($sidef["name"]); ?>
                        </a></li><?php endif; ?>
                    <?php if(is_array($sidec)): $i = 0; $__LIST__ = $sidec;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                            <?php if($vo['typeid'] == 2): ?><a href="<?php echo ($vo["href"]); ?>"  target="_blank"><?php echo ($vo["name"]); ?></a>
                                <?php else: ?>
                                <a href="<?php echo U($vo['href']);?>"><?php echo ($vo["name"]); ?></a><?php endif; ?>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        
    </div>
    <div class="con_right">
        
    <h3>|&nbsp;&nbsp;&nbsp;<?php echo ($current["name"]); ?></h3>
    <div class="news" scroll=no>
           <div class="title">
               <?php echo ($news["title"]); ?>
           </div>
        <div class="content" scroll=no>
            <?php echo ($news["content"]); ?>
        </div>
    </div>


    </div>


</div>

	<div class="clearfix"></div>

    <div class="showfooter">
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
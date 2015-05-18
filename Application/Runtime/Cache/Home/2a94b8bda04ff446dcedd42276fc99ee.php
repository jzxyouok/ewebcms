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
	<link href="/Public//Home/css/index.css" type=text/css rel=stylesheet>
    <link href="/Public//Home/css/list.css" type=text/css rel=stylesheet>

	<script type="text/javascript" src="/Public//Home/js/xgc.js"></script>
	<script type="text/javascript" src="/Public//Home/js/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="/Public//Home/js/bgstretcher.js"></script>
	<link rel="stylesheet" href="/Public//Home/css/bgstretcher.css">

	<!--[if IE 6]>
	<style type="text/css">
	body{
	background:url(/Public//Home/images/bg2.jpg)
	}
	</style>
	<script type="text/javascript" src="DD_belatedPNG.js"></script>
	<script language="javascript" type="text/javascript">
        DD_belatedPNG.fix("#header,#logo,#end,#tupiantitle,#newscon,#zhutititle,.tabtitel");
        </script>
	<![endif]-->

	<script type="text/javascript" src="/Public//Home/js/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="/Public//Home/js/xgc.js"></script>
	<script type="text/javascript" src="/Public//Home/js/bgstretcher.js"></script>
	<script  type="text/javascript">
	$(document).ready(function(){

		 var userAgent = window.navigator.userAgent.toLowerCase();

		$.browser.msie10 = $.browser.msie && /msie 10\.0/i.test(userAgent);
		$.browser.msie9 = $.browser.msie && /msie 9\.0/i.test(userAgent);
		$.browser.msie8 = $.browser.msie && /msie 8\.0/i.test(userAgent);
		$.browser.msie7 = $.browser.msie && /msie 7\.0/i.test(userAgent);
		$.browser.msie6 = !$.browser.msie8 && !$.browser.msie7 && $.browser.msie && /msie 6\.0/i.test(userAgent);

	if($.browser.msie6==true)
	{}
	else
	{

		$('BODY').bgStretcher({
			images: [ '/Public//Home/images/bg1.jpg', '/Public//Home/images/bg2.jpg','/Public//Home/images/bg3.jpg', '/Public//Home/images/bg4.jpg'],
			imageWidth: 1920,
			imageHeight: 1280,
			slideDirection: 'NE',
			slideShowSpeed: 1000,
			transitionEffect: 'superSlide',
			sequenceMode: 'normal',
			buttonPrev: '#prev',
			buttonNext: '#next',
			pagination: '#nav',
			anchoring: 'left center',
			anchoringImg: 'left center'
		});
	}

	});
 </script>

</head>
<body>
	<!-- <div class="wrapper"> -->
		<div class="top">
			<div class="top_center">
				<div class="logo">
					<img src="/Public//Home/images/aa.png" />
				</div>

				<div class="top_right">
					<div id="top_time" onload="updateTime()">
						<?php
 $text=file_get_contents('http://www.hitwh.edu.cn/'); $regex4="/<div id=\"top_nav_left\".*?>.*?<\/div>/ism"; preg_match($regex4,$text,$match); echo "$match[0]"; ?>
					</div>

					<div class="search_box">
						<form id="search_from" target="blank" onsubmit="return go(this)">
							<input type="image" src="/Public//Home/images/btn_search_box.png" width="78px" height="31px" id="go" alt="search" onclick="document.search_from.submit()" >
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
                                        <?php if($chd['typeid'] == 2): ?><a href="<?php echo ($chd["href"]); ?>"><?php echo ($chd["name"]); ?></a>
                                            <?php else: ?>
                                            <a href="<?php echo U($chd['href']);?>"><?php echo ($chd["name"]); ?></a><?php endif; ?>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>


<div class="center">

	<a href="javascript:;" id="prev" style="cursor:pointer" class="bgStretcherNav bgStretcherNavPrev">
		<div style="height:40px; width:20px;position:fixed;left:0;bottom:300px; background:url(/Public//Home/images/prev1.png) no-repeat; line-height:40px; text-align:center;margin-top:1px;"></div>
	</a>
	<a href="javascript:;" id="next" style="cursor:pointer" class="bgStretcherNav bgStretcherNavNext">
		<div style="height:40px; width:20px; position:fixed;right:0;bottom:300px; background:url(/Public//Home/images/next1.png) no-repeat;line-height:40px;text-align:center;margin-top:1px;"></div>
	</a>

	<div class="center_container">
	<!-- 图片描述 -->
	<div id="pic_desc">
		<h3>十佳歌手</h3>
		<p>十佳歌手</p>
	</div>


	<!-- 新闻模块 -->
		<div class="news_bg">

			<div id="tab-list">
				<ul id="ul1">
					<li class="active">
						<img src="/Public//Home/images/xgxw.png"/>
						<a href="<?php echo U('Home/News/Newslist',array('id' => 121));?>">学工新闻</a>
					</li>
					<li>
						<img src="/Public//Home/images/tzgg.png"/>
						<a href="<?php echo U('Home/News/Newslist',array('id' => 121));?>">通知公告</a>
					</li>
					<li>
						<img src="/Public//Home/images/hdzx.png"/>
						<a href="<?php echo U('Home/News/Newslist',array('id' => 121));?>">卫生检查</a>
					</li>
				</ul>

                    <div class="active">
                        <ul>
                            <?php if($highlight[0]): ?><li>
                                    <a href="<?php echo U('Home/News/show',array('id' => $highlight[0]['id']));?>" target="_blank" title="<?php echo ($vo["title"]); ?>" style="color:#feff9b;">
                                        <span class="rq"><?php echo (date("m-d",$highlight[0]["updatetime"])); ?></span>
                                        <?php echo (msubstr($highlight[0]["title"],0,24,'utf8',false)); ?>
                                    </a>
                                </li><?php endif; ?>

                            <?php if(is_array($newslist[0])): $i = 0; $__LIST__ = $newslist[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                    <a href="<?php echo U('Home/News/show',array('id' => $vo['id']));?>" target="_blank" title="<?php echo ($vo["title"]); ?>">
                                        <span class="rq"><?php echo (date("m-d",$vo["updatetime"])); ?></span>
                                        <?php echo (msubstr($vo["title"],0,24,'utf8',false)); ?>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>


                <div class="hide">
                    <ul>
                        <?php if($highlight[1]): ?><li>
                                <a href="<?php echo U('Home/News/show',array('id' => $highlight[1]['id']));?>" target="_blank" title="<?php echo ($vo["title"]); ?>" style="color:#feff9b;">
                                    <span class="rq"><?php echo (date("m-d",$highlight[1]["updatetime"])); ?></span>
                                    <?php echo (msubstr($highlight[1]["title"],0,24,'utf8',false)); ?>
                                </a>
                            </li><?php endif; ?>
                        <?php if(is_array($newslist[1])): $i = 0; $__LIST__ = $newslist[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a href="<?php echo U('Home/News/show',array('id' => $vo['id']));?>" target="_blank" title="<?php echo ($vo["title"]); ?>">
                                    <span class="rq"><?php echo (date("m-d",$vo["updatetime"])); ?></span>
                                    <?php echo (msubstr($vo["title"],0,24,'utf8',false)); ?>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>

                <div class="hide">
                    <ul>
                        <?php if($highlight[2]): ?><li>
                                <a href="<?php echo U('Home/News/show',array('id' => $highlight[2]['id']));?>" target="_blank" title="<?php echo ($vo["title"]); ?>" style="color:#feff9b;">
                                    <span class="rq"><?php echo (date("m-d",$highlight[2]["updatetime"])); ?></span>
                                    <?php echo (msubstr($highlight[2]["title"],0,24,'utf8',false)); ?>
                                </a>
                            </li><?php endif; ?>
                        <?php if(is_array($newslist[2])): $i = 0; $__LIST__ = $newslist[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a href="<?php echo U('Home/News/show',array('id' => $vo['id']));?>" target="_blank" title="<?php echo ($vo["title"]); ?>">
                                    <span class="rq"><?php echo (date("m-d",$vo["updatetime"])); ?></span>
                                    <?php echo (msubstr($vo["title"],0,24,'utf8',false)); ?>
                                </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>

			<!-- <div style=" clear:both;width:450px; height:13px; line-height:10px;text-align:right; margin-right:10px;">
				<a id="gengduo" target="_blank" onclick="showmore();" href="http://news.hitwh.edu.cn" style="text-decoration:none;">+MORE</a>
			</div> -->
		</div>
		<div style=" clear:both;width:450px; height:13px; line-height:10px;text-align:right; margin-right:10px;">
				<a id="gengduo" target="_blank" onclick="showmore();" href="<?php echo U('Home/News/Newslist',array('id' => 109));?>" style="text-decoration:none;">+更多</a>
			</div>
	</div>

	<div class="news_bottom">
		<img src="/Public//Home/images/news_bottom_logo.png" />

		<span class="news_bottom_title">&nbsp;&nbsp;校园快讯&nbsp;:&nbsp;</span>

		<div class="news_bottom_title">
			<a href="<?php echo U('Home/News/show',array('id' => $highlight[0]['id']));?>"><?php echo ($highlight[0]["title"]); ?></a>
		</div>

	</div>

	<div style="clear:both;width:100%;height:25px;"></div>

</div>


</div>

<div class="footer_bg">
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
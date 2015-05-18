<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>威海驾培信息网</title>

<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
$("#menu_com").mouseover(function(){

  $("#menu_detail").css("display","block");

});
$("#menu_com").mouseout(function(){

  $("#menu_detail").css("display","none");

});

});
</script>



</head>

<body>
<div id="headerCon">
  <!--Top start-->
  <div id="top"> <span style="float:right">&nbsp;&nbsp;<span style=""><img src="images/d.png" style="vertical-align:middle; padding-right:6px;" /><a href=# onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.whjpfw.com');">设为首页</a></span>&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><img src="images/d.png" style="vertical-align:middle; padding-right:6px;" /><a href="javascript:window.external.AddFavorite('http://www.whjpfw.com', '威海驾培网')">加入收藏</a>&nbsp;&nbsp;&nbsp;&nbsp;{!$time_now!}</span>&nbsp;&nbsp;</span>-- <?php echo ($webname); ?> --
  </div>
  <!--top end-->
  <div id="header">
   <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="1026" height="221">
  <param name="movie" value="/ewebcms/Public/home/images/jiapei22.swf" />
  <param name="quality" value="high" />
  <param name="allowScriptAccess" value="always" />
  <param name="wmode" value="transparent">
     <embed src="/ewebcms/Public/home/images/jiapei22.swf"
      quality="high"
      type="application/x-shockwave-flash"
      WMODE="transparent"
      width="1022"
      height="221"
      pluginspage="http://www.macromedia.com/go/getflashplayer"
      allowScriptAccess="always" />
</object>
  </div>
  <!--header end-->
  <!--nav start-->
  <div id="menucontain">
  	<div id="menu">
    	<ul>
        	<li><a href="index.php">首 页</a></li>

    <li><a href="newslist.php?nid=1">新闻快讯</a></li>
     <li><a href="newslist.php?nid=11">政策法规</a></li>
     <li><a href="newslist.php?nid=3">行业动态</a></li>
     <li><a href="newslist.php?nid=4">驾校新闻</a></li>
    <li><a href="newslist.php?nid=5">学车指南</a></li>
    <li><a href="newslist.php?nid=6">考试技巧</a></li>
    <li><a href="baoming.php">网上报名</a></li>
     <li><a href="{!$config.testlink!}" target="_blank">模拟考试</a></li>

    <li id="menu_com"><a  href="complain.php">投诉曝光台</a>
	     <div id="menu_detail"  style="background:#0057A7;color:#FFFFFF;font-size:12px;float:right;position:absolute;display:none"> 
		 <a class="menu_com" style="line_height:10px;height:20px;margin:0px 0px;padding:0px 10px;" href="blamelist.php?nid=3">实名投诉列表</a>
		  <a class="menu_com" style="line_height:10px;height:20px;margin:0px 0px;padding:0px 10px;" href="complainlist.php">匿名投诉列表</a> 
		  <a class="menu_com" style="line_height:10px;height:20px;margin:0px 0px;padding:0px 10px;" href="sincerity_sx.php?nid=3">教练员黑名单</a> 
		  <a class="menu_com" style="line_height:10px;height:20px;margin:0px 0px;padding:0px 10px;" href="complain.php?nid=3">匿名投诉登记</a>	
		 </div>
	
	
	
	</li>
	    
    <li class="nobak"><a href="#">联系我们</a></li>
        </ul>
    </div>
    <div id="kuaixun"><span>投诉电话：{!$config.tel!}</span><a href="newsdetail.php?id={!$news_first.id!}">{!$news_first.title!}</a></div>
  </div>

    <div class="clearfloat"></div>
  <!--nav end-->
</div>

 ﻿
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>威海驾培信息网</title>
<link href="/ewebcms/Public/home/css/index_layout.css" rel="stylesheet" type="text/css" />
<script src="/ewebcms/Public/home/js/jquery-1.4a2.min.js" type="text/javascript"></script>
<script src="/ewebcms/Public/home/js/jquery.KinSlideshow-1.2.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$("#KinSlideshow").KinSlideshow();
})
</script>
</head>

<body>

<!--container start-->
<div id="container">

  <div id="nowpsn">你现在的位置：威海驾培网 >> {!$newsname!}</div>
  <!--maincontent start-->
  <div id="maincontent">
  	<!--新闻分页面左栏开始-->
  	<div id="listsideContain">
    	<div id="box"  style="width:240px; margin-bottom:15px;  float:none">
        <div id="boxTitle"><span class="floatRight"><a href="newslist.php?nid=1">更多</a></span><a href="newslist.php?nid=1" class="blue">新闻快讯</a></div>
        <div id="boxCon">
           <ul>
           {!section name=l loop=$d_news_kuaixun!}
            <li> <a href="newsdetail.php?id={!$d_news_kuaixun[l].id!}">{!$d_news_kuaixun[l].title!}</a></li>
           {!/section!}
          </ul>
        </div>
      </div>
     <div id="box"  style="width:240px; margin-bottom:15px;  float:none">
        <div id="boxTitle"><span class="floatRight"><a href="newslist.php?nid=7">更多</a></span><a href="newslist.php?nid=7" class="blue">行业动态</a></div>
        <div id="boxCon">
           <ul>
            {!section name=l loop=$d_news_hangye!}
            <li> <a href="newsdetail.php?id={!$d_news_hangye[l].id!}">{!$d_news_hangye[l].title!}</a></li>
           {!/section!}

          </ul>
        </div>
      </div>
      <div id="box"  style="width:240px; float:none">
        <div id="boxTitle"><span class="floatRight"><a href="newslist.php?nid=11">更多</a></span><a href="newslist.php?nid=11" class="blue">政策法规</a></div>
        <div id="boxCon">
           <ul>
             {!section name=l loop=$news_zcfg!}
          <li> <a href="newsdetail.php?id={!$news_zcfg[l].id!}">{!$news_zcfg[l].title!}</a></li>
            {!/section!}
          </ul>
        </div>
      </div>
    </div>
    <!--新闻分页面左栏结束-->
    <!--新闻分页面右栏开始-->
    <div id="listmainContain">
    	<div id="title">{!$news.title!}</div>
        <div id="author">作者：{!$news.author!}&nbsp;&nbsp;文章来源：本站原创&nbsp;&nbsp;点击数：{!$news.clickrate!} &nbsp;&nbsp;发表时间：{!$news_date!}</div>
        <div id="conten">
        {!$news.content!}
        </div>
    </div>
    <!--新闻分页面右栏结束-->
    <div class="clearfloat"></div>
  </div>
  <!--maincontent end-->
  <div class="clearfloat"></div>
  <!--footer start-->

</body>
</html>


<div id="footer">
    <p><a href="http://www.weihai.gov.cn" target="_blank">友情链接：威海市政府</a> <a href="http://www.whygc.com" target="_blank">威海市道路运输管理处</a> <a href="http://www.sdjiapei.com/"  target="_blank"> 山东省机动车驾驶员培训信息网</a> <a href="http://www.moc.gov.cn/"  target="_blank"> 中华人民共和国交通运输部</a> <a href="http://www.sdjt.gov.cn/"  target="_blank"> 山东省交通运输厅 </a> <a href="http://www.sddlys.com/"  target="_blank">山东交通运输厅道路运输局 </a> <a href="http://www.sdga.gov.cn/"  target="_blank">山东省公安厅 </a></p>
    <p>关于我们 | 联系我们 | 广告服务 | 资质荣誉 | 网站声明</p>
    <p>主办单位：{!$config.zhuban!} &nbsp; 运行维护单位：{!$config.yunxing!} &nbsp;&nbsp;{!$config.record!}</p>
    <p>地址：{!$config.address!} &nbsp;联系电话：{!$config.tel!} &nbsp;传真：{!$config.fax!} &nbsp;　Email:{!$config.email!}&nbsp;&nbsp;&nbsp;</p>
    <p id="cnzz_color"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000436426'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "v1.cnzz.com/z_stat.php%3Fid%3D1000436426%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
    &nbsp;&nbsp;&nbsp;您是第<script src="http://count.2881.com/count/count.asp?id=52097&sx=1&ys=20" language="JavaScript" charset="gb2312"></script>个访客
    </p>
    </div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <title>软件中心CMS内容管理系统</title>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public//Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public//Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/ewebcms/Public//Css/style.css" />
    <script type="text/javascript" src="/ewebcms/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcms/Public//Js/common.js"></script>
    <style>
      body{
            width: 95%;margin: 0 auto;
      	}
      .box_left{
			width:48%;float:left;height:500px;margin:20px 0px;
      	  }
      .box_rigth{
			width:48%;float:right;height:500px;margin:20px 0px;
      	  }
       .myinfo{
       	    margin-bottom: 10px;
       	 	width: 100%;height: 240px;border: 1px solid #d1dee2;
       	 	border: 1px solid #d1dee2;
       	 	background: #fff;
            -moz-border-radius: 3px;
            border-radius: 8px;
            -moz-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            -webkit-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            box-shadow: rgba(24, 108, 162, 0.6) 4px;
       }
       .topbanner{
       	    background-color: #fff;
       	    height: 20px;
       	    border-bottom: 1px solid #c7d8ea;
			color: #3a6ea5;
			border-top-left-radius:8px;
			border-top-right-radius:8px;
			background: url(/ewebcms/Public/Images/x_bg.png) repeat-x ;
			height: 26px;
			line-height: 28px;
			padding: 0 10px;
       }
       .info{
       		margin-top: 10px;
       		margin-left: 10px;
       		font-size: 14px;
       }
    </style>
</head>
<body>
<div class="box_left" >
	<div class="myinfo">
		<div class="topbanner">个人信息
        <button style="margin-top:2px;float:right" type="button" class="btn btn-mini btn-success"  >修改密码
        </button>
		</div>
		<div class="info">
		<table class="table table-bordered table-striped definewidth">
            <colgroup>
              <col class="span1">
              <col class="span7">
            </colgroup>
            <tbody>
              <tr>
                <td>
                <span class="label label-success">用户名：</span>
                </td>
                <td>admin</td>
              </tr>
              <tr>
                <td>
                 <span class="label label-info">角色：</span>
                </td>
                <td>站点管理员</td>
              </tr>
              <tr>
                <td>
                <span class="label label-success">上次登录时间:</span>
                 
                </td>
                <td>2011-12-12 09:12:12</td>
              </tr>
              <tr>
                <td>
                  <span class="label label-info">上次登录IP:</span>
                </td>
                <td>192.31.132.1</td>
              </tr>
              <tr>
                <td>
                  <span class="label label-success">本次登录IP:</span>
                </td>
                <td>123.21.232.1</td>
              </tr>
            </tbody>
          </table>
		</div> 
	</div>

	<div class="myinfo">
		<div class="topbanner">文档信息</div>
         <div class="info">
			<table class="table table-bordered table-striped definewidth">
            <colgroup>
              <col class="span1">
              <col class="span7">
            </colgroup>
           <tbody>
              <tr>
                <td>
                <span class="label label-success">文档类别总数：</span>
                </td>
                <td>12</td>
              </tr>
              <tr>
                <td>
                 <span class="label label-info">新增文章数量：</span>
                </td>
                <td>80</td>
              </tr>
              <tr>
                <td>
                <span class="label label-success">总文章数量:</span>
                 
                </td>
                <td>340</td>
              </tr>
              
            </tbody>
          </table>
		</div> 
	</div>
	</div>
</div>
<div class="box_rigth">
	<div class="myinfo">
		<div class="topbanner">会员留言</div>
		     <div class="info">
			<table class="table table-bordered table-striped definewidth">
            <colgroup>
              <col class="span1">
              <col class="span7">
            </colgroup>
           <tbody>
              <tr>
                <td>
                <span class="label label-success">新增会员数：</span>
                </td>
                <td>0</td>
              </tr>
              <tr>
                <td>
                 <span class="label label-info">会员总数：</span>
                </td>
                <td>0</td>
              </tr>
              <tr>
                <td>
                <span class="label label-success">新增留言:</span>
                 
                </td>
                <td>0</td>
              </tr>
              <tr>
                <td>
                  <span class="label label-info">留言总数:</span>
                </td>
                <td>0</td>
              </tr>
             
            </tbody>
          </table>
		</div> 
	</div>
<div class="myinfo">
	<div class="topbanner">其他信息</div>
	         <div class="info">
			<table class="table table-bordered table-striped definewidth">
            <colgroup>
              <col class="span1">
              <col class="span7">
            </colgroup>
            <tbody>
              <tr>
                <td>
                <span class="label label-success">访客流量查看</span>
                </td>
                <td><a href="http://www.baidu.com"  target="_black" >CNZZ</a></td>
              </tr>
            </tbody>
          </table>
		</div> 
	</div>
</div>

</body>
</html>
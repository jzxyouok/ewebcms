<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <title>软件中心CMS内容管理系统</title>

    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public//Css/style.css"/>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public//Js/common.js"></script>
    <style type="text/css">
        body {
            width: 95%;
            margin: 0 auto;
        }

        .box {
            width: 100%;
            margin: 20px 0px;
        }

        .myinfo {
            margin-bottom: 5px;
            padding-bottom: 5px;
            width: 100%;
            border: 1px solid #d1dee2;
            border: 1px solid #d1dee2;
            background: #fff;
            -moz-border-radius: 3px;
            border-radius: 8px;
            -moz-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            -webkit-box-shadow: rgba(24, 108, 162, 0.6) 0 0 4px;
            box-shadow: rgba(24, 108, 162, 0.6) 4px;
        }

        .myinfo li em {
            float: left;
            width: 100px;
            font-style: normal;
        }

        li {
            list-style: none;
        }

        .topbanner {
            background-color: #fff;
            height: 20px;
            border-bottom: 1px solid #c7d8ea;
            color: #3a6ea5;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            background: url(/ewebcmsxgc/Public/Images/x_bg.png) repeat-x;
            height: 26px;
            line-height: 28px;
            padding: 0 10px;
        }

        .info {
            margin-top: 10px;
            margin-left: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="box">
    <div class="myinfo">
        <div class="topbanner">船舶技术研究院</div>
        <div class="info">在威海,由省市,服务全省的船舶制造公众研发平台,</div>
    </div>
    <div class="myinfo">
        <div class="topbanner">系统信息</div>
        <div class="info">
            <ul>
                <?php if(is_array($server_info)): $i = 0; $__LIST__ = $server_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><em><?php echo ($key); ?></em> <span><?php echo ($vo); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <div class="myinfo">
        <div class="topbanner">软件开发者</div>
        <div class="info">
            <ul>
                <li><em>团队成员</em> <span>Dean,Sam,Tuolaji,Smile,Codefans,睡不醒的猪,Jack,日本那只猫</span></li>
                <li><em>联系邮箱</em> <span>cmf@simplewind.net</span></li>
            </ul>
        </div>
    </div>
    <div class="myinfo">
        <div class="topbanner">使用帮助</div>
        <div class="info">
            <ul>
                <li><em>团队成员</em> <span>Dean,Sam,Tuolaji,Smile,Codefans,睡不醒的猪,Jack,日本那只猫</span></li>
                <li><em>联系邮箱</em> <span>cmf@simplewind.net</span></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
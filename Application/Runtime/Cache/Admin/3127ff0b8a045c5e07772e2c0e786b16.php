<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Css/style.css"/>
    <script type="text/javascript" src="/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/Public/Js/common.js"></script>

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
        font{
            color:#5bb75b;
        }
        textarea {
            width:100%;
            height:500px;
        }

    </style>
</head>
<body>

<div class="navbar definewidth m10">
    <div class="navbar-inner">
        <a class="brand">创建微信底部菜单</a>
    </div>
</div>

<div style="margin-top:0px;">
        <table class="table definewidth m10" classid="class_1">
            <thead>
            <th width="45%">
                json代码示例
            </th>
            <th>
                生成菜单代码
            </th>
            </thead>
            <tbody>
            <td>
<pre>
{
    "button": [                           <font style="color:red;">//一级按钮,最多3个</font>
        {
            "name": "院系介绍",
            "sub_button": [              <font>//这里为二级按钮,最多5个</font>
                {
                    "type": "click",     <font>//若为点击按钮类型为click</font>
                    "name": "学院介绍",   <font>//二级按钮的名字</font>
                    "key": "XYJS"        <font>//关键字,提供事件,任意字符</font>
                },
                {
                    "type": "click",
                    "name": "专业介绍",
                    "key": "ZYJS"
                }
            ]
        },                               <font style="color:red;">//第一个一级按钮结束</font>
        {
            "name": "互动交流",
            "sub_button": [
                {
                    "type": "view",      <font>//view类型为打开网页</font>
                    "name": "搜索",
                    "url": "http://www.baidu.com" <font>//网页URL</font>
                }
            ]
        },                              <font style="color:red;">//第二个一级按钮结束</font>-->
        {
            ....                        <font style="color:blue;">//第三个以此类推</font>
        },
    ]
}
</pre>
            </td>
            <td>
                <form action="<?php echo U('Admin/Wechat/menusubmit');?>" method="post" class="form">
                    <textarea name="menudata" id="menudata" cols="30" rows="10"></textarea><br/>
                    <input type="submit" class="btn btn-success" value="提  交"/>
                </form>
            </td>
            </tbody>
        </table>


</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>哈工大威海学生工作处-留言回复</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style>
        /*分页*/
        .pagination {
            margin: 20px 0;
        }

        .pagination-centered{
            text-align: center;
        }

        .pagination a,.pagination span{
            float:left;
            display:block;
            height:30px;
            width:30px;
            border:1px solid #eee;
            text-align:center;
            line-height: 30px;
        }

        .pagination ul a:hover{
            color:#1A78C1;;
        }

        .current{
            color:black;
        }

        .num{
            color:#003bb3;
        }

        .prev{
            color:#002a80;
        }
        .next{
            color:#002a80;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <?php if(is_array($msglist)): $i = 0; $__LIST__ = $msglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><b><?php echo ($vo["name"]); ?>:</b><?php echo ($vo["title"]); ?></h3>
                </div>
                <div class="panel-body">
                    <h4><?php echo ($vo["content"]); ?></h4><br/>
                    <div class="pull-right"><?php echo (date("Y-m-d",$vo["date"])); ?></div>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h5><?php echo (date("Y-m-d",$vo["replydate"])); ?>&nbsp;回复:</h5>
                    <h4><?php echo ($vo["reply"]); ?></h4>
                </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <ul class="pagination pagination-centered">
            <?php echo ($page); ?>
        </ul>
    </div>
</div>
</body>
</html>
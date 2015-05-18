<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public/Css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public/Css/bootstrap-responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/ewebcmsxgc/Public/Css/style.css"/>
    <script type="text/javascript" src="/ewebcmsxgc/Public/Js/jquery.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public/Js/jquery.sorted.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public/Js/ckform.js"></script>
    <script type="text/javascript" src="/ewebcmsxgc/Public/Js/common.js"></script>

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


    </style>
</head>
<body>
<div class="definewidth m10">
    <div class="navbar definewidth m10" style="margin-bottom:-8px;">
        <div class="navbar-inner">
            <a class="brand">正在为&nbsp;<strong><?php echo ($rname); ?></strong>&nbsp;配置权限</a>
        </div>
    </div>
</div>
<form action="<?php echo U('Admin/Rbac/submitAccess');?>" method="post" class="definewidth m20">
    <input type="hidden" value="<?php echo ($rid); ?>"  name="rid"/>
    <table class="table table-bordered table-hover definewidth m10">
        <tr>
            <td>
                <?php if(is_array($nodelist)): $i = 0; $__LIST__ = $nodelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p style="margin-left:<?php echo ($vo['level']*20); ?>px;<?php if($vo["level"] == 3): ?>float:left<?php else: ?>clear:both;<?php endif; ?>">
                        <label for="<?php echo ($vo["id"]); ?>" name="name" value="$vo.id">
                            <?php $checked = $vo['access']==1 ? "checked":""; ?>
                            <input type="checkbox" id="<?php echo ($vo["id"]); ?>" name="access[]" value="<?php echo ($vo["id"]); ?>_<?php echo ($vo["level"]); ?>" pid="<?php echo ($vo["pid"]); ?>" level="<?php echo ($vo["level"]); ?>" <?php echo ($checked); ?>/>
                            <?php if($vo["level"] == 1): ?><b>[应用]</b>
                                <?php elseif($vo["level"] == 2): ?><b>[模块]</b>
                                <?php else: ?><b>[操作]</b><?php endif; ?>
                            <?php echo ($vo["title"]); ?>
                        </label>
                    </p><?php endforeach; endif; else: echo "" ;endif; ?>
            </td>

        </tr>
        <tr>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>
    $(function () {
        $('#backid').click(function () {
            window.location.href = "roleList.html";
        });

        $("input").click(
                function(){
                   var level = $(this).attr('level');
                    if(level == 1){
                        var str = "_";
                        var inputs = $('input[value*='+str+']');
                        $(this).attr('checked')?inputs.attr('checked',true):inputs.removeAttr('checked');
                    }
                    if(level == 2){
                        var id = $(this).attr('id');
                        var inputs = $('input[pid='+id+']');
                        $(this).attr('checked')?inputs.attr('checked',true):inputs.removeAttr('checked');

                        var pid = $(this).attr('pid');
                        $('input[id='+pid+']').attr('checked',true);
                    }
                    if(level == 3){
                        if($(this).attr('checked')){
                            var pid = $(this).attr('pid');
                            $('input[id='+pid+']').attr('checked',true);

                            var ppid = $('input[id='+pid+']').attr('pid');
                            $('input[id='+ppid+']').attr('checked',true);
                        }

                    }
                });
    });
</script>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Css/style.css" />
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


    </style>
</head>
<body>
<div class="definewidth m10">
<div class="navbar definewidth m10" style="margin-bottom:-8px;">
  <div class="navbar-inner">
    <a class="brand">用户编辑</a>
  </div>
</div>
</div>
<form action="<?php echo U('Admin/User/update');?>" method="post" class="definewidth m20">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">登录名称</td>
        <input type="hidden" name="username" value="<?php echo ($list["username"]); ?>"/>
        <input type="hidden" name="id" value="<?php echo ($list["id"]); ?>"/>
        <td><span class="input-xlarge uneditable-input"><?php echo ($list["username"]); ?></span></td>
    </tr>
    <tr>
        <td class="tableleft">密码</td>
        <td><input type="password" name="password" value=""/></td>
    </tr>
    <tr>
        <td class="tableleft">真实姓名</td>
        <td><input type="text" name="name" value="<?php echo ($list["name"]); ?>" /></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">所属部门</td>
        <td>
            <select name="dptid">
                <?php if(is_array($dptlist)): $i = 0; $__LIST__ = $dptlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $selected = $vo['f']['id']==$list['dpt']?"selected":""; ?>
                    <option value="<?php echo ($vo["f"]["id"]); ?>" <?php echo ($selected); ?>><?php echo ($vo["f"]["name"]); ?></option>
                    <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i; $selected1 = $chd['id']==$list['dpt']?"selected":""; ?>
                        <option value="<?php echo ($chd["id"]); ?>" <?php echo ($selected1); ?>>&nbsp;&nbsp;┊--<?php echo ($chd["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">用户组</td>
        <td><select name="mid" style="width:200px">
        <?php if(is_array($roles)): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($list["mid"]) == $vo["id"]): ?><option selected="selected" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option>  
                             <?php else: ?>
                                <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </td>
    </tr>
    <tr>
        <td class="tableleft">联系手机</td>
        <td><input type="text" name="tel" value="<?php echo ($list["tel"]); ?>" />&nbsp;&nbsp;<span class="label label-success">选填</span></td>
    </tr>
    <tr>
        <td class="tableleft">联系QQ</td>
        <td><input type="text" name="qq" value="<?php echo ($list["qq"]); ?>" />&nbsp;&nbsp;<span class="label label-success">选填</span></td>
    </tr>
    <tr>
        <td class="tableleft">E-mail</td>
        <td><input type="text" name="email" value="<?php echo ($list["email"]); ?>" />&nbsp;&nbsp;<span class="label label-success">选填</span></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <button type="submit" class="btn btn-primary" type="button">保存</button> &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>
<script>
    $(function () {       
        $('#backid').click(function(){
                window.location.href="index.html";
         });

    });
</script>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>5667软件中心CMS内容管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/ewebcmsxgcbackup/Public/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="/ewebcmsxgcbackup/Public/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="/ewebcmsxgcbackup/Public/assets/css/main-min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/ewebcmsxgcbackup/Public/assets/css/layout.css">

    <style>
        .home{
            float:left;
        }
        .home a{
            color:#eee;
        }
        .home a:hover{
            color:white;
        }
    </style>
</head>
<body>

<div class="header">

    <div class="dl-title">软件中心CMS内容管理系统</div><div  class="home" >&nbsp;&nbsp;<a target="_blank" href="<?php echo U('Home/Index/index');?>">[站点首页]</a></div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($user["name"]); ?></span><a href="<?php echo U('Admin/Main/outlogin');?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">

    <div class="dl-main-nav">
        <div class="dl-inform">
            <div class="dl-inform-title">
                <s class="dl-inform-icon dl-up">
                </s>
            </div>
        </div>
        <ul id="J_Nav"  class="nav-list ks-clear">

            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">网站管理</div></li>

            <?php if($doc): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-goods">内容管理</div></li><?php endif; ?>
            <?php if($newsclass): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-order">菜单管理 </div></li><?php endif; ?>
            <?php if($message): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-sample">留言管理</div></li><?php endif; ?>
            <?php if($depart): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-distribution">部门管理 </div></li><?php endif; ?>
            <?php if($rbac): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-permission">权限管理 </div></li><?php endif; ?>
            <?php if($wechat): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-register">微信管理 </div></li><?php endif; ?>
            <?php if($setting): ?><li class="nav-item dl-selected"><div class="nav-item-inner nav-package">网站设置</div></li><?php endif; ?>

            <li class="nav-item dl-selected"><div class="nav-item-inner nav-user">个人信息</div></li>

        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>

</div>
<script type="text/javascript" src="/ewebcmsxgcbackup/Public/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/ewebcmsxgcbackup/Public/assets/js/bui-min.js"></script>
<script type="text/javascript" src="/ewebcmsxgcbackup/Public/assets/js/common/main-min.js"></script>
<script type="text/javascript" src="/ewebcmsxgcbackup/Public/assets/js/config-min.js"></script>

<script src="http://g.tbcdn.cn/fi/bui/jquery-1.8.1.min.js"></script>
<script src="http://g.alicdn.com/bui/seajs/2.3.0/sea.js"></script>
<script src="http://g.alicdn.com/bui/bui/1.1.16/config.js"></script>
<?php $homenavnum = 1; ?>
<script>
	
    var docM=
	{
                id:'2',
                menu:
                        [
								
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i; $navdouhao = $homenavnum == $adminnavnum?"":","; $homenavnum ++; ?>

                                {
                                    text:'<?php echo ($vo1["nav"]["name"]); ?>',
                                    items:[
											 <?php if(is_array($vo1["navlist"])): $i = 0; $__LIST__ = $vo1["navlist"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $display=$vo['f']['display']==1?"":"(不可见)"; ?>
                                                <?php if($vo['f']['typeid'] == 3): ?>{
                                                    id:'<?php echo ($vo["f"]["id"]); ?>',text:'<?php echo ($vo["f"]["name"]); ?>(单)<?php echo ($display); ?>',href:"<?php echo U('Admin/NewsClass/edit');?>?id=<?php echo ($vo["f"]["id"]); ?>&typeid=3"
                                                },
												<?php elseif($vo['f']['typeid'] == 2): ?>
                                                {
                                                    id:'<?php echo ($vo["f"]["id"]); ?>',text:'<?php echo ($vo["f"]["name"]); ?>(外)<?php echo ($display); ?>',href:"<?php echo U('Admin/NewsClass/edit');?>?id=<?php echo ($vo["f"]["id"]); ?>&typeid=2"
                                                },
                                                <?php else: ?>
                                                {
                                                    id:'<?php echo ($vo["f"]["id"]); ?>',text:'<?php echo ($vo["f"]["name"]); echo ($display); ?>',href:"<?php echo U('Admin/Doc/index');?>?id=<?php echo ($vo["f"]["id"]); ?>"
                                                },<?php endif; ?>
												
												 <?php if(is_array($vo["c"])): $i = 0; $__LIST__ = $vo["c"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chd): $mod = ($i % 2 );++$i; $display=$chd['display']==1?"":"(不可见)"; ?>
													<?php if($chd['typeid'] == 3): ?>{
														id:'<?php echo ($chd["id"]); ?>',text:'┗<?php echo ($chd["name"]); ?>(单)<?php echo ($display); ?>',href:"<?php echo U('Admin/NewsClass/edit');?>?id=<?php echo ($chd["id"]); ?>&typeid=3"
													},
													<?php elseif($chd['typeid'] == 2): ?>
													{
														id:'<?php echo ($chd["id"]); ?>',text:'┗<?php echo ($chd["name"]); ?>(外)<?php echo ($display); ?>',href:"<?php echo U('Admin/NewsClass/edit');?>?id=<?php echo ($chd["id"]); ?>&typeid=2"
													},
												
															<?php else: ?>
													{
														id:'<?php echo ($chd["id"]); ?>',text:'┗<?php echo ($chd["name"]); echo ($display); ?>',href:"<?php echo U('Admin/Doc/index');?>?id=<?php echo ($chd["id"]); ?>"
													},<?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                                        ]
                                }
								<?php echo $navdouhao; endforeach; endif; else: echo "" ;endif; ?>

                        ]
            };

    BUI.use('common/main',function(){
        var config = [
            {
                id:'1',
                menu:
                        [
                            {
                                text:'网站信息',
                                items:
                                        [
                                            {
                                                id:'1',text:'网站信息',href:"<?php echo U('Admin/Main/infoshow');?>"
                                            },
                                            {
                                                id:'2',text:'基本信息',href:"<?php echo U('Admin/Main/infoshow2');?>"
                                            },
                                            {
                                                id:'3',text:'统计信息',href:"<?php echo U('Admin/Main/datashow');?>"
                                            },
                                            {
                                                id:'4',text:'版权所有',href:"<?php echo U('Admin/Main/copyright');?>"
                                            }

                                        ]
                            }

                        ]
            },
                <?php if($doc): ?>docM,<?php endif; ?>
                <?php if($newsclass): ?>{
                        id:'8',
                        menu:
                                [
                                    {
                                        text:'菜单管理',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'管理导航',href:'<?php echo U("Admin/NewsClass/navindex");?>'
                                                    },
                                                    {
                                                        id:'2',text:'管理栏目',href:'<?php echo U("Admin/NewsClass/index");?>'
                                                    },
                                                    {
                                                        id:'3',text:'新增内部栏目',href:'<?php echo U("Admin/NewsClass/add");?>'
                                                    },
                                                    {
                                                        id:'4',text:'新增外部链接',href:'<?php echo U("Admin/NewsClass/addurl");?>'
                                                    },
                                                    {
                                                        id:'5',text:'新增单网页',href:'<?php echo U("Admin/NewsClass/addpage");?>'
                                                    }
                                                ]
                                    }
                                ]
                    },<?php endif; ?>

                <?php if($message): ?>{
                        id:'3',
                        menu:
                                [
                                    {
                                        text:'网站留言管理',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'未回留言',href:"<?php echo U('Admin/Message/index');?>?type=0"
                                                    },
                                                    {
                                                        id:'2',text:'所有留言',href:"<?php echo U('Admin/Message/index');?>?type=1"
                                                    }
                                                ]
                                    }

                                ]
                    },<?php endif; ?>
                <?php if($depart): ?>{
                        id:'4',
                        menu:
                                [
                                    {
                                        text:'部门管理',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'部门管理',href:'<?php echo U("Admin/Depart/index");?>'
                                                    },
                                                    {
                                                        id:'2',text:'部门添加',href:'<?php echo U("Admin/Depart/add");?>'
                                                    }
                                                ]
                                    }
                                ]
                    },<?php endif; ?>
                <?php if($rbac): ?>{
                        id:'9',
                        menu:
                                [
                                    {
                                        text:'用户管理',
                                        items:
                                                [

                                                    {
                                                        id:'4',text:'查看所有用户',href:"<?php echo U('Admin/Rbac/userList');?>"
                                                    },
                                                    {
                                                        id:'5',text:'增加新用户',href:"<?php echo U('Admin/Rbac/addUser');?>"
                                                    }

                                                ]
                                    },
                                    {
                                        text:'角色管理',
                                        items:
                                                [

                                                    {
                                                        id:'6',text:'所有角色',href:"<?php echo U('Admin/Rbac/roleList');?>"
                                                    },
                                                    {
                                                        id:'7',text:'增加新角色',href:"<?php echo U('Admin/Rbac/addRole');?>"
                                                    }

                                                ]
                                    },
                                    {
                                        text:'权限管理',
                                        items:
                                                [

                                                    {
                                                        id:'8',text:'权限管理',href:"<?php echo U('Admin/Rbac/nodeList');?>"
                                                    },
                                                    {
                                                        id:'9',text:'添加权限',href:"<?php echo U('Admin/Rbac/addNode');?>"
                                                    }

                                                ]
                                    }
                                ]
                    },<?php endif; ?>
                 <?php if($wechat): ?>{
                        id:'5',
                        menu:
                                [
                                    {
                                        text:'微信留言',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'未回留言',href:"<?php echo U('Admin/Wechat/guestbook');?>?type=0"
                                                    },
                                                    {
                                                        id:'2',text:'微信留言',href:"<?php echo U('Admin/Wechat/guestbook');?>?type=1"
                                                    }
                                                ]
                                    },
                                    {
                                        text:'微信设置',
                                        items:
                                                [
                                                    {
                                                        id:'3',text:'连接微信',href:"<?php echo U('Admin/Wechat/connect');?>"
                                                    },
                                                    {
                                                        id:'4',text:'关注列表',href:"<?php echo U('Admin/Wechat/userlist');?>"
                                                    },
                                                    {
                                                        id:'5',text:'创建菜单',href:"<?php echo U('Admin/Wechat/createmenu');?>"
                                                    },
                                                    {
                                                        id:'6',text:'获取菜单',href:"<?php echo U('Admin/Wechat/getmenu');?>"
                                                    }
                                                ]
                                    },
                                    {
                                        text:'消息回复',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'未回微信',href:"<?php echo U('Admin/Wechat/msgreply');?>?type=0"
                                                    },
                                                    {
                                                        id:'2',text:'微信消息',href:"<?php echo U('Admin/Wechat/msgreply');?>?type=1"
                                                    }
                                                ]
                                    }
                                ]
                    },<?php endif; ?>
                <?php if($setting): ?>{
                        id:'6',
                        menu:
                                [
                                    {
                                        text:'网站设置',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'网站信息',href:"<?php echo U('Admin/Setting/infoset');?>"
                                                    }

                                                ]
                                    }

                                ]
                    },<?php endif; ?>
                    {
                        id:'7',
                        menu:
                                [
                                    {
                                        text:'个人信息',
                                        items:
                                                [
                                                    {
                                                        id:'1',text:'修改个人信息',href:"<?php echo U('Admin/User/editinfo',array('id'=>$user['id']));?>"},
                                                    {
                                                        id:'2',text:'修改密码',href:"<?php echo U('Admin/User/editpwd',array('id'=>$user['id']));?>"}

                                                ]
                                    }

                                ]
                    }
        ];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>

</body>
</html>
<?php
return array(
    //'配置项'=>'配置值'
    /**
     * +------------------------------------------------------------------------------
     * 数据库配置
     * +------------------------------------------------------------------------------
     */
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'ewebcmsxgc', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '', // 密码
    'DB_PORT' => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET' => 'utf8',

    /**
     * +------------------------------------------------------------------------------
     * 基于角色的数据库方式验证类
     * +------------------------------------------------------------------------------
     */
    'RBAC_SUPERADMIN' => 'admin',//超级管理员用户名,对应admins数据表中的用户名
    'ADMIN_AUTH_KEY' => 'superadmin',
    'USER_AUTH_ON' => true,//是否需要认证
    'USER_AUTH_TYPE' => 1,//认证类型
    'USER_AUTH_KEY' => 'authId', //认证识别号
    //'REQUIRE_AUTH_MODULE' =>  '',//需要认证模块
    'NOT_AUTH_MODULE' => 'Index,Main', //无需认证模块//上面和这个一样,注释上面
    'NOT_AUTH_ACTION' => 'add,edit',//无需认证操作
    //'USER_AUTH_GATEWAY' => //认证网关,  //此处不需要
    //'RBAC_DB_DSN' => 'mysql://root:123456@localhost:3306/ewebcms2', // 数据库连接DSN // 公用的连接,此处不用
    'RBAC_ROLE_TABLE' => 'role',//角色表名称
    'RBAC_USER_TABLE' => 'role_user',// 用户表名称
    'RBAC_ACCESS_TABLE' => 'access',//权限表名称
    'RBAC_NODE_TABLE' => 'node',//节点表名称

        //Rewrite模式
    'URL_MODEL'=>2,

    'TMPL_PARSE_STRING' => array(
        '__HOME__' => __ROOT__ . '/Public/Home/',
    ),
    
);
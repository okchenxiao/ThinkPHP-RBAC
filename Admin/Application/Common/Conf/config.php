<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'rbac',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(
        PDO::ATTR_CASE      =>  PDO::CASE_NATURAL
    ), // 数据库连接参数

    'SESSION_PREFIX'        =>  'Admin', // session 前缀
    'COOKIE_PREFIX'        =>  'Admin', // session 前缀

    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    //设置静态常量
    'TMPL_PARSE_STRING'     =>  array(
        '__CSS__'           =>  MY_URL.'/Public/css',
        '__JS__'            =>  MY_URL.'/Public/js',
        '__IMG__'           =>  MY_URL.'/Public/img',
        '__IMAGE__'           =>  MY_URL.'/Public/image',
    ),
    //分页工具的
    'PAGE'                  =>  array(
        'SIZE'              =>  15,//每页显示条数
        'THEME'             =>  '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    ),

    /* 默认设定 */
    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Users', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称

    'TMPL_LAYOUT_ITEM'      =>  '{__CONTENT__}', // 布局模板的内容替换标识
    'LAYOUT_ON'             =>  true, // 是否启用布局
    'LAYOUT_NAME'           =>  'Layout/layout', // 当前布局名称 默认为layout
);
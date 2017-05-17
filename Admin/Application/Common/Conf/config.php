<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'rbac',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '',        // 端口
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
    ),
    //分页工具的
    'PAGE'                  =>  array(
        'SIZE'              =>  10,//每页显示条数
        'THEME'             =>  '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    ),
);
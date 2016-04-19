<?php
return array(
	//'配置项'=>'配置值'
    //调试模式
    'SHOW_PAGE_TRACE' =>true,
    //数据库配置
    'DB_TYPE'               =>  'MYSQL',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 数据库地址
    'DB_NAME'               =>  'jf_system',          // 数据库名称
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 数据库端口
    'DB_PREFIX'             =>  'jf_',    // 表名前缀
    'DB_FIELDTYPE_CHECK'    =>  false,
    'DB_FIELDS_CACHE'       =>  true,
    'DB_CHARSET'            =>  'utf8',      // 数据库编码

    // 配置邮件发送服务器
    'MAIL_HOST' =>'smtp.qq.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_PORT'=>465,
    'MAIL_USERNAME' =>'xxx@qq.com',//你的邮箱名
    'MAIL_FROM' =>'xxx@qq.com',//发件人地址
    'MAIL_FROMNAME'=>'教辅系统',//发件人姓名
    'MAIL_PASSWORD' =>'xxxxx',//邮箱smtp服务密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
);
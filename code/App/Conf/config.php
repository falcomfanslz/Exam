<?php
return array(
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'exam', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'prc_', // 数据库表前缀
	
	'TMPL_PARSE_STRING' =>  array( // 添加输出替换
	'__PUBLIC__' => __ROOT__.'/app/Public'
    ),
	'APP_GROUP_LIST' => 'Teacher,Home,Student', //项目分组设定 待定
	'DEFAULT_GROUP'  => 'Home' //默认分组
);
?>
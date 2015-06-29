<?php	
return array ( 
		'DB_TYPE' => 'mysql',
		'DB_HOST' => 'localhost',
		'DB_NAME' => 'examination',
		'DB_USER' => 'root',
		'DB_PWD' => '',
		'DB_PORT' => 3306,
		'DB_PREFIX' => 'exam_',
		'TMPL_PARSE_STRING' => array ( 
							'__PUBLIC__' => __ROOT__.'/App/Public', ),
		'APP_GROUP_LIST' => 'Teacher,Home,Admin,Printer,Dean',
		'DEFAULT_GROUP' => 'Home',
		'DEFAULT_CHARSET' => 'UTF-8'
	);
?>
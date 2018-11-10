<?php
return array(
	//'配置项'=>'配置值'
	//
	
	//模版常量
	'TMPL_PARSE_STRING' => array(
		'__ADMIN__' => __ROOT__.'/Public/Admin',
	),


	 /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     	 // 数据库类型
    /*'DB_HOST'             =>  'localhost', 	 // 服务器地址*/
    'DB_HOST'               =>  '212.64.25.152', 	 // 服务器地址
    'DB_NAME'               =>  'db_oa',         // 数据库名
    'DB_USER'               =>  'ted',      	 // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',          // 端口
    'DB_PREFIX'             =>  'sp_',    		 // 数据库表前缀
    'SHOW_PAGE_TRACE'       =>  false,
);
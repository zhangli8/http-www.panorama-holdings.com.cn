<?php

if(!defined('GUY')){
	exit('getout!');
}
header('content-type:text/html;charset=utf-8');
require 'global.func.php';
define('HOST','47.90.35.97');
define('USER','root');
define('PASSWORD','zhangli123');
define('DB','naccc');
$_conn=@mysql_connect(HOST,USER,PASSWORD) or die('MYSQL连接错误');
@mysql_select_db(DB) or die('数据库连接错误');
@mysql_query('set names utf8') or die('query字符集错误');

$_result=mysql_query("select * from system");
if(!!$_rows=mysql_fetch_array($_result)){
	$_system=array();
	$_system['name']=$_rows['name'];
	$_system['pagenums']=$_rows['pagenums'];
	$_system['newsnums']=$_rows['newsnums'];
	$_system['hotnums']=$_rows['hotnums'];
	$_system['copy']=$_rows['copy'];	
}else{
	echoalert('系统配置错误!');
	exit;
}
?>
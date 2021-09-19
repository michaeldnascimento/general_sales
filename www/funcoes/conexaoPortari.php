<?php
/*
$servidor 	  = 'rstelecom.mysql.uhserver.com';
$usuario  	  = 'portari';
$senha    	  = 'Brasil@2016';
$baseDados    = 'rstelecom';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");
$linkComMysql->set_charset("utf8");
ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout',300);

$servidor 	  = 'localhost';
$usuario  	  = 'root';
$senha    	  = '';
$baseDados    = 'portari';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

*/

if ($_SESSION['empresa'] == '001'){
//$servidor 	  = 'rstelecom.mysql.uhserver.com';
//$usuario  	  = 'portari';
//$senha    	  = 'Brasil@2016';
//$baseDados    = 'rstelecom';

$servidor 	  = 'db_server';
$usuario  	  = 'general';
$senha    	  = 'general2021';
$baseDados    = 'db_general';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");
$linkComMysql->set_charset("utf8");
ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout',300);
}

if ($_SESSION['empresa'] == '003'){
$servidor 	  = 'vendasnet.mysql.uhserver.com';
$usuario  	  = 'vendasnet';
$senha    	  = 'Brasil@2016';
$baseDados    = 'vendasnet';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");
$linkComMysql->set_charset("utf8");
ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout',300);
}

if ($_SESSION['empresa'] == '005'){
$servidor 	  = 'amg.mysql.uhserver.com';
$usuario  	  = 'amg';
$senha    	  = 'Brasil@2016';
$baseDados    = 'amg';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");
$linkComMysql->set_charset("utf8");
ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout',300);
}

if ($_SESSION['empresa'] == '10'){
$servidor 	  = 'netville.mysql.uhserver.com';
$usuario  	  = 'netville';
$senha    	  = 'Brasil@2016';
$baseDados    = 'netville';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");
$linkComMysql->set_charset("utf8");
ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout',300);
}

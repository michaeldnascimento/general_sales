<?php
session_start();

if ($_SESSION['empresa'] == '001'){
$servidor 	  = 'rstelecom.mysql.uhserver.com';
$usuario  	  = 'portari';
$senha    	  = 'Brasil@2016';
$baseDados    = 'rstelecom';


$link = mysql_connect($servidor, $usuario, $senha);
mysql_select_db($baseDados);
}

if ($_SESSION['empresa'] == '10'){
$servidor 	  = 'netville.mysql.uhserver.com';
$usuario  	  = 'netville';
$senha    	  = 'Brasil@2016';
$baseDados    = 'netville';


$link = mysql_connect($servidor, $usuario, $senha);
mysql_select_db($baseDados);
}

 
require 'exportcsv.inc.php';
$table = $_POST['lista_csv']; // aqui vai o nome da tabela que voce quer exportar 


//echo $table;
//exit;

exportMysqlToCsv($table);
 
?>
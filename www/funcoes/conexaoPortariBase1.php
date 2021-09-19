<?php
header("Content-Type: text/html; charset=ISO-8859-1", true);

//$servidor     = 'portaribase1.mysql.uhserver.com';
//$usuario      = 'portaribase1';
//$senha        = 'Brasil@2016';
//$baseDados    = 'portaribase1';

$servidor 	  = 'db_server';
$usuario  	  = 'general';
$senha    	  = 'general2021';
$baseDados    = 'db_general';


$linkComMysql = mysqli_connect($servidor , $usuario, $senha, $baseDados) or die("Problemas na conexao.");
?>
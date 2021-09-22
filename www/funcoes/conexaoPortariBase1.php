<?php
require __DIR__ . '/../vendor/autoload.php';
use \App\Common\Environment;

//CARREGA AS VARIAVEIS DE AMBIENTE DO PROJETO
Environment::load(__DIR__. '/../');

header("Content-Type: text/html; charset=ISO-8859-1", true);
$linkComMysql = mysqli_connect(getenv('RDS_MYSQL_HOST') , getenv('RDS_MYSQL_USER'), getenv('RDS_MYSQL_PASS'), getenv('RDS_MYSQL_DB')) or die("Problemas na conexão.");

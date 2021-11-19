<?php
require __DIR__ . '/../vendor/autoload.php';
use \App\Common\Environment;

//CARREGA AS VARIAVEIS DE AMBIENTE DO PROJETO
Environment::load(__DIR__. '/../');

if ($_SESSION['empresa'] == '001'){

$linkComMysql = mysqli_connect(getenv('DOCKER_MYSQL_HOST') , getenv('DOCKER_MYSQL_USER'), getenv('DOCKER_MYSQL_PASS'), getenv('DOCKER_MYSQL_DB')) or die("Problemas na conexão.");
$linkComMysql->set_charset("utf8");
ini_set('mysqli.connect_timeout',300);
ini_set('default_socket_timeout',300);

//try {
//    $linkComMysql = new PDO("mysql:host=".getenv('DOCKER_MYSQL_HOST').";dbname=".getenv('DOCKER_MYSQL_DB')."", getenv('DOCKER_MYSQL_USER'), getenv('DOCKER_MYSQL_PASS'));
//    $linkComMysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch(PDOException $e) {
//    echo 'ERROR: ' . $e->getMessage();
//}
}

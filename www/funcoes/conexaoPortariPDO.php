<?php
require __DIR__ . '/../vendor/autoload.php';
use \App\Common\Environment;

//CARREGA AS VARIAVEIS DE AMBIENTE DO PROJETO
Environment::load(__DIR__. '/../');

if ($_SESSION['empresa'] == '001'){

try {
    $linkComMysql = new PDO("mysql:host=".getenv('DOCKER_MYSQL_HOST').";dbname=".getenv('DOCKER_MYSQL_DB')."", getenv('DOCKER_MYSQL_USER'), getenv('DOCKER_MYSQL_PASS'),
    array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
    ));
    $linkComMysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

}

<?php
require __DIR__ . '/../vendor/autoload.php';
use \App\Common\Environment;

//CARREGA AS VARIAVEIS DE AMBIENTE DO PROJETO
Environment::load(__DIR__. '/../');

if ($_SESSION['empresa'] == '001'){

try {
    $linkComMysql = new PDO("mysql:host=".getenv('MYSQL_HOST').";dbname=".getenv('MYSQL_DB')."", getenv('MYSQL_USER'), getenv('MYSQL_PASS'),
    array(
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
    ));
    $linkComMysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

}

if ($_SESSION['empresa'] == '002'){

    try {
        $linkComMysql = new PDO("mysql:host=".getenv('MYSQL_HOST').";dbname=".getenv('MYSQL_DB_02')."", getenv('MYSQL_USER'), getenv('MYSQL_PASS'),
            array(
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            ));
        $linkComMysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

}

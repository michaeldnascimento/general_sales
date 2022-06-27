<?php
session_start();
require_once dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'funcoes/conexaoPortari.php';

//SELECT OPERADORA
$sql = "SELECT id, name FROM operadora WHERE status = 1  ORDER BY name";
$result = mysqli_query($linkComMysql, $sql);
$operadora = array();

if (mysqli_num_rows($result) > 0) {
    while ($op = mysqli_fetch_assoc($result)) {
        $operadora[] = array(
            'id' => $op['id'],
            'name' => $op['name'],
        );
    }
}else{
        $operadora = false;
}

header("Content-type=application/json; charset=utf-8");
print(json_encode($operadora));

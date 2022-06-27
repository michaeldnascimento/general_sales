<?php
session_start();
require_once dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'funcoes/conexaoPortari.php';

$operadora = trim(strtoupper($_POST['internetoperadora']));

//SELECT OPERADORA
$sql = "SELECT id, nome, operadora FROM internet WHERE status = 1 AND operadora = '$operadora' ORDER BY nome";
$result = mysqli_query($linkComMysql, $sql);
$internet = array();

if (mysqli_num_rows($result) > 0) {
    while ($int = mysqli_fetch_assoc($result)) {
        $internet[] = array(
            'id' => $int['id'],
            'nome' => $int['nome'],
            'operadora' => $int['operadora'],
        );
    }
}else{
        $internet = false;
}

header("Content-type=application/json; charset=utf-8");
print(json_encode($internet));

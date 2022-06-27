<?php
session_start();
require_once dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'funcoes/conexaoPortari.php';


$nome = trim(strtoupper($_POST['nometelefone']));
$id = trim($_POST['idtelefone']);

if (isset($nome) && isset($id)) {

    $sql = "UPDATE telefonia SET nome='$nome' WHERE id=$id";

    if (mysqli_query($linkComMysql, $sql)) {
        $return = true;
    } else {
        $return = "Error updating record: " . mysqli_error($linkComMysql);
    }

    header("Content-type=application/json; charset=utf-8");
    print(json_encode($return));
}
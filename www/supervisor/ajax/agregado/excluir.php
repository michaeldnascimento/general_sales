<?php
session_start();
require_once dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'funcoes/conexaoPortari.php';

$id = trim($_POST['idagregado']);


if (isset($id)) {
    // sql to delete a record
    $sql = "DELETE FROM agregado WHERE id=$id";

    if (mysqli_query($linkComMysql, $sql)) {
        $result = true;
    } else {
        $result = "Error deleting record: " . $linkComMysql->error;
    }

    $linkComMysql->close();

    header("Content-type=application/json; charset=utf-8");
    print(json_encode($result));
}
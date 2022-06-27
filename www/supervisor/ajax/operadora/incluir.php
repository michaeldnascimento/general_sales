<?php
session_start();
require_once dirname(__FILE__, 4) . DIRECTORY_SEPARATOR . 'funcoes/conexaoPortari.php';

if (isset($_POST['txtnome'])) {

    //Operadora
    $name     = $_POST['txtnome'];

    // Check connection
    if (!$linkComMysql) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO operadora (name, status) VALUES ('$name', 1)";

    if (mysqli_query($linkComMysql, $sql)) {
        $result =  true;
    } else {
        $result =  "Error: " . $sql . "<br>" . mysqli_error($linkComMysql);
    }

    mysqli_close($linkComMysql);

header("Content-type=application/json; charset=utf-8");
print(json_encode($result));
}
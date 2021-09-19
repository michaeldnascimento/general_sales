<?php

session_start();
include_once "../login/verifica.php";
include_once '../funcoes/conexaoPortari.php';


unset($_SESSION['logado']);

$query = "UPDATE usuario SET user_login = '0' WHERE usuario_login = '$nomeUsuario'";
        $resultado  = mysqli_query($linkComMysql, $query);


header("location: entrar.php");
exit;

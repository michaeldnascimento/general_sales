<?php
session_start();


$mensagem = "";

if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];
	unset($_SESSION['mensagem']);
}


?>




<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="../css/imagens/16x16.png">
		<title>General Sales</title>


		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">



	</head>
	<body>

<!--****************mensagem sistema*********-->

<div id="main" class="container-fluid">
 <h5 class="titulo-mensagem"><?=$mensagem?></h5>

<div id="login" class="form bradius">
 <div class="logo"> <img src="../css/imagens/200x226.png" width="200" height="180"/></div>
        <div class="acomodar">
        	<form action="validacao.php" method="POST">
        	<label type="number">Empresa: </label>
            <input type="text" class="txt bradius" name="empresa" />
            <label type="text">Login: </label>
            <input type="text" class="txt bradius" name="login" />
            <label type="text">Senha: </label>
            <input type="password" class="txt bradius" name="senha" />
            <input type="submit" class="sb bradius" value="Entrar" />

            </form>
        <!--acomodar-->
        </div>
       <!--login-->
    </div>

    </div>




		<!--<div class="autor">Desenvolvido por:<br>Michael Douglas</div>-->

	</body>
      
       <!-- jQuery -->
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>


<style>

	body{
	background-image: url(../css/imagens/Background-login2.jpg);
	width: 100%;
    height: 100%;
    background-position: center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
    color: #2eaea0;
	}


</style>

</html>
<?php 
session_start();
if (intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
	$lista = strval($_GET['lista']);

			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";

	if ($lista == 'GENERAL') {
	$query = "UPDATE clientes SET flag = '1' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/oportunidades-site.php");
	exit;
	}


	if ($lista == 'GENERALCLARO') {
	$query = "UPDATE clientes SET flag = '1' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/leadNET-Claro.php");
	exit;
	}


}
	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na postagem de dados";

	}


$_SESSION['mensagem'] = $mensagem;
header("location: ../mailing/oportunidades-site.php");
exit;










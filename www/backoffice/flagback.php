<?php 

session_start();
if (intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
	$lista = strval($_GET['lista']);
				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

			$query = "UPDATE clientes SET flag = '2' WHERE id_cliente = $id ";
			$resultado  = mysqli_query($linkComMysql, $query);


/************************MENSAGENS DO SISTEMA ***************************************/

}
	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na postagem de dados";

	}

$_SESSION['mensagem'] = $mensagem;
header("location: consultar-vendabackoffice.php?id=$id&lista=$lista");


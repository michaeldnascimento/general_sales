<?php 

session_start();
if (intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

			$query = "UPDATE parceiros SET flag_parceiros = '2' WHERE id_cliente_parceiros = $id ";
			$resultado  = mysqli_query($linkComMysql, $query);

/************************MENSAGENS DO SISTEMA ***************************************/

}
	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na postagem de dados";

	}

$_SESSION['mensagem'] = $mensagem;
header("location: consultar-vendabackoffice.php?id=$id");


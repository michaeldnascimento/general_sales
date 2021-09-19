<?php 
session_start();
if (intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);

				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

			$query = "UPDATE clientes SET tabulacao_lixeira = '' WHERE id_cliente = $id ";
			$resultado  = mysqli_query($linkComMysql, $query);

}
	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na postagem de dados";

	}

$_SESSION['mensagem'] = $mensagem;
header("location: analise-lixeira.php?id=$id");

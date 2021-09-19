<?php
	if( $_SERVER['REQUEST_METHOD']=='POST' ){
		$arr = filter( $_POST['excluir'] );
		$lista = strval($_GET['lista']);



			//gera o $link com o banco de dados
		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		$query = 'DELETE FROM clientes WHERE id_cliente IN('.implode( ',', $arr ).')';

		
		}
		function filter( $dados ){
		$arr = Array();
		foreach( $dados AS $dado ) $arr[] = (int)$dado;
		return $arr;
		}

		$resultado  = mysqli_query($linkComMysql, $query);
		


			if ($resultado) {
			$mensagem = "Mailing(s) excluido(s)";
		    }   

		    else {
			$mensagem = "Nao foi possivel exluir o(s) mailing(s)";

			}

if ($lista == 'NAOVENDA') {
$_SESSION['mensagem'] = $mensagem;
header("location: nao-venda-geral.php");
exit;
}

if ($lista == 'ANALISE') {
$_SESSION['mensagem'] = $mensagem;
header("location: analise-lixeira.php");
exit;
}

$_SESSION['mensagem'] = $mensagem;
header("location: analise-lixeira.php");
exit;

?>
<?php
session_start();
$mailing = $_POST['mailing'];

include "../funcoes/conexaoPortari.php";
include "../funcoes/funcoes_geraisPortari.php";

$query = "UPDATE clientes SET status_mailing = 'ATIVO' WHERE id_mailing = '$mailing'";
		//echo $query;
	    //exit;

$resCliente  = mysqli_query($linkComMysql, $query);

		if ($resCliente){
		$mensagem = "Salvo com Sucesso";
		}

		else{
		$mensagem = "Nao foi possivel atualizar os dados de contato.
		por favor entra em contato com o administador do sistema";
		}



		$_SESSION['mensagem'] = $mensagem;
		header("location: gerenciador-mailing.php");
		exit;

?>





<!--

	if( $_SERVER['REQUEST_METHOD']=='POST' ){
		$arr = filter( $_POST['excluir'] );
		$lista = strval($_GET['lista']);

			//gera o $link com o banco de dados
		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		$query = 'UPDATE clientes SET status_mailing = "ATIVO" WHERE id_cliente IN('.implode( ',', $arr ).')';
		//echo $query;
		//exit;
		
		}
		function filter( $dados ){
		$arr = Array();
		foreach( $dados AS $dado ) $arr[] = (int)$dado;
		return $arr;
		}

		$resultado  = mysqli_query($linkComMysql, $query);
		


			if ($resultado) {
			$mensagem = "Inativados com Sucesso";
		    }   

		    else {
			$mensagem = "Nao foi possivel inativar o mailing";

			}

		if ($lista == 'MULTIBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listagem-multibase.php");
		exit;
		}

		if ($lista == 'SAC') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listagem-oportunidade-sac.php");
		exit;
		}

		if ($lista == 'CANCELADO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listagem-cancelados.php");
		exit;
		}

		if ($lista == 'PROPOSTAS') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listagem-propostasNET.php");
		exit;
		}

	    if ($lista == 'CANCELADOSCLARO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listagem-canceladosCLARO.php");
		exit;
		}
-->
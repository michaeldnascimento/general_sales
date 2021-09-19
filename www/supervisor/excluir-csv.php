<?php
session_start();
$mailing = $_POST['mailing'];
//echo $mailing;
//exit;

include "../funcoes/conexaoPortari.php";
include "../funcoes/funcoes_geraisPortari.php";

$query = "DELETE FROM clientes WHERE id_mailing = '$mailing' AND (motivo_cliente IS NULL OR motivo_cliente LIKE '%LIXEIRA%')";
		//echo $query;
	    //exit;

$resCliente  = mysqli_query($linkComMysql, $query);

		if ($resCliente){
		$mensagem = "Excluido com Sucesso";
		}

		else{
		$mensagem = "Nao foi possivel atualizar os dados de contato.
		por favor entra em contato com o administador do sistema";
		}



		$_SESSION['mensagem'] = $mensagem;
		header("location: gerenciador-mailing.php");
		exit;

?>


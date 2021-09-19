<?php
session_start();
$mailing = $_POST['mailing'];
$tabulacao = $_POST['tabulacao'];
//echo $tabulacao;

if ($tabulacao <> '') {

	$motivo = "motivo_cliente = " . "'".$tabulacao."'";

}

if ($tabulacao == '') {

		$motivo = "motivo_cliente IS NULL OR motivo_cliente = '' ";

}
//echo $motivo;
//exit;

include "../funcoes/conexaoPortari.php";
include "../funcoes/funcoes_geraisPortari.php";

$query = "UPDATE clientes SET nomeUsuario = '' , motivo_cliente = '' WHERE id_mailing = '$mailing' AND $motivo";
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
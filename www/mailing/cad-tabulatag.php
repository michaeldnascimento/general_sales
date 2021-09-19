<?php 
session_start();

$lista = strval($_GET['lista']);
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){


	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";


	$id 			       = $_POST['id_contato'];
	$tv_atual              = $_POST['tv_atual'];
	$fidelidade_tv         = $_POST['fidelidade_tv'];
	$internet_atual        = $_POST['internet_atual'];
	$fidelidade_internet   = $_POST['fidelidade_internet'];
	$telefonia_atual       = $_POST['telefonia_atual'];
	$fidelidade_telefonia  = $_POST['fidelidade_telefonia'];
	$movel_atual           = $_POST['movel_atual'];
	$fidelidade_movel      = $_POST['fidelidade_movel'];
	$custo_atual           = $_POST['custo_atual'];
	$sabendo_tag           = $_POST['sabendo_tag'];
	$saber_tag             = $_POST['saber_tag'];
	$experiencia_tag       = $_POST['experiencia_tag'];
	$obs_tag               = $_POST['obs_tag'];
	$origemCSV             = $_POST['origemCSV'];
	$data_venda            = $_POST['data_venda'];
	$hora_venda            = $_POST['hora_venda'];
	$lista_sistema         = $_POST['lista_sistema'];
	$nomeUsuario           = $_POST['nomeUsuario'];

	$campos = array(
	'tv_atual',
	'fidelidade_tv',
	'internet_atual',
	'fidelidade_internet',
	'telefonia_atual',
	'fidelidade_telefonia',
	'movel_atual',
	'fidelidade_movel',
	'custo_atual',
	'sabendo_tag',
	'saber_tag',
	'experiencia_tag',
	'obs_tag',
	'origemCSV',
	'data_venda',
	'hora_venda',
    'lista_sistema',
    'nomeUsuario'
	);

	$valores = array(
	$tv_atual,
	$fidelidade_tv,
	$internet_atual,
	$fidelidade_internet,
	$telefonia_atual,
	$fidelidade_telefonia,
	$movel_atual,
	$fidelidade_movel,
	$custo_atual,
	$sabendo_tag,
	$saber_tag,
	$experiencia_tag,
	$obs_tag,
	$origemCSV,
	$data_venda,
	$hora_venda,
    $lista_sistema,
    $nomeUsuario
	);



		$whereCliente = array('id_cliente' => $id);
		$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
		$resCliente  = mysqli_query($linkComMysql, $queryCliente);


//testes
//echo $queryCliente . "<br><br>";
//exit;	


		if ($resCliente) {
		$mensagem = "TABULACAO FOI SALVA COM SUCESSO";
		}

		else {
		$mensagem = "NAO FOI POSSIVEL SALVAR SUA TABULACAO";

		}


                if ($lista == 'TAG') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-tag.php");
				exit;
				}



} else{//se não veio o id
		$mensagem = "POR FAVOR TENTE NOVAMENTE, NAO FOI POSSIVEL SALVAR A TABULACAO.";



                if ($lista == 'TAG') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-tag.php");
				exit;
				}



}
 ?>
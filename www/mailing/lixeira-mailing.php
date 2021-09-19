<?php 
session_start();

$lista = strval($_GET['lista']);
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){


	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";
	

	$id 				= $_POST['id_contato'];
	$tabulacao_lixeira  = $_POST['tabulacao_lixeira'];

	$campos = array(
	'tabulacao_lixeira'
	);

	$valores = array(
	$tabulacao_lixeira
	);



		$whereCliente = array('id_cliente' => $id);
		$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
		$resCliente  = mysqli_query($linkComMysql, $queryCliente);


//testes
//echo $queryCliente . "<br><br>";
//exit;	

		if ($resCliente) {
		$mensagem = "CONCLUIDO MAILING FOI MOVIDO PARA LIXEIRA";
		}

		else {
		$mensagem = "NAO FOI POSSIVEL MOVER PARA LIXEIRA";

		}

		if ($lista == 'SP') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-SP.php");
			exit;
		}

		if ($lista == 'BR') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-BR.php");
			exit;
		}

		if ($lista == 'MT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Multi.php");
			exit;
		}

		if ($lista == 'CO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-CO.php");
			exit;
		}

		if ($lista == 'RX') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Reconex.php");
			exit;
		}

		if ($lista == 'UTI') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-UTI.php");
			exit;
		}

		if ($lista == 'CANCELADO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadMailing-Cancelados.php");
			exit;
		}

		if ($lista == 'PROSPECT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/tratando-Prospects-CSV.php");
			exit;
		}

		if ($lista == 'MULTIBASE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/multibase.php");
			exit;
		}

		if ($lista == 'PROPOSTAS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


} else{//se não veio o id
		$mensagem = "POR FAVOR TENTE NOVAMENTE, NAO FOI POSSIVEL MOVER PARA LIXEIRA.";


		if ($lista == 'SP') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/leadNET-SP.php");
		exit;
		}

		if ($lista == 'BR') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-BR.php");
			exit;
		}

		if ($lista == 'MT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Multi.php");
			exit;
		}

		if ($lista == 'CO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-CO.php");
			exit;
		}


		if ($lista == 'RX') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Reconex.php");
			exit;
		}

		if ($lista == 'UTI') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-UTI.php");
			exit;
		}

		if ($lista == 'CANCELADO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadMailing-Cancelados.php");
			exit;
		}

		if ($lista == 'PROSPECT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/tratando-Prospects-CSV.php");
			exit;
		}

		if ($lista == 'MULTIBASE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/multibase.php");
			exit;
		}

		if ($lista == 'PROPOSTAS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}

	header("location: ../mailing/leadNET-SP.php");
	exit;

	}
 ?>
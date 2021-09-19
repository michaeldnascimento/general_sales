<?php 
session_start();
if (intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
		$lista = strval($_GET['lista']);

			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";


			$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
			$resultado  = mysqli_query($linkComMysql, $query);

}
	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na postagem de dados";

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

	if ($lista == 'SL') {
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/leadNET-SUL.php");
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

    if ($lista == 'SITE') {
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/oportunidades-site.php");
	exit;
	}


   if ($lista == 'NVENDA') {
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../vendedor/consultar-naoVendas.php?id=207345");
	exit;
	}

	if ($lista == 'CANCELADOS') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/leadMailing-Cancelados.php");
	exit;
	}

    if ($lista == 'CANCELADOSCLARO') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/lead-cancelados-claro.php");
	exit;
	}

	if ($lista == 'PROSPECT') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/leadProspects.php");
	exit;
	}

	if ($lista == 'MULTIBASE') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/multibase.php");
	exit;
	}

	if ($lista == 'PROPOSTAS') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/lead-Propostas.php");
	exit;
	}

	if ($lista == 'OPORTUNIDADES') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/oportunidades-sac.php");
	exit;
	}


	if ($lista == 'CLARO') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../mailing/oportunidades-claro.php");
	exit;
	}

	if ($lista == 'RETORNO') {
	$query = "UPDATE clientes SET flag = '0' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);
	$_SESSION['mensagem'] = $mensagem;
	header("location: ../vendedor/minha-agendaRetornos.php");
	exit;
	}







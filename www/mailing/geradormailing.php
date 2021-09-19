<?php 
session_start();
include_once "../login/verifica.php";

if ($_POST['nomeUsuario'] !="" ) {


	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";

	$Nusuario    = $_POST['nomeUsuario'];
	$lista    	 = $_POST['lista'];

	$stringSql = " SELECT id_cliente, origemCSV, cidade_cliente, flag, lista_sistema, nomeUsuario FROM clientes WHERE lista_sistema = '$lista' AND (origemCSV != 'LEAD' AND origemCSV != 'SITE') AND (motivo_cliente IS NULL OR motivo_cliente = '') AND (nomeUsuario IS NULL OR nomeUsuario = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente DESC LIMIT 0, 1";


			//echo $stringSql . "<br><br>";
			//exit;

			//mando execultar a query no banco de dados
			$resut = mysqli_query($linkComMysql, $stringSql);
			$qtdClientes = mysqli_num_rows($resut);
			$clientes = array();

			while ($clien = mysqli_fetch_assoc($resut)) {
			$clientes[] = array(
			$id    = $clien ['id_cliente'],
			);
			}


	$query = "UPDATE clientes SET flag = '1', nomeUsuario = '$Nusuario' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);


//echo $query . "<br><br>";
//exit;


				if ($lista == 'TVBASE') {
				header("location: ../mailing/tvbase.php");
				exit;
				}

				if ($lista == 'MULTIBASE') {
				header("location: ../mailing/multibase.php");
				exit;
				}

				if ($lista == 'EXCLUSIVO') {
				header("location: ../mailing/leadExclusivo.php");
				exit;
				}

				if ($lista == 'PROSPECT') {
				header("location: ../mailing/prospect.php");
				exit;
				}

				if ($lista == 'CLARO') {
				header("location: ../mailing/leadNET-Claro.php");
				exit;
				}

				if ($lista == 'SKY') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-sac.php");
				exit;
				}

				if ($lista == 'TAG') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-tag.php");
				exit;
				}

				if ($lista == 'TIM') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-TIM.php");
				exit;
				}

				if ($lista == 'VIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-VIVO.php");
				exit;
				}

				if ($lista == 'HUNGHES') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-HUGHES.php");
				exit;
				}

				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-NET.php");
				exit;
				}

				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-NET.php");
				exit;
				}

			    if ($lista == 'GERAL') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-GERAL.php");
				exit;
				}

				if ($lista == 'CORPORATIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-corporativo.php");
				exit;
				}





}

                $mensagem = "ERRO";

				if ($lista == 'TVBASE') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/tvbase.php");
				exit;
				}

				if ($lista == 'MULTIBASE') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/multibase.php");
				exit;
				}

				if ($lista == 'EXCLUSIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadExclusivo.php");
				exit;
				}

				if ($lista == 'PROSPECT') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/prospect.php");
				exit;
				}

				if ($lista == 'CLARO') {
				header("location: ../mailing/leadNET-Claro.php");
				exit;
				}


				if ($lista == 'SKY') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-sac.php");
				exit;
				}

				if ($lista == 'TAG') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-tag.php");
				exit;
				}

				if ($lista == 'TIM') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-TIM.php");
				exit;
				}

				if ($lista == 'VIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-VIVO.php");
				exit;
				}

				if ($lista == 'HUNGHES') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-HUGHES.php");
				exit;
				}

				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-NET.php");
				exit;
				}

				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-NET.php");
				exit;
				}

			    if ($lista == 'GERAL') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-GERAL.php");
				exit;
				}

				if ($lista == 'CORPORATIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-corporativo.php");
				exit;
				}


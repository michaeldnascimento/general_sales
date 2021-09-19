<?php 
session_start();
include_once "../login/verifica.php";

if (strval($_GET['lista']) != '' ) {

    $Nusuario = strval($_GET['usuario']);
	   $lista = strval($_GET['lista']);


			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";

	$stringSql = " SELECT id_cliente, cidade_cliente, flag, lista_sistema, nomeUsuario FROM clientes WHERE (lista_sistema = 'PROPOSTAS' AND nomeUsuario IS NULL AND motivo_cliente IS NULL) AND (flag IS NULL AND status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente DESC LIMIT 0, 1";


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



				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-Propostas.php");
				exit;
				}


				if ($lista == 'CANCELADOS') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadMailing-Cancelados.php");
				exit;
				}

				if ($lista == 'CANCELADOSCLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-cancelados-claro.php");
				exit;
				}


				if ($lista == 'PROSPECT') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadProspects.php");
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

				if ($lista == 'OPORTUNIDADES') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-sac");
				exit;
				}

				if ($lista == 'PROSPECTNET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/prospectNET.php");
				exit;
				}

				if ($lista == 'CLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-claro.php");
				exit;
				}

				if ($lista == 'NAO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-site.php");
				exit;
				}

				if ($lista == 'CHECKLIST') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/checklist.php");
				exit;
				}

				if ($lista == 'EXCLUSIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadProspects.php");
				exit;
				}



}



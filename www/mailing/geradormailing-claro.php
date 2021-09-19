<?php 
session_start();
include_once "../login/verifica.php";

if ($_POST['nomeUsuario'] !="" ) {


	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";

	$Nusuario    = $_POST['nomeUsuario'];
	$lista    	 = $_POST['lista'];

	$stringSql = " SELECT id_cliente, cidade_cliente, flag, lista_sistema, nomeUsuario FROM clientes WHERE (lista_sistema = 'SP' OR lista_sistema = 'BR' OR lista_sistema = 'EXCLUSIVO' OR lista_sistema = 'PROSPECT') AND (motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA TV' OR motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA VIRTUA') AND (status_mailing IS NULL OR status_mailing = 'ATIVO')  AND (data_venda BETWEEN DATE_SUB(NOW(), INTERVAL 2 DAY) AND NOW()) AND (MONTH(data_venda) = MONTH(NOW())) ORDER BY id_cliente DESC LIMIT 0, 1";


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


		$query = "UPDATE clientes SET flag = '2', nomeUsuario = '$Nusuario' , lista_sistema = '$lista' WHERE id_cliente = $id ";
		$resultado  = mysqli_query($linkComMysql, $query);


		//echo $query . "<br><br>";
		//exit;

				if ($lista == 'OPCLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-claro.php");
				exit;
				}




}

                $mensagem = "ERRO";

				if ($lista == 'OPCLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-claro.php");
				exit;
				}


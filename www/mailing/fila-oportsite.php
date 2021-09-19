<?php 
session_start();
include_once "../login/verifica.php";

if (strval($_GET['lista']) != '' ) {

    $Nusuario = strval($_GET['usuario']);
	   $lista = strval($_GET['lista']);


			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";


	$stringSql = "SELECT id_cliente, nome_contato_cliente, motivo_cliente, cidade_cliente, estado_cliente, codigoAntigo_cliente, flag, lista_sistema, datahora_cad_cliente FROM clientes WHERE (motivo_cliente IS NULL OR motivo_cliente = 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO') AND (flag IS NULL OR flag = '0' OR flag = '1') AND (lista_sistema = 'SP' OR lista_sistema = 'BR') AND (datahora_cad_cliente BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()) AND (MONTH(datahora_cad_cliente) = MONTH(NOW())) ORDER BY id_cliente DESC LIMIT 10, 1";

			//echo $stringSql . "<br><br>";
			//exit;

			//mando execultar a query no banco de dados
			$resut = mysqli_query($linkComMysql, $stringSql);
			$qtdClientes = mysqli_num_rows($resut);
			$clientes = array();


			while ($clien = mysqli_fetch_assoc($resut)) {
			$clientes[] = array(
			$id              = $clien ['id_cliente'],
			$listasistema    = $clien ['lista_sistema'],
			);
			}

	$query = "UPDATE clientes SET flag = '2', nomeUsuario = '$Nusuario' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);


	header("location: tratando-oportsite.php?id=$id&lista=$lista");
	exit;


}else {

$mensagem = "Erro na postagem de dados";


				$_SESSION['mensagem'] = $mensagem;
				header("location: oportunidades-site.php");
				exit;





}




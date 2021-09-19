<?php 
session_start();
include_once "../login/verifica.php";

if (strval($_GET['lista']) != '' ) {

    $Nusuario = strval($_GET['usuario']);
	   $lista = strval($_GET['lista']);


			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";


	$stringSql = " SELECT id_cliente FROM clientes WHERE (lista_sistema = 'MULTIBASE' OR lista_sistema = 'PROPOSTAS') AND (nomeUsuario = '$nomeUsuario' AND motivo_cliente IS NULL) AND (flag IS NULL AND status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente DESC LIMIT 10, 1";

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


	header("location: tratando-CSV.php?id=$id&lista=$lista");
	exit;


}else {

$mensagem = "Erro na postagem de dados";


				$_SESSION['mensagem'] = $mensagem;
				header("location: leadProspects.php");
				exit;





}




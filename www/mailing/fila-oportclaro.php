<?php 
session_start();
include_once "../login/verifica.php";

if (strval($_GET['lista']) != '' ) {

    $Nusuario = strval($_GET['usuario']);
	   $lista = strval($_GET['lista']);


			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";


	$stringSql = "SELECT id_cliente, nome_contato_cliente, motivo_cliente, cidade_cliente, estado_cliente, codigoAntigo_cliente, flag, lista_sistema, datahora_cad_cliente, data_venda, hora_venda FROM clientes WHERE (motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA TV' OR motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA VIRTUA') AND (lista_sistema = 'SP' OR lista_sistema = 'BR' OR lista_sistema = 'OPORTUNIDADES' OR lista_sistema = 'PROPOSTAS') AND ( data_venda BETWEEN DATE_SUB(NOW(), INTERVAL 2 DAY) AND NOW()) AND (MONTH(data_venda) = MONTH(NOW())) ORDER BY hora_venda LIMIT 0, 1";

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

	$query = "UPDATE clientes SET flag = '1', nomeUsuario = '$Nusuario' WHERE id_cliente = $id ";
	$resultado  = mysqli_query($linkComMysql, $query);

	    if ($listasistema == 'SP' OR $listasistema == 'BR' OR $listasistema == 'RX' OR $listasistema == 'MT' OR $listasistema == 'UTI') {

          	header("location: tratando-oportsite.php?id=$id&lista=$lista");
	        exit;

        }

        if ($listasistema  == 'CANCELADOS' OR $listasistema  == 'PROSPECT' OR $listasistema  == 'MULTIBASE' OR $listasistema  == 'OPORTUNIDADES' OR $listasistema  == 'SITE' OR $listasistema == 'CLARO'  OR $listasistema  == 'LEADCLARO'  OR $listasistema  == 'CANCELADOSCLARO' OR $listasistema  == 'PROPOSTAS') {

          	header("location: tratando-CSV.php?id=$id&lista=$lista");
	        exit;

        }



}else {

$mensagem = "Erro na postagem de dados";


$_SESSION['mensagem'] = $mensagem;
header("location: leadNET-Claro.php");
exit;





}




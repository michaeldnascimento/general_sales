<?php
ini_set('default_charset', 'UTF-8');
session_start();

$mensagem = "";

if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {

		if (
		//dados do contato obrigatorios
		$_POST['statusPedido_venda_cliente'] !=""

		) {

				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";


				//vem do contratoresumo_venda.php
				$numero_proposta_cliente       = $_POST['numero_proposta_cliente'];
				$codigo_cliente                = $_POST['codigo_cliente'];
				$data_pre_agendamento_cliente  = $_POST['data_pre_agendamento_cliente'];
				$statusPedido_venda_cliente    = $_POST['statusPedido_venda_cliente'];
				$motivoPendencia_venda_cliente = $_POST['motivoPendencia_venda_cliente'];
				$observacao_pedido_cliente     = $_POST['observacao_pedido_cliente'];

				$idCliente           	   = $_GET['id'];


/*****************************************EDITAR clientes ***************************************/


				$campos = array(

	   			//vem do contratoresumo.php
	   			'numero_proposta_cliente',
	   			'codigo_cliente',
	   			'data_pre_agendamento_cliente',
	   			'statusPedido_venda_cliente',
	   			'motivoPendencia_venda_cliente',
	   			'observacao_pedido_cliente'
				);//campos da tabela cliente

				$valores = array(

	   			//vem do contratoresumo.php
	   			$numero_proposta_cliente,
	   			$codigo_cliente,
	   			$data_pre_agendamento_cliente,
	   			$statusPedido_venda_cliente,
	   			$motivoPendencia_venda_cliente,
	   			$observacao_pedido_cliente
				//$comprou_cliente
				);//valores cliente




				$whereCliente = array('ID_CLIENTE' => $idCliente);

				$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);

				//exit("TEXTO GERADO: {$queryCliente}");

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);


				if ($statusPedido_venda_cliente == 'CADASTRO-CONCLUIDO') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}else{
		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Salvo com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel atualizar os dados de contato.
								por favor entra em contato com o administador do sistema";
			    }

	}

			else{
				$mensagem = "Necessario preencher todos os campos";
			    }

}

	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na envio dos dados";

	}


$_SESSION['mensagem'] = $mensagem;
header("location: minhas-vendas.php");


 ?>
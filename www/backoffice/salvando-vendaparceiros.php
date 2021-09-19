<?php
session_start();
if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {

		if (
		//dados do contato obrigatorios
		$_POST['nome_cliente_parceiros'] !="" 

		) {


				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

//Cliente
$nome_contato_parceiros       	 = $_POST['nome_contato_parceiros'];
$nome_cliente_parceiros    		 = $_POST['nome_cliente_parceiros'];
$cidade_cliente_parceiros   	 = $_POST['cidade_cliente_parceiros'];
$estado_cliente_parceiros    	 = $_POST['estado_cliente_parceiros'];
$codigo_claro_cliente_parceiros  = $_POST['codigo_claro_cliente_parceiros'];
$ddd_fonevenda_cliente_parceiros = $_POST['ddd_fonevenda_cliente_parceiros'];
$fonevenda_cliente_parceiros     = $_POST['fonevenda_cliente_parceiros'];
$dddfone_cliente_parceiros  	 = $_POST['dddfone_cliente_parceiros'];
$fone_cliente_parceiros     	 = $_POST['fone_cliente_parceiros'];
$obsvenda_cliente_parceiros 	 = $_POST['obsvenda_cliente_parceiros'];
$nomeUsuarioBack_parceiros       = $_POST['nomeUsuarioBack_parceiros'];
$statusVenda_cliente_parceiros   = $_POST['statusVenda_cliente_parceiros'];
$data_inst_cliente_parceiros     = $_POST['data_inst_cliente_parceiros'];
$data_agendamento_cliente_parceiros = $_POST['data_agendamento_cliente_parceiros'];
$data_canc_cliente_parceiros     = $_POST['data_canc_cliente_parceiros'];
$motivoCanc_cliente_parceiros    = $_POST['motivoCanc_cliente_parceiros'];
$motivoQuebra_cliente_parceiros  = $_POST['motivoQuebra_cliente_parceiros'];
$auditoria_bko_parceiros         = $_POST['auditoria_bko_parceiros'];
$obs_bko_parceiros               = $_POST['obs_bko_parceiros'];

$idCliente           	         = $_GET['id'];


				$campos = array(
				'nome_contato_parceiros',
				'nome_cliente_parceiros',
				'cidade_cliente_parceiros',
				'estado_cliente_parceiros',
				'codigo_claro_cliente_parceiros',
				'ddd_fonevenda_cliente_parceiros',
				'fonevenda_cliente_parceiros',
	   			'dddfone_cliente_parceiros',
	   			'fone_cliente_parceiros',
	   			'obsvenda_cliente_parceiros',
	   			'nomeUsuarioBack_parceiros',
     			'statusVenda_cliente_parceiros',
     			'motivoCanc_cliente_parceiros',
      			'motivoQuebra_cliente_parceiros',
     			'auditoria_bko_parceiros',
      			'obs_bko_parceiros',
				);

				$valores = array(
				$nome_contato_parceiros,
				$nome_cliente_parceiros,
				$cidade_cliente_parceiros,
				$estado_cliente_parceiros,
				$codigo_claro_cliente_parceiros,
	   			$ddd_fonevenda_cliente_parceiros,
	   			$fonevenda_cliente_parceiros,
	   			$dddfone_cliente_parceiros,
	   			$fone_cliente_parceiros,
	   			$obsvenda_cliente_parceiros,
	   		    $nomeUsuarioBack_parceiros,
     			$statusVenda_cliente_parceiros,
     			$motivoCanc_cliente_parceiros,
      			$motivoQuebra_cliente_parceiros,
     			$auditoria_bko_parceiros,
      			$obs_bko_parceiros,

				);//valores cliente


				$whereCliente = array('ID_CLIENTE_PARCEIROS' => $idCliente);
				$queryCliente = gera_update($campos, $valores, 'parceiros', $whereCliente);
				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				if ($data_inst_cliente_parceiros != '') {
					$query = "UPDATE parceiros SET data_inst_cliente_parceiros = '$data_inst_cliente_parceiros' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

				if ($data_agendamento_cliente_parceiros != '') {
					$query = "UPDATE parceiros SET data_agendamento_cliente_parceiros = '$data_agendamento_cliente_parceiros' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

				if ($data_canc_cliente_parceiros != '') {
					$query = "UPDATE parceiros SET data_canc_cliente_parceiros = '$data_canc_cliente_parceiros' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

//echo $queryCliente;
//exit;

/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Cliente alterado com sucesso";
			    }

			else{
					$mensagem = "Não foi possivel atualizar os dados de contato.
								por favor entra em contato com o administador do sistema";
			    }

	}

			else{
				$mensagem = "É necessario preencher todos os campos";
			    }

}

	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na envio dos dados";

	}


			$_SESSION['mensagem'] = $mensagem;
			header("location: listavenda-parceiros.php");


 ?>
<?php
session_start();
if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {


		if (
		//dados do contato obrigatorios
		$_POST['tabulacao_chamado'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		//Cliente
		$tabulacao_chamado     	 = $_POST['tabulacao_chamado'];
		$codigoNET    			 = $_POST['codigoNET'];
		$propostaNET 	 		 = $_POST['propostaNET'];
		$cidade_chamado 	 	 = $_POST['cidade_chamado'];
		$descricao_chamado  	 = $_POST['descricao_chamado'];
		$nome_vendedor 			 = $_POST['nome_vendedor'];
		$data_chamado 		     = $_POST['data_chamado'];
		$hora_chamado     		 = $_POST['hora_chamado'];
		$situacao_chamado     	 = $_POST['situacao_chamado'];
		$nome_back     	         = $_POST['nome_back'];
		$dataAT_chamado     	 = $_POST['dataAT_chamado'];
		$horaAT_chamado     	 = $_POST['horaAT_chamado'];
		$descricaoRESP_chamado   = $_POST['descricaoRESP_chamado'];
		$idCliente           	 = $_GET['id'];

/************************************EDITAR clientes ***************************************/


				$campos = array(
				'tabulacao_chamado',
				'codigoNET',
				'propostaNET',
				'cidade_chamado',
				'descricao_chamado',
				'nome_vendedor',
				'data_chamado',
				'hora_chamado',
				'situacao_chamado',
				'nome_back',
				'dataAT_chamado',
				'horaAT_chamado',
				'descricaoRESP_chamado'

	   			
				);//campos da tabela cliente

				$valores = array(
				$tabulacao_chamado,
				$codigoNET,
				$propostaNET,
				$cidade_chamado,
				$descricao_chamado,
				$nome_vendedor,
	   			$data_chamado,
	   			$hora_chamado,
	   			$situacao_chamado,
	   			$nome_back,
				$dataAT_chamado,
				$horaAT_chamado,
				$descricaoRESP_chamado

				);//valores cliente


				$whereCliente = array('ID_CHAMADO' => $idCliente);
				$queryCliente = gera_update($campos, $valores, 'chamados', $whereCliente);
				$resCliente  = mysqli_query($linkComMysql, $queryCliente);


/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Salvo com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel salvar o chamado.
								Tente novamente, se persistir entre em contato com o administrador";
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
?>
<script>
	window.opener.location.reload();
	window.close();
</script>

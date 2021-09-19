<?php
session_start();

$mensagem = "";

if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['tabulacao_chamado'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		//Cliente
		$tabulacao_chamado     	 = utf8_decode(mb_strtoupper($_POST['tabulacao_chamado']));
		$codigoNET    			 = utf8_decode(mb_strtoupper($_POST['codigoNET']));
		$propostaNET 	 		 = utf8_decode(mb_strtoupper($_POST['propostaNET']));
		$cidade_chamado 	 	 = utf8_decode(mb_strtoupper($_POST['cidade_chamado']));
		$descricao_chamado  	 = utf8_decode(mb_strtoupper($_POST['descricao_chamado']));
		$nome_vendedor 			 = utf8_decode(mb_strtoupper($_POST['nome_vendedor']));
		$data_chamado 		     = utf8_decode(mb_strtoupper($_POST['data_chamado']));
		$hora_chamado     		 = utf8_decode(mb_strtoupper($_POST['hora_chamado']));
		$situacao_chamado     	 = utf8_decode(mb_strtoupper($_POST['situacao_chamado']));

/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'tabulacao_chamado',
				'codigoNET',
				'propostaNET',
				'cidade_chamado',
				'descricao_chamado',
				'nome_vendedor',
				'data_chamado',
				'hora_chamado',
				'situacao_chamado'

	   			
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
	   			$situacao_chamado

				);//valores cliente


				$queryCliente = gera_insert($campos, $valores, 'chamados');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);


/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Enviado com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel enviar o chamado.
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
			header("location: lista_chamadosVED.php");


 ?>
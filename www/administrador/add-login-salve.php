<?php
session_start();

$mensagem = "";

$lista = strval($_GET['lista']);
if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['login'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		//Cliente
		$obs     	    = $_POST['obs'];
		$nome    	    = $_POST['nome'];
		$cpf 	 		= $_POST['cpf'];
		$rg  			= $_POST['rg'];
		$data_nasc 	    = $_POST['data_nasc'];
		$origem 		= $_POST['origem'];
		$site_local     = $_POST['site_local'];
		$departamento   = $_POST['departamento'];
		$cargo    	 	= $_POST['cargo'];
		$matricula	    = $_POST['matricula'];
		$centro_custo   = $_POST['centro_custo'];
		$login          = $_POST['login'];
		$senha          = $_POST['senha'];
		$lista_login    = $_POST['lista_login'];
		$situacao_login = $_POST['situacao_login'];
		$data_reset     = $_POST['data_reset'];
		$data_caiu      = $_POST['data_caiu'];
		$enviado        = $_POST['enviado'];



/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'obs',
				'nome',
				'cpf',
				'rg',
				'data_nasc',
				'origem',
				'site_local',
	   			'departamento',
	   			'cargo',
	   			'matricula',
	   			'centro_custo',
	   			'login',
	   			'senha',
	   			'lista_login',
	   			'situacao_login',
	   			'data_reset',
	   			'data_caiu',
	   			'enviado'

				);//campos da tabela cliente

				$valores = array(
				$obs,
				$nome,
				$cpf,
				$rg,
				$data_nasc,
	   			$origem,
	   			$site_local,
	   			$departamento,
	   			$cargo,
	   			$matricula,
	   			$centro_custo,
	   			$login,
	   			$senha,
	   			$lista_login,
	   			$situacao_login,
	   			$data_reset,
	   			$data_caiu,
	   			$enviado

				);//valores cliente


				$queryCliente = gera_insert2($campos, $valores, 'logins');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);




/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Novo login salvo com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel salvar os dados do login.
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
	header("location: listacitrix.php");
	exit;


 ?>

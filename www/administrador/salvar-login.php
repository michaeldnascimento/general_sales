<?php
session_start();
if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {
	$lista = strval($_GET['lista']);

		if (
		//dados do contato obrigatorios
		$_POST['login'] !="" 

		) {



				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

				//Cliente
				$situacao_login    = $_POST['situacao_login'];
				$login             = $_POST['login'];
				$senha             = $_POST['senha'];
				$data_reset        = $_POST['data_reset'];
				$data_caiu         = $_POST['data_caiu'];
				$rg 	 	       = $_POST['rg'];
				$cpf 	     	   = $_POST['cpf'];
				$data_nasc 	       = $_POST['data_nasc'];
				$nome 	           = $_POST['nome'];
				$origem      	   = $_POST['origem'];
				$site_local        = $_POST['site_local'];
				$departamento      = $_POST['departamento'];
				$cargo             = $_POST['cargo'];
				$matricula         = $_POST['matricula'];
				$centro_custo      = $_POST['centro_custo'];
				$enviado           = $_POST['enviado'];

				$id_login          = $_GET['id'];



				$campos = array(
				'situacao_login',
				'login',
				'senha',
				'data_reset',
				'data_caiu',
				'rg',
	   			'cpf',
	   			'data_nasc',
	   			'nome',
	  			'origem',
	   			'site_local',
	   			'departamento',
	   		    'cargo',
	   			'centro_custo',
	   			'enviado'
				);

				$valores = array(
				$situacao_login,
				$login,
				$senha,
				$data_reset,
				$data_caiu,
				$rg,
	   			$cpf,
	   			$data_nasc,
	   			$nome,
	  			$origem,
	   			$site_local,
	   			$departamento,
	   		    $cargo,
	   			$centro_custo,
	   			$enviado
				);//valores cliente


				$whereCliente = array('id_login' => $id_login);
				$queryCliente = gera_update2($campos, $valores, 'logins', $whereCliente);
				$resCliente  = mysqli_query($linkComMysql, $queryCliente);
//echo $queryCliente;
//exit;
/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Dados salvo com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel atualizar os dados.
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






?>

<script>
	opener.location.reload(); window.close();
</script>

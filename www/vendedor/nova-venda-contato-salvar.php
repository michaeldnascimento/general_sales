<?php
session_start();

$mensagem = "";

if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['nome_contato_cliente'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		

		//Cliente
		$nome_contato_cliente     	 = $_POST['nome_contato_cliente'];
		$cidade_cliente 	 		 = $_POST['cidade_cliente'];
		$estado_cliente  			 = $_POST['estado_cliente'];
		$codigo_cliente   	         = $_POST['codigo_cliente'];
		$ddd_fone_cliente 		     = $_POST['ddd_fone_cliente'];
		$fone_cliente     		     = $_POST['fone_cliente'];
		$ddd_celular_cliente 		 = $_POST['ddd_celular_cliente'];
		$celular_cliente    	 	 = $_POST['celular_cliente'];
		$observacao_venda_cliente	 = $_POST['observacao_venda_cliente'];
		$nomeUsuario          		 = $_POST['nomeUsuario'];
		$nomeEquipe         		 = $_POST['nomeEquipe'];
		$nomeEmpresa                 = $_POST['nomeEmpresa'];
		$data_venda         	     = $_POST['data_venda'];
		$hora_venda         	     = $_POST['hora_venda'];
		$lista_sistema         	     = $_POST['lista_sistema'];
		$motivo_cliente         	 = $_POST['motivo_cliente'];
		$tipo_servico         	     = $_POST['tipo_servico'];




/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'nome_contato_cliente',
				'cidade_cliente',
				'estado_cliente',
				'codigo_cliente',
				'ddd_fone_cliente',
				'fone_cliente',
	   			'ddd_celular_cliente',
	   			'celular_cliente',
	   			'observacao_venda_cliente',
	   			'nomeUsuario',
	   			'nomeEquipe',
	   			'nomeEmpresa',
	   			'data_venda',
	   			'hora_venda',
	   			'lista_sistema',
	   			'motivo_cliente',
	   			'tipo_servico'

	   			
				);//campos da tabela cliente

				$valores = array(
				$nome_contato_cliente,
				$cidade_cliente,
				$estado_cliente,
				$codigo_cliente,
	   			$ddd_fone_cliente,
	   			$fone_cliente,
	   			$ddd_celular_cliente,
	   			$celular_cliente,
	   			$observacao_venda_cliente,
	   			$nomeUsuario,
	   			$nomeEquipe,
	   			$nomeEmpresa,
	   			$data_venda,
	   			$hora_venda,
	   			$lista_sistema,
	   			$motivo_cliente,
	   			$tipo_servico


				);//valores cliente


				$queryCliente = gera_insert($campos, $valores, 'clientes');

				//echo $queryCliente;
				//exit;

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);

			if ($motivo_cliente == 'VENDA - NOVO CLIENTE') {

			$query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO', statusPedido_venda_cliente = 'CADASTRO-PENDENTE', efetividade_contato = 'VENDA' WHERE ID_CLIENTE = $idCliente";
		    $resultado  = mysqli_query($linkComMysql, $query);


		    $_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/contratogerando_cliente.php?id=$idCliente&lista=$lista_sistema");
			exit;


 	        }

 	        if ($motivo_cliente == 'VENDA - UPGRADE + MULTI' ) {

			$query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO', statusPedido_venda_cliente = 'CADASTRO-PENDENTE', efetividade_contato = 'VENDA' WHERE ID_CLIENTE = $idCliente";
		    $resultado  = mysqli_query($linkComMysql, $query);


		    $_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/venda_simplificada.php?id=$idCliente&lista=$lista_sistema");
			exit;


 	        }

 	        if ($motivo_cliente == 'VENDA - BASE TV' ) {

			$query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO', statusPedido_venda_cliente = 'CADASTRO-PENDENTE', efetividade_contato = 'VENDA' WHERE ID_CLIENTE = $idCliente";
		    $resultado  = mysqli_query($linkComMysql, $query);


		    $_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/venda_basetv.php?id=$idCliente&lista=$lista_sistema");
			exit;


 	        }



/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Contato salvo com sucesso";
			    }

			else{
			$mensagem = "Erro nos dados! tente novamente.";
			$_SESSION['mensagem'] = $mensagem;
			?>
			<script> window.history.go(-1); </SCRIPT>;
			<?php
			exit;
		    }

	}

			else{
		    $mensagem = "Necessario preencher todos os campos obrigatorios.";
			$_SESSION['mensagem'] = $mensagem;
			?>
			<script> window.history.go(-1); </SCRIPT>;
			<?php
			exit;
			 }

}

	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na envio dos dados";

	}


			$_SESSION['mensagem'] = $mensagem;
			header("location: nova-venda-contato.php");


 ?>
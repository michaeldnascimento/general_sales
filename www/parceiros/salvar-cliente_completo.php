<?php
session_start();

$mensagem = "";

if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['nome_cliente'] !="" 

		) {





				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";



//Cliente
$nome_cliente       	     = utf8_decode(mb_strtoupper($_POST['nome_cliente']));
$nome_contato_cliente      	 = utf8_decode(mb_strtoupper($_POST['nome_contato_cliente']));
$rg_ie_cliente          	 = utf8_decode(mb_strtoupper($_POST['rg_ie_cliente']));
$cpf_cnpj_cliente         	 = utf8_decode(mb_strtoupper($_POST['cpf_cnpj_cliente']));
$data_nasc_cliente           = utf8_decode(mb_strtoupper($_POST['data_nasc_cliente']));
$tipo_pessoa_cliente		 = utf8_decode(mb_strtoupper($_POST['tipo_pessoa_cliente']));
$sexo_cliente			     = utf8_decode(mb_strtoupper($_POST['sexo_cliente']));
$nome_mae_cliente            = utf8_decode(mb_strtoupper($_POST['nome_mae_cliente']));
$email_cliente               = utf8_decode(mb_strtoupper($_POST['email_cliente']));
$ddd_fone_cliente 	 	     = utf8_decode(mb_strtoupper($_POST['ddd_fone_cliente']));
$fone_cliente 	     	     = utf8_decode(mb_strtoupper($_POST['fone_cliente']));
$ddd_celular_cliente 	     = utf8_decode(mb_strtoupper($_POST['ddd_celular_cliente']));
$celular_cliente 	         = utf8_decode(mb_strtoupper($_POST['celular_cliente']));
$ddd_fone3_cliente 	 	     = utf8_decode(mb_strtoupper($_POST['ddd_fone3_cliente']));
$fone3_cliente 	     	     = utf8_decode(mb_strtoupper($_POST['fone3_cliente']));
$ddd_fone4_cliente 	 	     = utf8_decode(mb_strtoupper($_POST['ddd_fone4_cliente']));
$fone4_cliente 	     	     = utf8_decode(mb_strtoupper($_POST['fone4_cliente']));
$cep_cliente 	     	     = utf8_decode(mb_strtoupper($_POST['cep_cliente']));
$endereco_cliente 	         = utf8_decode(mb_strtoupper($_POST['endereco_cliente']));
$enderecoNumero_cliente 	 = utf8_decode(mb_strtoupper($_POST['enderecoNumero_cliente']));
$enderecoComplemento_cliente = utf8_decode(mb_strtoupper($_POST['enderecoComplemento_cliente']));
$bairro_cliente 	         = utf8_decode(mb_strtoupper($_POST['bairro_cliente']));
$cidade_cliente      	     = utf8_decode(mb_strtoupper($_POST['cidade_cliente']));
$estado_cliente      	     = utf8_decode(mb_strtoupper($_POST['estado_cliente']));
$tv_venda_cliente            = utf8_decode(mb_strtoupper($_POST['tv_venda_cliente']));
$internet_venda_cliente      = utf8_decode(mb_strtoupper($_POST['internet_venda_cliente']));
$netfone_venda_cliente       = utf8_decode(mb_strtoupper($_POST['netfone_venda_cliente']));
$portfone_venda_cliente      = utf8_decode(mb_strtoupper($_POST['portfone_venda_cliente']));
$netcelular_venda_cliente    = utf8_decode(mb_strtoupper($_POST['netcelular_venda_cliente']));
$portcelular_venda_cliente   = utf8_decode(mb_strtoupper($_POST['portcelular_venda_cliente']));
$agregado_venda_cliente      = utf8_decode(mb_strtoupper($_POST['agregado_venda_cliente']));
$tipo_servico     		     = utf8_decode(mb_strtoupper($_POST['tipo_servico']));
$numPacote_venda_cliente     = utf8_decode(mb_strtoupper($_POST['numPacote_venda_cliente']));
$valor_venda_cliente         = utf8_decode(mb_strtoupper($_POST['valor_venda_cliente']));
$formaPagemento_cliente      = utf8_decode(mb_strtoupper($_POST['formaPagemento_cliente']));
$vencimentoPagamento_cliente = utf8_decode(mb_strtoupper($_POST['vencimentoPagamento_cliente']));
$pagamentoBanco_cliente      = utf8_decode(mb_strtoupper($_POST['pagamentoBanco_cliente']));
$pagamentoAgencia_cliente    = utf8_decode(mb_strtoupper($_POST['pagamentoAgencia_cliente']));
$pagamentoConta_cliente      = utf8_decode(mb_strtoupper($_POST['pagamentoConta_cliente']));
$foneContato_venda_cliente   = utf8_decode(mb_strtoupper($_POST['foneContato_venda_cliente']));
$observacao_venda_cliente    = utf8_decode(mb_strtoupper($_POST['observacao_venda_cliente']));
$motivo_cliente              = utf8_decode(mb_strtoupper($_POST['motivo_cliente']));
$statusVenda_venda_cliente   = utf8_decode(mb_strtoupper($_POST['statusVenda_venda_cliente']));
$lista_sistema  			 = utf8_decode(mb_strtoupper($_POST['lista_sistema']));
$flag          				 = utf8_decode(mb_strtoupper($_POST['flag']));
$nomeUsuario                 = utf8_decode(mb_strtoupper($_POST['nomeUsuario']));
$nomeEquipe         	     = utf8_decode(mb_strtoupper($_POST['nomeEquipe']));
$data_venda         	     = utf8_decode(mb_strtoupper($_POST['data_venda']));
$hora_venda         	     = utf8_decode(mb_strtoupper($_POST['hora_venda']));


/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'nome_cliente',
				'nome_contato_cliente',
				'rg_ie_cliente',
				'cpf_cnpj_cliente',
				'data_nasc_cliente',
				'tipo_pessoa_cliente',
				'sexo_cliente',
				'nome_mae_cliente',
				'email_cliente',
				'ddd_fone_cliente',
	   			'fone_cliente',
	   			'ddd_celular_cliente',
	   			'celular_cliente',
	   			'ddd_fone3_cliente',
	   			'fone3_cliente',
	   			'ddd_fone4_cliente',
	   			'fone4_cliente',
				'cep_cliente',
				'endereco_cliente',
				'enderecoNumero_cliente',
				'enderecoComplemento_cliente',
				'bairro_cliente',
	  			'cidade_cliente',
	   			'estado_cliente',
	   			'tv_venda_cliente',
	   			'internet_venda_cliente',
	   			'netfone_venda_cliente',
	   			'portfone_venda_cliente',
	   			'netcelular_venda_cliente',
	   			'portcelular_venda_cliente',
	   			'agregado_venda_cliente',
	   			'tipo_servico',
	   			'numPacote_venda_cliente',
	   			'valor_venda_cliente',
	   			'formaPagemento_cliente',
	   			'vencimentoPagamento_cliente',
	   			'pagamentoBanco_cliente',
	   			'pagamentoAgencia_cliente',
	   			'pagamentoConta_cliente',
	   			'foneContato_venda_cliente',
	   			'observacao_venda_cliente',
	   			'motivo_cliente',
	   			'statusVenda_venda_cliente',
	   			'lista_sistema',
	   			'flag',
	   			'nomeUsuario',
	   			'nomeEquipe',
	   			'data_venda',
	   			'hora_venda'

				);//campos da tabela cliente

				$valores = array(
				$nome_cliente,
				$nome_contato_cliente,
				$rg_ie_cliente,
				$cpf_cnpj_cliente,
				$data_nasc_cliente,
				$tipo_pessoa_cliente,
				$sexo_cliente,
				$nome_mae_cliente,
				$email_cliente,
				$ddd_fone_cliente,
	   			$fone_cliente,
	   			$ddd_celular_cliente,
	   			$celular_cliente,
	   			$ddd_fone3_cliente,
	   			$fone3_cliente,
	   			$ddd_fone4_cliente,
	   			$fone4_cliente,
				$cep_cliente,
				$endereco_cliente,
				$enderecoNumero_cliente,
				$enderecoComplemento_cliente,
				$bairro_cliente,
	  			$cidade_cliente,
	   			$estado_cliente,
	   			$tv_venda_cliente,
	   			$internet_venda_cliente,
	   			$netfone_venda_cliente,
	   			$portfone_venda_cliente,
	   			$netcelular_venda_cliente,
	   			$portcelular_venda_cliente,
	   			$agregado_venda_cliente,
	   			$tipo_servico,
	   			$numPacote_venda_cliente,
	   			$valor_venda_cliente,
	   			$formaPagemento_cliente,
	   			$vencimentoPagamento_cliente,
	   			$pagamentoBanco_cliente,
	   			$pagamentoAgencia_cliente,
	   			$pagamentoConta_cliente,
	   			$foneContato_venda_cliente,
	   			$observacao_venda_cliente,
	   			$motivo_cliente,
	   			$statusVenda_venda_cliente,
	   			$lista_sistema,
	   			$flag,
	   			$nomeUsuario,
	   			$nomeEquipe,
	   			$data_venda,
	   			$hora_venda

				);//valores cliente




				$queryCliente = gera_insert($campos, $valores, 'clientes');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);


/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Cliente alterado com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel atualizar os dados de contato.
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
			header("location: add-cliente_completoRS.php?id=$idCliente");


 ?>
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
$nome_cliente       	     = $_POST['nome_cliente'];
$nome_contato_cliente      	 = $_POST['nome_contato_cliente'];
$rg_ie_cliente          	 = $_POST['rg_ie_cliente'];
$cpf_cnpj_cliente         	 = $_POST['cpf_cnpj_cliente'];
$data_nasc_cliente           = $_POST['data_nasc_cliente'];
$tipo_pessoa_cliente		 = $_POST['tipo_pessoa_cliente'];
$sexo_cliente			     = $_POST['sexo_cliente'];
$nome_mae_cliente            = $_POST['nome_mae_cliente'];
$email_cliente               = $_POST['email_cliente'];
$ddd_fone_cliente 	 	     = $_POST['ddd_fone_cliente'];
$fone_cliente 	     	     = $_POST['fone_cliente'];
$ddd_celular_cliente 	     = $_POST['ddd_celular_cliente'];
$celular_cliente 	         = $_POST['celular_cliente'];
$ddd_fone3_cliente 	 	     = $_POST['ddd_fone3_cliente'];
$fone3_cliente 	     	     = $_POST['fone3_cliente'];
$ddd_fone4_cliente 	 	     = $_POST['ddd_fone4_cliente'];
$fone4_cliente 	     	     = $_POST['fone4_cliente'];
$origemCSV 	     	         = $_POST['origemCSV'];
$cep_cliente 	     	     = $_POST['cep_cliente'];
$endereco_cliente 	         = $_POST['endereco_cliente'];
$enderecoNumero_cliente 	 = $_POST['enderecoNumero_cliente'];
$enderecoComplemento_cliente = $_POST['enderecoComplemento_cliente'];
$observacao_cliente          = $_POST['observacao_cliente'];
$bairro_cliente 	         = $_POST['bairro_cliente'];
$cidade_cliente      	     = $_POST['cidade_cliente'];
$estado_cliente      	     = $_POST['estado_cliente'];
$tv_venda_cliente            = $_POST['tv_venda_cliente'];
$internet_venda_cliente      = $_POST['internet_venda_cliente'];
$netfone_venda_cliente       = $_POST['netfone_venda_cliente'];
$portfone_venda_cliente      = $_POST['portfone_venda_cliente'];
$netcelular_venda_cliente    = $_POST['netcelular_venda_cliente'];
$portcelular_venda_cliente   = $_POST['portcelular_venda_cliente'];
$plano_multi_cliente         = $_POST['plano_multi_cliente'];
$qtdchip_multi_cliente       = $_POST['qtdchip_multi_cliente'];
$agregado_venda_cliente      = $_POST['agregado_venda_cliente'];
$tipo_servico     		     = $_POST['tipo_servico'];
$numPacote_venda_cliente     = $_POST['numPacote_venda_cliente'];
$valor_venda_cliente         = $_POST['valor_venda_cliente'];
$formaPagemento_cliente      = $_POST['formaPagemento_cliente'];
$vencimentoPagamento_cliente = $_POST['vencimentoPagamento_cliente'];
$pagamentoBanco_cliente      = $_POST['pagamentoBanco_cliente'];
$pagamentoAgencia_cliente    = $_POST['pagamentoAgencia_cliente'];
$pagamentoConta_cliente      = $_POST['pagamentoConta_cliente'];
$foneContato_venda_cliente   = $_POST['foneContato_venda_cliente'];
$observacao_venda_cliente    = $_POST['observacao_venda_cliente'];
$motivo_cliente              = $_POST['motivo_cliente'];
$statusVenda_venda_cliente   = $_POST['statusVenda_venda_cliente'];
$lista_sistema  			 = $_POST['lista_sistema'];
$flag          				 = $_POST['flag'];
$nomeUsuario                 = $_POST['nomeUsuario'];
$nomeEquipe         	     = $_POST['nomeEquipe'];
$nomeEmpresa         	     = $_POST['nomeEmpresa'];
$login_net                   = $_POST['login_net'];
$data_venda         	     = $_POST['data_venda'];
$hora_venda         	     = $_POST['hora_venda'];
$operadora         	         = $_POST['operadora'];

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
                'origemCSV',
				'cep_cliente',
				'endereco_cliente',
				'enderecoNumero_cliente',
				'enderecoComplemento_cliente',
                'observacao_cliente',
				'bairro_cliente',
	  			'cidade_cliente',
	   			'estado_cliente',
	   			'tv_venda_cliente',
	   			'internet_venda_cliente',
	   			'netfone_venda_cliente',
	   			'portfone_venda_cliente',
	   			'netcelular_venda_cliente',
	   			'portcelular_venda_cliente',
	   			'plano_multi_cliente',
	   			'qtdchip_multi_cliente',
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
	   			'nomeEmpresa',
	   			'login_net',
	   			'data_venda',
	   			'hora_venda',
                'operadora'

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
                $origemCSV,
				$cep_cliente,
				$endereco_cliente,
				$enderecoNumero_cliente,
				$enderecoComplemento_cliente,
                $observacao_cliente,
				$bairro_cliente,
	  			$cidade_cliente,
	   			$estado_cliente,
	   			$tv_venda_cliente,
	   			$internet_venda_cliente,
	   			$netfone_venda_cliente,
	   			$portfone_venda_cliente,
	   			$netcelular_venda_cliente,
	   			$portcelular_venda_cliente,
	   		    $plano_multi_cliente,
	   			$qtdchip_multi_cliente,
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
	   			$nomeEmpresa,
	   			$login_net,
	   			$data_venda,
	   			$hora_venda,
                $operadora

				);//valores cliente

				$queryCliente = gera_insert($campos, $valores, 'clientes');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);


			    //exit("TEXTO GERADO: {$idCliente}");

//testes
//echo $queryCliente . "<br><br>";
//exit;

	/*
	//MODOS DE TESTE
	    1 exit("TEXTO GERADO: {$queryCliente}");
		2 exit($query);
		3 echo "<pre>";
		3 print_r($resCliente);		
	*/		

	

/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Cliente alterado com sucesso";
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
			header("location: ../mailing/contratoresumo_cliente.php?id=$idCliente");


 ?>
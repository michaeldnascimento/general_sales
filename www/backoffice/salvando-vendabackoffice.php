<?php
session_start();
if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {
	$lista = strval($_GET['lista']);

		if (
		//dados do contato obrigatorios
		$_POST['nome_cliente'] !="" 

		) {



				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

				//Cliente
				$nome_cliente       	     = $_POST['nome_cliente'];
				$nome_contato_cliente        = $_POST['nome_contato_cliente'];
				$parentesco_cliente          = $_POST['parentesco_cliente'];
				$cpf_cnpj_cliente         	 = $_POST['cpf_cnpj_cliente'];
				$codigoAntigo_cliente        = $_POST['codigoAntigo_cliente'];
				$numero_proposta_cliente     = $_POST['numero_proposta_cliente'];
				$fone_cliente 	     	     = $_POST['fone_cliente'];
				$celular_cliente 	         = $_POST['celular_cliente'];

				$cidade_cliente      	     = $_POST['cidade_cliente'];
				$estado_cliente      	     = $_POST['estado_cliente'];
				$observacao_venda_cliente    = $_POST['observacao_venda_cliente'];
				$tv_venda_cliente            = $_POST['tv_venda_cliente'];
				$internet_venda_cliente      = $_POST['internet_venda_cliente'];
				$netfone_venda_cliente       = $_POST['netfone_venda_cliente'];
				$portfone_venda_cliente      = $_POST['portfone_venda_cliente'];
				$netcelular_venda_cliente    = $_POST['netcelular_venda_cliente'];
				$portcelular_venda_cliente   = $_POST['portcelular_venda_cliente'];
				$plano_multi_cliente         = $_POST['plano_multi_cliente'];
				$qtdchip_multi_cliente       = $_POST['qtdchip_multi_cliente'];
				$agregado_venda_cliente      = $_POST['agregado_venda_cliente'];
				$tipo_servico			     = $_POST['tipo_servico'];
				$numPacote_venda_cliente     = $_POST['numPacote_venda_cliente'];
				$valor_venda_cliente         = $_POST['valor_venda_cliente'];
				$formaPagemento_cliente      = $_POST['formaPagemento_cliente'];
				$vencimentoPagamento_cliente = $_POST['vencimentoPagamento_cliente'];
				$pagamentoBanco_cliente      = $_POST['pagamentoBanco_cliente'];
				$pagamentoAgencia_cliente    = $_POST['pagamentoAgencia_cliente'];
				$pagamentoConta_cliente      = $_POST['pagamentoConta_cliente'];
				//vem do contratoresumo_venda.php
				$nomeUsuario           		   = $_POST['nomeUsuario'];
				$nomeEquipe         	       = $_POST['nomeEquipe'];
				$nomeEmpresa         	       = $_POST['nomeEmpresa'];
				$data_venda         	       = $_POST['data_venda'];
				$hora_venda         	       = $_POST['hora_venda'];
				$codigo_cliente                = $_POST['codigo_cliente'];
				//vem do consultar-vendabackoffice.php
				$nomeUsuarioBack   			   = $_POST['nomeUsuarioBack'];
				$nomeEquipeBack  			   = $_POST['nomeEquipeBack'];
				$nomeEmpresaBack         	   = $_POST['nomeEmpresaBack'];
				$hora_back   			       = $_POST['hora_back'];
				$data_back  			       = $_POST['data_back'];
				$statusVenda_venda_cliente     = $_POST['statusVenda_venda_cliente'];
				$data_inst_venda_cliente       = $_POST['data_inst_venda_cliente'];
				$data_ativacao                 = $_POST['data_ativacao'];
				$data_agendamento_venda_cliente= $_POST['data_agendamento_venda_cliente'];
				$periodo_agendamento_back      = $_POST['periodo_agendamento_back'];
				$statusPedido_venda_cliente    = $_POST['statusPedido_venda_cliente'];
				$data_canc_venda_cliente       = $_POST['data_canc_venda_cliente'];
				$motivoCanc_venda_cliente      = $_POST['motivoCanc_venda_cliente'];
				$motivoPendencia_venda_cliente      = $_POST['motivoPendencia_venda_cliente'];
				$motivoPendenciaVendedor_venda_cliente      = $_POST['motivoPendenciaVendedor_venda_cliente'];
				$motivoQuebra_venda_cliente    = $_POST['motivoQuebra_venda_cliente'];
				$observacaoBack_venda_cliente  = $_POST['observacaoBack_venda_cliente'];
				$statusChecklist               = $_POST['statusChecklist'];
				$multisales                    = $_POST['multisales'];
				$conexao                       = $_POST['conexao'];


				$extensao4 = strtolower(substr($_FILES['audio_multisales']['name'], - 4));
				$audio_multisales = strtoupper(md5(time()). $extensao4);
				$diretorio4 = "../audiomultisales/" . $audio_multisales;
				move_uploaded_file($_FILES['audio_multisales']['tmp_name'], $diretorio4);


				$idCliente           	       = $_GET['id'];



				$campos = array(
				'nome_cliente',
				'nome_contato_cliente',
				'parentesco_cliente',
				'cpf_cnpj_cliente',
				'codigoAntigo_cliente',
				'numero_proposta_cliente',
	   			'fone_cliente',
	   			'celular_cliente',
	  			'cidade_cliente',
	   			'estado_cliente',
	   			'observacao_venda_cliente',
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
	   			//vem do contratoresumo.php
	   		    'nomeUsuario',
	   			'nomeEquipe',
	   			'nomeEmpresa',
	   			'data_venda',
	   			'hora_venda',
	   			'codigo_cliente',
	   			////vem do consultar-vendabackoffice.php
	   			'nomeUsuarioBack',
	   			'nomeEquipeBack',
	   			'nomeEmpresaBack',
	   			'hora_back',
	   			'data_back',
	   			'statusVenda_venda_cliente',
	   			'periodo_agendamento_back',
	   			'statusPedido_venda_cliente',
	   			'motivoCanc_venda_cliente',
	   			'motivoQuebra_venda_cliente',
	   			'motivoPendencia_venda_cliente',
	   			'motivoPendenciaVendedor_venda_cliente',
	   			'observacaoBack_venda_cliente',
	   			'statusChecklist',
	   			'multisales',
	   			'conexao',
	   			'audio_multisales'

				);

				$valores = array(
				$nome_cliente,
				$nome_contato_cliente,
				$parentesco_cliente,
				$cpf_cnpj_cliente,
				$codigoAntigo_cliente,
				$numero_proposta_cliente,
	   			$fone_cliente,
	   			$celular_cliente,
	   			$cidade_cliente,
	   			$estado_cliente,
	   			$observacao_venda_cliente,
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
	   			//vem do contratoresumo.php
	   			$nomeUsuario,
				$nomeEquipe,
				$nomeEmpresa,
				$data_venda,
				$hora_venda,
	   			$codigo_cliente,
	   			////vem do consultar-vendabackoffice.php
	   			$nomeUsuarioBack,
	   			$nomeEquipeBack,
	   			$nomeEmpresaBack,
	   			$hora_back,
	   			$data_back,
	   			$statusVenda_venda_cliente,
	   			$periodo_agendamento_back,
	   			$statusPedido_venda_cliente,
	   			$motivoCanc_venda_cliente,
	   			$motivoQuebra_venda_cliente,
	   			$motivoPendencia_venda_cliente,
	   			$motivoPendenciaVendedor_venda_cliente,
	   			$observacaoBack_venda_cliente,
	   			$statusChecklist,
	   			$multisales,
	   			$conexao,
	   			$audio_multisales
				);//valores cliente


				$whereCliente = array('ID_CLIENTE' => $idCliente);
				$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				if ($data_inst_venda_cliente != '') {
					$query = "UPDATE clientes SET data_inst_venda_cliente = '$data_inst_venda_cliente' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

				if ($data_agendamento_venda_cliente != '') {
					$query = "UPDATE clientes SET data_agendamento_venda_cliente = '$data_agendamento_venda_cliente' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

				if ($data_canc_venda_cliente != '') {
					$query = "UPDATE clientes SET data_canc_venda_cliente = '$data_canc_venda_cliente' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}

				if ($data_ativacao != '') {
					$query = "UPDATE clientes SET data_ativacao = '$data_ativacao' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);
				}
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




		if ($lista == 'TRATARCONCLUIDA') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-tratar.php");
		exit;
		}

		if ($lista == 'TRATARPENDENCIA') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../supervisor/listavenda-backoffice-tratarpendentes.php");
		exit;
		}

		if ($lista == 'TRATARPARCEIROS') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-parceiros.php");
		exit;
		}

		if ($lista == 'QUEBRA') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-quebra.php");
		exit;
		}

		if ($lista == 'CONEXAO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-conexao.php");
		exit;
		}

		if ($lista == 'CREDITO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-credito.php");
		exit;
		}

		if ($lista == 'PENDENTE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-pendente.php");
		exit;
		}

		if ($lista == 'PENDENTE-VENDEDOR') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-pendente-vendedor.php");
		exit;
		}

		if ($lista == 'INSTALADO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-instalado.php");
		exit;
		}

		if ($lista == 'EMCADASTRO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-emcadastro.php");
		exit;
		}

		if ($lista == 'CANCELADO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-cancelado.php");
		exit;
		}

		if ($lista == 'AGENDADO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-agendado.php");
		exit;
		}

		if ($lista == 'REPROVADO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-reprovada.php");
		exit;
		}

		if ($lista == 'PARCEIROSCSV') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-parceiroscsv.php");
		exit;
		}

		if ($lista == 'MULTI') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-multi.php");
		exit;
		}


		if ($lista == 'NET') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-net.php");
		exit;
		}

	    if ($lista == 'CLARO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice-claro.php");
		exit;
		}



$_SESSION['mensagem'] = $mensagem;
?>

<script>

window.close();
window.opener.location.reload();
</script>

<?php
session_start();

$lista = strval($_GET['lista']);
$tratativa = strval($_GET['tratar']);
if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {

		if (
		//dados do contato obrigatorios
		$_POST['motivo_cliente'] !=""

		) {

				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

				//Cliente
				$nome_contato_cliente        = $_POST['nome_contato_cliente'];
				$codigoAntigo_cliente        = $_POST['codigoAntigo_cliente'];
				$cpf_cnpj_cliente            = $_POST['cpf_cnpj_cliente'];
				$ddd_fone_cliente 	         = $_POST['ddd_fone_cliente'];
				$fone_cliente 	      		 = $_POST['fone_cliente'];
				$ddd_celular_cliente  	     = $_POST['ddd_celular_cliente'];
				$celular_cliente     	     = $_POST['celular_cliente'];
				$ddd_fone3_cliente 	   		 = $_POST['ddd_fone3_cliente'];
				$fone3_cliente 	       		 = $_POST['fone3_cliente'];
				$ddd_fone4_cliente 	   		 = $_POST['ddd_fone4_cliente'];
				$fone4_cliente 	      	     = $_POST['fone4_cliente'];
				$cep_cliente 	     	     = $_POST['cep_cliente'];
				$endereco_cliente 	         = $_POST['endereco_cliente'];
				$enderecoNumero_cliente 	 = $_POST['enderecoNumero_cliente'];
				$enderecoComplemento_cliente = $_POST['enderecoComplemento_cliente'];
				$bairro_cliente 	         = $_POST['bairro_cliente'];
				$cidade_cliente      	     = $_POST['cidade_cliente'];
				$estado_cliente      	     = $_POST['estado_cliente'];
				$motivo_cliente       		 = $_POST['motivo_cliente'];
				$data_followup_cliente 	  	 = $_POST['data_followup_cliente'];
				$hora_followup_cliente 		 = $_POST['hora_followup_cliente'];

				$codigoAntigo_cliente   	 = $_POST['codigoAntigo_cliente'];
				$codigoAntigo_cliente        = str_replace("-", "", $codigoAntigo_cliente);
				$codigoAntigo_cliente        = str_replace("/", "", $codigoAntigo_cliente);

				$numero_proposta_cliente 	 = $_POST['numero_proposta_cliente'];
				$observacao_cliente     	 = $_POST['observacao_cliente'];
				$nomeUsuario           		 = $_POST['nomeUsuario'];
				$nomeEquipe         	     = $_POST['nomeEquipe'];
				$nomeEmpresa         	     = $_POST['nomeEmpresa'];
				$data_venda         	     = $_POST['data_venda'];
				$hora_venda         	     = $_POST['hora_venda'];
				$lista_sistema         	     = $_POST['lista_sistema'];
				$numHP_cliente         	     = $_POST['numHP_cliente'];

				$idCliente                   = $_GET['id'];
				//atualiza os dados do contato



/*****************************EDITAR clientes ***************************************/

				$campos = array(
				'nome_contato_cliente',
	   			'ddd_fone_cliente',
	   			'cpf_cnpj_cliente',
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
	   			'motivo_cliente',
	   			'data_followup_cliente',
	   			'hora_followup_cliente',
	   		    'codigoAntigo_cliente',
	   		    'numero_proposta_cliente',
	   			'observacao_cliente',
	   			'nomeUsuario',
	   			'nomeEquipe',
	   			'nomeEmpresa',
	   			'data_venda',
	   			'hora_venda',
	   			'lista_sistema',
	   			'numHP_cliente'
	   			//'comprou_cliente'
				);//campos da tabela cliente

				$valores = array(
				$nome_contato_cliente,
				$ddd_fone_cliente,
				$cpf_cnpj_cliente,
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
				$motivo_cliente,
				$data_followup_cliente,
				$hora_followup_cliente,
				$codigoAntigo_cliente,
				$numero_proposta_cliente,
				$observacao_cliente,
				$nomeUsuario,
				$nomeEquipe,
				$nomeEmpresa,
				$data_venda,
				$hora_venda,
				$lista_sistema,
				$numHP_cliente
				//$comprou_cliente
				);//valores cliente

				$whereCliente = array('ID_CLIENTE' => $idCliente);
				$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

//testes
//echo $queryCliente . "<br><br>";
//exit;


/**************************MENSAGENS DO SISTEMA ***************************************/

			if ($resCliente){
				$mensagem = "Salvo com sucesso";
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
		$_SESSION['mensagem'] = $mensagem;
		?>
		<script> window.history.go(-1); </SCRIPT>;
		<?php
		exit;

}

//se o motivo cliente for de um determinado grupo ele se direciona a pagina corespondente		
if ($motivo_cliente == 'VENDA - NOVO CLIENTE') {

			$query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO', statusPedido_venda_cliente = 'CADASTRO-PENDENTE', efetividade_contato = 'VENDA' WHERE ID_CLIENTE = $idCliente";
		    $resultado  = mysqli_query($linkComMysql, $query);

		    if ($tratativa == 'LEAD') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: contratogerando_cliente.php?id=$idCliente&lista=$lista");
			exit;
		    }

		    if ($tratativa == 'CSV') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: contratogerando_cliente.php?id=$idCliente&lista=$lista");
			exit;
		    }

		    if ($tratativa == 'OP') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: contratogerando_cliente.php?id=$idCliente&lista=$lista");
			exit;
		    }


 	}

if ($motivo_cliente == 'VENDA - UPGRADE + MULTI') {

			$query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO', statusPedido_venda_cliente = 'CADASTRO-PENDENTE', efetividade_contato = 'VENDA' WHERE ID_CLIENTE = $idCliente";
		    $resultado  = mysqli_query($linkComMysql, $query);

		    if ($tratativa == 'LEAD') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: venda_simplificada.php?id=$idCliente&lista=$lista");
			exit;
		    }

		    if ($tratativa == 'CSV') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: venda_simplificada.php?id=$idCliente&lista=$lista");
			exit;
		    }

		    if ($tratativa == 'OP') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: venda_simplificada.php?id=$idCliente&lista=$lista");
			exit;
		    }


 	}

if ($motivo_cliente == 'VENDA - BASE TV' ) {

			$query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO', statusPedido_venda_cliente = 'CADASTRO-PENDENTE', efetividade_contato = 'VENDA' WHERE ID_CLIENTE = $idCliente";
		    $resultado  = mysqli_query($linkComMysql, $query);

		    if ($tratativa == 'LEAD') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: venda_basetv.php?id=$idCliente&lista=$lista");
			exit;
		    }

		    if ($tratativa == 'CSV') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: venda_basetv.php?id=$idCliente&lista=$lista");
			exit;
		    }

		    if ($tratativa == 'OP') {
		    $_SESSION['mensagem'] = $mensagem;
			header("location: venda_basetv.php?id=$idCliente&lista=$lista");
			exit;
		    }


 	}




	if ($motivo_cliente == 'FOLLOW-UP') {

		$query = "UPDATE clientes SET efetividade_contato = 'EFETIVO' WHERE ID_CLIENTE = $idCliente";
		$resultado  = mysqli_query($linkComMysql, $query);


		if ($lista == 'SP') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-SP.php");
			exit;
		}

		if ($lista == 'BR') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-BR.php");
			exit;
		}

		if ($lista == 'MT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Multi.php");
			exit;
		}

		if ($lista == 'CO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-CO.php");
			exit;
		}

		if ($lista == 'RX') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Reconex.php");
			exit;
		}

		if ($lista == 'UTI') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-UTI.php");
			exit;
		}

	    if ($lista == 'CLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-claro.php");
			exit;
		}


		if ($lista == 'CANCELADOS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadMailing-Cancelados.php");
			exit;
		}

		if ($lista == 'CANCELADOSCLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-cancelados-claro.php");
			exit;
		}

		if ($lista == 'PROSPECT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/prospect.php");
			exit;
		}

		if ($lista == 'MULTIBASE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/multibase.php");
			exit;
		}

		if ($lista == 'PROPOSTAS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'NET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'SITE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-site.php");
			exit;
		}

		if ($lista == 'PROSPECTNET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/prospectNET.php");
			exit;
		}

		if ($lista == 'GENERAL') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/oportunidades-site.php");
		   exit;
		}

	    if ($lista == 'GENERALCLARO') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/leadNET-Claro.php");
		   exit;
		}


		if ($lista == 'TVBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/tvbase.php");
		exit;
		}

		if ($lista == 'MULTIBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/multibase.php");
		exit;
		}

		if ($lista == 'EXCLUSIVO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/leadExclusivo.php");
		exit;
		}

		if ($lista == 'PROSPECT') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/prospect.php");
		exit;
		}

	}

	if ($motivo_cliente == 'CORPORATIVO') {

		$query = "UPDATE clientes SET efetividade_contato = 'EFETIVO' , lista_sistema = 'CORPORATIVO' , nomeUsuario = NULL , origemCSV = 'LEAD' , motivo_cliente = NULL WHERE ID_CLIENTE = $idCliente";
		$resultado  = mysqli_query($linkComMysql, $query);


		if ($lista == 'SP') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-SP.php");
			exit;
		}

		if ($lista == 'BR') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-BR.php");
			exit;
		}

		if ($lista == 'MT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Multi.php");
			exit;
		}

		if ($lista == 'CO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-CO.php");
			exit;
		}

		if ($lista == 'RX') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Reconex.php");
			exit;
		}

		if ($lista == 'UTI') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-UTI.php");
			exit;
		}

	    if ($lista == 'CLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-claro.php");
			exit;
		}


		if ($lista == 'CANCELADOS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadMailing-Cancelados.php");
			exit;
		}

		if ($lista == 'CANCELADOSCLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-cancelados-claro.php");
			exit;
		}

		if ($lista == 'PROSPECT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/prospect.php");
			exit;
		}

		if ($lista == 'MULTIBASE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/multibase.php");
			exit;
		}

		if ($lista == 'PROPOSTAS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'NET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'SITE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-site.php");
			exit;
		}

		if ($lista == 'PROSPECTNET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/prospectNET.php");
			exit;
		}

		if ($lista == 'GENERAL') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/oportunidades-site.php");
		   exit;
		}

	    if ($lista == 'GENERALCLARO') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/leadNET-Claro.php");
		   exit;
		}


		if ($lista == 'TVBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/tvbase.php");
		exit;
		}

		if ($lista == 'MULTIBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/multibase.php");
		exit;
		}

		if ($lista == 'EXCLUSIVO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/leadExclusivo.php");
		exit;
		}

		if ($lista == 'PROSPECT') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/prospect.php");
		exit;
		}

	}



	if ($motivo_cliente == 'LIXEIRA - NAO ATENDE/ CAIXA POSTAL' OR $motivo_cliente == 'CORPORATIVO' OR $motivo_cliente == 'LIXEIRA - NAO TEM INTERESSE' OR $motivo_cliente == 'LIXEIRA - NAO TEM COBERTURA VIRTUA' OR $motivo_cliente == 'LIXEIRA - NAO TEM COBERTURA TV' OR $motivo_cliente == 'LIXEIRA - NUMERO INCORRETO/ BLOQUEADO' OR $motivo_cliente == 'LIXEIRA - CLIENTE REPETIDO' OR $motivo_cliente == 'LIXEIRA - CLIENTE JA CONTRATOU O SERVICO' OR $motivo_cliente == 'LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR' OR $motivo_cliente == 'LIXEIRA - DESCONECTADO -6 MESES' OR $motivo_cliente == 'LIXEIRA - SP1' OR $motivo_cliente == 'LIXEIRA - PROBLEMAS TECNICOS/LIGACAO COM PROBLEMAS' OR $motivo_cliente == 'LIXEIRA - OUTROS - ESPECIFICAR') {

		$query = "UPDATE clientes SET flag = '0', efetividade_contato = 'EFETIVO' WHERE id_cliente = $idCliente ";
			$resultado  = mysqli_query($linkComMysql, $query);


		if ($lista == 'SP') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-SP.php");
			exit;
		}

		if ($lista == 'BR') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-BR.php");
			exit;
		}

		if ($lista == 'MT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Multi.php");
			exit;
		}
		if ($lista == 'CO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-CO.php");
			exit;
		}

		if ($lista == 'RX') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Reconex.php");
			exit;
		}

		if ($lista == 'UTI') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-UTI.php");
			exit;
		}

	    if ($lista == 'CLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-claro.php");
			exit;
		}

		if ($lista == 'CANCELADOS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadMailing-Cancelados.php");
			exit;
		}

		if ($lista == 'CANCELADOSCLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-cancelados-claro.php");
			exit;
		}

		if ($lista == 'PROSPECT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadProspects.php");
			exit;
		}

		if ($lista == 'MULTIBASE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/multibase.php");
			exit;
		}

		if ($lista == 'PROPOSTAS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'NET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'SITE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-site.php");
			exit;
		}


		if ($lista == 'PROSPECTNET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/prospectNET.php");
			exit;
		}

	    if ($lista == 'GENERAL') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/oportunidades-site.php");
		   exit;
		}

	    if ($lista == 'GENERALCLARO') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/leadNET-Claro.php");
		   exit;
		}


		if ($lista == 'TVBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/tvbase.php");
		exit;
		}

		if ($lista == 'MULTIBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/multibase.php");
		exit;
		}

		if ($lista == 'EXCLUSIVO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/leadExclusivo.php");
		exit;
		}

		if ($lista == 'PROSPECT') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/prospect.php");
		exit;
		}

	}

	if ($motivo_cliente == 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO' OR $motivo_cliente == 'LIXEIRA - CLIENTE JA CONTRATOU O SERVICO' OR $motivo_cliente == 'LIXEIRA - CLIENTE REPETIDO') {

		$query = "UPDATE clientes SET flag = '0', efetividade_contato = 'NAO EFETIVO' WHERE id_cliente = $idCliente ";
			$resultado  = mysqli_query($linkComMysql, $query);

		if ($lista == 'SP') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-SP.php");
			exit;
		}

		if ($lista == 'BR') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-BR.php");
			exit;
		}

		if ($lista == 'MT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Multi.php");
			exit;
		}

		if ($lista == 'CO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-CO.php");
			exit;
		}

		if ($lista == 'RX') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-Reconex.php");
			exit;
		}

		if ($lista == 'UTI') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadNET-UTI.php");
			exit;
		}

	    if ($lista == 'CLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-claro.php");
			exit;
		}

		if ($lista == 'CANCELADOS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadMailing-Cancelados.php");
			exit;
		}

		if ($lista == 'CANCELADOSCLARO') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-cancelados-claro.php");
			exit;
		}

		if ($lista == 'PROSPECT') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/leadProspects.php");
			exit;
		}

		if ($lista == 'MULTIBASE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/multibase.php");
			exit;
		}

		if ($lista == 'PROPOSTAS') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}

		
		if ($lista == 'NET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/lead-Propostas.php");
			exit;
		}


		if ($lista == 'SITE') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/oportunidades-site.php");
			exit;
		}


		if ($lista == 'PROSPECTNET') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/prospectNET.php");
			exit;
		}

	    if ($lista == 'GENERAL') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/oportunidades-site.php");
		   exit;
		}

	    if ($lista == 'GENERALCLARO') {
		   $_SESSION['mensagem'] = $mensagem;
		   header("location: ../mailing/leadNET-Claro.php");
		   exit;
		}


		if ($lista == 'TVBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/tvbase.php");
		exit;
		}

		if ($lista == 'MULTIBASE') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/multibase.php");
		exit;
		}

		if ($lista == 'EXCLUSIVO') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/leadExclusivo.php");
		exit;
		}

		if ($lista == 'PROSPECT') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../mailing/prospect.php");
		exit;
		}

	}

		if ($motivo_cliente == 'CONCLUIDO' OR $motivo_cliente == 'CHECKLIST NAO OK' OR $motivo_cliente == 'NAO LOCALIZADO') {


		if ($lista == 'CHECKLIST') {
			$_SESSION['mensagem'] = $mensagem;
			header("location: ../mailing/checklist.php");
			exit;
		}

	}


if ($lista == 'CORPORATIVO') {
$_SESSION['mensagem'] = $mensagem;
?>
<script>

window.close();
window.opener.location.reload();
</script>
<?php
exit;
}


$_SESSION['mensagem'] = $mensagem;
header("location: ../vendedor/minhas-naoVendas.php");

?>
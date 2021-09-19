<?php
session_start();

$mensagem = "";
$dataDia = date('Ymd');
$horaDia = date('His');

if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['nome_cliente'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		//Cliente
		$nome_contato_cliente     	 = $_POST['nome_contato_cliente'];
		$nome_cliente    			 = $_POST['nome_cliente'];
		$cidade_cliente 	 		 = $_POST['cidade_cliente'];
		$estado_cliente  			 = $_POST['estado_cliente'];
		$codigo_cliente 			 = $_POST['codigo_cliente'];
		$fone_cliente     		     = $_POST['fone_cliente'];
		$celular_cliente    	 	 = $_POST['celular_cliente'];
		$fone3_cliente 	     	     = $_POST['fone3_cliente'];
        $fone4_cliente 	     	     = $_POST['fone4_cliente'];
		$observacao_venda_cliente	 = $_POST['observacao_venda_cliente'];
		$motivo_cliente         	 = $_POST['motivo_cliente'];
		$tv_venda_cliente            = $_POST['tv_venda_cliente'];
		$internet_venda_cliente      = $_POST['internet_venda_cliente'];
		$netfone_venda_cliente       = $_POST['netfone_venda_cliente'];
		$netcelular_venda_cliente    = $_POST['netcelular_venda_cliente'];
		$numPacote_venda_cliente     = $_POST['numPacote_venda_cliente'];
		$formaPagemento_cliente      = $_POST['formaPagemento_cliente'];
		$vencimentoPagamento_cliente = $_POST['vencimentoPagamento_cliente'];
		$pagamentoBanco_cliente      = $_POST['pagamentoBanco_cliente'];
		$pagamentoAgencia_cliente    = $_POST['pagamentoAgencia_cliente'];
		$pagamentoConta_cliente      = $_POST['pagamentoConta_cliente'];
		$statusPedido_venda_cliente  = $_POST['statusPedido_venda_cliente'];
		$tipo_servico     		     = $_POST['tipo_servico'];
		$nomeUsuario          		 = $_POST['nomeUsuario'];
		$nomeEquipe         		 = $_POST['nomeEquipe'];
		$nomeEmpresa                 = $_POST['nomeEmpresa'];
		$login_net                   = $_POST['login_net'];
		$data_venda         	     = $_POST['data_venda'];
		$hora_venda         	     = $_POST['hora_venda'];
		$lista_sistema         	     = $_POST['lista_sistema'];

		$extensao = strtolower(substr($_FILES['img_multisales']['name'], - 4));
		$img_multisales = strtoupper(md5($dataDia . $horaDia) . $extensao);
		$diretorio = "../imgmultisales/" . $img_multisales;
		move_uploaded_file($_FILES['img_multisales']['tmp_name'], $diretorio);

		$extensao2 = strtolower(substr($_FILES['img_multisales2']['name'], - 4));
		$img_multisales2 = strtoupper(md5($dataDia). $extensao2);
		$diretorio2 = "../imgmultisales/" . $img_multisales2;
		move_uploaded_file($_FILES['img_multisales2']['tmp_name'], $diretorio2);

		$extensao3 = strtolower(substr($_FILES['img_multisales3']['name'], - 4));
		$img_multisales3 = strtoupper(md5(time()). $extensao3);
		$diretorio3 = "../imgmultisales/" . $img_multisales3;
		move_uploaded_file($_FILES['img_multisales3']['tmp_name'], $diretorio3);

		$extensao4 = strtolower(substr($_FILES['audio_multisales']['name'], - 4));
		$audio_multisales = strtoupper(md5(time()). $extensao4);
		$diretorio4 = "../audiomultisales/" . $audio_multisales;
		move_uploaded_file($_FILES['audio_multisales']['tmp_name'], $diretorio4);

/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'nome_contato_cliente',
				'nome_cliente',
				'cidade_cliente',
				'estado_cliente',
				'codigo_cliente',
				'fone_cliente',
	   			'celular_cliente',
	   			'fone3_cliente',
	   			'fone4_cliente',
	   			'observacao_venda_cliente',
	   			'motivo_cliente',
	   			'tv_venda_cliente',
	   			'internet_venda_cliente',
	   			'netfone_venda_cliente',
	   			'netcelular_venda_cliente',
	   			'numPacote_venda_cliente',
	   			'formaPagemento_cliente',
	   			'vencimentoPagamento_cliente',
	   			'pagamentoBanco_cliente',
	   			'pagamentoAgencia_cliente',
	   			'pagamentoConta_cliente',
	   			'statusPedido_venda_cliente',
	   			'tipo_servico',
	   			'nomeUsuario',
	   			'nomeEquipe',
	   			'nomeEmpresa',
	   			'login_net',
	   			'data_venda',
	   			'hora_venda',
	   			'lista_sistema',
	   		    'img_multisales',
	   			'img_multisales2',
	   			'img_multisales3',
	   			'audio_multisales'
	   			

	   			
				);//campos da tabela cliente

				$valores = array(
				$nome_contato_cliente,
				$nome_cliente,
				$cidade_cliente,
				$estado_cliente,
				$codigo_cliente,
	   			$fone_cliente,
	   			$fone3_cliente,
	   			$fone4_cliente,
	   			$celular_cliente,
	   			$observacao_venda_cliente,
	   			$motivo_cliente,
	   			$tv_venda_cliente,
	   			$internet_venda_cliente,
	   			$netfone_venda_cliente,
	   			$netcelular_venda_cliente,
	   			$numPacote_venda_cliente,
	   			$formaPagemento_cliente,
	   			$vencimentoPagamento_cliente,
	   			$pagamentoBanco_cliente,
	   			$pagamentoAgencia_cliente,
	   			$pagamentoConta_cliente,
	   			$statusPedido_venda_cliente,
	   			$tipo_servico,
	   			$nomeUsuario,
	   			$nomeEquipe,
	   			$nomeEmpresa,
	   			$login_net,
	   			$data_venda,
	   			$hora_venda,
	   			$lista_sistema,
	   		    $img_multisales,
	   			$img_multisales2,
	   			$img_multisales3,
	   			$audio_multisales


				);//valores cliente


				$queryCliente = gera_insert($campos, $valores, 'clientes');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);

				//echo $queryCliente;
				//exit;

				if ($nomeEquipe == 'EQUIPE 1') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'EQUIPE 2') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'EQUIPE 3') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				 if ($nomeEquipe == 'EQUIPE 4') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

			    if ($nomeEquipe == 'EQUIPE 5') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}


				if ($nomeEquipe == 'NET PROSPECT') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'MULTI') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'CLARO') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'TIM') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}
				if ($nomeEquipe == 'PARCEIRO CLARO') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'EM CADASTRO' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'PARCEIRO NET') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'PARCEIRO TIM') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'ANALISE BACKOFFICE' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}

				if ($nomeEquipe == 'GERAL') {

		         $query = "UPDATE clientes SET statusVenda_venda_cliente = 'GERAL' WHERE ID_CLIENTE = $idCliente";
					$resultado  = mysqli_query($linkComMysql, $query);

				}


/*****************************MENSAGENS DO SISTEMA **********************************/

			if ($resCliente){
				$mensagem = "Cliente salvo com sucesso";
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
			$mensagem = "Necessario preencher todos os campos";
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
header("location: nova-venda-rapida.php");


 ?>
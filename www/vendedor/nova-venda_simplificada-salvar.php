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
		$nome_cliente    			 = $_POST['nome_cliente'];
		$cpf_cnpj_cliente         	 = $_POST['cpf_cnpj_cliente'];
		$cidade_cliente 	 		 = $_POST['cidade_cliente'];
		$estado_cliente  			 = $_POST['estado_cliente'];
		$codigo_cliente   	         = $_POST['codigo_cliente'];
		$observacao_venda_cliente	 = $_POST['observacao_venda_cliente'];
		$statusPedido_venda_cliente  = $_POST['statusPedido_venda_cliente'];
		$nomeUsuario          		 = $_POST['nomeUsuario'];
		$nomeEquipe         		 = $_POST['nomeEquipe'];
		$nomeEmpresa                 = $_POST['nomeEmpresa'];
		$login_net                   = $_POST['login_net'];
		$data_venda         	     = $_POST['data_venda'];
		$hora_venda         	     = $_POST['hora_venda'];
		$lista_sistema         	     = $_POST['lista_sistema'];
		$motivo_cliente         	 = $_POST['motivo_cliente'];
		$tipo_servico         	     = $_POST['tipo_servico'];
		$statusVenda_venda_cliente   = $_POST['statusVenda_venda_cliente'];
		$statusOcorencia_venda_cliente = $_POST['statusOcorencia_venda_cliente'];

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
		'nome_cliente',
		'cpf_cnpj_cliente',
		'cidade_cliente',
		'estado_cliente',
		'codigo_cliente',
		'observacao_venda_cliente',
		'statusPedido_venda_cliente',
		'nomeUsuario',
		'nomeEquipe',
		'nomeEmpresa',
		'login_net',
		'data_venda',
		'hora_venda',
		'lista_sistema',
		'motivo_cliente',
		'tipo_servico',
		'img_multisales',
		'img_multisales2',
		'img_multisales3',
		'audio_multisales',
		'statusVenda_venda_cliente',
		'statusOcorencia_venda_cliente'



		);//campos da tabela cliente

		$valores = array(
		$nome_cliente,
		$cpf_cnpj_cliente,
		$cidade_cliente,
		$estado_cliente,
		$codigo_cliente,
		$observacao_venda_cliente,
		$statusPedido_venda_cliente,
		$nomeUsuario,
		$nomeEquipe,
		$nomeEmpresa,
		$login_net,
		$data_venda,
		$hora_venda,
		$lista_sistema,
		$motivo_cliente,
		$tipo_servico,
		$img_multisales,
		$img_multisales2,
		$img_multisales3,
		$audio_multisales,
		$statusVenda_venda_cliente,
		$statusOcorencia_venda_cliente

		);//valores cliente


		$queryCliente = gera_insert($campos, $valores, 'clientes');

		//echo $queryCliente;
		//exit;

		$resCliente  = mysqli_query($linkComMysql, $queryCliente);

		$idCliente  = mysqli_insert_id($linkComMysql);



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
header("location: nova-venda_simplificada.php");


 ?>
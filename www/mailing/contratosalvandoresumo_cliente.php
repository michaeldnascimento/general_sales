<?php
session_start();

$mensagem = "";
$dataDia = date('Ymd');
$horaDia = date('His');

if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {

		if (
		//dados do contato obrigatorios
		$_GET['id'] !="" 


		) {

			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";


				//vem do contratoresumo_venda.php
			$numero_proposta_cliente       = $_POST['numero_proposta_cliente'];
			$codigo_cliente                = $_POST['codigo_cliente'];
			$data_pre_agendamento_cliente  = $_POST['data_pre_agendamento_cliente'];
			$statusPedido_venda_cliente    = $_POST['statusPedido_venda_cliente'];
			$motivoPendencia_venda_cliente = $_POST['motivoPendencia_venda_cliente'];
			$observacao_pedido_cliente     = $_POST['observacao_pedido_cliente'];

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


			//echo $img_multisales;
			//exit;
			$idCliente           	       = $_GET['id'];


/*****************************************EDITAR clientes ***************************************/

				$campos = array(

	   			//vem do contratoresumo.php
	   			'numero_proposta_cliente',
	   			'codigo_cliente',
	   			'data_pre_agendamento_cliente',
	   			'statusPedido_venda_cliente',
	   			'motivoPendencia_venda_cliente',
	   			'observacao_pedido_cliente',
	   			'img_multisales',
	   			'img_multisales2',
	   			'img_multisales3',
	   			'audio_multisales'

				);//campos da tabela cliente

				$valores = array(

	   			//vem do contratoresumo.php
	   			$numero_proposta_cliente,
	   			$codigo_cliente,
	   			$data_pre_agendamento_cliente,
	   			$statusPedido_venda_cliente,
	   			$motivoPendencia_venda_cliente,
	   			$observacao_pedido_cliente,
	   			$img_multisales,
	   			$img_multisales2,
	   			$img_multisales3,
	   			$audio_multisales
				//$comprou_cliente
				);//valores cliente

				$whereCliente = array('ID_CLIENTE' => $idCliente);

				$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);

				//exit("TEXTO GERADO: {$queryCliente}");

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);




/*****************************MENSAGENS DO SISTEMA **********************************/

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

}


$_SESSION['mensagem'] = $mensagem;
header("location: ../vendedor/minhas-vendasLista.php");


 ?>
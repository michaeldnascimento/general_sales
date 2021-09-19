<?php
session_start();

$mensagem = "";

if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['codigo_cliente'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

	//Cliente
$nome_contato_cliente        = utf8_decode(mb_strtoupper($_POST['nome_contato_cliente']));
$nome_cliente    		 	 = utf8_decode(mb_strtoupper($_POST['nome_cliente']));
$cidade_cliente   	 		 = utf8_decode(mb_strtoupper($_POST['cidade_cliente']));
$estado_cliente    	 		 = utf8_decode(mb_strtoupper($_POST['estado_cliente']));
$tipo_servico     		     = utf8_decode(mb_strtoupper($_POST['tipo_servico']));
$codigo_cliente     		 = utf8_decode(mb_strtoupper($_POST['codigo_cliente']));
$ddd_fone_cliente 			 = utf8_decode(mb_strtoupper($_POST['ddd_fone_cliente']));
$fone_cliente     			 = utf8_decode(mb_strtoupper($_POST['fone_cliente']));
$ddd_celular_cliente  	 	 = utf8_decode(mb_strtoupper($_POST['ddd_celular_cliente']));
$celular_cliente     	 	 = utf8_decode(mb_strtoupper($_POST['celular_cliente']));
$observacao_venda_cliente 	 = utf8_decode(mb_strtoupper($_POST['observacao_venda_cliente']));
$nomeUsuario           		 = utf8_decode(mb_strtoupper($_POST['nomeUsuario']));
$nomeEquipe            		 = utf8_decode(mb_strtoupper($_POST['nomeEquipe']));
$flag                  		 = utf8_decode(mb_strtoupper($_POST['flag']));
$data_venda       	 		 = utf8_decode(mb_strtoupper($_POST['data_venda']));
$hora_venda        	 		 = utf8_decode(mb_strtoupper($_POST['hora_venda']));
$lista_sistema     	 		 = utf8_decode(mb_strtoupper($_POST['lista_sistema']));
$motivo_cliente     	 	 = utf8_decode(mb_strtoupper($_POST['motivo_cliente']));
$statusVenda_venda_cliente   = utf8_decode(mb_strtoupper($_POST['statusVenda_venda_cliente']));
$statusPedido_venda_cliente  = utf8_decode(mb_strtoupper($_POST['statusPedido_venda_cliente']));

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
'tipo_servico',
'codigo_cliente',
'ddd_fone_cliente',
'fone_cliente',
'ddd_celular_cliente',
'celular_cliente',
'observacao_venda_cliente',
'nomeUsuario',
'nomeEquipe',
'flag',
'data_venda',
'hora_venda',
'lista_sistema',
'motivo_cliente',
'statusVenda_venda_cliente',
'statusPedido_venda_cliente',
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
$tipo_servico,
$codigo_cliente,
$ddd_fone_cliente,
$fone_cliente,
$ddd_celular_cliente,
$celular_cliente,
$observacao_venda_cliente,
$nomeUsuario,
$nomeEquipe,
$flag,
$data_venda,
$hora_venda,
$lista_sistema,
$motivo_cliente,
$statusVenda_venda_cliente,
$statusPedido_venda_cliente,
$img_multisales,
$img_multisales2,
$img_multisales3,
$audio_multisales


);//valores cliente


				$queryCliente = gera_insert($campos, $valores, 'clientes');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);

			    //exit("TEXTO GERADO: {$idCliente}");
	
//testes			
//echo $queryCliente. "<br><br>";
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
				$mensagem = "Cliente salvo com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel salvar os dados de contato.
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


			$_SESSION['mensagem'] = $mensagem;
			header("location: minhas-vendas.php");


 ?>
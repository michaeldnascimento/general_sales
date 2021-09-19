<?php
session_start();

$dataDia = date('Ymd');
$horaDia = date('His');


$lista = strval($_GET['lista']);
$tratativa = strval($_GET['tratar']);
if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {

		if (
		//dados do contato obrigatorios
		$_POST['nome_cliente'] !="" 

		) {



		include "../funcoes/conexaoPortari.php";
		include "../funcoes/funcoes_geraisPortari.php";

		//Cliente
		$nome_contato_cliente     	 = $_POST['nome_contato_cliente'];
		$nome_cliente    			 = $_POST['nome_cliente'];
		$parentesco_cliente    		 = $_POST['parentesco_cliente'];
		$cidade_cliente 	 		 = $_POST['cidade_cliente'];
		$estado_cliente  			 = $_POST['estado_cliente'];
		$codigo_cliente   	         = $_POST['codigo_cliente'];
		$fone_checklist 		     = $_POST['fone_checklist'];
		$fone_gravacao 		         = $_POST['fone_gravacao'];
		$observacao_venda_cliente	 = $_POST['observacao_venda_cliente'];
		$statusPedido_venda_cliente  = $_POST['statusPedido_venda_cliente'];
		$statusChecklist             = $_POST['statusChecklist'];
		$nomeUsuario          		 = $_POST['nomeUsuario'];
		$nomeEquipe         		 = $_POST['nomeEquipe'];
		$nomeEmpresa         	     = $_POST['nomeEmpresa'];
		$data_venda         	     = $_POST['data_venda'];
		$hora_venda         	     = $_POST['hora_venda'];
		$lista_sistema         	     = $_POST['lista_sistema'];
        $cpf_cnpj_cliente         	 = $_POST['cpf_cnpj_cliente'];
        $tipo_servico         	     = $_POST['tipo_servico'];
		$plano_multi_cliente         = $_POST['plano_multi_cliente'];
		$tv_venda_cliente            = $_POST['tv_venda_cliente'];
        $qtdchip_multi_cliente       = $_POST['qtdchip_multi_cliente'];
        $portcelular_venda_cliente   = $_POST['portcelular_venda_cliente'];
        $data_nasc_cliente           = $_POST['data_nasc_cliente'];


		$idCliente                   = $_GET['id'];


/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'nome_contato_cliente',
				'nome_cliente',
				'parentesco_cliente',
				'cidade_cliente',
				'estado_cliente',
				'codigo_cliente',
				'fone_checklist',
	   			'fone_gravacao',
	   			'observacao_venda_cliente',
	   			'statusPedido_venda_cliente',
	   			'statusChecklist',
	   			'nomeUsuario',
	   			'nomeEquipe',
	   			'nomeEmpresa',
	   			'data_venda',
	   			'hora_venda',
	   			'lista_sistema',
	   			'cpf_cnpj_cliente',
	   			'tipo_servico',
	   			'plano_multi_cliente',
	   			'tv_venda_cliente',
	   			'qtdchip_multi_cliente',
	   			'portcelular_venda_cliente',
	   			'data_nasc_cliente'

	   			
				);//campos da tabela cliente

				$valores = array(
				$nome_contato_cliente,
				$nome_cliente,
				$parentesco_cliente,
				$cidade_cliente,
				$estado_cliente,
				$codigo_cliente,
	   			$fone_checklist,
	   			$fone_gravacao,
	   			$observacao_venda_cliente,
	   			$statusPedido_venda_cliente,
	   			$statusChecklist,
	   			$nomeUsuario,
	   			$nomeEquipe,
	   			$nomeEmpresa,
	   			$data_venda,
	   			$hora_venda,
	   			$lista_sistema,
	   			$cpf_cnpj_cliente,
	   			$tipo_servico,
	   			$plano_multi_cliente,
	   			$tv_venda_cliente,
	   			$qtdchip_multi_cliente,
	   			$portcelular_venda_cliente,
	   			$data_nasc_cliente


				);//valores cliente


                $whereCliente = array('ID_CLIENTE' => $idCliente);
				$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

//echo $queryCliente . "<br><br>";
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
	$mensagem = "Salvo com sucesso";
	$_SESSION['mensagem'] = $mensagem;

				if ($statusPedido_venda_cliente == 'CADASTRO-CONCLUIDO') {


					 $_SESSION['mensagem'] = $mensagem;
			         header("location: ../vendedor/minhas-vendasLista.php");
			         exit;

				}else{


					$_SESSION['mensagem'] = $mensagem;
			         header("location: ../vendedor/minhas-vendasPendentes.php");
			         exit;
				}

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
header("location:  ../vendedor/minhas-vendasLista.php");


 ?>
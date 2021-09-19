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
				$nome_contato_cliente      	 = $_POST['nome_contato_cliente'];
				$fone_cliente 	     	     = $_POST['fone_cliente'];
				$celular_cliente 	         = $_POST['celular_cliente'];
				$cep_cliente 	     	     = $_POST['cep_cliente'];
				$endereco_cliente 	         = $_POST['endereco_cliente'];
				$enderecoNumero_cliente 	 = $_POST['enderecoNumero_cliente'];
				$enderecoComplemento_cliente = $_POST['enderecoComplemento_cliente'];
				$bairro_cliente 	         = $_POST['bairro_cliente'];
				$cidade_cliente      	     = $_POST['cidade_cliente'];
				$estado_cliente      	     = $_POST['estado_cliente'];
				$tv_atual                    = $_POST['tv_atual'];
				$fidelidade_tv               = $_POST['fidelidade_tv'];
				$internet_atual              = $_POST['internet_atual'];
				$fidelidade_internet         = $_POST['fidelidade_internet'];
				$telefonia_atual             = $_POST['telefonia_atual'];
				$fidelidade_telefonia        = $_POST['fidelidade_telefonia'];
				$movel_atual                 = $_POST['movel_atual'];
				$fidelidade_movel            = $_POST['fidelidade_movel'];
				$sabendo_tag                 = $_POST['sabendo_tag'];
				$custo_atual                 = $_POST['custo_atual'];
				$saber_tag                   = $_POST['saber_tag'];
				$lista_sistema  			 = $_POST['lista_sistema'];
				$experiencia_tag             = $_POST['experiencia_tag'];
				$nomeUsuario                 = $_POST['nomeUsuario'];
				$nomeEquipe         	     = $_POST['nomeEquipe'];
				$nomeEmpresa                 = $_POST['nomeEmpresa'];
				$data_venda         	     = $_POST['data_venda'];
				$hora_venda         	     = $_POST['hora_venda'];
				$obs_tag         	         = $_POST['obs_tag'];
				$origemCSV         	         = $_POST['origemCSV'];
			    $coberturaNET         	     = $_POST['coberturaNET'];
				$coberturaVIVO         	     = $_POST['coberturaVIVO'];
				$coberturaTIM         	     = $_POST['coberturaTIM'];


/*****************************************EDITAR clientes ***************************************/


				$campos = array(
				'nome_contato_cliente',
	   			'fone_cliente',
	   			'celular_cliente',
				'cep_cliente',
				'endereco_cliente',
				'enderecoNumero_cliente',
				'enderecoComplemento_cliente',
				'bairro_cliente',
	  			'cidade_cliente',
	   			'estado_cliente',
	   			'tv_atual',
	   			'fidelidade_tv',
	   			'internet_atual',
	   			'fidelidade_internet',
	   			'telefonia_atual',
	   			'fidelidade_telefonia',
	   			'movel_atual',
	   			'fidelidade_movel',
	   			'sabendo_tag',
	   			'custo_atual',
	   			'saber_tag',
	   			'lista_sistema',
	   			'experiencia_tag',
	   			'nomeUsuario',
	   			'nomeEquipe',
	   			'nomeEmpresa',
	   			'data_venda',
	   			'hora_venda',
	   			'obs_tag',
	   			'origemCSV',
	   			'coberturaNET',
	   		    'coberturaVIVO',
	   		    'coberturaTIM'

				);//campos da tabela cliente

				$valores = array(
				$nome_contato_cliente,
	   			$fone_cliente,
	   			$celular_cliente,
				$cep_cliente,
				$endereco_cliente,
				$enderecoNumero_cliente,
				$enderecoComplemento_cliente,
				$bairro_cliente,
	  			$cidade_cliente,
	   			$estado_cliente,
	   			$tv_atual,
	   			$fidelidade_tv,
	   			$internet_atual,
	   			$fidelidade_internet,
	   			$telefonia_atual,
	   			$fidelidade_telefonia,
	   			$movel_atual,
	   			$fidelidade_movel,
	   			$sabendo_tag,
	   			$custo_atual,
	   			$saber_tag,
	   			$lista_sistema,
	   			$experiencia_tag,
	   			$nomeUsuario,
	   			$nomeEquipe,
	   			$nomeEmpresa,
	   			$data_venda,
	   			$hora_venda,
	   			$obs_tag,
	   			$origemCSV,
	   			$coberturaNET,
	   		    $coberturaVIVO,
	   		    $coberturaTIM


				);//valores cliente




				$queryCliente = gera_insert($campos, $valores, 'clientes');

				$resCliente  = mysqli_query($linkComMysql, $queryCliente);

				$idCliente  = mysqli_insert_id($linkComMysql);


			    //exit("TEXTO GERADO: {$queryCliente}");

//testes
//echo $num . "<br><br>";
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
 ?>
 <script>

window.close();
window.opener.location.reload();
</script>
 <meta charset="utf-8">
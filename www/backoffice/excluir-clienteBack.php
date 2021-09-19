<?php 
session_start();

$lista = strval($_GET['lista']);
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){


	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";


	$id = $_POST['id_contato'];



		$where = array('id_cliente' => $id);
		$queryDelete = gera_delete('clientes', $where);

		$excluiuContato = mysqli_query($linkComMysql, $queryDelete);
	

//testes			
//echo $queryDelete . "<br><br>";
//exit;		

			if ($excluiuContato) {
			$mensagem .= "Excluido com sucesso.";
		    }   
		
		    else {
			$mensagem = "Nao foi possivel exluir";
			
			}


} else{//se não veio o id
		$mensagem = "Id do cliente inexistente. Nao foi possivel excluir os dados desse mailing";
	}


		if ($lista == 'GERAL') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: listavenda-backoffice.php");
		exit;
		}


		if ($lista == 'TRATARPENDENCIA') {
		$_SESSION['mensagem'] = $mensagem;
		header("location: ../supervisor/listavenda-backoffice-tratarpendentes.php");
		exit;
		}



 ?>
<?php 
session_start();

// se veio o id pelo post
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){

	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";


	$id = $_POST['id_contato'];

	

		$where = array('id_login' => $id);
		$queryDelete = gera_delete('usuario', $where);

		$excluiuContato = mysqli_query($linkComMysql, $queryDelete);
	

//testes			
//echo $queryDelete . "<br><br>";
//exit;		

			if ($excluiuContato) {
			$mensagem .= "Usuario excluido";
		    }   
		
		    else {
			$mensagem = "Nao foi possivel exluir os dados do usuario";
			
			}


} else{//se não veio o id
		$mensagem = "Id do usuario Inexistente. Nao foi possivel excluir os dados do usuario";
	}

$_SESSION['mensagem'] =  $mensagem;
header("location: con-usuario-lista.php");

 ?>
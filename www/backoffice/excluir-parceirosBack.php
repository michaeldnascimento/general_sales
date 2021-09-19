<?php 
session_start();

// se veio o id pelo post
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){

	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";


	$id = $_POST['id_contato'];

	

		$where = array('id_cliente_parceiros' => $id);
		$queryDelete = gera_delete('parceiros', $where);

		$excluiuContato = mysqli_query($linkComMysql, $queryDelete);
	

//testes			
//echo $queryDelete . "<br><br>";
//exit;		

			if ($excluiuContato) {
			$mensagem .= "Mailing excluido";
		    }   
		
		    else {
			$mensagem = "Não foi possivel exluir os dados desse Mailing";
			
			}


} else{//se não veio o id
		$mensagem = "Id do mailing Inexistente. Não foi possivel excluir os dados desse mailing";
	}

$_SESSION['mensagem'] =  $mensagem;
header("location: listavenda-parceiros.php");

 ?>
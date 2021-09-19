<?php 
session_start();

if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['sistema'] !=""
		
		) {



				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";


				$sistema  	  = $_POST['sistema'];
				//$imagem_cliente 	  = $_FILES['imagem_cliente']['name']; //para imagens
				//$diretorio = "print/"; 
				//move_uploaded_file($_FILES['imagem_cliente']['tmp_name'], $diretorio.$imagem_cliente); 





/*************************INSERT CLIENTE ***************************************/

/*
			//INSERIR DADOS NO BANCO DE DADOS NA TABELA CONTATO
			$query = "INSERT INTO clientes (cidade_cliente, imagem_cliente, imagemCanc_cliente, observacao_sistema, lista_sistema, datahora_cad_cliente)
			VALUES ('SAO PAULO' , 'unnamed.png' , 'unnamed1.png' , 'OBSERVACAO SISTEMA', 'SP',  now())";
*/

			$query = $sistema;


			$resultado  = mysqli_query($linkComMysql, $query);
			$idCliente  = mysqli_insert_id($linkComMysql);



/************************MENSAGENS DO SISTEMA ***************************************/

			if ($idCliente > 0 ){
				$mensagem = "Mailing Incluído com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel incluir o Mailing";
			    }

	}
			else{
				$mensagem = "Necessario preencher todos os campos";
			    }

}

	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na postagem de dados";

	}

	$_SESSION['mensagem'] = $mensagem;
	header("location: novo_mailing.php");


?>
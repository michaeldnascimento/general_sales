<?php
session_start();
if (isset($_POST)) {

		if (
		//dados do contato obrigatorios
		$_POST['senhaAtual'] !="" &&  $_POST['nova_senha'] !=""

		) {


				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

				//Cliente
				$senhaAtual       	     = $_POST['senhaAtual'];
				$nova_senha              = $_POST['nova_senha'];
				$conf_senha              = $_POST['conf_senha'];

				$id          	         = $_GET['id'];


				$campos = array(
				'senhaAtual',
				'nova_senha',
				'conf_senha'

				);

				$valores = array(
				$senhaAtual,
				$nova_senha,
				$conf_senha
				);//valores cliente


			$query = "SELECT id_login, nome_usuario_login, usuario_login, senha_login FROM usuario WHERE id_login = '{$id}' AND senha_login = '{$senhaAtual}' " ;
			//echo $query;
			//exit;
			$resultado   = mysqli_query($linkComMysql, $query);
			$qtd = mysqli_num_rows($resultado);

			if ($qtd > 0) {
				if ($nova_senha == $conf_senha) {
					$querysenha = "UPDATE usuario SET senha_login = '{$conf_senha}' WHERE id_login = '{$id}' AND senha_login = '{$senhaAtual}'";
					$resu   = mysqli_query($linkComMysql, $querysenha);

			        $mensagem = "SENHA ALTERADA COM SUCESSSO !";
					$_SESSION['mensagem'] = $mensagem;
					header("location: usuario-alterar-senha.php");
					exit;
				 }else{

					$mensagem = "NOVA SENHA DIFEENTE DA SENHA DE CONFIRMACAO !";
					$_SESSION['mensagem'] = $mensagem;
					header("location: usuario-alterar-senha.php");
					exit;
			    }

            }else{

            $mensagem = "SENHA ATUAL INVALIDA!";
		    $_SESSION['mensagem'] = $mensagem;
		    header("location: usuario-alterar-senha.php");
		    exit;

		    }

}
}

?>



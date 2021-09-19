
<?php 
session_start();
include_once "../login/verifica.php";

if (intval($_GET['id']) > 0 ) {
 $id = intval($_GET['id']);
    $Nusuario = strval($_GET['usuario']);
	  $lista = strval($_GET['lista']);


			include "../funcoes/conexaoPortari.php";
			include "../funcoes/funcoes_geraisPortari.php";


			$query = "SELECT flag, nomeUsuario, motivo_cliente FROM clientes WHERE id_cliente = '{$id}' LIMIT 1 " ;
			$resp   = mysqli_query($linkComMysql, $query);	

			$clientes = array();
			while ($cliente = mysqli_fetch_assoc($resp)) {
			$clientes[] = array(
			$flag   	= $cliente['flag'],
			$nomeUse    = $cliente['nomeUsuario'],
			$motiva     = $cliente['motivo_cliente'],
				);
			}

			 if($Nusuario == $nomeUse OR $nivel == 2 OR $nivel == 3 OR $nivel == 4 OR $motiva == 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO' ){

			 	if ($lista == 'SP' OR $lista == 'BR' OR $lista == 'SL' OR $lista == 'RX' OR $lista == 'MT' OR $lista == 'CO' OR $lista == 'UTI') {

					header("location: tratandoLista_cliente.php?id=$id&lista=$lista");
		    		exit;

				}

		    	if ($lista == 'NAO') {
		    		header("location: tratando-oportsite.php?id=$id&lista=$lista");
		    		exit;
		    	}

		    	if ($lista == 'SITE') {
		    		header("location: tratando-oportsite.php?id=$id&lista=$lista");
		    		exit;
		    	}


             }


			if ($flag == 1) {
				//echo $flagverifica;
				//exit;

				$mensagem = "CLIENTE $id ESTA SENDO ATENDIDO POR $nomeUse, TENTE MAIS TARDE.";


					if ($lista == 'SP') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-SP.php");
						exit;
					}

					if ($lista == 'BR') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-BR.php");
						exit;
					}

					if ($lista == 'SL') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-SUL.php");
						exit;
					}

					if ($lista == 'MT') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-Multi.php");
						exit;
					}

					if ($lista == 'CO') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-CO.php");
						exit;
					}


					if ($lista == 'RX') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-Reconex.php");
						exit;
					}

					if ($lista == 'UTI') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/leadNET-UTI.php");
						exit;
					}

					if ($lista == 'NAO') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/oportunidades-site.php");
						exit;
					}

					if ($lista == 'SITE') {
						$_SESSION['mensagem'] = $mensagem;
						header("location: ../mailing/oportunidades-site.php");
						exit;
					}


			}else{

			$query = "UPDATE clientes SET flag = '1', nomeUsuario = '$Nusuario' WHERE id_cliente = $id ";
			$resultado  = mysqli_query($linkComMysql, $query);

				if ($lista == 'SP' OR $lista == 'BR' OR $lista == 'SL' OR $lista == 'RX' OR $lista == 'MT' OR $lista == 'CO' OR $lista == 'UTI') {

					header("location: tratandoLista_cliente.php?id=$id&lista=$lista");
		    		exit;

				}

		    	if ($lista == 'NAO') {
		    		header("location: tratando-oportsite.php?id=$id&lista=$lista");
		    		exit;
		    	}

		       if ($lista == 'SITE') {
		    		header("location: tratando-oportsite.php?id=$id&lista=$lista");
		    		exit;
		    	}

		    }



}else {// se não vier dados postados da via $_POST
	$mensagem = "Erro na postagem de dados";

				if ($lista == 'SP') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-SP.php");
				exit;
				}

				if ($lista == 'BR') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-BR.php");
				exit;
				}

				if ($lista == 'SL') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-SUL.php");
				exit;
				}

				if ($lista == 'MT') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-Multi.php");
				exit;
				}

				if ($lista == 'CO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-CO.php");
				exit;
				}

				if ($lista == 'RX') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-Reconex.php");
				exit;
				}

				if ($lista == 'UTI') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-UTI.php");
				exit;
				}


				if ($lista == 'NAO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-site.php");
				exit;
				}

				if ($lista == 'SITE') {
				$_SESSION['mensagem'] = $mensagem;
			    header("location: ../mailing/oportunidades-site.php");
				exit;
			    }



}




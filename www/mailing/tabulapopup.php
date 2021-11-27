<?php 
session_start();

$lista = strval($_GET['lista']);
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){


	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";


	$id 			        = $_POST['id_contato'];
	$motivo_cliente         = $_POST['motivo_cliente'];
	$data_followup_cliente  = $_POST['data_followup_cliente'];
	$hora_followup_cliente  = $_POST['hora_followup_cliente'];
	$nomeUsuario            = $_POST['nomeUsuario'];
	$nomeEquipe            = $_POST['nomeEquipe'];
	$nomeEmpresa           = $_POST['nomeEmpresa'];
	$data_venda            = $_POST['data_venda'];
	$hora_venda            = $_POST['hora_venda'];
	$observacao_cliente    = $_POST['observacao_cliente'];
	$lista_sistema         = $_POST['lista_sistema'];

	$campos = array(
	'motivo_cliente',
	'data_followup_cliente',
	'hora_followup_cliente',
	'nomeUsuario',
	'nomeEquipe',
	'nomeEmpresa',
	'data_venda',
	'hora_venda',
	'observacao_cliente',
	);

	$valores = array(
	$motivo_cliente,
	$data_followup_cliente,
	$hora_followup_cliente,
	$nomeUsuario,
	$nomeEquipe,
	$nomeEmpresa,
	$data_venda,
	$hora_venda,
	$observacao_cliente,
	);



		$whereCliente = array('id_cliente' => $id);
		$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
		$resCliente  = mysqli_query($linkComMysql, $queryCliente);



   //se o motivo cliente for de um determinado grupo ele se direciona a pagina corespondente		
	if ($motivo_cliente == 'VENDA - NOVO CLIENTE') {
	header("location: contratogerando_cliente.php?id=$id&lista=$lista");
	exit;
	}


	if ($motivo_cliente == 'VENDA - UPGRADE + MULTI' ) {
	header("location: contratogerando_cliente.php?id=$id&lista=$lista");
	exit;
	}


	if ($motivo_cliente == 'VENDA - BASE TV' ) {
	header("location: contratogerando_cliente.php?id=$id&lista=$lista");
	exit;
	}

		if ($resCliente) {
		$mensagem = "TABULACAO FOI SALVA COM SUCESSO";
		}

		else {
		$mensagem = "NAO FOI POSSIVEL SALVAR SUA TABULACAO";

		}


                if ($lista == 'TVBASE') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/tvbase.php");
				exit;
				}

				if ($lista == 'MULTIBASE') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/multibase.php");
				exit;
				}

				if ($lista == 'EXCLUSIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadExclusivo.php");
				exit;
				}

				if ($lista == 'PROSPECT') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/prospect.php");
				exit;
				}

                if ($lista == 'OPORTUNIDADES') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../mailing/oportunidades.php");
                    exit;
                }

                if ($lista == 'PROSPECT2') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../mailing/prospect2.php");
                    exit;
                }

                if ($lista == 'OPORTUNIDADES2') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../mailing/oportunidades2.php");
                    exit;
                }

                if ($lista == 'RETORNO') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../vendedor/minha-agendaRetornos.php");
                    exit;
                }

				if ($lista == 'OPCLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-claro.php");
				exit;
				}

				if ($lista == 'CLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-Claro.php");
				exit;
				}


				if ($lista == 'SKY') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-sac.php");
				exit;
				}


				if ($lista == 'TIM') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-TIM.php");
				exit;
				}

				if ($lista == 'VIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-VIVO.php");
				exit;
				}

				if ($lista == 'HUNGHES') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-HUGHES.php");
				exit;
				}

				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-NET.php");
				exit;
				}

				if ($lista == 'CORPORATIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-corporativo.php");
				exit;
				}

		        if ($lista == 'GERAL') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-GERAL.php");
				exit;
				}







} else{//se não veio o id
		$mensagem = "POR FAVOR TENTE NOVAMENTE, NAO FOI POSSIVEL SALVAR A TABULACAO.";



                if ($lista == 'TVBASE') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/tvbase.php");
				exit;
				}

				if ($lista == 'MULTIBASE') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/multibase.php");
				exit;
				}

				if ($lista == 'EXCLUSIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadExclusivo.php");
				exit;
				}

				if ($lista == 'PROSPECT') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/prospect.php");
				exit;
				}

                if ($lista == 'OPORTUNIDADES') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../mailing/oportunidades.php");
                    exit;
                }

                if ($lista == 'PROSPECT2') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../mailing/prospect2.php");
                    exit;
                }

                if ($lista == 'OPORTUNIDADES2') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../mailing/oportunidades2.php");
                    exit;
                }


    if ($lista == 'RETORNO') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../vendedor/minha-agendaRetornos.php");
                    exit;
                }

				if ($lista == 'OPCLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-claro.php");
				exit;
				}

				if ($lista == 'CLARO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/leadNET-Claro.php");
				exit;
				}

				if ($lista == 'SKY') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-sac.php");
				exit;
				}

				
				if ($lista == 'TIM') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-TIM.php");
				exit;
				}

				if ($lista == 'VIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-VIVO.php");
				exit;
				}

				if ($lista == 'HUNGHES') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-HUGHES.php");
				exit;
				}

				if ($lista == 'NET') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-NET.php");
				exit;
				}

				if ($lista == 'CORPORATIVO') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-corporativo.php");
				exit;
				}

				if ($lista == 'GERAL') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/lead-GERAL.php");
				exit;
				}

}
 ?>
<?php 
session_start();
$loginEmpresa = ( isset($_POST['empresa']) ) ? trim($_POST['empresa']) : "";
$loginUsuario = ( isset($_POST['login']) ) ? trim($_POST['login']) : ""; 
$senhaUsuario = ( isset($_POST['senha']) ) ? trim($_POST['senha']) : ""; 

$mensagem = "";

if ( strlen($loginUsuario) > 0 && strlen($senhaUsuario) > 0 && strlen($loginEmpresa) > 0  ) {

	$_SESSION['empresa']= $loginEmpresa;

	include_once '../funcoes/conexaoPortari.php';// gera o $linkComMysql

// verificar o login no banco de dados
$query = "SELECT usuario_login, senha_login, statusUsuario_login, user_login, nivel_login, funcao_login, equipe_login, empresa_login, acessoSP_login, acessoBR_login, acessoSL_login, acessoRX_login, acessoMT_login, acessoUTI_login, acessoPROPOSTA_login, acessoPROSPECTS_login, acessoME_login, acessoCE_login, acessoCANC_login, acessoCLARO_login, acessoOportunidadeClaro_login, acessoMultibase_login, acessoOportunidadeSite_login, acessoOportunidadeSAC_login, acessoLEADSITE_login, acessoVENDARS_login, acessoVIVO_login, acessoTIM_login, acessoNET_login, acessoHUGHES_login, acessoGERAL_login, acessoPARCEIROS_login, acessoTODOS_login FROM usuario WHERE usuario_login = '{$loginUsuario}' AND senha_login = '{$senhaUsuario}' LIMIT 1 " ;
	//echo $query;
	//exit;
	$resLogin   = mysqli_query($linkComMysql, $query);	
	$dadosLogin = mysqli_fetch_assoc($resLogin);


	$_SESSION['usuario']=$dadosLogin['usuario_login'];
	$_SESSION['senha']=$dadosLogin['usuario_login'];
	$_SESSION['status']=$dadosLogin['statusUsuario_login'];
	$_SESSION['user']=$dadosLogin['user_login'];
	$_SESSION['nivel']=$dadosLogin['nivel_login'];
	$_SESSION['funcao']=$dadosLogin['funcao_login'];
	$_SESSION['equipe']=$dadosLogin['equipe_login'];
	$_SESSION['prestadora']=$dadosLogin['empresa_login'];
	$_SESSION['acessoSP']=$dadosLogin['acessoSP_login'];
	$_SESSION['acessoBR']=$dadosLogin['acessoBR_login'];
	$_SESSION['acessoSL']=$dadosLogin['acessoSL_login'];
	$_SESSION['acessoRX']=$dadosLogin['acessoRX_login'];
	$_SESSION['acessoMT']=$dadosLogin['acessoMT_login'];
	$_SESSION['acessoUTI']=$dadosLogin['acessoUTI_login'];
	$_SESSION['acessoPROPOSTA']=$dadosLogin['acessoPROPOSTA_login'];
	$_SESSION['acessoPROSPECTS']=$dadosLogin['acessoPROSPECTS_login'];
	$_SESSION['acessoME']=$dadosLogin['acessoME_login'];
	$_SESSION['acessoCE']=$dadosLogin['acessoCE_login'];
	$_SESSION['acessoCLARO']=$dadosLogin['acessoCLARO_login'];
	$_SESSION['acessoOportunidadeClaro']=$dadosLogin['acessoOportunidadeClaro_login'];
	$_SESSION['acessoCANC']=$dadosLogin['acessoCANC_login'];
	$_SESSION['acessoMultibase']=$dadosLogin['acessoMultibase_login'];
	$_SESSION['acessoOportunidadeSite']=$dadosLogin['acessoOportunidadeSite_login'];
	$_SESSION['acessoOportunidadeSAC']=$dadosLogin['acessoOportunidadeSAC_login'];
	$_SESSION['acessoLEADSITE']=$dadosLogin['acessoLEADSITE_login'];
	$_SESSION['acessoVENDARS']=$dadosLogin['acessoVENDARS_login'];
	$_SESSION['acessoVIVO']=$dadosLogin['acessoVIVO_login'];
	$_SESSION['acessoTIM']=$dadosLogin['acessoTIM_login'];
	$_SESSION['acessoNET']=$dadosLogin['acessoNET_login'];
    $_SESSION['acessoHUGHES']=$dadosLogin['acessoHUGHES_login'];
    $_SESSION['acessoGERAL']=$dadosLogin['acessoGERAL_login'];
	$_SESSION['acessoPARCEIROS']=$dadosLogin['acessoPARCEIROS_login'];
	$_SESSION['acessoTODOS']=$dadosLogin['acessoTODOS_login'];

	$qtdLogin = mysqli_num_rows($resLogin);
	if($qtdLogin > 0) {
	if( $loginUsuario ==  $dadosLogin['usuario_login'] && $senhaUsuario ==  $dadosLogin['senha_login'] && $dadosLogin['statusUsuario_login'] ==  'ATIVO' ) {

			$_SESSION['logado'] = true;

			$query = "UPDATE usuario SET user_login = '1' WHERE usuario_login = '$loginUsuario'";
			$resultado  = mysqli_query($linkComMysql, $query);

			//se o login estiver correto, envia o usuário para index
			header("location: ../index.php");
			exit;

		} else {
			$mensagem =  "Usuário ou senha inválido";
		}
	} else {
		$mensagem = "Login não encontrado";
	}
	
} else {
	//enviar pra login.php com a mensagem
	$mensagem =  "É necessáiro informar o login e senha";
}

if( isset($_SESSION['logado']) ){

	unset($_SESSION['logado']);
}


$_SESSION['mensagem'] = $mensagem;
header("location: entrar.php");
?>
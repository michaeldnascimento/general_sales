<?php 
$empresa = $_SESSION['empresa'];
$nomeUsuario = $_SESSION['usuario'];
$statusUsuario = $_SESSION['status'];
$funcao = $_SESSION['funcao'];
$nivel  = $_SESSION['nivel'];
$nomeEquipe = $_SESSION['equipe'];
$nomePrestadora = $_SESSION['prestadora'];
$acessoSP = $_SESSION['acessoSP'];
$acessoBR = $_SESSION['acessoBR'];
$acessoSL = $_SESSION['acessoSL'];
$acessoRX = $_SESSION['acessoRX'];
$acessoMT = $_SESSION['acessoMT'];
$acessoUTI = $_SESSION['acessoUTI'];
$acessoPROPOSTA = $_SESSION['acessoPROPOSTA'];
$acessoPROSPECTS = $_SESSION['acessoPROSPECTS'];
$acessoME = $_SESSION['acessoME'];
$acessoCE = $_SESSION['acessoCE'];
$acessoCLARO = $_SESSION['acessoCLARO'];
$acessoOportunidadeClaro = $_SESSION['acessoOportunidadeClaro'];
$acessoCANC = $_SESSION['acessoCANC'];
$acessoMultibase = $_SESSION['acessoMultibase'];
$acessoOportunidadeSite = $_SESSION['acessoOportunidadeSite'];
$acessoOportunidadeSAC = $_SESSION['acessoOportunidadeSAC'];
$acessoLEADSITE = $_SESSION['acessoLEADSITE'];
$acessoVENDARS = $_SESSION['acessoVENDARS'];
$acessoVIVO = $_SESSION['acessoVIVO'];
$acessoTIM = $_SESSION['acessoTIM'];
$acessoNET = $_SESSION['acessoNET'];
$acessoHUGHES = $_SESSION['acessoHUGHES'];
$acessoGERAL = $_SESSION['acessoGERAL'];
$acessoPARCEIROS = $_SESSION['acessoPARCEIROS'];
$acessoTODOS = $_SESSION['acessoTODOS'];

$limpar = '.';

//echo $limpar;
//exit;
//Validado o login
if( !isset($_SESSION['logado']) || $_SESSION['logado'] != true) {


	unset($_SESSION['logado']);
	$_SESSION['mensagem'] = "É necessário estar logado para entrar";
	
	header("location: ../login/entrar.php");
	exit;
}

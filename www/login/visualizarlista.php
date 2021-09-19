<?php

if($empresa == '001' && ($acessoSP == 'SIM' OR $acessoTODOS == 'SIM')){

  $dropsp = '';

}else{

  $dropsp = 'none';
}

if($empresa == '001' && ($acessoBR == 'SIM' OR $acessoTODOS == 'SIM')){

  $dropbr = '';

}else{

  $dropbr = 'none';
}

if($empresa == '001' && ($acessoSL == 'SIM' OR $acessoTODOS == 'SIM')){

  $dropsl = '';

}else{

  $dropsl = 'none';
}

if($empresa == '001' && ($acessoRX == 'SIM' OR $acessoTODOS == 'SIM')){

  $droprx = '';

}else{

  $droprx = 'none';
}

if($empresa == '001' && ($acessoMT == 'SIM' OR $acessoTODOS == 'SIM')){
  $dropmt = '';

}else{

  $dropmt = 'none';
}

if($empresa == '001' && ($acessoUTI == 'SIM' OR $acessoTODOS == 'SIM')){

  $droputi = '';

}else{

  $droputi = 'none';
}

if ($acessoCLARO == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropcl = '';

}else{

  $dropcl = 'none';
}


if ($acessoPROPOSTA == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropproposta = '';

}else{

  $dropproposta = 'none';
}

if ($acessoPROSPECTS == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropprospects = '';

}else{

  $dropprospects = 'none';
}

if ($acessoME == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropme = '';

}else{

  $dropme = 'none';
}

if ($acessoCE == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropce = '';

}else{

  $dropce = 'none';
}

if ($acessoCANC == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropcanc = '';

}else{

  $dropcanc = 'none';
}

if ($acessoCANC == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropcancclaro = '';

}else{

  $dropcancclaro = 'none';
}

if ($acessoMultibase == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropmultibase = '';

}else{

  $dropmultibase = 'none';
}

if ($acessoOportunidadeSite == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropoportunidadesite = '';

}else{

  $dropoportunidadesite = 'none';
}

if ($acessoOportunidadeSAC == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropoportunidadesac = '';

}else{

  $dropoportunidadesac = 'none';
}

if ($acessoOportunidadeClaro == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropoportunidadecl = '';

}else{

  $dropoportunidadecl = 'none';
}

if ($acessoLEADSITE == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropleadsite = '';

}else{

  $dropleadsite = 'none';
}

if ($acessoVIVO == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropvivo = '';

}else{

  $dropvivo = 'none';
}

if ($acessoTIM == 'SIM' OR $acessoTODOS == 'SIM'){

  $droptim = '';

}else{

  $droptim = 'none';
}

if ($acessoNET == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropnet = '';

}else{

  $dropnet = 'none';
}

if ($acessoHUGHES == 'SIM' OR $acessoTODOS == 'SIM'){

  $drophughes = '';

}else{

  $drophughes = 'none';
}

if ($acessoGERAL == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropgeral = '';

}else{

  $dropgeral = 'none';
}


if ($acessoVENDARS == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropvendars = '';

}else{

  $dropvendars = 'none';
}

if ($acessoPARCEIROS == 'SIM' OR $acessoTODOS == 'SIM'){

  $dropparceiros = '';

}else{

  $dropparceiros = 'none';
}


if ($acessoOportunidadeClaro == 'SIM' OR $acessoCE == 'SIM' OR $acessoHUGHES == 'SIM' OR $acessoGERAL == 'SIM' OR $acessoNET == 'SIM' OR $acessoVIVO == 'SIM' OR $acessoTIM == 'SIM' OR $acessoOportunidadeSAC == 'SIM' OR $acessoCLARO == 'SIM' OR $acessoTODOS == 'SIM'){

  $menuclaro = '';

}else{

  $menuclaro = 'none';
}

if ($acessoSP == 'SIM' OR $acessoBR == 'SIM' OR $acessoSL == 'SIM' OR $acessoRX == 'SIM' OR $acessoMT == 'SIM' OR $acessoPROPOSTA == 'SIM' OR $acessoCANC == 'SIM' OR $acessoPROSPECTS == 'SIM' OR $acessoMultibase == 'SIM' OR $acessoOportunidadeSite == 'SIM' OR $acessoOportunidadeSAC == 'SIM' OR $acessoLEADSITE == 'SIM' OR $acessoTODOS == 'SIM'){

  $menunet = '';

}else{

  $menunet = 'none';
}


//ACESSO DOS MENUS POR NIVEL DE LOGIN

if ($acessoPARCEIROS == 'SIM' AND $nivel == 1) {
$menunet   = 'none';
$menuclaro = 'none';
$dropvend  = 'none';
$dropparc  = '';
$dropback  = 'none';
$dropsup   = 'none';
$dropger   = 'none';
$dropadm   = 'none';
$droprela  = 'none';
}

if (($acessoPARCEIROS == '' OR $acessoPARCEIROS == 'NAO')  AND $nivel == 1) {

$dropvend  = '';
$dropparc  = 'none';
$dropback  = 'none';
$dropsup   = 'none';
$dropger   = 'none';
$dropadm   = 'none';
$drop      = 'none';
$droprela  = 'none';

}

if ($nivel == 2) {

$menunet   = '';
$menuclaro = '';
$dropvend  = '';
$dropparc  = '';
$dropback  = '';
$dropsup   = 'none';
$dropger   = 'none';
$dropadm   = 'none';
$drop      = 'none';
$droprela  = 'none';

}

if ($nivel == 3) {

$menunet   = '';
$menuclaro = '';
$dropvend  = '';
$dropparc  = '';
$dropback  = '';
$dropsup   = '';
$dropger   = 'none';
$dropadm   = 'none';
$drop      = '';
$droprela  = '';

}
if ($nivel == 4) {

$menunet   = '';
$menuclaro = '';
$dropvend  = '';
$dropparc  = '';
$dropback  = '';
$dropsup   = '';
$dropger   = '';
$dropadm   = 'none';
$drop      = '';
$droprela  = '';

}

if ($nivel == 5) {

$menunet   = '';
$menuclaro = '';
$dropvend  = '';
$dropparc  = '';
$dropback  = '';
$dropsup   = '';
$dropger   = '';
$dropadm   = '';
$drop      = '';
$droprela  = '';

}



// ACESSO AO MENU POR EMPRESA

if ($empresa == '002') {
  $emp = 'none';
}else{
  $emp = '';
}


?>
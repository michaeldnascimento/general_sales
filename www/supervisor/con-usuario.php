<?php
ini_set('default_charset', 'UTF-8');
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($nivel == 3 OR $nivel == 4 OR $nivel == 5){


//LIBERAR NIVES DE CADASTRO
if ($nivel == 3) {
  $nv = 'none';
}

//LIBERA NOME DE EQUIPE
if ($nomeEquipe == 'EQUIPE 1') {
  $eq1 = '';
  $eq2 = 'none';
  $eq3 = 'none';
  $eq4 = 'none';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 2') {
  $eq1 = 'none';
  $eq2 = '';
  $eq3 = 'none';
  $eq4 = 'none';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 3') {
  $eq1 = 'none';
  $eq2 = 'none';
  $eq3 = '';
  $eq4 = 'none';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 4') {
  $eq1 = 'none';
  $eq2 = 'none';
  $eq3 = 'none';
  $eq4 = '';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 5') {
  $eq1 = 'none';
  $eq2 = 'none';
  $eq3 = 'none';
  $eq4 = 'none';
  $eq5 = '';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'GERAL') {
  $eq1 = '';
  $eq2 = '';
  $eq3 = '';
  $eq4 = '';
  $eq5 = '';
  $eqGeral = '';
}

//LIBERA EMPRESA
if ($nomePrestadora == 'EMPRESA 1') {
  $em1 = '';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 2') {
  $em1 = 'none';
  $em2 = '';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 3') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = '';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 4') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = '';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 5') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = '';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 6') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = '';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 7') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = '';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 8') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = '';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 9') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $em9 = '';
  $emg = 'none';
}
if ($nomePrestadora == 'GERAL') {
  $em1 = '';
  $em2 = '';
  $em3 = '';
  $em4 = '';
  $em5 = '';
  $em6 = '';
  $em7 = '';
  $em8 = '';
  $emg = '';
}
if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
$id = intval($_GET['id']);

          //conectar e selecionar o banco de dados mysql/agenda
          include_once '../funcoes/conexaoPortari.php';
          include_once '../funcoes/funcoes_geraisPortari.php';

          //gera uma query para buscar todos os contatos


          $campos = array(
          'id_login',
          'nome_usuario_login',
          'usuario_login',
          'senha_login',
          'statusUsuario_login',
          'funcao_login',
          'departamento_login',
          'turno_login',
          'equipe_login',
          'empresa_login',
          'nivel_login',
          'acessoSP_login',
          'acessoBR_login',
          'acessoSL_login',
          'acessoRX_login',
          'acessoMT_login',
          'acessoUTI_login',
          'acessoPROPOSTA_login',
          'acessoPROSPECTS_login',
          'acessoME_login',
          'acessoCE_login',
          'acessoCANC_login',
          'acessoCLARO_login',
          'acessoOportunidadeClaro_login',
          'acessoMultibase_login',
          'acessoLEADSITE_login',
          'acessoOportunidadeSite_login',
          'acessoOportunidadeSAC_login',
          'acessoVIVO_login',
          'acessoTIM_login',
          'acessoHUGHES_login',
          'acessoGERAL_login',
          'acessoNET_login',
          'acessoVENDARS_login',
          'acessoPARCEIROS_login',
          'acessoTODOS_login'
          );

          $tabelas = array(
          array('usuario', 'id_login')

          );

          $where = array(
          'id_login' => $id
          ); 


          $stringSql = gera_select($campos, $tabelas, $where);

          // exit("TEXTO GERADO: {$stringSql}");
          //mando executar a query no banco de dados
          $resultado = mysqli_query($linkComMysql, $stringSql);

          $cliente = mysqli_fetch_assoc($resultado);
          }



?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
		<title>General Sales</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">


	</head>

<body>



<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>


 <h4><center><strong>Consulta Usuario</strong></center></h4>
 <br />



<!--*************************************FORM *********************************** -->


		  
<div id="main" class="form-horizontal">
<form action="con-usuario-salve.php?id=<?=$id;?>" method="POST">


			
	

	<div class="col-sm-12">

              <div class="form-group">

            <label class="col-sm-3 control-label" for="textinput">ID</label>
            <div class="col-sm-1">
             <div class="input-group">
             <input type="text" class="form-control input-md" value="<?=$cliente['id_login']?>" disabled>
             </div>
            </div>

         
            <label class="col-sm-1 control-label" for="textinput">Nome</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" style="text-transform: uppercase" name="nome_usuario_login" class="form-control input-md" id="nome_usuario_login" value="<?=$cliente['nome_usuario_login']?>">
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>


            <div class="col-sm-2">
            <div class="input-group">

            <label class="radio-inline">
            <input type="radio" 
            name="statusUsuario_login" 
            id="statusUsuario_login" 
            value="ATIVO"
            <?php echo ($cliente['statusUsuario_login'] == "ATIVO") ? "checked" : null; ?>/> <strong style="color: blue">ATIVO</strong>
            </label>

            <label class="radio-inline">
            <input type="radio" 
            name="statusUsuario_login" 
            id="statusUsuario_login" value="INATIVO"
            <?php echo ($cliente['statusUsuario_login'] == "INATIVO") ? "checked" : null; ?>/> <strong style="color: red">INATIVO</strong>
            </label>
            </div>
            </div>



       </div>

		



        <!-- Text input-->
        <div class="form-group">


            <label class="col-sm-3 control-label" for="textinput">Usuario</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" style="text-transform: uppercase" name="usuario_login" class="form-control input-md" id="usuario_login" value="<?=$cliente['usuario_login']?>">
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Senha</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" style="display: <?php echo $adm ?>"class="form-control" required name="senha_login" id="senha_login" value="<?=$cliente['senha_login']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

       </div>

	    <!-- Text input-->
        <div class="form-group">
                          
      

 
          <label class="col-sm-3 control-label" for="textinput">Funcao</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control" required name="funcao_login" id="funcao_login" value="<?=$cliente['funcao_login']?>">
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Departamento</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control" required name="departamento_login" id="departamento_login" value="<?=$cliente['departamento_login']?>">
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Turno</label>
            <div class="col-sm-1">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control"  name="turno_login" id="turno_login" value="<?=$cliente['turno_login']?>">
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>


        </div>


			<!-- Text input-->
	    <div class="form-group">



          <label class="col-sm-3 control-label" for="textinput">Equipe</label>
            <div class="col-sm-2">
          <select name="equipe_login" value="<?=$cliente['equipe_login']?>" class="form-control">
          <option value="<?=$cliente['equipe_login']?>"><?=$cliente['equipe_login']?></option>
          <option></option>
          <option value="EQUIPE 1" style="display: <?php echo $eq1 ?>">EQUIPE 1</option>
          <option value="EQUIPE 2" style="display: <?php echo $eq2 ?>">EQUIPE 2</option>
          <option value="EQUIPE 3" style="display: <?php echo $eq3 ?>">EQUIPE 3</option>
          <option value="EQUIPE 4" style="display: <?php echo $eq4 ?>">EQUIPE 4</option>
          <option value="EQUIPE 5" style="display: <?php echo $eq5 ?>">EQUIPE 5</option>
          <option value="NET PROSPECT">NET PROSPECT</option>
          <option value="MULTI">MULTI</option>
          <option value="CLARO">CLARO</option>
          <option value="TIM">TIM</option>
          <option value="PARCEIRO CLARO">PARCEIRO CLARO</option>
          <option value="PARCEIRO NET">PARCEIRO NET</option>
          <option value="PARCEIRO TIM">PARCEIRO TIM</option>
          <option value="JLR">JLR</option>
          <option value="FELIPE">FELIPE</option>
          <option value="GERAL"    style="display: <?php echo $eqGeral ?>">GERAL</option>
          </select>
            </div>

        <label class="col-sm-1 control-label" for="textinput">Empresa</label>
        <div class="col-sm-2">
        <select name="empresa_login" value="<?=$cliente['empresa_login']?>" class="form-control" required>
        <option value="<?=$cliente['empresa_login']?>"><?=$cliente['empresa_login']?></option>
        <option></option>
        <option value="EMPRESA 1" style="display: <?php echo $em1 ?>">EMPRESA 1-RSTELECOM</option>
        <option value="EMPRESA 2" style="display: <?php echo $em2 ?>">EMPRESA 2-MACHADO</option>
        <option value="EMPRESA 3" style="display: <?php echo $em3 ?>">EMPRESA 3-LEONARDO</option>
        <option value="EMPRESA 4" style="display: <?php echo $em4 ?>">EMPRESA 4-FLEXCELL</option>
        <option value="EMPRESA 5" style="display: <?php echo $em5 ?>">EMPRESA 5-CRISTIANO</option>
        <option value="EMPRESA 6" style="display: <?php echo $em6 ?>">EMPRESA 6-SAHIMON</option>
        <option value="EMPRESA 7" style="display: <?php echo $em7 ?>">EMPRESA 7-AGNALDO</option>
        <option value="EMPRESA 8" style="display: <?php echo $em8 ?>">EMPRESA 8-JLR</option>
        <option value="EMPRESA 9" style="display: <?php echo $em9 ?>">EMPRESA 9-FELIPE</option>
        <option value="GERAL"     style="display: <?php echo $emg ?>">GERAL</option>
        </select>
        </div>

            <label class="col-sm-1 control-label" for="textinput">Nivel</label>
            <div class="col-sm-1">
          <select name="nivel_login" value="<?=$cliente['nivel_login']?>" class="form-control">
          <option value="<?=$cliente['nivel_login']?>"><?=$cliente['nivel_login']?></option>
          <option></option>
          <option value="1">1 - VENDEDOR</option>
          <option value="2">2 - BACKOFFICE</option>
          <option value="3" style="display: <?php echo $nv ?>">3 - SUPERVISOR</option>
          <option value="4" style="display: <?php echo $nv ?>">4 - ADM</option>
          <option value="5" style="display: <?php echo $nv ?>">5 - LOGINS</option>
          </select>
            </div>


            
	    </div>

		
		<br>
	     <h4><center><strong>Acessos</strong></center></h4>
		<br>
		         

	  <div class="form-group">
	  

	  <label class="col-sm-3 control-label" for="textinput">LEAD SP</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="acessoSP_login" 
      id="acessoSP_login" 
      value="SIM"
      <?php echo ($cliente['acessoSP_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoSP_login" 
      id="acessoSP_login" value="NAO"
      <?php echo ($cliente['acessoSP_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>




      <label class="col-sm-1 control-label" for="textinput">LEAD BR</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio"
      name="acessoBR_login" 
      id="acessoBR_login" 
      value="SIM"
      <?php echo ($cliente['acessoBR_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoBR_login" 
      id="acessoBR_login" 
      value="NAO"
      <?php echo ($cliente['acessoBR_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">RECONEX</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="acessoRX_login" 
      id="acessoRX_login" 
      value="SIM"
      <?php echo ($cliente['acessoRX_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoRX_login"
      id="acessoRX_login" 
      value="NAO"
      <?php echo ($cliente['acessoRX_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>



	   </div>


	   <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput">LEAD MULTI</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="acessoMT_login" 
      id="acessoMT_login" 
      value="SIM"
      <?php echo ($cliente['acessoMT_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoMT_login" 
      id="acessoMT_login" 
      value="NAO"
      <?php echo ($cliente['acessoMT_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">BASE MT</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoMultibase_login"
      id="acessoMultibase_login"
      value="SIM"
      <?php echo ($cliente['acessoMultibase_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoMultibase_login"
      id="acessoMultibase_login"
      value="NAO"
      <?php echo ($cliente['acessoMultibase_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">BASE TV</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoPROPOSTA_login" 
      id="acessoPROPOSTA_login" 
      value="SIM"
      <?php echo ($cliente['acessoPROPOSTA_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoPROPOSTA_login" 
      id="acessoPROPOSTA_login" 
      value="NAO"
      <?php echo ($cliente['acessoPROPOSTA_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>




      </div>

      <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput">LEAD SITE</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoOportunidadeSite_login"
      id="acessoOportunidadeSite_login"
      value="SIM"
      <?php echo ($cliente['acessoOportunidadeSite_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoOportunidadeSite_login"
      id="acessoOportunidadeSite_login"
      value="NAO"
      <?php echo ($cliente['acessoOportunidadeSite_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">EXCLUSIVO</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoLEADSITE_login" 
      id="acessoLEADSITE_login" 
      value="SIM"
      <?php echo ($cliente['acessoLEADSITE_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoLEADSITE_login" 
      id="acessoLEADSITE_login" 
      value="NAO"
      <?php echo ($cliente['acessoLEADSITE_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">PROSPECT</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="acessoPROSPECTS_login" 
      id="acessoPROSPECTS_login" 
      value="SIM"
      <?php echo ($cliente['acessoPROSPECTS_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoPROSPECTS_login" 
      id="acessoPROSPECTS_login" 
      value="NAO"
      <?php echo ($cliente['acessoPROSPECTS_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      </div>

      <div class="form-group">

          <label class="col-sm-3 control-label" for="textinput">LEAD CLARO</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoCLARO_login"
      id="acessoCLARO_login"
      value="SIM"
      <?php echo ($cliente['acessoCLARO_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoCLARO_login"
      id="acessoCLARO_login"
      value="NAO"
      <?php echo ($cliente['acessoCLARO_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Oport.Claro</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoOportunidadeClaro_login"
      id="acessoOportunidadeClaro_login"
      value="SIM"
      <?php echo ($cliente['acessoOportunidadeClaro_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoOportunidadeClaro_login"
      id="acessoOportunidadeClaro_login"
      value="NAO"
      <?php echo ($cliente['acessoOportunidadeClaro_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

       <label class="col-sm-1 control-label" for="textinput">TAG</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoCE_login" 
      id="acessoCE_login" 
      value="SIM"
      <?php echo ($cliente['acessoCE_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoCE_login" 
      id="acessoCE_login" 
      value="NAO"
      <?php echo ($cliente['acessoCE_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>



      </div>

      <div class="form-group">


      <label class="col-sm-3 control-label" for="textinput">LEAD SKY</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoOportunidadeSAC_login"
      id="acessoOportunidadeSAC_login"
      value="SIM"
      <?php echo ($cliente['acessoOportunidadeSAC_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoOportunidadeSAC_login"
      id="acessoOportunidadeSAC_login"
      value="NAO"
      <?php echo ($cliente['acessoOportunidadeSAC_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">LEAD VIVO</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoVIVO_login"
      id="acessoVIVO_login"
      value="SIM"
      <?php echo ($cliente['acessoVIVO_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoVIVO_login"
      id="acessoVIVO_login"
      value="NAO"
      <?php echo ($cliente['acessoVIVO_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">LEAD TIM</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoTIM_login"
      id="acessoTIM_login"
      value="SIM"
      <?php echo ($cliente['acessoTIM_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoTIM_login"
      id="acessoTIM_login"
      value="NAO"
      <?php echo ($cliente['acessoTIM_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      </div>

      <div class="form-group">


      <label class="col-sm-3 control-label" for="textinput">LEAD HUGHES</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoHUGHES_login"
      id="acessoHUGHES_login"
      value="SIM"
      <?php echo ($cliente['acessoHUGHES_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoHUGHES_login"
      id="acessoHUGHES_login"
      value="NAO"
      <?php echo ($cliente['acessoHUGHES_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">LEAD NET</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoNET_login"
      id="acessoNET_login"
      value="SIM"
      <?php echo ($cliente['acessoNET_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoNET_login"
      id="acessoNET_login"
      value="NAO"
      <?php echo ($cliente['acessoNET_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">LEAD GERAL</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoGERAL_login"
      id="acessoGERAL_login"
      value="SIM"
      <?php echo ($cliente['acessoGERAL_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoGERAL_login"
      id="acessoGERAL_login"
      value="NAO"
      <?php echo ($cliente['acessoGERAL_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>



      </div>
<!--

      <label class="col-sm-1 control-label" for="textinput">LEAD SUL</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio"
      name="acessoSL_login" 
      id="acessoSL_login" 
      value="SIM"
      <?php echo ($cliente['acessoSL_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoSL_login" 
      id="acessoSL_login" 
      value="NAO"
      <?php echo ($cliente['acessoSL_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">UTI</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoUTI_login" 
      id="acessoUTI_login" 
      value="SIM"
      <?php echo ($cliente['acessoUTI_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoUTI_login" 
      id="acessoUTI_login" 
      value="NAO"
      <?php echo ($cliente['acessoUTI_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>


	   <div class="form-group">

    

      <label class="col-sm-1 control-label" for="textinput">M.E</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoME_login" 
      id="acessoME_login" 
      value="SIM"
      <?php echo ($cliente['acessoME_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoME_login" 
      id="acessoME_login" 
      value="NAO"
      <?php echo ($cliente['acessoME_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>




	   </div>

	   <div class="form-group">


      <label class="col-sm-3 control-label" for="textinput">Cancelados</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoCANC_login" 
      id="acessoCANC_login" 
      value="SIM"
      <?php echo ($cliente['acessoCANC_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoCANC_login" 
      id="acessoCANC_login" 
      value="NAO"
      <?php echo ($cliente['acessoCANC_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>




	   </div>





     </div>

      <div class="form-group">


    
      <label class="col-sm-3 control-label" for="textinput">Vendas Resumidas</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoVENDARS_login" 
      id="acessoVENDARS_login" 
      value="SIM"
      <?php echo ($cliente['acessoVENDARS_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoVENDARS_login" 
      id="acessoVENDARS_login" 
      value="NAO"
      <?php echo ($cliente['acessoVENDARS_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>




     </div>
-->
<br/>
      <div class="form-group">


      <label class="col-sm-3 control-label" for="textinput">PARCEIROS</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoPARCEIROS_login" 
      id="acessoPARCEIROS_login" 
      value="SIM"
      <?php echo ($cliente['acessoPARCEIROS_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoPARCEIROS_login" 
      id="acessoPARCEIROS_login" 
      value="NAO"
      <?php echo ($cliente['acessoPARCEIROS_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>


      <label class="col-sm-1 control-label" style="color: red" for="textinput">TODOS</label>
      <div class="col-sm-2">
      <div class="input-group">

      <label class="radio-inline">
      <input type="radio" 
      name="acessoTODOS_login" 
      id="acessoTODOS_login" 
      value="SIM"
      <?php echo ($cliente['acessoTODOS_login'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="acessoTODOS_login" 
      id="acessoTODOS_login" 
      value="NAO"
      <?php echo ($cliente['acessoTODOS_login'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>


      </div>


	   <br>
	   <br>


				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-2">
						<a href="con-usuario-lista.php" class="btn btn-default">Voltar</a>
						<button type="submit" class="btn btn-success active">Salvar</button>
					</div>
				</div>

		</div>
</form>
</div>



</body>

<!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

</html>

<?php }else{?>

   <script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>
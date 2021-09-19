<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57



$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


if ($nivel == 2 OR $nivel == 3 OR $nivel == 4 ) {

  $drop = '';

}else{

  $drop = 'none';
}
if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
  $id = intval($_GET['id']);
      $lista = strval($_GET['lista']);




    $campos = array(
      'id_cliente', //0
      'tv_atual',
      'fidelidade_tv',
      'internet_atual',
      'fidelidade_internet',
      'telefonia_atual',
      'fidelidade_telefonia',
      'movel_atual',
      'fidelidade_movel',
      'custo_atual',
      'sabendo_tag',
      'saber_tag',
      'experiencia_tag',
      'lista_sistema',
      'obs_tag',
      'coberturaNET',
      'coberturaVIVO',
      'coberturaTIM'
    );

    $tabelas = array(
      array('clientes', 'id_cliente')

    );
  
  $where = array(
    'id_cliente' => $id
  );


  $stringSql = gera_select($campos, $tabelas, $where);
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

	</head>


<body>




<div class="container">
<!--*************************************FORM *********************************** -->
<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<h4><center><strong style="color: green">PESQUISA TAG</strong></center></h4>
<br/>


<div id="main" class="form-horizontal">
<form action="tabulatag.php?lista=TAG" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;" method="post">



      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">QUAL SUA OPERADORA DE TV ATUALMENTE ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="tv_atual" id="tv_atual" value="<?=$cliente['tv_atual']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
    

      <label class="col-sm-1 control-label" for="textinput">FEDELIDADE</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_tv" 
      id="fidelidade_tv" 
      value="SIM"
      <?php echo ($cliente['fidelidade_tv'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_tv" 
      id="fidelidade_tv" value="NAO"
      <?php echo ($cliente['fidelidade_tv'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      </div>



      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">QUAL SUA OPERADORA DE INTERNET ATUALMENTE ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="internet_atual" id="internet_atual" value="<?=$cliente['internet_atual']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
    

      <label class="col-sm-1 control-label" for="textinput">FEDELIDADE</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_internet" 
      id="fidelidade_internet" 
      value="SIM"
      <?php echo ($cliente['fidelidade_internet'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_internet" 
      id="fidelidade_internet" value="NAO"
      <?php echo ($cliente['fidelidade_internet'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      </div>




      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">QUAL SUA OPERADORA DE TELEFONIA ATUALMENTE ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="telefonia_atual" id="telefonia_atual" value="<?=$cliente['telefonia_atual']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
    

      <label class="col-sm-1 control-label" for="textinput">FEDELIDADE</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_telefonia" 
      id="fidelidade_telefonia" 
      value="SIM"
      <?php echo ($cliente['fidelidade_telefonia'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_telefonia" 
      id="fidelidade_telefonia" value="NAO"
      <?php echo ($cliente['fidelidade_telefonia'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      </div>


      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">QUAL SUA OPERADORA DE TELEFONIA MOVEL ATUALMENTE ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="movel_atual" id="movel_atual" value="<?=$cliente['movel_atual']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

    

      <label class="col-sm-1 control-label" for="textinput">FEDELIDADE</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_movel" 
      id="fidelidade_movel" 
      value="SIM"
      <?php echo ($cliente['fidelidade_movel'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="fidelidade_movel" 
      id="fidelidade_movel" value="NAO"
      <?php echo ($cliente['fidelidade_movel'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      </div>




      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">QUAL SEU CUSTO ATUAL COM ESSES SERVICOS ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="custo_atual" id="custo_atual" value="<?=$cliente['custo_atual']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
      </div>





      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">COMO FICOU SABENDO DA TAG ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="sabendo_tag" id="sabendo_tag" value="<?=$cliente['sabendo_tag']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
      </div>




      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">EXISTE ALGUMA OPERADORA QUE NAO DESEJA TRABALHAR ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="saber_tag" id="saber_tag" value="<?=$cliente['saber_tag']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
      </div>



      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">COMO FOI A SUA EXPERIENCIA COM SERVICOS TELECOM ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="experiencia_tag" id="experiencia_tag" value="<?=$cliente['experiencia_tag']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
      </div>

      <h5><strong>TEM COBERTURA ?</strong></h5>
      <label class="col-sm-1 control-label" for="textinput">NET</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="coberturaNET" 
      id="coberturaNET" 
      value="SIM"
      <?php echo ($cliente['coberturaNET'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="coberturaNET" 
      id="coberturaNET" value="NAO"
      <?php echo ($cliente['coberturaNET'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">VIVO</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="coberturaVIVO" 
      id="coberturaVIVO" 
      value="SIM"
      <?php echo ($cliente['coberturaVIVO'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="coberturaVIVO" 
      id="coberturaVIVO" value="NAO"
      <?php echo ($cliente['coberturaVIVO'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">TIM</label>
      <div class="col-sm-2">
      <div class="input-group">
      
      <label class="radio-inline">
      <input type="radio" 
      name="coberturaTIM" 
      id="coberturaTIM" 
      value="SIM"
      <?php echo ($cliente['coberturaTIM'] == "SIM") ? "checked" : null; ?>/> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" 
      name="coberturaTIM" 
      id="coberturaTIM" value="NAO"
      <?php echo ($cliente['coberturaTIM'] == "NAO") ? "checked" : null; ?>/> NAO
      </label>
      </div>
      </div>




        <!-- Textarea -->
      <div class="form-group">
      <div class="col-sm-12">
        <label for="textinput">OBS</label>
        <div class="input-group">
        <?php 
        echo '<textarea rows="3" readonly maxlength="200" text-transform: uppercase" name="obs_tag" id="obs_tag" class="form-control">' . $cliente['obs_tag'] . '</textarea>';
         ?>
         <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
        </div>
        </div>
      </div>



<br/>
<br/>
<br/>


     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

     <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="">

     <input type="text" style="display: none" name="origemCSV" class="form-control input-md" id="origemCSV" value="TAG">


      </form>
</div>
</div>
</body>
    <!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>


</html>


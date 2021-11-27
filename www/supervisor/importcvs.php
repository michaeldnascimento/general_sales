<?php
session_start();
include_once "../login/verifica.php";


if($nivel == 3 OR $nivel == 4){


if ($empresa == 10) {

$droplista = 'none';

}else{
  $droplista = '';
}



$mensagem = "";
//isset = se existe tal coisa 
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];
//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}


 ?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
		<title>Home Sales</title>


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

 
<!--********************** FORMULARIO ************************************** -->
<div id="main" class="container-fluid">
<br/>
<h4><center><strong>IMPORTAR CSV</strong></center></h4>
<br/>
<form action="importarcsv.php" method="post" enctype="multipart/form-data">
  <div class="row">
          <div class="col-md-12">
            <br />
            <h5 class="msg-padrao"><?=$mensagem;?></h5>
          </div>
</div>

<div class="form-group">
     <label class="col-md-1 control-label" for="selectbasic">LISTA</label>
     <div class="col-md-2">
          
     <select required name="lista_sistema" class="form-control">


      <option value=""></option>
      <option value="OPORTUNIDADES">OPORTUNIDADES</option>
      <option value="OPORTUNIDADES2">OPORTUNIDADES 2</option>
      <option value="PROSPECT">PROSPECT</option>
      <option value="PROSPECT2">PROSPECT 2</option>
      </select>
      </div>

      <label  class="col-sm-1 control-label" for="textinput">Descricao</label>
          <div class="col-sm-3">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" class="form-control" name="origemCSV" id="origemCSV"> </textarea>'
          ?><span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
</div>
<label  class="col-sm-1" for="textinput">Padrão CSV Home Sales:</label>
<a href="http://homesales.com.br/download/PADRAO_CSV_GENERAL.csv" download="PADRAO_HOMESALES.csv">Click Aqui</a>

<br/>
<br/>
<br/>

<div class="form-group">
  <div class="col-sm-12">
  <label  class="col-sm-2" for="textinput">Selecione o arquivo.csv para upload:</label>
  <div class="input-group">
  <input type="file" name="fileToUpload" id="fileToUpload"><br/>
  <button type="submit" name="submit" class="btn btn-block btn-success">Upload CSV</button>
  </div>
  </div>
</div>

</form>

</div>


	</body>
    <!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>
</html>

  <?php }else{?>

  <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

  <?php }?> 
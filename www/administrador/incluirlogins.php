<?php
session_start();
include_once "../login/verifica.php";

if($empresa == '001' && $nivel == 4 OR $nivel == 5){

$lista = strval($_GET['lista']);



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
        <title>Home Sale</title>


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
<br/>
<h4><center><strong>Importar Logins</strong></center></h4>
<br/>
<form action="importarloginscsv.php?lista=<?=$lista;?>" method="post" enctype="multipart/form-data">
  <div class="row">
          <div class="col-md-12">
            <br />
            <h5 class="msg-padrao"><?=$mensagem;?></h5>
          </div>
</div>

<div class="form-group">
  <label class="col-sm- control-label" for="textinput"></label>
  <div class="col-sm-3">
  <label for="textinput">Selecione o arquivo.csv para upload:</label><br/>
  <div class="input-group">
  <input type="file" name="fileToUpload" id="fileToUpload"><br/>
  <button type="submit" name="submit" class="btn btn-block btn-success">Upload CSV</button>
  </div>
  </div>
</div>

</form>




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
<?php
session_start();


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

?>



    <!DOCTYPE html>
    <html>
    <head>
    <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./css/imagens/16x16.ico">
    <title>General Sales 2.0</title>


      <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">



      </head>
      <body>

<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<div class="container">
<br/>

<br />
          <h3 style="color: green"><center><strong>Dados Cliente</strong></center></h3>
<br />

      <!--*************************************FORM *********************************** -->


      <!-- Step Wizard END -->
      <!-- quote form -->

      <div id="main" class="form-horizontal">
      <form action="salvar-insert-img.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;">





<br/>


          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar imagem 1:</label>
          <input type="file" id="img_multisales" name="img_multisales" autofocus>
          </div>

          </div>

<br/>
<br/>



      <!-- SUBMIT FORM BUTTON-->
      <div class="col-sm-2 pull-right">
      <button type="submit" class="btn btn-block btn-success" name="enviar">Salvar</button>
      </div>

  


      </form>
      </div> 

</div>
</body>
            <!-- jQuery -->
      <script src="../js/jquery-2.2.3.min.js"></script>
      <script src="../js/scripts-geral.js"></script>
      <script src="../css/bootstrap/js/bootstrap.min.js"></script>
      <script src="../js/jquery.maskedinput.js"></script>
      <script src="../js/funcao-maske.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>
 </html>

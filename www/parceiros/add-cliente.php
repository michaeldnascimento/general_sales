<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($acessoPARCEIROS == 'SIM' OR $acessoTODOS == 'SIM'){


if ($acessoPARCEIROS == 'SIM') {

  $drop = 'none';

}else{

  $drop = '';
}

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57

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
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">
        <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">

	</head>


<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>




<!--*************************************FORM *********************************** -->
<h3><center><strong>Nova Venda</strong></center></h3>
<br>


<div id="main" class="form-horizontal">
<form action="salvar-cliente.php" method="POST" enctype="multipart/form-data">


        <!-- Text input-->


	    <!-- Text input-->
        <div class="form-group">


           <label class="col-sm-3 control-label" for="textinput">Codigo</label>
            <div class="col-sm-3">
              <div class="input-group">
                <select id="tipo_servico" required name="tipo_servico" class="form-control">
                <option value="">SERVICO</option>
                <option value="NET"> NET</option>
                <option value="CLARO"> CLARO </option>
                </select>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="CODIGO CLIENTE" maxlength="20" class="form-control" name="codigo_cliente" id="codigo_cliente">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

              </div>
            </div>

        </div>


          <div class="form-group">
          <label class="col-sm-3 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar audio:</label>
          <input type="file" id="audio_multisales" name="audio_multisales">
          </div>
          </div>


          <div class="form-group">
          <label class="col-sm-3 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 1:</label>
          <input type="file" id="img_multisales" name="img_multisales" >
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 2:</label>
          <input type="file" id="img_multisales2" name="img_multisales2" >
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar imagem 3:</label>
          <input type="file" id="img_multisales3" name="img_multisales3" >
          </div>

          </div>




				<!-- Textarea -->
			<div class="form-group">
			<label  class="col-sm-3 control-label" for="textinput">Observação</label>
		    	<div class="col-sm-7">
				<div class="input-group">
			  <?php 
			  echo '<textarea rows="2" maxlength="200" text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente" class="form-control">' . '</textarea>';
			   ?>
			   <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
			  </div>
			  </div>
			</div>

			<input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

       <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

       <input type="text" style="display: none" name="flag" class="form-control input-md" id="flag" value="1">

       <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

       <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

      <input type="text" style="display: none" name="motivo_cliente" class="form-control input-md" id="motivo_cliente" value="VENDA - NOVO CLIENTE">

      <input type="text" style="display: none" name="statusPedido_venda_cliente" class="form-control input-md" id="statusPedido_venda_cliente" value="CADASTRO-CONCLUIDO">

      <input type="text" style="display: none" name="statusVenda_venda_cliente" class="form-control input-md" id="statusVenda_venda_cliente" value="ANALISE BACKOFFICE">

      <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="PARCEIROS">





        <!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-8 control-label" for="button1id"></label>
            <div class="col-md-2">
            <button type="submit" name="form1" class="btn btn-block btn-success active">Salvar</button>
          </div>
        </div>

			<!-- Modal -->



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

    <script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

  <?php }?>
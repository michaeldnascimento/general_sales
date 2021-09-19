<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";
include_once "../funcoes/conexaoPortari.php";


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

<script language="javascript">
function update(opcao){
if(opcao=='OK'){
window.close();

}
}
</script>
</head>
<body>


<!--*************************************FORM *********************************** -->


<div class="container">




          <div class="col-sm-12">

         <h4><center><strong style="color:green">PESQUISAR</strong></center></h4>
         <br/>

         <!-- Text input-->
<form action="listavenda-backoffice.php" method="post">
          <div class="form-group">


          <label class="col-sm-2 control-label" for="textinput">D.Incio</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data1"  id="data1" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>


          <label class="col-sm-2 control-label" for="textinput">D.Fim</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data2"  id="data2" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          </div>
          <div class="form-group">



          <label class="col-sm-2 control-label" for="textinput">Status</label>
                <div class="col-sm-3">
                <select id="statusVenda" name="statusVenda" class="form-control">
                <option value=""></option>
                    <option value="ATIVADO">ATIVADO</option>
                    <option value="ATIVADO MIGRACAO">ATIVADO MIGRACAO</option>
                    <option value="NAO ATIVADO">NAO ATIVADO</option>
                    <option value="PENDENTE">PENDENTE</option>
                    <option value="AGENDADO">AGENDADO</option>
                    <option value="QUEBRA">QUEBRA</option>
                    <option value="INSTALADO">INSTALADO</option>
                    <option value="CANCELADO">CANCELADO</option>
                    <option value="REPROVADA">REPROVADA</option>
                    <option value="SSI">SSI</option>
                    <option value="UPGRADE">UPGRADE</option>
                    <option value="DUPLICIDADE CPF">DUPLICIDADE CPF</option>
                    <option value="DUPLICIDADE DCC">DUPLICIDADE DCC</option>
                    <option value="AGUARDANDO PAGAMENTO">AGUARDANDO PAGAMENTO</option>
                    <option value="AGUARDANDO RETORNO BC">AGUARDANDO RETORNO BC</option>
                </select>
                </div>

           <label class="col-sm-2 control-label" for="textinput">Nome Usuario</label>
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="Nome do usuario" class="form-control" name="vendedor" id="vendedor">
                   <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                 </div>
                </div>
          </div>


          <br>


          <div class="form-group">
          <label class="col-md-9 control-label" for="button1id"></label>
          <div class="col-md-2">
          <button type="submit" onclick="update('OK');" class="btn btn-success" data-toggle="modal" data-target="#myModal">Pesquisar</button>
          </div>
          </div>



</div>
</form>
</div>
</body>
</html>




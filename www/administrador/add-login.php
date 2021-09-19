<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

if($empresa == '001' && $nivel == 4 OR $nivel == 5){

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57


$lista = strval($_GET['lista']);
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




<!--*************************************FORM *********************************** -->


<div class="container">
<br/>
        <div class="form-group">
          <div class="col-md-2" style="display: <?php echo $drop ?>">
            <a href="listacitrix.php" class="btn btn-info active">Voltar</a>
          </div>
        </div>


<div id="main">
<form action="add-login-salve.php?lista=<?=$lista;?>" method="POST" class="form-horizontal">


<!--

          <div class="col-sm-12">

         <h4><center><strong style="color:green">Dados Login</strong></center></h4>
         <br/>


          <div class="form-group">



          <label  class="col-sm-1 control-label" for="textinput">Obs</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" maxlength="200" text-transform: uppercase" name="obs" id="obs" class="form-control"></textarea>';
          ?>
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

          </div>


          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Nome</label>
          <div class="col-sm-7">
          <div class="input-group">
          <input type="text" name="nome" class="form-control input-md" id="nome">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div> 

          <label class="col-sm-1 control-label" for="textinput">Enviado</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" name="enviado" class="form-control input-md" id="enviado">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          </div>



          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">CPF</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="cpf" id="cpf">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">RG</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" id="rg">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">D.Nasc</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="data_nasc"  id="data_nasc">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          </div>


          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Origem</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="origem" id="origem">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Local</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="site_local" id="site_local">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

         <label class="col-sm-1 control-label" for="textinput">Depart.</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="departamento" id="departamento">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

          </div>
          </div>
          </div>



          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Cargo</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="cargo" id="cargo">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Matricula</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="matricula" id="matricula">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>



          <label class="col-sm-1 control-label" for="textinput">Centro</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="centro_custo" id="centro_custo">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>



          </div>

-->
<br>
<br>
<br>

         <h3><center><strong style="color:green">Novo Login</strong></center></h3>
         <br/>
         <br/>
         <br/>


                  <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Login</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="login" required>
            <span class="input-group-addon label_white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Senha</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input class="form-control" name="senha" id="senha">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Tipo</label>
          <div class="col-md-3">
          
          <select required name="lista_login" class="form-control">
          <option></option>
          <option value="BACKOFFICE">BACKOFFICE</option>
          <option value="SMS">SMS</option>
          <option value="OUTROS">OUTROS</option>
          </select>
          </div>





          </div>



          <!-- Text input-->
          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Situacao</label>
          <div class="col-md-3">
          
          <select required name="situacao_login" class="form-control">
          <option></option>
          <option value="HABILITADO">HABILITADO</option>
          <option value="RESERVA">RESERVA</option>
          <option value="INDISPONIVEL">INDISPONIVEL</option>
          <option value="OUTROS ACESSOS">OUTROS ACESSOS</option>
          </select>
          </div>


          <label class="col-sm-1 control-label" for="textinput">DT. Insert</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data_reset" id="data_reset">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">DT. Caiu</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data_caiu" id="data_caiu">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          </div>

          <br/>




          <div class="form-group">
          <label class="col-md-10 control-label" for="button1id"></label>
          <div class="col-md-2">
          <button type="submit" class="btn btn-block btn-success" data-toggle="modal" data-target="#myModal">Salvar</button>
          </div>
          </div>


          </div>

</form>
</div>

</div>



</body>
          <!-- jQuery -->
          <script src="../js/jquery-2.2.3.min.js"></script>
          <script src="../js/scripts-geral.js"></script>
          <script src="../css/bootstrap/js/bootstrap.min.js"></script>
          <script src="../css/bootstrap/js/meunavbar2.js"></script>


</html>


<?php }else{?>

   <script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>   

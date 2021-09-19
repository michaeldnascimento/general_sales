<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";



if($empresa == '001' && $nivel == 4 OR $nivel == 5){



if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
$id = intval($_GET['id']);
$lista = strval($_GET['lista']);

//conectar e selecionar o banco de dados mysql/agenda
include_once '../funcoes/conexaoPortari.php';
include_once '../funcoes/funcoes_geraisPortari.php';

$campos = array(
'id_login', //0
'situacao_login', //1
'login',//2
'senha', //3
'data_reset',
'data_caiu',
'rg',
'cpf',
'data_nasc',
'nome',
'origem',
'site_local',
'departamento',
'cargo',
'matricula',
'centro_custo',
'lista_login',
'obs',
'enviado'
);


$tabelas = array(
array('logins', 'id_login')

);

$where = array(
'id_login' => $id
);


$stringSql = gera_select($campos, $tabelas, $where);
$resultado = mysqli_query($linkComMysql, $stringSql);
$cliente = mysqli_fetch_assoc($resultado);
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
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">
</head>
<body>



<!--*************************************FORM *********************************** -->


<div class="container">


<div id="main">
<form action="salvar-login.php?id=<?=$id;?>&lista=<?=$lista;?>" method="POST" class="form-horizontal">


<!--

          <div class="col-sm-12">

         <h4><center><strong style="color:green">Dados Login</strong></center></h4>
         <br/>


          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">ID</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" name="id_cliente" class="form-control input-md" id="id_cliente" value="<?=$cliente['id_login']?>" disabled >
          </div>
          </div>


          <label  class="col-sm-1 control-label" for="textinput">Obs</label>
          <div class="col-sm-8">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" maxlength="200" text-transform: uppercase" name="obs" id="obs" class="form-control">' . $cliente['obs'] . '</textarea>';
          ?>
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

          </div>


          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Nome</label>
          <div class="col-sm-7">
          <div class="input-group">
          <input type="text" name="nome" class="form-control input-md" id="nome" value="<?=$cliente['nome']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div> 


          <label class="col-sm-1 control-label" for="textinput">Enviado</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" name="enviado" class="form-control input-md" id="enviado" value="<?=$cliente['enviado']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          </div>



          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">CPF</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="cpf" id="cpf" value="<?=$cliente['cpf']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">RG</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" id="rg" value="<?=$cliente['rg']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">D.Nasc</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="data_nasc"  id="data_nasc" value="<?=$cliente['data_nasc']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          </div>


    
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Origem</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="origem" id="origem" value="<?=$cliente['origem']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Local</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="site_local" id="site_local" value="<?=$cliente['site_local']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

         <label class="col-sm-1 control-label" for="textinput">Depart.</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="tel" class="form-control" name="departamento" id="departamento" value="<?=$cliente['departamento']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

          </div>
          </div>
          </div>




          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Cargo</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="tel" class="form-control" name="cargo" id="cargo" value="<?=$cliente['cargo']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Matricula</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="tel" class="form-control" name="matricula" id="matricula" value="<?=$cliente['matricula']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>



          <label class="col-sm-1 control-label" for="textinput">Centro</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="tel" class="form-control" name="centro_custo" id="centro_custo" value="<?=$cliente['centro_custo']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>



          </div>


-->

         <h3><center><strong style="color:green">Login</strong></center></h3>
         <br/>

          <!-- Text input-->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Login</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="login" value="<?=$cliente['login']?>">
            <span class="input-group-addon label_white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Senha</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input class="form-control" name="senha" id="senha" value="<?=$cliente['senha']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Tipo</label>
          <div class="col-md-3">
          
          <select required name='lista_login' value="<?=$cliente['lista_login']?>" class="form-control">
          <option value="<?=$cliente['lista_login']?>"><?=$cliente['lista_login']?></option>
          <option></option>
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
          
          <select required name='situacao_login' value="<?=$cliente['situacao_login']?>" class="form-control">
          <option value="<?=$cliente['situacao_login']?>"><?=$cliente['situacao_login']?></option>
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
          <input type="date" class="form-control" name="data_reset" id="data_reset" value="<?=$cliente['data_reset']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">DT. Caiu</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data_caiu" id="data_caiu" value="<?=$cliente['data_caiu']?>">
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

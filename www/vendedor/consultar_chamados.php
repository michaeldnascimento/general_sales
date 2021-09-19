<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";
include_once "../login/visualizarlista.php";


if($acessoPARCEIROS == 'SIM'){

      ?>
      <script> alert('Usuario sem permissão! '); window.history.go(-1); </SCRIPT>;

     <?php
} else{

if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
$id = intval($_GET['id']);




          $campos = array(
          'tabulacao_chamado',
          'codigoNET',
          'propostaNET',
          'cidade_chamado',
          'descricao_chamado',
          'nome_vendedor',
          'data_chamado',
          'hora_chamado',
          'situacao_chamado',
          'nome_back',
          'dataAT_chamado',
          'horaAT_chamado',
          'descricaoRESP_chamado'
          );

          $tabelas = array(
          array('chamados', 'id_chamado')

          );

          $where = array(
          'id_chamado' => $id
          );


          $stringSql = gera_select($campos, $tabelas, $where);
          $resultado = mysqli_query($linkComMysql, $stringSql);
          $cliente = mysqli_fetch_assoc($resultado);
          }


if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
}


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
<html lang="pt-br">
  <head>
    <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
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
<br />
 <h4><center><strong>Consultar Chamado <?=$id;?></strong></center></h4>

        <div class="form-group">
          <div class="col-md-2">
            <a href="lista_chamadosVED.php" class="btn btn-default">Voltar</a>
          </div>
        </div>


<div id="main" class="form-horizontal">
<form action="salvando_chamadoBACK.php?id=<?=$id;?>" name="form1" method="POST">
<div class="col-sm-12">
<br/>

              <!-- Text input-->
      <div class="form-group">

        <label class="col-sm-2 control-label" for="textinput">Vendedor</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text"  placeholder="Nome do Vendedor" maxlength="30" class="form-control" name="nome_vendedor" id="nome_vendedor" value="<?=$cliente['nome_vendedor']?>" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

              </div>
            </div>


        <label class="col-sm-1 control-label" for="textinput">Data</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="date" class="form-control" name="data_chamado" id="data_chamado" value="<?=$cliente['data_chamado']?>" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>

              </div>
            </div>

          <label class="col-sm-1 control-label" for="textinput">Hora</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="time"  name="hora_chamado" class="form-control input-md" id="hora_chamado" value="<?=$cliente['hora_chamado']?>" readonly>
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-time"></i></span>
          </div>
          </div>

      </div>

      <!-- Text input-->
      <div class="form-group">

           <label class="col-sm-2 control-label" for="textinput">Motivo</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input type="text" class="form-control" name="tabulacao_chamado" id="tabulacao_chamado" value="<?=$cliente['tabulacao_chamado']?>" AUTOCOMPLETE="off" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>
        </div>


        <div class="form-group">
           <label class="col-sm-2 control-label" for="textinput">Codigo</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="Codigo NET" maxlength="20" class="form-control" name="codigoNET" id="codigoNET" value="<?=$cliente['codigoNET']?>" AUTOCOMPLETE="off" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>


          <label class="col-sm-1 control-label" for="textinput">N. Proposta</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  maxlength="50" placeholder="Numero Proposta" name="propostaNET" class="form-control input-md" id="propostaNET" value="<?=$cliente['propostaNET']?>" readonly>
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Cidade</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  maxlength="50" style="text-transform: uppercase" name="cidade_chamado" class="form-control input-md" id="cidade_chamado" value="<?=$cliente['cidade_chamado']?>" readonly>
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>


        </div>

          <div class="form-group">

          <label  class="col-sm-2 control-label" for="textinput">Descricao</label>
          <div class="col-sm-8">
          <div class="input-group">
          <?php 
          echo '<textarea rows="4"  style=" text-transform: uppercase" maxlength="1000" text-transform: uppercase" readonly name="descricao_chamado" id="descricao_chamado" class="form-control">' . $cliente['descricao_chamado'] . '</textarea>';
          ?>
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

          </div>

<br />
 <h4><center><strong>Backoffice</strong></center></h4>
<br />

<input type="text" style="display: none" name="nome_back" class="form-control input-md" id="nome_back" value="<?=$nomeUsuario?>">

<input type="text" style="display: none" name="dataAT_chamado" class="form-control input-md" id="dataAT_chamado" value="<?=$dataDia?>">

<input type="text" style="display: none" name="horaAT_chamado" class="form-control input-md" id="horaAT_chamado" value="<?=$horaDia?>">

<input type="text" style="display: none" name="situacao_chamado" class="form-control input-md" id="situacao_chamado" value="ATENDIDA">



          <div class="form-group">

          <label  class="col-sm-2 control-label" for="textinput">Backoffice</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" value="<?=$cliente['nome_back']?>" readonly>
          </div>
          </div>

          <label  class="col-sm-1 control-label" for="textinput">Data</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" value="<?=$cliente['dataAT_chamado']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Hora</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="time"  class="form-control input-md"  value="<?=$cliente['horaAT_chamado']?>" readonly>
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-time"></i></span>
          </div>
          </div>

          </div>

          <div class="form-group">

          <label class="col-md-2 control-label" for="selectbasic">St. Chamado</label>
          <div class="col-md-2">
          
          <select id='situacao_chamado' readonly name='situacao_chamado' class="form-control">
          <option value="<?=$cliente['situacao_chamado']?>"><?=$cliente['situacao_chamado']?></option>
          </select>
          </div>

          </div>

          <div class="form-group">

          <label  class="col-sm-2 control-label" for="textinput">Observacao</label>
          <div class="col-sm-8">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2"  style=" text-transform: uppercase" maxlength="1000" text-transform: uppercase" readonly name="descricaoRESP_chamado" id="descricaoRESP_chamado" class="form-control">' . $cliente['descricaoRESP_chamado'] . '</textarea>';
          ?>
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

          </div>


        <!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-7 control-label" for="button1id"></label>
            <div class="col-md-3">
            <a href="editar_chamado.php?id=<?=$id;?>" class="btn btn-block btn-warning active">Editar</a>
          </div>
        </div>

      <!-- Modal -->


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

 <?php } ?>
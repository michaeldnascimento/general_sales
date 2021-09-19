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

$situacao = $cliente['situacao_chamado'];
if ($situacao == 'EM TRATAMENTO' OR $situacao== 'FINALIZADO') {
  ?>
  <script> alert('Esta chamada ja foi finalizada pelo backoffice, e nao pode ser alterada. '); window.history.go(-1); </SCRIPT>;

  <?php
} else{


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


<?php
include_once "../css/navbar/meunavbar.php";
?>



<!--*************************************FORM *********************************** -->
<br />
 <h4><center><strong>Editar Chamado <?=$id;?></strong></center></h4>

        <div class="form-group">
          <div class="col-md-2">
            <a href="consultar_chamados.php?id=<?=$id;?>" class="btn btn-default">Voltar</a>
          </div>
        </div>


<div id="main" class="form-horizontal">
<form action="salvandoEditado_chamado.php?id=<?=$id;?>" name="form1" method="POST">
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

      <div class="form-group">


      <label class="col-md-2 control-label" for="selectbasic">Motivo*</label>
      <div class="col-md-8">
      
      <select id="tabulacao_chamado" required name="tabulacao_chamado" class="form-control">

      <option value="<?=$cliente['tabulacao_chamado']?>"><?=$cliente['tabulacao_chamado']?></option>
      <option value="AGENDAR CLIENTE">AGENDAR CLIENTE</option>
      <option value="CORRIGIR STATUS VENDAS">CORRIGIR STATUS VENDA</option>
      <option value="COBRAR TECNICO">COBRAR TECNICO</option>
      <option value="CONTESTACAO DE VENDA">CONTESTACAO DE VENDA</option>
      <option value="COBRAR ATIVICAO MULTI">COBRAR ATIVICAO MULTI</option>
      <option value="CANCELAR CONTRATO E GERA NOVA PROPOSTA">CANCELAR CONTRATO E GERA NOVA PROPOSTA</option>
      <option valeu="PROBLEMA MOTIVA/BACKOFFICE">PROBLEMA MOTIVA/BACKOFFICE</option>
      <option value="PROJETO GED">PROJETO GED</option>
      <option value="POSSIBILIDADE DE SP1 - ANTIFRAUDE">POSSIBILIDADE DE SP1 - ANTIFRAUDE</option>
      <option value="REPORTAR INFORMACAO">REPORTAR INFORMACAO</option>
      <option value="VERIFICAR O MOTIVO DE CANCELAMENTO">VERIFICAR O MOTIVO DE CANCELAMENTO</option>
      <option value="OUTROS SUPORTE">OUTROS SUPORTE</option>
      </select>
      </div>
      </div>




        <div class="form-group">
           <label class="col-sm-2 control-label" for="textinput">Codigo</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="Codigo NET" maxlength="20" class="form-control" name="codigoNET" id="codigoNET" AUTOCOMPLETE="off" value="<?=$cliente['codigoNET']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>


          <label class="col-sm-1 control-label" for="textinput">N. Proposta</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  maxlength="50" placeholder="Numero Proposta" name="propostaNET" class="form-control input-md" id="propostaNET" value="<?=$cliente['propostaNET']?>">
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Cidade</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  maxlength="50" style="text-transform: uppercase" name="cidade_chamado" class="form-control input-md" id="cidade_chamado" value="<?=$cliente['cidade_chamado']?>">
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>


        </div>

          <div class="form-group">

          <label  class="col-sm-2 control-label" for="textinput">Observacao</label>
          <div class="col-sm-8">
          <div class="input-group">
          <?php 
          echo '<textarea rows="4"  style=" text-transform: uppercase" maxlength="1000" text-transform: uppercase" name="descricao_chamado" id="descricao_chamado" class="form-control">' . $cliente['descricao_chamado'] . '</textarea>';
          ?>
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

          </div>



    <input type="text" style="display: none" name="nome_vendedor" class="form-control input-md" id="nome_vendedor" value="<?=$nomeUsuario?>">

     <input type="text" style="display: none" name="data_chamado" class="form-control input-md" id="data_chamado" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_chamado" class="form-control input-md" id="hora_chamado" value="<?=$horaDia?>">

     <input type="text" style="display: none" name="situacao_chamado" class="form-control input-md" id="situacao_chamado" value="EM ANALISE">


        <!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-7 control-label" for="button1id"></label>
            <div class="col-md-3">
            <button type="submit" name="form1" class="btn btn-block btn-success active">Salvar</button>
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

<?php } ?>
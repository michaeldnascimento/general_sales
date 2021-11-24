<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/visualizarlista.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57

if ($empresa != 1) {
$obsCad = 'none';
}

$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


//LIBERA NOME DE EQUIPE
if ($acessoSP == 'SIM') {
  $loginNet1 = '';
}else{
  $loginNet1 = 'none';
}

if ($acessoBR == 'SIM') {
  $loginNet2 = '';
}else{
  $loginNet2 = 'none';
}

if ($acessoRX == 'SIM') {
  $loginNet3 = '';
}else{
  $loginNet3 = 'none';
}

if ($acessoMT == 'SIM') {
  $loginSky1 = '';
}else{
  $loginSky1 = 'none';
}

if ($acessoTODOS == 'SIM') {
  $loginNet1 = '';
  $loginNet2 = '';
  $loginNet3 = '';
  $loginSky1 = '';
}


//conectar e selecionar o banco de dados mysql/agenda
include_once '../funcoes/conexaoPortari.php';
include_once '../funcoes/funcoes_geraisPortari.php';

/******************************Buscar os clientes - paginacao**************************/

$stringSql = "SELECT id_login, nome_usuario_login, usuario_login, statusUsuario_login, nivel_login  FROM usuario WHERE statusUsuario_login = 'ATIVO' AND nivel_login = 1 ORDER BY nome_usuario_login";

//mando execultar a query no banco de dados
$resultado = mysqli_query($linkComMysql, $stringSql);

//se eu quiser saber - pego a quantidade de contatos/linhas retornadas na busca
$qtdClientes = mysqli_num_rows($resultado);

$clientes = array();


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
<div class="container">
<!--*************************************FORM *********************************** -->

<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<h4><center><strong style="color: green">VENDA SIMPLIFICADA</strong></center></h4>


<div class="col-md-10" style="display: <?php echo $obsCad ?>">
<div class="btn-group">
  <button type="button" class="btn btn-xs btn-success active">NOVA VENDA</button>
  <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <!--<li><a  href="nova-venda-basemulti.php">BASE MULTI</a></li>
    <li><a  href="nova-venda-basetv.php">BASE TV</a></li>-->
    <li><a  href="nova_venda.php">COMPLETA</a></li>
    <!--<li><a  href="nova-venda-rapida.php">PROSPECT RESUMIDA</a></li>-->
    <li><a  href="nova-venda_simplificada.php">SIMPLIFICADA</a></li>
  </ul>
</div>

</div>





<br/>
<br/>
<br/>
<br/>


<div id="main" class="form-horizontal">
<form action="nova-venda_simplificada-salvar.php" method="POST" enctype="multipart/form-data" class="form-horizontal">

      <div class="form-group">


      <label class="col-sm-2 control-label" for="textinput">CPF/CNPJ</label>
            <div class="col-sm-4">
             <div class="input-group">
              <input type="text" class="form-control" maxlength="19" name="cpf_cnpj_cliente" id="cpfCnpj" AUTOCOMPLETE="off" placeholder="CPF/CNPJ" autofocus required>
              <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
        </div>

        <label class="col-sm-1 control-label" for="textinput">Cidade/UF</label>
            <div class="col-sm-4">
              <div class="input-group">
                <input type="text" placeholder="Cidade"  maxlength="50" class="form-control" required name="cidade_cliente" id="cidade_cliente">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
            </div>

 
          <div class="col-md-1">
          <select name="estado_cliente" class="form-control" required>
          <option value="">UF</option>
          <option value="AC">AC</option>
          <option value="AL">AL</option>
          <option value="AP">AP</option>
          <option value="AM">AM</option>
          <option value="BA">BA</option>
          <option value="CE">CE</option>
          <option value="DF">DF</option>
          <option value="ES">ES</option>
          <option value="GO">GO</option>
          <option value="MA">MA</option>
          <option value="MT">MT</option>
          <option value="MS">MS</option>
          <option value="MG">MG</option>
          <option value="PA">PA</option>
          <option value="PB">PB</option>
          <option value="PR">PR</option>
          <option value="PE">PE</option>
          <option value="PI">PI</option>
          <option value="RJ">RJ</option>
          <option value="RN">RN</option>
          <option value="RS">RS</option>
          <option value="RO">RO</option>
          <option value="RR">RR</option>
          <option value="SC">SC</option>
          <option value="SP">SP</option>
          <option value="SE">SE</option>
          <option value="TO">TO</option>
          </select>
          </div>

        </div>


      <!-- Text input-->
        <div class="form-group">

            <label class="col-md-2 control-label" for="selectbasic">Internet</label>
            <div class="col-md-4">
                <select id="internet_venda_cliente" name="internet_venda_cliente" class="form-control">
                    <option value="">Selecione o plano de internet</option>
                    <option value="100 Mega">100 MEGA</option>
                    <option value="200 Mega">200 MEGA</option>
                    <option value="300 Mega">300 MEGA</option>
                    <option value="600 Mega">600 MEGA</option>
                    <option value="Link dedicado 10 MB">Link dedicado 10 MB</option>
                    <option value="Link dedicado 30 MB">Link dedicado 30 MB</option>
                    <option value="Link dedicado 50 MB">Link dedicado 50 MB</option>
                    <option value="Link dedicado 100 MB">Link dedicado 100 MB</option>
                    <option value="Link dedicado 200 MB">Link dedicado 200 MB</option>
                    <option value="Link dedicado 500 MB">Link dedicado 500 MB</option>
                </select>
            </div>

        <label class="col-sm-1 control-label" for="textinput">ID Pedido</label>
          <div class="col-sm-4">
              <div class="input-group">
              <input type="codigo" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="codigo cliente..." name="codigo_cliente" class="form-control input-md" required AUTOCOMPLETE="off">
              <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
              </div>
          </div>





        </div>


    

 

          <div class="form-group">


          <label  class="col-sm-2 control-label" for="textinput">Data Venda</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="date" required maxlength="10" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Vendedor</label>
          <div class="col-sm-4">
          <div class="input-group">
          <select id="nomeUsuario" name="nomeUsuario" class="form-control">
          <option value="">Selecione vendedor...</option>
          <?php
          while ($cliente = mysqli_fetch_assoc($resultado)) {
            ?>
            <option value="<?= $cliente ['usuario_login']; ?>"><?= $cliente ['usuario_login']; ?></option>
            <?php
          }
          ?>
          </select>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          </div>

          
          <div class="form-group">
          <label class="col-sm-2 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar audio:</label>
          <input type="file" id="audio_multisales" name="audio_multisales">
          </div>
          </div>

          <div class="form-group">
          <label class="col-sm-2 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 1:</label>
          <input type="file" id="img_multisales" name="img_multisales">
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 2:</label>
          <input type="file" id="img_multisales2" name="img_multisales2">
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 3:</label>
          <input type="file" id="img_multisales3" name="img_multisales3">
          </div>

          </div>
<br/>

          <div class="form-group">
          <label class="col-sm-2 control-label" for="textinput">Ocorrência</label>
          <div class="col-sm-3">
          <select name="statusOcorencia_venda_cliente" required id="idTipo" class="form-control">
          <option></option>
          <option value="Conexao/NetSales">Conexão/Sales</option>
          <option value="Produto/Promo">Produto/Promo</option>
          <option value="Outros/Especifique">Outros/Especifique</option>
          </select>
          </div>
          </div>



                    <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-2 control-label" for="textinput"></label>
          <div class="col-sm-9">
          <label for="textinput">Descrição: Ocorrência/Produto/Promoção</label>
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" required id="descricao" disabled="disabled" class="form-control" style="text-transform: uppercase" name="observacao_venda_cliente"></textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>

     <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

     <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

     <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="SIMPLIFICADA">

     <input type="text" style="display: none" name="statusPedido_venda_cliente" class="form-control input-md" id="statusPedido_venda_cliente" value="CADASTRO-CONCLUIDO">

     <input type="text" style="display: none" name="statusVenda_venda_cliente" class="form-control input-md" id="statusVenda_venda_cliente" value="ANALISE BACKOFFICE">

     <input type="text" style="display: none" name="motivo_cliente" class="form-control input-md" id="motivo_cliente" value="VENDA - NOVO CLIENTE">

     <input type="text" style="display: none" name="nome_cliente" class="form-control input-md" id="nome_cliente" value="VENDA SIMPLES">



        <!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-8 control-label" for="button1id"></label>
            <div class="col-md-3">
            <button type="submit" name="form1" class="btn btn-block btn-success active">Salvar</button>
          </div>
        </div>

      <!-- Modal -->



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
      <script src="../js/jquery.maskedinput.min.js"></script>
      <script src="../js/funcao-maskemoney.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>


      <script type="text/javascript">

      $('#idTipo').on('change', function() {
      var tipo = $(this).find('option:selected').text().trim();
      if(tipo != '') {
      $('#descricao').prop("disabled", false);
      }
      if(tipo == '') {
      $('#descricao').prop("disabled", true);
      }
      });

      </script>


</html>


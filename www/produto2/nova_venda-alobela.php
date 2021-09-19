      <?php
      session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

      date_default_timezone_set('America/Sao_Paulo');
      $dataDia = date('Y-m-d'); // Resultado: 2009-02-05
      $horaDia = date('H:i:s'); // Resultado: 03:39:57


      if($empresa != '005'){

      ?>
      <script> alert('Usuario sem permissão! '); window.history.go(-1); </SCRIPT>;

     <?php
      } else{

      if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

      $drop = '';

      }else{

      $drop = 'none';
      }


      ?>



      <!DOCTYPE html>
      <html lang="pt-br">
      <head>
      <meta http-equiv="content-type" content="text/html;charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="../css/imagens/16x16.png">
      <title>General Sales</title>


      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">
      <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">


      </head>
      <body>



<?php
include_once "../css/navbar/meunavbar.php";
?>


 <h4><center><strong>Dados Cliente</strong></center></h4>
 <br/>


      <!--******************************FORM *************************** -->

      <div class="container">

      <!-- quote form -->

      <div id="main" class="form-horizontal">
      <form action="nova_venda-salvar.php" method="POST">




      <div class="col-sm-12">



      <!-- Text input-->
      <div class="form-group">


      <label class="col-sm-1 control-label" for="textinput">Contato</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" name="nome_contato_cliente" maxlength="50"  class="form-control input-md" id="nome_contato_cliente" autofocus>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Nome*</label>
      <div class="col-sm-7">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" placeholder="Nome Completo" maxlength="50"  name="nome_cliente" class="form-control input-md" id="nome_cliente" required>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      </div>


      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" maxlength="19" name="cpf_cnpj_cliente" required id="cpf_cnpj_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">RG/IE</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" maxlength="16" name="rg_ie_cliente" id="rg_ie_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">D.Nasc</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="date" class="form-control" name="data_nasc_cliente" id="data_nasc_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
      </div>
      </div>

      </div>

      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Pessoa</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="tipo_pessoa_cliente" id="PF" value="PF"> PF
      </label>
      <label class="radio-inline">
      <input type="radio" name="tipo_pessoa_cliente" id="PJ" value="PJ"> PJ
      </label>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">Sexo</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="sexo_cliente" id="sexo_cliente" value="M"> M
      </label>
      <label class="radio-inline">
      <input type="radio" name="sexo_cliente" id="sexo_cliente" value="F"> F
      </label>
      <label class="radio-inline">
      <input type="radio" name="sexo_cliente" id="sexo_cliente" value="E"> E
      </label>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">Mae</label>
      <div class="col-sm-5">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="50"  placeholder="Nome da mae" class="form-control" name="nome_mae_cliente" id="nome_mae_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>
      </div>



      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Email</label>
      <div class="col-sm-5">
      <div class="input-group">
      <input type="email" placeholder="email@exemplo.com" maxlength="50" class="form-control" name="email_cliente" id="email_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-envelope"></i></span>
      </div>
      </div>

      </div>



      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
      <div class="col-sm-1">
      <div class="input-group">
      <input type="tel" placeholder="DDD" class="form-control" maxlength="5" name="ddd_fone_cliente" id="ddd_fone_cliente">
      </div>
      </div>


      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="xxxx-xxxx" maxlength="9" class="form-control" name="fone_cliente" id="fone_cliente">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">Celular</label>
      <div class="col-sm-1">
      <div class="input-group">
      <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_celular_cliente" id="ddd_celular_cliente">
      </div>
      </div>

      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="xxxxx-xxxx" maxlength="11" class="form-control" name="celular_cliente" id="celular_cliente">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
      </div>
      </div>

      </div>


      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
      <div class="col-sm-1">
      <div class="input-group">
      <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone3_cliente" id="ddd_fone3_cliente">
      </div>
      </div>


      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="xxxx-xxxx" maxlength="9" class="form-control" name="fone3_cliente" id="fone3_cliente">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
      <div class="col-sm-1">
      <div class="input-group">
      <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone4_cliente" id="ddd_fone4_cliente">
      </div>
      </div>

      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="xxxxx-xxxx" maxlength="11" class="form-control" name="fone4_cliente" id="fone4_cliente">
       <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>

      </div>



      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">CEP*</label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" placeholder="N. do CEP" maxlength="12" class="form-control" name="cep_cliente" required id="cep_cliente">
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Endereco*</label>
      <div class="col-sm-5">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="50" placeholder="Endereco completo" class="form-control" required name="endereco_cliente" id="endereco_cliente">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

     
      <div class="col-sm-1">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" placeholder="N."  maxlength="10" class="form-control" required name="enderecoNumero_cliente" id="enderecoNumero_cliente">

      </div>
      </div>

      
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="15" placeholder="Complemento" class="form-control" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente">
     
      </div>
      </div>

      </div>



      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Bairro</label>
      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="30" class="form-control" name="bairro_cliente" id="bairro_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Cidade*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="30" class="form-control" required name="cidade_cliente" id="cidade_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Estado*</label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="3" class="form-control" required name="estado_cliente" id="estado_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      </div>


<br/>
      <h4><center><strong>Produto</strong></center></h4>
<br/>


 





      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput"></label>
      <div class="col-sm-11">
      <label for="textinput"> Descricao Promocao / Observacao Venda</label>
      <div class="input-group">
      <?php 
      echo '<textarea rows="4" class="form-control" maxlength="300" style="text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente">' . '</textarea>'
      ?>      
      <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
      </div>
      </div>
      </div>

      <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

      <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

      <input type="text" style="display: none" name="motivo_cliente" class="form-control input-md" id="motivo_cliente" value="VENDA - NOVO CLIENTE">

      <input type="text" style="display: none" name="statusVenda_venda_cliente" class="form-control input-md" id="statusVenda_venda_cliente" value="ANALISE BACKOFFICE">

      <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="NOVA VENDA">

      <input type="text" style="display: none" name="flag" class="form-control input-md" id="flag" value="1">

      <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

      <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">


      <!-- SUBMIT FORM BUTTON-->
      <div class="col-sm-2 pull-right">
      <button type="submit" class="btn btn-block btn-success">Salvar</button>
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

 <?php } ?>
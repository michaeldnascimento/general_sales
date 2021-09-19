<?php
session_start();
//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57




if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
  $id = intval($_GET['id']);
      $lista = strval($_GET['lista']);

$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}

          //conectar e selecionar o banco de dados mysql/agenda
          include_once '../funcoes/conexaoPortari.php';
          include_once '../funcoes/funcoes_geraisPortari.php';

          //gera uma query para buscar todos os contatos


          $campos = array(
          'id_cliente', //0
          'nome_contato_cliente',//2
          'rg_ie_cliente', //3
          'cpf_cnpj_cliente',
          'data_nasc_cliente',
          'tipo_pessoa_cliente',
          'email_cliente',
          'fone_cliente',  
          'celular_cliente',
          'fone3_cliente',
          'fone4_cliente',
          'cep_cliente', 
          'endereco_cliente',
          'enderecoNumero_cliente',
          'enderecoComplemento_cliente',
          'bairro_cliente',
          'cidade_cliente',
          'estado_cliente',
          'data_solicitacao',
          'motivo_rejeicao',
          'produto_interesse',
          'observacao_sistema',
          'observacao_cliente',
          'lista_sistema',
          'motivo_cliente'

          );

          $tabelas = array(
          array('clientes', 'id_cliente')

          );

          $where = array(
          'id_cliente' => $id
          ); 


          $stringSql = gera_select($campos, $tabelas, $where);

          //exit("TEXTO GERADO: {$stringSql}");
          //mando executar a query no banco de dados
          $resultado = mysqli_query($linkComMysql, $stringSql);

          $cliente = mysqli_fetch_assoc($resultado);


          //print_r($cliente);
          //exit;
          }



          ?>



<!DOCTYPE html>
<html>
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

<!--*************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE************************* -->




<!--*************************************FORM *********************************** -->


<div class="container">

<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>


    <div id="msgAviso" style="display:none;" class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Antecao !</strong> Nao e permitido voltar pelo botao do browser, Insira a tabulacao e use o botao salvar.
    </div>


    <div class="form-group">
    <div class="col-md-2" style="display: <?php echo $drop ?>">
    <a href="desfazer-flag.php?id=<?=$id;?>&lista=<?=$lista;?>" class="btn btn-info active">Voltar</a>
    </div>
    </div>




<form action="tratadoLista_cliente.php?id=<?=$id;?>&lista=<?=$lista;?>&tratar=LEAD" method="POST" class="form-horizontal" accept-charset="utf-8" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;">


          <div class="col-sm-12">

<br />
          <h4><center><strong>Dados Cliente</strong></center></h4>
<br />
          <!-- Text input-->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">ID</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" name="id_cliente" class="form-control input-md" id="id_cliente" value="<?=$cliente['id_cliente']?>" disabled >
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Contato</label>
          <div class="col-sm-8">
          <div class="input-group">
          <input type="text" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div> 

          </div>


          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" size="12" name="cpf_cnpj_cliente" id="cpf_cnpj_cliente" value="<?=$cliente['cpf_cnpj_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">RG/IE</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="rg_ie_cliente" id="rg_ie_cliente" value="<?=$cliente['rg_ie_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">D.Nasc</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="data_nasc_cliente" id="data_nasc_cliente" value="<?=$cliente['data_nasc_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          </div>

          <!-- Text input-->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Pessoa</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="tipo_pessoa_cliente" id="tipo_pessoa_cliente" value="<?=$cliente['tipo_pessoa_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Email</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="email" class="form-control" name="email_cliente" id="email_cliente" value="<?=$cliente['email_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-envelope"></i></span>
          </div>
          </div>


          </div>






          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Telefone</label>


          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="fone_cliente" id="fone_cliente" value="<?=$cliente['fone_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Celular</label>


          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="celular_cliente" id="celular_cliente" value="<?=$cliente['celular_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
          </div>
          </div>

         <label class="col-sm-1 control-label" for="textinput">Telefone 2</label>



          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  class="form-control" name="fone3_cliente" id="fone3_cliente" value="<?=$cliente['fone3_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Telefone 3</label>


          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="fone4_cliente" id="fone4_cliente" value="<?=$cliente['fone4_cliente']?>" readonly>
           <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>

          </div>



          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">CEP</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="cep_cliente" id="cep_cliente" value="<?=$cliente['cep_cliente']?>" readonly>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Endereco</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" class="form-control" name="endereco_cliente" id="endereco_cliente" value="<?=$cliente['endereco_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>


          <div class="col-sm-1">
          <div class="input-group">
          <input type="text" class="form-control" name="enderecoNumero_cliente" id="enderecoNumero_cliente" value="<?=$cliente['enderecoNumero_cliente']?>" readonly>

          </div>
          </div>


          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente" value="<?=$cliente['enderecoComplemento_cliente']?>" readonly>

          </div>
          </div>

          </div>



          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Bairro</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" class="form-control" name="bairro_cliente" id="bairro_cliente" value="<?=$cliente['bairro_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Cidade</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Estado</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="estado_cliente" id="estado_cliente" value="<?=$cliente['estado_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

          </div>


          <hr />

<br />
          <h4><center><strong>Dados Interesse</strong></center></h4>
<br />


          <div class="form-group">


          <label class="col-sm-1 control-label" for="textinput">Data</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="data_solicitacao" id="data_solicitacao" value="<?=$cliente['data_solicitacao']?>" readonly >
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-globe"></i></span>
          </div>
          </div>

          <label class="col-sm-2 control-label" for="textinput">Motivo Rejeicao</label>
          <div class="col-sm-6">
          <div class="input-group">
          <input type="text" class="form-control" name="motivo_rejeicao" id="motivo_rejeicao" value="<?=$cliente['motivo_rejeicao']?>" readonly >
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>     
          </div>
          </div>


          </div>

          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-11">
          <label for="textinput"> Oferta / Promocao de interesse</label>
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" readonly class="form-control" name="observacao_cliente" id="observacao_cliente">' . $cliente['observacao_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>




          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-11">
          <label for="textinput"> Observacao cliente</label>
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" readonly class="form-control" name="observacao_sistema" id="observacao_sistema">' . $cliente['observacao_sistema'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>
          <hr />

<br />
          <h4><center><strong>Tabulacao</strong></center></h4>
<br />
      <div class="form-group">
      <label class="col-md-1 control-label" for="selectbasic">Tabulacao*</label>
      <div class="col-md-11">
      
      <select id="select" required name="motivo_cliente" class="form-control">

          
      <option value="<?=$cliente['motivo_cliente']?>"><?=$cliente['motivo_cliente']?></option>
      <option style="color:green" value="VENDA - NOVO CLIENTE"> VENDA - NOVO CLIENTE </option>
      <option style="color:green" value="VENDA - UPGRADE + MULTI"> VENDA - UPGRADE + MULTI </option>
      <option style="color:green" value="VENDA - BASE TV"> VENDA - BASE TV </option>
      <option style="color:blue" value="FOLLOW-UP"> OPORTUNIDADE - FOLLOW UP - RETORNO AGENDADO </option>
      <option style="color:blue" value="OPORTUNIDADE - CLIENTE NAO LOCALIZADO"> OPORTUNIDADE - CLIENTE NAO LOCALIZADO </option>
      <option style="color:red" valeu="LIXEIRA - NAO ATENDE/CAIXA POSTAL"> LIXEIRA - NAO ATENDE/ CAIXA POSTAL </option>
      <option style="color:red" valeu="LIXEIRA - NAO TEM INTERESSE"> LIXEIRA - NAO TEM INTERESSE </option>
      <option style="color:red" value="LIXEIRA - NAO TEM COBERTURA VIRTUA"> LIXEIRA - NAO TEM COBERTURA VIRTUA </option>
      <option style="color:red" value="LIXEIRA - NAO TEM COBERTURA TV"> LIXEIRA - NAO TEM COBERTURA TV </option>
      <option style="color:red" valeu="LIXEIRA - NUMERO INCORRETO/ BLOQUEADO"> LIXEIRA - NUMERO INCORRETO/ BLOQUEADO </option>
      <option style="color:red" value="LIXEIRA - CLIENTE REPETIDO"> LIXEIRA - CLIENTE REPETIDO </option>
      <option style="color:red" value="LIXEIRA - CLIENTE JA CONTRATOU O SERVICO"> LIXEIRA - CLIENTE JA CONTRATOU O SERVICO </option>
      <option style="color:red" value="LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR"> LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR </option>
      <option style="color:red" value="LIXEIRA - DESCONECTADO -6 MESES"> LIXEIRA - DESCONECTADO -6 MESES </option>
      <option style="color:red" value="LIXEIRA - SP1"> LIXEIRA - SP1 </option>
      <option style="color:red" value="LIXEIRA - PROBLEMAS TECNICOS/LIGACAO COM PROBLEMAS"> LIXEIRA - PROBLEMAS TECNICOS/ LIGACAO COM PROBLEMAS </option>
      <option style="color:red" value="LIXEIRA - OUTROS - ESPECIFICAR"> LIXEIRA - OUTROS - ESPECIFICAR </option>
      </select>
      </div>
      </div>





        <div class="form-group">
          <div id='mestre'>

          <div id='FOLLOW-UP'>

 
          <label class="col-md-1 control-label" style="width: 400px;" for="selectbasic">Data</label>
          <input type="date"  class="col-md-2" id="data_followup_cliente" name="data_followup_cliente" value="<?=$cliente['data_followup_cliente']?>" class="form-control input-md">

          <label class="col-md-1 control-label" for="selectbasic">Hora</label>
          <input type="time"  class="col-md-2"  id="hora_followup_cliente" name="hora_followup_cliente" value="<?=$cliente['hora_followup_cliente']?>" class="form-control input-md">
          </div>


          </div>
      </div>

    <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

     <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

    <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="<?=$cliente['lista_sistema']?>">

     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">


          <!-- SUBMIT FORM BUTTON-->
          <div class="col-sm-2 pull-right">
          <button type="submit" value="submit" class="btn btn-block btn-success">Salvar</button>
          </div> 

          <br>
          <br>





          </div>

</form>


</div>






</body>
           <!-- jQuery -->
          <script src="../js/jquery-2.2.3.min.js"></script>
          <script src="../js/scripts-geral.js"></script>
          <script src="../css/bootstrap/js/bootstrap.min.js"></script>

          <script type="text/javascript">

(function(window) {
  'use strict';

var noback = {

  //globals
  version: '0.0.1',
  history_api : typeof history.pushState !== 'undefined', 

  init:function(){
    window.location.hash = '#no-back';
    noback.configure();
  },

  hasChanged:function(){
    if (window.location.hash == '#no-back' ){
      window.location.hash = '#BLOQUEIO';
      //mostra mensagem que não pode usar o btn volta do browser
      if($( "#msgAviso" ).css('display') =='none'){
        $( "#msgAviso" ).slideToggle("slow");
      }
    }
  },

  checkCompat: function(){ 
    if(window.addEventListener) { 
      window.addEventListener("hashchange", noback.hasChanged, false); 
    }else if (window.attachEvent) { 
      window.attachEvent("onhashchange", noback.hasChanged); 
    }else{ 
      window.onhashchange = noback.hasChanged; 
    } 
  }, 
   
  configure: function(){ 
    if ( window.location.hash == '#no-back' ) { 
      if ( this.history_api ){ 
        history.pushState(null, '', '#BLOQUEIO'); 
      }else{  
        window.location.hash = '#BLOQUEIO';
        //mostra mensagem que não pode usar o btn volta do browser
        if($( "#msgAviso" ).css('display') =='none'){
          $( "#msgAviso" ).slideToggle("slow");
        }
      } 
    } 
    noback.checkCompat(); 
    noback.hasChanged(); 
  } 
   
  }; 
   
  // AMD support 
  if (typeof define === 'function' && define.amd) { 
    define( function() { return noback; } ); 
  }  
  // For CommonJS and CommonJS-like 
  else if (typeof module === 'object' && module.exports) { 
    module.exports = noback; 
  }  
  else { 
    window.noback = noback; 
  } 
  noback.init();
}(window)); 
</script>


</html>

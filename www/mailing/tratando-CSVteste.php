<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";

if($acessoCANC == 'SIM' OR $acessoPROSPECTS == 'SIM' OR $acessoMultibase == 'SIM' OR $acessoTODOS == 'SIM'){

if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
}


$sqli = strval($_GET['sql']);
$limitFim    = 1; // quantidade de registro por pagina
$limitInicio = $sqli;

$LIMIT = "LIMIT {$limitInicio}, {$limitFim}";

/******************************Buscar os clientes - paginacao**************************/
$stringSql = " SELECT id_cliente FROM clientes WHERE lista_sistema = 'MULTIBASE' AND (motivo_cliente IS NULL AND status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente DESC";

$resut = mysqli_query($linkComMysql, $stringSql);
$qtd   = mysqli_num_rows($resut);


$stringSql = " SELECT id_cliente FROM clientes WHERE lista_sistema = 'MULTIBASE' AND (motivo_cliente IS NULL AND status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente DESC {$LIMIT}";

//echo $stringSql . "<br><br>";
//exit;

//mando execultar a query no banco de dados
$resut = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resut);
$clientes = array();


while ($clien = mysqli_fetch_assoc($resut)) {
  $clientes[] = array(
  'id'                   => $clien ['id_cliente'],
  );
}


if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
     $lista = strval($_GET['lista']);


		$campos = array(
			'id_cliente', //0
      'nome_contato_cliente',
      'cpf_cnpj_cliente', //1
      'ddd_fone_cliente',
      'fone_cliente',
      'ddd_celular_cliente',
      'celular_cliente',
      'ddd_fone3_cliente',
      'fone3_cliente',
      'ddd_fone4_cliente',
      'fone4_cliente',
      'cep_cliente',
      'endereco_cliente',
      'enderecoNumero_cliente',
      'enderecoComplemento_cliente',
      'bairro_cliente',
      'cidade_cliente',
      'estado_cliente',
      'imagem_cliente',
      'imagemCanc_cliente',
      'data_followup_cliente',
      'hora_followup_cliente',
      'codigoAntigo_cliente',
      'data_vendaCSV',
      'numero_proposta_cliente',
      'observacao_sistema',
      'observacao_cliente',
      'lista_sistema'
		);

		$tabelas = array(
			array('clientes', 'id_cliente')

		);
	
	$where = array(
		'id_cliente' => $id
	);


	$stringSql = gera_select($campos, $tabelas, $where);
	$resultado = mysqli_query($linkComMysql, $stringSql);
	$cliente = mysqli_fetch_assoc($resultado);

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


<!--**********************NAVBAR - BARRA DE NAVEGA????O DO SITE******************************** -->
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="tratando-Canc-CSV.php?id=<?=$id;?>&lista=<?=$lista;?>" class="navbar-brand">General Sales</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="#">Lead NET SP</a></li>
              <li><a href="#">Lead NET BR</a></li>
              <li><a href="#">Lead NET Reconex</a></li>
              <li><a href="#">Lead NET Multi</a></li>
              <li><a href="#">Lead NET UTI</a></li>
              <li><a href="#">Lead M.E.</a></li>
              <li><a href="#">Lead C.E</a></li>
              <li><a href="#">Lead Site</a></li>
              <li><a href="#">Propostas</a></li>
              <li><a href="#">Prospects</a></li>
              <li><a href="#">Cancelados</a></li>
              <li><a href="#">Multi Base</a></li>
              <li><a href="#">Oport. General</a></li>
              <li><a href="#">Oport. SAC</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendedor<b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="#">Vendas Concluidas</a></li>
              <li><a href="#">Vendas Pendentes</a></li>
              <li><a href="#">Nao Vendas</a></li>
              <li><a href="#">Agenda Retornos</a></li>
              <li><a href="#">Nova Venda</a></li>
              <li><a href="#">Nova Venda Resumida</a></li>
          </ul>
        </li>
        <li>
        <a href="#">Home</a>
        </li>


      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li><a><?php echo $nomeUsuario?></a></li>
          <li class="active ">
              <a href="#">Sair</a>
            </li>
       </ul>

    </nav>
  </div>
</header>



<!--*************************************FORM *********************************** -->
<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->
<div class="alert alert-success" role="alert" style="display: <?php echo $alerta ?>">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4><center><strong>Atencao ! Deseja completar o cadastro agora ?</strong></center></h4>
<p ALIGN="center"><strong>INFO: </strong><?=$mensagem;?>. Se desejar completar o cadastro agora click no cadastrar agora!</p>

<p ALIGN="right">
<a type="button" href="contratogerando_cliente.php?id=<?=$id;?>" class="btn btn-primary active btn-sm" >Cadastrar Agora</a> 
<a type="button" href="../vendedor/minhas-vendasPendentes.php" class="btn btn-warning active btn-sm" >Cadastrar Depois</a> 
</p>
</div>


<div id="msgAviso" style="display:none;" class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Antecao !</strong> Nao e permitido voltar pelo botao do browser, Insira a tabulacao e use o botao salvar.
</div>
<br/>

<h4><center><strong>Tratando Mailing</strong></center></h4>

       <div class="form-group" style="display: <?php echo $drop ?>">
          <div class="col-md-2">
            <a href="desfazer-flag.php?id=<?=$id;?>&lista=<?=$lista;?>" class="btn btn-default">Voltar</a>
          </div>
        </div>

     <?php 


      foreach ($clientes as $key => $clie) {
        $id = $clie['id'];

        $atualleft  = $sqli - 1;
        $atualright = $sqli + 1;


      if ($sqli == 0){
        $visualizarbutton1 = 'disabled';
        $visualizarbutton2 = '';
      }

      if ($sqli != 0){
        $visualizarbutton1 = 'disabled';
        $visualizarbutton2 = 'disabled';
      }



      ?>

    <tr>


       <td class="actions">
        <a class="btn btn-default btn-xs <?php echo $visualizarbutton1 ?>" href="tratando-CSVteste.php?id=<?=$clie['id'];?>&usuario=<?=$nomeUsuario?>&lista=MULTIBASE&sql=<?=$atualleft?>"><span class="glyphicon glyphicon-chevron-left"></span></a>
        </td>

        <td></td>
        <td>Registro <?=$sqli?> de <?=$qtd?></td>
        <td></td>

        <td class="actions">
        <a class="btn btn-default btn-xs <?php echo $visualizarbutton2 ?>" href="tratando-CSVteste.php?id=<?=$clie['id'];?>&usuario=<?=$nomeUsuario?>&lista=MULTIBASE&sql=<?=$atualright?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </td>
    </tr>



      <?php

         }

       ?>


<div id="main" class="form-horizontal">
<form action="tratadoLista_cliente.php?id=<?=$id;?>&lista=<?=$lista;?>&tratar=CSV" method="POST">

	<div class="col-sm-12">
  <br>
  <br>


        <!-- Text input-->
 <div class="form-group">


         <label class="col-sm-2 control-label" for="textinput">ID</label>
            <div class="col-sm-1">
             <div class="input-group">
             <input type="text" name="id_cliente" class="form-control input-md" id="id_cliente" value="<?=$cliente['id_cliente']?>" disabled>
             </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Contato</label>
            <div class="col-sm-7">
             <div class="input-group">
             <input type="text" style=" text-transform: uppercase" maxlength="50" placeholder="Nome do contato" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>" required autofocus>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>

       </div>


      <!-- Text input-->
 


      <!-- Text input-->
      <div class="form-group">

        <label class="col-sm-2 control-label" for="textinput">CPF/CNPJ*</label>
            <div class="col-sm-3">
            <div class="input-group">
            <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" maxlength="19" name="cpf_cnpj_cliente" id="cpf_cnpj_cliente" value="<?=$cliente['cpf_cnpj_cliente']?>">
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
            </div>
            </div>
      
      <label  class="col-sm-2 control-label" for="textinput">Tel. Fixo</label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone_cliente" required id="ddd_fone_cliente" value="<?=$cliente['ddd_fone_cliente']?>">
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="11" class="form-control" name="fone_cliente" required id="fone_cliente" value="<?=$cliente['fone_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
              </div>

            <input type="button" id="botao" value="mostra" onClick="ativa()"> 
      </div>

  <div id='div' style='display:none'> 

      <div class="form-group">

      <label  class="col-sm-2 control-label" for="textinput">Celular</label>
         <div class="col-sm-1">
                 <div class="input-group">
                  <input type="text" placeholder="DDD" maxlength="5" class="form-control" name="ddd_celular_cliente" id="ddd_celular_cliente" value="<?=$cliente['ddd_celular_cliente']?>">
                 </div>
                </div>

                            
          <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text"  placeholder="9xxxx-xxxx" maxlength="11" class="form-control" name="celular_cliente" id="celular_cliente" value="<?=$cliente['celular_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
                 </div>
            </div>
      
      <label  class="col-sm-1 control-label" for="textinput">Tel. Fixo 2</label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone3_cliente" id="ddd_fone3_cliente" value="<?=$cliente['ddd_fone3_cliente']?>">
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="11" class="form-control" name="fone3_cliente" id="fone3_cliente" value="<?=$cliente['fone3_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
              </div>
      </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label" for="textinput">Celular 2</label>
         <div class="col-sm-1">
                 <div class="input-group">
                  <input type="text" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone4_cliente" id="ddd_fone4_cliente" value="<?=$cliente['ddd_fone4_cliente']?>">
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="11" class="form-control" name="fone4_cliente" id="fone4_cliente" value="<?=$cliente['fone4_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
                 </div>
              </div>
        </div>
    </div>

          <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-2 control-label" for="textinput">CEP*</label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" placeholder="N. do CEP" maxlength="9" class="form-control" name="cep_cliente" id="cep_cliente" value="<?=$cliente['cep_cliente']?>">
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Endereco*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" placeholder="Endereco completo" class="form-control" name="endereco_cliente" id="endereco_cliente" value="<?=$cliente['endereco_cliente']?>">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

     
      <div class="col-sm-1">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="10" placeholder="N." class="form-control" name="enderecoNumero_cliente" id="enderecoNumero_cliente" value="<?=$cliente['enderecoNumero_cliente']?>">

      </div>
      </div>

      
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="15" placeholder="Complemento" class="form-control" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente" value="<?=$cliente['enderecoComplemento_cliente']?>">
     
      </div>
      </div>

      </div>


      <div class="form-group">

      <label class="col-sm-2 control-label" for="textinput">Bairro</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" class="form-control" name="bairro_cliente" id="bairro_cliente" value="<?=$cliente['bairro_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

        <label class="col-sm-1 control-label" for="textinput">Cidade</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" maxlength="20" class="form-control" required name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
            </div>

 
        <label class="col-sm-1 control-label" for="textinput">Estado</label>
             <div class="col-sm-2">
               <div class="input-group">
                <input type="text" style="text-transform: uppercase" maxlength="3" class="form-control" required name="estado_cliente" id="estado_cliente" value="<?=$cliente['estado_cliente']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
              </div>
        </div>
  


      <div class="form-group">

          <label class="col-md-2 control-label" for="selectbasic">Tabulacao</label>
          <div class="col-md-9">
          
          <select id="select" required name="motivo_cliente" value="<?=$cliente['motivo_cliente']?>" class="form-control">

          
      <option value="">SELECIONE</option>
      <option value="VENDA - NOVO CLIENTE"> VENDA - NOVO CLIENTE </option>
      <option value="VENDA - UPGRADE"> VENDA - UPGRADE </option>
      <option value="VENDA - UPGRADE + MULTI"> VENDA - UPGRADE + MULTI </option>
      <option value="FOLLOW-UP"> NAO VENDA - FOLLOW UP - RETORNO AGENDADO </option>
      <option value="NAO VENDA - TELEFONE NAO ATENDE"> NAO VENDA - TELEFONE NAO ATENDE </option>
      <option value="NAO VENDA - TELEFONE NAO PERTENCE AO CLIENTE"> NAO VENDA - TELEFONE NAO PERTENCE AO CLIENTE</option>
      <option value="NAO VENDA - CLIENTE NAO LOCALIZADO"> NAO VENDA - CLIENTE NAO LOCALIZADO </option>
      <option value="NAO VENDA - DECISOR AUSENTE - REAGENDADO"> NAO VENDA - DECISOR AUSENTE - REAGENDADO </option>
      <option valeu="NAO VENDA - NAO TEM INTERESSE EM NOVA ASSINATURA"> NAO VENDA - NAO TEM INTERESSE EM NOVA ASSINATURA </option>
      <option value="NAO VENDA - PROBLEMAS TECNICOS"> NAO VENDA - PROBLEMAS TECNICOS </option>
      <option value="NAO VENDA - NAO TEM COBERTURA VIRTUA"> NAO VENDA - NAO TEM COBERTURA VIRTUA </option>
      <option value="NAO VENDA - NAO TEM COBERTURA TODOS OS SERVICOS"> NAO VENDA - NAO TEM COBERTURA TODOS OS SERVICOS </option>
      <option value="NAO VENDA - ENDERE??O BLOQUEADO"> NAO VENDA - ENDERECO BLOQUEADO </option>
      <option value="NAO VENDA - CLIENTE REPETIDO"> NAO VENDA - CLIENTE REPETIDO </option>
      <option value="NAO VENDA - CLIENTE JA CONTRATOU O SERVICO"> NAO VENDA - CLIENTE JA CONTRATOU O SERVICO </option>
      <option value="NAO VENDA - SENDO ATENDIDO POR OUTRO VENDEDOR"> NAO VENDA - SENDO ATENDIDO POR OUTRO VENDEDOR </option>
      <option value="NAO VENDA ??? EM ATENDIMENTO COM O VENDEDOR DA EMPRESA"> NAO VENDA - EM ATENDIMENTO COM O VENDEDOR DA EMPRESA VENDEDOR </option>
      <option value="NAO VENDA ??? EM ATENDIMENTO COM O VENDEDOR NET"> NAO VENDA - EM ATENDIMENTO COM O VENDEDOR NET </option>
      <option value="NAO VENDA - OUTROS - ESPECIFICAR"> NAO VENDA - OUTROS - ESPECIFICAR </option>
          </select>
          </div>
          </div>

          



        <div class="form-group">
          <div id='mestre'>
          
          <div id='FOLLOW-UP'>
          
          <label style="width: 400px;" class="col-md-3 control-label" for="selectbasic">Data</label>
          <input type="date"  class="col-md-2" id="data_followup_cliente" name="data_followup_cliente" value="<?=$cliente['data_followup_cliente']?>" class="form-control input-md">

          <label class="col-md-1 control-label" for="selectbasic">Hora</label>
          <input type="time"  class="col-md-2"  id="hora_followup_cliente" name="hora_followup_cliente" value="<?=$cliente['hora_followup_cliente']?>" class="form-control input-md">
          </div>


          </div>
      </div>

            <div class="form-group">


           <label class="col-sm-2 control-label" for="textinput">N. Contrato Ant.</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="N. do contrato Anterior" maxlength="20" class="form-control" name="codigoAntigo_cliente" id="codigoAntigo_cliente" value="<?=$cliente['codigoAntigo_cliente']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>


          <label class="col-sm-1 control-label" for="textinput">Data Venda</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="date" placeholder="data da venda" maxlength="20" class="form-control"value="<?=$cliente['data_vendaCSV']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>



            <label class="col-sm-2 control-label" for="textinput">Proposta</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="N. Proposta" maxlength="20" class="form-control" name="numero_proposta_cliente" id="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>

        </div>




        <!-- Textarea -->
      <div class="form-group">
      <label  class="col-sm-2 control-label" for="textinput">Observacao</label>
          <div class="col-sm-9">
        <div class="input-group">
        <?php 
        echo '<textarea rows="2" maxlength="200" text-transform: uppercase" name="observacao_cliente" id="observacao_cliente" class="form-control">' . $cliente['observacao_cliente'] . '</textarea>';
         ?>
         <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
        </div>
        </div>
      </div>

    <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

    <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

    <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="<?=$cliente['lista_sistema']?>">

    <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

    <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">


        <!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-9 control-label" for="button1id"></label>
            <div class="col-md-2">
            <button type="submit" class="btn btn-block btn-success active">Salvar</button>
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
      //mostra mensagem que n??o pode usar o btn volta do browser
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
        //mostra mensagem que n??o pode usar o btn volta do browser
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


<?php }else{?>

  <script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>
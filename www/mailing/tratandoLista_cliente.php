<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";





if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
      $lista = strval($_GET['lista']);



		$campos = array(
			'id_cliente', //0
      'nome_contato_cliente',
      'cidade_cliente',
			'imagem_cliente',
			'imagemCanc_cliente',
			'data_followup_cliente',
			'hora_followup_cliente',
      'motivo_cliente',
      'codigoAntigo_cliente',
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

if ($cliente['imagemCanc_cliente'] != '') {
	
	$imagemAtual = $cliente['imagemCanc_cliente'];
}else{

	$imagemAtual = $cliente['imagem_cliente'];
}


if ($nivel == 2 OR $nivel == 3 OR $nivel == 4 ) {

  $drop = '';

}else{

  $drop = 'none';
}

$motivo_cliente = $cliente['motivo_cliente'];
if ($motivo_cliente == 'VENDA - NOVO CLIENTE'){
$ref = 'venda_simplificada.php';

}else{
$ref = 'venda_simplificada.php';
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


    <style type="text">
    input {
    background-image: url(../print/<?=$imagemAtual?>);
    }


    input.imagem {
    font-size: 16px;        /* CONFLITO: Só pra mostrar uma outra propriedade conflitante */  
    padding-left: 23px;
    padding-top: 5px;
    height: 20px;
    background-image: url(../print/<?=$imagemAtual?>); /* CONFLITO */
    background-repeat: no-repeat;
    }
    
    </style>

	</head>


<body>




  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>SCRIPT COMERCIAL</strong></h4>
      </div>
      <div class="modal-body">
<p><strong>Script abordagem opcao 1</strong></p>
Ola, bom dia / boa tarde / boa noite<br>
Por gentileza o (a)  Sr (a) .........................?<br>
Meu nome e ...................... sou Representante Comercial da NET, tudo bom?<br>
<p>Estou ligando para passar algumas condicoes especiais sobre TV, internet e telefonia para o seu endereco, recebi uma indicacao e estou retornando o contato.</p>
<hr/>
<p><strong>Script abordagem opcao 2</strong></p>
Ola, bom dia / boa tarde / boa noite<br>
Por favor o (a) Sr.(a)...................?<br>
Meu nome e................ sou Representante de vendas da NET, tudo bem?<br>
<p>Estou ligando pra saber se voce necessita de algum servico como telefonia, TV ou internet?<p>
<hr/>
<p><strong>Script CheckList prospect:</strong></p>

<p>Sr. (sra), ......o Sr esta adquirindo:<br>
* Informar os servicos contratados;<br>
* Valor total mensal dos servicos contratados; em caso de boleto, acrescentqar o valor e informar o cliente;<br>
* Lembrar sobre a utilizacao do 21 no fixo (de acordo com o plano) e no movel para ligacoes DDD e DDI;<br>
* Reforcar que ligacoes excedentes do fixo e do movel serao cobradas a parte;<br>
* Em caso de fidelidade informar o periodo e valor;<br>
* Primeira fatura em formato de pro-rata;<br>
* Em caso de promocao especificar o periodo<br>
* Instalacao:  dia da semana, data e copia do documento com foto do titular da assinatura.<br>
Caso a instalacao seja acompanhada por outra pessoa tambem sera necessario a copia do documento;<br>
* Informar ao cliente que o numero do protocolo sera enviado via SMS ou email em ate 24 horas<br></p>

<p>Lembrando que sua fatura sera enviada atraves do seu email xxxxxx@xxxx.com.br. E em  ate 05 dias uteis sera enviado o Aviso de Compra Net, com as informacoes do servico contratados.<br>
0 (a) Sr (a) tera acesso ao seu contrato e tambem podera realizar diversas solicitacoes no espaco reservado ao cliente no site www.net.tv.br, na area "acesso minha net" e iniciar o cadastro utilizando o CNPJ/CPF do titular;</p>

<p>Em caso de venda de combo multi<br>
* Reforcar o plano de minutos;<br>
* Reforcar que para usufruir de todos os beneficios informados, inclusive o dobro do VTA, a ativacao do chip deve ser feita atraves do telefone 0800 723 6626 (pedir para que o cliente confirme o numero informado).<br>
O (a) Sr (a) podera receber ligacoes da net solicitando o envio de documentos para o email cliente_net@net.com.br<br>
O Sr. Concorda com os valores e servicos contratados</p>

<p>Parabens pela aquisicao!!!</p>



      </div>
    </div>
  </div>
</div>



<!--*************************FORM *********************************** -->
<!--*********MESSAGEM DO SISTEMA - BASEADO EM SESSOES****************** -->
<div class="alert alert-success" role="alert" style="display: <?php echo $alerta ?>">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4><center><strong>Atencao ! Deseja completar o cadastro agora ?</strong></center></h4>
<p ALIGN="center"><strong>INFO: </strong><?=$mensagem;?>. Se desejar completar o cadastro agora click no cadastrar agora!</p>

<p ALIGN="right">

<a type="button" href="<?php echo $ref?>?id=<?=$id;?>&lista=<?=$lista;?>" class="btn btn-primary active btn-sm" >Cadastrar Agora</a> 

<a type="button" href="../vendedor/minhas-vendasPendentes.php" class="btn btn-warning active btn-sm" >Cadastrar Depois</a> 
</p>
</div>


<div id="msgAviso" style="display:none;" class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Antecao !</strong> Nao e permitido voltar pelo botao do browser, Insira a tabulacao e use o botao salvar.
</div>
<br/>
<br />

        <div class="form-group">
          <div class="col-md-2" style="display: <?php echo $drop ?>">
            <a href="desfazer-flag.php?id=<?=$id;?>&lista=<?=$lista;?>" class="btn btn-info active">Voltar</a>
          </div>
        </div>

        <div class="form-group">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-xs active" data-toggle="modal" data-target="#myModal">
            Script
            </button>
        </div>

        </div>



<div id="main" class="form-horizontal">
<form action="tratadoLista_cliente.php?id=<?=$id;?>&lista=<?=$lista;?>&tratar=LEAD" name="form1" method="POST">

<div class="col-sm-12">


<div id='div' style='display:none'> 
      <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput"></label>
      <div class="col-sm-8">
      <div class="input-group">
      <input type="text" style='background: url(../print/<?=$imagemAtual?>) -5px -260px; width: 725px; height: 77px;'  class="form-control input-md" disabled>
      </div>
      </div>

      </div>

      <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput"></label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style='background: url(../print/<?=$imagemAtual?>) -5px -470px; width: 346px; height: 30px;'  class="form-control input-md" disabled>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput"></label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style='background: url(../print/<?=$imagemAtual?>) -270px -370px; width: 251px; height: 30px;' class="form-control input-md" disabled>
      </div>
      </div>


      </div>

</div>
	<br />

		<div class="form-group">
    <button type="button" id="botao" class="btn btn-default active btn-xs" title="Mostrar Imagem" onClick="ativa()"><span class="glyphicon glyphicon-picture"></span></button>
       <label class="col-sm-2 control-label" for="textinput"></label>
		    	<div class="col-sm-9">
				<div class="input-group">
			  <?php 
			  echo '<textarea rows="5" readonly  name="observacao_sistema" id="observacao_sistema" class="form-control">' . $cliente['observacao_sistema'] . '</textarea>';
			   ?>
			   <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
			  </div>
			  </div>
			</div>

  <br />



        <!-- Text input-->
        <div class="form-group">


         <label class="col-sm-2 control-label" for="textinput">ID</label>
            <div class="col-sm-1">
             <div class="input-group">
             <input type="text" name="id_cliente" class="form-control input-md" id="id_cliente" value="<?=$cliente['id_cliente']?>" disabled>
             </div>
            </div>


      <label class="col-md-1 control-label" for="selectbasic">Tabulacao*</label>
      <div class="col-md-7">
      
      <select id="select" required name="motivo_cliente" class="form-control">

          
      <option value="<?=$cliente['motivo_cliente']?>"><?=$cliente['motivo_cliente']?></option>
      <option style="color:green" value="VENDA - NOVO CLIENTE"> VENDA - NOVO CLIENTE </option>
      <option style="color:green" value="VENDA - UPGRADE + MULTI"> VENDA - UPGRADE + MULTI </option>
      <option style="color:green" value="VENDA - BASE TV"> VENDA - BASE TV </option>
      <option style="color:blue" value="FOLLOW-UP"> OPORTUNIDADE - FOLLOW UP - RETORNO AGENDADO </option>
      <option style="color:blue" value="OPORTUNIDADE - CLIENTE NAO LOCALIZADO"> OPORTUNIDADE - CLIENTE NAO LOCALIZADO </option>
      <option style="color:blue" value="CORPORATIVO"> OPORTUNIDADE - CORPORATIVO </option>
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

        <div class="form-group">
           <label class="col-sm-2 control-label" for="textinput">Codigo*</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="Codigo antigo" maxlength="20" class="form-control" name="codigoAntigo_cliente" value="<?=$cliente['codigoAntigo_cliente']?>" AUTOCOMPLETE="off" required>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>


          <label class="col-sm-1 control-label" for="textinput"> Proposta</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  maxlength="50" placeholder="Numero Proposta" name="numero_proposta_cliente" class="form-control input-md" id="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>">
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Contato</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" style=" text-transform: uppercase" maxlength="50" placeholder="Nome do contato" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>


        </div>

          <div class="form-group">

          <label  class="col-sm-2 control-label" for="textinput">Observacao</label>
          <div class="col-sm-9">
          <div class="input-group">
          <?php 
          echo '<textarea rows="1" maxlength="200" text-transform: uppercase" name="observacao_cliente" id="observacao_cliente" class="form-control">' . $cliente['observacao_cliente'] . '</textarea>';
          ?>
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

          </div>


		<input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

     <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

     <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="<?=$cliente['lista_sistema']?>">

     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

     <input type="text" style="display: none" name="cidade_cliente" class="form-control input-md" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>">


				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-2">
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

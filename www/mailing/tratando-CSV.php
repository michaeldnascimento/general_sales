<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";

if($acessoCANC == 'SIM' OR $acessoOportunidadeSAC == 'SIM' OR $acessoPROSPECTS == 'SIM' OR $acessoMultibase == 'SIM' OR $acessoTODOS == 'SIM'){




if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);
     $lista = strval($_GET['lista']);


		$campos = array(
			'id_cliente', //0
      'nome_contato_cliente',
      'cpf_cnpj_cliente', //1
      'nome_mae_cliente',
      'ddd_fone_cliente',
      'fone_cliente',
      'ddd_celular_cliente',
      'celular_cliente',
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
      'motivo_cliente',
      'lista_sistema',
      'numHP_cliente'
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

if ($nivel == 2 OR $nivel == 3 OR $nivel == 4 ) {

  $drop = '';

}else{

  $drop = 'none';
}

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
		<title>Home Sales</title>

		<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">

	</head>
<body>





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

       <div class="form-group" style="display: <?php echo $drop ?>">
          <div class="col-md-2">
            <a href="desfazer-flag.php?id=<?=$id;?>&lista=<?=$lista;?>" class="btn btn-default">Voltar</a>
          </div>
        </div>

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

        <label class="col-sm-2 control-label" for="textinput">CPF/CNPJ</label>
            <div class="col-sm-2">
            <div class="input-group">
            <input type="text" class="form-control" maxlength="19" name="cpf_cnpj_cliente" id="cpf_cnpj_cliente" value="<?=$cliente['cpf_cnpj_cliente']?>">
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
            </div>
            </div>



            <label class="col-sm-1 control-label" for="textinput">Mae</label>
            <div class="col-sm-6">
            <div class="input-group">
            <input type="text" placeholder="NOME DA MAE" class="form-control" maxlength="100" name="nome_mae_cliente" id="nome_mae_cliente" value="<?=$cliente['nome_mae_cliente']?>">
            <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
            </div>
            </div>
      </div>
      
    <div class="form-group">


           <label class="col-sm-2 control-label" for="textinput">Contrato</label>
      <div class="col-sm-2">
        <div class="input-group">
          <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="N. do contrato Anterior" maxlength="20" class="form-control" name="codigoAntigo_cliente" id="codigoAntigo_cliente" value="<?=$cliente['codigoAntigo_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

        </div>
      </div>


               <label  class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone_cliente" id="ddd_fone_cliente" value="<?=$cliente['ddd_fone_cliente']?>">
                 </div>
                </div>

                            
                <div class="col-sm-2">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="11" class="form-control" name="fone_cliente" id="fone_cliente" value="<?=$cliente['fone_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
              </div>

         <input type="button" id="botao" value="mostra" onClick="ativa()">


      </div>

    <div id='div' style='display:none'> 

    <div class="form-group">

              <label  class="col-sm-8 control-label" for="textinput">Celular</label>
         <div class="col-sm-1">
                 <div class="input-group">
                  <input type="text" placeholder="DDD" maxlength="5" class="form-control" name="ddd_celular_cliente" id="ddd_celular_cliente" value="<?=$cliente['ddd_celular_cliente']?>">
                 </div>
                </div>


          <div class="col-sm-2">
                 <div class="input-group">
                   <input type="text"  placeholder="9xxxx-xxxx" maxlength="11" class="form-control" name="celular_cliente" id="celular_cliente" value="<?=$cliente['celular_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
                 </div>
            </div>

        </div>

      </div>




          <!-- Text input-->
      <div class="form-group">

      <label class="col-sm-2 control-label" for="textinput">HP</label>
      <div class="col-sm-1">
      <div class="input-group">
      <input type="text" maxlength="20" class="form-control" name="numHP_cliente" id="numHP_cliente" value="<?=$cliente['numHP_cliente']?>">
      </div>
      </div>



      <label  class="col-sm-1 control-label" for="textinput">Endereco</label>
      <div class="col-sm-4">
      <div class="input-group">
      <?php 
      echo '<textarea rows="2" maxlength="200" text-transform: uppercase" name="endereco_cliente" id="endereco_cliente" class="form-control">' . $cliente['endereco_cliente'] . '</textarea>';
      ?>
      <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-home"></i></span>
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
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" maxlength="20" class="form-control" required name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
            </div>

 
        <label class="col-sm-1 control-label" for="textinput">Estado</label>
          <div class="col-md-1">
          <select name="estado_cliente" class="form-control" required>
          <option value="<?=$cliente['estado_cliente']?>"><?=$cliente['estado_cliente']?></option>
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
  


      <div class="form-group">

          <label class="col-md-2 control-label" for="selectbasic">Tabulacao</label>
          <div class="col-md-9">
          
          <select id="select" required name="motivo_cliente" value="<?=$cliente['motivo_cliente']?>" class="form-control">

          
      <option value="<?=$cliente['motivo_cliente']?>"><?=$cliente['motivo_cliente']?></option>
      <option style="color:green" value="VENDA - NOVO CLIENTE"> VENDA - NOVO CLIENTE </option>
      <option style="color:green" value="VENDA - UPGRADE + MULTI"> VENDA - UPGRADE + MULTI </option>
      <option style="color:blue" value="FOLLOW-UP"> OPORTUNIDADE - FOLLOW UP - RETORNO AGENDADO </option>
      <option style="color:blue" value="OPORTUNIDADE - CLIENTE NAO LOCALIZADO">OPORTUNIDADE - CLIENTE NAO LOCALIZADO </option>
      <option style="color:red" valeu="LIXEIRA - NAO TEM INTERESSE EM NOVA ASSINATURA"> LIXEIRA - NAO TEM INTERESSE EM NOVA ASSINATURA </option>
      <option style="color:red" value="LIXEIRA - PROBLEMAS TECNICOS"> LIXEIRA - PROBLEMAS TECNICOS </option>
      <option style="color:red" value="LIXEIRA - NAO TEM COBERTURA VIRTUA"> LIXEIRA - NAO TEM COBERTURA VIRTUA </option>
      <option style="color:red" value="LIXEIRA - NAO TEM COBERTURA TV"> LIXEIRA - NAO TEM COBERTURA TV </option>
      <option style="color:red" value="LIXEIRA - CLIENTE REPETIDO"> LIXEIRA - CLIENTE REPETIDO </option>
      <option style="color:red" value="LIXEIRA - CLIENTE JA CONTRATOU O SERVICO"> LIXEIRA - CLIENTE JA CONTRATOU O SERVICO </option>
      <option style="color:red" value="LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR"> LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR </option>
      <option style="color:red" value="LIXEIRA - OUTROS - ESPECIFICAR"> LIXEIRA - OUTROS - ESPECIFICAR </option>
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

    <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

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


<?php }else{?>

  <script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>
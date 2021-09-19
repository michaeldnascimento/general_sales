<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d');
$horaDia = date('H:i:s');


if($empresa == '001' && ($acessoTIM == 'SIM' OR $acessoTODOS == 'SIM')){

$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


/******************************Buscar os clientes - paginacao**************************/
if ($_POST['data1'] !="" OR $_POST['data2'] !="") {


    if ($_POST['statusVenda'] == "VENDA") {
      $status = "motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI'";
    }

    if ($_POST['statusVenda'] == "LIXEIRA") {
      $status = "motivo_cliente = 'LIXEIRA - NAO TEM INTERESSE EM NOVA ASSINATURA' OR motivo_cliente = 'LIXEIRA - PROBLEMAS TECNICOS' OR motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA VIRTUA' OR motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA TV' OR motivo_cliente = 'LIXEIRA - CLIENTE REPETIDO' OR motivo_cliente = 'LIXEIRA - CLIENTE JA CONTRATOU O SERVICO'";
    }



$stringSql = " SELECT id_cliente, motivo_cliente, cidade_cliente, lista_sistema, nome_contato_cliente, cpf_cnpj_cliente, ddd_fone_cliente, fone_cliente, ddd_celular_cliente, celular_cliente, numHP_cliente, endereco_cliente , origemCSV, observacao_cliente, flag FROM clientes WHERE lista_sistema = 'TIM' AND (nomeUsuario = '$nomeUsuario') AND ({$status}) AND (status_mailing IS NULL OR status_mailing = 'ATIVO') AND (data_venda BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}') ORDER BY id_cliente desc";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();
while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'             => $cliente ['id_cliente'],
  'origem'               => $cliente ['origemCSV'],
  'nome_contato'         => $cliente ['nome_contato_cliente'],
  'cpf'                  => $cliente ['cpf_cnpj_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'hp'                   => $cliente ['numHP_cliente'],
  'endereco'             => $cliente ['endereco_cliente'],
  'telefone'  => "Fone:". $cliente ['ddd_fone_cliente'] . $cliente ['fone_cliente']. "<br>". "Cel:". $cliente ['ddd_celular_cliente'] . $cliente ['celular_cliente'] ,
  'tabulacao'            => $cliente ['motivo_cliente'],
  'obs'                  => $cliente ['observacao_cliente'],
  'flag'                  => $cliente ['flag'],
  );
    }

}else{

$stringSql = " SELECT id_cliente, motivo_cliente, cidade_cliente, lista_sistema, nome_contato_cliente, cpf_cnpj_cliente, ddd_fone_cliente, fone_cliente, ddd_celular_cliente, celular_cliente, numHP_cliente, endereco_cliente , origemCSV, observacao_cliente, obs_tag, flag FROM clientes WHERE lista_sistema = 'TIM' AND (nomeUsuario = '$nomeUsuario') AND (motivo_cliente IS NULL OR motivo_cliente = 'FOLLOW-UP' OR motivo_cliente = 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO' OR motivo_cliente = 'OPORTUNIDADE - TRATANDO' OR motivo_cliente = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente desc";

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();
while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'             => $cliente ['id_cliente'],
  'origem'               => $cliente ['origemCSV'],
  'nome_contato'         => $cliente ['nome_contato_cliente'],
  'cpf'                  => $cliente ['cpf_cnpj_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'hp'                   => $cliente ['numHP_cliente'],
  'endereco'             => $cliente ['endereco_cliente'],
  'telefone'  => "Fone:". $cliente ['ddd_fone_cliente'] . $cliente ['fone_cliente']. "<br>". "Cel:". $cliente ['ddd_celular_cliente'] . $cliente ['celular_cliente'] ,
  'tabulacao'            => $cliente ['motivo_cliente'],
  'obs'                  => $cliente ['observacao_cliente']. " ". $cliente ['obs_tag'],
  'flag'                  => $cliente ['flag'],
  );
}
}

//***************EVENTOS DO BOTAO***************
$visualizarbutton = '';

//CONTADOR DO BOTÃO DE BLOQUEIO
$ocorrencia = " SELECT id_cliente FROM clientes WHERE (lista_sistema = 'TIM') AND (motivo_cliente IS NULL OR motivo_cliente = '') AND (nomeUsuario IS NULL OR nomeUsuario = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO')";


$resu = mysqli_query($linkComMysql, $ocorrencia);
$qtd  = mysqli_num_rows($resu);


if ($qtd == 0){
$visualizarbutton = 'disabled';
}


//CONTADOR DO BOTÃO DE BLOQUEIO
$ocorrencia2 = " SELECT id_cliente FROM clientes WHERE lista_sistema = 'TIM' AND (nomeUsuario = '{$nomeUsuario}') AND (motivo_cliente IS NULL OR motivo_cliente = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO')";

$resu2 = mysqli_query($linkComMysql, $ocorrencia2);
$qtd2  = mysqli_num_rows($resu2);


if ($qtd2 >= 5){
$visualizarbutton = 'disabled';
}



mysqli_close($linkComMysql);
?>
<!--*******************INICIO DO CODIGO HTML- INICIO DA PAGINA********************************** -->
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
    <title>General Sales</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">

    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">

</head>
<body>



<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->

<?php
include_once "../css/navbar/meunavbar.php";
?>




<div id="main" class="container-fluid">

      <div class="form-group">
            <div class="col-md-12">

             <button type="button" class="btn btn-default active btn-xs pull-right" title="Pesquisa avancada" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-calendar"></span></button>


             </div>
        </div>



  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>PESQUISAR</strong></h4>
      </div>
      <div class="modal-body">
<div class="container">



         <!-- Text input-->
<form action="leadNET-TIM.php" method="post">

          <label class="col-sm-1 control-label" for="textinput">D.Incio</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" name="data1"  id="data1" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

<br>
<br>
<br>

          <label class="col-sm-1 control-label" for="textinput">D.Fim</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" name="data2"  id="data2" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

<br>
<br>
<br>

          <label class="col-sm-1 control-label" for="textinput">Status</label>
                <div class="col-sm-2">
                <select id="statusVenda" name="statusVenda" class="form-control">
                <option value=""></option>
                    <option value="VENDA">VENDA</option>
                    <option value="LIXEIRA">LIXEIRA</option>
                </select>
                </div>

<br>
<br>
<br>

          <div class="form-group">
          <label class="col-md-1 control-label" for="button1id"></label>
          <div class="col-md-2">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Pesquisar</button>
          </div>
          </div>

</form>
</div>



      </div>
    </div>
  </div>
</div>

      <!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalLabel"><strong>TABULACAO</strong></h4>
              </div>
<?php
if ( isset($_GET['id_contato']) && intval($_GET['id_contato']) > 0 ) {
  $id = intval($_GET['id_contato']);




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
    'id_cliente' => $id_contato
  );


  $stringSql = gera_select($campos, $tabelas, $where);
  $resultado = mysqli_query($linkComMysql, $stringSql);
  $cliente = mysqli_fetch_assoc($resultado);

}
?>

<div class="modal-body">
<div class="container">
      <form action="tabulapopup.php?lista=TIM" method="post">

     <label class="col-md-1 control-label" for="selectbasic">Selecione</label>
     <div class="col-md-3">
          
     <select required id="select" name="motivo_cliente" class="form-control">

          
      <option value=""></option>
      <option style="color:green" value="VENDA - NOVO CLIENTE"> VENDA - NOVO CLIENTE </option>
      <option style="color:green" value="VENDA - UPGRADE + MULTI"> VENDA - UPGRADE + MULTI </option>
      <option style="color:green" value="VENDA - BASE TV"> VENDA - BASE TV </option>
      <option style="color:blue" value="FOLLOW-UP"> OPORTUNIDADE - FOLLOW UP - RETORNO AGENDADO </option>
      <option style="color:blue" value="OPORTUNIDADE - TRATANDO">OPORTUNIDADE - TRATANDO </option>
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

<br/>
<br/>


          <div id='mestre'>
          <div id='FOLLOW-UP'>

          <label class="col-md-1 control-label" for="selectbasic">Data/Hora</label>
          <input type="date"  class="col-md-2" id="data_followup_cliente" name="data_followup_cliente" value="<?=$cliente['data_followup_cliente']?>" class="form-control input-md">

          <input type="time"  class="col-md-2"  id="hora_followup_cliente" name="hora_followup_cliente" value="<?=$cliente['hora_followup_cliente']?>" class="form-control input-md">

          </div>
          </div>

<br/>
<br/>



          <label  class="col-sm-1 control-label" for="textinput">Obs</label>
          <div class="col-sm-3">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" class="form-control" style="text-transform: uppercase" name="observacao_cliente" id="observacao_cliente">' . $cliente['observacao_cliente'] . '</textarea>'
          ?>              <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>

<br/>
<br/>
<br/>

   <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

     <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

     <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">



       <!--FOI FEITO EM VIA POST PRA O ID NAO APARECER NA URL POR MODE DE SEGURANÇA-->
       <input type="hidden" name="id_contato" id="id_contato" value="">
       <label class="col-md-5 control-label" for="selectbasic"></label>
       <input type="submit" class="btn btn-success" value = "Salvar">

      </form>
        </div>

        </div>
      </div>
  </div>
  </div>



<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>


<div class="page-header">
<h2><strong>LEAD TIM</strong></h2>
</div>

 <form action="geradormailing.php" method="post" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;">

    <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

    <input type="text" style="display: none" name="lista" class="form-control input-md" id="lista" value="TIM">

    <div class="form-group">
          <label class="col-md-0 control-label" for="button1id"></label>
            <div class="col-md-2">
            <button type="submit" name="enviar" class="btn btn-success btn-sm active" <?php echo $visualizarbutton ?> ><span class="glyphicon glyphicon-chevron-right"></span> Gerar 1 de <?=$qtd?></button>
          </div>
    </div>
  </form>

<br/>
<!--****************************LISTAGEM************************************* -->



    <div id="list" class="row">

        <div class="table-responsive col-md-12">

          <table class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                     <th>ID</th>
                     <th>ORIGEM</th>
                     <th>CONTATO</th>
                     <th>CPF</th>
                     <th>HP</th>
                     <th>ENDERECO</th>
                     <th>CIDADE</th>
                     <th>TELEFONE</th>
                     <th>OBS</th>
                     <th>TABULACO</th>
                     <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
                    </tr>
                </thead>
                <tbody>



<!--****************************************CONTATOS*********************************** -->    

    <?php

      foreach ($clientes as $key => $cliente) {



      ?>

        <tr>  
            <td style="<?=$style?>"> <?=$cliente['id'];?></td>
            <td style="<?=$style?>"> <?=$cliente['origem'];?></td>
            <td style="<?=$style?>"> <?=$cliente['nome_contato'];?></td>
            <td style="<?=$style?>"> <?=$cliente['cpf'];?></td>
            <td style="<?=$style?>"> <?=$cliente['hp']?></td>
            <td style="<?=$style?>"> <?=$cliente['endereco']?></td>
            <td style="<?=$style?>"> <?=$cliente['localizacao_assinante'];?></td>
            <td style="<?=$style?>"> <?=$cliente['telefone'];?></td>
            <td style="<?=$style?>"> <?=$cliente['obs'];?></td>
            <td style="<?=$style?>"> <?=$cliente['tabulacao'];?></td>

           <td class="actions">

          <a class="btn btn-xs" title="Pesquisa TAG" href="#" onclick="window.open('consultapesquisa.php?id=<?=$cliente['id'];?>&lista=GERAL', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=110, LEFT=350, WIDTH=500, HEIGHT=500');"><span class="glyphicon glyphicon-pencil"></span></a>

           <a class="btn btn-info btn-xs excluir" title="Tabular" href="#" data-toggle="modal" data-target="#delete-modal" id-do-contato="<?=$cliente['id'];?>"><span class="glyphicon glyphicon-ok"></span></a>


           </td>
        </tr>


      <?php

         }

       ?>



<!--*****************************FIM DE CADA CONTATOS**************************** -->
                </tbody>
             </table>


             
        <div class="row">
          <div class="col-md-12">
            <h5 class="msg-padrao">Quantidade de Registros <?=$qtdClientes;?></h5>
          </div>
        </div>

            </div>
    </div>


  </div>
</body>
    <!-- jQuery -->
     <script src="../js/jquery-2.2.3.min.js"></script>
     <script src="../js/scripts-geral.js"></script>
     <script src="../css/bootstrap/js/bootstrap.min.js"></script>
     <script src="../css/bootstrap/js/meunavbar2.js"></script>


    <script src="../media/js/jquery.dataTables.min.js"></script>
    <script src="../media/js/dataTables.bootstrap.min.js"></script>
    <script src="../media/js/tablesgeneral.js"></script>

<script type="text/javascript">
    $("#loading").ajaxStart(function(){
        $(this).show();
        $('button').attr('disabled', 'disabled');
    });
    $("#loading").ajaxStop(function(){
        $(this).hide();
        $('button').removeAttr('disabled');
    });

</script>

</html>


    <?php }else{?>
    <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;
    <?php }?>
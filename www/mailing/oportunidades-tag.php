<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d');
$horaDia = date('H:i:s');


if($empresa == '001' && ($acessoCE == 'SIM' OR $acessoTODOS == 'SIM')){

$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


/******************************Buscar os clientes - paginacao**************************/


$stringSql = " SELECT id_cliente, motivo_cliente, cidade_cliente, lista_sistema, nome_contato_cliente, cpf_cnpj_cliente, ddd_fone_cliente, fone_cliente, ddd_celular_cliente, celular_cliente, numHP_cliente, endereco_cliente , origemCSV, observacao_sistema, flag FROM clientes WHERE lista_sistema = 'TAG' AND (nomeUsuario = '$nomeUsuario') AND (motivo_cliente IS NULL OR motivo_cliente = 'FOLLOW-UP' OR motivo_cliente = 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO' OR motivo_cliente = 'OPORTUNIDADE - TRATANDO' OR motivo_cliente = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente desc";

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();
while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'             => $cliente ['id_cliente'],
  'origem'               => $cliente ['origemCSV'],
  'nome_contato'         => $cliente ['nome_contato_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'hp'                   => $cliente ['numHP_cliente'],
  'endereco'             => $cliente ['endereco_cliente'],
  'telefone'  => "Fone:". $cliente ['ddd_fone_cliente'] . $cliente ['fone_cliente']. "<br>". "Cel:". $cliente ['ddd_celular_cliente'] . $cliente ['celular_cliente'] ,
  'tabulacao'            => $cliente ['motivo_cliente'],
  'obs'                  => $cliente ['observacao_sistema'],
  'flag'                  => $cliente ['flag'],
  );
}


//***************EVENTOS DO BOTAO***************
$visualizarbutton = '';

//CONTADOR DO BOTÃO DE BLOQUEIO
$ocorrencia = " SELECT id_cliente FROM clientes WHERE (lista_sistema = 'TAG') AND (motivo_cliente IS NULL OR motivo_cliente = '') AND (nomeUsuario IS NULL OR nomeUsuario = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO')";


$resu = mysqli_query($linkComMysql, $ocorrencia);
$qtd  = mysqli_num_rows($resu);


if ($qtd == 0){
$visualizarbutton = 'disabled';
}


//CONTADOR DO BOTÃO DE BLOQUEIO
$ocorrencia2 = " SELECT id_cliente FROM clientes WHERE lista_sistema = 'TAG' AND (nomeUsuario = '{$nomeUsuario}') AND (motivo_cliente IS NULL OR motivo_cliente = '') AND (status_mailing IS NULL OR status_mailing = 'ATIVO')";

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




      <!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="modalLabel"><strong>PESQUISA TAG</strong></h4>
              </div>
<?php
if ( isset($_GET['id_contato']) && intval($_GET['id_contato']) > 0 ) {
  $id = intval($_GET['id_contato']);




    $campos = array(
      'id_cliente', //0
      'tv_atual',
      'fidelidade_tv',
      'internet_atual',
      'fidelidade_internet',
      'telefonia_atual',
      'fidelidade_telefonia',
      'movel_atual',
      'fidelidade_movel',
      'custo_atual',
      'sabendo_tag',
      'saber_tag',
      'experiencia_tag',
      'lista_sistema',
      'obs_tag',
      'coberturaNET',
      'coberturaVIVO',
      'coberturaTIM'
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

    <form action="tabulatag.php?lista=TAG" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;" method="post">





     <label class="control-label">QUAL SUA OPERADORA DE TV ATUALMENTE ?</label>

      <select id="tv_atual" name="tv_atual" class="form-control">


      <option value="">SELECIONE</option>
      <option value="NET"> NET </option>
      <option value="CLARO"> CLARO </option>
      <option value="VIVO"> VIVO </option>
      <option value="TIM"> TIM </option>
      <option value="HEGHES"> HUGHES </option>
      <option value="OI"> OI </option>
      <option value="GVT"> GVT </option>
      <option value="OUTROS"> OUTROS </option>
      </select>


      <label class="control-label" for="textinput">Fidelidade</label>

      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_tv" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_tv" id="NAO" value="NAO"> NAO
      </label>
      </div>





     <label for="recipient-name" class="control-label">QUAL SUA OPERADORA DE INTERNET ATUALMENTE ?</label>

          
      <select id="internet_atual" name="internet_atual" class="form-control">

      <option value="">SELECIONE</option>
      <option value="NET"> NET </option>
      <option value="CLARO"> CLARO </option>
      <option value="VIVO"> VIVO </option>
      <option value="TIM"> TIM </option>
      <option value="HEGHES"> HUGHES </option>
      <option value="OI"> OI </option>
      <option value="GVT"> GVT </option>
      <option value="OUTROS"> OUTROS </option>
      </select>


      <label class="control-label" for="textinput">Fidelidade</label>

      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_internet" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_internet" id="NAO" value="NAO"> NAO
      </label>
      </div>



     <label for="recipient-name" class="control-label">QUAL SUA OPERADORA DE TELEFONIA ATUALMENTE ?</label>

          
      <select id="telefonia_atual" name="telefonia_atual" class="form-control">


      <option value="">SELECIONE</option>
      <option value="NET"> NET </option>
      <option value="CLARO"> CLARO </option>
      <option value="VIVO"> VIVO </option>
      <option value="TIM"> TIM </option>
      <option value="HEGHES"> HUGHES </option>
      <option value="OI"> OI </option>
      <option value="GVT"> GVT </option>
      <option value="OUTROS"> OUTROS </option>
      </select>

      <label class="control-label" for="textinput">Fidelidade</label>

      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_telefonia" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_telefonia" id="NAO" value="NAO"> NAO
      </label>
      </div>



     <label for="recipient-name" class="control-label">QUAL SUA OPERADORA DE TELEFONIA MOVEL ATUALMENTE ?</label>

          
      <select id="movel_atual" name="movel_atual" class="form-control">


      <option value="">SELECIONE</option>
      <option value="NET"> NET </option>
      <option value="CLARO"> CLARO </option>
      <option value="VIVO"> VIVO </option>
      <option value="TIM"> TIM </option>
      <option value="HEGHES"> HUGHES </option>
      <option value="OI"> OI </option>
      <option value="GVT"> GVT </option>
      <option value="NEXTEL"> NEXTEL </option>
      <option value="OUTROS"> OUTROS </option>
      </select>

      <label class="control-label" for="textinput">Fidelidade</label>

      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_movel" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_movel" id="NAO" value="NAO"> NAO
      </label>
      </div>


      <label class="control-label" for="textinput">COMO FICOU SABENDO DA TAG ?</label>


          
      <select id="sabendo_tag" name="sabendo_tag" class="form-control">


      <option value="">SELECIONE</option>
      <option value="SITE"> SITE </option>
      <option value="FACEBOOK"> FACEBOOK </option>
      <option value="AMIGOS"> AMIGOS </option>
      <option value="SMS"> SMS </option>
      <option value="E-MAIL"> E-MAIL </option>
      </select>





     <label class="control-label" for="textinput">QUAL SEU CUSTO ATUAL COM ESSES SERVICOS ?</label>


      <div class="input-group">
      <input type="text" class="form-control" name="custo_atual" id="custo_atual" value="<?=$cliente['custo_atual']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-ok"></i></span>
      </div>





     <label class="control-label" for="textinput">EXISTE ALGUMA OPERADORA QUE NAO DESEJA TRABALHAR ?</label>


      <div class="input-group">
      <input type="text" class="form-control" name="saber_tag" id="saber_tag" value="<?=$cliente['saber_tag']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-ok"></i></span>
      </div>




     <label class="control-label" for="textinput">COMO FOI A SUA EXPERIENCIA COM SERVICOS TELECOM ?</label>


      <div class="input-group">
      <input type="text" class="form-control" name="experiencia_tag" id="experiencia_tag" value="<?=$cliente['experiencia_tag']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-ok"></i></span>
      </div>

      <h5><strong>TEM COBERTURA ?</strong></h5>
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">NET</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="coberturaNET" id="coberturaNET" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="coberturaNET" id="coberturaNET" value="NAO"> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">VIVO</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="coberturaVIVO" id="coberturaVIVO" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="coberturaVIVO" id="coberturaVIVO" value="NAO"> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">TIM</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="coberturaTIM" id="coberturaTIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="coberturaTIM" id="coberturaTIM" value="NAO"> NAO
      </label>
      </div>
      </div>
      </div>

<br/>

     <label class="control-label" for="selectbasic">LISTA PARA ENVIO</label>

          
     <select required id="lista_sistema" name="lista_sistema" class="form-control">

          
      <option value=""></option>
      <option style="color:blue" value="GERAL"> LEAD GERAL </option>
      <option style="color:blue" value="NET"> LEAD NET </option>
      <option style="color:blue" value="CLARO"> LEAD CLARO </option>
      <option style="color:blue" value="VIVO"> LEAD VIVO </option>
      <option style="color:blue" value="TIM"> LEAD TIM </option>
      <option style="color:blue" value="HUGHES"> LEAD HUGHES </option>
      </select>




      <label for="message-text" class="col-form-label">Obs</label>
      <textarea class="form-control" name="obs_tag" id="obs_tag"></textarea>


<br/>
<br/>
<br/>


     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

      <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="">

     <input type="text" style="display: none" name="origemCSV" class="form-control input-md" id="origemCSV" value="TAG">


       <div class="modal-footer">
       <!--FOI FEITO EM VIA POST PRA O ID NAO APARECER NA URL POR MODE DE SEGURANÇA-->
       <input type="hidden" name="id_contato" id="id_contato" value="">
       <input type="submit" class="btn btn-success" value = "Salvar">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       </div>

      </form>
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
<h2><strong>OPORTUNIDADES TAG</strong></h2>
</div>

         <a class="btn btn-success btn-xs pull-right" title="Cad. Pesquisa TAG" href="#" onclick="window.open('cad-oportunidades-tag.php?lista=TAG', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=110, LEFT=350, WIDTH=500, HEIGHT=500');"><span class="glyphicon glyphicon-plus"></span></a>

 <form action="geradormailing.php" method="post" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;">

    <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

    <input type="text" style="display: none" name="lista" class="form-control input-md" id="lista" value="TAG">

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
                     <th>CONTATO</th>
                     <th>ENDERECO</th>
                     <th>CIDADE</th>
                     <th>TELEFONE</th>
                     <th>OBS</th>
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
            <td style="<?=$style?>"> <?=$cliente['nome_contato'];?></td>
            <td style="<?=$style?>"> <?=$cliente['endereco']?></td>
            <td style="<?=$style?>"> <?=$cliente['localizacao_assinante'];?></td>
            <td style="<?=$style?>"> <?=$cliente['telefone'];?></td>
            <td style="<?=$style?>"> <?=$cliente['obs'];?></td>

           <td class="actions">

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
  </div>
</body>
    <!-- jQuery -->
     <script src="../js/jquery-2.2.3.min.js"></script>
     <script src="../js/scripts-geral.js"></script>
     <script src="../css/bootstrap/js/bootstrap.min.js"></script>
     <script src="../css/bootstrap/js/meunavbar2.js"></script>


</html>


    <?php }else{?>
    <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;
    <?php }?>
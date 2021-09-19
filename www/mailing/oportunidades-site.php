<?php
session_start();


include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";



if($empresa == '001' && ($acessoOportunidadeSite == 'SIM' OR $acessoTODOS == 'SIM')){


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}



/******************************Buscar os clientes - paginacao**************************/

$stringSql = " SELECT id_cliente, cidade_cliente, nome_contato_cliente, flag, data_solicitacao, motivo_rejeicao, lista_sistema, nomeUsuario, motivo_cliente FROM clientes WHERE (lista_sistema = 'SITE') AND (motivo_cliente IS NULL OR motivo_cliente = 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO') ORDER BY id_cliente DESC";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);

$clientes = array();
while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'                   => $cliente ['id_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'nome_contato'         => $cliente ['nome_contato_cliente'],
  'motivo_rejeicao'      => $cliente ['motivo_rejeicao'],
  'datahora_cadastro'    => $cliente ['data_solicitacao'],
  'flag'                 => $cliente ['flag'],
  'lista_sistema'        => $cliente ['lista_sistema'],
  'nomeUser'             => $cliente ['nomeUsuario'],
  'tabulacao'            => $cliente ['motivo_cliente'],
  );
}


mysqli_close($linkComMysql);


?>

<!--*******************INICIO DO CODIGO HTML- INICIO DA PAGINA********************************** -->

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
    <title>General Sales</title>


    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">
       <link rel="stylesheet" href="../css/navbar/meunavbar.css">



</head>
<body>



<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->


  </div>

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


<!--***********************TOPO - BARRA DE PESQUISA********************************** -->

<!--*************MESSAGEM DO SISTEMA - BASEADO EM SESSOES********************* -->
<div id='ReloadThis'>
  <div class="container-fluid">
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>


<div class="form-group">
<h3><center><strong>LEAD SITE</strong></center></h3>

<!-- Split button -->
<div class="col-md-10">
<div class="btn-group ">
  <button type="button" class="btn btn-xs btn-success active">Atalhos</button>
  <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a style="display: <?php echo $dropsp ?>" href="#" target="_blank">SP</a></li>
    <li><a style="display: <?php echo $dropbr ?>" href="leadNET-BR.php" target="_blank">BR</a></li>
    <li> <a style="display: <?php echo $droprx ?>" href="leadNET-Reconex.php" target="_blank">RX</a></li>
    <li> <a style="display: <?php echo $dropmt ?>" href="leadNET-Multi.php" target="_blank">MULTI</a></li>
    <li role="separator" class="divider"></li>
    <li><a style="display: <?php echo $dropproposta ?>" href="#" onclick="window.open('lead-Propostas.php#', 'Pagina3', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=400, WIDTH=400, HEIGHT=400');">PROPOSTAS</a></li>
    <li><a style="display: <?php echo $dropmultibase ?>" href="#" onclick="window.open('multibase.php#', 'Pagina4', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=400, WIDTH=400, HEIGHT=400');">BASE</a></li>
    <li><a style="display: <?php echo $dropprospects ?>" href="#" onclick="window.open('leadProspects.php#', 'Pagina5', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=200, WIDTH=400, HEIGHT=400');">EXCLUSIVO</a></li>
    </ul>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-xs active" data-toggle="modal" data-target="#myModal">
  Script
</button>
</div>


</div>
<br/>



<!--**********************************LISTAGEM******************************************** -->


    <div id="list" class="row">

        <div class="table-responsive col-md-12">

          <table class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                     <th>ID</th>
                     <th>CIDADE</th>
                     <th>NOME</th>
                     <th>MOTIVO REJEICAO</th>
                     <th style="display: <?php echo $drop ?>">VENDEDOR</th>
                     <th>DATA SOLICITACAO</th>
                     <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
                    </tr>
                </thead>
                <tbody>



<!--****************************************CONTATOS*********************************** -->    

    <?php

      foreach ($clientes as $key => $cliente) {

        if ($cliente['flag'] == 0){
          $style = 'font-weight:bold';

          }

          if ($cliente['flag'] == 1){
          $style = '';

          }

          if ($cliente['flag'] == ''){
          $style = 'font-weight:bold';

          }

          if ($cliente ['tabulacao'] == 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO') {
          $style = 'color:blue';
          }



          $cliente['nome_contato'] = substr_replace($cliente['nome_contato'], (strlen($cliente['nome_contato']) > 500 ? '...' : ''), 500);

      ?>

        <tr>  
            <td style="<?=$style?>"> <?=$cliente['id'];?></td>
            <td style="<?=$style?>"> <?=$cliente['localizacao_assinante'];?></td>
            <td style="<?=$style?>"> <?=$cliente['nome_contato']?></td>
            <td style="<?=$style?>"> <?=$cliente['motivo_rejeicao']?></td>
            <td style="display: <?php echo $drop ?>"> <?=$cliente['nomeUser']?></td>
            <td style="<?=$style?>"> <?=$cliente['datahora_cadastro'];?></td>

        <td class="actions">
        <a class="btn btn-success btn-xs" href="flag.php?id=<?=$cliente['id'];?>&usuario=<?=$nomeUsuario?>&lista=SITE"><span class="glyphicon glyphicon-pencil"></span></a>

        </td>
        </tr>


      <?php

         }

       ?>



<!--*****************************FIM DE CADA CONTATOS**************************** -->
                </tbody>
             </table>

            </div>
    </div>



<!--*****************QUANTIDA DE COSTATOS DA PAGINA*************************** -->


        <div class="row">
          <div class="col-md-12">
            <h5 class="msg-padrao">Quantidade de Registros <?=$qtdClientes;?></h5>
          </div>
        </div>


<!--*******************************BOTTOM - PAGINAÇÃO***************************** -->








</div>
</div>
</body>

        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/scripts-geral.js"></script>
        <script src="../css/bootstrap/js/bootstrap.min.js"></script>
        <script src="../css/bootstrap/js/meunavbar2.js"></script>




<?php
include_once "../css/navbar/meunavbar.php";
?>



</html>

    <?php }else{?>
    <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;
    <?php }?>
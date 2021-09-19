<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($acessoPARCEIROS == 'SIM'){


?>
  <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php
} else{



if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
$id = intval($_GET['id']);
$lista = strval($_GET['lista']);


          //gera uma query para buscar todos os contatos



          $campos = array(
          'id_cliente', //0
          'nome_cliente', //1
          'nome_contato_cliente',//2
          'rg_ie_cliente', //3
          'cpf_cnpj_cliente',
          'data_nasc_cliente',
          'tipo_pessoa_cliente',
          'sexo_cliente',
          'nome_mae_cliente',
          'codigoAntigo_cliente',
          'email_cliente',
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
          'tv_venda_cliente',
          'internet_venda_cliente',
          'netfone_venda_cliente',
          'portfone_venda_cliente',
          'netcelular_venda_cliente',
          'portcelular_venda_cliente',
          'plano_multi_cliente',
          'qtdchip_multi_cliente',
          'agregado_venda_cliente',
          'numPacote_venda_cliente',
          'valor_venda_cliente',
          'formaPagemento_cliente',
          'vencimentoPagamento_cliente',
          'pagamentoBanco_cliente',
          'pagamentoAgencia_cliente',
          'pagamentoConta_cliente',
          'foneContato_venda_cliente',
          'observacao_venda_cliente',
          'numero_proposta_cliente',
          'data_pre_agendamento_cliente',
          'codigo_cliente',
          'statusPedido_venda_cliente',
          'motivoPendencia_venda_cliente',
          'motivo_cliente',
          'observacao_pedido_cliente',
          'statusVenda_venda_cliente',
          'data_inst_venda_cliente',
          'data_agendamento_venda_cliente',
          'data_canc_venda_cliente',
          'motivoCanc_venda_cliente',
          'motivoQuebra_venda_cliente',
          'auditadoBack_venda_cliente',
          'observacaoBack_venda_cliente',
          'nomeUsuario',
          'nomeEquipe',
          'data_venda',
          'hora_venda',
          'nomeUsuarioBack',
          'nomeEquipeBack',
          'hora_back',
          'data_back',
          'auditoria_back',
          'tipo_servico',
          'tabulacao_auditoria',
          'chipAtivo_cliente',
          'img_multisales',
          'img_multisales2',
          'img_multisales3',
          'audio_multisales'

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



if ($lista == 'VCONCLUIDA') {
  $voltar = "minhas-vendasLista.php";
}else{
  $voltar = "minhas-vendasPendentes.php";
}

if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
}


$imagem1 = $cliente['img_multisales'];
$imagem2 = $cliente['img_multisales2'];
$imagem3 = $cliente['img_multisales3'];
//$pasta   = "/audiomultisales/";
$audio   = $cliente['audio_multisales'];
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


<style>
/* TODO:
 * clean up!
 * ===============
 * horizontal thumbnails
 * at small screens
 * and in fullscreen
 * ===============
 * create Mixins
 * ===============
 */


.gallery {
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  position: relative;
  background: white;
  width: 80%;
  box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
  border-radius: 5px;
}
.gallery input[name$="control"] {
  display: none;
}
.gallery .carousel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
  position: relative;
  height: 70vh;
  width: 100%;
}
.gallery .wrap {
  width: 100%;
  height: 100%;
  position: static;
  margin: 0 auto;
  overflow: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -ms-flex-wrap: nowrap;
      flex-wrap: nowrap;
  margin-right: 20px;
}
.gallery .wrap figure {
  padding: 10px;
  height: 100%;
  min-width: 100%;
  -webkit-transition: opacity 0.25s ease-in-out 0.05s;
  transition: opacity 0.25s ease-in-out 0.05s;
  position: relative;
  left: 0;
  -webkit-transform: translateX(0%);
          transform: translateX(0%);
  box-sizing: border-box;
  text-align: center;
  margin: 0;
  display: block;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  opacity: 1;
}
.gallery .wrap figure label {
  cursor: zoom-in;
  height: auto;
  width: 100%;
  height: 100%;
  position: relative;
  display: block;
}
.gallery .wrap figure img {
  cursor: inherit;
  height: auto;
  max-width: 100%;
  max-height: 100%;
  border-radius: 3px;
  margin: 0 auto;
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
}
.gallery .thumbnails {
  -webkit-box-flex: 1;
      -ms-flex: 1;
          flex: 1;
  min-width: 60px;
  max-height: 100%;
  height: auto;
  -webkit-box-flex: 0;
      -ms-flex-positive: 0;
          flex-grow: 0;
  -ms-flex-item-align: center;
      align-self: center;
  -ms-flex-preferred-size: auto;
      flex-basis: auto;
  position: relative;
  white-space: nowrap;
  overflow: hidden;
  overflow-y: auto;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  padding: 0 10px;
  z-index: 20;
}
.gallery .thumbnails .thumb {
  min-width: 60px;
  height: 60px;
  background-position: center center;
  background-size: cover;
  box-sizing: border-box;
  opacity: 0.7;
  margin: 5px 0;
  -ms-flex-negative: 0;
      flex-shrink: 0;
  left: 0;
  border-radius: 3px;
  cursor: pointer;
  -webkit-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  background-repeat: no-repeat;
}
.gallery .thumbnails .slider {
  position: absolute;
  display: block;
  width: 5px;
  height: calc(60px + 10px);
  z-index: 2;
  margin: 0;
  left: 0;
  -webkit-transition: all 0.33s cubic-bezier(0.3, 0, 0.33, 1);
  transition: all 0.33s cubic-bezier(0.3, 0, 0.33, 1);
}
.gallery .thumbnails .slider .indicator {
  width: 100%;
  height: 100px;
  max-height: calc(100% - 10px);
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  background: #428BFF;
  border-radius: 1px;
}
.gallery input#fullscreen:checked ~ .wrap figure {
  position: fixed;
  z-index: 10;
  height: 100vh;
  width: 100vw;
  padding: 0;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%) !important;
          transform: translate(-50%, -50%) !important;
  -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
  -webkit-animation-fill-mode: forwards;
          animation-fill-mode: forwards;
}
.gallery input#fullscreen:checked ~ .wrap figure label {
  cursor: zoom-out;
}
.gallery input#fullscreen:checked ~ .wrap figure label img {
  -webkit-animation: shadow 0.2s;
          animation: shadow 0.2s;
  -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
  -webkit-animation-direction: forwards;
          animation-direction: forwards;
  -webkit-animation-fill-mode: forwards;
          animation-fill-mode: forwards;
  border-radius: 0;
}
.gallery input#image1:checked ~ .wrap figure {
  -webkit-transform: translateX(0);
          transform: translateX(0);
}
.gallery input#image1:checked ~ .wrap figure:not(:nth-of-type(1)) {
  opacity: 0;
}
.gallery input#image1:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(0);
          transform: translateY(0);
}
.gallery input#image1:checked ~ .thumbnails .thumb:nth-of-type(1) {
  opacity: 1;
  cursor: default;
}
.gallery input#image2:checked ~ .wrap figure {
  -webkit-transform: translateX(-100%);
          transform: translateX(-100%);
}
.gallery input#image2:checked ~ .wrap figure:not(:nth-of-type(2)) {
  opacity: 0;
}
.gallery input#image2:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(100%);
          transform: translateY(100%);
}
.gallery input#image2:checked ~ .thumbnails .thumb:nth-of-type(2) {
  opacity: 1;
  cursor: default;
}
.gallery input#image3:checked ~ .wrap figure {
  -webkit-transform: translateX(-200%);
          transform: translateX(-200%);
}
.gallery input#image3:checked ~ .wrap figure:not(:nth-of-type(3)) {
  opacity: 0;
}
.gallery input#image3:checked ~ .thumbnails .slider {
  -webkit-transform: translateY(200%);
          transform: translateY(200%);
}
.gallery input#image3:checked ~ .thumbnails .thumb:nth-of-type(3) {
  opacity: 1;
  cursor: default;
}


@-webkit-keyframes full {
  from {
    -webkit-transform: translate(-50%, -50%) scale(0.8);
            transform: translate(-50%, -50%) scale(0.8);
  }
  to {
    -webkit-transform: translate(-50%, -50%) scale(1);
            transform: translate(-50%, -50%) scale(1);
  }
}

@keyframes full {
  from {
    -webkit-transform: translate(-50%, -50%) scale(0.8);
            transform: translate(-50%, -50%) scale(0.8);
  }
  to {
    -webkit-transform: translate(-50%, -50%) scale(1);
            transform: translate(-50%, -50%) scale(1);
  }
}
@-webkit-keyframes shadow {
  from {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0), 0 0 10vmin rgba(13, 21, 31, 0);
  }
  to {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0.6), 0 0 10vmin rgba(13, 21, 31, 0.6);
  }
}
@keyframes shadow {
  from {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0), 0 0 10vmin rgba(13, 21, 31, 0);
  }
  to {
    box-shadow: 0 0 0 100vmin rgba(24, 33, 45, 0.6), 0 0 10vmin rgba(13, 21, 31, 0.6);
  }
}

</style>

</head>
<body>

<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>

<!--*************************************FORM *********************************** -->
<div class="container">


<div id="main">
<form action="contratosalvandoresumo_cliente.php?id=<?=$id;?>" method="POST" class="form-horizontal">

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

          <label class="col-sm-1 control-label" for="textinput">Solicitante</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div> 

          <label class="col-sm-1 control-label" for="textinput">Titular</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" name="nome_cliente" class="form-control input-md" id="nome_cliente" value="<?=$cliente['nome_cliente']?>" readonly>
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
          <input type="date" class="form-control" name="data_nasc_cliente" id="data_nasc_cliente" value="<?=$cliente['data_nasc_cliente']?>" readonly>
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

          <label class="col-sm-1 control-label" for="textinput">Sexo</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="sexo_cliente" id="sexo_cliente" value="<?=$cliente['sexo_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>
          

          <label class="col-sm-1 control-label" for="textinput">Mãe</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" class="form-control" name="nome_mae_cliente" id="nome_mae_cliente" value="<?=$cliente['nome_mae_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          </div>



          <!-- Text input-->
          <div class="form-group">
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

          <h4><center>Dados Servicos</center> </h4>


          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">TV</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" class="form-control" name="tv_venda_cliente" id="tv_venda_cliente" value="<?=$cliente['tv_venda_cliente']?>" readonly >
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-blackboard"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Internet</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" class="form-control" name="internet_venda_cliente" id="internet_venda_cliente" value="<?=$cliente['internet_venda_cliente']?>" readonly >
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-globe"></i></span>
          </div>
          </div>


          </div>


          <!-- Select Basic -->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Net fone</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" class="form-control" name="netfone_venda_cliente" id="netfone_venda_cliente" value="<?=$cliente['netfone_venda_cliente']?>" readonly >
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>     
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Port.Fixo</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="portfone_venda_cliente" id="portfone_venda_cliente" value="<?=$cliente['portfone_venda_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>
          </div>




          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Celular</label>
          <div class="col-md-5">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="netcelular_venda_cliente" id="netcelular_venda_cliente" value="<?=$cliente['netcelular_venda_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>

          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Port. Cel</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="portcelular_venda_cliente" id="portcelular_venda_cliente" value="<?=$cliente['portcelular_venda_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>

          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Chip.Ativo</label>
          <div class="col-sm-2">
          <div class="input-group">
          <label class="radio-inline">
          
          <input type="radio" 
          name="chipAtivo_cliente" 
          id="chipAtivo_cliente"
          disabled
          value="SIM" 
          <?php echo ($cliente['chipAtivo_cliente'] == "SIM") ? "checked" : null; ?>/> SIM

          </label>
          <label class="radio-inline">

          <input type="radio" 
          name="chipAtivo_cliente" 
          id="chipAtivo_cliente" 
          disabled
          value="NAO"
          <?php echo ($cliente['chipAtivo_cliente'] == "NAO") ? "checked" : null; ?>/>
          NAO

          </label>
          </div>
          </div>
          </div>

      <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Multi</label>
          <div class="col-md-5">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="plano_multi_cliente" id="plano_multi_cliente" value="<?=$cliente['plano_multi_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>

          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Chip</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="qtdchip_multi_cliente" id="qtdchip_multi_cliente" value="<?=$cliente['qtdchip_multi_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>

          </div>
          </div>
      </div>



          <!-- Text input-->
          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">N.Combo</label>
          <div class="col-md-2">
          <input type="text"  class="form-control" readonly name="numPacote_venda_cliente" id="NumPacote_venda_cliente" value="<?=$cliente['numPacote_venda_cliente']?>">
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Valor</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  class="form-control" readonly name="valor_venda_cliente" id="valor_venda_cliente" value="<?=$cliente['valor_venda_cliente']?>">
          </div>
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Servicos</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  class="form-control" readonly name="tipo_servico" id="tipo_servico" value="<?=$cliente['tipo_servico']?>">
          </div>
          </div>
          </div>


          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Pag.*</label>
          <div class="col-sm-2">
          <input type="text"  class="form-control" readonly name="formaPagemento_cliente" id="formaPagemento_cliente" value="<?=$cliente['formaPagemento_cliente']?>">
          </div>

          <label class="col-sm-1 control-label" for="textinput">Venc.</label>
          <div class="col-sm-1">
          <input type="text"  class="form-control" readonly name="vencimentoPagamento_cliente" id="vencimentoPagamento_cliente" value="<?=$cliente['vencimentoPagamento_cliente']?>">
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Banco</label>
          <div class="col-sm-2">
          <input type="text"  class="form-control" readonly name="pagamentoBanco_cliente" id="pagamentoBanco_cliente" value="<?=$cliente['pagamentoBanco_cliente']?>">
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Agen./Conta</label>
          <div class="col-sm-1">
          <input type="text"  class="form-control" readonly name="pagamentoAgencia_cliente" id="pagamentoAgencia_cliente" value="<?=$cliente['pagamentoAgencia_cliente']?>">
          </div>
          
          <div class="col-sm-2">
          <input type="text"  class="form-control" readonly name="pagamentoConta_cliente" id="pagamentoConta_cliente" value="<?=$cliente['pagamentoConta_cliente']?>">
          </div>
          </div>


          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-11">
          <label for="textinput">Agregado + P.O</label>
          <div class="input-group">
          <input type="text" readonly class="form-control" name="agregado_venda_cliente" id="agregado_venda_cliente" value="<?=$cliente['agregado_venda_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>
          </div>





          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-11">
          <label for="textinput"> Descricao Promocao / Observacao Venda</label>
          <div class="input-group">
          <?php 
          echo '<textarea rows="4" readonly class="form-control" name="observacao_venda_cliente" id="observacao_venda_cliente">' . $cliente['observacao_venda_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>


          <hr />
          <h4><center>Status Pedido</center> </h4>

          <div class="form-group">
          <label class="col-md-1 control-label" for="numero_proposta_cliente">N.Proposta</label>  
          <div class="col-md-3">
          <input type="text" readonly class="form-control" name="numero_proposta_cliente" id="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>">

          </div>



          <label class="col-md-1 control-label" for="codigo_cliente">Codigo</label>  
          <div class="col-md-3">
          <input type="text" readonly class="form-control" name="codigo_cliente" id="codigo_cliente" value="<?=$cliente['codigo_cliente']?>">

          </div>

          <label class="col-sm-1 control-label" for="textinput">Pre-Agen</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="data_pre_agendamento_cliente" id="data_pre_agendamento_cliente" value="<?=$cliente['data_pre_agendamento_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>



          </div>

         <div class="form-group">

         <label class="col-md-1 control-label">Vendedor</label>  
          <div class="col-md-2">
          <input type="text" value="<?=$cliente['nomeUsuario']?>"  class="form-control input-md" readonly>
          </div>

          <label class="col-md-1 control-label">Equipe</label>  
          <div class="col-md-2">
          <input type="text" value="<?=$cliente['nomeEquipe']?>"  class="form-control input-md" readonly>
          </div>

          <label class="col-md-1 control-label">Hora</label>  
          <div class="col-md-2">
          <input type="text" value="<?=$cliente['hora_venda']?>"  class="form-control input-md" readonly>
          </div>

          <label class="col-md-1 control-label">Data</label>  
          <div class="col-md-2">
          <input type="text" value="<?=$cliente['data_venda']?>"  class="form-control input-md" readonly>
          </div>




          </div>


         
         <div class="form-group">


          <label class="col-md-1 control-label" for="selectbasic">Status</label>
          <div class="col-md-3">
          <input type="text" id="statusPedido_venda_cliente" name="statusPedido_venda_cliente"  value="<?=$cliente['statusPedido_venda_cliente']?>"  class="form-control input-md" readonly>
          </div>

          <label class="col-md-2 control-label" for="selectbasic">Mot. Pendencia</label>
          <div class="col-md-3">
          <input type="text" id="motivoPendencia_venda_cliente" name="motivoPendencia_venda_cliente"  value="<?=$cliente['motivoPendencia_venda_cliente']?>"  class="form-control input-md" readonly>
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Tabulacao</label>
          <div class="col-md-2">
          <input type="text" id="motivo_cliente" name="motivo_cliente"  value="<?=$cliente['motivo_cliente']?>"  class="form-control input-md" readonly>
          </div>


          </div>

           <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Observacao</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" readonly  class="form-control" style="text-transform: uppercase" name="observacao_pedido_cliente" id="observacao_pedido_cliente">' . $cliente['observacao_pedido_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>

          <br>

                   <div class="form-group">
          <label  class="col-sm-1 control-label" for="textinput">Audio</label>
          <div class="col-sm-2">
          <td> 
          <audio controls="controls">
          <source src="../audiomultisales/<?=$audio?>" type="audio/mp3" />
          </audio>
          </td>
          <br />
          <a href="../baixar.php?arquivo=audiomultisales/<?=$audio?>">Baixar MP3</a>
          </div>
          </div>


<section class="gallery">
  <div class="carousel">
    
    <input type="radio" id="image1" name="gallery-control" checked>
    <input type="radio" id="image2" name="gallery-control">
    <input type="radio" id="image3" name="gallery-control">

    
    
    <input type="checkbox" id="fullscreen" name="gallery-fullscreen-control"/>
    
    <div class="wrap">
      
      <figure>
        <label for="fullscreen">
          <img src="../imgmultisales/<?=$imagem1?>" alt="image1"/>
        </label>
      </figure>
      
      <figure>
        <label for="fullscreen">
          <img src="../imgmultisales/<?=$imagem2?>" alt="image2"/>
        </label>
      </figure>

      <figure>
        <label for="fullscreen">
          <img src="../imgmultisales/<?=$imagem3?>" alt="image3" />
        </label>
      </figure>


    </div>
    
    <div class="thumbnails">
      
      <div class="slider"><div class="indicator"></div></div>
      
      <label for="image1" class="thumb" style="background-image: url('../imgmultisales/<?=$imagem1?>')"></label>
      
      <label for="image2" class="thumb" style="background-image: url('../imgmultisales/<?=$imagem2?>')"></label>
      
      <label for="image3" class="thumb" style="background-image: url('../imgmultisales/<?=$imagem3?>')"></label>
        

    </div>
  </div>
</section>

        
          
          <hr />

          <h4><center>Status Venda</center></h4>

         <div class="form-group">

          <label  class="col-sm-1 control-label" for="textinput">Backoffice</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" value="<?=$cliente['nomeUsuarioBack']?>" readonly>
          </div>
          </div>

          <label  class="col-sm-1 control-label" for="textinput">Equipe</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" value="<?=$cliente['nomeEquipeBack']?>" readonly>
          </div>
          </div>

          <label  class="col-sm-1 control-label" for="textinput">Hora</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" value="<?=$cliente['hora_back']?>" readonly>
          </div>
          </div>

          <label  class="col-sm-1 control-label" for="textinput">Data</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" value="<?=$cliente['data_back']?>" readonly>
          </div>
          </div>

          </div>

          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">St. Venda</label>
          <div class="col-md-3">
          
          <select id='select' name='statusVenda_venda_cliente' value="<?=$cliente['statusVenda_venda_cliente']?>" class="form-control" readonly>
          <option value="<?=$cliente['statusVenda_venda_cliente']?>"><?=$cliente['statusVenda_venda_cliente']?></option>
          <option></option>
          <option value="EM CADASTRO">EM CADASTRO</option>
          <option value="PENDENTE">PENDENTE</option>
          <option value="AGENDADO">AGENDADO</option>
          <option value="QUEBRA">QUEBRA</option>
          <option value="INSTALADO">INSTALADO</option>
          <option value="CANCELADO">CANCELADO</option>
          </select>
          </div>


          <div id='mestre'>


          <div id='INSTALADO'>

          <label class="col-md-2 control-label" for="selectbasic">Data da Instalacao</label>
          <input type="date"  class="col-md-3" style="height: 30px" id="data_inst_venda_cliente" name="data_inst_venda_cliente" value="<?=$cliente['data_inst_venda_cliente']?>" class="form-control input-md" disabled>
          </div>


          <div id='AGENDADO'>

          <label class="col-md-2 control-label" for="selectbasic">Data do Agendamento</label>
          <input type="date" class="col-md-3" style="height: 30px" id="data_agendamento_venda_cliente" name="data_agendamento_venda_cliente" value="<?=$cliente['data_agendamento_venda_cliente']?>" class="form-control input-md" disabled>
          </div>
  
          

          <div id='CANCELADO'>
          <label class="col-md-2 control-label" for="selectbasic">Data Cancelamento</label>
          <input type="date" style="width: 200px; height: 30px; type="date" id="  data_canc_venda_cliente" name="data_canc_venda_cliente" value="<?=$cliente['data_canc_venda_cliente']?>" class="col-md-2" class="form-control input-md" disabled>


          <label class="col-md-1 control-label" for="selectbasic">Motivo</label>
          <input type="text" style="width: 200px; height: 30px;" id="motivoCanc_venda_cliente" value="<?=$cliente['motivoCanc_venda_cliente']?>" name="motivoCanc_venda_cliente" class="col-md-3" disabled>
          </div>


          
          <div id='QUEBRA'>
          <label class="col-md-2 control-label" for="selectbasic">Motivo Quebra </label>
          <input type="text" class="col-md-3" style="height: 30px" id="motivoQuebra_venda_cliente" name="motivoQuebra_venda_cliente" value="<?=$cliente['motivoQuebra_venda_cliente']?>" class="form-control input-md" disabled>
          </div>


          </div>
          </div>

           <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Observacao</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" readonly class="form-control" style="text-transform: uppercase" name="observacaoBack_venda_cliente" id="observacaoBack_venda_cliente">' . $cliente['observacaoBack_venda_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>

          <br>

            <div class="form-group">
          <label class="col-md-10 control-label" for="button1id"></label>
            <div class="col-md-2">
            <a href="<?=$voltar?>" class="btn btn-default">Voltar</a>
            <a href="../vendedor/editar-venda.php?id=<?=$cliente['id_cliente'];?>&lista=<?=$lista?>" class="btn btn-warning">Editar</a>
      
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
<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($nivel == 2 OR $nivel == 3 OR $nivel == 4 OR $nivel == 5){



if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
$id = intval($_GET['id']);
$lista = strval($_GET['lista']);

//conectar e selecionar o banco de dados mysql/agenda
include_once '../funcoes/conexaoPortari.php';
include_once '../funcoes/funcoes_geraisPortari.php';

$campos = array(
'id_cliente', //0
'nome_cliente', //1
'nome_contato_cliente',//2
'rg_ie_cliente', //3
'parentesco_cliente',
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
'data_ativacao',
'data_agendamento_venda_cliente',
'periodo_agendamento_back',
'data_canc_venda_cliente',
'motivoCanc_venda_cliente',
'motivoQuebra_venda_cliente',
'auditadoBack_venda_cliente',
'observacaoBack_venda_cliente',
'nomeUsuario',
'nomeEquipe',
'nomeEmpresa',
'data_venda',
'hora_venda',
'nomeUsuarioBack',
'nomeEquipeBack',
'nomeEmpresaBack',
'hora_back',
'data_back',
'auditoria_back',
'tipo_servico',
'tabulacao_auditoria',
'chipAtivo_cliente',
'tabulacao_chip',
'statusChecklist',
'multisales',
'fone_gravacao',
'fone_checklist',
'img_multisales',
'img_multisales2',
'img_multisales3',
'audio_multisales',
'lista_sistema',
'login_net',
'statusOcorencia_venda_cliente'

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
       <script type="text/javascript">
             
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco_cliente').value=("");
            document.getElementById('bairro_cliente').value=("");
            document.getElementById('cidade_cliente').value=("");
            document.getElementById('estado_cliente').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco_cliente').value=(conteudo.logradouro);
            document.getElementById('bairro_cliente').value=(conteudo.bairro);
            document.getElementById('cidade_cliente').value=(conteudo.localidade);
            document.getElementById('estado_cliente').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco_cliente').value="...";
                document.getElementById('bairro_cliente').value="...";
                document.getElementById('cidade_cliente').value="...";
                document.getElementById('estado_cliente').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };


       </script>

</head>
<body>




<!--*************************************FORM *********************************** -->


<div class="container">


<div id="main">
<form action="salvando-vendabackoffice.php?id=<?=$id;?>&lista=<?=$lista;?>" method="POST" enctype="multipart/form-data" class="form-horizontal">




          <div class="col-sm-12">

         <h4><center><strong style="color:green">Dados Cliente</strong></center></h4>
         <br/>

         <!-- Text input-->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">ID</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" name="id_cliente" class="form-control input-md" id="id_cliente" value="<?=$cliente['id_cliente']?>" disabled >
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Titular</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase"  name="nome_cliente" maxlength="50" class="form-control input-md" id="nome_cliente" value="<?=$cliente['nome_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

         <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" maxlength="18" name="cpf_cnpj_cliente" id="cpfCnpj" value="<?=$cliente['cpf_cnpj_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>
        </div>




          <!-- Text input-->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Cidade</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" class="form-control" maxlength="30" name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Estado</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" maxlength="3" class="form-control" name="estado_cliente" id="estado_cliente" value="<?=$cliente['estado_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

          </div>


          <hr />
<br/>
<br/>
         <h4><center><strong style="color:green">Dados Servicos</strong></center></h4>
<br/>

          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">Servico</label>
          <div class="col-sm-2">
          <div class="input-group">
          <select id="tipo_servico" name="tipo_servico" class="form-control">
          <option value="<?=$cliente['tipo_servico']?>"><?=$cliente['tipo_servico']?></option>
          <option value=""></option>
          <option value="NET"> NET</option>
          <option value="CLARO"> CLARO</option>
          </select>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Empresas</label>
          <div class="col-sm-8">
          <div class="input-group">
          <input type="text" class="form-control" name="login_net" id="login_net" value="<?=$cliente['login_net']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>


          </div>




          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Ocorrência</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" name="statusOcorencia_venda_cliente" id="statusOcorencia_venda_cliente" value="<?=$cliente['statusOcorencia_venda_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>
          </div>

          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Produto</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" class="form-control" style="text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente">' . $cliente['observacao_venda_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>



         <hr />
         <br/>
         <br/>
         <h4><center><strong style="color:green">Pedido</strong></center></h4>
         <br/>

          <div class="form-group">

          <label class="col-md-1 control-label" for="codigo_cliente">Codigo</label>  
          <div class="col-md-3">
          <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" name="codigo_cliente" id="codigo_cliente" value="<?=$cliente['codigo_cliente']?>">
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Status</label>
          <div class="col-md-3">
          <select id="statusPedido_venda_cliente" value="<?=$cliente['statusPedido_venda_cliente']?>" name="statusPedido_venda_cliente" class="form-control">
          <option value="<?=$cliente['statusPedido_venda_cliente']?>"><?=$cliente['statusPedido_venda_cliente']?></option>
          <option value=""></option>
          <option value="CADASTRO-PENDENTE">CADASTRO PENDENTE</option>
          <option value="CADASTRO-CONCLUIDO">CADASTRO CONCLUIDO</option>
          </select>
          </div>




          <label class="col-md-1 control-label" for="selectbasic">Tipo</label>
          <div class="col-md-3">

          <select id="motivo_cliente" name="motivo_cliente" class="form-control">

          <option value="<?=$cliente['motivo_cliente']?>"><?=$cliente['motivo_cliente']?></option>
          <option style="color:green" value="VENDA - NOVO CLIENTE"> VENDA - NOVO CLIENTE </option>
          <option style="color:green" value="VENDA - UPGRADE + MULTI"> VENDA - UPGRADE + MULTI </option>
          <option style="color:green" value="VENDA - BASE TV"> VENDA - BASE TV </option>
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

          <label class="col-md-1 control-label">Vendedor</label>  
          <div class="col-md-2">
          <input type="text" name="nomeUsuario" value="<?=$cliente['nomeUsuario']?>"  class="form-control input-md"  >
          </div>

          <label class="col-md-1 control-label">Equipe</label>  
          <div class="col-md-2">
          <input type="text" name="nomeEquipe" value="<?=$cliente['nomeEquipe']?>"  class="form-control input-md">
          </div>

           <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$cliente['nomeEmpresa']?>">

          <label class="col-md-1 control-label">Data</label>  
          <div class="col-md-2">
          <input type="date" name="data_venda" value="<?=$cliente['data_venda']?>"  class="form-control input-md">
          </div>

          <label class="col-md-1 control-label">Hora</label>  
          <div class="col-md-2">
          <input type="time" name="hora_venda" value="<?=$cliente['hora_venda']?>"  class="form-control input-md">
          </div>


          </div>



          <div class="form-group">
          <label  class="col-sm-1 control-label" for="textinput">Audio</label>
          <div class="col-sm-3">
          <td> 
          <audio controls="controls">
          <source src="../audiomultisales/<?=$audio?>" type="audio/mp3" />
          </audio>
          </td>
          <br />
          <a href="../baixar.php?arquivo=audiomultisales/<?=$audio?>">Baixar MP3</a>
          </div>


          <label class="col-sm-2 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar audio:</label>
          <input type="file" id="audio_multisales" name="audio_multisales">
          </div>

          </div>


<button type="button" id="botao" class="btn btn-default active btn-xs" title="Mostrar Imagem" onClick="ativa()"><span class="glyphicon glyphicon-picture"></span></button>

<div id='div' style='display:none'> 
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
</div>




          

          <hr />
          <br/>
          <br/>
          <h4><center><strong style="color:green">Backoffice</strong></center></h4>
          <br/>

          <input type="text" style="display: none" name="nomeUsuarioBack" class="form-control input-md" id="nomeUsuarioBack" value="<?=$nomeUsuario?>">

          <input type="text" style="display: none" name="nomeEquipeBack" class="form-control input-md" id="nomeEquipeBack" value="<?=$nomeEquipe?>">

          <input type="text" style="display: none" name="nomeEmpresaBack" class="form-control input-md" id="nomeEmpresaBack" value="<?=$nomePrestadora?>">

          <input type="time" style="display: none" name="hora_back" class="form-control input-md" id="hora_back" value="<?=$horaDia?>">

          <input type="date" style="display: none" name="data_back" class="form-control input-md" id="data_back" value="<?=$dataDia?>">

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
          <input type="date" class="form-control" value="<?=$cliente['data_back']?>" readonly>
          </div>
          </div>

          </div>

          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">St. Venda</label>
          <div class="col-md-3">
          
          <select id='select' required name='statusVenda_venda_cliente' value="<?=$cliente['statusVenda_venda_cliente']?>" class="form-control">
          <option value="<?=$cliente['statusVenda_venda_cliente']?>"><?=$cliente['statusVenda_venda_cliente']?></option>
          <option></option>
          <option value="ATIVADO">ATIVADO</option>
          <option value="ATIVADO MIGRACAO">ATIVADO MIGRACAO</option>
          <option value="NAO ATIVADO">NAO ATIVADO</option>
          <option value="PENDENTE">PENDENTE</option>
          <option value="AGENDADO">AGENDADO</option>
          <option value="QUEBRA">QUEBRA</option>
          <option value="INSTALADO">INSTALADO</option>
          <option value="CANCELADO">CANCELADO</option>
          <option value="REPROVADA">REPROVADA</option>
          <option value="SSI">SSI</option>
          <option value="UPGRADE">UPGRADE</option>
          <option value="EM CADASTRO">EM CADASTRO</option>
          <option value="DUPLICIDADE CPF">DUPLICIDADE CPF</option>
          <option value="DUPLICIDADE DCC">DUPLICIDADE DCC</option>
          <option value="AGUARDANDO PAGAMENTO">AGUARDANDO PAGAMENTO</option>
          <option value="AGUARDANDO RETORNO BC">AGUARDANDO RETORNO BC</option>
          </select>
          </div>

          



          
          <div id='mestre'>

          
          <div id='INSTALADO'>

          <label class="col-md-2 control-label" for="selectbasic">Data da Instalacao</label>
          <input type="date"  class="col-md-3" style="height: 30px" id="data_inst_venda_cliente" name="data_inst_venda_cliente" value="<?=$cliente['data_inst_venda_cliente']?>" class="form-control input-md">
          </div>

          <div id='ATIVADO'>

          <label class="col-md-2 control-label" for="selectbasic">Data de Ativacao</label>
          <input type="date"  class="col-md-3" style="height: 30px" id="data_ativacao" name="data_ativacao" value="<?=$cliente['data_ativacao']?>" class="form-control input-md">
          </div>



          <div id='AGENDADO'>

          <label class="col-md-2 control-label" for="selectbasic">Data do Agendamento</label>
          <input type="date" class="col-md-2" style="height: 30px" id="data_agendamento_venda_cliente" name="data_agendamento_venda_cliente" value="<?=$cliente['data_agendamento_venda_cliente']?>" class="form-control input-md">

          <label class="col-md-1 control-label" for="selectbasic">Periodo</label>
          <select style="width: 200px; height: 30px;" id="periodo_agendamento_back" value="<?=$cliente['periodo_agendamento_back']?>" name="periodo_agendamento_back" class="col-md-3" >
          <option value="<?=$cliente['periodo_agendamento_back']?>"><?=$cliente['periodo_agendamento_back']?></option>
          <option value=""></option>
          <option value="INTEGRAL">INTEGRAL</option>
          <option value="MANHA">MANHA</option>
          <option value="TARDE">TARDE</option>
          </select>


          </div>

  
          

          <div id='CANCELADO'>
          <label class="col-md-2 control-label" for="selectbasic">Data Cancelamento</label>
          <input type="date" style="width: 200px; height: 30px; type="date" id="  data_canc_venda_cliente" name="data_canc_venda_cliente" value="<?=$cliente['data_canc_venda_cliente']?>" class="col-md-2" class="form-control input-md">


          <label class="col-md-1 control-label" for="selectbasic">Motivo</label>
          <select style="width: 260px; height: 30px;" id="motivoCanc_venda_cliente" value="<?=$cliente['motivoCanc_venda_cliente']?>" name="motivoCanc_venda_cliente" class="col-md-3" >
          <option value="<?=$cliente['motivoCanc_venda_cliente']?>"><?=$cliente['motivoCanc_venda_cliente']?></option>
          <option value=""></option>
          <option value="CANCELADO SSI">CANCELADO SSI</option>
          <option value="RETORNO SSI">RETORNO SSI</option>
          <option value="CPF REPROVADO">CPF REPROVADO</option>
          <option value="CREDITO EXTERNO">CREDITO EXTERNO</option>
          <option value="DESISTENCIA DE ASSINATURA">DESISTENCIA DE ASSINATURA</option>
          <option value="NAO SOLICITOU O SERVICO">NAO SOLICITOU O SERVICO</option>
          <option value="DUPLICIDADE DE CONTRATO">DUPLICIDADE DE CONTRATO</option>
          <option value="INSATISFEITO COM A EQUIPE TECNICA">INSATISFEITO COM A EQUIPE TECNICA</option>
          <option value="INSATISFEITO COM O VENDEDOR">INSATISFEITO COM O VENDEDOR</option>
          <option value="RESIDENCIA NAO CONTEMPLA PADRAO">RESIDENCIA NAO CONTEMPLA PADRAO</option>
          <option value="TAP LOTADO">TAP LOTADO</option>
          <option value="ERRO DE VENDA">ERRO DE VENDA</option>
          <option value="ERRO NO ENDERECO">ERRO NO ENDERECO</option>
          <option value="CORRECAO DE CADASTRO">CORRECAO DE CADASTRO</option>
          <option value="CLIENTE NAO LOCALIZADO">CLIENTE NAO LOCALIZADO</option>
          <option value="ENDERECO NAO LOCALIZADO">ENDERECO NAO LOCALIZADO</option>
          <option value="SEM MDU / BACKBONE">SEM MDU / BACKBONE</option>
          <option value="NAO TEM CABEAMENTO">NAO TEM CABEAMENTO</option>
          <option value="SEM POSTE / INFRAESTRUTURA">SEM POSTE / INFRAESTRUTURA</option>
          <option value="OUTROS - ESPECIFICAR">OUTROS - ESPECIFICAR</option>
          </select>
          </div>


          
          <div id='QUEBRA'>
          <label class="col-md-2 control-label" for="selectbasic">Motivo Quebra </label>
          <input type="text" class="col-md-3" style="height: 30px" id="motivoQuebra_venda_cliente" name="motivoQuebra_venda_cliente" value="<?=$cliente['motivoQuebra_venda_cliente']?>" class="form-control input-md">
          </div>


          </div>
          </div>

          

          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Checklist</label>
          <div class="col-md-3">
          
          <select required name='statusChecklist' value="<?=$cliente['statusChecklist']?>" class="form-control">
          <option value="<?=$cliente['statusChecklist']?>"><?=$cliente['statusChecklist']?></option>
          <option></option>
          <option value="CHECKLIST-PENDENTE">CHECKLIST PENDENTE</option>
          <option value="CHECKLIST-CONCLUIDO">CHECKLIST CONCLUIDO</option>
          <option value="CHECKLIST-FINALIZADO">CHECKLIST FINALIZADO</option>
          </select>
          </div>

         <label class="col-md-5 control-label" for="selectbasic">MultiSales</label>
          <div class="col-md-3">
          
          <select required name='multisales' value="<?=$cliente['multisales']?>" class="form-control">
          <option value="<?=$cliente['multisales']?>"><?=$cliente['multisales']?></option>
          <option></option>
          <option value="OK">OK</option>
          <option value="PENDENTE">PENDENTE</option>
          </select>
          </div>


          </div>


                    <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-11">
          <label for="textinput">Observacao Backoffice</label>
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" class="form-control" style="text-transform: uppercase" name="observacaoBack_venda_cliente" id="observacaoBack_venda_cliente">' . $cliente['observacaoBack_venda_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>


          <br>


        <div class="form-group">
          <label class="col-md-10 control-label" for="button1id"></label>
            <div class="col-md-2">
            <button type="submit" class="btn btn-block btn-success active">Salvar</button>
          </div>
        </div>



          </div>

</form>
</div>

</div>



</body>
      <script src="../js/jquery-2.2.3.min.js"></script>
      <script src="../js/scripts-geral.js"></script>
      <script src="../css/bootstrap/js/bootstrap.min.js"></script>
      <script src="../js/jquery.maskedinput.js"></script>
      <script src="../js/funcao-maske.js"></script>
      <script src="../js/jquery.maskedinput.min.js"></script>
      <script src="../js/funcao-maskemoney.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>



</html>


<?php }else{?>

   <script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>   

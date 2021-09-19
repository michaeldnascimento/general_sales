<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($nivel == 2 OR $nivel == 3 OR $nivel == 4){



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
'conexao'

);


$tabelas = array(
array('clientes', 'id_cliente')

);

$where = array(
'id_cliente' => $id
);


$stringSql = gera_select($campos, $tabelas, $where);
//echo $stringSql;
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

          <label class="col-sm-1 control-label" for="textinput">Solicitante</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" name="nome_contato_cliente" maxlength="50" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div> 

          <label class="col-sm-1 control-label" for="textinput">Titular</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase"  name="nome_cliente" maxlength="50" class="form-control input-md" id="nome_cliente" value="<?=$cliente['nome_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>
        </div>


          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" maxlength="18" name="cpf_cnpj_cliente" id="cpfCnpj" value="<?=$cliente['cpf_cnpj_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">RG/IE</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" class="form-control" maxlength="16" name="rg_ie_cliente" id="rgEi" value="<?=$cliente['rg_ie_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">D.Nasc</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data_nasc_cliente"  id="data_nasc_cliente" value="<?=$cliente['data_nasc_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

          </div>

          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Pessoa</label>
          <div class="col-sm-2">
          <div class="input-group">
          <select id="tipo_pessoa_cliente" name="tipo_pessoa_cliente" class="form-control">
          <option value="<?=$cliente['tipo_pessoa_cliente']?>"><?=$cliente['tipo_pessoa_cliente']?></option>
          <option value=""></option>
          <option value="Fisica">Fisica</option>
          <option value="Juridica">Juridica</option>
          </select>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Sexo</label>
          <div class="col-sm-2">
          <div class="input-group">
          <select id="sexo_cliente" name="sexo_cliente" class="form-control">
          <option value="<?=$cliente['sexo_cliente']?>"><?=$cliente['sexo_cliente']?></option>
          <option value=""></option>
          <option value="F">F</option>
          <option value="M">M</option>
          </select>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Mae</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" class="form-control" name="nome_mae_cliente" id="nome_mae_cliente" value="<?=$cliente['nome_mae_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

        </div>




          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Email</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="email" class="form-control" name="email_cliente" id="email_cliente" value="<?=$cliente['email_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-envelope"></i></span>
          </div>
          </div>
          </div>



          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>



          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="fone_cliente" id="campoTelefone" value="<?=$cliente['fone_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Celular</label>

          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="celular_cliente" id="campoCelular" value="<?=$cliente['celular_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>


          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  class="form-control" name="fone3_cliente" id="campoTelefone2" value="<?=$cliente['fone3_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>

          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="fone4_cliente" id="campoTelefone3" value="<?=$cliente['fone4_cliente']?>">
           <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>

          </div>




          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">CEP</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="cep_cliente" id="campoCEP" value="<?=$cliente['cep_cliente']?>" size="10" maxlength="9" onblur="pesquisacep(this.value);">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Endereco</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" class="form-control" maxlength="50" name="endereco_cliente" id="endereco_cliente" value="<?=$cliente['endereco_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>


          <div class="col-sm-1">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" class="form-control" maxlength="10" name="enderecoNumero_cliente" id="enderecoNumero_cliente" value="<?=$cliente['enderecoNumero_cliente']?>">

          </div>
          </div>


          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" class="form-control" maxlength="15" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente" value="<?=$cliente['enderecoComplemento_cliente']?>">

          </div>
          </div>

          </div>



          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Bairro</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" style="text-transform: uppercase" class="form-control" maxlength="30" name="bairro_cliente" id="bairro_cliente" value="<?=$cliente['bairro_cliente']?>">
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
          </div>
          </div>

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

          <label class="col-md-2 control-label" for="selectbasic">N. Combo*</label>
          <div class="col-md-3">
          <select id="numPacote_venda_cliente" name="numPacote_venda_cliente" class="form-control">
          <option value="<?=$cliente['numPacote_venda_cliente']?>"><?=$cliente['numPacote_venda_cliente']?></option>
          <option value=""></option>
          <option value="NAO SE APLICA">NAO SE APLICA</option>
          <option value="600">  600 </option>
          <option value="630">  630 </option>
          <option value="660">  660 </option>
          <option value="661">  661 </option>
          <option value="663">  663 </option>
          <option value="665">  665 </option>
          <option value="666">  666 </option>
          <option value="667">  667 </option>
          <option value="669">  669 </option>
          <option value="671">  671 </option>
          <option value="672">  672 </option>
          <option value="673">  673 </option>
          <option value="675">  675 </option>
          <option value="677">  677 </option>
          <option value="701">  701 </option>
          <option value="1140">  1140  </option>
          <option value="1150">  1150  </option>
          <option value="1151">  1151  </option>
          <option value="1152">  1152  </option>
          <option value="1153">  1153  </option>
          <option value="1154">  1154  </option>
          <option value="1171">  1171  </option>
          <option value="1173">  1173  </option>
          <option value="1175">  1175  </option>
          <option value="1224">  1224  </option>
          <option value="1225">  1225  </option>
          <option value="1226">  1226  </option>
          <option value="1227">  1227  </option>
          <option value="1228">  1228  </option>
          <option value="1229">  1229  </option>
          <option value="1230">  1230  </option>
          <option value="1231">  1231  </option>
          <option value="1232">  1232  </option>
          <option value="1233">  1233  </option>
          <option value="1234">  1234  </option>
          <option value="1235">  1235  </option>
          <option value="1236">  1236  </option>
          <option value="1237">  1237  </option>
          <option value="1238">  1238  </option>
          <option value="1239">  1239  </option>
          <option value="1240">  1240  </option>
          <option value="1241">  1241  </option>
          <option value="1242">  1242  </option>
          <option value="1243">  1243  </option>
          <option value="1244">  1244  </option>
          <option value="1245">  1245  </option>
          <option value="1246">  1246  </option>
          <option value="1247">  1247  </option>
          <option value="1248">  1248  </option>
          <option value="1249">  1249  </option>
          <option value="1250">  1250  </option>
          <option value="1251">  1251  </option>
          <option value="1252">  1252  </option>
          <option value="1253">  1253  </option>
          <option value="1254">  1254  </option>
          <option value="1255">  1255  </option>
          <option value="1256">  1256  </option>
          <option value="1257">  1257  </option>
          <option value="1258">  1258  </option>
          <option value="1259">  1259  </option>
          <option value="1260">  1260  </option>
          <option value="1261">  1261  </option>
          <option value="1262">  1262  </option>
          <option value="1263">  1263  </option>
          <option value="1264">  1264  </option>
          <option value="1265">  1265  </option>
          <option value="1266">  1266  </option>
          <option value="1267">  1267  </option>
          <option value="1268">  1268  </option>
          <option value="1269">  1269  </option>
          <option value="1270">  1270  </option>
          <option value="1271">  1271  </option>
          <option value="1272">  1272  </option>
          <option value="1273">  1273  </option>
          <option value="1274">  1274  </option>
          <option value="1275">  1275  </option>
          <option value="1276">  1276  </option>
          <option value="1277">  1277  </option>
          <option value="1278">  1278  </option>
          <option value="1279">  1279  </option>
          <option value="1280">  1280  </option>
          <option value="1281">  1281  </option>
          <option value="1282">  1282  </option>
          <option value="1283">  1283  </option>
          <option value="1284">  1284  </option>
          <option value="1285">  1285  </option>
          <option value="1286">  1286  </option>
          <option value="1287">  1287  </option>
          <option value="1288">  1288  </option>
          <option value="1289">  1289  </option>
          <option value="1290">  1290  </option>
          <option value="1291">  1291  </option>
          <option value="1292">  1292  </option>
          <option value="1293">  1293  </option>
          <option value="1294">  1294  </option>
          <option value="1295">  1295  </option>
          <option value="1486">  1486  </option>
          <option value="1487">  1487  </option>
          <option value="1488">  1488  </option>
          <option value="1489">  1489  </option>
          <option value="1490">  1490  </option>
          <option value="1491">  1491  </option>
          <option value="1492">  1492  </option>
          <option value="1493">  1493  </option>
          <option value="1494">  1494  </option>
          <option value="1495">  1495  </option>
          <option value="1496">  1496  </option>
          <option value="1497">  1497  </option>
          <option value="1498">  1498  </option>
          <option value="1499">  1499  </option>
          <option value="1500">  1500  </option>
          <option value="1501">  1501  </option>
          <option value="1502">  1502  </option>
          <option value="1503">  1503  </option>
          <option value="1504">  1504  </option>
          <option value="1505">  1505  </option>
          <option value="1506">  1506  </option>
          <option value="1507">  1507  </option>
          <option value="1508">  1508  </option>
          <option value="1540">  1540  </option>
          <option value="1541">  1541  </option>
          <option value="1542">  1542  </option>
          <option value="1543">  1543  </option>
          <option value="1544">  1544  </option>
          <option value="1545">  1545  </option>
          <option value="1546">  1546  </option>
          <option value="1547">  1547  </option>
          <option value="1548">  1548  </option>
          <option value="1549">  1549  </option>
          <option value="1550">  1550  </option>
          <option value="1551">  1551  </option>
          <option value="1552">  1552  </option>
          <option value="1553">  1553  </option>
          <option value="1554">  1554  </option>
          <option value="1555">  1555  </option>
          <option value="1556">  1556  </option>
          <option value="1557">  1557  </option>
          <option value="1558">  1558  </option>
          <option value="1559">  1559  </option>
          <option value="1560">  1560  </option>
          <option value="1561">  1561  </option>
          <option value="1562">  1562  </option>
          <option value="1563">  1563  </option>
          <option value="1564">  1564  </option>
          <option value="1565">  1565  </option>
          <option value="1566">  1566  </option>
          <option value="1567">  1567  </option>
          <option value="1568">  1568  </option>
          <option value="1569">  1569  </option>
          <option value="1570">  1570  </option>
          <option value="1571">  1571  </option>
          <option value="1572">  1572  </option>
          <option value="1573">  1573  </option>
          <option value="1574">  1574  </option>
          <option value="1575">  1575  </option>
          <option value="1700">  1700  </option>
          <option value="1701">  1701  </option>
          <option value="1702">  1702  </option>
          <option value="1703">  1703  </option>
          <option value="1704">  1704  </option>
          <option value="1705">  1705  </option>
          <option value="1706">  1706  </option>
          <option value="1707">  1707  </option>
          <option value="1708">  1708  </option>
          <option value="1709">  1709  </option>
          <option value="1710">  1710  </option>
          <option value="1711">  1711  </option>
          <option value="1712">  1712  </option>
          <option value="1713">  1713  </option>
          <option value="1714">  1714  </option>
          <option value="1715">  1715  </option>
          <option value="1716">  1716  </option>
          <option value="1717">  1717  </option>
          <option value="1718">  1718  </option>
          <option value="1719">  1719  </option>
          <option value="1720">  1720  </option>
          <option value="1721">  1721  </option>
          <option value="1722">  1722  </option>
          <option value="1723">  1723  </option>
          <option value="1724">  1724  </option>
          <option value="1725">  1725  </option>
          <option value="1726">  1726  </option>
          <option value="1727">  1727  </option>
          <option value="1728">  1728  </option>
          <option value="1729">  1729  </option>
          <option value="1730">  1730  </option>
          <option value="1731">  1731  </option>
          <option value="1732">  1732  </option>
          <option value="1733">  1733  </option>
          <option value="1734">  1734  </option>
          <option value="1735">  1735  </option>
          <option value="1736">  1736  </option>
          <option value="1737">  1737  </option>
          <option value="1738">  1738  </option>
          <option value="1739">  1739  </option>
          <option value="1740">  1740  </option>
          <option value="1741">  1741  </option>
          <option value="1742">  1742  </option>
          <option value="1743">  1743  </option>
          <option value="1744">  1744  </option>
          <option value="1745">  1745  </option>
          <option value="1746">  1746  </option>
          <option value="1747">  1747  </option>
          <option value="1748">  1748  </option>
          <option value="1749">  1749  </option>
          <option value="1750">  1750  </option>
          <option value="1751">  1751  </option>
          <option value="1752">  1752  </option>
          <option value="1753">  1753  </option>
          <option value="1754">  1754  </option>
          <option value="1755">  1755  </option>
          <option value="1756">  1756  </option>
          <option value="1757">  1757  </option>
          <option value="1758">  1758  </option>
          <option value="1759">  1759  </option>
          <option value="1760">  1760  </option>
          <option value="1761">  1761  </option>
          <option value="1762">  1762  </option>
          <option value="1763">  1763  </option>
          <option value="1764">  1764  </option>
          <option value="1765">  1765  </option>
          <option value="1766">  1766  </option>
          <option value="1767">  1767  </option>
          <option value="1768">  1768  </option>
          <option value="1769">  1769  </option>
          <option value="1770">  1770  </option>
          <option value="1771">  1771  </option>
          <option value="1772">  1772  </option>
          <option value="1773">  1773  </option>
          <option value="1774">  1774  </option>
          <option value="1775">  1775  </option>
          <option value="1776">  1776  </option>
          <option value="1777">  1777  </option>
          <option value="1778">  1778  </option>
          <option value="1779">  1779  </option>
          <option value="1780">  1780  </option>
          <option value="1781">  1781  </option>
          <option value="1782">  1782  </option>
          <option value="1783">  1783  </option>
          <option value="1801">  1801  </option>
          <option value="1802">  1802  </option>
          <option value="1803">  1803  </option>
          <option value="1804">  1804  </option>
          <option value="1805">  1805  </option>
          <option value="1806">  1806  </option>
          <option value="1807">  1807  </option>
          <option value="1808">  1808  </option>
          <option value="1809">  1809  </option>
          <option value="1810">  1810  </option>
          <option value="1811">  1811  </option>
          <option value="1812">  1812  </option>
          <option value="1813">  1813  </option>
          <option value="1814">  1814  </option>
          <option value="1815">  1815  </option>
          <option value="1816">  1816  </option>
          <option value="1817">  1817  </option>
          <option value="1818">  1818  </option>
          <option value="1819">  1819  </option>
          <option value="1820">  1820  </option>
          <option value="1821">  1821  </option>
          <option value="1822">  1822  </option>
          <option value="1823">  1823  </option>
          <option value="1824">  1824  </option>
          <option value="2056">  2056  </option>
          <option value="2267">  2267  </option>
          <option value="3000">  3000  </option>
          <option value="3005">  3005  </option>
          <option value="3022">  3022  </option>
          <option value="3027">  3027  </option>

          <option value="PTV">  PTV  </option>
          <option value="PTV+VIRTUA">  PTV+VIRTUA </option>
          <option value="PTV+VIRTUA+FONE">  PTV+VIRTUA+FONE  </option>
          <option value="PTV+VIRTUA+CELULAR">  PTV+VIRTUA+CELULAR  </option>
          <option value="PTV+FONE">  PTV+FONE </option>
          <option value="PTV+VIRTUA+FONE+CELULAR">  PTV+VIRTUA+FONE+CELULAR </option>
          <option value="VIRTUA+FONE">  VIRTUA+FONE</option>
          <option value="PME">  PME  </option>
          </select>
          </div>

          <label class="col-md-2 control-label" for="selectbasic">Valor</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text"  class="form-control" name="valor_venda_cliente" id="valor" value="<?=$cliente['valor_venda_cliente']?>" placeholder="R$ 0,00">
          </div>
          </div>


          </div>


          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">TV</label>
          <div class="col-md-5">
          <select id="tv_venda_cliente" name="tv_venda_cliente" class="form-control">
          <option value="<?=$cliente['tv_venda_cliente']?>"><?=$cliente['tv_venda_cliente']?></option>
           <option value=""></option>
          <option value="FACIL HD - NET">FACIL HD - NET</option>
          <option value="ESSENCIAL HD - NET">ESSENCIAL HD - NET</option>
          <option value="MAIS HD - NET">MAIS HD - NET</option>
          <option value="TOP HD - NET">TOP HD - NET</option>
          <option value="TOP HD MAX - NET">TOP HD MAX - NET</option>
          <option value="COMPACTO DIGITAL - NET">COMPACTO DIGITAL - NET</option>
          <option value="COMPACTO HD - NET">COMPACTO HD - NET</option>
          <option value="PLUS HD - NET">PLUS HD - NET</option>
          <option value="CORP HD - NET">CORP HD - NET</option>
          <option value="ACESSO VIRTUA - NET">ACESSO VIRTUA - NET</option>
          <option value="CONEXAO DIGITAL - NET">CONEXAO DIGITAL - NET</option>
          <option value="FACIL LIGHT DIGITAL - CLARO">FACIL LIGHT DIGITAL - CLARO</option>
          <option value="LIGHT DIGITAL - CLARO">LIGHT DIGITAL - CLARO</option>
          <option value="MIX DIGITAL - CLARO">MIX DIGITAL - CLARO</option>
          <option value="MIX HD S PO">MIX HD S PO</option>
          <option value="MIX HD  C PO">MIX HD  C PO </option>
          <option value="MIX HD MAX S PO">MIX HD MAX S PO</option>
          <option value="MIX HD MAX C PO">MIX HD MAX C PO</option>
          <option value="MIX HD - CLARO">MIX HD - CLARO</option>
          <option value="TOP HD MAX">TOP HD MAX</option>
          <option value="TOP HD - CLARO">TOP HD - CLARO</option>
          <option value="TOP HD MAX - CLARO">TOP HD MAX - CLARO</option>
           </select>
           </div>


          <label class="col-md-1 control-label" for="selectbasic">Internet</label>
          <div class="col-md-5">
          <select id="internet_venda_cliente" name="internet_venda_cliente" class="form-control">
          <option value="<?=$cliente['internet_venda_cliente']?>"><?=$cliente['internet_venda_cliente']?></option>
           <option value=""></option>
          <option value="1 MEGA - NET">1 MEGA - NET</option>
          <option value="2 MEGA - NET">2 MEGA - NET</option>
          <option value="5 MEGA - NET">5 MEGA - NET</option>
          <option value="5 MEGA C/WI-FI - NET">5 MEGA C/WI-FI - NET</option>
          <option value="15 MEGA - NET">15 MEGA - NET</option>
          <option value="30 MEGA - NET">30 MEGA - NET</option>
          <option value="35 MEGA - NET">35 MEGA - NET</option>
          <option value="60 MEGA - NET">60 MEGA - NET</option>
          <option value="120 MEGA - NET">120 MEGA - NET</option>
          <option value=""></option>
          <option value="1 MEGA-PME IP FIXO - NET">1 MEGA-PME IP FIXO - NET</option>
          <option value="10 MEGA-PME IP FIXO - NET">10 MEGA-PME IP FIXO - NET</option>
          <option value="10 MEGA-PME - NET">10 MEGA-PME - NET</option>
          <option value="20 MEGA-PME - NET">20 MEGA-PME - NET</option>
          <option value="30 MEGA-PME - NET">30 MEGA-PME - NET</option>
          <option value="60 MEGA-PME - NET">60 MEGA-PME - NET</option>
          <option value="120 MEGA-PME - NET">120 MEGA-PME - NET</option>
          <option value=""></option>
          <option value="INTERNET 20GB - CLARO">INTERNET 20GB - CLARO</option>
          <option value="INTERNET 40GB - CLARO">INTERNET 40GB - CLARO</option>
           </select>

      </div>


          </div>


          <!-- Select Basic -->
          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Telefonia</label>
          <div class="col-md-5">
          <select id="netfone_venda_cliente" name="netfone_venda_cliente" class="form-control">
          <option value="<?=$cliente['netfone_venda_cliente']?>"><?=$cliente['netfone_venda_cliente']?></option>
           <option value=""></option>
           <option value="NETFONE ILIM. NET - NET">NETFONE ILIM. NET- NET</option>
           <option value="ILIMITADO LOCAL - NET">ILIMITADO LOCAL - NET</option>
           <option value="BRASIL TOTAL 21 - NET">BRASIL TOTAL 21 - NET</option>
           <option value="ILIMITADO BRASIL 21 - NET">ILIMITADO BRASIL 21 - NET</option>
           <option value="ILIMITADO MUNDO 21 - NET">ILIMITADO MUNDO 21 - NET</option>
           <option value="ECONOMICO 2 LINHAS C/PORT - NET">ECONOMICO 2 LINHAS C/PORT - NET</option>
           <option value="ECONOMICO 2 LINHAS S/PORT - NET">ECONOMICO 2 LINHAS S/PORT - NET</option>
           <option value="ECONOMICO 4 LINHAS - NET">ECONOMICO 4 LINHAS - NET</option>
           <option value="ECONOMICO 8 LINHAS - NET">ECONOMICO 8 LINHAS - NET</option>
           <option value="ILIMITADO 1 LINHA - NET">ILIMITADO 1 LINHA - NET</option>
           <option value="ILIMITADO 2 LINHAS - NET">ILIMITADO 2 LINHAS - NET</option>
           <option value="ILIMITADO 4 LINHAS - NET">ILIMITADO 4 LINHAS - NET</option>
           <option value="ILIMITADO 8 LINHAS - NET">ILIMITADO 8 LINHAS - NET</option>
           <option value="FONE ILIMITADO LOCAL - CLARO">FONE ILIMITADO LOCAL - CLARO</option>
           <option value="FONE ILIMITADO BRASIL 21 - CLARO">FONE ILIMITADO BRASIL 21 - CLARO</option>
           <option value="FONE ILIMITADO MUNDO - CLARO">FONE ILIMITADO MUNDO - CLARO</option>
           </select>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Port.Fixo</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="tel" maxlength="12" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" placeholder="N. Portabilidade Fixo" name="portfone_venda_cliente" id="portfone_venda_cliente" value="<?=$cliente['portfone_venda_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-earphone"></i></span>
          </div>
          </div>
          </div>


          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Multi</label>
          <div class="col-md-5">
          <select id="plano_multi_cliente" value="<?=$cliente['plano_multi_cliente']?>" name="plano_multi_cliente" class="form-control">
          <option value="<?=$cliente['plano_multi_cliente']?>"><?=$cliente['plano_multi_cliente']?></option>
          <option value=""></option>
          <option value="CONTROLE R$54,99">CONTROLE R$54,99</option>
          <option value="CONTROLE R$70,10">CONTROLE  R$70,10</option>
          <option value="2 GB + 150 MIN LOCAL">2 GB + 150 MIN LOCAL</option>
          <option value="3GB + 2GB + MIN ILIMITADOS">3GB + 2GB + MIN ILIMITADOS</option>
          <option value="5 GB + MIN ILIMITADOS">5 GB + MIN ILIMITADOS</option>
          <option value="6 GB + MIN ILIMITADOS">6 GB + MIN ILIMITADOS</option>
          <option value="7 GB + MIN ILIMITADOS">7 GB + MIN ILIMITADOS</option>
          <option value="9 GB + MIN ILIMITADOS">9 GB + MIN ILIMITADOS</option>
          <option value="14 GB + MIN ILIMITADOS">14 GB + MIN ILIMITADOS</option>
          <option value="25 GB + MIN ILIMITADOS">25 GB + MIN ILIMITADOS</option>
          </select>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Port. Cel</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="tel" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="N. Portabilidade Celular" maxlength="12" class="form-control" name="portcelular_venda_cliente" id="portcelular_venda_cliente" value="<?=$cliente['portcelular_venda_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-phone"></i></span>
          </div>
          </div>
          </div>




          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Celular</label>
          <div class="col-md-5">
          <select id="netcelular_venda_cliente" name="netcelular_venda_cliente" class="form-control">
          <option value="<?=$cliente['netcelular_venda_cliente']?>"><?=$cliente['netcelular_venda_cliente']?></option>
          <option value=""></option>
          <option value="Controle Turbo 1.4GB">Controle Turbo 1.4GB</option>
          <option value="Controle Turbo 2GB">Controle Turbo 2GB</option>
          <option value="2GB + 150 Min.">2GB + 150 Min.</option>
          <option value="3GB + 200 Min.">3GB + 200 Min.</option>
          <option value="4GB + 300 Min.">4GB + 300 Min.</option>
          <option value="5GB + 500 Min.">5GB + 500 Min.</option>
          <option value="7GB + 700 Min.">7GB + 700 Min.</option>
          <option value="9GB + 1200 Min.">9GB + 1200 Min.</option>
          <option value="15GB + 2200 Min.">15GB + 2200 Min.</option>
          <option value="20 GB + 3200 Min.">20 GB + 3200 Min.</option>

          <option value="2GB + 150 Min. C/ APA">2GB + 150 Min. C/ APA.</option>
          <option value="3GB + 200 Min. C/ APA">3GB + 200 Min. C/ APA</option>
          <option value="4GB + 300 Min. C/ APA">4GB + 300 Min. C/ APA</option>
          <option value="5GB + 500 Min. C/ APA">5GB + 500 Min. C/ APA</option>
          <option value="7GB + 700 Min. C/ APA">7GB + 700 Min. C/ APA</option>
          <option value="9GB + 1200 Min. C/ APA">9GB + 1200 Min. C/ APA</option>
          <option value="15GB + 2200 Min. C/ APA">15GB + 2200 Min. C/ APA</option>
          <option value="20 GB + 3200 Min. C/ APA">20 GB + 3200 Min. C/ APA</option>
          </select>
          </div>

          <label class="col-sm-2 control-label" for="textinput">Qtd CHIP</label>
          <div class="col-md-1">
          <select id="qtdchip_multi_cliente" value="<?=$cliente['qtdchip_multi_cliente']?>" name="qtdchip_multi_cliente" class="form-control">
          <option value="<?=$cliente['qtdchip_multi_cliente']?>"><?=$cliente['qtdchip_multi_cliente']?></option>
          <option value=""></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>>
          </select>
          </div>


          <label class="col-sm-1 control-label" for="textinput">CHIP</label>
          <div class="col-sm-2">
          <div class="input-group">
          <label class="radio-inline">
          
          <input type="radio" 
          name="chipAtivo_cliente" 
          id="chipAtivo_cliente"
          value="SIM" 
          <?php echo ($cliente['chipAtivo_cliente'] == "SIM") ? "checked" : null; ?>/> ATIVO

          </label>
          <label class="radio-inline">

          <input type="radio" 
          name="chipAtivo_cliente" 
          id="chipAtivo_cliente" 
          value="NAO"
          <?php echo ($cliente['chipAtivo_cliente'] == "NAO") ? "checked" : null; ?>/>
          INATIVO

          </label>
          </div>
          </div>
          </div>

          <div class="form-group">
          <label class="col-md-1 control-label" for="selectbasic">Agregado</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="1" class="form-control" style="text-transform: uppercase" name="agregado_venda_cliente" id="agregado_venda_cliente">' . $cliente['agregado_venda_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>

          <div class="form-group">

          <label class="col-md-1 control-label" for="selectbasic">Produto</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="4" class="form-control" style="text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente">' . $cliente['observacao_venda_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>



          <!-- Text input-->

          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Pag.*</label>
          <div class="col-sm-2">
          <select id="formaPagemento_cliente" name="formaPagemento_cliente" class="form-control">
          <option value="<?=$cliente['formaPagemento_cliente']?>"><?=$cliente['formaPagemento_cliente']?></option>
          <option value=""></option>
          <option value="BOLETO">BOLETO</option>
          <option value="DCC">DCC</option>
          <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
          </select>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Venc.</label>
          <div class="col-sm-1">
         <select id="vencimentoPagamento_cliente" name="vencimentoPagamento_cliente" class="form-control">
          <option value="<?=$cliente['vencimentoPagamento_cliente']?>"><?=$cliente['vencimentoPagamento_cliente']?></option>
          <option value=""></option>
          <option value="5">5</option>
          <option value="8">8</option>
          <option value="10">10</option>
          <option value="12">12</option>
          <option value="15">15</option>
          <option value="20">20</option>
          <option value="25">25</option>
          </select>
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Banco</label>
          <div class="col-sm-2">
          <input type="text"  class="form-control" name="pagamentoBanco_cliente" id="pagamentoBanco_cliente" value="<?=$cliente['pagamentoBanco_cliente']?>">
          </div>

          <label class="col-md-1 control-label" for="selectbasic">Agen./Conta</label>
          <div class="col-sm-1">
          <input type="text"  class="form-control" name="pagamentoAgencia_cliente" id="pagamentoAgencia_cliente" value="<?=$cliente['pagamentoAgencia_cliente']?>">
          </div>
          
          <div class="col-sm-2">
          <input type="text"  class="form-control" name="pagamentoConta_cliente" id="pagamentoConta_cliente" value="<?=$cliente['pagamentoConta_cliente']?>">
          </div>
          </div>



          <div class="form-group">
          <label class="col-md-1 control-label" for="selectbasic">Checklist</label>
          <div class="col-md-3">
          <select id="statusChecklist" name="statusChecklist" class="form-control">
          <option value="<?=$cliente['statusChecklist']?>"><?=$cliente['statusChecklist']?></option>
          <option></option>
          <option value="CHECKLIST-PENDENTE">CHECKLIST PENDENTE</option>
          <option value="CHECKLIST-CONCLUIDO">CHECKLIST CONCLUIDO</option>
          </select>
          </div>

          <label class="col-md-2 control-label" for="selectbasic">Tel. Checklist</label>
          <div class="col-sm-2">
          <input type="text"  class="form-control" name="fone_checklist" id="fone_checklist" value="<?=$cliente['fone_checklist']?>">
          </div>
          

          <label class="col-md-2 control-label" for="selectbasic">Tel. Gravacao</label>
          <div class="col-sm-2">
          <input type="text"  class="form-control" name="fone_gravacao" id="fone_gravacao" value="<?=$cliente['fone_gravacao']?>">
          </div>
          </div>


         <hr />
         <br/>
         <br/>
         <h4><center><strong style="color:green">Pedido</strong></center></h4>
         <br/>

          <div class="form-group">
          <label class="col-md-1 control-label" for="numero_proposta_cliente">N.Proposta</label>  
          <div class="col-md-3">
          <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" name="numero_proposta_cliente" id="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>">

          </div>



          <label class="col-md-1 control-label" for="codigo_cliente">Codigo</label>  
          <div class="col-md-3">
          <input type="text" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" class="form-control" name="codigo_cliente" id="codigo_cliente" value="<?=$cliente['codigo_cliente']?>">

          </div>

          <label class="col-sm-1 control-label" for="textinput">Pre-Agen</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" class="form-control" name="data_pre_agendamento_cliente" id="data_pre_agendamento_cliente" value="<?=$cliente['data_pre_agendamento_cliente']?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
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


           <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-11">
          <label for="textinput">Observacao Pedido</label>
          <div class="input-group">
          <?php 
          echo '<textarea rows="3" class="form-control" style="text-transform: uppercase" name="observacao_pedido_cliente" id="observacao_pedido_cliente">' . $cliente['observacao_pedido_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
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
          <option value="NOVA-VENDA">NOVA-VENDA</option>
          <option value="CREDITO-APROVADO">CREDITO-APROVADO</option>
          <option value="CONEXAO">CONEXAO</option>
          <option value="PENDENTE-BACKOFFICE">PENDENTE-BACKOFFICE</option>
          <option value="PENDENTE-VENDEDOR">PENDENTE-VENDEDOR</option>
          <option value="AGENDADO">AGENDADO</option>
          <option value="QUEBRA">QUEBRA</option>
          <option value="INSTALADO">INSTALADO</option>
          <option value="CANCELADO">CANCELADO</option>
          </select>
          </div>

          



          
          <div id='mestre'>

          
          <div id='INSTALADO'>

          <label class="col-md-2 control-label" for="selectbasic">Data da Instalacao</label>
          <input type="date"  class="col-md-3" style="height: 30px" id="data_inst_venda_cliente" name="data_inst_venda_cliente" value="<?=$cliente['data_inst_venda_cliente']?>" class="form-control input-md">
          </div>

          <div id='PENDENTE-VENDEDOR'>

          <label class="col-md-1 control-label" for="selectbasic">Motivo</label>
          <select style="width: 200px; height: 30px;" id="motivoPendenciaVendedor_venda_cliente" name="motivoPendenciaVendedor_venda_cliente" class="col-md-3" >
          <option value="<?=$cliente['motivoPendenciaVendedor_venda_cliente']?>"><?=$cliente['motivoPendenciaVendedor_venda_cliente']?></option>
          <option value=""></option>
          <option value="CPF REPROVADO">CPF REPROVADO</option>
          <option value="ENDERECO NAO LOCALIZADO">ENDERECO NAO LOCALIZADO</option>
          <option value="ATIVO SEM SUCESSO">ATIVO SEM SUCESSO</option>
          <option value="SERVICO VENDIDO INDISPONIVEL">SERVICO VENDIDO INDISPONIVEL</option>
          <option value="ENDERECO ERRADO">ENDERECO ERRADO</option>
          <option value="DADOS BANCARIOS INVALIDOS">DADOS BANCARIOS INVALIDOS</option>
          <option value="DADOS CADASTRAIS INVALIDOS">DADOS CADASTRAIS INVALIDOS</option>
          <option value="FALTA DE EMAIL/FONE">FALTA DE EMAIL/FONE</option>
          </select>
          </div>

          <div id='PENDENTE-BACKOFFICE'>

          <label class="col-md-1 control-label" for="selectbasic">Motivo</label>
          <select style="width: 200px; height: 30px;" id="motivoPendencia_venda_cliente" name="motivoPendencia_venda_cliente" class="col-md-3" >
          <option value="<?=$cliente['motivoPendencia_venda_cliente']?>"><?=$cliente['motivoPendencia_venda_cliente']?></option>
          <option value=""></option>
          <option value="LIBERAR CPF">LIBERAR CPF</option>
          <option value="DUPLICIDADE DE CPF">DUPLICIDADE DE CPF</option>
          <option value="ENDERECO EM ANALISE">ENDERECO EM ANALISE</option>
          <option value="DUPLICIDADE DE DCC">DUPLICIDADE DE DCC</option>
          <option value="DUPLICIDADE DE CARTAO DE CREDITO">DUPLICIDADE DE CARTAO DE CREDITO</option>
          </select>
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

          <label class="col-sm-8 control-label" for="textinput">Conexao</label>
          <div class="col-sm-2">
          <div class="input-group">

          <label class="radio-inline">
          <input type="radio" 
          name="conexao"
          id="conexao"
          value="SIM"
          <?php echo ($cliente['conexao'] == "SIM") ? "checked" : null; ?>/> SIM
          </label>

          <label class="radio-inline">
          <input type="radio" 
          name="conexao"
          id="conexao"
          value="NAO"
          <?php echo ($cliente['conexao'] == "NAO") ? "checked" : null; ?>/> NAO
          </label>
          </div>
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
      <script src="../js/jquery.maskedinput.min.js"></script>
      <script src="../js/funcao-maskemoney.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>



</html>


<?php }else{?>

   <script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>   

<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

      if($acessoPARCEIROS == 'SIM' OR $acessoTODOS == 'SIM'){


      if ($acessoPARCEIROS == 'SIM') {

        $drop = 'none';

      }else{

        $drop = '';
      }




if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
$id = intval($_GET['id']);

          //conectar e selecionar o banco de dados mysql/agenda
          include_once '../funcoes/conexaoPortari.php';
          include_once '../funcoes/funcoes_geraisPortari.php';

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
          'observacao_pedido_cliente',
          'data_venda',
          'hora_venda',
          'nomeEquipe',
          'nomeUsuario',
          'tipo_servico'

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
          <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">
          <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">


</head>
<body>

<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>


<!--*************************************FORM *********************************** -->


<div class="container">


<div id="main">
<form action="salvar-cliente_completoRS.php?id=<?=$id;?>" method="POST" class="form-horizontal">




          <div class="col-sm-12">

<br />

          <h4><center>Dados Cliente</center> </h4>

          <!-- Text input-->
          <div class="form-group">

          <label class="col-sm-1 control-label" for="textinput">ID</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="text" name="id_cliente" class="form-control input-md" id="id_cliente" value="<?=$cliente['id_cliente']?>" disabled >
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Contato</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div> 

          <label class="col-sm-1 control-label" for="textinput">Nome</label>
          <div class="col-sm-5">
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

          <label class="col-sm-1 control-label" for="textinput">Sexo</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="text" class="form-control" name="sexo_cliente" id="sexo_cliente" value="<?=$cliente['sexo_cliente']?>" readonly>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Pessoa</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="text" class="form-control" name="tipo_pessoa_cliente" id="tipo_pessoa_cliente" value="<?=$cliente['tipo_pessoa_cliente']?>" readonly>
          </div>
          </div>
          

          <label class="col-sm-1 control-label" for="textinput">Mae</label>
          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" class="form-control" name="nome_mae_cliente" id="nome_mae_cliente" value="<?=$cliente['nome_mae_cliente']?>" readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Cod. Ant.</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="text" class="form-control" name="nome_mae_cliente" id="codigoAntigo_cliente" value="<?=$cliente['codigoAntigo_cliente']?>" readonly>
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

          <label class="col-sm-1 control-label" for="textinput">N.Contato</label>
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" class="form-control" name="foneContato_venda_cliente" id="foneContato_venda_cliente" value="<?=$cliente['foneContato_venda_cliente']?>"  readonly>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-earphone"></i></span>
          </div>
          </div>
          </div>



          <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="tel" class="form-control" name="ddd_fone_cliente" id="ddd_fone_cliente" value="<?=$cliente['ddd_fone_cliente']?>" readonly>

          </div>
          </div>


          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" class="form-control" name="fone_cliente" id="fone_cliente" value="<?=$cliente['fone_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Celular</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="tel" class="form-control" name="ddd_celular_cliente" id="ddd_celular_cliente" value="<?=$cliente['ddd_celular_cliente']?>" readonly>
          </div>
          </div>

          <div class="col-sm-4">
          <div class="input-group">
          <input type="text" class="form-control" name="celular_cliente" id="celular_cliente" value="<?=$cliente['celular_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
          </div>
          </div>

          </div>

           <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="tel" class="form-control" name="ddd_fone3_cliente" id="ddd_fone3_cliente" value="<?=$cliente['ddd_fone3_cliente']?>" readonly>
          </div>
          </div>


          <div class="col-sm-4">
          <div class="input-group">
          <input type="text"  class="form-control" name="fone3_cliente" id="fone3_cliente" value="<?=$cliente['fone3_cliente']?>" readonly>
          <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
          </div>
          </div>


          <label class="col-sm-1 control-label" for="textinput">Tel. Fixo</label>
          <div class="col-sm-1">
          <div class="input-group">
          <input type="tel" class="form-control" name="ddd_fone4_cliente" id="ddd_fone4_cliente" value="<?=$cliente['ddd_fone4_cliente']?>" readonly>
          </div>
          </div>

          <div class="col-sm-4">
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
          <div class="col-sm-5">
          <div class="input-group">
          <input type="text" readonly class="form-control" name="portcelular_venda_cliente" id="portcelular_venda_cliente" value="<?=$cliente['portcelular_venda_cliente']?>">
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
          <h4><center>Pedido</center> </h4>

          <div class="form-group">
          <label class="col-md-1 control-label" for="codigo_cliente">Codigo</label>  
          <div class="col-md-3">
          <input type="codigo" id="codigo" placeholder="Codigo do cliente" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" name="codigo_cliente" value="<?=$cliente['codigo_cliente']?>" class="form-control input-md" onblur="liberar();" autofocus>
          </div>

          <label class="col-md-1 control-label" for="numero_proposta_cliente">N.Proposta</label>  
          <div class="col-md-3">
          <input type="text" placeholder="Numero de proposta" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" id="numero_proposta_cliente" name="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>" class="form-control input-md">
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

          <label class="col-md-1 control-label" for="numero_proposta_cliente">Vendedor</label>  
          <div class="col-md-2">
          <input type="text" id="nomeUsuario" name="nomeUsuario"  value="<?=$cliente['nomeUsuario']?>"  class="form-control input-md" readonly >
          </div>

          <label class="col-md-1 control-label" for="numero_proposta_cliente">Equipe</label>  
          <div class="col-md-2">
          <input type="text" id="nomeEquipe" name="nomeEquipe"  value="<?=$cliente['nomeEquipe']?>"  class="form-control input-md" readonly >
          </div>

          <label class="col-md-1 control-label" for="numero_proposta_cliente">Data</label>  
          <div class="col-md-2">
          <input type="text" id="hora_venda" name="hora_venda"  value="<?=$cliente['hora_venda']?>"  class="form-control input-md" readonly >
          </div>

          <label class="col-md-1 control-label" for="numero_proposta_cliente">Data</label>  
          <div class="col-md-2">
          <input type="text" id="data_venda" name="data_venda"  value="<?=$cliente['data_venda']?>"  class="form-control input-md" readonly >
          </div>
          </div>



          <div class="form-group">
          <label class="col-md-1 control-label" for="selectbasic">Status*</label>
          <div class="col-md-3">
          <select id="select" name="statusPedido_venda_cliente" class="form-control" required>
          <option value="">SELECIONE</option>
          <option id="pendente" disabled="disabled" value="CADASTRO-PENDENTE">CADASTRO PENDENTE</option>
          <option id="concluido" disabled="disabled" value="CADASTRO-CONCLUIDO">CADASTRO CONCLUIDO</option>
          </select>

          </div>
          <div id='mestre'>
          
          <div id='CADASTRO-PENDENTE'>

          <label class="col-md-2 control-label" for="selectbasic">Mot. Pendencia</label>
          <select id="motivoPendencia_venda_cliente" name="motivoPendencia_venda_cliente" class="form-control" style="width: 550px;">
          <option value="">SELECIONE</option>
          <option value="CREDITO EXTERNO">CREDITO EXTERNO</option>
          <option value="CREDITO INTERNO">CREDITO INTERNO</option>
          <option value="DADOS INCONSISTENTES">DADOS INCONSISTENTES</option>
          <option value="DUPLICIDADE DE CPF">DUPLICIDADE DE CPF</option>
          <option value="ENDERECO EXISTENTE">ENDERECO EXISTENTE</option>
          <option value="ENDERECO INADIMPLENTE">ENDERECO INADIMPLENTE</option>
          <option value="INCONSISTENCIA CADASTRAL">INCONSISTENCIA CADASTRAL</option>
          <option value="OUTROS ENDERECOS">OUTROS ENDERECOS</option>
          <option value="PENDENTE INSTALACAO">PENDENTE INSTALACAO</option>
          <option value="PERFIL CLIENTE X PRODUTO">PERFIL CLIENTE X PRODUTO</option>
          <option value="PROBLEMAS SPC">PROBLEMAS SPC</option>
          <option value="REPROVADO CLARO / EMBRATEL">REPROVADO CLARO / EMBRATEL</option>
          <option value="RESERVA PORTABILIDADE">RESERVA PORTABILIDADE</option>
          <option value="RESERVA TELEFONICA">RESERVA TELEFONICA</option>
          <option value="SOLICITADA PELO OPERADOR">SOLICITADA PELO OPERADOR</option>
          <option value="VISTORIA DE ENDERECO">VISTORIA DE ENDERECO</option>
          <option value="OUTROS">OUTROS</option>
          </select>
          
          
          </div>

          </div>


          </div>

           <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Observacao</label>
          <div class="col-sm-11">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" class="form-control" name="observacao_pedido_cliente" id="observacao_pedido_cliente">' . $cliente['observacao_pedido_cliente'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>


          <input type="text" style="display: none" name="statusVenda_venda_cliente" class="form-control input-md" id="statusVenda_venda_cliente" value="ANALISE BACKOFFICE">

          <br>
          <br>

          <!-- SUBMIT FORM BUTTON-->
          <div class="col-sm-2 pull-right">
          <button type="submit" value="submit" class="btn btn-block btn-success">Salvar</button>
          </div> 

          <br>
          <br>
          <hr />




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

<script type="text/javascript">

function liberar()
{
  var codigo = document.getElementById("codigo"); 
  var pendente= document.getElementById("pendente");
  var concluido= document.getElementById("concluido");

  if(codigo.value != "")
  {
    concluido.disabled=false;
  }

  if(codigo.value != "")
  {
    pendente.disabled=true;
  }

  if(codigo.value == "")
  {
    concluido.disabled=true;
  }

  if(codigo.value == "")
  {
    pendente.disabled=false;
  }
}
</script>

</html>

  <?php }else{?>

    <script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

  <?php }?>
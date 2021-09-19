<?php
session_start();
include_once "../login/verifica.php";


if($nivel == 3){


if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
  $id = intval($_GET['id']);

  //conectar e selecionar o banco de dados mysql/agenda
  include_once '../funcoes/conexaoPortari.php';
  include_once '../funcoes/funcoes_geraisPortari.php';


    $campos = array(
      'id_cliente', //0
      'nome_contato_cliente', //1
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
      'numero_proposta_cliente',
      'observacao_sistema',
      'observacao_cliente',
      'lista_sistema',
      'nomeUsuario',
      'nomeEquipe',
      'hora_venda',
      'data_venda'
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


date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('d/m/Y'); // Resultado: 12/03/2009
$horaDia = date('H:i:s'); // Resultado: 03:39:57


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
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">

  </head>


<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="tratandoLista_cliente.php?id=<?=$id;?>" class="navbar-brand">General Sales</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../mailing/leadNET-SP.php">Lead NET SP</a></li>
            <li><a href="../mailing/leadNET-BR.php">Lead NET BR</a></li>
            <li><a href="../mailing/leadNET-Reconex.php">Lead NET Reconex</a></li>
            <li><a href="../mailing/leadNET-Multi.php">Lead NET Multi</a></li>
            <li><a href="../mailing/leadNET-UTI.php">Lead NET UTI</a></li>
            <li><a href="../mailing/lead-Propostas.php">Lead Propostas</a></li>
            <li><a href="../mailing/lead-M.E.php">Lead M.E.</a></li>
            <li><a href="../mailing/lead-C.E.php">Lead C.E</a></li>
            <li><a href="../mailing/leadMailing-Cancelados.php">Cancelados</a></li>
            <li><a href="../mailing/leadProspects.php">Prospects</a></li>
            <li><a href="../mailing/multibase.php">Multi Base</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendedor<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../vendedor/minhas-vendasLista.php">Minhas Vendidas</a></li>
            <li><a href="../vendedor/minhas-naoVendas.php">Nao Vendas</a></li>
            <li><a href="../vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
            <li><a href="../vendedor/nova_venda.php">Nova Venda</a></li>
            <li><a href="../vendedor/nova-venda-rapida.php">Nova Venda Resumida</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Parceiros<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../parceiros/add-cliente.php">Novo Cliente</a></li>
            <li><a href="../parceiros/minhas-vendas.php">Minhas Vendidas</a></li>
          </ul>
        </li>
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../backoffice/listavenda-backoffice-tratar.php">Lista Vendas Novas</a></li>
              <li><a href="../backoffice/listavenda-backoffice.php">Lista Vendas Gerais</a></li>
              <li><a href="../backoffice/listavenda-backoffice-agendado.php">Lista Vendas Agendadas</a></li>
              <li><a href="../backoffice/listavenda-backoffice-cancelado.php">Lista Vendas Canceladas</a></li>
              <li><a href="../backoffice/listavenda-backoffice-emcadastro.php">Lista Vendas Em Cadastro</a></li>
              <li><a href="../backoffice/listavenda-backoffice-instalado.php">Lista Vendas Instaladas</a></li>
              <li><a href="../backoffice/listavenda-backoffice-pendente.php">Lista Vendas Pendentes</a></li>
              <li><a href="../backoffice/listavenda-backoffice-quebra.php">Lista Vendas Quebra</a></li>
              <li><a href="../backoffice/listavenda-parceiros.php">Lista Venda Parceiros</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrador<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../administrador/novo_mailing.php">Novo Mailing</a></li>
            <li><a href="../administrador/cad-usuario.php">Novo Usuario</a></li>
            <li><a href="../administrador/con-usuario-lista.php">Consultar Usuario</a></li>
            <li><a href="../administrador/importcvs.php">Importar CSV</a></li>
          </ul>
        </li>
        <li>
        <a href="../index.php">Home</a>
        </li>


      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li><a><?php echo $nomeUsuario?></a></li>
          <li class="active ">
              <a href="../login/sair.php">Sair</a>
            </li>
       </ul>

    </nav>
  </div>
</header>



<!--*************************************FORM *********************************** -->

<br/>


<div id="main" class="form-horizontal">
<form action="tratadoLista_cliente.php?id=<?=$id;?>" method="POST">

  <div class="col-sm-12">

  <div id='img'>
    <div id='print-box'>


    <div id='client-info' style='background: url(../print/<?=$imagemAtual?>) -10px -255px;'>
    </div>

    <div id='client-contact' style='background: url(../print/<?=$imagemAtual?>) -10px -465px;'>
    </div>


    </div>
  </div>
  <br />

    <div class="form-group">
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
      
      <label  class="col-sm-2 control-label" for="textinput">Tel. Fixo</label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone_cliente" required id="ddd_fone_cliente" value="<?=$cliente['ddd_fone_cliente']?>">
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="9" class="form-control" name="fone_cliente" required id="fone_cliente" value="<?=$cliente['fone_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
              </div>

      <label  class="col-sm-1 control-label" for="textinput">Celular</label>
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
            <input type="button" id="botao" value="mostra" onClick="ativa()"> 
      </div>

  <div id='div' style='display:none'> 

      <div class="form-group">
      
      <label  class="col-sm-2 control-label" for="textinput">Tel. Fixo 2</label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone3_cliente" id="ddd_fone3_cliente" value="<?=$cliente['ddd_fone3_cliente']?>">
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="9" class="form-control" name="fone3_cliente" id="fone3_cliente" value="<?=$cliente['fone3_cliente']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
              </div>

      <label  class="col-sm-1 control-label" for="textinput">Celular 2</label>
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
      <input type="text" placeholder="N do CEP" maxlength="9" class="form-control" name="cep_cliente"  id="cep_cliente" value="<?=$cliente['cep_cliente']?>">
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
      <input type="text" style="text-transform: uppercase" maxlength="10" placeholder="N" class="form-control" name="enderecoNumero_cliente" id="enderecoNumero_cliente" value="<?=$cliente['enderecoNumero_cliente']?>">

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
                <input type="text" style="text-transform: uppercase" maxlength="50" class="form-control" required name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>">
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
      <option value="VENDA - UPGRADE"> VENDA - UP GRADE </option>
      <option value="VENDA - UPGRADE + MULTI"> VENDA - UP GRADE + MULTI </option>
      <option value="FOLLOW-UP"> NAO VENDA - FOLLOW UP - RETORNO AGENDADO </option>
      <option value="NAO VENDA - TELEFONE NAO ATENDE"> NAO VENDA - TELEFONE NAO ATENDE </option>
      <option value="NAO VENDA - TELEFONE NAO PERTENCE AO CLIENTE"> NAO VENDA - TELEFONE NAO PERTENCE AO CLIENTE</option>
      <option value="NAO VENDA - CLIENTE NAO LOCALIZADO"> NAO VENDA - CLIENTE NAO LOCALIZADO </option>
      <option value="NAO VENDA - DECISOR AUSENTE - REAGENDADO"> NAO VENDA - DECISOR AUSENTE - REAGENDADO </option>
      <option valeu="NAO VENDA - NAO TEM INTERESSE EM NOVA ASSINATURA"> NAO VENDA - NAO TEM INTERESSE EM NOVA ASSINATURA </option>
      <option value="NAO VENDA - PROBLEMAS TECNICOS"> NAO VENDA - PROBLEMAS TECNICOS </option>
      <option value="NAO VENDA - NAO TEM COBERTURA VIRTUA"> NAO VENDA - NAO TEM COBERTURA VIRTUA </option>
      <option value="NAO VENDA - NAO TEM COBERTURA TODOS OS SERVICOS"> NAO VENDA - NAO TEM COBERTURA TODOS OS SERVICOS </option>
      <option value="NAO VENDA - ENDEREÇO BLOQUEADO"> NAO VENDA - ENDERECO BLOQUEADO </option>
      <option value="NAO VENDA - CLIENTE REPETIDO"> NAO VENDA - CLIENTE REPETIDO </option>
      <option value="NAO VENDA - CLIENTE JA CONTRATOU O SERVICO"> NAO VENDA - CLIENTE JA CONTRATOU O SERVICO </option>
      <option value="NAO VENDA - SENDO ATENDIDO POR OUTRO VENDEDOR"> NAO VENDA - SENDO ATENDIDO POR OUTRO VENDEDOR </option>
      <option value="NAO VENDA – EM ATENDIMENTO COM O VENDEDOR DA EMPRESA"> NAO VENDA - EM ATENDIMENTO COM O VENDEDOR DA EMPRESA VENDEDOR </option>
      <option value="NAO VENDA – EM ATENDIMENTO COM O VENDEDOR NET"> NAO VENDA - EM ATENDIMENTO COM O VENDEDOR NET </option>
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


           <label class="col-sm-2 control-label" for="textinput">Codigo Anterior</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" placeholder="Codigo antigo" maxlength="20" class="form-control" name="codigoAntigo_cliente" id="codigoAntigo_cliente" value="<?=$cliente['codigoAntigo_cliente']?>" required>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>

            <label class="col-sm-3 control-label" for="textinput">Proposta</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" placeholder="N Proposta" maxlength="20" class="form-control" name="numero_proposta_cliente" id="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>">
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

      <div class="form-group">


           <label class="col-sm-2 control-label" for="textinput">Vendedor/Equipe</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" maxlength="20" class="form-control" name="nomeUsuario" id="nomeUsuario" value="<?=$cliente['nomeUsuario']?>" required>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>

            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" maxlength="20" class="form-control" name="nomeEquipe" id="nomeEquipe" value="<?=$cliente['nomeEquipe']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Hora/Data</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" maxlength="20" class="form-control" name="hora_venda" id="hora_venda" value="<?=$cliente['hora_venda']?>" required>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>

            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" maxlength="20" class="form-control" name="data_venda" id="data_venda" value="<?=$cliente['data_venda']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

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
            <a onclick="javascript:history.back();self.location.reload();" class="btn btn-default">Voltar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
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


</html>


<?php }else{?>

  <script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

<?php }?>
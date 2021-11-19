<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

      if ($empresa != 1) {
        $obsCad = 'none';
      }

      $mensagem = "";
      if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
        $alerta = '';
        $mensagem = $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
      }else{
        $alerta = 'none';
      }


      if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
      $id = intval($_GET['id']);
        $lista = strval($_GET['lista']);

      //conectar e selecionar o banco de dados mysql/agenda
      include_once '../funcoes/conexaoPortari.php';
      include_once '../funcoes/funcoes_geraisPortari.php';

      //gera uma query para buscar todos os contatos


      $campos = array(
      'id_cliente', //0
      'nome_contato_cliente',
      'nome_cliente', //1
      'rg_ie_cliente', //2
      'cpf_cnpj_cliente',
      'data_nasc_cliente',
      'tipo_pessoa_cliente',
      'sexo_cliente',
      'nome_mae_cliente',
      'email_cliente',
      'origemCSV',
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
      'observacao_cliente',
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
      'tipo_servico',
      'numPacote_venda_cliente',
      'valor_venda_cliente',
      'formaPagemento_cliente',
      'vencimentoPagamento_cliente',
      'pagamentoBanco_cliente',
      'pagamentoAgencia_cliente',
      'pagamentoConta_cliente',
      'foneContato_venda_cliente',
      'observacao_venda_cliente',
      'plano_multi_cliente',
      'qtdchip_multi_cliente',
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

      date_default_timezone_set('America/Sao_Paulo');
      $dataDia = date('Y-m-d'); // Resultado: 2009-02-05
      $horaDia = date('H:i:s'); // Resultado: 03:39:57

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

<div class="container">
<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<h4><center><strong style="color: green">Cad. Venda</strong></center></h4>


      <!--*************************************FORM *********************************** -->


      <!-- Step Wizard -->
      <div class="stepwizard">
      <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
      <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
      <p>Dados</p>
      </div>

      <div class="stepwizard-step">
      <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
      <p>Servicos</p>
      </div>

      </div>
      </div>

      <!-- Step Wizard END -->
      <!-- quote form -->

      <div id="main" class="form-horizontal">
      <form action="contratosalvando_cliente.php?id=<?=$id;?>&lista=<?=$lista?>" method="POST">



      <!-- Wizard STEP 1 -->
      <div class="row setup-content" id="step-1">
      <div class="col-sm-12">



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
      <input type="text" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Titular*</label>
      <div class="col-sm-5">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="50" placeholder="Nome Completo" name="nome_cliente" class="form-control input-md" id="nome_cliente" value="<?=$cliente['nome_cliente']?>" autofocus required>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      </div>


      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" class="form-control" maxlength="18" name="cpf_cnpj_cliente" required id="cpfCnpj" value="<?=$cliente['cpf_cnpj_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">RG/IE</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" class="form-control" maxlength="15" name="rg_ie_cliente" id="rgEi" value="<?=$cliente['rg_ie_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">D.Nasc*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="date" class="form-control" name="data_nasc_cliente" id="data_nasc_cliente" value="<?=$cliente['data_nasc_cliente']?>" required>
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
      <input type="text" style="text-transform: uppercase" maxlength="50"  placeholder="Nome da mae" class="form-control" name="nome_mae_cliente" id="nome_mae_cliente" value="<?=$cliente['nome_mae_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>
      </div>





      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Email</label>
      <div class="col-sm-5">
      <div class="input-group">
      <input type="email" placeholder="email@exemplo.com" class="form-control" name="email_cliente" id="email_cliente" value="<?=$cliente['email_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-envelope"></i></span>
      </div>
      </div>

      <label class="col-sm-4 control-label" for="textinput">Origem Venda</label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" name="login_net" class="form-control input-md" value="<?=$cliente['origemCSV']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

      </div>
      </div>
      </div>



            <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Telefone </label>

      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" class="form-control" name="fone_cliente" value="<?=$cliente['fone_cliente']?>" id="campoTelefone">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">Celular</label>

      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" class="form-control" name="celular_cliente" value="<?=$cliente['celular_cliente']?>" id="campoCelular">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
      </div>
      </div>

     <label class="col-sm-1 control-label" for="textinput">Telefone 2</label>

      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" class="form-control" name="fone3_cliente" value="<?=$cliente['fone3_cliente']?>" id="campoTelefone2">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Telefone 3</label>


      <div class="col-sm-2">
      <div class="input-group">
      <input type="text"  class="form-control" name="fone4_cliente" value="<?=$cliente['fone4_cliente']?>" id="campoTelefone3">
       <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>



      </div>






     <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">CEP</label>
      <div class="col-sm-2">
      <div class="input-group">
      <input class="form-control" name="cep_cliente" id="campoCEP" type="text" placeholder="Digite o CEP..." required size="10" maxlength="9" onblur="pesquisacep(this.value);" value="<?=$cliente['cep_cliente']?>">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Endereco</label>
      <div class="col-sm-5">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" placeholder="Endereco completo" class="form-control" name="endereco_cliente" id="endereco_cliente" value="<?=$cliente['endereco_cliente']?>">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
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
          <label class="col-sm-1 control-label" for="textinput">Observação</label>
          <div class="col-sm-11">
              <div class="input-group">
                  <input type="text" style="text-transform: uppercase" maxlength="500" placeholder="Observação sobre o endereço" class="form-control" name="observacao_cliente" id="observacao_cliente" value="<?=$cliente['observacao_cliente']?>">
                  <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
          </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Bairro</label>
      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" class="form-control" name="bairro_cliente" id="bairro_cliente" value="<?=$cliente['bairro_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Cidade*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" class="form-control" required name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Estado*</label>
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="2" class="form-control" required name="estado_cliente" id="estado_cliente" value="<?=$cliente['estado_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      </div>



      <button type="submit" class="btn btn-primary nextBtn col-xs-3 pull-right" >Proximo <i class="fa fa-angle-double-right"></i> </button>
      </div>
      </div>
      <!-- Wizard STEP 1 END -->



          <!-- Wizard STEP 2 -->
          <div class="row setup-content" id="step-2">
              <div class="col-sm-12">

                  <div class="form-group">
                      <label style="display: <?php echo $emp ?>" class="col-md-1 control-label" for="selectbasic">Internet</label>

                      <div class="col-md-5">
                          <select style="display: <?php echo $emp ?>" id="internet_venda_cliente" name="internet_venda_cliente" class="form-control">
                              <option value="">Selecione o plano de internet</option>
                              <option value="100 Mega">100 Mega</option>
                              <option value="200 Mega">200 Mega</option>
                              <option value="300 Mega">300 Mega</option>
                              <option value="600 Mega">600 Mega</option>
                              <option value="Link dedicado 10 MB">Link dedicado 10 MB</option>
                              <option value="Link dedicado 30 MB">Link dedicado 30 MB</option>
                              <option value="Link dedicado 50 MB">Link dedicado 50 MB</option>
                              <option value="Link dedicado 100 MB">Link dedicado 100 MB</option>
                              <option value="Link dedicado 200 MB">Link dedicado 200 MB</option>
                              <option value="Link dedicado 500 MB">Link dedicado 500 MB</option>
                          </select>
                      </div>

                      <label style="display: <?php echo $emp ?>" class="col-md-1 control-label" for="selectbasic">Telefonia</label>
                      <div class="col-md-5">
                          <select style="display: <?php echo $emp ?>" id="netfone_venda_cliente" name="netfone_venda_cliente" class="form-control">
                              <option value="">Selecione o plano de telefone</option>
                              <option value="Fale a Vontade Brasil Fixo e Celular">Fale a Vontade Brasil Fixo e Celular</option>
                          </select>
                      </div>

                  </div>


                  <!-- Select Basic -->
                  <div class="form-group">

                      <label style="display: <?php echo $emp ?>" class="col-sm-1 control-label" for="textinput">Operadora</label>
                      <div class="col-sm-5">
                          <div class="input-group">
                              <input type="text" placeholder="Informe a operadora anterior telefone fixo" maxlength="14" class="form-control" name="portcelular_venda_cliente" id="portcelular_venda_cliente">
                              <span class="input-group-addon label-white"><i class="glyphicon glyphicon-earphone"></i></span>
                          </div>
                      </div>

                      <label style="display: <?php echo $emp ?>" class="col-sm-1 control-label" for="textinput">Port. Fixo</label>
                      <div class="col-sm-5">
                          <div class="input-group">
                              <input style="display: <?php echo $emp ?>" type="tel" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="N. Portabilidade Fixo" maxlength="15" class="form-control" name="portfone_venda_cliente" id="portfone_venda_cliente">
                              <span style="display: <?php echo $emp ?>" class="input-group-addon label-white"><i class="glyphicon glyphicon-earphone"></i></span>
                          </div>
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-1 control-label" for="textinput">Valor</label>
                      <div class="col-sm-2">
                          <div class="input-group">
                              <input type="text" placeholder="Valor do Pacote R$" maxlength="10" class="form-control" name="valor_venda_cliente" id="valor">
                          </div>
                      </div>

                      <label class="col-sm-1 control-label" for="textinput">Pag.*</label>
                      <div class="col-sm-2">
                          <select id="select" required name="formaPagemento_cliente" class="form-control">
                              <option value="">SELECIONE</option>
                              <option value="BOLETO">BOLETO</option>
                              <option value="DCC">DCC</option>
                          </select>
                      </div>

                      <label class="col-sm-1 control-label" for="textinput">Venc.</label>
                      <div class="col-sm-2">
                          <select id="vencimentoPagamento_cliente" name="vencimentoPagamento_cliente" class="form-control">
                              <option value=""></option>
                              <option value="5">5</option>
                              <option value="8">8</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="25">25</option>
                          </select>
                      </div>

                  </div>

                  <div class="form-group">
                      <div id='mestre'>

                          <div id='DCC'>

                              <label style="width: 600px;" class="col-md-3 control-label" for="selectbasic">Banco</label>
                              <input type="text"  class="col-md-1" id="pagamentoBanco_cliente" name="pagamentoBanco_cliente" class="form-control input-md" maxlength="30">

                              <label class="col-md-1 control-label" for="selectbasic">Agencia</label>
                              <input type="text"  class="col-md-1" id="pagamentoAgencia_cliente" name="pagamentoAgencia_cliente" class="form-control input-md" maxlength="10">

                              <label class="col-md-1 control-label" for="selectbasic">Conta</label>
                              <input type="text"  class="col-md-1"  id="pagamentoConta_cliente" name="pagamentoConta_cliente" class="form-control input-md" maxlength="20">
                          </div>


                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-1 control-label" for="textinput">Agregado</label>
                      <div class="col-sm-11">
                          <select id="agregado_venda_cliente" name="agregado_venda_cliente" class="form-control">
                              <option value=""></option>
                              <option value="0800">0800</option>
                              <option value="Número único">Número único</option>
                              <option value="DDG Nacional">DDG Nacional</option>
                              <option value="Voz Total Solução em Nuvem">Voz Total Solução em Nuvem</option>
                              <option value="Gerenciamento de Rede">Gerenciamento de Rede</option>
                              <option value="Gerenciamento de Segurança Firewall">Gerenciamento de Segurança Firewall</option>
                          </select>
                      </div>
                  </div>



      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput"></label>
      <div class="col-sm-11">
      <label for="textinput"> Descricao Promocao / Observacao Venda</label>
      <div class="input-group">
      <?php 
      echo '<textarea rows="4" class="form-control" maxlength="300" style="text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente">' . $cliente['observacao_venda_cliente'] . '</textarea>'
      ?>      
      <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
      </div>
      </div>
      </div>

     <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

      <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

      <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

      <input type="text" style="display: none" name="motivo_cliente" class="form-control input-md" id="motivo_cliente" value="VENDA - NOVO CLIENTE">

      <input type="text" style="display: none" name="statusVenda_venda_cliente" class="form-control input-md" id="statusVenda_venda_cliente" value="ANALISE BACKOFFICE">

      <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="NOVA VENDA">

      <input type="text" style="display: none" name="flag" class="form-control input-md" id="flag" value="1">

      <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

      <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

      <!-- SUBMIT FORM BUTTON-->
      <div class="col-sm-2 pull-right">
      <button type="submit" class="btn btn-block btn-success">Salvar</button>
      </div>



      </div>
      </div>

      </form>
      </div> 
      </div>
      <!-- Wizard STEP 2 END -->

      <!-- Wizard STEP 3 -->


</body>


      <script src="../js/jquery-2.2.3.min.js"></script>
      <script src="../js/scripts-geral.js"></script>
      <script src="../css/bootstrap/js/bootstrap.min.js"></script>
      <script src="../js/jquery.maskedinput.min.js"></script>
      <script src="../js/funcao-maskemoney.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>
</html>


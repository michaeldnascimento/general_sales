<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/visualizarlista.php";


date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57.

if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {
$drop = '';

}else{

$drop = 'none';
}

if ($empresa == 1) {
    $emp1 = '';
    $emp2 = 'none';
}

if ($empresa == 2) {
    $emp1 = 'none';
    $emp2 = '';
}

$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
    $alerta = '';
    $mensagem = $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}else{
    $alerta = 'none';
}

//SELECT INTERNET
$selectInternet = "SELECT id, nome FROM internet WHERE status = 1 ORDER BY nome";
$resultInternet = mysqli_query($linkComMysql, $selectInternet);
$internet = array();

while ($int = mysqli_fetch_assoc($resultInternet)) {
    $internet[] = array(
    'id' 		=> $int['id'],
	'nome'  	=> $int['nome'],
	);
}

//SELECT FONE
$selectFone = "SELECT id, nome FROM telefonia WHERE status = 1 ORDER BY nome";
$resultFone = mysqli_query($linkComMysql, $selectFone);
$fone = array();

while ($phone = mysqli_fetch_assoc($resultFone)) {
    $fone[] = array(
        'id' 		=> $phone['id'],
        'nome'  	=> $phone['nome'],
    );
}

//SELECT AGREGADO
$selectAgregado = "SELECT id, nome FROM agregado WHERE status = 1 ORDER BY nome";
$resultAgregado = mysqli_query($linkComMysql, $selectAgregado);
$agregado = array();

while ($agre = mysqli_fetch_assoc($resultAgregado)) {
    $agregado[] = array(
        'id' 		=> $agre['id'],
        'nome'  	=> $agre['nome'],
    );
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
    <title>Home Sales</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">
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



<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>
    <div class="container">
        <!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
        <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>INFO: </strong><?=$mensagem;?>
        </div>

        <h4><center><strong style="color: green">Cad. Venda</strong></center></h4>
        <!-- Split button -->
        <div class="col-md-10" style="display: <?php echo $obsCad ?>">
            <div class="btn-group">
                <button type="button" class="btn btn-xs btn-success active">NOVA VENDA</button>
                <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <!--<li><a  href="nova-venda-basemulti.php">BASE MULTI</a></li>
                    <li><a  href="nova-venda-basetv.php">BASE TV</a></li>-->
                    <li><a  href="nova_venda.php">COMPLETA</a></li>
                    <!--<li><a  href="nova-venda-rapida.php">PROSPECT RESUMIDA</a></li>-->
                    <li><a  href="nova-venda_simplificada.php">SIMPLIFICADA</a></li>
                </ul>
            </div>

</div>


        <!--*************************************FORM *********************************** -->

        <div class="container">

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
                <form action="nova_venda-salvar.php" method="POST">



                    <!-- Wizard STEP 1 -->
                    <div class="row setup-content" id="step-1">
                        <div class="col-sm-12">



                            <!-- Text input-->
                            <div class="form-group">


                                <label class="col-sm-1 control-label" for="textinput">Responsável</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" name="nome_contato_cliente" maxlength="50"  class="form-control input-md" id="nome_contato_cliente" autofocus>
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">Titular*</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" placeholder="Nome Completo" maxlength="50"  name="nome_cliente" class="form-control input-md" id="nome_cliente" required>
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                    </div>
                                </div>

                            </div>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ*</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="19" name="cpf_cnpj_cliente" required id="cpfCnpj">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">RG/I.E.</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" maxlength="16" name="rg_ie_cliente" id="rgEi">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">Data Nasc*</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="data_nasc_cliente" id="data_nasc_cliente" required>
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                </div>

                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Tipo Pessoa</label>
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
                                            <option value="OUTRO">M</option>
                                        </select>
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                    </div>
                                </div>


                                <label class="col-sm-1 control-label" for="textinput">Mae</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="50"  placeholder="Nome da mae" class="form-control" name="nome_mae_cliente" id="nome_mae_cliente">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                    </div>
                                </div>
                            </div>



                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Email</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="email" placeholder="email@exemplo.com" maxlength="50" class="form-control" name="email_cliente" id="email_cliente">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-envelope"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-4 control-label" for="textinput">Origem Venda</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <select id="origemCSV" name="origemCSV" class="form-control">
                                            <option value="">Selecione Origem</option>
                                            <option value="PROSPECT">PROSPECT</option>
                                            <option value="OPORTUNIDADE">OPORTUNIDADE</option>
                                            <option value="INDICAÇÃO">INDICAÇÃO</option>
                                            <option value="OUTROS">OUTROS</option>
                                        </select>
                                    </div>
                                </div>

                            </div>



                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Telefone </label>

                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="fone_cliente" id="campoTelefone">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    </div>
                                </div>


                                <label class="col-sm-1 control-label" for="textinput">Celular</label>

                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="celular_cliente" id="campoCelular">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">Telefone 2</label>

                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="fone3_cliente" id="campoTelefone2">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">Telefone 3</label>


                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text"  class="form-control" name="fone4_cliente" id="campoTelefone3">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    </div>
                                </div>



                            </div>



                            <br/>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label"><b>CEP*</b></label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input class="form-control" name="cep_cliente" id="campoCEP" type="text" placeholder="Digite o CEP..." required size="10" maxlength="9" onblur="pesquisacep(this.value);">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
                                    </div>
                                </div>


                                <label class="col-sm-1 control-label" for="textinput">Endereço</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="50" placeholder="Endereco completo" class="form-control" name="endereco_cliente" id="endereco_cliente">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
                                    </div>
                                </div>


                                <div class="col-sm-1">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" placeholder="N."  maxlength="10" class="form-control" name="enderecoNumero_cliente" id="enderecoNumero_cliente">

                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="15" placeholder="Complemento" class="form-control" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente">

                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Observação</label>
                                <div class="col-sm-11">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="500" placeholder="Observação sobre o endereço" class="form-control" name="observacao_cliente" id="observacao_cliente">
                                        <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Bairro</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="30" class="form-control" name="bairro_cliente" id="bairro_cliente">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">Cidade*</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="30" class="form-control" required name="cidade_cliente" id="cidade_cliente">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 control-label" for="textinput">Estado*</label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" style="text-transform: uppercase" maxlength="3" class="form-control" required name="estado_cliente" id="estado_cliente">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-primary nextBtn col-xs-3 pull-right" type="submit" >Proximo <i class="fa fa-angle-double-right"></i> </button>
                        </div>
                    </div>
                    <!-- Wizard STEP 1 END -->



                    <!-- Wizard STEP 2 -->
                    <div class="row setup-content" id="step-2">
                    <div class="col-sm-12">

                        <!-- empresa 1 -->
                        <div style="display: <?php echo $emp1 ?>">
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="selectbasic">Internet</label>
                                <div class="col-sm-11">
                                    <select id="internet_venda_cliente" name="internet_venda_cliente" class="form-control">
                                        <option>Selecione o plano de internet</option>
                                        <?php
                                        foreach ($internet as $key => $int){
                                            ?>
                                            <option value="<?= $int['nome'] ?>"><?= $int['nome'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="selectbasic">Telefonia</label>
                                <div class="col-sm-11">
                                    <select id="netfone_venda_cliente" name="netfone_venda_cliente" class="form-control">
                                        <option value="">Selecione o plano de telefone</option>
                                        <?php
                                        foreach ($fone as $key => $phone){
                                            ?>
                                            <option value="<?= $phone['nome'] ?>"><?= $phone['nome'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Agregado</label>
                                <div class="col-sm-11">
                                    <select id="agregado_venda_cliente" name="agregado_venda_cliente" class="form-control">
                                        <option value="">Selecione</option>
                                        <?php
                                        foreach ($agregado as $key => $agre){
                                            ?>
                                            <option value="<?= $agre['nome'] ?>"><?= $agre['nome'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- empresa 1 -->

                        <!-- empresa 2 -->
                        <div style="display: <?php echo $emp2 ?>">
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="selectbasic">Internet</label>
                                <div class="col-sm-11">
                                    <select id="internet_venda_cliente" name="internet_venda_cliente" class="form-control">
                                        <option>Selecione o plano de internet</option>
                                        <?php
                                        foreach ($internet as $key => $int){
                                            ?>
                                            <option value="<?= $int['nome'] ?>"><?= $int['nome'] ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                            <!-- empresa 2 -->

                            <!-- Select Basic -->
                            <div class="form-group">

                                <label style="display: <?php echo $emp ?>" class="col-sm-1 control-label" for="textinput">Operadora</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input type="text" placeholder="Se portabilidade, Informe a operadora do telefone fixo" maxlength="14" class="form-control" name="portcelular_venda_cliente" id="portcelular_venda_cliente">
                                        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-earphone"></i></span>
                                    </div>
                                </div>

                                <label style="display: <?php echo $emp ?>" class="col-sm-1 control-label" for="textinput">Port. Fixo</label>
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <input style="display: <?php echo $emp ?>" type="tel" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="Digite o Número a ser portado" maxlength="15" class="form-control" name="portfone_venda_cliente" id="portfone_venda_cliente">
                                        <span style="display: <?php echo $emp ?>" class="input-group-addon label-white"><i class="glyphicon glyphicon-earphone"></i></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput">Valor Mensal</label>
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
                                        <option value="3">3</option>
                                        <option value="7">7</option>
                                        <option value="11">11</option>
                                        <option value="16">16</option>
                                        <option value="20">20</option>
                                        <option value="24">24</option>
                                        <option value="28">28</option>
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

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="textinput"></label>
                                <div class="col-sm-11">
                                    <label for="textinput"> Descricao Promocao / Observacao Venda</label>
                                    <div class="input-group">
                                        <?php
                                        echo '<textarea rows="4" class="form-control" maxlength="300" style="text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente">' . '</textarea>'
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
    </div>
    </body>
<script src="../js/jquery-2.2.3.min.js"></script>
<script src="../js/scripts-geral.js"></script>
<script src="../css/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/jquery.maskedinput.min.js"></script>
<script src="../js/funcao-maskemoney.js"></script>
<script src="../css/bootstrap/js/meunavbar2.js"></script>
</html>
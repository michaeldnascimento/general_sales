<?php
session_start();

include_once "../login/verifica.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
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
<!--*************************************FORM *********************************** -->

<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<h4><center><strong style="color: green">CAD PESQUISA TAG</strong></center></h4>



<br/>
<br/>


<div id="main" class="form-horizontal">
  <form action="cad-oportunidades-tag-salve.php?lista=TAG" onsubmit="this.enviar.value='Enviando...'; this.enviar.disabled=true;" method="post">

      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">Nome</label>
      <div class="input-group">
      <input type="text" class="form-control" name="nome_contato_cliente" id="nome_contato_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="col-sm-4">
      <label class="control-label" for="textinput">Telefone</label>
      <div class="input-group">
      <input type="text" class="form-control" name="fone_cliente" id="campoTelefone">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <div class="col-sm-4">
      <label class="control-label" for="textinput">Celular</label>
      <div class="input-group">
      <input type="text" class="form-control" name="celular_cliente" id="campoCelular">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="col-sm-2">
      <label class="control-label" for="textinput">Cep</label>
      <div class="input-group">
      <input type="text" class="form-control" name="cep_cliente" id="campoCEP" type="text" placeholder="Digite o CEP..." required size="10" maxlength="9" onblur="pesquisacep(this.value);">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <div class="col-sm-5">
      <label class="control-label" for="textinput">Endereco</label>
      <div class="input-group">
      <input type="text" class="form-control" name="endereco_cliente" id="endereco_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <div class="col-sm-2">
      <label class="control-label" for="textinput">Numero</label>
      <div class="input-group">
      <input type="text" class="form-control" name="enderecoNumero_cliente" id="enderecoNumero_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <div class="col-sm-3">
      <label class="control-label" for="textinput">Complemento</label>
      <div class="input-group">
      <input type="text" class="form-control" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="col-sm-4">
      <label class="control-label" for="textinput">Bairro</label>
      <div class="input-group">
      <input type="text" class="form-control" name="bairro_cliente" id="bairro_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <div class="col-sm-4">
      <label class="control-label" for="textinput">Cidade</label>
      <div class="input-group">
      <input type="text" class="form-control" name="cidade_cliente" id="cidade_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

      <div class="col-sm-2">
      <label class="control-label" for="textinput">UF</label>
      <div class="input-group">
      <input type="text" class="form-control" name="estado_cliente" id="estado_cliente">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>
      </div>

<hr/>
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


      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label">QUAL SUA OPERADORA DE TV ATUALMENTE ?</label>

      <select required id="tv_atual" name="tv_atual" class="form-control">


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
      </div>

      <div class="col-sm-12">
      <label class="control-label" for="textinput">Fidelidade</label>
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_tv" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_tv" id="NAO" value="NAO"> NAO
      </label>
      </div>
      </div>
      </div>




      <div class="form-group">
      <div class="col-sm-12">
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
      </div>


      <div class="col-sm-12">
      <label class="control-label" for="textinput">Fidelidade</label>
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_internet" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_internet" id="NAO" value="NAO"> NAO
      </label>
      </div>
      </div>
      </div>


      <div class="form-group">
      <div class="col-sm-12">
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
      </div>


      <div class="col-sm-12">
      <label class="control-label" for="textinput">Fidelidade</label>
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_telefonia" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_telefonia" id="NAO" value="NAO"> NAO
      </label>
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="col-sm-12">
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
      </div>


      <div class="col-sm-12">
      <label class="control-label" for="textinput">Fidelidade</label>
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="fidelidade_movel" id="SIM" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="fidelidade_movel" id="NAO" value="NAO"> NAO
      </label>
      </div>
      </div>
      </div>


      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">COMO FICOU SABENDO DA TAG ?</label>
      <select id="sabendo_tag" name="sabendo_tag" class="form-control">
      <option value="">SELECIONE</option>
      <option value="SITE"> SITE </option>
      <option value="FACEBOOK"> FACEBOOK </option>
      <option value="AMIGOS"> AMIGOS </option>
      <option value="SMS"> SMS </option>
      <option value="E-MAIL"> E-MAIL </option>
      </select>
      </div>
      </div>

      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">QUAL SEU CUSTO ATUAL COM ESSES SERVICOS ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="custo_atual" id="custo_atual">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-ok"></i></span>
      </div>
      </div>
      </div>




      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">EXISTE ALGUMA OPERADORA QUE NAO DESEJA TRABALHAR ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="saber_tag" id="saber_tag">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-ok"></i></span>
      </div>
      </div>
      </div>



      <div class="form-group">
      <div class="col-sm-12">
      <label class="control-label" for="textinput">COMO FOI A SUA EXPERIENCIA COM SERVICOS TELECOM ?</label>
      <div class="input-group">
      <input type="text" class="form-control" name="experiencia_tag" id="experiencia_tag">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-ok"></i></span>
      </div>
      </div>
      </div>


      <div class="form-group">
      <div class="col-sm-12">
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
      </div>
      </div>




              <!-- Textarea -->
      <div class="form-group">
      <div class="col-sm-12">
        <label for="textinput">OBS</label>
        <div class="input-group">
        <?php 
        echo '<textarea rows="3" readonly maxlength="200" text-transform: uppercase" name="obs_tag" id="obs_tag" class="form-control"> </textarea>';
         ?>
         <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
        </div>
        </div>
      </div>




<br/>
<br/>
<br/>


     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

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
</body>
    <!-- jQuery -->
      <script src="../js/jquery-2.2.3.min.js"></script>
      <script src="../js/scripts-geral.js"></script>
      <script src="../css/bootstrap/js/bootstrap.min.js"></script>
      <script src="../js/jquery.maskedinput.js"></script>
      <script src="../js/funcao-maske.js"></script>
</html>



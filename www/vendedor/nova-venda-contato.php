<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57

//login_verifica pra verificar o login
include_once "../login/verifica.php";
      if($acessoPARCEIROS == 'SIM'){

      ?>
      <script> alert('Usuario sem permissão! '); window.history.go(-1); </SCRIPT>;

     <?php
      } else{


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $mensagem = $_SESSION['mensagem'];
unset($_SESSION['mensagem']);
}


if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
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

	</head>


<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>

<!--*************************************FORM *********************************** -->
<div class="container">
 <h4><center><strong>Novo Contato</strong></center></h4>



        <div class="form-group">
          <label class="col-md-1 control-label" for="button1id"></label>
            <div class="col-md-2">
            <a onclick="javascript:history.back();self.location.reload();" class="btn btn-info">Voltar</a>
          </div>
        </div>


   <div class="row">

        </div>
<br/>
<br/>


<div id="main" class="form-horizontal">
<form action="nova-venda-contato-salvar.php" method="POST">



        <!-- Text input-->
        <div class="form-group">

            <label class="col-sm-2 control-label" for="textinput">Contato</label>
            <div class="col-sm-8">
             <div class="input-group">
             <input type="text" maxlength="50" placeholder="Nome Contato" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" required>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
             </div>

       </div>



      <!-- Text input-->
        <div class="form-group">

        <label class="col-sm-2 control-label" for="textinput">Codigo</label>
            <div class="col-sm-3">
              <div class="input-group">
              <input type="codigo" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="Novo codigo" name="codigo_cliente" class="form-control input-md" required AUTOCOMPLETE="off" autofocus>
              <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
              </div>
            </div>

           <label class="col-sm-1 control-label" for="textinput">Cidade/UF</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" placeholder="Cidade"  maxlength="50" class="form-control" required name="cidade_cliente" id="cidade_cliente">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
            </div>

 
          <div class="col-md-1">
          <select name="estado_cliente" class="form-control" required>
          <option value="">UF</option>
          <option value="AC">AC</option>
          <option value="AL">AL</option>
          <option value="AP">AP</option>
          <option value="AM">AM</option>
          <option value="BA">BA</option>
          <option value="CE">CE</option>
          <option value="DF">DF</option>
          <option value="ES">ES</option>
          <option value="GO">GO</option>
          <option value="MA">MA</option>
          <option value="MT">MT</option>
          <option value="MS">MS</option>
          <option value="MG">MG</option>
          <option value="PA">PA</option>
          <option value="PB">PB</option>
          <option value="PR">PR</option>
          <option value="PE">PE</option>
          <option value="PI">PI</option>
          <option value="RJ">RJ</option>
          <option value="RN">RN</option>
          <option value="RS">RS</option>
          <option value="RO">RO</option>
          <option value="RR">RR</option>
          <option value="SC">SC</option>
          <option value="SP">SP</option>
          <option value="SE">SE</option>
          <option value="TO">TO</option>
          </select>
          </div>


        </div>


      <!-- Text input-->
      <div class="form-group">

      <label  class="col-sm-2 control-label" for="textinput">Telefone</label>


                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="(XX) XXXX-XXXX" maxlength="15" class="form-control" name=" fone_cliente" required id="fone_cliente">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
                  </div>

            <label  class="col-sm-2 control-label" for="textinput">Celular</label>
  

                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="(XX) XXXXX-XXXX" maxlength="15" class="form-control" name=" celular_cliente" id="celular_cliente">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
                  </div>

         </div>

    

 

          <div class="form-group">
          
      <label class="col-md-2 control-label" for="selectbasic">Tabulacao*</label>
      <div class="col-md-5">
      
      <select id="select" required name="motivo_cliente" class="form-control">

          
      <option value=""></option>
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

          <label class="col-sm-1 control-label" for="textinput">Servico</label>
          <div class="col-sm-2">
          <div class="input-group">
          <select id="tipo_servico" required name="tipo_servico" class="form-control">
          <option value=""></option>
          <option value="NET"> NET</option>
          <option value="CLARO"> CLARO </option>
          </select>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          </div>


        <!-- Textarea -->
      <div class="form-group">
      <label  class="col-sm-2 control-label" for="textinput">Produto e promocao</label>
          <div class="col-sm-8">
        <div class="input-group">
        <?php 
        echo '<textarea rows="3" maxlength="200" text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente" class="form-control">' . '</textarea>';
         ?>
         <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
        </div>
        </div>
      </div>

     <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

     <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

     <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

     <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

     <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="NOVOCONTATO">



        <!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-8 control-label" for="button1id"></label>
            <div class="col-md-2">
            <button type="submit" name="form1" class="btn btn-block btn-success active">Salvar</button>
          </div>
        </div>

      <!-- Modal -->



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
<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";

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


if ($nivel == 2 OR $nivel == 3 OR $nivel == 4 ) {

  $drop = '';

}else{

  $drop = 'none';
}
if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
  $id = intval($_GET['id']);
      $lista = strval($_GET['lista']);




    $campos = array(
      'id_cliente', //0
      'nome_contato_cliente',
      'nome_cliente',
      'cpf_cnpj_cliente',
      'codigo_cliente',
      'ddd_fone_cliente',
      'fone_cliente',
      'data_nasc_cliente',
      'celular_cliente',
      'fone3_cliente',
      'fone_gravacao',
      'fone_checklist',
      'cep_cliente',
      'cidade_cliente',
      'estado_cliente',
      'data_followup_cliente',
      'hora_followup_cliente',
      'codigoAntigo_cliente',
      'data_vendaCSV',
      'numero_proposta_cliente',
      'observacao_sistema',
      'observacao_cliente',
      'motivo_cliente',
      'lista_sistema',
      'tipo_servico',
      'plano_multi_cliente',
      'qtdchip_multi_cliente',
      'portcelular_venda_cliente',
      'observacao_venda_cliente'
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

<h4><center><strong style="color: green">BASE MULTI</strong></center></h4>
<br/>
<!-- Split button -->
<div class="col-md-10">
<div class="btn-group">
  <button type="button" class="btn btn-xs btn-success active">NOVA VENDA</button>
  <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="contratogerando_cliente.php?id=<?=$id?>&lista=<?=$lista?>">COMPLETA</a></li>
    <li><a href="venda_simplificada.php?id=<?=$id?>&lista=<?=$lista?>">MULTI</a></li>
    <li><a href="venda_basetv.php?id=<?=$id?>&lista=<?=$lista?>">TV</a></li>
  </ul>  
</div>

</div>
<br/>
<br/>

<div id="main" class="form-horizontal">
<form action="venda_simplificada_salvar.php?id=<?=$id;?>&lista=NOVA&tratar=LEAD" name="form1" method="POST" enctype="multipart/form-data" class="form-horizontal">


        <!-- Text input-->
        <div class="form-group">

            <label class="col-sm-1 control-label" for="textinput">ID</label>
            <div class="col-sm-2">
             <div class="input-group">
             <input type="text" name="id_cliente" class="form-control input-md" value="<?=$cliente['id_cliente']?>" id="id_cliente" disabled>
             </div>
             </div>


            <label class="col-sm-1 control-label" for="textinput">Solicitante</label>
            <div class="col-sm-5">
             <div class="input-group">
             <input type="text" maxlength="50" placeholder="Nome do solicitante" name="nome_contato_cliente" class="form-control input-md" value="<?=$cliente['nome_contato_cliente']?>" id="nome_contato_cliente" required>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
             </div>

            <label class="col-sm-1 control-label" for="textinput">Parentesco</label>
            <div class="col-sm-2">
             <div class="input-group">
             <input type="text" maxlength="20" name="parentesco_cliente" class="form-control input-md" id="parentesco_cliente">
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
             </div>



       </div>

        <div class="form-group">

        <label class="col-sm-1 control-label" for="textinput">Titular</label>
        <div class="col-sm-11">
        <div class="input-group">
        <input type="text" maxlength="50" placeholder="Nome do titular" name="nome_cliente" class="form-control input-md" id="nome_cliente" value="<?=$cliente['nome_cliente']?>" required>
        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
        </div>
        </div>

        </div>

        <div class="form-group">

        <label class="col-sm-1 control-label" for="textinput">CPF/CNPJ</label>
        <div class="col-sm-2">
        <div class="input-group">
        <input type="text" class="form-control" maxlength="19" name="cpf_cnpj_cliente" value="<?=$cliente['cpf_cnpj_cliente']?>" id="cpfCnpj" AUTOCOMPLETE="off">
        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
        </div>
        </div>

        <label class="col-sm-1 control-label" for="textinput">D. Nasc</label>
        <div class="col-sm-2">
        <div class="input-group">
        <input type="date" class="form-control" name="data_nasc_cliente" id="data_nasc_cliente" value="<?=$cliente['data_nasc_cliente']?>" required>
        <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
        </div>
        </div>

        <label class="col-sm-2 control-label" for="textinput">Cidade/UF</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" placeholder="Cidade"  maxlength="50" class="form-control" value="<?=$cliente['cidade_cliente']?>" required name="cidade_cliente" id="cidade_cliente">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
            </div>

 
          <div class="col-md-1">
          <select name="estado_cliente" class="form-control" required>
          <option value="<?=$cliente['estado_cliente']?>"><?=$cliente['estado_cliente']?></option>
          <option value=""></option>
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




        <div class="form-group">





          <label class="col-sm-1 control-label" for="textinput">Servico</label>
          <div class="col-sm-2">
          <div class="input-group">
          <select id="tipo_servico" required name="tipo_servico" class="form-control">
          <option value="<?=$cliente['tipo_servico']?>"><?=$cliente['tipo_servico']?></option>
          <option value=""></option>
          <option value="NET"> NET</option>
          <option value="CLARO"> CLARO </option>
          </select>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Codigo</label>
            <div class="col-sm-3">
              <div class="input-group">
              <input type="codigo" pattern="[0-9]+$" title="Nao sao aceitos (ABC.,/@$+-\*) somente numeros!" placeholder="Novo codigo" name="codigo_cliente"  value="<?=$cliente['codigo_cliente']?>" maxlength="20" class="form-control input-md" required>
              <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
              </div>
            </div>

        <label class="col-md-1 control-label" for="selectbasic">Checklist*</label>
        <div class="col-md-4">
        <select name="statusChecklist" class="form-control" required>
        <option value="">SITUACAO CHECKLIST</option>
        <option></option>
        <option value="CHECKLIST-PENDENTE">CHECKLIST PENDENTE</option>
        <option value="CHECKLIST-CONCLUIDO">CHECKLIST CONCLUIDO</option>
        </select>
        </div>

        </div>




	    <!-- Text input-->


      <div class="form-group">

      <label  class="col-sm-1 control-label" for="textinput">Tel. Gravacao</label>
      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="XXXX-XXXX" maxlength="15" class="form-control" name="fone_gravacao" required id="campoTelefone" value="<?=$cliente['fone_gravacao']?>">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>

      <label  class="col-sm-3 control-label" for="textinput">Tel. Checklist</label>
      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="XXXX-XXXX" maxlength="15" class="form-control" name="fone_checklist" required id="campoCelular" value="<?=$cliente['fone_checklist']?>">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>


      </div>




      <div class="form-group">

      <label class="col-md-1 control-label" for="selectbasic">Plano Multi</label>
      <div class="col-md-4">
      <select id="plano_multi_cliente" value="<?=$cliente['plano_multi_cliente']?>" name="plano_multi_cliente" class="form-control" required>
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

      <label class="col-sm-1 control-label" for="textinput">Qtd Chip</label>
      <div class="col-md-1">
      <select id="qtdchip_multi_cliente" value="<?=$cliente['qtdchip_multi_cliente']?>" name="qtdchip_multi_cliente" class="form-control" required>
      <option value=""></option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>>
      </select>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Port.</label>
      <div class="col-sm-4">
      <div class="input-group">
      <input type="text" placeholder="N. Portabilidade" maxlength="100" class="form-control" name="portcelular_venda_cliente" id="campoTelefone2" value="<?=$cliente['portcelular_venda_cliente']?>">
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-phone"></i></span>
      </div>
      </div>


      </div>

<!--
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar imagem 1:</label>
          <input type="file" id="img_multisales" name="img_multisales" required>
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar imagem 2:</label>
          <input type="file" id="img_multisales2" name="img_multisales2" required>
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar imagem 3:</label>
          <input type="file" id="img_multisales3" name="img_multisales3" required>
          </div>

          </div>


-->




				<!-- Textarea -->
			<div class="form-group">
			<label  class="col-sm-1 control-label" for="textinput">Produto e promocao</label>
		    	<div class="col-sm-11">
				<div class="input-group">
			  <?php 
			  echo '<textarea rows="3" maxlength="200" text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente" class="form-control">' . $cliente['observacao_venda_cliente'] . '</textarea>';
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

     <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="<?=$lista?>">

    <input type="text" style="display: none" name="statusPedido_venda_cliente" class="form-control input-md" id="statusPedido_venda_cliente" value="CADASTRO-CONCLUIDO">



				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-10 control-label" for="button1id"></label>
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
      <script src="../js/jquery.maskedinput.js"></script>
      <script src="../js/funcao-maske.js"></script>
      <script src="../js/jquery.maskedinput.min.js"></script>
      <script src="../js/funcao-maskemoney.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>


</html>


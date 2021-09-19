<?php
session_start();
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

if($nivel == 2 OR $nivel == 3 OR $nivel == 4){

if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
  $id = intval($_GET['id']);

  //conectar e selecionar o banco de dados mysql/agenda
  include_once '../funcoes/conexaoPortari.php';
  include_once '../funcoes/funcoes_geraisPortari.php';


    $campos = array(
      'id_cliente_parceiros', //0
      'nome_contato_parceiros', //1
      'nome_cliente_parceiros',
      'cidade_cliente_parceiros',
      'estado_cliente_parceiros',
      'codigo_claro_cliente_parceiros',
      'ddd_fonevenda_cliente_parceiros',
      'fonevenda_cliente_parceiros',
      'dddfone_cliente_parceiros',
      'fone_cliente_parceiros',
      'obsvenda_cliente_parceiros',
      'nomeUsuarioBack_parceiros',
      'nomeUsuario_parceiros',
      'data_venda_parceiros',
      'hora_venda_parceiros',
      'statusVenda_cliente_parceiros',
      'data_inst_cliente_parceiros',
      'data_agendamento_cliente_parceiros',
      'data_canc_cliente_parceiros',
      'motivoCanc_cliente_parceiros',
      'motivoQuebra_cliente_parceiros',
      'auditoria_bko_parceiros',
      'obs_bko_parceiros',


    );

    $tabelas = array(
      array('parceiros', 'id_cliente_parceiros')

    );
  
  $where = array(
    'id_cliente_parceiros' => $id
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
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">

	</head>


<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>


<!--*************************************FORM *********************************** -->

<br />
 <h4><center><strong>Cliente N. <?=$cliente['id_cliente_parceiros']?></strong></center></h4>
<br />


<div id="main" class="form-horizontal">
<form action="salvando-vendaparceiros.php?id=<?=$id;?>" method="POST" class="form-horizontal">



        <!-- Text input-->
        <div class="form-group">


            <label class="col-sm-3 control-label" for="textinput">Contato</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" name="nome_contato_parceiros" class="form-control input-md" id="nome_contato_parceiros" value="<?=$cliente['nome_contato_parceiros']?>">
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
             </div>


            <label class="col-sm-1 control-label" for="textinput">Cliente</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" name="nome_cliente_parceiros" class="form-control input-md" id="nome_cliente_parceiros" value="<?=$cliente['nome_cliente_parceiros']?>">
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>


       </div>


	    <!-- Text input-->
        <div class="form-group">

           <label class="col-sm-3 control-label" for="textinput">Cidade/ Estado</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" required name="cidade_cliente_parceiros" id="cidade_cliente_parceiros" value="<?=$cliente['cidade_cliente_parceiros']?>">
              </div>
            </div>

 
             <div class="col-sm-1">
               <div class="input-group">
                <input type="text" class="form-control" required name="estado_cliente_parceiros" id="estado_cliente_parceiros" value="<?=$cliente['estado_cliente_parceiros']?>">
              </div>
              </div>

           <label class="col-sm-1 control-label" for="textinput">Codigo</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control" name="codigo_claro_cliente_parceiros" id="codigo_claro_cliente_parceiros" value="<?=$cliente['codigo_claro_cliente_parceiros']?>">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

              </div>
            </div>

        </div>


			<!-- Text input-->
	    <div class="form-group">

			<label  class="col-sm-3 control-label" for="textinput">Tel. Contato</label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="tel" class="form-control" name="ddd_fonevenda_cliente_parceiros" id="ddd_fonevenda_cliente_parceiros" value="<?=$cliente['ddd_fonevenda_cliente_parceiros']?>">
                 </div>
                </div>


                <div class="col-sm-2">
                 <div class="input-group">
                   <input type="tel" class="form-control" name="fonevenda_cliente_parceiros" id="fonevenda_cliente_parceiros" value="<?=$cliente['fonevenda_cliente_parceiros']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
				          </div>

				       <div class="col-sm-1">
                 <div class="input-group">
                  <input type="text" class="form-control" name="dddfone_cliente_parceiros" id="dddfone_cliente_parceiros" value="<?=$cliente['dddfone_cliente_parceiros']?>">
                 </div>
                </div>


                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="tel" class="form-control" name="fone_cliente_parceiros" id="fone_cliente_parceiros" value="<?=$cliente['fone_cliente_parceiros']?>">
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
                 </div>
				        </div>
	       </div>


				<!-- Textarea -->
			<div class="form-group">
			<label  class="col-sm-3 control-label" for="textinput">Observacao</label>
		    	<div class="col-sm-7">
				<div class="input-group">
			  <?php 
			  echo '<textarea rows="2" name="obsvenda_cliente_parceiros" id="obsvenda_cliente_parceiros" class="form-control">' . $cliente['obsvenda_cliente_parceiros'] .  '</textarea>';
			   ?>
			   <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
			  </div>
			  </div>
			</div>

      <div class="form-group">
        <label class="col-sm-3 control-label" for="textinput">Vendedor</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" value="<?=$cliente['nomeUsuario_parceiros']?>" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

              </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Hora/Data</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" value="<?=$cliente['hora_venda_parceiros']?>" readonly>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" class="form-control" value="<?=$cliente['data_venda_parceiros']?>" readonly>
              </div>
            </div>

      </div>

			<input type="text" style="display: none" name="nomeUsuarioBack_parceiros" class="form-control input-md" id="nomeUsuarioBack_parceiros" value="<?=$nomeUsuario?>">


				<hr />
          <h4><center><strong>Backoffice</strong></center></h4>

          <div class="form-group">

          <label  class="col-sm-3 control-label" for="textinput">Backoffice</label>
              <div class="col-sm-3">
                 <div class="input-group">
            <input type="text" class="form-control" value="<?=$cliente['nomeUsuarioBack_parceiros']?>" readonly>
                 </div>
                </div>
         </div>


          <div class="form-group">

          <label class="col-md-3 control-label" for="selectbasic">St. Venda</label>
          <div class="col-md-2">
          
          <select id='select' name="statusVenda_cliente_parceiros" value="<?=$cliente['statusVenda_cliente_parceiros']?>" class="form-control">
          <option value="<?=$cliente['statusVenda_cliente_parceiros']?>"><?=$cliente['statusVenda_cliente_parceiros']?></option>
          <option></option>
          <option value="PENDENTE">PENDENTE</option>
          <option value="AGENDADO">AGENDADO</option>
          <option value="QUEBRA">QUEBRA</option>
          <option value="INSTALADO">INSTALADO</option>
          <option value="CANCELADO">CANCELADO</option>
          </select>
          </div>

          



          
          <div id='mestre'>

          
          <div id='INSTALADO'>

          <label class="col-md-1 control-label" for="selectbasic">Data</label>
          <input type="date"  class="col-md-3" style="height: 30px" id="data_inst_cliente_parceiros" name="data_inst_cliente_parceiros" value="<?=$cliente['data_inst_cliente_parceiros']?>" class="form-control input-md">
          </div>


          <div id='AGENDADO'>

          <label class="col-md-1 control-label" for="selectbasic">Data</label>
          <input type="date" class="col-md-3" style="height: 30px" id="data_agendamento_cliente_parceiros" name="data_agendamento_cliente_parceiros" value="<?=$cliente['data_agendamento_cliente_parceiros']?>" class="form-control input-md">
          </div>
  
          

          <div id='CANCELADO'>
          <label class="col-md-1 control-label" for="selectbasic">Data</label>
          <input type="date" style="width: 150px; height: 30px; type="date" id="data_canc_cliente_parceiros" name="data_canc_cliente_parceiros" value="<?=$cliente['data_canc_cliente_parceiros']?>" class="col-md-2" class="form-control input-md">


          <label class="col-md-1 control-label" for="selectbasic">Motivo</label>
          <select style="width: 180px; height: 30px;" id="motivoCanc_cliente_parceiros" value="<?=$cliente['motivoCanc_cliente_parceiros']?>" name="motivoCanc_cliente_parceiros" class="col-md-3" >
          <option value="">SELECIONE O MOTIVO</option>
          <option value=""></option>
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
          <label class="col-md-1 control-label" for="selectbasic">Motivo</label>
          <input type="text" class="col-md-3" style="height: 30px" id="motivoQuebra_cliente_parceiros" name="motivoQuebra_cliente_parceiros" value="<?=$cliente['motivoQuebra_cliente_parceiros']?>" class="form-control input-md">
          </div>


          </div>
          </div>

          

          <div class="form-group">
          <label class="col-sm-3 control-label" for="textinput">Auditoria</label>
          <div class="col-sm-4">
          <div class="input-group">
          <label class="radio-inline">
          
          <input type="radio" 
          name="auditoria_bko_parceiros" 
          id="auditoria_bko_parceiros" 
          value="APROVADO" 
          <?php echo ($cliente['auditoria_bko_parceiros'] == "APROVADO") ? "checked" : null; ?>/> APROVADO

          </label>
          <label class="radio-inline">

          <input type="radio" 
          name="auditoria_bko_parceiros" 
          id="auditoria_bko_parceiros" 
          value="REPROVADO"
          <?php echo ($cliente['auditoria_bko_parceiros'] == "REPROVADO") ? "checked" : null; ?>/> REPROVADO

          </label>
          </div>
          </div>


          </div>

           <!-- Text input-->
          <div class="form-group">
          <label class="col-sm-3 control-label" for="textinput">Observacao</label>
          <div class="col-sm-7">
          <div class="input-group">
          <?php 
          echo '<textarea rows="2" class="form-control" style="text-transform: uppercase" name="obs_bko_parceiros" id="obs_bko_parceiros">' . $cliente['obs_bko_parceiros'] . '</textarea>'
          ?>      
          <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
          </div>
          </div>
          </div>

          <br>


          <div class="form-group">
          <label class="col-md-8 control-label" for="button1id"></label>
          <div class="col-md-3">
          <a href="listavenda-parceiros.php" class="btn btn-default">Voltar</a>
          <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Salvar</button>
          </div>
          </div>



</form>
</div>
</body>
    <!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>
</html>

<?php }else{?>

   <script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

<?php }?>   
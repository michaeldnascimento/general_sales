<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once '../funcoes/funcoes_geraisPortari.php';
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($acessoPARCEIROS == 'SIM'){

if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
}

?>
  <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php
} else{

if ( isset($_GET['id']) && intval($_GET['id']) > 0 ) {
	$id = intval($_GET['id']);


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
			'motivo_cliente',
			'numero_proposta_cliente',
			'observacao_sistema',
			'observacao_cliente'
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
		<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
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

<br/>

<div class="form-group">

      <div class="col-md-2">
      <a onclick="javascript:history.back();self.location.reload();" class="btn btn-default">Voltar</a>
      </div>
 </div>

<div id="main" class="form-horizontal">


		<!-- Form Name -->
			<br/>


<div class="col-sm-12">


<div id='div' style='display:none'> 
  <div id='img'>
    <div id='print-box'>


    <div id='client-info' style='background: url(../print/<?=$imagemAtual?>) -10px -255px;'>
    </div>

    <div id='client-contact' style='background: url(../print/<?=$imagemAtual?>) -10px -465px;'>
    </div>

    <div id='client-ocorrencia' style='background: url(../print/<?=$imagemAtual?>) -340px -365px;'>
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

</div>
<button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Mostrar Imagem" onClick="ativa()"><span class="glyphicon glyphicon-picture"></span></button>

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
             <input type="text" style=" text-transform: uppercase" maxlength="50" placeholder="Nome do contato" name="nome_contato_cliente" class="form-control input-md" id="nome_contato_cliente" value="<?=$cliente['nome_contato_cliente']?>" readonly>
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
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone_cliente" required id="ddd_fone_cliente" value="<?=$cliente['ddd_fone_cliente']?>" readonly>
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="9" class="form-control" name="fone_cliente" required id="fone_cliente" value="<?=$cliente['fone_cliente']?>" readonly>
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
				      </div>

      <label  class="col-sm-1 control-label" for="textinput">Celular</label>
				 <div class="col-sm-1">
                 <div class="input-group">
                  <input type="text" placeholder="DDD" maxlength="5" class="form-control" name="ddd_celular_cliente" id="ddd_celular_cliente" value="<?=$cliente['ddd_celular_cliente']?>" readonly>
                 </div>
                </div>

                            
          <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text"  placeholder="9xxxx-xxxx" maxlength="11" class="form-control" name="celular_cliente" id="celular_cliente" value="<?=$cliente['celular_cliente']?>" readonly>
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
                  <input type="tel" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone3_cliente" id="ddd_fone3_cliente" value="<?=$cliente['ddd_fone3_cliente']?>" readonly>
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="9" class="form-control" name="fone3_cliente" id="fone3_cliente" value="<?=$cliente['fone3_cliente']?>" readonly>
                   <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                 </div>
				      </div>

      <label  class="col-sm-1 control-label" for="textinput">Celular 2</label>
				 <div class="col-sm-1">
                 <div class="input-group">
                  <input type="text" placeholder="DDD" maxlength="5" class="form-control" name="ddd_fone4_cliente" id="ddd_fone4_cliente" value="<?=$cliente['ddd_fone4_cliente']?>" readonly>
                 </div>
                </div>

                            
                <div class="col-sm-3">
                 <div class="input-group">
                   <input type="text" placeholder="xxxx-xxxx" maxlength="11" class="form-control" name="fone4_cliente" id="fone4_cliente" value="<?=$cliente['fone4_cliente']?>" readonly>
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
      <input type="text" placeholder="N do CEP" maxlength="9" class="form-control" name="cep_cliente" required id="cep_cliente" value="<?=$cliente['cep_cliente']?>" readonly>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Endereco*</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" placeholder="Endereco completo" class="form-control" required name="endereco_cliente" id="endereco_cliente" value="<?=$cliente['endereco_cliente']?>" readonly>
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

     
      <div class="col-sm-1">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="10" placeholder="N" class="form-control" required name="enderecoNumero_cliente" id="enderecoNumero_cliente" value="<?=$cliente['enderecoNumero_cliente']?>" readonly>

      </div>
      </div>

      
      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" maxlength="15" placeholder="Complemento" class="form-control" name="enderecoComplemento_cliente" id="enderecoComplemento_cliente" value="<?=$cliente['enderecoComplemento_cliente']?>" readonly>
     
      </div>
      </div>

      </div>


      <div class="form-group">

      <label class="col-sm-2 control-label" for="textinput">Bairro</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" class="form-control" name="bairro_cliente" id="bairro_cliente" value="<?=$cliente['bairro_cliente']?>" readonly>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
      </div>
      </div>

        <label class="col-sm-1 control-label" for="textinput">Cidade</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" maxlength="20" class="form-control" required name="cidade_cliente" id="cidade_cliente" value="<?=$cliente['cidade_cliente']?>" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
            </div>

 
        <label class="col-sm-1 control-label" for="textinput">Estado</label>
             <div class="col-sm-2">
               <div class="input-group">
                <input type="text" style="text-transform: uppercase" maxlength="3" class="form-control" required name="estado_cliente" id="estado_cliente" value="<?=$cliente['estado_cliente']?>" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-home"></i></span>
              </div>
              </div>
        </div>
  


		  <div class="form-group">

          <label class="col-md-2 control-label" for="selectbasic">Tabulacao</label>
          <div class="col-md-9">
          
        <input type="text" maxlength="20" class="form-control" name="motivo_cliente" id="motivo_cliente" value="<?=$cliente['motivo_cliente']?>" readonly>

          </div>
      </div>

        


      <div class="form-group">


           <label class="col-sm-2 control-label" for="textinput">Codigo Anterior</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" placeholder="Codigo antigo" maxlength="20" class="form-control" name="codigoAntigo_cliente" id="codigo" value="<?=$cliente['codigoAntigo_cliente']?>" readonly>
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>

              </div>
            </div>

            <label class="col-sm-3 control-label" for="textinput">Proposta</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" placeholder="N Proposta" maxlength="20" class="form-control" name="numero_proposta_cliente" id="numero_proposta_cliente" value="<?=$cliente['numero_proposta_cliente']?>" readonly>
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
			  echo '<textarea rows="2" readonly maxlength="200" text-transform: uppercase" name="observacao_cliente" id="observacao_cliente" class="form-control">' . $cliente['observacao_cliente'] . '</textarea>';
			   ?>
			   <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
			  </div>
			  </div>
			</div>

				
				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-2">
						<button class="btn btn-block btn-warning active" data-toggle="modal" data-target="#myModal">Editar</button>
					</div>
				</div>
				

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Atencao!</h4>
			      </div>
			      <div class="modal-body">
			        Deseja editar o cliente ?
			      </div>
			      <div class="modal-footer">
			        <a onclick="javascript:history.back();self.location.reload();" class="btn btn-default">Nao, Voltar</a>
			        <a href="../mailing/tratandoLista_cliente.php?id=<?=$id;?>&lista=NVENDA" class="btn btn-primary">Sim, Continuar</a>
			      </div>
			    </div>
			  </div>
			</div>


</div>
</div>
</body>
		<!-- jQuery -->
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>
    <script src="../js/jquery.maskedinput.js"></script>
    <script src="../js/funcao-maske.js"></script>
</html>

<?php } ?>
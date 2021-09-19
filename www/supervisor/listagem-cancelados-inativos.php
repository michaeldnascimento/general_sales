<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($nivel == 3 OR $nivel == 4){


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];

//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}


/***************Buscar os clientes - paginacao**********************/
if ($_POST['status']  !="") {

  if ($_POST['origem'] !="") {
  $origem = "origemCSV = '{$_POST['origem']}' AND";
  }

  if ($_POST['status'] == "TABULADOS") {
  $status = " motivo_cliente <> '' AND";
  }

  if ($_POST['status'] == "NAO TABULADOS") {
  $status = " motivo_cliente IS NULL AND";
  }





$stringSql = "SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusPedido_venda_cliente, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, origemCSV, status_mailing, flag FROM clientes WHERE lista_sistema = 'CANCELADOS' AND {$origem} {$status} (status_mailing = 'INATIVO') ORDER BY id_cliente DESC";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'                   => $cliente ['id_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'origem'               => $cliente ['origemCSV'],
  'statusCSV'            => $cliente ['status_mailing'],
  'motivo'               => $cliente ['motivo_cliente'],
  'vendedor'             => $cliente ['nomeUsuario'],
  'status'               => $cliente ['statusVenda_venda_cliente'],
  'flag'                 => $cliente ['flag']
  );
    }

}else{

$stringSql = " SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusPedido_venda_cliente, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, origemCSV, status_mailing, flag FROM clientes WHERE lista_sistema = 'CANCELADOS' AND (status_mailing = 'INATIVO') ORDER BY id_cliente DESC ";

//echo $stringSql . "<br><br>";
//exit;

//mando execultar a query no banco de dados
$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
  'id'                   => $cliente ['id_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'origem'               => $cliente ['origemCSV'],
  'statusCSV'            => $cliente ['status_mailing'],
  'motivo'               => $cliente ['motivo_cliente'],
  'status'               => $cliente ['statusVenda_venda_cliente'],
  'vendedor'             => $cliente ['nomeUsuario'],
  'flag'                 => $cliente ['flag']
	);
}
}
//fechamento do banco de dados
mysqli_close($linkComMysql);



?>

<!--*******************INICIO DO CODIGO HTML- INICIO DA PAGINA********************************** -->
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
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



<!--***********************TOPO - BARRA DE PESQUISA********************************** -->


<div id="main" class="container-fluid">
    <div id="top" class="row">
    <div class="col-md-12">

          <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>

             <button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Relatorio por data" onClick="ativa()"><span class="glyphicon glyphicon-list-alt"></span></button>
             </div>
          </div>


</div>
</div> 


<div id='div' style='display:none'> 
<form action="listagem-cancelados-inativos.php" method="post">
    <div class="form-group">
          <label  class="col-sm-6 control-label" for="textinput"></label>
                <div class="col-sm-2">
                 <div class="input-group">
                   <input type="text" placeholder="ORIGEM CSV" class="form-control" name="origem" id="origem">
                 </div>
        </div>

          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-sm-2">
          <select id="status" name="status" class="form-control">
          <option value=""></option>
            <option value="TABULADOS">TABULADOS</option>
            <option value="NAO TABULADOS">NAO TABULADOS</option>
            <option value="TODOS">TODOS</option>
          </select>
          </div>


      <button type="submit" class="btn btn-success active btn-sm pull-right"><span class="glyphicon glyphicon-ok"></span></button>
     </div>
</form>
</div>
<br/>

<h2><center><strong>CANCELADOS</strong> <strong style="color:red">(INATIVO)</strong></center></h2>

<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->

<!--aqui vai aparece os dados do adicionar_contato-->
		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$mensagem;?></h5>
		    	</div>
		    </div>


<!--**********************************LISTAGEM******************************************** -->
<form action="status-listagem-ativo.php" method="POST">

		<div id="list" class="row">

		    <div class="table-responsive col-md-12">

		        <table id="consultas_general" class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
                     <th>ID</th>
                     <th>ORIGEM</th>
                     <th>STATUS MAILING</th>
                     <th>TABULACAO</th>
                     <th>VENDEDOR</th>
                     <th>STATUS VENDA</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {


					if ($cliente['flag'] == 0){
					$style = 'font-weight:bold';

				    }

					if ($cliente['flag'] == 1){
					$style = '';

					}

					if ($cliente['flag'] == ''){
					$style = 'font-weight:bold';

					}



			?>

				 	<tr>
                        <td style="<?=$style?>"> <?=$cliente['id'];?></td>
                        <td style="<?=$style?>"> <?=$cliente['origem'];?></td>
                        <td style="<?=$style?>"> <?=$cliente['statusCSV'];?></td>
                        <td style="<?=$style?>"> <?=$cliente['motivo'];?></td>
                        <td style="<?=$style?>"> <?=$cliente['vendedor'];?></td>
                        <td style="<?=$style?>"> <?=$cliente['status'];?></td>
		                    <td class="actions">
		                    <input type="checkbox" title="Selecionar para alterar" name="excluir[]" value="<?=$cliente['id'];?>" />
		                    </td>
		        	</tr>


			<?php

				 }

			 ?>



<!--*****************************FIM DE CADA CONTATOS**************************** -->
		            </tbody>
		         </table>

            </div>
		</div> <!-- /#list -->



<!--*****************QUANTIDA DE COSTATOS DA PAGINA*************************** -->


		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao">Quantidade de Registros <?=$qtdClientes;?></h5>
		    	</div>
		    </div>



		    	<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-2">
						 <input type="submit" class="btn btn-success"  name="submit" value="Ativar Selecionados"/>
						 <input id="acao" type="checkbox" title="Selecionar Todos" name="excluir[]" onclick="marcarTodos(this.checked);">
						</div>
				</div>
				<br />
				<br />


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
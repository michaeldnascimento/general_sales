<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($acessoPARCEIROS == 'SIM' OR $acessoTODOS == 'SIM'){


if ($acessoPARCEIROS == 'SIM') {

  $drop = 'none';

}else{

  $drop = '';
}


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];
unset($_SESSION['mensagem']);
}


$dadoProcurado = ( isset($_POST['data']['search']) ) ? trim($_POST['data']['search']) : "" ;





/******************************Buscar os clientes - paginacao**************************/
if ($_POST['data1'] !="" OR $_POST['data2'] !="") {

	if ($_POST['statusVenda'] =="") {
		$status = " motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI'";

		$data = "data_venda";
	}else{
		$status = " statusVenda_venda_cliente = '{$_POST['statusVenda']}'";

		if ($_POST['statusVenda'] == "INSTALADO") {
			$data = "data_inst_venda_cliente";
		}

		if ($_POST['statusVenda'] == "CANCELADO") {
			$data = "data_canc_venda_cliente";
		}

		if ($_POST['statusVenda'] == "AGENDADO") {
			$data = "data_agendamento_venda_cliente";
		}

		if ($_POST['statusVenda'] == "PENDENTE" OR $_POST['statusVenda'] == "QUEBRA") {
			$data = "data_venda";
		}

	}



$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, nomeUsuarioBack, auditoria_back FROM clientes WHERE  (nomeUsuario = '{$nomeUsuario}' AND motivo_cliente = 'VENDA - NOVO CLIENTE') AND ({$status}) AND ({$data} BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}') ORDER BY SUBSTR( data_venda, 7, 4), SUBSTR( data_venda, 4, 2), SUBSTR( data_venda, 1, 2)
	";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


  while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		   => $cliente ['id_cliente'],
	'nome_cliente'  	   => $cliente ['nome_cliente'],
	'codigo_claro_cliente' => $cliente ['codigo_cliente'],
	'localizacao_cliente'  => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'dataVenda'  		   => $cliente ['data_venda'],
    'nomeBack_parceiros'   => $cliente ['nomeUsuarioBack'],
    'statusAuditacao_parceiros'  => $cliente ['auditoria_back'],
    'statusVenda_parceiros' => $cliente ['statusVenda_venda_cliente'],
	);
    }

}else{

$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, nomeUsuarioBack, auditoria_back FROM clientes WHERE nomeUsuario = '{$nomeUsuario}' AND (motivo_cliente = 'VENDA - NOVO CLIENTE') AND ((MONTH(data_venda)) = MONTH(NOW()) OR (MONTH(data_inst_venda_cliente)) = MONTH(NOW())) ORDER BY SUBSTR( data_venda, 7, 4), SUBSTR( data_venda, 4, 2), SUBSTR( data_venda, 1, 2)";

//echo $stringSql;
//exit;


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		   => $cliente ['id_cliente'],
	'nome_cliente'  	   => $cliente ['nome_cliente'],
	'codigo_claro_cliente' => $cliente ['codigo_cliente'],
	'localizacao_cliente'  => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'dataVenda'  		   => $cliente ['data_venda'],
    'nomeBack_parceiros'   => $cliente ['nomeUsuarioBack'],
    'statusAuditacao_parceiros'  => $cliente ['auditoria_back'],
    'statusVenda_parceiros' => $cliente ['statusVenda_venda_cliente'],
	);
}
}
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
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">

    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">

	</head>
	<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>



<!--***********************TOPO - BARRA DE PESQUISA********************************** -->

<div id="main" class="container-fluid">
<br />

	    <div class="form-group">
            <div class="col-md-12">
             <button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Relatorio por data" onClick="ativa()"><span class="glyphicon glyphicon-calendar"></span></button>

             </div>
        </div>
<br/>
<div id='div' style='display:none'> 
<form action="minhas-vendas.php" method="post">
	  <div class="form-group">

	  		 <label class="col-sm-5 control-label" for="textinput"></label>
		      <div class="col-sm-2">
		      <select id="statusVenda" name="statusVenda" class="form-control">
		      <option value=""></option>
	          <option value="PENDENTE">PENDENTE</option>
	          <option value="AGENDADO">AGENDADO</option>
	          <option value="QUEBRA">QUEBRA</option>
	          <option value="INSTALADO">INSTALADO</option>
	          <option value="CANCELADO">CANCELADO</option>
		      </select>
		      </div>


	  			<label  class="col-sm-1 control-label" for="textinput"></label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="date" class="form-control" name="data1" id="data1">
                 </div>
                </div>


      			<label  class="col-sm-1 control-label" for="textinput"></label>
                <div class="col-sm-1">
                 <div class="input-group">
                   <input type="date" class="form-control" name="data2" id="data2"s>
                 </div>
				</div>
			<button type="submit" class="btn btn-success active btn-sm pull-right"><span class="glyphicon glyphicon-ok"></span></button>
	   </div>
</form>
</div>


          <div class="page-header">
          <h2>Minhas Vendas</h2>
          </div>

<br />

<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->

<!--aqui vai aparece os dados do adicionar_contato-->
		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$mensagem;?></h5>
		    	</div>
		    </div>


<!--**********************************LISTAGEM******************************************** -->
		
		<div id="list" class="row">
		 
		    <div class="table-responsive col-md-12">
		     
		  <table id="consultas_general" class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
      <thead>
		                <tr>
		                 
		                 <th>ID</th>
						 <th>NOME</th>
						 <th>CODIGO</th>
		                 <th>CIDADE/ESTADO</th>
		                 <th>DATA VENDA</th>
		                 <th>BACKOFFICE</th>
		                 <th>STATUS AUDITORIA</th>
		                 <th>STATUS VENDA</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                 
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php 


			foreach ($clientes as $key => $cliente) {

		$cliente['nome_cliente'] = substr_replace($cliente['nome_cliente'], (strlen($cliente['nome_cliente']) > 20 ? '...' : ''), 20);
			?>	 

				 	<tr>

		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['nome_cliente'];?></td>
		                    <td><?=$cliente['codigo_claro_cliente'];?></td>
		                    <td><?=$cliente['localizacao_cliente'];?></td>
		                    <td><?=$cliente['dataVenda'];?></td>
		                    <td><?=$cliente['nomeBack_parceiros'];?></td>
		                    <td><?=$cliente['statusAuditacao_parceiros'];?></td>
		                    <td><?=$cliente['statusVenda_parceiros'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" title="Consultar Venda" href="consulta-cliente.php?id=<?=$cliente['id'];?>"><span class="glyphicon glyphicon-plus"></span></a>
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
		     




		</div> 
 	
	</body>
		<!-- jQuery -->
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

    <script src="../media/js/jquery.dataTables.min.js"></script>
    <script src="../media/js/dataTables.bootstrap.min.js"></script>
    <script src="../media/js/tablesgeneral.js"></script>

</html>

	<?php }else{?>

		<script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

	<?php }?>
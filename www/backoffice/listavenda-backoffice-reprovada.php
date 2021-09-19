<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($nivel == 2 OR $nivel == 3 OR $nivel == 4){



$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];


unset($_SESSION['mensagem']);
}



/******************************Buscar os clientes - paginacao**************************/
if ($_POST['data1'] !="" OR $_POST['data2'] !="") {

	if ($_POST['vendedor'] !="") {
		$vendedor = "AND nomeUsuario = '{$_POST['vendedor']}'";
	}


$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, tipo_servico FROM clientes WHERE statusVenda_venda_cliente = 'INSTALADO' {$vendedor} AND data_inst_venda_cliente BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}' ORDER BY SUBSTR( data_inst_venda_cliente, 7, 4), SUBSTR( data_inst_venda_cliente, 4, 2), SUBSTR( data_inst_venda_cliente, 1, 2) desc
	";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


    while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
		'id' 		  		            => $cliente ['id_cliente'],
		'nome_cliente'  	        => $cliente ['nome_cliente'],
		'codigo_assinante'	      => $cliente ['codigo_cliente'],
		'localizacao_assinante'   => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
		'nomeUsuario_assinante'  	=> $cliente ['nomeUsuario'],
		'dataVenda'	              => $cliente ['data_venda'],
		'nomeBack'				        => $cliente ['nomeUsuarioBack'],
		'tiposervico'	            => $cliente ['tipo_servico'],
		'statusVenda_assinante'	  => $cliente ['statusVenda_venda_cliente'],
		'datainstalacao'	        => $cliente ['data_inst_venda_cliente'],
	);
    }

}else{

$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, tipo_servico FROM clientes WHERE statusVenda_venda_cliente = 'REPROVADO' AND (MONTH(data_inst_venda_cliente)) = MONTH(NOW()) AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) ORDER BY data_inst_venda_cliente desc
	";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


	while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		          => $cliente ['id_cliente'],
	'nome_cliente'  	      => $cliente ['nome_cliente'],
	'codigo_assinante'	    => $cliente ['codigo_cliente'],
	'localizacao_assinante' => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'nomeUsuario_assinante'	=> $cliente ['nomeUsuario'],
	'dataVenda'	            => $cliente ['data_venda'],
	'nomeBack'				      => $cliente ['nomeUsuarioBack'],
	'tiposervico'	            => $cliente ['tipo_servico'],
	'statusVenda_assinante'	=> $cliente ['statusVenda_venda_cliente'],
	'datainstalacao'	      => $cliente ['data_inst_venda_cliente'],
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
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">

</head>
<body>



<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>




<!--***********************TOPO - BARRA DE PESQUISA********************************** -->



	<div id="ReloadThis">	
	   <div id="main" class="container-fluid">


	    <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>

             <button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Relatorio por data" onClick="ativa()"><span class="glyphicon glyphicon-calendar"></span></button>


        </div>

<div id='div' style='display:none'> 
<form action="listavenda-backoffice-reprovada.php" method="post">
	  <div class="form-group">
	  			<label  class="col-sm-5 control-label" for="textinput"></label>
                <div class="col-sm-2">
                 <div class="input-group">
                   <input type="text" placeholder="Nome Vendedor" class="form-control" name="vendedor" id="vendedor"s>
                 </div>
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
  				<h2>Backoffice Vendas Reprovadas</h2>
				  </div>

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
						<th>VENDEDOR</th>
						<th>DATA VENDA</th>
						<th>BACKOFFICE</th>
						<th>STATUS VENDA</th>
						<th>SERVICO</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>

	

<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {


					
			?>	 

				 	<tr>	
				 			
		                    <td style="<?=$style?>"><?=$cliente['id'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nome_cliente'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['codigo_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['localizacao_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nomeUsuario_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['dataVenda'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nomeBack'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['statusVenda_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['tiposervico'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" href="consultar-vendabackoffice.php?id=<?=$cliente['id'];?>&lista=REPROVADO"><span class="glyphicon glyphicon-pencil"></span></a>
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



		</div>  
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

	<script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php }?>

<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";



$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}




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
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, lista_sistema FROM clientes WHERE nomeUsuario = '{$nomeUsuario}' AND ({$status}) AND ({$data} BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}') ORDER BY data_venda";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


    while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		      => $cliente ['id_cliente'],
	'nome_cliente'  	  	  => $cliente ['nome_cliente'],
	'codigo_assinante'	      => $cliente ['codigo_cliente'],
	'localizacao_assinante'   => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
  'lista_sistema'		      => $cliente ['lista_sistema'],
  'dataVenda'  			  => $cliente ['data_venda'],
  'statusPedido_assinante'  => $cliente ['statusPedido_venda_cliente'],
  'statusVenda_assinante'   => $cliente ['statusVenda_venda_cliente'],
	);
    }

}else{

$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, lista_sistema FROM clientes WHERE nomeUsuario = '{$nomeUsuario}' AND (motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI' OR motivo_cliente = 'VENDA - BASE TV') AND ((MONTH(data_venda)) = MONTH(NOW()) OR (MONTH(data_inst_venda_cliente)) = MONTH(NOW())) ORDER BY data_venda desc";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		      => $cliente ['id_cliente'],
	'nome_cliente'  	  	  => $cliente ['nome_cliente'],
	'codigo_assinante'	      => $cliente ['codigo_cliente'],
	'localizacao_assinante'   => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
    'lista_sistema'		      => $cliente ['lista_sistema'],
    'dataVenda'  			  => $cliente ['data_venda'],
    'statusPedido_assinante'  => $cliente ['statusPedido_venda_cliente'],
    'statusVenda_assinante'   => $cliente ['statusVenda_venda_cliente'],
	);
}
}
mysqli_close($linkComMysql);

?>

<!--*******************INICIO DO CODIGO HTML- INICIO DA PAGINA********************************** -->


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="icon" href="../css/imagens/16x16.png">
		<title>Home Sales</title>


		<!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">

	</head>
	<body>


<?php
include_once "../css/navbar/meunavbar.php";
?>


<!--***********************TOPO - BARRA DE PESQUISA********************************** -->


	<div id="main" class="container-fluid">
    
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

      <div class="form-group">
            <div class="col-md-12">
            <button type="button" class="btn btn-default active btn-xs pull-right" title="Pesquisa avancada" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-calendar"></span></button>
             </div>
      </div>
<br/>
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>PESQUISAR</strong></h4>
      </div>
      <div class="modal-body">
<div class="container">



         <!-- Text input-->
<form action="minhas-vendasLista.php" method="post">

          <label class="col-sm-1 control-label" for="textinput">D.Incio</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" name="data1"  id="data1" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

<br>
<br>
<br>

          <label class="col-sm-1 control-label" for="textinput">D.Fim</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" name="data2"  id="data2" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

<br>
<br>
<br>

          <label class="col-sm-1 control-label" for="textinput">Status</label>
                <div class="col-sm-2">
                <select id="statusVenda" name="statusVenda" class="form-control">
                    <option value="">TODOS</option>
                    <option value="ANALISE BACKOFFICE">ANALISE BACKOFFICE</option>
                    <option value="APROVADA">APROVADA</option>
                    <option value="CANCELADA">CANCELADA</option>
                    <option value="PENDENTE">PENDENTE</option>
                    <option value="REPROVADA">REPROVADA</option>
                </select>
                </div>

<br>
<br>
<br>



          <div class="form-group">
          <label class="col-md-1 control-label" for="button1id"></label>
          <div class="col-md-2">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Pesquisar</button>
          </div>
          </div>

</form>
</div>



      </div>
    </div>
  </div>
</div>

<div id='div2' style='display:none'> 
    <div class="form-group ">
        <form action="minhas-vendasLista.php" method="post"> 
        <div class="col-md-3 pull-right">
              <div class="input-group h2">
                  <input name="data[search]" class="form-control" id="search" type="text" placeholder="Pesquisar">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
              </div>
        </div>
    </form>
    </div>
</div>


		 	    <div class="page-header">
  				<h2>PROPOSTAS</h2>
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
		                 <th>LEAD</th>
		                 <th>DATA VENDA</th>
		                 <th>STATUS PEDIDO</th>
		                 <th>STATUS VENDA</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {

			$cliente['nome_cliente'] = substr_replace($cliente['nome_cliente'], (strlen($cliente['nome_cliente']) > 20 ? '...' : ''), 20);

			if ($empresa == '003') {
			$vervenda = 'consultar-vendasimples.php';
			}else{
			$vervenda = 'consultar-minhavenda.php';
			}

					
			?>	 

				 	<tr>	
				 			
		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['nome_cliente'];?></td>
		                    <td><?=$cliente['codigo_assinante'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
		                    <td><?=$cliente['lista_sistema'];?></td>
		                    <td><?=$cliente['dataVenda'];?></td>
		                    <td><?=$cliente['statusPedido_assinante'];?></td>
		                    <td><?=$cliente['statusVenda_assinante'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" title="Consultar Venda" href="<?=$vervenda;?>?id=<?=$cliente['id'];?>&lista=VCONCLUIDA"><span class="glyphicon glyphicon-plus"></span></a>
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

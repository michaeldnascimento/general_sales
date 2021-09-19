<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($acessoPARCEIROS == 'SIM'){


?>
  <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

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
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, motivoPendencia_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, lista_sistema FROM clientes WHERE (nomeUsuario = '{$nomeUsuario}') AND (statusPedido_venda_cliente = 'CADASTRO-PENDENTE' OR statusPedido_venda_cliente IS NULL) AND ({$status}) AND ({$data} BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}') ORDER BY SUBSTR( data_venda, 7, 4), SUBSTR( data_venda, 4, 2), SUBSTR( data_venda, 1, 2)
	";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


    while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	  'id' 		  		            => $cliente ['id_cliente'],
	  'nome_cliente'  	  	    => $cliente ['nome_cliente'],
	  'codigo_assinante'	      => $cliente ['codigo_cliente'],
	  'localizacao_assinante'   => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
    'lista_sistema'		        => $cliente ['lista_sistema'],
    'dataVenda'  			        => $cliente ['data_venda'],
    'statusPedido_assinante'  => $cliente ['statusPedido_venda_cliente'],
    'motivoPendencia'         => $cliente ['motivoPendencia_venda_cliente'],
    'statusVenda_assinante'   => $cliente ['statusVenda_venda_cliente'],
	);
    }

}else{

$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, motivoPendencia_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, lista_sistema FROM clientes WHERE (nomeUsuario = '{$nomeUsuario}') AND (statusPedido_venda_cliente = 'CADASTRO-PENDENTE' OR statusPedido_venda_cliente IS NULL) AND (motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI' OR motivo_cliente = 'VENDA - BASE TV') AND ((MONTH(data_venda)) = MONTH(NOW()) OR (MONTH(data_inst_venda_cliente)) = MONTH(NOW())) ORDER BY data_venda desc";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
    'id'                      => $cliente ['id_cliente'],
    'nome_cliente'            => $cliente ['nome_cliente'],
    'codigo_assinante'        => $cliente ['codigo_cliente'],
    'localizacao_assinante'   => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
    'lista_sistema'           => $cliente ['lista_sistema'],
    'dataVenda'               => $cliente ['data_venda'],
    'statusPedido_assinante'  => $cliente ['statusPedido_venda_cliente'],
    'motivoPendencia'         => $cliente ['motivoPendencia_venda_cliente'],
    'statusVenda_assinante'   => $cliente ['statusVenda_venda_cliente'],
	);
}
} if (strlen($dadoProcurado) > 0 ) {

    $stringSql = "
  SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, statusPedido_venda_cliente, motivoPendencia_venda_cliente, statusVenda_venda_cliente, date_format(data_venda,'%d/%m/%Y')as data_venda, data_inst_venda_cliente, lista_sistema FROM clientes WHERE (nomeUsuario = '{$nomeUsuario}') AND (statusPedido_venda_cliente = 'CADASTRO-PENDENTE' OR statusPedido_venda_cliente IS NULL) AND (motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI') AND (id_cliente like '%{$dadoProcurado}%' OR nome_cliente like '%{$dadoProcurado}%' OR codigo_cliente like '%{$dadoProcurado}%' OR nomeUsuario like '%{$dadoProcurado}%' OR cidade_cliente like '%{$dadoProcurado}%' OR estado_cliente like '%{$dadoProcurado}%') ORDER BY SUBSTR( data_venda, 7, 4), SUBSTR( data_venda, 4, 2), SUBSTR( data_venda, 1, 2)";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


    while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
    'id'                      => $cliente ['id_cliente'],
    'nome_cliente'            => $cliente ['nome_cliente'],
    'codigo_assinante'        => $cliente ['codigo_cliente'],
    'localizacao_assinante'   => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
    'lista_sistema'           => $cliente ['lista_sistema'],
    'dataVenda'               => $cliente ['data_venda'],
    'statusPedido_assinante'  => $cliente ['statusPedido_venda_cliente'],
    'motivoPendencia'         => $cliente ['motivoPendencia_venda_cliente'],
    'statusVenda_assinante'   => $cliente ['statusVenda_venda_cliente'],
  );
    }

}
mysqli_close($linkComMysql);

?>

<!--*******************INICIO DO CODIGO HTML- INICIO DA PAGINA********************************** -->


<!DOCTYPE html>
<html lang="pt-br">
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
    <title>General Sales</title>


    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">
    <link rel="stylesheet" href="../media/css/dataTables.bootstrap.min.css">
	<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->

<?php
include_once "../css/navbar/meunavbar.php";
?>



<!--***********************TOPO - BARRA DE PESQUISA********************************** -->


	        <div id="main" class="container-fluid">


	    <div class="form-group">
            <div class="col-md-12">
             <button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Relatorio por data" onClick="ativa()"><span class="glyphicon glyphicon-calendar"></span></button>

             <button type="button" id="botao2" class="btn btn-default active btn-xs pull-right" title="Pesquisar" onClick="ativa2()"><span class="glyphicon glyphicon-search"></span></button>
             </div>
        </div>
<br/>
<div id='div' style='display:none'> 
<form action="minhas-vendasPendentes.php" method="post">
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

<div id='div2' style='display:none'> 
    <div class="form-group ">
        <form action="minhas-vendasPendentes.php" method="post"> 
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
  				<h2>Vendas Pendentes</h2>
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
		                 <th>LEAD</th>
		                 <th>DATA VENDA</th>
		                 <th>STATUS PEDIDO</th>
                     <th>PENDENCIA</th>
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
		                    <td><?=$cliente['codigo_assinante'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
		                    <td><?=$cliente['lista_sistema'];?></td>
		                    <td><?=$cliente['dataVenda'];?></td>
		                    <td><?=$cliente['statusPedido_assinante'];?></td>
                        <td><?=$cliente['motivoPendencia'];?></td>
		                    <td><?=$cliente['statusVenda_assinante'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" title="Consultar Venda" href="consultar-minhavenda.php?id=<?=$cliente['id'];?>&lista=VPENDENTE"><span class="glyphicon glyphicon-plus"></span></a>
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



		</div>

	</body>
		<!-- jQuery -->
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>

    <script src="../media/js/jquery.dataTables.min.js"></script>
    <script src="../media/js/dataTables.bootstrap.min.js"></script>
    <script src="../media/js/tablesgeneral.js"></script>
        <script src="../css/bootstrap/js/meunavbar2.js"></script>

</html>

<?php } ?>
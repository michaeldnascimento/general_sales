<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";


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


/******************************Buscar os clientes - paginacao**************************/


$stringSql = "
	SELECT id_cliente, nome_contato_cliente, cidade_cliente, estado_cliente, motivo_cliente, ddd_fone_cliente, fone_cliente, lista_sistema, date_format(datahora_cad_cliente,'%d/%m/%y %T')as datahora_cad_cliente FROM clientes WHERE (nomeUsuario = '{$nomeUsuario}' AND (DAY(data_venda) = DAY(NOW()))) AND (MONTH(data_venda) = MONTH(NOW())) AND (motivo_cliente = 'NAO VENDA - TELEFONE NAO ATENDE' OR motivo_cliente = 'LIXEIRA - NAO TEM INTERESSE EM NOVA ASSINATURA' OR motivo_cliente = 'LIXEIRA - PROBLEMAS TECNICOS' OR motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA VIRTUA' OR motivo_cliente = 'LIXEIRA - NAO TEM COBERTURA TV' OR motivo_cliente = 'LIXEIRA - CLIENTE REPETIDO' OR motivo_cliente = 'LIXEIRA - CLIENTE JA CONTRATOU O SERVICO' OR motivo_cliente = 'LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR' OR motivo_cliente = 'LIXEIRA - OUTROS - ESPECIFICAR')
		
		ORDER BY id_cliente DESC
	";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		         => $cliente ['id_cliente'],
	'nome_cliente'  	     => $cliente ['nome_contato_cliente'],
	'localizacao_assinante'=> $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'motivo_assinante'     => $cliente ['motivo_cliente'],
  'fone_assinante'       => "(" .$cliente ['ddd_fone_cliente'] .") ". $cliente ['fone_cliente'],
  'lista_sistema'		     => $cliente ['lista_sistema'],
  'datahora_cadastro'    => $cliente ['datahora_cad_cliente']
	);
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


	        <div id="main" class="container-fluid">



		 	    <div class="page-header">
  				<h2>Lixeira</h2>
				 </div>


<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->


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
						         <th>NOME CONTATO</th>
		                 <th>CIDADE/ESTADO</th>
		                 <th>MOTIVO</th>
		                 <th>LEAD</th>
		                 <th>FONE</th>
		                 <th>DATA/HORA</th>
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
		                    <td><?=$cliente['localizacao_assinante'];?></td>
		                    <td><?=$cliente['motivo_assinante'];?></td>
		                    <td><?=$cliente['lista_sistema'];?></td>
		                    <td><?=$cliente['fone_assinante'];?></td>
		                    <td><?=$cliente['datahora_cadastro'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" title="Consultar" href="consultar-naoVendas.php?id=<?=$cliente['id'];?>"><span class="glyphicon glyphicon-plus"></span></a>
		                    </td>
		        	</tr>


			<?php
				}

			 ?>



<!--*****************************FIM DE CADA CONTATOS**************************** -->

		            </tbody>
		         </table>

		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao">Quantidade de Registros <?=$qtdClientes;?></h5>
		    	</div>
		    </div>

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

<?php } ?>
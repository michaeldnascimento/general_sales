<?php
session_start();

//login_verifica pra verificar o login
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





$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, origemCSV, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusPedido_venda_cliente, statusChecklist, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, tipo_servico, flag FROM clientes WHERE (lista_sistema = 'PARCEIROSCSV' AND statusVenda_venda_cliente IS NULL)  ORDER BY data_venda desc
	";

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		    => $cliente ['id_cliente'],
	'nome_cliente'  	    => $cliente ['nome_cliente'],
	'codigo_assinante'	    => $cliente ['codigo_cliente'],
	'localizacao_assinante' => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'nomeUsuario_assinante'	=> $cliente ['nomeUsuario'],
	'dataVenda'	            => $cliente ['data_venda'],
	'tiposervico'	            => $cliente ['tipo_servico'],
	'nomeBack'				=> $cliente ['nomeUsuarioBack'],
	'origem'             => $cliente ['origemCSV'],
	'statusVenda_assinante'	=> $cliente ['statusVenda_venda_cliente'],
	'flag'                  => $cliente ['flag']
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
            <a type="button" href="csvparceiros.php?lista=CSVPARCEIROS" class="btn btn-success active btn-xs pull-right" title="Importa CSV"><span class="glyphicon glyphicon-plus"></span></a>

            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>


             </div>
        </div>



		 	    <div class="page-header">
  				<h2>Backoffice Parceiros CSV</h2>
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
							<th>SERVICO</th>
							<th>ORIGEM</th>
							<th>BACKOFFICE</th>
							<th>STATUS VENDA</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>

	

<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {

				if ($cliente['flag'] == 1){
					$style = 'font-weight:bold';

				    }

					if ($cliente['flag'] == 2){
					$style = '';

					}

					if ($cliente['flag'] == ''){
					$style = 'font-weight:bold';

					}


			?>

				<tr>

          <td style="<?=$style?>"><?=$cliente['id'];?></td>
          <td style="<?=$style?>"><?=$cliente['nome_cliente'];?></td>
          <td style="<?=$style?>"><?=$cliente['codigo_assinante'];?></td>
          <td style="<?=$style?>"><?=$cliente['localizacao_assinante'];?></td>
          <td style="<?=$style?>"><?=$cliente['nomeUsuario_assinante'];?></td>
          <td style="<?=$style?>"><?=$cliente['dataVenda'];?></td>
          <td style="<?=$style?>"><?=$cliente['tiposervico'];?></td>
          <td style="<?=$style?>"><?=$cliente['origem'];?></td>
          <td style="<?=$style?>"><?=$cliente['nomeBack'];?></td>
          <td style="<?=$style?>"><?=$cliente['statusVenda_assinante'];?></td>
          <td class="actions">

		  <a class="btn btn-success btn-xs" href="consultar-vendabackoffice.php?id=<?=$cliente['id'];?>&lista=PARCEIROSCSV"><span class="glyphicon glyphicon-pencil"></span></a>

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

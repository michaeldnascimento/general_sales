<?php
session_start();
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

if($nivel == 3 OR $nivel == 4){


$mensagem = "";

if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];
unset($_SESSION['mensagem']);
}

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57

include_once '../funcoes/conexaoPortari.php';


/******************************Buscar os clientes - paginacao**************************/


$stringSql = " SELECT id_cliente, nome_contato_cliente, codigoAntigo_cliente, origemCSV, bairro_cliente, cidade_cliente, estado_cliente, motivo_cliente, ddd_fone_cliente, fone_cliente, lista_sistema, origemCSV, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, hora_venda, observacao_sistema FROM clientes WHERE lista_sistema = 'CHECKLIST' ORDER BY id_cliente DESC ";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		         => $cliente ['id_cliente'],
	'nome_contato'         => $cliente ['nome_contato_cliente'],
  'codigo'               => $cliente ['codigoAntigo_cliente'],
	'vendedor'             => $cliente ['origemCSV'],
	'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'dataVenda'            => $cliente ['data_venda'],
  'horaVenda'            => $cliente ['hora_venda'],
	'motivo_assinante'     => $cliente ['motivo_cliente'],
  'mailing'              => $cliente ['lista_sistema'],
  'tratado'              => $cliente ['nomeUsuario'],
	);
}

//fechamento do banco de dados
mysqli_close($linkComMysql);

?>

<!--***************INICIO DO CODIGO HTML- INICIO DA PAGINA***************************** -->


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



      <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>

             </div>
        </div>
<br />




		 	    <div class="page-header">
  				<h2><strong>CheckList</strong></h2>
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
                     <th>CODIGO</th>
		                 <th>CIDADE</th>
                     <th>DATA</th>
                     <th>HORA</th>
                     <th>LEAD</th>
                     <th>VENDIDO</th>
		                 <th>MOTIVO</th>
		                 <th>TRATADO</th>
		                 <th><span class="glyphicon glyphicon-cog"></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php

			foreach ($clientes as $key => $cliente) {


        if ($cliente['motivo_assinante'] == 'CONCLUIDO' OR $cliente['motivo_assinante'] == 'CHECKLIST NAO OK' OR $cliente['motivo_assinante'] == 'NAO LOCALIZADO') {
            $ref = '../mailing/tratando-checklist.php';
          }



			?>

				 	<tr>

		                    <td><?=$cliente['id'];?></td>
                        <td><?=$cliente['codigo'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
                        <td><?=$cliente['dataVenda'];?></td>
                        <td><?=$cliente['horaVenda'];?></td>
                        <td><?=$cliente['mailing'];?></td>
                        <td><?=$cliente['vendedor'];?></td>
		                    <td><?=$cliente['motivo_assinante'];?></td>
		                    <td><?=$cliente['tratado'];?></td>
		                    <td class="actions">
                          <a class="btn btn-success btn-xs" title="Consultar" href="#" onclick="window.open('<?=$ref;?>?id=<?=$cliente['id'];?>&lista=RELATORIO', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=110, LEFT=450, WIDTH=700, HEIGHT=500');"><span class="glyphicon glyphicon-plus"></span></a>
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
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

    <script src="../media/js/jquery.dataTables.min.js"></script>
    <script src="../media/js/dataTables.bootstrap.min.js"></script>
    <script src="../media/js/tablesgeneral.js"></script>


</html>

<?php }else{?>

	<script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php }?>


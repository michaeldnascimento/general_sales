<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($nivel == 3 OR $nivel == 4){


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


/******************************Buscar os clientes - paginacao**************************/


$stringSql = "SELECT nomeUsuario, nomeEquipe, nomeEmpresa FROM clientes WHERE motivo_cliente <> '' AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY nomeUsuario";

echo $stringSql . "<br><br>";
//exit;

//mando execultar a query no banco de dados
$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'nomeUsuario'                => $cliente ['nomeUsuario'],
	'nomeEquipe'                  => $cliente ['nomeEquipe'],
	'nomeEmpresa'                 => $cliente ['nomeEmpresa']
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



<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>



<div id="main" class="container-fluid">




<div id="top" class="row">
<div class="col-md-12">

			<form action="../exportar/exporta_csv.php" method="POST">
			<input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
			<button type="submit" class="btn btn-default active btn-sm pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
			</form>


</div>
</div> 




<div class="page-header">
<h2>Relatorio Vendedor</h2>
</div>

<!--**********************LISTAGEM******************************************** -->


		<div id="list" class="row">

		    <div class="table-responsive col-md-12">

		       <table id="consultas_general" class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
						<th>VENDEDOR</th>
						<th>EQUIPE</th>
						<th>EMPRESA</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>



<!--********************************CONTATOS****************************** -->
		<?php 

			foreach ($clientes as $key => $cliente) {



		?>

			<tr>
			<td style="<?=$style?>"> <?=$cliente['nomeUsuario'];?></td>
			<td style="<?=$style?>"> <?=$cliente['nomeEquipe'];?></td>
			<td style="<?=$style?>"> <?=$cliente['nomeEmpresa'];?></td>
			<td class="actions">
			<form action="visualizar-mailing.php" method="post">

			<input style="display: none" type="text" name="mailing"  value="<?=$cliente['mailing'];?>" />

			<button type="submit" class="btn btn-info active btn-xs" title="VISUALIZAR"><span class="glyphicon glyphicon-eye-open"></span></button>
			</form>


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
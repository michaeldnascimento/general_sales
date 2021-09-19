<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($nivel == 3 OR $nivel == 4){

if ($nomeEquipe == 'GERAL') {
  $sqlequipe = '';
}else{
  $sqlequipe = "AND nomeEquipe = '". $nomeEquipe . "'";
}


$mailing = $_POST['mailing'];
$tabulacao = $_POST['tabulacao'];
//echo $tabulacao;

if ($tabulacao <> '') {

	$motivo = "motivo_cliente = " . "'".$tabulacao."'";

}

if ($tabulacao == '') {

	$motivo = "motivo_cliente IS NULL OR motivo_cliente = '' ";

}

/******************************Buscar os clientes - paginacao**************************/


$stringSql = "SELECT id_mailing, motivo_cliente, status_mailing, lista_sistema, nomeUsuario, COUNT(*) qtde FROM clientes WHERE id_mailing = '$mailing' AND {$motivo} {$sqlequipe} GROUP BY nomeUsuario";


//echo $stringSql . "<br><br>";
//exit;

//mando execultar a query no banco de dados
$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id_mailing'             => $cliente ['id_mailing'],
	'usuario'                => $cliente ['nomeUsuario'],
	'motivo_cliente'         => $cliente ['motivo_cliente'],
	'status_mailing'         => $cliente ['status_mailing'],
	'lista_sistema'          => $cliente ['lista_sistema'],
	'qtd'                    => $cliente ['qtde']
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




<div id="main" class="container-fluid">




<div id="top" class="row">
<div class="col-md-12">

			<form action="../exportar/exporta_csv.php" method="POST">
			<input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
			<button type="submit" class="btn btn-default active btn-sm pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
			</form>

</div>
</div> 

<br>
<br>




<div class="form-group">
<div class="col-md-12">



			<form action="visualizar-mailing.php" method="post">

			<input style="display: none" type="text" name="mailing"  value="<?=$mailing;?>"/>

			<button type="submit" class="btn btn-info active btn-xs">Voltar</button>
			</form>


			<form action="limpar-mailing.php" method="post">

			<input style="display: none" type="text" name="mailing"  value="<?=$mailing;?>"/>

			<input style="display: none" type="text" name="tabulacao" value="<?=$tabulacao;?>"/>

			<button type="submit" class="btn btn-default btn-xs pull-right">LIMPAR TUDO</button>
			</form>



</div>
</div>


<br/>
<br/>


<!--**********************LISTAGEM******************************************** -->



		<div id="list" class="row">

		    <div class="table-responsive col-md-12">

		        <table  class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
		                <th>ORIGEM</th>
						<th>TABULACAO</th>
						<th>VENDEDOR</th>
						<th>LISTA</th>
						<th>STATUS</th>
						<th>QTD</th>
		                </tr>
		            </thead>
		            <tbody>



<!--********************************CONTATOS****************************** -->
		<?php

			foreach ($clientes as $key => $cliente) {


			?>

			<tr>
			<td style="<?=$style?>"> <?=$cliente['id_mailing'];?></td>
			<td style="<?=$style?>"> <?=$cliente['motivo_cliente'];?></td>
			<td style="<?=$style?>"> <?=$cliente['usuario'];?></td>
			<td style="<?=$style?>"> <?=$cliente['lista_sistema'];?></td>
			<td style="<?=$style?>"> <?=$cliente['status_mailing'];?></td>
			<td style="<?=$style?>"> <?=$cliente['qtd'];?></td>
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
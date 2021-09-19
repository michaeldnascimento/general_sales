<?php
session_start();
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

if($nivel == 3){


$mensagem = "";

if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];
unset($_SESSION['mensagem']);
}

include_once '../funcoes/conexaoPortari.php';


/******************************Buscar os clientes - paginacao**************************/


$stringSql = " SELECT id_cliente, cidade_cliente, lista_sistema, observacao_sistema, tabulacao_lixeira FROM clientes WHERE tabulacao_lixeira = 'ASSUNTOS REFERENTE - SAC' OR tabulacao_lixeira = 'RECLAMACOES GERAIS - SAC' OR tabulacao_lixeira = 'REDUCAO DE PACOTE - SAC' OR tabulacao_lixeira = 'COMPRA DE CANAIS A LA CARTE' OR tabulacao_lixeira = 'MAILING REPETIDO' ORDER BY id_cliente DESC ";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		   => $cliente ['id_cliente'],
	'localizacao_assinante'=> $cliente ['cidade_cliente'],
    'lista_sistema'		   => $cliente ['lista_sistema'],
    'observacao_sistema'   => $cliente ['observacao_sistema'],
    'tabulacao_vendedor'   => $cliente ['tabulacao_lixeira'],
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


	</head>
	<body>



<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>


<!--***********************TOPO - BARRA DE PESQUISA********************************** -->


	        <div id="main" class="container-fluid">


		 	    <div class="page-header">
  				<h2>Analise de Lixeira</h2>
				</div>


<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->

<!--aqui vai aparece os dados do adicionar_contato-->
		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$mensagem;?></h5>
		    	</div>
		    </div>


<!--**********************************LISTAGEM******************************************** -->
<form action="excluir-mailing.php?lista=ANALISE" method="POST">




		<div id="list" class="row">

		    <div class="table-responsive col-md-12">

		        <table class="table table-striped" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
		                 <th>ID</th>
		                 <th>CIDADE</th>
		                 <th>LEAD</th>
		                 <th>OBSERVACAO</th>
		                 <th>TABULACAO</th>
		                 <th><span class="glyphicon glyphicon-cog"></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {

				 $cliente['observacao_sistema'] = substr_replace($cliente['observacao_sistema'], (strlen($cliente['observacao_sistema']) > 500 ? '...' : ''), 500);
					
			?>	 

				 	<tr>	
				 			
		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
		                    <td><?=$cliente['lista_sistema'];?></td>
		                    <td><?=$cliente['observacao_sistema'];?></td>
		                    <td><?=$cliente['tabulacao_vendedor'];?></td>
		                    <td class="actions">
		                    <a class="btn btn-warning btn-xs" title="Retornar para o mailing" href="limpar-tabulacao.php?id=<?=$cliente['id'];?>"><span class="glyphicon glyphicon-repeat"></a>
		                    <input type="checkbox" title="Selecionar para exluir" name="excluir[]" value="<?=$cliente['id'];?>" />
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
				    
				

				 				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-10 control-label" for="button1id"></label>
						<div class="col-md-2">
						 <input type="submit" class="btn btn-danger"  name="submit" value="Excluir Selecionados"/>
						 <input id="acao" type="checkbox" title="Selecionar Todos" name="excluir[]" onclick="marcarTodos(this.checked);">
						</div>
				</div>
				<br/>
				<br/>


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

	<script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php }?>


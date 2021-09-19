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

include_once '../funcoes/conexaoPortari.php';

/******************************Buscar os clientes - paginacao**************************/


$stringSql = " SELECT id_cliente, nome_contato_cliente, codigoAntigo_cliente, cidade_cliente, estado_cliente, motivo_cliente, ddd_fone_cliente, fone_cliente, lista_sistema, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, observacao_sistema FROM clientes WHERE motivo_cliente = 'NAO VENDA - TELEFONE NAO ATENDE' OR motivo_cliente = 'NAO VENDA - TELEFONE NAO PERTENCE AO CLIENTE' OR motivo_cliente = 'NAO VENDA - CLIENTE NAO LOCALIZADO' OR motivo_cliente = 'NAO VENDA - DECISOR AUSENTE - REAGENDADO' OR motivo_cliente = 'NAO VENDA - NAO TEM INTERESSE EM NOVA ASSINATURA' OR motivo_cliente = 'NAO VENDA - PROBLEMAS TECNICOS' OR motivo_cliente = 'NAO VENDA - NAO TEM COBERTURA VIRTUA' OR motivo_cliente = 'NAO VENDA - NAO TEM COBERTURA TODOS OS SERVICOS' OR motivo_cliente = 'NAO VENDA - ENDERECO BLOQUEADO' OR motivo_cliente = 'NAO VENDA - CLIENTE REPETIDO' OR motivo_cliente = 'NAO VENDA - CLIENTE JA CONTRATOU O SERVICO' OR motivo_cliente = 'NAO VENDA - SENDO ATENDIDO POR OUTRO VENDEDOR'  OR motivo_cliente = 'NAO VENDA  EM ATENDIMENTO COM O VENDEDOR DA EMPRESA' OR motivo_cliente = 'NAO VENDA - EM ATENDIMENTO COM O VENDEDOR NET' OR motivo_cliente = 'NAO VENDA - OUTROS - ESPECIFICAR' ORDER BY id_cliente DESC ";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		         => $cliente ['id_cliente'],
	'nome_contato'         => $cliente ['nome_contato_cliente'],
	'codigo_cliente'       => $cliente ['codigoAntigo_cliente'],
	'localizacao_assinante'=> $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'motivo_assinante'     => $cliente ['motivo_cliente'],
  'vendedor'             => $cliente ['nomeUsuario'],
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

<br />


		 <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
          </form>
          </div>
        </div>


		 	    <div class="page-header">
  				<h2>Nao Vendas Gerais</h2>
				</div>


<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->

<!--aqui vai aparece os dados do adicionar_contato-->
		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$mensagem;?></h5>
		    	</div>
		    </div>


<!--**********************************LISTAGEM******************************************** -->
<form action="excluir-mailing.php?lista=NAOVENDA" method="POST">




		<div id="list" class="row">

		    <div class="table-responsive col-md-12">

		        <table class="table table-striped" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
		                 <th>ID</th>
		                 <th>NOME</th>
		                 <th>CODIGO</th>
		                 <th>CIDADE</th>
		                 <th>MOTIVO</th>
		                 <th>VENDEDOR</th>
		                 <th><span class="glyphicon glyphicon-cog"></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {

				 $cliente['nome_contato'] = substr_replace($cliente['nome_contato'], (strlen($cliente['nome_contato']) > 30 ? '...' : ''), 30);
					
			?>	 

				 	<tr>	
				 			
		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['nome_contato'];?></td>
		                    <td><?=$cliente['codigo_cliente'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
		                    <td><?=$cliente['motivo_assinante'];?></td>
		                    <td><?=$cliente['vendedor'];?></td>
		                    <td class="actions">
		                    <!--<a class="btn btn-warning btn-xs" href="#?id=<?=$cliente['id'];?>"><span class="glyphicon glyphicon-repeat"></a>-->
		                    <input type="checkbox" title="Selecionar para excluir" name="excluir[]" value="<?=$cliente['id'];?>" />
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


<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($nivel == 3 OR $nivel == 4){

if ($nomeEquipe == 'GERAL') {
  $sqlequipe = '';
}else{
  $sqlequipe = "AND nomeEquipe = '". $nomeEquipe . "'";
}




$mensagem = "";


if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];


unset($_SESSION['mensagem']);
}


include_once '../funcoes/conexaoPortari.php';

$PESQUISA = "";


$dadoProcurado = ( isset($_POST['data']['search']) ) ? trim($_POST['data']['search']) : "" ;

//strlen altera texto pra numero, ele conta a quantidade de caracter 
if (strlen($dadoProcurado) > 0 ) {
	
	// gera dados para a pesquisa
	$PESQUISA .= " AND 
	(id_cliente like '%{$dadoProcurado}%'
	OR nome_cliente like '%{$dadoProcurado}%'
	OR codigo_cliente like '%{$dadoProcurado}%'
	OR nomeUsuario like '%{$dadoProcurado}%'
	OR cidade_cliente like '%{$dadoProcurado}%'
	OR estado_cliente like '%{$dadoProcurado}%')

	";
}



/******************************Buscar os clientes - paginacao**************************/


$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusPedido_venda_cliente, statusVenda_venda_cliente, lista_sistema, flag FROM clientes WHERE (statusVenda_venda_cliente = 'EM CADASTRO' OR statusVenda_venda_cliente IS NULL) AND (statusPedido_venda_cliente = 'CADASTRO-PENDENTE' OR statusPedido_venda_cliente is NULL) AND (motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI') {$PESQUISA} {$sqlequipe} ORDER BY data_venda desc
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
    'statusPedido_assinante'=> $cliente ['statusPedido_venda_cliente'],
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
	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
	<link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">

</head>
<body>



<!--**********************NAVBAR - BARRA DE NAVEGA????O DO SITE******************************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>


<!---*********************** MODAL PARA EXCLUSAO ******************** -->

			<!-- Modal -->
	<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="modalLabel">Excluir Usuario</h4>
	            </div>
	            <div class="modal-body">
	        		Deseja realmente excluir ?
	     		</div>

	        <div class="modal-footer">
	      
	        <form action="../backoffice/excluir-clienteBack.php?lista=TRATARPENDENCIA" method="post">
	      		<!--FOI FEITO EM VIA POST PRA O ID NAO APARECER NA URL POR MODE DE SEGURAN?????A-->
	      	  	<input type="hidden" name="id_contato" id="id_contato" value="">
	      	  	<input type="submit" class="btn btn-primary" value = "Sim">
	      

	 		  	<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
	 		</form>
	      </div>

	      </div>
	    </div>
	</div>




<!--***********************TOPO - BARRA DE PESQUISA********************************** -->



	<div id="ReloadThis">	
	   <div id="main" class="container-fluid">

	   <br />


	    <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>

             <button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Pesquisar" onClick="ativa()"><span class="glyphicon glyphicon-search"></span></button>

		</div>
        </div>
<div id='div' style='display:none'> 
		<div class="form-group ">
        <form action="listavenda-backoffice-tratarpendentes.php" method="post"> 
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
<br />


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
		     
		        <table class="table table-striped" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
		                 
		                 <th>ID</th>
						 <th>NOME</th>
						 <th>CODIGO</th>
		                 <th>CIDADE/ESTADO</th>
		                 <th>VENDEDOR</th>
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

				if ($cliente['flag'] == 1){
					$style = 'font-weight:bold';

				    }

					if ($cliente['flag'] == 2){
					$style = '';

					}

					if ($cliente['flag'] == ''){
					$style = 'font-weight:bold';

					}
					
					 $cliente['nome_cliente'] = substr_replace($cliente['nome_cliente'], (strlen($cliente['nome_cliente']) > 25 ? '...' : ''), 25);
					
			?>	 

				 	<tr>	
				 			
		                    <td style="<?=$style?>"><?=$cliente['id'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nome_cliente'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['codigo_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['localizacao_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nomeUsuario_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['dataVenda'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['statusPedido_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['statusVenda_assinante'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" href="../backoffice/flagback.php?id=<?=$cliente['id'];?>&lista=TRATARPENDENCIA"><span class="glyphicon glyphicon-pencil"></span></a>

		                      <a class="btn btn-danger btn-xs excluir"  href="#" data-toggle="modal" data-target="#delete-modal" id-do-contato="<?=$cliente['id'];?>"><span class="glyphicon glyphicon-trash"></span></a>
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

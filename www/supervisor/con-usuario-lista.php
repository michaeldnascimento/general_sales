<?php
//iniciar uma sessão
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";
include_once '../funcoes/conexaoPortari.php';

//VERIFICA O NIVEL DO USUARIO
if($nivel == 3 OR $nivel == 4 OR $nivel == 5){

//VERIFICA O NIVEL
if($nivel == 4){
    $nv = '';
}
else{
    $nv = 'WHERE nivel_login != 4 AND nivel_login != 2';
}

//VERIFICA A EQUIPE 
if ($nomeEquipe == 'GERAL') {
  $sqlequipe = '';
}else{
  $sqlequipe = "AND equipe_login = '". $nomeEquipe . "'";
}

//VERIFICA A EMPRESA
if ($nomePrestadora == 'GERAL') {
  $sqlempresa = '';
}else{
  $sqlempresa = "AND empresa_login = '". $nomePrestadora . "'";
}


//MENSAGEM SISTEMA 
$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


/******************************Buscar os clientes - paginacao**************************/


$stringSql = "SELECT id_login, nome_usuario_login, usuario_login, statusUsuario_login, funcao_login, departamento_login, turno_login, equipe_login, empresa_login, nivel_login, acessoSP_login, acessoBR_login, acessoSL_login, acessoRX_login, acessoMT_login, acessoUTI_login, acessoPROPOSTA_login, acessoPROSPECTS_login, acessoME_login, acessoCE_login, acessoCANC_login, acessoLEADSITE_login, acessoVENDARS_login, acessoMultibase_login, acessoOportunidadeSite_login, acessoOportunidadeSAC_login, acessoPARCEIROS_login, acessoTODOS_login FROM usuario {$nv} {$sqlequipe} {$sqlempresa} ORDER BY nome_usuario_login";


//echo $stringSql . "<br><br>";
//exit;

//mando execultar a query no banco de dados
$resultado = mysqli_query($linkComMysql, $stringSql);

//se eu quiser saber - pego a quantidade de contatos/linhas retornadas na busca
$qtdClientes = mysqli_num_rows($resultado);


$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		   => $cliente ['id_login'],
	'nome_do_usuario'  	   => $cliente ['nome_usuario_login'],
	'nome_usuario'  	   => $cliente ['usuario_login'],
	'statusUsuario'  	   => $cliente ['statusUsuario_login'],
	'funcao_usuario'	   => $cliente ['funcao_login'],
	'departamento_usuario' => $cliente ['departamento_login'],
	'turno_usuario'	       => $cliente ['turno_login'],
	'equipe_usuario' 	   => $cliente ['equipe_login'],
	'empresa_usuario' 	   => $cliente ['empresa_login'],
	'nivel_usuario'	       => $cliente ['nivel_login'],
	);
}


//fechamento do banco de dados
mysqli_close($linkComMysql);



if ($empresa == '003') {
$nvusuario = 'cad-usuarioSimples.php';
}else{
$nvusuario = 'cad-usuario.php';
}

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


<!--**************MODAL - PRA CONFIRMAÇÃO DE EXCLUIR ITEM******************************** -->


			<!-- Modal -->
	<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="modalLabel">Excluir Usuario</h4>
	            </div>
	            <div class="modal-body">
	        		Deseja realmente excluir este usuario?
	     		</div>

	        <div class="modal-footer">
	      
	        <form action="excluir-usuario.php" method="post">
	      		<!--FOI FEITO EM VIA POST PRA O ID NAO APARECER NA URL POR MODE DE SEGURANÇA-->
	      	  	<input type="hidden" name="id_contato" id="id_contato" value="">
	      	  	<input type="submit" class="btn btn-primary" value = "Sim">
	      

	 		  	<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
	 		</form>
	      </div>

	      </div>
	    </div>
	</div>

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


<!--***********************TOPO - BARRA DE PESQUISA********************************** -->


		<div id="main" class="container-fluid">


		<div class="form-group">
		<div class="col-md-12">
		<a type="button" href="<?=$nvusuario;?>" class="btn btn-success active btn-xs pull-right" title="Novo Usuario"><span class="glyphicon glyphicon-plus"></span></a>

		<form action="../exportar/exporta_csv.php" method="POST">
		<input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
		<button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
		</form>
		</div>


		<div class="page-header">
		<h2>Lista Usuarios</h2>
		</div>



<!--**********************************LISTAGEM******************************************** -->



		<div id="list" class="row">
		 
		    <div class="table-responsive col-md-12">
		     
		      <table id="consultas_general" class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
		                 
		                 <th>ID</th>
		                 <th>NOME</th>
						 <th>USUARIO</th>
						 <th>STATUS</th>
						 <th>FUNCAO</th>
		                 <th>DEPARTAMENTO</th>
		                 <th>TURNO</th>
		                 <th>EQUIPE</th>
		                 <th>EMPRESA</th>
		                 <th>NIVEL ACESSO</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                 
		                </tr>
		            </thead>
		            <tbody>

	

<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {

				if ($empresa == '003') {
				$vervenda = 'con-usuarioSimples.php';
				}else{
				$vervenda = 'con-usuario.php';
				}
					
			?>	 

				 	<tr>	
				 			
		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['nome_do_usuario'];?></td>
		                    <td><?=$cliente['nome_usuario'];?></td>
		                    <td><?=$cliente['statusUsuario'];?></td>
		                    <td><?=$cliente['funcao_usuario'];?></td>
		                    <td><?=$cliente['departamento_usuario'];?></td>
		                    <td><?=$cliente['turno_usuario'];?></td>
		                    <td><?=$cliente['equipe_usuario'];?></td>
		                    <td><?=$cliente['empresa_usuario'];?></td>
		                    <td><?=$cliente['nivel_usuario'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" href="<?=$vervenda;?>?id=<?=$cliente['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a>
		                      <a class="btn btn-danger btn-xs excluir"  href="#" data-toggle="modal" data-target="#delete-modal" id-do-contato="<?=$cliente['id'];?>"><span class="glyphicon glyphicon-trash"></span></</a>
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
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
		<script src="../css/bootstrap/js/meunavbar2.js"></script>

		<script src="../media/js/jquery.dataTables.min.js"></script>
    	<script src="../media/js/dataTables.bootstrap.min.js"></script>
   		<script src="../media/js/tablesgeneral.js"></script>

		<script>
			$(document).ready(function(){
				// pra buscar a value do button tem que usar .variavel pra buscar o id tem que se usar #iddooponete
				$('.excluir').click(function(){
					var idContato = $(this).attr('id-do-contato');
					
					$('#id_contato').val(idContato);
				});

			});
				

			
		</script>


</html>

<?php }else{?>

	<script> alert('Usuario sem permissão! '); window.history.go(-1); </SCRIPT>;

<?php }?>
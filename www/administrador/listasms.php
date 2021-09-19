<!--*************************CONEXAO COM O BANCO DE DADOS*********************************** -->
<?php
//iniciar uma sessão
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($empresa == '001' && $nivel == 4 OR $nivel == 5){

$mensagem = "";



//isset = se existe tal coisa 
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];

//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}


include_once '../funcoes/conexaoPortari.php';



/******************************Buscar os clientes - paginacao**************************/


$stringSql = "SELECT id_login, situacao_login, login, senha, enviado, date_format(data_reset,'%d/%m/%y')as data_reset, date_format(data_caiu,'%d/%m/%y')as data_caiu FROM logins WHERE lista_login = 'SMS' ORDER BY id_login DESC";


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
	'situacao'  	       => $cliente ['situacao_login'],
	'login'  	           => $cliente ['login'],
	'senha'  	           => $cliente ['senha'],
	'data_reset'	       => $cliente ['data_reset'],
	'data_caiu'            => $cliente ['data_caiu'],
	'enviado'              => $cliente ['enviado'],
	);
}

$ativo = "SELECT id_login, situacao_login, login, senha, enviado, date_format(data_reset,'%d/%m/%y')as data_reset, date_format(data_caiu,'%d/%m/%y')as data_caiu FROM logins WHERE lista_login = 'SMS' AND situacao_login = 'HABILITADO' ORDER BY id_login DESC";
//echo $ocorrencia;

$resu = mysqli_query($linkComMysql, $ativo);
$qtd = mysqli_num_rows($resu);

$client = array();
while ($clie = mysqli_fetch_assoc($resu)) {
  $client[] = array(
    'situacao2' 	       => $clie ['situacao_login'],
	'login2'  	           => $clie ['login'],
	'senha2'  	           => $clie ['senha'],
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


  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Logins SMS</strong></h4>
      </div>
      <div class="modal-body">

		<?php 

			
			foreach ($client as $key => $client) {
					
			?>	 

	 	<tr>	
	 	        <p><strong style="color:green">HABILITADO</strong></p>
                <td><strong>Situacao: </strong><?=$client['situacao2'];?></td><br>
                <td><strong>Login:    </strong><?=$client['login2'];?></td><br>
                <td><strong>Senha:    </strong><?=$client['senha2'];;?></td><br>
                <hr/>
    	</tr>


			<?php 		
				}

			 ?>


      </div>
    </div>
  </div>
</div>


	        <div id="main" class="container-fluid">


	    <div class="form-group">
            <div class="col-md-12">
             <a type="button" href="add-login.php?lista=SMS" class="btn btn-success active btn-xs pull-right" title="Inserir logins"><span class="glyphicon glyphicon-plus"></span></a>

            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>
        </div>


<div class="form-group">
<h3><center><strong>LISTA SMS</strong></center></h3>

<!-- Split button -->
<div class="col-md-2">
<button type="button" class="btn btn-primary btn-xs active" data-toggle="modal" data-target="#myModal">Logins Habilitados</button>
</div>

</div>
<br/>

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
		                 <th>SITUACAO</th>
						 <th>LOGIN</th>
						 <th>SENHA</th>
						 <th>DATA RESET</th>
		                 <th>DATA CAIU</th>
		                 <th>ENVIADO</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                 
		                </tr>
		            </thead>
		            <tbody>

	

<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {
					
			?>	 

	 	<tr>	
	 			
                <td><?=$cliente['id'];?></td>
                <td><?=$cliente['situacao'];?></td>
                <td><?=$cliente['login'];?></td>
                <td><?=$cliente['senha'];?></td>
                <td><?=$cliente['data_reset'];?></td>
                <td><?=$cliente['data_caiu'];?></td>
                <td><?=$cliente['enviado'];?></td>
                <td class="actions">
				  <a class="btn btn-success btn-xs" title="Consultar Chamado" href="#" onclick="window.open('consultar-login.php?id=<?=$cliente['id'];?>&lista=SMS', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=110, LEFT=350, WIDTH=600, HEIGHT=500');"><span class="glyphicon glyphicon-pencil"></span></a>

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
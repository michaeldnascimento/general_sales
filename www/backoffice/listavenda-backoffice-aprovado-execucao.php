<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";


if($nivel == 2 OR $nivel == 3 OR $nivel == 4){



$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}



/******************************Buscar os clientes - paginacao**************************/
if ($_POST['data1'] !="" OR $_POST['data2'] !="") {

  if ($_POST['vendedor'] !="") {
    $vendedor = "AND nomeUsuario = '{$_POST['vendedor']}'";
  }


$stringSql = "
  SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusVenda_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema FROM clientes WHERE statusVenda_venda_cliente = 'APROVADO EXECUÇÃO' {$vendedor} AND data_venda BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}' ORDER BY SUBSTR( data_venda, 7, 4), SUBSTR( data_venda, 4, 2), SUBSTR( data_venda, 1, 2)";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'                    => $cliente ['id_cliente'],
  'nome_cliente'          => $cliente ['nome_cliente'],
  'codigo_assinante'      => $cliente ['codigo_cliente'],
  'localizacao_assinante' => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
  'nomeUsuario_assinante' => $cliente ['nomeUsuario'],
  'dataVenda'             => $cliente ['data_venda'],
  'nomeBack'              => $cliente ['nomeUsuarioBack'],
  'statusVenda_assinante' => $cliente ['statusVenda_venda_cliente'],

  );
    }

}else{

$stringSql = "
	SELECT id_cliente, nome_cliente, codigo_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusVenda_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema FROM clientes WHERE statusVenda_venda_cliente = 'APROVADO EXECUÇÃO' AND (MONTH(data_venda)) = MONTH(NOW()) AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) ORDER BY SUBSTR( data_venda, 7, 4), SUBSTR( data_venda, 4, 2), SUBSTR( data_venda, 1, 2)";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		          => $cliente ['id_cliente'],
	'nome_cliente'  	      => $cliente ['nome_cliente'],
	'codigo_assinante'	    => $cliente ['codigo_cliente'],
	'localizacao_assinante' => $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
	'nomeUsuario_assinante'	=> $cliente ['nomeUsuario'],
	'dataVenda'	            => $cliente ['data_venda'],
  'nomeBack'				      => $cliente ['nomeUsuarioBack'],
  'statusVenda_assinante'	=> $cliente ['statusVenda_venda_cliente'],


	);
}

}//fechamento do banco de dados
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

<!--***********************TOPO - BARRA DE PESQUISA********************************** -->



	<div id="ReloadThis">	
	   <div id="main" class="container-fluid">



 <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>

             <button type="button" class="btn btn-default active btn-xs pull-right" title="Pesquisa avancada" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-calendar"></span></button>


             </div>
        </div>



  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>PESQUISAR</strong></h4>
      </div>
      <div class="modal-body">
<div class="container">



         <!-- Text input-->
<form action="listavenda-backoffice-credito.php" method="post">

          <label class="col-sm-1 control-label" for="textinput">D.Incio</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" name="data1"  id="data1" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

<br>
<br>
<br>

          <label class="col-sm-1 control-label" for="textinput">D.Fim</label>
          <div class="col-sm-2">
          <div class="input-group">
          <input type="date" class="form-control" name="data2"  id="data2" required>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>

<br>
<br>
<br>



           <label class="col-sm-1 control-label" for="textinput">Nome Usuario</label>
                <div class="col-sm-2">
                 <div class="input-group">
                   <input type="text" placeholder="Nome do usuario" class="form-control" name="vendedor" id="vendedor">
                   <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                 </div>
                </div>

<br>
<br>
<br>

          <div class="form-group">
          <label class="col-md-1 control-label" for="button1id"></label>
          <div class="col-md-2">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Pesquisar</button>
          </div>
          </div>

</form>
</div>



      </div>
    </div>
  </div>
</div>



          <div class="page-header">
          <h2>Backoffice Aprovado Execução</h2>
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
		                 <th>BACKOFFICE</th>
		                 <th>STATUS VENDA</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>

	

<!--****************************************CONTATOS*********************************** -->		 

		<?php 

			
			foreach ($clientes as $key => $cliente) {

					
			?>	 

				 	<tr>	
				 			
		                    <td style="<?=$style?>"><?=$cliente['id'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nome_cliente'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['codigo_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['localizacao_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nomeUsuario_assinante'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['dataVenda'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['nomeBack'];?></td>
		                    <td style="<?=$style?>"><?=$cliente['statusVenda_assinante'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" href="consultar-vendabackoffice.php?id=<?=$cliente['id'];?>&lista=EXECUCAO"><span class="glyphicon glyphicon-pencil"></span></a>
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

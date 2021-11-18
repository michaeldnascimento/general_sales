<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";


if($acessoPARCEIROS == 'SIM'){


?>
  <script> alert('Usuario sem permissão! '); window.history.go(-1); </SCRIPT>;

<?php
} else{



$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];

//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}

if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
}




/******************************Buscar os clientes - paginacao**************************/


$stringSql = "
	SELECT id_cliente, nome_contato_cliente, cidade_cliente, estado_cliente, date_format(data_followup_cliente,'%d/%m/%Y')as data_followup_cliente, date_format(hora_followup_cliente,'%Hh%i')as hora_followup_cliente, ddd_fone_cliente, fone_cliente, lista_sistema, date_format(datahora_cad_cliente,'%d/%m/%y %T')as datahora_cad_cliente, lista_sistema FROM clientes WHERE  nomeUsuario = '{$nomeUsuario}' AND (motivo_cliente = 'FOLLOW-UP') AND (YEAR(data_venda) = YEAR(NOW()))  ORDER BY id_cliente DESC
	";

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	   'id' 		  		        => $cliente ['id_cliente'],
	   'nome_cliente'  	      => $cliente ['nome_contato_cliente'],
	   'localizacao_assinante'=> $cliente ['cidade_cliente'] ." - ". $cliente ['estado_cliente'],
     'fone_assinante'       => "(" .$cliente ['ddd_fone_cliente'] .") ". $cliente ['fone_cliente'],
     'data_assinante'       => $cliente ['data_followup_cliente'],
     'hora_assinante'	      => $cliente ['hora_followup_cliente'],
     'datahora_cadastro'    => $cliente ['datahora_cad_cliente'],
     'lista_sistema'        => $cliente ['lista_sistema']
	);
}

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
		<title>Home Sales</title>

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

 <!-- /#top -->
          <div class="page-header">
          <h2>Agenda Retornos</h2>
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
						         <th>NOME CONTATO</th>
		                 <th>CIDADE/ESTADO</th>
		                 <th>FONE</th>
		                 <th>DATA/HORA</th>
		                 <th>DATA RETORNO</th>
		                 <th>HORA RETORNO</th>
		                 <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>

		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php 


			foreach ($clientes as $key => $cliente) {

				$cliente['nome_cliente'] = substr_replace($cliente['nome_cliente'], (strlen($cliente['nome_cliente']) > 20 ? '...' : ''), 20);

        if ($cliente['lista_sistema'] == 'SP' OR $cliente['lista_sistema'] == 'BR' OR $cliente['lista_sistema'] == 'RX' OR $cliente['lista_sistema'] == 'MT' OR $cliente['lista_sistema']  == 'CO' OR $cliente['lista_sistema'] == 'UTI') {

          $lista = "../mailing/tratandoLista_cliente.php";
        }

        if ($cliente['lista_sistema']  == 'CANCELADOS' OR $cliente['lista_sistema']  == 'PROSPECT' OR $cliente['lista_sistema']  == 'MULTIBASE' OR $cliente['lista_sistema']  == 'OPORTUNIDADES' OR $cliente['lista_sistema']  == 'PROSPECTNET' OR $cliente['lista_sistema']  == 'CLARO'  OR $cliente['lista_sistema']  == 'LEADCLARO'  OR $cliente['lista_sistema']  == 'CANCELADOSCLARO' OR $cliente['lista_sistema']  == 'PROPOSTAS' OR $cliente['lista_sistema']  == 'EXCLUSIVO' OR $cliente['lista_sistema']  == 'TVBASE') {

          $lista = "../mailing/tratando-CSV.php";
        }

        if ($cliente['lista_sistema']  == 'NAO') {
          $lista = "../mailing/tratando-oportsite.php";
            
        }

			?>

				 	<tr>

		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['nome_cliente'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
		                    <td><?=$cliente['fone_assinante'];?></td>
		                    <td><?=$cliente['datahora_cadastro'];?></td>
		                    <td><?=$cliente['data_assinante'];?></td>
		                    <td><?=$cliente['hora_assinante'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" href="<?=$lista;?>?id=<?=$cliente['id'];?>&lista=RETORNO"><span class="glyphicon glyphicon-pencil"></span></a>
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

<?php } ?>
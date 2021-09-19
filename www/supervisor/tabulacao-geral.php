<?php
session_start();
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

if($nivel == 3 OR $nivel == 4){

if ($nomeEquipe == 'GERAL') {
  $sqlequipe = '';
}else{
  $sqlequipe = "nomeEquipe = '". $nomeEquipe . "' AND";
}



$mensagem = "";

if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];
unset($_SESSION['mensagem']);
}

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57

include_once '../funcoes/conexaoPortari.php';
$dadoProcurado = ( isset($_POST['data']['search']) ) ? trim($_POST['data']['search']) : "" ;

/******************************Buscar os clientes - paginacao**************************/
if ($_POST['data1'] !="" OR $_POST['data2'] !="") {

  if ($_POST['vendedor'] !="") {
    $vendedor = "nomeUsuario = '{$_POST['vendedor']}' AND";
  }


    if ($_POST['status'] == "NAOVENDASGERAIS") {
      $tabula = "statusVenda_venda_cliente IS NULL AND";
    }

    if ($_POST['status'] == "VENDASGERAIS") {
      $tabula = "statusVenda_venda_cliente != '' AND";
    }



$stringSql = "
  SELECT id_cliente, nome_contato_cliente, codigoAntigo_cliente, cidade_cliente, estado_cliente, motivo_cliente, efetividade_contato,  ddd_fone_cliente, fone_cliente, lista_sistema, origemCSV, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, hora_venda, observacao_cliente, date_format(datahora_cad_cliente,'%d/%m/%y %T')as datahora_cad_cliente FROM clientes WHERE {$sqlequipe} {$vendedor} {$tabula} data_venda BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}' ORDER BY id_cliente DESC";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'                   => $cliente ['id_cliente'],
  'nome_contato'         => $cliente ['nome_contato_cliente'],
  'codigo_cliente'       => $cliente ['codigoAntigo_cliente'],
  'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'dataVenda'            => $cliente ['data_venda'],
  'horaVenda'            => $cliente ['hora_venda'],
  'motivo_assinante'     => $cliente ['motivo_cliente'],
  'efetividade'          => $cliente ['efetividade_contato'],
  'mailing'              => $cliente ['lista_sistema'],
  'vendedor'             => $cliente ['nomeUsuario'],
  );
    }

}else{

$stringSql = " SELECT id_cliente, nome_contato_cliente, codigoAntigo_cliente, cidade_cliente, estado_cliente, motivo_cliente, efetividade_contato, ddd_fone_cliente, fone_cliente, lista_sistema, origemCSV, nomeUsuario, nomeEquipe, date_format(data_venda,'%d/%m/%Y')as data_venda, hora_venda, observacao_sistema, date_format(datahora_cad_cliente,'%d/%m/%y %T')as datahora_cad_cliente FROM clientes WHERE {$sqlequipe} data_venda = '{$dataDia}' ORDER BY id_cliente DESC ";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		         => $cliente ['id_cliente'],
	'nome_contato'         => $cliente ['nome_contato_cliente'],
	'codigo_cliente'       => $cliente ['codigoAntigo_cliente'],
	'localizacao_assinante'=> $cliente ['cidade_cliente'],
  'dataVenda'            => $cliente ['data_venda'],
  'horaVenda'            => $cliente ['hora_venda'],
	'motivo_assinante'     => $cliente ['motivo_cliente'],
  'efetividade'          => $cliente ['efetividade_contato'],
  'mailing'              => $cliente ['lista_sistema'],
  'vendedor'             => $cliente ['nomeUsuario'],
	);
}
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
<form action="tabulacao-geral.php" method="post">

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

          <label class="col-sm-1 control-label" for="textinput">Status</label>
          <div class="col-sm-2">
          <select id="status" name="status" class="form-control">
          <option value=""></option>
            <option value="NAOVENDASGERAIS">NAO VENDAS GERAIS</option>
            <option value="VENDASGERAIS">VENDAS GERAIS</option>
            <option value="TODOS">TODOS</option>
          </select>
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
  				<h2><strong>Tabulacao Geral</strong></h2>
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
		                 <th>MOTIVO</th>
                     <th>EFETIVIDADE</th>
		                 <th>VENDEDOR</th>
		                 <th><span class="glyphicon glyphicon-cog"></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->		 

		<?php

			foreach ($clientes as $key => $cliente) {

				 $cliente['nome_contato'] = substr_replace($cliente['nome_contato'], (strlen($cliente['nome_contato']) > 15 ? '...' : ''), 15);

        if ($cliente['motivo_assinante'] == 'VENDA - NOVO CLIENTE' OR $cliente['motivo_assinante'] == 'VENDA - UPGRADE + MULTI' OR $cliente['motivo_assinante'] == 'VENDA - UPGRADE') {
            $ref = '../backoffice/consultar-vendabackoffice.php';
          }


        if ($cliente['motivo_assinante'] == 'FOLLOW-UP' OR $cliente['motivo_assinante'] == 'OPORTUNIDADE - CLIENTE NAO LOCALIZADO' OR $cliente['motivo_assinante'] == 'LIXEIRA - NAO TEM INTERESSE EM NOVA ASSINATURA' OR $cliente['motivo_assinante'] == 'LIXEIRA - PROBLEMAS TECNICOS' OR $cliente['motivo_assinante'] == 'LIXEIRA - NAO TEM INTERESSE EM NOVA ASSINATURA' OR $cliente['motivo_assinante'] == 'LIXEIRA - PROBLEMAS TECNICOS' OR $cliente['motivo_assinante'] == 'LIXEIRA - NAO TEM COBERTURA VIRTUA' OR $cliente['motivo_assinante'] == 'LIXEIRA - NAO TEM COBERTURA TV' OR $cliente['motivo_assinante'] == 'LIXEIRA - CLIENTE REPETIDO' OR $cliente['motivo_assinante'] == 'LIXEIRA - CLIENTE JA CONTRATOU O SERVICO' OR $cliente['motivo_assinante'] == 'LIXEIRA - SENDO ATENDIDO POR OUTRO VENDEDOR' OR $cliente['motivo_assinante'] == 'LIXEIRA - OUTROS - ESPECIFICAR') {

            if ($cliente['mailing'] == 'SP' OR $cliente['mailing'] == 'BR' OR $cliente['mailing'] == 'RX') {
              $ref = '../mailing/tratandoLista_cliente.php';
             }

            if ($cliente['mailing'] == 'CANCELADOS' OR $cliente['mailing'] == 'MULTIBASE' OR $cliente['mailing'] == 'OPORTUNIDADES' OR $cliente['mailing'] == 'PROPOSTAS' OR $cliente['mailing'] == 'PROSPECT' OR $cliente['mailing'] == 'SITE') {
              $ref = '../mailing/tratando-CSV.php';
             }

          }

			?>

				 	<tr>

		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['codigo_cliente'];?></td>
		                    <td><?=$cliente['localizacao_assinante'];?></td>
                        <td><?=$cliente['dataVenda'];?></td>
                        <td><?=$cliente['horaVenda'];?></td>
                        <td><?=$cliente['mailing'];?></td>
		                    <td><?=$cliente['motivo_assinante'];?></td>
                        <td><?=$cliente['efetividade'];?></td>
		                    <td><?=$cliente['vendedor'];?></td>
		                    <td class="actions">
                          <a class="btn btn-success btn-xs" title="Consultar Chamado" href="#" onclick="window.open('<?=$ref;?>?id=<?=$cliente['id'];?>&lista=RELATORIO', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=110, LEFT=450, WIDTH=700, HEIGHT=500');"><span class="glyphicon glyphicon-plus"></span></a>
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


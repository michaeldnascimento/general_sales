<?php
session_start();

include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($acessoPARCEIROS == 'SIM'){


?>
  <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php
} else{


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}


if ($nivel == 2 OR $nivel == 3 OR $nivel == 4) {

  $drop = '';

}else{

  $drop = 'none';
}


$dadoProcurado = ( isset($_POST['data']['search']) ) ? trim($_POST['data']['search']) : "" ;




/******************************Buscar os clientes - paginacao**************************/
if ($_POST['data1'] !="" OR $_POST['data2'] !="") {

  if ($_POST['statusVenda'] != "") {
    $status = "AND (situacao_chamado = '{$_POST['statusVenda']}')";
  }


$stringSql = "SELECT id_chamado, codigoNET, tabulacao_chamado, propostaNET, nome_back, situacao_chamado, chamado, date_format(data_chamado,'%d/%m/%Y')as data_chamado FROM chamados WHERE (nome_vendedor = '{$nomeUsuario}') {$status} AND (data_chamado BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}') ORDER BY data_chamado";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


    while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'             => $cliente ['id_chamado'],
  'codigo'         => $cliente ['codigoNET'],
  'proposta'       => $cliente ['propostaNET'],
  'tabulacao'      => $cliente ['tabulacao_chamado'],
  'nome_back'      => $cliente ['nome_back'],
  'situacao'       => $cliente ['situacao_chamado'],
  'chamado'        => $cliente ['chamado'],
  'data_chamado'   => $cliente ['data_chamado'],
  );
    }

}else{

$stringSql = "SELECT id_chamado, codigoNET, tabulacao_chamado, propostaNET, nome_back, situacao_chamado, chamado, date_format(data_chamado,'%d/%m/%Y')as data_chamado FROM chamados WHERE (nome_vendedor = '{$nomeUsuario}') AND ((MONTH(data_chamado)) = MONTH(NOW()) OR (MONTH(data_chamado)) = MONTH(NOW())) ORDER BY data_chamado desc";


$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		   => $cliente ['id_chamado'],
	'codigo'  	  	 => $cliente ['codigoNET'],
	'proposta'	     => $cliente ['propostaNET'],
	'tabulacao'      => $cliente ['tabulacao_chamado'],
  'nome_back'		   => $cliente ['nome_back'],
  'situacao'  		 => $cliente ['situacao_chamado'],
  'chamado'        => $cliente ['chamado'],
  'data_chamado'   => $cliente ['data_chamado'],
	);
}

}if (strlen($dadoProcurado) > 0 ) {

$stringSql = "SELECT id_chamado, codigoNET, tabulacao_chamado, propostaNET, nome_back, situacao_chamado, chamado, date_format(data_chamado,'%d/%m/%Y')as data_chamado FROM chamados WHERE (nome_vendedor = '{$nomeUsuario}') AND ((MONTH(data_chamado)) = MONTH(NOW()) OR (MONTH(data_chamado)) = MONTH(NOW())) AND (id_chamado like '%{$dadoProcurado}%' OR codigoNET like '%{$dadoProcurado}%' OR propostaNET like '%{$dadoProcurado}%' OR tabulacao_chamado like '%{$dadoProcurado}%' OR nome_back like '%{$dadoProcurado}%' OR situacao_chamado like '%{$dadoProcurado}%') ORDER BY SUBSTR( data_chamado, 7, 4), SUBSTR( data_chamado, 4, 2), SUBSTR( data_chamado, 1, 2)";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();


    while ($cliente = mysqli_fetch_assoc($resultado)) {
  $clientes[] = array(
  'id'             => $cliente ['id_chamado'],
  'codigo'         => $cliente ['codigoNET'],
  'proposta'       => $cliente ['propostaNET'],
  'tabulacao'      => $cliente ['tabulacao_chamado'],
  'nome_back'      => $cliente ['nome_back'],
  'situacao'       => $cliente ['situacao_chamado'],
  'chamado'        => $cliente ['chamado'],
  'data_chamado'   => $cliente ['data_chamado'],
  );
    }

}
mysqli_close($linkComMysql);

?>

<!--*******************INICIO DO CODIGO HTML- INICIO DA PAGINA********************************** -->


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="icon" href="../css/imagens/16x16.png">
		<title>Home Sales</title>


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
<!--*************MESSAGEM DO SISTEMA - BASEADO EM SESSOES********************* -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<div id="main" class="container-fluid">
<br />

	    <div class="form-group">
            <div class="col-md-12">
            <a type="button" href="novo_chamado.php" class="btn btn-success active btn-xs pull-right" title="Novo Chamado"><span class="glyphicon glyphicon-plus"></span></a>

            <button type="button" id="botao" class="btn btn-default active btn-xs pull-right" title="Relatorio por data" onClick="ativa()"><span class="glyphicon glyphicon-calendar"></span></button>

            <button type="button" id="botao2" class="btn btn-default active btn-xs pull-right" title="Pesquisar" onClick="ativa2()"><span class="glyphicon glyphicon-search"></span></button>
             </div>
        </div>
<br/>
<div id='div' style='display:none'> 
<form action="lista_chamadosVED.php" method="post">
	  <div class="form-group">

	  		 <label class="col-sm-5 control-label" for="textinput"></label>
		      <div class="col-sm-2">
		      <select id="statusVenda" name="statusVenda" class="form-control">
		      <option value=""></option>
	          <option value="EM ANALISE">EM ANALISE</option>
	          <option value="EM TRATAMENTO ">EM TRATAMENTO </option>
	          <option value="FINALIZADO ">FINALIZADO</option>
		      </select>
		      </div>


	  			<label  class="col-sm-1 control-label" for="textinput"></label>
                <div class="col-sm-1">
                 <div class="input-group">
                  <input type="date" class="form-control" name="data1" id="data1">
                 </div>
                </div>


      			<label  class="col-sm-1 control-label" for="textinput"></label>
                <div class="col-sm-1">
                 <div class="input-group">
                   <input type="date" class="form-control" name="data2" id="data2"s>
                 </div>
				</div>
			<button type="submit" class="btn btn-success active btn-sm pull-right"><span class="glyphicon glyphicon-ok"></span></button>
	   </div>
</form>
</div>

<div id='div2' style='display:none'> 
    <div class="form-group ">
        <form action="lista_chamadosVED.php" method="post"> 
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

		 	    <div class="page-header">
  				<h2>Chamados Backoffice</h2>
				  </div>


<!--**********************************LISTAGEM******************************************** -->

		<div id="list" class="row">

		    <div class="table-responsive col-md-12">

		        <table class="table table-striped" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>

                     <th>ID</th>
                     <th>CODIGO</th>
                     <th>PROPOSTA</th>
                     <th>MOTIVO</th>
                     <th>DATA CHAMADO</th>
                     <th>BAKCOFFICE</th>
                     <th>SITUACAO</th>
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
                        <td><?=$cliente['codigo'];?></td>
                        <td><?=$cliente['proposta'];?></td>
                        <td><?=$cliente['tabulacao'];?></td>
                        <td><?=$cliente['data_chamado'];?></td>
                        <td><?=$cliente['nome_back'];?></td>
                        <td><?=$cliente['situacao'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" title="Consultar Chamado" href="consultar_chamados.php?id=<?=$cliente['id'];?>"><span class="glyphicon glyphicon-pencil"></span></a>
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


</html>

<?php } ?>
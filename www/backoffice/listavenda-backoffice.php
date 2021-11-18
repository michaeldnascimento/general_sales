<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";


if($nivel == 2 OR $nivel == 3 OR $nivel == 4 OR $nivel == 5){



if ($nomeEquipe == 'GERAL') {
  $sqlequipe = '';
  $verequipe = '';
}else{
  $sqlequipe = "AND nomeEquipe = '". $nomeEquipe . "'";
  $verequipe = 'none';
}

if ($nomePrestadora == 'GERAL') {
  $sqlempresa = '';
  $verempresas = '';

}else{
  $sqlempresa = "AND nomeEmpresa = '". $nomePrestadora . "'";
  $verempresas = 'none';
}


  // SE NIVEL FOR IGUAL A NIVEL 4(ADM) O CAMPO NOME DO VENDEDOR FICAR ALTERAVEL 
if ($nivel == 4) {
    $botaoexcluir = '';

  }else{
    $botaoexcluir = 'none';
  }


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
		$vendedor = " nomeUsuario = '{$_POST['vendedor']}' AND";
	}

	if ($_POST['statusVenda'] =="") {
		$status = " motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI' OR motivo_cliente = 'VENDA - BASE TV'";

		$data = "data_venda BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}' OR data_inst_venda_cliente BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}' OR data_agendamento_venda_cliente BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}' OR data_canc_venda_cliente BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}'";
	}else{
		$status = " statusVenda_venda_cliente = '{$_POST['statusVenda']}'";

		if ($_POST['statusVenda'] == "INSTALADO") {
			$data = "data_inst_venda_cliente";
		}

		if ($_POST['statusVenda'] == "CANCELADO") {
			$data = "data_canc_venda_cliente";
		}

		if ($_POST['statusVenda'] == "AGENDADO") {
			$data = "data_agendamento_venda_cliente";
		}

		if ($_POST['statusVenda'] == "PENDENTE" OR $_POST['statusVenda'] == "QUEBRA" OR $_POST['statusVenda'] == "EM CADASTRO") {
			$data = "data_venda";
		}

	}

    if ($_POST['empresa'] !="") {
    $empresa = "AND nomeEmpresa = '{$_POST['empresa']}'";
    }else{
      $empresa = "";
    }


    if ($_POST['equipe'] !="") {
    $equipe = "AND nomeEquipe = '{$_POST['equipe']}'";
  }else{
      $equipe = "";
    }

    if ($_POST['conexao'] !="") {
    $conexao = "AND conexao = '{$_POST['conexao']}'";
  }else{
      $conexao = "";
    }



$stringSql = "
	SELECT id_cliente, nome_cliente, cpf_cnpj_cliente, rg_ie_cliente, data_nasc_cliente, email_cliente, sexo_cliente, tipo_pessoa_cliente, nome_mae_cliente, codigo_cliente, fone_cliente, celular_cliente,  fone3_cliente, fone4_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, nomeEmpresa, login_net, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusPedido_venda_cliente, statusChecklist, conexao, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, date_format(data_ativacao,'%d/%m/%Y')as data_ativacao, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, plano_multi_cliente, qtdchip_multi_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, tipo_servico, observacaoBack_venda_cliente, flag FROM clientes WHERE ({$status}) {$sqlequipe} {$sqlempresa} {$equipe} {$empresa} {$conexao} AND ({$vendedor}  {$data} BETWEEN '{$_POST['data1']}' AND '{$_POST['data2']}') ORDER BY data_venda desc";
//echo $stringSql;

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
	'tiposervico'	          => $cliente ['tipo_servico'],
	'nomeBack'				      => $cliente ['nomeUsuarioBack'],
	'conexao'               => $cliente ['conexao'],
	'statusVenda_assinante'	=> $cliente ['statusVenda_venda_cliente'],
	'flag'                  => $cliente ['flag'],
  'empresa'               => $cliente ['nomeEquipe']." - ". $cliente ['nomeEmpresa'],
  'observacaoBack'        => $cliente ['observacaoBack_venda_cliente'],
	);
    }

}else{


$stringSql = "
	SELECT id_cliente, nome_cliente, cpf_cnpj_cliente, rg_ie_cliente, data_nasc_cliente, email_cliente, sexo_cliente, tipo_pessoa_cliente, nome_mae_cliente, codigo_cliente, fone_cliente, celular_cliente,  fone3_cliente, fone4_cliente, cidade_cliente, estado_cliente, nomeUsuario, nomeEquipe, nomeEmpresa, login_net, date_format(data_venda,'%d/%m/%Y')as data_venda, nomeUsuarioBack, statusPedido_venda_cliente, statusChecklist, conexao, statusVenda_venda_cliente, date_format(data_inst_venda_cliente,'%d/%m/%Y')as data_inst_venda_cliente, date_format(data_ativacao,'%d/%m/%Y')as data_ativacao, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, date_format(data_agendamento_venda_cliente,'%d/%m/%Y')as data_agendamento_venda_cliente, date_format(data_canc_venda_cliente,'%d/%m/%Y')as data_canc_venda_cliente, motivo_cliente, numPacote_venda_cliente, tv_venda_cliente, internet_venda_cliente, netfone_venda_cliente, netcelular_venda_cliente, plano_multi_cliente, qtdchip_multi_cliente, agregado_venda_cliente, formaPagemento_cliente, auditadoBack_venda_cliente, lista_sistema, tipo_servico, observacaoBack_venda_cliente, flag FROM clientes WHERE (motivo_cliente = 'VENDA - NOVO CLIENTE' OR motivo_cliente = 'VENDA - UPGRADE' OR motivo_cliente = 'VENDA - UPGRADE + MULTI' OR motivo_cliente = 'VENDA - BASE TV') {$sqlequipe} {$sqlempresa} AND ((MONTH(data_inst_venda_cliente)) = MONTH(NOW()) AND (YEAR(data_inst_venda_cliente)) = YEAR(NOW()) OR (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) OR (MONTH(data_agendamento_venda_cliente)) = MONTH(NOW()) AND (YEAR(data_agendamento_venda_cliente)) = YEAR(NOW())OR (MONTH(data_canc_venda_cliente)) = MONTH(NOW()) AND (YEAR(data_canc_venda_cliente)) = YEAR(NOW())) ORDER BY data_venda desc
	";
//echo $stringSql;
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
	'tiposervico'	          => $cliente ['tipo_servico'],
	'nomeBack'				      => $cliente ['nomeUsuarioBack'],
	'conexao'               => $cliente ['conexao'],
	'statusVenda_assinante'	=> $cliente ['statusVenda_venda_cliente'],
	'flag'                  => $cliente ['flag'],
  'empresa'               => $cliente ['nomeEquipe']." - ". $cliente ['nomeEmpresa'],
  'observacaoBack'        => $cliente ['observacaoBack_venda_cliente'],
	);
}
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
		<title>Home Sale</title>

		<!-- Bootstrap CSS -->
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


<div id="main" class="container-fluid">



	    <div class="form-group">
            <div class="col-md-12">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
             <button type="submit" class="btn btn-default active btn-xs pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
             </form>

             <button type="button" class="btn btn-default active btn-xs pull-right" title="Pesquisa avancada" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-calendar"></span></button>


             <button type="button" class="btn btn-default active btn-xs pull-right" style="display: <?=$botaoexcluir?>" title="Excluir" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-trash"></span></button>

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
<form action="listavenda-backoffice.php" method="post">

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
                <select id="statusVenda" name="statusVenda" class="form-control">
                    <option value="">TODOS</option>
                    <option value="PENDENTE-BACKOFFICE">PENDENTE-BACKOFFICE</option>
                    <option value="PENDENTE-VENDEDOR">PENDENTE-VENDEDOR</option>
                    <option value="AGENDADO">AGENDADO</option>
                    <option value="QUEBRA">QUEBRA</option>
                    <option value="INSTALADO">INSTALADO</option>
                    <option value="CANCELADO">CANCELADO</option>
                </select>
                </div>

<br>
<br>
<br>
      <label style="display: <?php echo $verequipe ?>"  class="col-sm-1 control-label" for="textinput">Equipe</label>
      <div style="display: <?php echo $verequipe ?>" class="col-sm-2">
      <select id="equipe" name="equipe" class="form-control">
      <option value="">TODOS</option>
      <option value="EQUIPE 1">EQUIPE 1</option>
      <option value="EQUIPE 2">EQUIPE 2</option>
      <option value="EQUIPE 3">EQUIPE 3</option>
      <option value="EQUIPE 4">EQUIPE 4</option>
      <option value="EQUIPE 5">EQUIPE 5</option>
      <option value="NET PROSPECT">NET PROSPECT</option>
      <option value="MULTI">MULTI</option>
      <option value="CLARO">CLARO</option>
      <option value="TIM">TIM</option>
      <option value="PARCEIRO CLARO">PARCEIRO CLARO</option>
      <option value="PARCEIRO NET">PARCEIRO NET</option>
      <option value="PARCEIRO TIM">PARCEIRO TIM</option>
      <option value="JLR">JLR</option>
      <option value="GERAL"   >GERAL</option>
      </select>
      </div>


<br>
<br>
<br>

      <label style="display: <?php echo $verempresas ?>" class="col-sm-1 control-label" for="textinput">Empresa</label>
      <div style="display: <?php echo $verempresas ?>" class="col-sm-2">
      <select id="empresa" name="empresa" class="form-control">
      <option value="">TODOS</option>
          <option value="EMPRESA 1">EMPRESA 1-RSTELECOM</option>
          <option value="EMPRESA 2">EMPRESA 2-MACHADO</option>
          <option value="EMPRESA 3">EMPRESA 3-LEONARDO</option>
          <option value="EMPRESA 4">EMPRESA 4-FLEXCELL</option>
          <option value="EMPRESA 5">EMPRESA 5-CRISTIANO</option>
          <option value="EMPRESA 6">EMPRESA 6-SAHIMON</option>
          <option value="EMPRESA 7">EMPRESA 7-AGNALDO</option>
          <option value="EMPRESA 8">EMPRESA 8</option>
          <option value="EMPRESA 9">EMPRESA 9-FELIPE</option>
          <option value="GERAL"     >GERAL</option>
      </select>
      </div>


<br>
<br>
<br>

      <label class="col-sm-1 control-label" for="textinput">Conexão</label>
      <div class="col-sm-2">
      <select id="conexao" name="conexao" class="form-control">
      <option value="">TODOS</option>
          <option value="SIM">SIM</option>
          <option value="NAO">NAO</option>
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

  <!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>EXCLUIR VENDA</strong></h4>
      </div>
      <div class="modal-body">
<div class="container">



         <!-- Text input-->
<form action="excluir-clienteBack.php?lista=GERAL" method="post">

	  			<label class="col-sm-1 control-label" for="textinput">ID</label>
                <div class="col-sm-2">
                 <div class="input-group">
                   <input type="text" placeholder="ID de exclusao" class="form-control" name="id_contato" id="id_contato">
                 </div>
				</div>


<br>
<br>
<br>

          <div class="form-group">
          <label class="col-md-1 control-label" for="button1id"></label>
          <div class="col-md-2">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Confirmar</button>
          </div>
          </div>

</form>
</div>



      </div>
    </div>
  </div>
</div>


<!--********MESSAGEM DO SISTEMA - BASEADO EM SESSOES************************ -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>


		 	    <div class="page-header">
  				<h2>Backoffice Vendas Gerais</h2>
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
                <th>EMPRESA</th>
                <th>DATA VENDA</th>
                <th>SERVICO</th>
                <th>CONEXAO</th>
                <th>BACKOFFICE</th>
                <th>STATUS VENDA</th>
                <th class="actions"><em class="glyphicon glyphicon-cog"></em></th>
		                </tr>
		            </thead>
		            <tbody>



<!--****************************************CONTATOS*********************************** -->

		<?php 


			foreach ($clientes as $key => $cliente) {

         $cliente['nome_cliente'] = substr_replace($cliente['nome_cliente'], (strlen($cliente['nome_cliente']) > 20 ? '...' : ''), 20);

         $cliente['observacaoBack'] = substr_replace($cliente['observacaoBack'], (strlen($cliente['observacaoBack']) > 20 ? '...' : ''), 20);

      if ($empresa == '003') {
      $vervenda = 'consultar-vendabackofficesimples.php';
      }else{
      $vervenda = 'consultar-vendabackoffice.php';
      }

			?>

		 <tr>

          <td style="<?=$style?>"><?=$cliente['id'];?></td>
          <td style="<?=$style?>"><?=$cliente['nome_cliente'];?></td>
          <td style="<?=$style?>"><?=$cliente['codigo_assinante'];?></td>
          <td style="<?=$style?>"><?=$cliente['localizacao_assinante'];?></td>
          <td style="<?=$style?>"><?=$cliente['nomeUsuario_assinante'];?></td>
          <td style="<?=$style?>"><?=$cliente['empresa'];?></td>
          <td style="<?=$style?>"><?=$cliente['dataVenda'];?></td>
          <td style="<?=$style?>"><?=$cliente['tiposervico'];?></td>
          <td style="<?=$style?>"><?=$cliente['conexao'];?></td>
          <td style="<?=$style?>"><?=$cliente['nomeBack'];?></td>
          <td style="<?=$style?>"><?=$cliente['statusVenda_assinante'];?></td>
          <td class="actions">

          <a class="btn btn-success btn-xs" title="Consultar Chamado" href="#" onclick="window.open('<?=$vervenda;?>?id=<?=$cliente['id'];?>&lista=GERAL', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=110, LEFT=350, WIDTH=600, HEIGHT=700');"><span class="glyphicon glyphicon-pencil"></span></a>


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

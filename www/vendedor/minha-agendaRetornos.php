<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";


date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('Y-m-d'); // Resultado: 2009-02-05
$horaDia = date('H:i:s'); // Resultado: 03:39:57.

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
	SELECT id_cliente, nome_contato_cliente, cidade_cliente, estado_cliente, observacao_cliente, date_format(data_followup_cliente,'%d/%m/%Y')as data_followup_cliente, date_format(hora_followup_cliente,'%Hh%i')as hora_followup_cliente, ddd_fone_cliente, fone_cliente, lista_sistema, date_format(datahora_cad_cliente,'%d/%m/%y %T')as datahora_cad_cliente, lista_sistema FROM clientes WHERE  nomeUsuario = '{$nomeUsuario}' AND (motivo_cliente = 'FOLLOW-UP') AND (YEAR(data_venda) = YEAR(NOW()))  ORDER BY id_cliente DESC
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
     'lista_sistema'        => $cliente ['lista_sistema'],
     'observacao_cliente'        => $cliente ['observacao_cliente']
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
<br/>

    <div class="form-group">
        <div class="col-md-12">
            <button type="button" class="btn btn-success active btn-xs pull-right" title="Novo agendamento" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span></button>
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
                        <form action="salvar-agenda.php" method="post">

                            <label class="col-sm-1 control-label" for="textinput">Nome</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="nome_contato_cliente"  id="nome_contato_cliente" required>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                            <label class="col-sm-1 control-label" for="textinput">Cidade</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cidade_cliente"  id="cidade_cliente" required>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                            <label class="col-sm-1 control-label" for="textinput">UF</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" maxlength="2" name="estado_cliente" id="estado_cliente" required>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                            <label class="col-sm-1 control-label" for="textinput">Data Retorno</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="data_followup_cliente"  id="data_followup_cliente" required>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                            <label class="col-sm-1 control-label" for="textinput">Hora Retorno</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="time" class="form-control" name="hora_followup_cliente"  id="hora_followup_cliente" required>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                            <label class="col-sm-1 control-label" for="textinput">Fone</label>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <input type="text" placeholder="Fone Contato" class="form-control" name="fone_cliente" id="fone_cliente" required>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>


                            <label class="col-sm-1 control-label" for="textinput">Descrição</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <textarea type="text" rows="3" class="form-control" name="observacao_cliente" id="observacao_cliente"></textarea>
                                    <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
                                </div>
                            </div>

                            <br>
                            <br>
                            <br>

                            <br>
                            <br>
                            <br>

                            <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

                            <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

                            <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

                            <input type="text" style="display: none" name="motivo_cliente" class="form-control input-md" id="motivo_cliente" value="FOLLOW-UP">

                            <input type="text" style="display: none" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">

                            <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

                            <div class="form-group">
                                <label class="col-md-1 control-label" for="button1id"></label>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal">Salvar</button>
                                </div>
                            </div>

                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>


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
		                 <th>DATA RETORNO</th>
		                 <th>HORA RETORNO</th>
                         <th>OBS</th>

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
		                    <td><?=$cliente['data_assinante'];?></td>
		                    <td><?=$cliente['hora_assinante'];?></td>
                            <td><?=$cliente['observacao_cliente'];?></td>
		                    <td class="actions">
		                      <a class="btn btn-success btn-xs" href="../mailing/tratando-oportsiteCSV.php?id_contato=<?=$cliente['id'];?>&lista=RETORNO"><span class="glyphicon glyphicon-pencil"></span></a>
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
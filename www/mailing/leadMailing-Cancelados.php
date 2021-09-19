<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

if($acessoCANC == 'SIM' OR $acessoTODOS == 'SIM'){



$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
}

include_once '../funcoes/conexaoPortari.php';



/******************************Buscar os clientes - paginacao**************************/


/******************************Buscar os clientes - paginacao**************************/
$stringSql = " SELECT id_cliente FROM clientes WHERE (lista_sistema = 'CANCELADOS' AND motivo_cliente IS NULL) AND (flag IS NULL AND status_mailing IS NULL OR status_mailing = 'ATIVO') ORDER BY id_cliente DESC";

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);
$clientes = array();
mysqli_close($linkComMysql);

if ($qtdClientes == 0){
$visualizarbutton = 'disabled';
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
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" href="../css/navbar/meunavbar.css">

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
        <h4 class="modal-title" id="myModalLabel"><strong>SCRIPT COMERCIAL</strong></h4>
      </div>
      <div class="modal-body">
<p><strong>Script abordagem opcao 1</strong></p>
Ola, bom dia / boa tarde / boa noite<br>
Por gentileza o (a)  Sr (a) .........................?<br>
Meu nome e ...................... sou Representante Comercial da NET, tudo bom?<br>
<p>Estou ligando para passar algumas condicoes especiais sobre TV, internet e telefonia para o seu endereco, recebi uma indicacao e estou retornando o contato.</p>
<hr/>
<p><strong>Script abordagem opcao 2</strong></p>
Ola, bom dia / boa tarde / boa noite<br>
Por favor o (a) Sr.(a)...................?<br>
Meu nome e................ sou Representante de vendas da NET, tudo bem?<br>
<p>Estou ligando pra saber se voce necessita de algum servico como telefonia, TV ou internet?<p>
<hr/>
<p><strong>Script CheckList prospect:</strong></p>

<p>Sr. (sra), ......o Sr esta adquirindo:<br>
* Informar os servicos contratados;<br>
* Valor total mensal dos servicos contratados; em caso de boleto, acrescentqar o valor e informar o cliente;<br>
* Lembrar sobre a utilizacao do 21 no fixo (de acordo com o plano) e no movel para ligacoes DDD e DDI;<br>
* Reforcar que ligacoes excedentes do fixo e do movel serao cobradas a parte;<br>
* Em caso de fidelidade informar o periodo e valor;<br>
* Primeira fatura em formato de pro-rata;<br>
* Em caso de promocao especificar o periodo<br>
* Instalacao:  dia da semana, data e copia do documento com foto do titular da assinatura.<br>
Caso a instalacao seja acompanhada por outra pessoa tambem sera necessario a copia do documento;<br>
* Informar ao cliente que o numero do protocolo sera enviado via SMS ou email em ate 24 horas<br></p>

<p>Lembrando que sua fatura sera enviada atraves do seu email xxxxxx@xxxx.com.br. E em  ate 05 dias uteis sera enviado o Aviso de Compra Net, com as informacoes do servico contratados.<br>
0 (a) Sr (a) tera acesso ao seu contrato e tambem podera realizar diversas solicitacoes no espaco reservado ao cliente no site www.net.tv.br, na area "acesso minha net" e iniciar o cadastro utilizando o CNPJ/CPF do titular;</p>

<p>Em caso de venda de combo multi<br>
* Reforcar o plano de minutos;<br>
* Reforcar que para usufruir de todos os beneficios informados, inclusive o dobro do VTA, a ativacao do chip deve ser feita atraves do telefone 0800 723 6626 (pedir para que o cliente confirme o numero informado).<br>
O (a) Sr (a) podera receber ligacoes da net solicitando o envio de documentos para o email cliente_net@net.com.br<br>
O Sr. Concorda com os valores e servicos contratados</p>

<p>Parabens pela aquisicao!!!</p>



      </div>
    </div>
  </div>
</div>


<!--***********************TOPO - BARRA DE PESQUISA********************************** -->


<div id="main" class="container-fluid">

<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>

<div class="page-header">
<h3><strong>CANCELADOS NET</strong></h3>
</div>

<label class="col-md-11 control-label" for="button1id"></label>
<button type="button" class="btn btn-primary btn-xs active" data-toggle="modal" data-target="#myModal">
  Script
</button>

<p ALIGN="left"><strong>INFO: </strong> Para tratar um novo cliente CANCELADO, click no botao PROXIMO.</p>

        <div class="form-group">
    <label class="col-md-0 control-label" for="button1id"></label>
        <a class="btn btn-success active <?php echo $visualizarbutton ?>" href="filacliente.php?usuario=<?=$nomeUsuario?>&lista=CANCELADOS"><span class="glyphicon glyphicon-chevron-right"></span> Proximo</a>
        </div>



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


<?php }else{?>

	<script> alert('Usuario sem permissao! '); window.history.go(-1); </script>;

<?php }?>
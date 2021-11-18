<?php
session_start();

include_once "../login/verifica.php";

if($empresa == '001' && $nivel == 4 OR $nivel == 5){

$mensagem = "";


//isset = se existe tal coisa
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];

//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}


?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
		<title>Home Sale</title>


		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap/css/css-geral.css">


</head>
<body>


<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="novo_mailing.php" class="navbar-brand">Home Sale</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>" data-toggle="dropdown">Mailing<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="../mailing/leadNET-SP.php">Lead NET SP</a></li>
              <li><a href="../mailing/leadNET-BR.php">Lead NET BR</a></li>
              <li><a href="../mailing/leadNET-Reconex.php">Lead NET Reconex</a></li>
              <li><a href="../mailing/leadNET-Multi.php">Lead NET Multi</a></li>
              <li><a href="../mailing/leadNET-UTI.php">Lead NET UTI</a></li>
              <li><a href="../mailing/lead-M.E.php">Lead M.E.</a></li>
              <li><a href="../mailing/lead-C.E.php">Lead C.E</a></li>
              <li><a href="../mailing/lead-SITE.php">Lead Site</a></li>
              <li><a href="../mailing/lead-Propostas.php">Propostas</a></li>
              <li><a href="../mailing/leadProspects.php">Prospects</a></li>
              <li><a href="../mailing/leadMailing-Cancelados.php">Cancelados</a></li>
              <li><a href="../mailing/multibase.php">Multi Base</a></li>
              <li><a href="../mailing/oportunidades-site.php">Oport. General</a></li>
              <li><a href="../mailing/oportunidades-sac.php">Oport. SAC</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>" data-toggle="dropdown">Vendedor<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="../vendedor/minhas-vendasLista.php">Vendas Concluidas</a></li>
              <li><a href="../vendedor/minhas-vendasPendentes.php">Vendas Pendentes</a></li>
              <li><a href="../vendedor/minhas-naoVendas.php">Nao Vendas</a></li>
              <li><a href="../vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
              <li><a href="../vendedor/nova_venda.php">Nova Venda</a></li>
              <li><a href="../vendedor/nova-venda-rapida.php">Nova Venda Resumida</a></li>
            </ul>
        </li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Parceiros<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="../parceiros/add-cliente.php">Novo Cliente Resumido</a></li>
            <li><a href="../parceiros/add-cliente_completo.php">Novo Cliente Completo</a></li>
            <li><a href="../parceiros/minhas-vendas.php">Minhas Vendidas</a></li>
          </ul>
        </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="../backoffice/listavenda-backoffice-tratar.php">Vendas Novas Concluidas</a></li>
              <li><a href="../backoffice/listavenda-backoffice.php">Vendas Gerais</a></li>
              <li><a href="../backoffice/listavenda-backoffice-agendado.php">Vendas Agendadas</a></li>
              <li><a href="../backoffice/listavenda-backoffice-cancelado.php">Vendas Canceladas</a></li>
              <li><a href="../backoffice/listavenda-backoffice-instalado.php">Vendas Instaladas</a></li>
              <li><a href="../backoffice/listavenda-backoffice-pendente.php">Vendas Pendentes</a></li>
              <li><a href="../backoffice/listavenda-backoffice-quebra.php">Vendas Quebra</a></li>
              <li><a href="../backoffice/listavenda-backoffice-multi.php">Vendas Multi</a></li>
              <li><a href="../backoffice/listavenda-parceiros.php">Vendas Parceiros</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li><a href="../supervisor/listavenda-backoffice-tratarpendentes.php">Vendas Novas Pendentes</a></li>
            <li><a href="../supervisor/analise-lixeira.php">Analise Lixeira</a></li>
            <li><a href="../supervisor/nao-venda-geral.php">Nao Vendas Gerais</a></li>
            <li><a href="../supervisor/listagem-multibase.php">Lista Multi Base</a></li>
            <li><a href="../supervisor/listagem-cancelados.php">Lista Cancelados</a></li>
            <li><a href="../supervisor/listagem-oportunidade-sac.php">Lista Oportunidades SAC</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>" data-toggle="dropdown">Administrador<b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li><a href="../administrador/novo_mailing.php">Novo Mailing</a></li>
            <li><a href="../administrador/con-usuario-lista.php">Lista Usuarios</a></li>
            <li><a href="../administrador/importcvs.php">Importar CSV</a></li>
          </ul>
        </li>
        <li>
        <a href="../index.php">Home</a>
        </li>


      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li><a><?php echo $nomeUsuario?></a></li>
          <li class="active ">
              <a href="../login/sair.php">Sair</a>
            </li>
       </ul>

    </nav>
  </div>
</header>


 
<!--********************** FORMULARIO ************************************** -->

<div id="main" class="container-fluid">
<form class="form-horizontal" method="POST" action="novo_mailing-salve.php" enctype="multipart/form-data">

<br />
<br />

			<!-- Form Name -->
			<h4><center><strong>Novo Mailing</strong></center></h4>


<!--*****************MESSAGEM DO SISTEMA - BASEADO EM SESSOES*********************************** -->

<!--aqui vai aparece os dados do adicionar_contato-->
		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$mensagem;?></h5>
		    	</div>
		    </div>


			

			<!-- Textarea -->
			<div class="form-group">
			  <label class="col-md-4 control-label" for="observacao_cliente"></label>
			  <div class="col-md-4">
			    <textarea rows="4" class="form-control" id="sistema" name="sistema" autofocus></textarea>
			  </div>
			</div>



			<!-- Button (Double) -->
			<div id="actions" class="form-group">
			  <label class="col-md-4 control-label" for="salvar"></label>
			  <div class="col-md-8">
			    <button type="submit" class="btn btn-primary">Salvar</button>
			  </div>
			</div>


	</form>
	</div>


</body>
    <!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
</html>

<?php }else{?>

  <script> alert('Usuario sem permissao! '); window.history.go(-1); </SCRIPT>;

<?php }?> 
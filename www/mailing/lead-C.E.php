<!--*************************CONEXAO COM O BANCO DE DADOS*********************************** -->
<?php

ini_set('default_charset', 'UTF-8'); 

//iniciar uma sessão
session_start();


//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";





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



	<style>

	body{
		margin-top: 600px;
		background-image: url(../css/imagens/pagina_construcao.jpg);
		background-repeat: no-repeat;
		background-position: center;
	}

	.msg-padrao {
		color: black;
		text-align: center;
		font-weight: bolder;
	}

	</style>


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
      <a href="lead-C.E.php" class="navbar-brand">General Sales</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a style="display: <?php echo $dropsp ?>" href="../mailing/leadNET-SP.php">Lead NET SP</a></li>
              <li><a style="display: <?php echo $dropbr ?>" href="../mailing/leadNET-BR.php">Lead NET BR</a></li>
              <li><a style="display: <?php echo $dropsl ?>" href="../mailing/leadNET-SUL.php">Lead NET SUL</a></li>
              <li><a style="display: <?php echo $droprx ?>" href="../mailing/leadNET-Reconex.php">Lead NET Reconex</a></li>
              <li><a style="display: <?php echo $dropmt ?>" href="../mailing/leadNET-Multi.php">Lead NET Multi</a></li>
              <li><a style="display: <?php echo $droputi ?>" href="../mailing/leadNET-UTI.php">Lead NET UTI</a></li>
              <li><a style="display: <?php echo $dropme ?>" href="../mailing/lead-M.E.php">Lead M.E.</a></li>
              <li><a style="display: <?php echo $dropce ?>" href="../mailing/lead-C.E.php">Lead C.E</a></li>
              <li><a style="display: <?php echo $dropleadsite ?>" href="../mailing/lead-SITE.php">Lead Site</a></li>
              <li><a style="display: <?php echo $dropproposta ?>" href="../mailing/lead-Propostas.php">Propostas</a></li>
              <li><a style="display: <?php echo $dropprospects ?>" href="../mailing/leadProspects.php">Prospects</a></li>
              <li><a style="display: <?php echo $dropcanc ?>" href="../mailing/leadMailing-Cancelados.php">Cancelados</a></li>
              <li><a style="display: <?php echo $dropmultibase ?>" href="../mailing/multibase.php">Multi Base</a></li>
              <li><a style="display: <?php echo $dropoportunidadesite ?>" href="../mailing/oportunidades-site.php">Oport. General</a></li>
              <li><a style="display: <?php echo $dropoportunidadesac ?>" href="../mailing/oportunidades-sac.php">Oport. SAC</a></li>
              <li><a href="../mailing/checklist.php">CheckList</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle"  data-toggle="dropdown">Vendedor<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="../vendedor/minhas-vendasLista.php">Vendas Concluidas</a></li>
              <li><a href="../vendedor/minhas-vendasPendentes.php">Vendas Pendentes</a></li>
              <li><a href="../vendedor/minhas-naoVendas.php">Nao Vendas</a></li>
              <li><a href="../vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
              <li><a href="../vendedor/nova_venda.php">Nova Venda</a></li>
              <li><a href="../vendedor/nova-venda-rapida.php">Nova Venda Resumida</a></li>
              <li><a href="../vendedor/nova-venda_simplificada.php">Nova Venda Simplificada</a></li>
               <li><a href="../vendedor/lista_chamadosVED.php">Chamados Backoffice</a></li>
            </ul>
        </li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>"  data-toggle="dropdown">Parceiros<b class="caret"></b></a>
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
            <li><a href="./supervisor/listavenda-backoffice-tratarpendentes.php">Vendas Novas Pendentes</a></li>
            <li><a href="../supervisor/tabulacao-geral.php">Tabulacao Geral</a></li>
            <li><a href="../supervisor/analise-lixeira.php">Analise Lixeira</a></li>
            <li><a href="../supervisor/nao-venda-geral.php">Nao Vendas Gerais</a></li>
            <li><a href="../supervisor/listagem-multibase.php">Lista Multi Base</a></li>
            <li><a href="../supervisor/listagem-cancelados.php">Lista Cancelados</a></li>
            <li><a href="../supervisor/listagem-oportunidade-sac.php">Lista Oportunidades SAC</a></li>
            <li><a href="../supervisor/listagem-checklist.php">Lista CheckList</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="display: <?php echo $drop ?>" data-toggle="dropdown">Administrador<b class="caret"></b></a>
            <ul class="dropdown-menu">
            <li><a href="../administrador/novo_mailing.php">Novo Mailing</a></li>
            <li><a href="../administrador/con-usuario-lista.php">Lista Usuarios</a></li>
            <li><a href="../administrador/useronline.php">Onlines</a></li>
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

		    


 	
</body>
	<!-- jQuery -->
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/scripts-geral.jss"></script>
		
		<!-- Bootstrap JavaScript -->
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
</html>
<?php
session_start();


//login_verifica pra verificar o login
include_once "./login/verifica.php";
include_once "./login/visualizarlista.php";

  $graficos = 'none';

if ($empresa == '001') {
  $img1 = 'css/imagens/BANNER_COMUNICADO_ALGA.jpg';
  $img2 = 'css/imagens/BANNER_COMUNICADO_ALGA.jpg';
}

if ($empresa == '002') {
  $img1 = 'css/imagens/BANNER-SITE-NOVO-1170X650-2.jpg';
  $img2 = 'css/imagens/BANNER-SITE-NOVO-1170X650-2.jpg';
}

 if($empresa == '005'){
  $img1 = 'css/imagens/Background_AmericanGroup.jpg';
  $img2 = 'css/imagens/Background_AmericanGroup_Blue.jpg';
 }


 if($empresa == '10'){
  $img1 = 'css/imagens/Background.jpg';
  $img2 = 'css/imagens/Background.jpg';
 }


?>

<!--***************INICIO DO CODIGO HTML- INICIO DA PAGINA**************************** -->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./css/imagens/16x16.png">
        <title>Home Sale</title>


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./css/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/bootstrap/css/css-geral.css">


<style>
body {
width: 100%;
height: 100%;
background-attachment: fixed;

background-position: center;
-webkit-background-size: cover;
-moz-background-size: cover;
background-size: cover;
-o-background-size: cover;
}

.imghome {
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}


/*-------------------------------*/
/*           Wrappers            */
/*-------------------------------*/

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 220px;
}

#sidebar-wrapper {
    z-index: 1000;
    left: 220px;
    width: 0;
    height: 100%;
    margin-left: -220px;
    overflow-y: auto;
    overflow-x: hidden;
    background: #1a1a1a;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#sidebar-wrapper::-webkit-scrollbar {
  display: none;
}

#wrapper.toggled #sidebar-wrapper {
    width: 220px;
}

#page-content-wrapper {
    width: 100%;
    padding-top: 1px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -220px;
}

/*-------------------------------*/
/*     Sidebar nav styles        */
/*-------------------------------*/

.sidebar-nav {
    position: absolute;
    top: 0;
    width: 220px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    position: relative; 
    line-height: 20px;
    display: inline-block;
    width: 100%;
}

.sidebar-nav li:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    height: 100%;
    width: 3px;
    background-color: #1c1c1c;
    -webkit-transition: width .2s ease-in;
      -moz-transition:  width .2s ease-in;
       -ms-transition:  width .2s ease-in;
            transition: width .2s ease-in;

}
.sidebar-nav li:first-child a {
    color: #fff;
    background-color: #1a1a1a;
}
.sidebar-nav li:nth-child(2):before {
    background-color: #279636;   
}
.sidebar-nav li:nth-child(3):before {
    background-color: #0A14DE;   
}
.sidebar-nav li:nth-child(4):before {  
    background-color: #F00911;   
}
.sidebar-nav li:nth-child(5):before {
    background-color: #14AE9C;   
}
.sidebar-nav li:nth-child(6):before {
    background-color: #153151;   
}
.sidebar-nav li:nth-child(7):before {
    background-color: #ead24c;   
}
.sidebar-nav li:nth-child(8):before {
    background-color: #2d2366;   
}
.sidebar-nav li:nth-child(9):before {
    background-color: #F28C07;   
}
.sidebar-nav li:nth-child(10):before {
    background-color: #0E463F;   
}
.sidebar-nav li:nth-child(11):before {
    background-color: #AFCDF2;   
}
.sidebar-nav li:nth-child(12):before {
    background-color: #B393F2;   
}
.sidebar-nav li:nth-child(13):before {
    background-color: #B7EB92;   
}
.sidebar-nav li:hover:before,
.sidebar-nav li.open:hover:before {
    width: 100%;
    -webkit-transition: width .2s ease-in;
      -moz-transition:  width .2s ease-in;
       -ms-transition:  width .2s ease-in;
            transition: width .2s ease-in;

}

.sidebar-nav li a {
    display: block;
    color: #ddd;
    text-decoration: none;
    padding: 10px 15px 10px 30px;    
}

.sidebar-nav li a:hover,
.sidebar-nav li a:active,
.sidebar-nav li a:focus,
.sidebar-nav li.open a:hover,
.sidebar-nav li.open a:active,
.sidebar-nav li.open a:focus{
    color: #fff;
    text-decoration: none;
    background-color: transparent;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 20px;
    line-height: 44px;
}
.sidebar-nav .dropdown-menu {
    position: relative;
    width: 100%;
    padding: 0;
    margin: 0;
    border-radius: 0;
    border: none;
    background-color: #404040;
    box-shadow: none;
}

/*-------------------------------*/
/*       Hamburger-Cross         */
/*-------------------------------*/

.hamburger {
  position: fixed;
  top: 20px;  
  z-index: 999;
  display: block;
  width: 32px;
  height: 32px;
  margin-left: 15px;
  background: transparent;
  border: none;
}
.hamburger:hover,
.hamburger:focus,
.hamburger:active {
  outline: none;
}
.hamburger.is-closed:before {
  content: '';
  display: block;
  width: 100px;
  font-size: 14px;
  color: #fff;
  line-height: 32px;
  text-align: center;
  opacity: 0;
  -webkit-transform: translate3d(0,0,0);
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed:hover:before {
  opacity: 1;
  display: block;
  -webkit-transform: translate3d(-100px,0,0);
  -webkit-transition: all .35s ease-in-out;
}

.hamburger.is-closed .hamb-top,
.hamburger.is-closed .hamb-middle,
.hamburger.is-closed .hamb-bottom,
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-middle,
.hamburger.is-open .hamb-bottom {
  position: absolute;
  left: 0;
  height: 4px;
  width: 100%;
}
.hamburger.is-closed .hamb-top,
.hamburger.is-closed .hamb-middle,
.hamburger.is-closed .hamb-bottom {
  background-color: #1a1a1a;
}
.hamburger.is-closed .hamb-top { 
  top: 5px; 
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed .hamb-middle {
  top: 50%;
  margin-top: -2px;
}
.hamburger.is-closed .hamb-bottom {
  bottom: 5px;  
  -webkit-transition: all .35s ease-in-out;
}

.hamburger.is-closed:hover .hamb-top {
  top: 0;
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed:hover .hamb-bottom {
  bottom: 0;
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-middle,
.hamburger.is-open .hamb-bottom {
  background-color: #1a1a1a;
}
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-bottom {
  top: 50%;
  margin-top: -2px;  
}
.hamburger.is-open .hamb-top { 
  -webkit-transform: rotate(45deg);
  -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
}
.hamburger.is-open .hamb-middle { display: none; }
.hamburger.is-open .hamb-bottom {
  -webkit-transform: rotate(-45deg);
  -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
}
.hamburger.is-open:before {
  content: '';
  display: block;
  width: 100px;
  font-size: 14px;
  color: #fff;
  line-height: 32px;
  text-align: center;
  opacity: 0;
  -webkit-transform: translate3d(0,0,0);
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-open:hover:before {
  opacity: 1;
  display: block;
  -webkit-transform: translate3d(-100px,0,0);
  -webkit-transition: all .35s ease-in-out;
}

/*-------------------------------*/
/*            Overlay            */
/*-------------------------------*/

.overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(250,250,250,.8);
    z-index: 1;
}a/*NAVBAR 2*/

body {
    position: relative;
    overflow-x: hidden;
}
body,
html { height: 100%;}
.nav .open > a, 
.nav .open > a:hover, 
.nav .open > a:focus {background-color: transparent;}

/*-------------------------------*/
/*           Wrappers            */
/*-------------------------------*/

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 220px;
}

#sidebar-wrapper {
    z-index: 1000;
    left: 220px;
    width: 0;
    height: 100%;
    margin-left: -220px;
    overflow-y: auto;
    overflow-x: hidden;
    background: #000;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#sidebar-wrapper::-webkit-scrollbar {
  display: none;
}

#wrapper.toggled #sidebar-wrapper {
    width: 220px;
}

#page-content-wrapper {
    width: 100%;
    padding-top: 1px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -220px;
}

/*-------------------------------*/
/*     Sidebar nav styles        */
/*-------------------------------*/

.sidebar-nav {
    position: absolute;
    top: 0;
    width: 220px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    position: relative; 
    line-height: 20px;
    display: inline-block;
    width: 100%;
}

.sidebar-nav li:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
    height: 100%;
    width: 3px;
    background-color: #1c1c1c;
    -webkit-transition: width .2s ease-in;
      -moz-transition:  width .2s ease-in;
       -ms-transition:  width .2s ease-in;
            transition: width .2s ease-in;

}
.sidebar-nav li:first-child a {
    color: #fff;
    background-color: #000;
}
.sidebar-nav li:nth-child(2):before {
    background-color: #279636;   
}
.sidebar-nav li:nth-child(3):before {
    background-color: #0A14DE;   
}
.sidebar-nav li:nth-child(4):before {  
    background-color: #F00911;   
}
.sidebar-nav li:nth-child(5):before {
    background-color: #14AE9C;   
}
.sidebar-nav li:nth-child(6):before {
    background-color: #153151;   
}
.sidebar-nav li:nth-child(7):before {
    background-color: #ead24c;   
}
.sidebar-nav li:nth-child(8):before {
    background-color: #2d2366;   
}
.sidebar-nav li:nth-child(9):before {
    background-color: #F28C07;   
}
.sidebar-nav li:nth-child(10):before {
    background-color: #0E463F;   
}
.sidebar-nav li:nth-child(11):before {
    background-color: #AFCDF2;   
}
.sidebar-nav li:nth-child(12):before {
    background-color: #EE6363;   
}
.sidebar-nav li:nth-child(13):before {
    background-color: #CD853F;   
}
.sidebar-nav li:hover:before,
.sidebar-nav li.open:hover:before {
    width: 100%;
    -webkit-transition: width .2s ease-in;
      -moz-transition:  width .2s ease-in;
       -ms-transition:  width .2s ease-in;
            transition: width .2s ease-in;

}

.sidebar-nav li a {
    display: block;
    color: #ddd;
    text-decoration: none;
    padding: 10px 15px 10px 30px;    
}

.sidebar-nav li a:hover,
.sidebar-nav li a:active,
.sidebar-nav li a:focus,
.sidebar-nav li.open a:hover,
.sidebar-nav li.open a:active,
.sidebar-nav li.open a:focus{
    color: #fff;
    text-decoration: none;
    background-color: transparent;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 20px;
    line-height: 44px;
}
.sidebar-nav .dropdown-menu {
    position: relative;
    width: 100%;
    padding: 0;
    margin: 0;
    border-radius: 0;
    border: none;
    background-color: #404040;
    box-shadow: none;
}

/*-------------------------------*/
/*       Hamburger-Cross         */
/*-------------------------------*/

.hamburger {
  position: fixed;
  top: 20px;  
  z-index: 999;
  display: block;
  width: 32px;
  height: 32px;
  margin-left: 15px;
  background: #5055ff;
  border: none;
}
.hamburger:hover,
.hamburger:focus,
.hamburger:active {
  outline: none;
}
.hamburger.is-closed:before {
  content: '';
  display: block;
  width: 100px;
  font-size: 14px;
  color: #fff;
  line-height: 32px;
  text-align: center;
  opacity: 0;
  -webkit-transform: translate3d(0,0,0);
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed:hover:before {
  opacity: 1;
  display: block;
  -webkit-transform: translate3d(-100px,0,0);
  -webkit-transition: all .35s ease-in-out;
}

.hamburger.is-closed .hamb-top,
.hamburger.is-closed .hamb-middle,
.hamburger.is-closed .hamb-bottom,
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-middle,
.hamburger.is-open .hamb-bottom {
  position: absolute;
  left: 0;
  height: 4px;
  width: 100%;
}
.hamburger.is-closed .hamb-top,
.hamburger.is-closed .hamb-middle,
.hamburger.is-closed .hamb-bottom {
  background-color: #1a1a1a;
}
.hamburger.is-closed .hamb-top { 
  top: 5px; 
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed .hamb-middle {
  top: 50%;
  margin-top: -2px;
}
.hamburger.is-closed .hamb-bottom {
  bottom: 5px;  
  -webkit-transition: all .35s ease-in-out;
}

.hamburger.is-closed:hover .hamb-top {
  top: 0;
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-closed:hover .hamb-bottom {
  bottom: 0;
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-middle,
.hamburger.is-open .hamb-bottom {
  background-color: #1a1a1a;
}
.hamburger.is-open .hamb-top,
.hamburger.is-open .hamb-bottom {
  top: 50%;
  margin-top: -2px;  
}
.hamburger.is-open .hamb-top { 
  -webkit-transform: rotate(45deg);
  -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
}
.hamburger.is-open .hamb-middle { display: none; }
.hamburger.is-open .hamb-bottom {
  -webkit-transform: rotate(-45deg);
  -webkit-transition: -webkit-transform .2s cubic-bezier(.73,1,.28,.08);
}
.hamburger.is-open:before {
  content: '';
  display: block;
  width: 100px;
  font-size: 14px;
  color: #fff;
  line-height: 32px;
  text-align: center;
  opacity: 0;
  -webkit-transform: translate3d(0,0,0);
  -webkit-transition: all .35s ease-in-out;
}
.hamburger.is-open:hover:before {
  opacity: 1;
  display: block;
  -webkit-transform: translate3d(-100px,0,0);
  -webkit-transition: all .35s ease-in-out;
}

/*-------------------------------*/
/*            Overlay            */
/*-------------------------------*/

.overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(250,250,250,.8);
    z-index: 1;
}

  body{
    margin-top: -20px;


}


</style>
 

    </head>
    <body>

<!--**********************NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************************** -->
<?php
if($empresa == '001'){
?>


    <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Home Sales
                    </a>
                </li>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 1<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                      <li><a style="display: <?php echo $dropprospects ?>" href="./mailing/lista1.php">LISTA 1</a></li>
                      <li><a style="display: <?php echo $dropproposta ?>" href="./mailing/lista2.php">LISTA 2</a></li>
                      <li><a style="display: <?php echo $acessoSL_login ?>" href="./mailing/lista3.php">LISTA 3</a></li>

                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 2<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                      <li><a style="display: <?php echo $dropce ?>" href="./mailing/leadNET-BR.php">LEAD</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropvend ?>" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header"></li>
                        <li><a href="./vendedor/nova_venda.php">Nova Venda</a></li>
                        <li><a href="./vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                        <li><a href="./vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
                        <li><a href="./vendedor/lista_chamadosVED.php">Chamados Backoffice</a></li>
                        <li><a href="./vendedor/usuario.php">Usuario</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Listas Vendas</li>
                        <li><a href="./backoffice/listavenda-backoffice-tratar.php">NOVAS VENDAS</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-aprovado-execucao.php">APROVADO EXECUÇÃO</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-pendente.php">PENDENTES BACKOFFICE</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-pendente-vendedor.php">PENDENTES VENDEDORES</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-agendado.php">AGENDADOS</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-quebra.php">QUEBRAS</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-instalado.php">INSTALADOS</a></li>
                        <li><a href="./backoffice/listavenda-backoffice-cancelado.php">CANCELADOS</a></li>
                        <li><a href="./backoffice/listavenda-backoffice.php">GERAIS</a></li>
                        <li><a href="./backoffice/lista_chamadosBACK.php">CHAMADOS</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                        <li><a href="./supervisor/con-usuario-lista.php">Usuarios</a></li>
                        <li><a href="./supervisor/useronline.php">Onlines General</a></li>
                        <li><a href="./supervisor/importcvs.php">Importar CSV</a></li>
                        <li><a href="./supervisor/tabulacao-geral.php">Tabulacao Geral</a></li>
                        <li><a href="./supervisor/gerenciador-mailing.php">Gerenciador Mailing</a></li>
                        <li><a href="./supervisor/criacao-produto.php">Criação Produto</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Gerente<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                        <li><a href="./gerente/basemailing.php">Base Mailing</a></li>
                        <li><a href="./gerente/importcsvbase.php">Importar Base (CSV)</a></li>
                    </ul>
                </li>
                <!--**INCLUSÃO DE NOVOS CAMPOS NO MENU (ALMOX, COP, TECNICO, GESTOR) - ROGER** -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">COP<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Almoxarifado<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                    </ul>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Técnico<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Gestor<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="display: <?php echo $dropadm ?>" data-toggle="dropdown">Administrador<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header"></li>
                    </ul>
                </li>

                <li>
                <li class="active ">
                <a style="color: red" href="./login/sair.php">Sair</a>
                </li>
                </li>

                <br/>
                <br/>
                <br/>
                <br/>

                <li>
                <li>
                <li><a><?php echo $empresa?> / <?php echo $nomeUsuario?></a></li>
                <li>
                <li><a><?php echo $funcao?></a></li>
                </li>
            </ul>

        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
        <span class="hamb-bottom"></span>
            </button>

        </div>
        <!-- /#page-content-wrapper -->

    </div>

<?php
}
if($empresa == '002'){
?>


<div id="wrapper">
    <div class="overlay"></div>

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    Home Sales
                </a>
            </li>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 1<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                    <li><a style="display: <?php echo $dropce ?>" href="./mailing/oportunidades.php">OPORTUNIDADES</a></li>
                    <li><a style="display: <?php echo $dropce ?>" href="./mailing/oportunidades2.php">OPORTUNIDADES 2</a></li>
                    <li><a style="display: <?php echo $dropprospects ?>" href="./mailing/prospect.php">PROSPECTS</a></li>
                    <li><a style="display: <?php echo $dropprospects ?>" href="./mailing/prospect2.php">PROSPECTS 2</a></li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 2<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                    <li><a style="display: <?php echo $dropce ?>" href="./mailing/leadNET-BR.php">LEAD</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropvend ?>" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"></li>
                    <li><a href="./vendedor/nova_venda.php">Nova Venda</a></li>
                    <li><a href="./vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                    <li><a href="./vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
                    <li><a href="./vendedor/lista_chamadosVED.php">Chamados Backoffice</a></li>
                    <li><a href="./vendedor/usuario.php">Usuario</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Listas Vendas</li>
                    <li><a href="./backoffice/listavenda-backoffice-tratar.php">NOVAS VENDAS</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-aprovado-execucao.php">APROVADO EXECUÇÃO</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-pendente.php">PENDENTES BACKOFFICE</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-pendente-vendedor.php">PENDENTES VENDEDORES</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-agendado.php">AGENDADOS</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-quebra.php">QUEBRAS</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-instalado.php">INSTALADOS</a></li>
                    <li><a href="./backoffice/listavenda-backoffice-cancelado.php">CANCELADOS</a></li>
                    <li><a href="./backoffice/listavenda-backoffice.php">GERAIS</a></li>
                    <li><a href="./backoffice/lista_chamadosBACK.php">CHAMADOS</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                    <li><a href="./supervisor/con-usuario-lista.php">Usuarios</a></li>
                    <li><a href="./supervisor/useronline.php">Onlines General</a></li>
                    <li><a href="./supervisor/importcvs.php">Importar CSV</a></li>
                    <li><a href="./supervisor/tabulacao-geral.php">Tabulacao Geral</a></li>
                    <li><a href="./supervisor/gerenciador-mailing.php">Gerenciador Mailing</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Gerente<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                    <li><a href="./gerente/basemailing.php">Base Mailing</a></li>
                    <li><a href="./gerente/importcsvbase.php">Importar Base (CSV)</a></li>
                </ul>
            </li>
            <!--**INCLUSÃO DE NOVOS CAMPOS NO MENU (ALMOX, COP, TECNICO, GESTOR) - ROGER** -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">COP<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Almoxarifado<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                </ul>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Técnico<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Gestor<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" style="display: <?php echo $dropadm ?>" data-toggle="dropdown">Administrador<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header"></li>
                </ul>
            </li>

            <li>
            <li class="active ">
                <a style="color: red" href="./login/sair.php">Sair</a>
            </li>
            </li>

            <br/>
            <br/>
            <br/>
            <br/>

            <li>
            <li>
            <li><a><?php echo $empresa?> / <?php echo $nomeUsuario?></a></li>
            <li>
            <li><a><?php echo $funcao?></a></li>
            </li>
        </ul>

    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>

    </div>
    <!-- /#page-content-wrapper -->

</div>

<?php
}
if($empresa == '003'){
?>


    <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Home Sale
                    </a>
                </li>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-header"></li>
                  <li><a href="./vendedor/nova-venda_simplificada.php">Nova Venda</a></li>
                  <li><a href="./vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                  </ul>
                </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                 <li class="dropdown-header">Listas Vendas</li>
                    <li><a href="./backoffice/listavenda-backoffice.php">Vendas GERAIS</a></li>
                  </ul>
               </li>
              <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="./supervisor/con-usuario-lista.php">Usuarios</a></li>
                      <li><a href="./supervisor/useronline.php">Onlines General</a></li>
                      </ul>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $droprela ?>" data-toggle="dropdown">Relatorios<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="./relatorio/relatorio-geral.php">Relatorio Geral</a></li>
                      </ul>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropadm ?>" data-toggle="dropdown">ADM<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="./administrador/listacitrix.php">Lista Logins</a></li>
                      </ul>
                </li>


                <li>
                <li class="active ">
                <a style="color: red" href="./login/sair.php">Sair</a>
                </li>
                </li>

                <br/>
                <br/>
                <br/>
                <br/>

                <li>
                <li>
                <li><a><?php echo $empresa?> / <?php echo $nomeUsuario?></a></li>
                <li>
                <li><a><?php echo $funcao?></a></li>
                </li>
            </ul>

        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
        <span class="hamb-bottom"></span>
            </button>

        </div>
        <!-- /#page-content-wrapper -->

    </div>
<?php
}
?>


    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="display: <?php echo $slide;?>">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      
      <div class="carousel-inner" role="listbox">
        
        <div class="item active">
        <img class="first" style="width: 100%; height: 100%;" src="<?php echo $img1 ?>" alt="first slide">
        </div>
        
        <div class="item">
          <img class="second" style="width: 100%; height: 100%;" src="<?php echo $img2 ?>" alt="Second slide">
        </div>
        
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->



    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 0 //changes the speed
    })
    </script>





</body>


        <!-- jQuery -->
        <script src="./js/jquery-2.2.3.min.js"></script>
        <script src="./js/scripts-geral.js"></script>
        <script src="./css/bootstrap/js/bootstrap.min.js"></script>
        <script src="./css/bootstrap/js/meunavbar2.js"></script>



</html>
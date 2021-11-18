<?php
include_once "../login/verifica.php";

if($empresa == '001'){
  # code...
?>
   <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       HOME SALES
                    </a>
                </li>
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 1<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                      <li><a style="display: <?php echo $dropprospects ?>" href="../mailing/prospect.php">PROSPECTS</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 2<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                      <li><a style="display: <?php echo $dropce ?>" href="../mailing/oportunidades.php">OPORTUNIDADES</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropvend ?>" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-header"></li>
                  <li><a href="../vendedor/nova_venda.php">Nova Venda</a></li>
                  <li><a href="../vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                  <li><a href="../vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
                  <li><a href="../vendedor/lista_chamadosVED.php">Chamados Backoffice</a></li>
                  <li><a href="../vendedor/usuario.php">Usuario</a></li>
                  </ul>
                </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                 <li class="dropdown-header">Listas Vendas</li>
                    <li><a href="../backoffice/listavenda-backoffice-tratar.php">NOVAS VENDAS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-credito.php">CREDITOS APROVADOS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-conexao.php">CONEXÃO</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-pendente.php">PENDENTES BACKOFFICE</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-pendente-vendedor.php">PENDENTES VENDEDORES</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-agendado.php">AGENDADOS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-quebra.php">QUEBRAS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-instalado.php">INSTALADOS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-cancelado.php">CANCELADOS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice.php">GERAIS</a></li>
                    <li><a href="../backoffice/lista_chamadosBACK.php">CHAMADOS</a></li>
                  </ul>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../supervisor/con-usuario-lista.php">Usuarios</a></li>
                      <li><a href="../supervisor/useronline.php">Onlines General</a></li>
                      <li><a href="../supervisor/importcvs.php">Importar CSV</a></li>
                      <li><a href="../supervisor/tabulacao-geral.php">Tabulacao Geral</a></li>
                      <li><a href="../supervisor/gerenciador-mailing.php">Gerenciador Mailing</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropger ?>" data-toggle="dropdown">Gerente<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../gerente/basemailing.php">Base Mailing</a></li>
                       <li><a href="../gerente/importcsvbase.php">Importar Base (CSV)</a></li>
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
                <a style="color: red" href="../login/sair.php">Sair</a>
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
    <!-- /#wrapper -->


<?php
}
?>


<?php
if($empresa == '003'){
?>


    <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       GENERAL SALES
                    </a>
                </li>
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-header"></li>
                  <li><a href="../vendedor/nova-venda_simplificada.php">Nova Venda</a></li>
                  <li><a href="../vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                  </ul>
                </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                 <li class="dropdown-header">Listas Vendas</li>
                    <li><a href="../backoffice/listavenda-backoffice.php">Vendas GERAIS</a></li>
                  </ul>
              </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../supervisor/con-usuario-lista.php">Usuarios</a></li>
                      <li><a href="../supervisor/useronline.php">Onlines General</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $droprela ?>" data-toggle="dropdown">Relatorios<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../relatorio/relatorio-geral.php">Relatorio Geral</a></li>
                      </ul>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropadm ?>" data-toggle="dropdown">ADM<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../administrador/listacitrix.php">Lista Logins</a></li>
                      </ul>
                </li>

                <li>
                <li class="active ">
                <a style="color: red" href="../login/sair.php">Sair</a>
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


<?php
if($empresa == '10'){
?>

   <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       GENERAL SALES
                    </a>
                </li>
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li class="dropdown">
                  <a style="display: <?php echo $menunet ?>"  href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 1<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                      <li><a style="display: <?php echo $dropleadsite ?>" href="../mailing/leadExclusivo.php">EXCLUSIVO</a></li>
                      <li><a style="display: <?php echo $dropprospects ?>" href="../mailing/prospect.php">PROSPECTS</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropvend ?>" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-header"></li>
                  <li><a href="../vendedor/nova_venda.php">Nova Venda</a></li>
                  <li><a href="../vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                  <li><a href="../vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
                  </ul>
                </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <li class="dropdown-header">Listas Vendas</li>
                    <li><a href="../backoffice/listavenda-backoffice-tratar.php">Vendas CONCLUIDAS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-multi.php">Vendas Base MULTI</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-tv.php">Vendas Base TV</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-prospect.php">Vendas Prospects</a></li>
                    <li><a href="../backoffice/listavenda-backoffice.php">Vendas GERAIS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-agendado.php">Vendas AGENDADAS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-instalado.php">Vendas INSTALADAS</a></li>
                  </ul>
              </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../supervisor/tabulacao-geral.php">Tabulacao Geral</a></li>
                      <li><a href="../supervisor/useronline.php">Onlines</a></li>
                      <li><a href="../supervisor/importcvs.php">Importar CSV</a></li>
                      <li><a href="../supervisor/gerenciador-mailing.php">Gerenciador Mailing</a></li>
                      </ul>
                  </li>
                <li>
                <li class="active ">
                <a style="color: red" href="../login/sair.php">Sair</a>
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
    <!-- /#wrapper -->
<?php
}
?>


<?php
if($empresa == '005'){
?>

   <div id="wrapper">
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                       GENERAL SALES
                    </a>
                </li>
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li class="dropdown">
                  <a style="display: <?php echo $menunet ?>"  href="#" class="dropdown-toggle" data-toggle="dropdown">Mailing 1<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header">Mailing</li>
                      <li><a style="display: <?php echo $dropleadsite ?>" href="../mailing/leadExclusivo.php">EXCLUSIVO</a></li>
                      <li><a style="display: <?php echo $dropprospects ?>" href="../mailing/prospect.php">PROSPECTS</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropvend ?>" data-toggle="dropdown">Vendedor <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                  <li class="dropdown-header"></li>
                  <li><a href="../vendedor/nova_venda.php">Nova Venda</a></li>
                  <li><a href="../vendedor/minhas-vendasLista.php">Status Propostas</a></li>
                  <li><a href="../vendedor/minha-agendaRetornos.php">Agenda Retornos</a></li>
                  </ul>
                </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" style="display: <?php echo $dropback ?>" data-toggle="dropdown">Backoffice<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                  <li class="dropdown-header">Listas Vendas</li>
                    <li><a href="../backoffice/listavenda-backoffice-tratar.php">Vendas CONCLUIDAS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-multi.php">Vendas Base MULTI</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-tv.php">Vendas Base TV</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-prospect.php">Vendas Prospects</a></li>
                    <li><a href="../backoffice/listavenda-backoffice.php">Vendas GERAIS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-agendado.php">Vendas AGENDADAS</a></li>
                    <li><a href="../backoffice/listavenda-backoffice-instalado.php">Vendas INSTALADAS</a></li>
                  </ul>
              </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" style="display: <?php echo $dropsup ?>" data-toggle="dropdown">Supervisor<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                      <li class="dropdown-header"></li>
                      <li><a href="../supervisor/tabulacao-geral.php">Tabulacao Geral</a></li>
                      <li><a href="../supervisor/useronline.php">Onlines</a></li>
                      <li><a href="../supervisor/importcvs.php">Importar CSV</a></li>
                      <li><a href="../supervisor/gerenciador-mailing.php">Gerenciador Mailing</a></li>
                      </ul>
                  </li>
                <li>
                <li class="active ">
                <a style="color: red" href="../login/sair.php">Sair</a>
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
    <!-- /#wrapper -->
<?php
}
?>
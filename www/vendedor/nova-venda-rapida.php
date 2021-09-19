<?php
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include_once "../login/online.php";
include_once "../login/visualizarlista.php";

date_default_timezone_set('America/Sao_Paulo');
$dataDia = date('d/m/Y'); // Resultado: 12/03/2009
$horaDia = date('H:i:s'); // Resultado: 03:39:57


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

?>




<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
		<title>General Sales</title>

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
<div class="container">
<!--*************************************FORM *********************************** -->
    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>


<h4><center><strong style="color: green">PROSPECT RESUMIDA</strong></center></h4>


<div class="col-md-10">
<div class="btn-group">
  <button type="button" class="btn btn-xs btn-success active">NOVA VENDA</button>
  <button type="button" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a  href="nova-venda-basemulti.php">BASE MULTI</a></li>
    <li><a  href="nova-venda-basetv.php">BASE TV</a></li>
    <li><a  href="nova_venda.php">PROSPECT COMPLETA</a></li>
    <li><a  href="nova-venda-rapida.php">PROSPECT RESUMIDA</a></li>
    <li><a  href="nova-venda_simplificada.php">PROSPECT SIMPLIFICADA</a></li>
  </ul>
</div>

</div>
<br />
<br />
<br />
<br />


<div id="main" class="form-horizontal">
<form action="nova-venda-rapida-salvar.php" method="POST" enctype="multipart/form-data" class="form-horizontal">



      <!-- Text input-->
      <div class="form-group">


      <label class="col-sm-1 control-label" for="textinput">Solicitante</label>
      <div class="col-sm-3">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" name="nome_contato_cliente" maxlength="50"  class="form-control input-md" id="nome_contato_cliente" autofocus>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Titular*</label>
      <div class="col-sm-7">
      <div class="input-group">
      <input type="text" style="text-transform: uppercase" placeholder="Nome Completo" maxlength="50"  name="nome_cliente" class="form-control input-md" id="nome_cliente" required>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
      </div>
      </div>

      </div>

	    <!-- Text input-->
        <div class="form-group">

           <label class="col-sm-1 control-label" for="textinput">Cidade</label>
            <div class="col-sm-4">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" maxlength="50" class="form-control" required name="cidade_cliente" id="cidade_cliente">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

          <label class="col-sm-1 control-label" for="textinput">UF</label>
          <div class="col-md-2">
          <select name="estado_cliente" class="form-control" required>
          <option value=""></option>
          <option value="AC">AC</option>
          <option value="AL">AL</option>
          <option value="AP">AP</option>
          <option value="AM">AM</option>
          <option value="BA">BA</option>
          <option value="CE">CE</option>
          <option value="DF">DF</option>
          <option value="ES">ES</option>
          <option value="GO">GO</option>
          <option value="MA">MA</option>
          <option value="MT">MT</option>
          <option value="MS">MS</option>
          <option value="MG">MG</option>
          <option value="PA">PA</option>
          <option value="PB">PB</option>
          <option value="PR">PR</option>
          <option value="PE">PE</option>
          <option value="PI">PI</option>
          <option value="RJ">RJ</option>
          <option value="RN">RN</option>
          <option value="RS">RS</option>
          <option value="RO">RO</option>
          <option value="RR">RR</option>
          <option value="SC">SC</option>
          <option value="SP">SP</option>
          <option value="SE">SE</option>
          <option value="TO">TO</option>
          </select>
          </div>


        </div>


      <!-- Text input-->
      <div class="form-group">
      <label class="col-sm-1 control-label" for="textinput">Telefone </label>

      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" class="form-control" name="fone_cliente" id="campoTelefone">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>


      <label class="col-sm-1 control-label" for="textinput">Celular</label>

      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" class="form-control" name="celular_cliente" id="campoCelular">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone"></i></span>
      </div>
      </div>

     <label class="col-sm-1 control-label" for="textinput">Telefone 2</label>

      <div class="col-sm-2">
      <div class="input-group">
      <input type="text" class="form-control" name="fone3_cliente" id="campoTelefone2">
      <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Telefone 3</label>


      <div class="col-sm-2">
      <div class="input-group">
      <input type="text"  class="form-control" name="fone4_cliente" id="campoTelefone3">
       <span class="input-group-addon label_white"><i class="glyphicon glyphicon-phone-alt"></i></span>
      </div>
      </div>



      </div>

      <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput">Codigo</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" name="codigo_cliente" class="form-control input-md" onblur="liberar();" autofocus>
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

          </div>
          </div>

          <label class="col-sm-1 control-label" for="textinput">Login NET</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="text" name="login_net" class="form-control input-md">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>

          </div>
          </div>

          <label  class="col-sm-1 control-label" for="textinput">Data Venda</label>
          <div class="col-sm-3">
          <div class="input-group">
          <input type="date" required maxlength="10" name="data_venda" class="form-control input-md" id="data_venda" value="<?=$dataDia?>">
          <span class="input-group-addon label-white"><i class="glyphicon glyphicon-calendar"></i></span>
          </div>
          </div>
      </div>



      <div class="form-group">

      <label class="col-md-1 control-label" for="selectbasic">TV</label>
      <div class="col-md-5">
      <select id="tv_venda_cliente" name="tv_venda_cliente" class="form-control">
      <option value=""></option>
      <option value="FACIL HD - NET">FACIL HD - NET</option>
      <option value="ESSENCIAL HD - NET">ESSENCIAL HD - NET</option>
      <option value="MAIS HD - NET">MAIS HD - NET</option>
      <option value="TOP HD - NET">TOP HD - NET</option>
      <option value="TOP HD MAX - NET">TOP HD MAX - NET</option>
      <option value="COMPACTO DIGITAL - NET">COMPACTO DIGITAL - NET</option>
      <option value="COMPACTO HD - NET">COMPACTO HD - NET</option>
      <option value="PLUS HD - NET">PLUS HD - NET</option>
      <option value="CORP HD - NET">CORP HD - NET</option>
      <option value="ACESSO VIRTUA - NET">ACESSO VIRTUA - NET</option>
      <option value="CONEXAO DIGITAL - NET">CONEXAO DIGITAL - NET</option>
      <option value="FACIL LIGHT DIGITAL - CLARO">FACIL LIGHT DIGITAL - CLARO</option>
      <option value="LIGHT DIGITAL - CLARO">LIGHT DIGITAL - CLARO</option>
      <option value="MIX DIGITAL - CLARO">MIX DIGITAL - CLARO</option>
      <option value="MIX HD - CLARO">MIX HD - CLARO</option>
      <option value="TOP HD - CLARO">TOP HD - CLARO</option>
      <option value="TOP HD MAX - CLARO">TOP HD MAX - CLARO</option>
      </select>
      </div>

      <label class="col-md-1 control-label" for="selectbasic">Internet</label>
      <div class="col-md-5">
      <select id="internet_venda_cliente" name="internet_venda_cliente" class="form-control">
      <option value=""></option>
      <option value="1 MEGA - NET">1 MEGA - NET</option>
      <option value="2 MEGA - NET">2 MEGA - NET</option>
      <option value="15 MEGA - NET">15 MEGA - NET</option>
      <option value="30 MEGA - NET">30 MEGA - NET</option>
      <option value="60 MEGA - NET">60 MEGA - NET</option>
      <option value="120 MEGA - NET">120 MEGA - NET</option>
      <option value="1 MEGA-PME IP FIXO - NET">1 MEGA-PME IP FIXO - NET</option>
      <option value="10 MEGA-PME IP FIXO - NET">10 MEGA-PME IP FIXO - NET</option>
      <option value="10 MEGA-PME - NET">10 MEGA-PME - NET</option>
      <option value="20 MEGA-PME - NET">20 MEGA-PME - NET</option>
      <option value="30 MEGA-PME - NET">30 MEGA-PME - NET</option>
      <option value="60 MEGA-PME - NET">60 MEGA-PME - NET</option>
      <option value="120 MEGA-PME - NET">120 MEGA-PME - NET</option>
      <option value="INTERNET 20GB - CLARO">INTERNET 20GB - CLARO</option>
      <option value="INTERNET 40GB - CLARO">INTERNET 40GB - CLARO</option>
      </select>

      </div>


      </div>

      <div class="form-group">

      <label class="col-md-1 control-label" for="selectbasic">Telefonia</label>
      <div class="col-md-5">
      <select id="netfone_venda_cliente" name="netfone_venda_cliente" class="form-control">
      <option value=""></option>
      <option value="NETFONE ILIM. NET - NET">NETFONE ILIM. NET- NET</option>
      <option value="ILIMITADO LOCAL - NET">ILIMITADO LOCAL - NET</option>
      <option value="ILIMITADO BRASIL 21 - NET">ILIMITADO BRASIL 21 - NET</option>
      <option value="ILIMITADO MUNDO 21 - NET">ILIMITADO MUNDO 21 - NET</option>
      <option value="ECONOMICO 2 LINHAS C/PORT - NET">ECONOMICO 2 LINHAS C/PORT - NET</option>
      <option value="ECONOMICO 2 LINHAS S/PORT - NET">ECONOMICO 2 LINHAS S/PORT - NET</option>
      <option value="ECONOMICO 4 LINHAS - NET">ECONOMICO 4 LINHAS - NET</option>
      <option value="ECONOMICO 8 LINHAS - NET">ECONOMICO 8 LINHAS - NET</option>
      <option value="ILIMITADO 1 LINHA - NET">ILIMITADO 1 LINHA - NET</option>
      <option value="ILIMITADO 2 LINHAS - NET">ILIMITADO 2 LINHAS - NET</option>
      <option value="ILIMITADO 4 LINHAS - NET">ILIMITADO 4 LINHAS - NET</option>
      <option value="ILIMITADO 8 LINHAS - NET">ILIMITADO 8 LINHAS - NET</option>
      <option value="FONE ILIMITADO LOCAL - CLARO">FONE ILIMITADO LOCAL - CLARO</option>
      <option value="FONE ILIMITADO BRASIL 21 - CLARO">FONE ILIMITADO BRASIL 21 - CLARO</option>
      <option value="FONE ILIMITADO MUNDO - CLARO">FONE ILIMITADO MUNDO - CLARO</option>
      </select>
      </div>

      <label class="col-md-1 control-label" for="selectbasic">Celular</label>
      <div class="col-md-5">
      <select id="netcelular_venda_cliente" name="netcelular_venda_cliente" class="form-control">
      <option value=""></option>
      <option value="Controle Turbo 1.4GB">Controle Turbo 1.4GB</option>
      <option value="Controle Turbo 2GB">Controle Turbo 2GB</option>
      <option value="2GB + 150 Min.">2GB + 150 Min.</option>
      <option value="3GB + 200 Min.">3GB + 200 Min.</option>
      <option value="4GB + 300 Min.">4GB + 300 Min.</option>
      <option value="5GB + 500 Min.">5GB + 500 Min.</option>
      <option value="7GB + 700 Min.">7GB + 700 Min.</option>
      <option value="9GB + 1200 Min.">9GB + 1200 Min.</option>
      <option value="15GB + 2200 Min.">15GB + 2200 Min.</option>
      <option value="20 GB + 3200 Min.">20 GB + 3200 Min.</option>

      <option value="2GB + 150 Min. C/ APA">2GB + 150 Min. C/ APA.</option>
      <option value="3GB + 200 Min. C/ APA">3GB + 200 Min. C/ APA</option>
      <option value="4GB + 300 Min. C/ APA">4GB + 300 Min. C/ APA</option>
      <option value="5GB + 500 Min. C/ APA">5GB + 500 Min. C/ APA</option>
      <option value="7GB + 700 Min. C/ APA">7GB + 700 Min. C/ APA</option>
      <option value="9GB + 1200 Min. C/ APA">9GB + 1200 Min. C/ APA</option>
      <option value="15GB + 2200 Min. C/ APA">15GB + 2200 Min. C/ APA</option>
      <option value="20 GB + 3200 Min. C/ APA">20 GB + 3200 Min. C/ APA</option>
      </select>
      </div>
      </div>

      <div class="form-group">

      <label class="col-md-1 control-label" for="selectbasic">N.Combo*</label>
      <div class="col-md-2">
      <select id="numPacote_venda_cliente" name="numPacote_venda_cliente" class="form-control" required>
      <option value="">SELECIONE</option>
      <option value="NAO">  NAO SE APLICA </option>
      <option value="600">  600 </option>
      <option value="630">  630 </option>
      <option value="660">  660 </option>
      <option value="661">  661 </option>
      <option value="663">  663 </option>
      <option value="665">  665 </option>
      <option value="666">  666 </option>
      <option value="667">  667 </option>
      <option value="669">  669 </option>
      <option value="671">  671 </option>
      <option value="672">  672 </option>
      <option value="673">  673 </option>
      <option value="675">  675 </option>
      <option value="677">  677 </option>
      <option value="701">  701 </option>
      <option value="1140">  1140  </option>
      <option value="1150">  1150  </option>
      <option value="1151">  1151  </option>
      <option value="1152">  1152  </option>
      <option value="1153">  1153  </option>
      <option value="1154">  1154  </option>
      <option value="1171">  1171  </option>
      <option value="1173">  1173  </option>
      <option value="1175">  1175  </option>
      <option value="1224">  1224  </option>
      <option value="1225">  1225  </option>
      <option value="1226">  1226  </option>
      <option value="1227">  1227  </option>
      <option value="1228">  1228  </option>
      <option value="1229">  1229  </option>
      <option value="1230">  1230  </option>
      <option value="1231">  1231  </option>
      <option value="1232">  1232  </option>
      <option value="1233">  1233  </option>
      <option value="1234">  1234  </option>
      <option value="1235">  1235  </option>
      <option value="1236">  1236  </option>
      <option value="1237">  1237  </option>
      <option value="1238">  1238  </option>
      <option value="1239">  1239  </option>
      <option value="1240">  1240  </option>
      <option value="1241">  1241  </option>
      <option value="1242">  1242  </option>
      <option value="1243">  1243  </option>
      <option value="1244">  1244  </option>
      <option value="1245">  1245  </option>
      <option value="1246">  1246  </option>
      <option value="1247">  1247  </option>
      <option value="1248">  1248  </option>
      <option value="1249">  1249  </option>
      <option value="1250">  1250  </option>
      <option value="1251">  1251  </option>
      <option value="1252">  1252  </option>
      <option value="1253">  1253  </option>
      <option value="1254">  1254  </option>
      <option value="1255">  1255  </option>
      <option value="1256">  1256  </option>
      <option value="1257">  1257  </option>
      <option value="1258">  1258  </option>
      <option value="1259">  1259  </option>
      <option value="1260">  1260  </option>
      <option value="1261">  1261  </option>
      <option value="1262">  1262  </option>
      <option value="1263">  1263  </option>
      <option value="1264">  1264  </option>
      <option value="1265">  1265  </option>
      <option value="1266">  1266  </option>
      <option value="1267">  1267  </option>
      <option value="1268">  1268  </option>
      <option value="1269">  1269  </option>
      <option value="1270">  1270  </option>
      <option value="1271">  1271  </option>
      <option value="1272">  1272  </option>
      <option value="1273">  1273  </option>
      <option value="1274">  1274  </option>
      <option value="1275">  1275  </option>
      <option value="1276">  1276  </option>
      <option value="1277">  1277  </option>
      <option value="1278">  1278  </option>
      <option value="1279">  1279  </option>
      <option value="1280">  1280  </option>
      <option value="1281">  1281  </option>
      <option value="1282">  1282  </option>
      <option value="1283">  1283  </option>
      <option value="1284">  1284  </option>
      <option value="1285">  1285  </option>
      <option value="1286">  1286  </option>
      <option value="1287">  1287  </option>
      <option value="1288">  1288  </option>
      <option value="1289">  1289  </option>
      <option value="1290">  1290  </option>
      <option value="1291">  1291  </option>
      <option value="1292">  1292  </option>
      <option value="1293">  1293  </option>
      <option value="1294">  1294  </option>
      <option value="1295">  1295  </option>
      <option value="1486">  1486  </option>
      <option value="1487">  1487  </option>
      <option value="1488">  1488  </option>
      <option value="1489">  1489  </option>
      <option value="1490">  1490  </option>
      <option value="1491">  1491  </option>
      <option value="1492">  1492  </option>
      <option value="1493">  1493  </option>
      <option value="1494">  1494  </option>
      <option value="1495">  1495  </option>
      <option value="1496">  1496  </option>
      <option value="1497">  1497  </option>
      <option value="1498">  1498  </option>
      <option value="1499">  1499  </option>
      <option value="1500">  1500  </option>
      <option value="1501">  1501  </option>
      <option value="1502">  1502  </option>
      <option value="1503">  1503  </option>
      <option value="1504">  1504  </option>
      <option value="1505">  1505  </option>
      <option value="1506">  1506  </option>
      <option value="1507">  1507  </option>
      <option value="1508">  1508  </option>
      <option value="1540">  1540  </option>
      <option value="1541">  1541  </option>
      <option value="1542">  1542  </option>
      <option value="1543">  1543  </option>
      <option value="1544">  1544  </option>
      <option value="1545">  1545  </option>
      <option value="1546">  1546  </option>
      <option value="1547">  1547  </option>
      <option value="1548">  1548  </option>
      <option value="1549">  1549  </option>
      <option value="1550">  1550  </option>
      <option value="1551">  1551  </option>
      <option value="1552">  1552  </option>
      <option value="1553">  1553  </option>
      <option value="1554">  1554  </option>
      <option value="1555">  1555  </option>
      <option value="1556">  1556  </option>
      <option value="1557">  1557  </option>
      <option value="1558">  1558  </option>
      <option value="1559">  1559  </option>
      <option value="1560">  1560  </option>
      <option value="1561">  1561  </option>
      <option value="1562">  1562  </option>
      <option value="1563">  1563  </option>
      <option value="1564">  1564  </option>
      <option value="1565">  1565  </option>
      <option value="1566">  1566  </option>
      <option value="1567">  1567  </option>
      <option value="1568">  1568  </option>
      <option value="1569">  1569  </option>
      <option value="1570">  1570  </option>
      <option value="1571">  1571  </option>
      <option value="1572">  1572  </option>
      <option value="1573">  1573  </option>
      <option value="1574">  1574  </option>
      <option value="1575">  1575  </option>
      <option value="1700">  1700  </option>
      <option value="1701">  1701  </option>
      <option value="1702">  1702  </option>
      <option value="1703">  1703  </option>
      <option value="1704">  1704  </option>
      <option value="1705">  1705  </option>
      <option value="1706">  1706  </option>
      <option value="1707">  1707  </option>
      <option value="1708">  1708  </option>
      <option value="1709">  1709  </option>
      <option value="1710">  1710  </option>
      <option value="1711">  1711  </option>
      <option value="1712">  1712  </option>
      <option value="1713">  1713  </option>
      <option value="1714">  1714  </option>
      <option value="1715">  1715  </option>
      <option value="1716">  1716  </option>
      <option value="1717">  1717  </option>
      <option value="1718">  1718  </option>
      <option value="1719">  1719  </option>
      <option value="1720">  1720  </option>
      <option value="1721">  1721  </option>
      <option value="1722">  1722  </option>
      <option value="1723">  1723  </option>
      <option value="1724">  1724  </option>
      <option value="1725">  1725  </option>
      <option value="1726">  1726  </option>
      <option value="1727">  1727  </option>
      <option value="1728">  1728  </option>
      <option value="1729">  1729  </option>
      <option value="1730">  1730  </option>
      <option value="1731">  1731  </option>
      <option value="1732">  1732  </option>
      <option value="1733">  1733  </option>
      <option value="1734">  1734  </option>
      <option value="1735">  1735  </option>
      <option value="1736">  1736  </option>
      <option value="1737">  1737  </option>
      <option value="1738">  1738  </option>
      <option value="1739">  1739  </option>
      <option value="1740">  1740  </option>
      <option value="1741">  1741  </option>
      <option value="1742">  1742  </option>
      <option value="1743">  1743  </option>
      <option value="1744">  1744  </option>
      <option value="1745">  1745  </option>
      <option value="1746">  1746  </option>
      <option value="1747">  1747  </option>
      <option value="1748">  1748  </option>
      <option value="1749">  1749  </option>
      <option value="1750">  1750  </option>
      <option value="1751">  1751  </option>
      <option value="1752">  1752  </option>
      <option value="1753">  1753  </option>
      <option value="1754">  1754  </option>
      <option value="1755">  1755  </option>
      <option value="1756">  1756  </option>
      <option value="1757">  1757  </option>
      <option value="1758">  1758  </option>
      <option value="1759">  1759  </option>
      <option value="1760">  1760  </option>
      <option value="1761">  1761  </option>
      <option value="1762">  1762  </option>
      <option value="1763">  1763  </option>
      <option value="1764">  1764  </option>
      <option value="1765">  1765  </option>
      <option value="1766">  1766  </option>
      <option value="1767">  1767  </option>
      <option value="1768">  1768  </option>
      <option value="1769">  1769  </option>
      <option value="1770">  1770  </option>
      <option value="1771">  1771  </option>
      <option value="1772">  1772  </option>
      <option value="1773">  1773  </option>
      <option value="1774">  1774  </option>
      <option value="1775">  1775  </option>
      <option value="1776">  1776  </option>
      <option value="1777">  1777  </option>
      <option value="1778">  1778  </option>
      <option value="1779">  1779  </option>
      <option value="1780">  1780  </option>
      <option value="1781">  1781  </option>
      <option value="1782">  1782  </option>
      <option value="1783">  1783  </option>
      <option value="1801">  1801  </option>
      <option value="1802">  1802  </option>
      <option value="1803">  1803  </option>
      <option value="1804">  1804  </option>
      <option value="1805">  1805  </option>
      <option value="1806">  1806  </option>
      <option value="1807">  1807  </option>
      <option value="1808">  1808  </option>
      <option value="1809">  1809  </option>
      <option value="1810">  1810  </option>
      <option value="1811">  1811  </option>
      <option value="1812">  1812  </option>
      <option value="1813">  1813  </option>
      <option value="1814">  1814  </option>
      <option value="1815">  1815  </option>
      <option value="1816">  1816  </option>
      <option value="1817">  1817  </option>
      <option value="1818">  1818  </option>
      <option value="1819">  1819  </option>
      <option value="1820">  1820  </option>
      <option value="1821">  1821  </option>
      <option value="1822">  1822  </option>
      <option value="1823">  1823  </option>
      <option value="1824">  1824  </option>
      <option value="PTV">  PTV  </option>
      <option value="PTV+VIRTUA">  PTV+VIRTUA </option>
      <option value="PTV+VIRTUA+FONE">  PTV+VIRTUA+FONE  </option>
      <option value="PTV+FONE">  PTV+FONE </option>
      <option value="VIRTUA+FONE">  VIRTUA+FONE</option>
      <option value="PME">  PME  </option>
      </select>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Pag.*</label>
      <div class="col-sm-3">
      <select id="select" required name="formaPagemento_cliente" class="form-control">
      <option value=""></option>
      <option value="BOLETO">BOLETO</option>
      <option value="DCC">DCC</option>
      <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
      </select>
      </div>

      <label class="col-sm-1 control-label" for="textinput">Venc.</label>
      <div class="col-sm-1">
     <select id="vencimentoPagamento_cliente" name="vencimentoPagamento_cliente" class="form-control">
      <option value=""></option>
      <option value="5">5</option>
      <option value="8">8</option>
      <option value="10">10</option>
      <option value="15">15</option>
      <option value="20">20</option>
      <option value="25">25</option>
      </select>
      </div>

            <label class="col-sm-1 control-label" for="textinput">Servico</label>
      <div class="col-sm-2">
      <div class="input-group">
      <select id="tipo_servico" required name="tipo_servico" class="form-control">
      <option value=""></option>
      <option value="NET"> NET</option>
      <option value="CLARO"> CLARO </option>
      </select>
      <span class="input-group-addon label-white"><i class="glyphicon glyphicon-briefcase"></i></span>
      </div>
      </div>

      </div>

      <div class="form-group">
          <div id='mestre'>
          
          <div id='DCC'>
          
          <label style="width: 400px;" class="col-md-1 control-label" for="selectbasic">Banco</label>
          <input type="text"  class="col-md-1" id="pagamentoBanco_cliente" name="pagamentoBanco_cliente" class="form-control input-md" maxlength="30">

          <label class="col-md-1 control-label" for="selectbasic">Agencia</label>
          <input type="text"  class="col-md-1" id="pagamentoAgencia_cliente" name="pagamentoAgencia_cliente" class="form-control input-md" maxlength="10">
          
          <label class="col-md-1 control-label" for="selectbasic">Conta</label>
          <input type="text"  class="col-md-1"  id="pagamentoConta_cliente" name="pagamentoConta_cliente" class="form-control input-md" maxlength="20">
          </div>


          </div>
      </div>


          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-3">
          <label for="selectbasic">Anexar audio:</label>
          <input type="file" id="audio_multisales" name="audio_multisales">
          </div>
          </div>

          
          <div class="form-group">
          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 1:</label>
          <input type="file" id="img_multisales" name="img_multisales">
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 2:</label>
          <input type="file" id="img_multisales2" name="img_multisales2">
          </div>




          <label class="col-sm-1 control-label" for="textinput"></label>
          <div class="col-md-2">
          <label for="selectbasic">Anexar imagem 3:</label>
          <input type="file" id="img_multisales3" name="img_multisales3">
          </div>

          </div>


				<!-- Textarea -->
			<div class="form-group">
			<label  class="col-sm-1 control-label" for="textinput">Observacao</label>
		    	<div class="col-sm-11">
				<div class="input-group">
			  <?php 
			  echo '<textarea rows="2" maxlength="200" text-transform: uppercase" name="observacao_venda_cliente" id="observacao_venda_cliente" class="form-control">' . '</textarea>';
			   ?>
			   <span class="input-group-addon bg-white"><i class="glyphicon glyphicon-pencil"></i></span>
			  </div>
			  </div>
			</div>

		 <input type="text" style="display: none" name="nomeUsuario" class="form-control input-md" id="nomeUsuario" value="<?=$nomeUsuario?>">

     <input type="text" style="display: none" name="nomeEquipe" class="form-control input-md" id="nomeEquipe" value="<?=$nomeEquipe?>">

     <input type="text" style="display: none" name="nomeEmpresa" class="form-control input-md" id="nomeEmpresa" value="<?=$nomePrestadora?>">

     <input type="text" style="display: none" name="hora_venda" class="form-control input-md" id="hora_venda" value="<?=$horaDia?>">

     <input type="text" style="display: none" name="lista_sistema" class="form-control input-md" id="lista_sistema" value="RESUMIDA">

     <input type="text" style="display: none" name="motivo_cliente" class="form-control input-md" id="motivo_cliente" value="VENDA - NOVO CLIENTE">

     <input type="text" style="display: none" name="statusPedido_venda_cliente" class="form-control input-md" id="statusPedido_venda_cliente" value="CADASTRO-CONCLUIDO">



				<!-- Button trigger modal -->
        <div class="form-group">
          <label class="col-md-9 control-label" for="button1id"></label>
            <div class="col-md-3">
            <button type="submit" name="form1" class="btn btn-block btn-success active">Salvar</button>
          </div>
        </div>

			<!-- Modal -->



</form>
</div>
</div>
</body>
    <!-- jQuery -->
      <script src="../js/jquery-2.2.3.min.js"></script>
      <script src="../js/scripts-geral.js"></script>
      <script src="../css/bootstrap/js/bootstrap.min.js"></script>
      <script src="../js/jquery.maskedinput.js"></script>
      <script src="../js/funcao-maske.js"></script>
      <script src="../js/jquery.maskedinput.min.js"></script>
      <script src="../js/funcao-maskemoney.js"></script>
      <script src="../css/bootstrap/js/meunavbar2.js"></script>


<script type="text/javascript">

function liberar()
{
  var codigo = document.getElementById("codigo"); 
  var pendente= document.getElementById("pendente");
  var concluido= document.getElementById("concluido");

  if(codigo.value != "")
  {
    concluido.disabled=false;
  }

  if(codigo.value != "")
  {
    pendente.disabled=true;
  }

  if(codigo.value == "")
  {
    concluido.disabled=true;
  }

  if(codigo.value == "")
  {
    pendente.disabled=false;
  }
}
</script>
</html>


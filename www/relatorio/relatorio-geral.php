<?php
ob_start();
session_start();
include_once "../funcoes/conexaoPortari.php";
include_once "../login/verifica.php";
include_once "../login/online.php";
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


if ($nomeEquipe == 'GERAL') {
  $sqlequipe = '';
}else{
  $sqlequipe = "AND nomeEquipe = '". $nomeEquipe . "'";
}

if ($nomePrestadora == 'GERAL') {
  $sqlempresa = '';
}else{
  $sqlempresa = "AND nomeEmpresa = '". $nomePrestadora . "'";
}


if ($nivel != 1) {

if ($_POST['diaGrafico'] == '') {

$novodt = strftime('%d de %b de %Y', strtotime('today'));

$stringSql = "SELECT date_format(data_venda,'%d')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY data_venda";

$resultado = mysqli_query($linkComMysql, $stringSql);

$clientes = array();
while ($cliente = mysqli_fetch_assoc($resultado)) {
   extract($cliente);
   $json[] = $cliente['data_venda'];
   $json2[] = (int)$cliente['qtde'];
}


$stringSqlMes = "SELECT date_format(data_venda,'%m')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY MONTH(data_venda)";


$resultadoMes = mysqli_query($linkComMysql, $stringSqlMes);

$vendasMes = array();
while ($vendaMes = mysqli_fetch_assoc($resultadoMes)) {
   extract($vendaMes);
   $jsonMes[]  = $vendaMes['data_venda'];
   $jsonMesQtd[] = (int)$vendaMes['qtde'];
}

$stringSqlDia = "SELECT statusVenda_venda_cliente, date_format(data_venda,'%d')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (DAY(data_venda)) = DAY(NOW()) AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY statusVenda_venda_cliente";


$resultadoDia = mysqli_query($linkComMysql, $stringSqlDia);

$vendasDia = array();
while ($vendaDia = mysqli_fetch_assoc($resultadoDia)) {
   extract($vendaDia);
   $jsonDia[]  = $vendaDia['data_venda'];
   $jsonDiaQtd[] = (int)$vendaDia['qtde'];
   $jsonStatus[] = $vendaDia['statusVenda_venda_cliente'];
   $jsonStatusQtd[] = $vendaDia['statusVenda_venda_cliente'] . "-" . $vendaDia['qtde'];
  //exit;
}

$stringSqlEmpresaMes = "SELECT nomeEmpresa, date_format(data_venda,'%m')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY nomeEmpresa";


$resultadoMesEmpresa = mysqli_query($linkComMysql, $stringSqlEmpresaMes);

$vendasMesEmpresa = array();
while ($vendaMesEmpresa = mysqli_fetch_assoc($resultadoMesEmpresa)) {
   extract($vendaMesEmpresa);
   $jsonMesEmpresaQtd[] = (int)$vendaMesEmpresa['qtde'];
   $jsonStatusMesEmpresa[] = $vendaMesEmpresa['nomeEmpresa'];
}

$stringSqlEmpresaLogin = "SELECT login_net, date_format(data_venda,'%m')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY login_net";


$resultadoMesEmpresaLogin = mysqli_query($linkComMysql, $stringSqlEmpresaLogin);

$vendasMesEmpresaLogin = array();
while ($vendaMesEmpresaLogin = mysqli_fetch_assoc($resultadoMesEmpresaLogin)) {
   extract($vendaMesEmpresaLogin);
   $jsonMesEmpresaLoginQtd[] = (int)$vendaMesEmpresaLogin['qtde'];
   $jsonStatusMesEmpresaLogin[] = $vendaMesEmpresaLogin['login_net'];
}


}else{

$dt = strftime(' de %b de %Y', strtotime('today'));
$novodt = $_POST['diaGrafico'] . $dt;

$stringSql = "SELECT date_format(data_venda,'%d')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY data_venda";


$resultado = mysqli_query($linkComMysql, $stringSql);

$clientes = array();
while ($cliente = mysqli_fetch_assoc($resultado)) {
   extract($cliente);
   $json[] = $cliente['data_venda'];
   $json2[] = (int)$cliente['qtde'];
}


$stringSqlMes = "SELECT date_format(data_venda,'%m')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY MONTH(data_venda)";


$resultadoMes = mysqli_query($linkComMysql, $stringSqlMes);

$vendasMes = array();
while ($vendaMes = mysqli_fetch_assoc($resultadoMes)) {
   extract($vendaMes);
   $jsonMes[]  = $vendaMes['data_venda'];
   $jsonMesQtd[] = (int)$vendaMes['qtde'];
}

$stringSqlDia = "SELECT statusVenda_venda_cliente, date_format(data_venda,'%d')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (DAY(data_venda)) = {$_POST['diaGrafico']} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY statusVenda_venda_cliente";

$resultadoDia = mysqli_query($linkComMysql, $stringSqlDia);

$vendasDia = array();
while ($vendaDia = mysqli_fetch_assoc($resultadoDia)) {
   extract($vendaDia);
   $jsonDia[]  = $vendaDia['data_venda'];
   $jsonDiaQtd[] = (int)$vendaDia['qtde'];
   $jsonStatus[] = $vendaDia['statusVenda_venda_cliente'];
}

$stringSqlEmpresaMes = "SELECT nomeEmpresa, date_format(data_venda,'%m')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY nomeEmpresa";


$resultadoMesEmpresa = mysqli_query($linkComMysql, $stringSqlEmpresaMes);

$vendasMesEmpresa = array();
while ($vendaMesEmpresa = mysqli_fetch_assoc($resultadoMesEmpresa)) {
   extract($vendaMesEmpresa);
   $jsonMesEmpresaQtd[] = (int)$vendaMesEmpresa['qtde'];
   $jsonStatusMesEmpresa[] = $vendaMesEmpresa['nomeEmpresa'];
}

$stringSqlEmpresaLogin = "SELECT login_net, date_format(data_venda,'%m')as data_venda, COUNT(*) qtde FROM clientes WHERE statusVenda_venda_cliente <> '' {$sqlequipe} {$sqlempresa} AND (MONTH(data_venda)) = MONTH(NOW()) AND (YEAR(data_venda)) = YEAR(NOW()) GROUP BY login_net";


$resultadoMesEmpresaLogin = mysqli_query($linkComMysql, $stringSqlEmpresaLogin);

$vendasMesEmpresaLogin = array();
while ($vendaMesEmpresaLogin = mysqli_fetch_assoc($resultadoMesEmpresaLogin)) {
   extract($vendaMesEmpresaLogin);
   $jsonMesEmpresaLoginQtd[] = (int)$vendaMesEmpresaLogin['qtde'];
   $jsonStatusMesEmpresaLogin[] = $vendaMesEmpresaLogin['login_net'];
}

}

/*
foreach ($clientes as $key => $cliente) {

$diagrafico = $cliente ['data_venda'] . ",";
$quantidade = $cliente ['qtde'] . ",";
echo $quantidade;
//exit;
}
*/
}else{
 $vergrafico = 'none';
 //echo $vergrafico;
// exit;
}

?>

<!DOCTYPE html>
<html lang="PT">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>General Sales</title>
  <!-- Bootstrap core CSS-->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap/css/css-geral.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar/meunavbar.css">
  <!-- Custom styles for this template-->
</head>

<body>
 

  <!-- Navigation-->
<?php include_once "../css/navbar/meunavbar.php"; ?>


  <div class="">
    <div class="container">
      
      <!-- Example DataTables Card-->
      <div class="col-sm-12" style="display: <?php echo $vergrafico;?>">
            <div class="form-row">

            <div class="col-sm-6"><canvas id="myChart2" width="50" height="50"></canvas></div>

            <div class="col-sm-6"><canvas id="myChart3" width="50" height="50"></canvas></div>


            </div>


            <div class="form-row">

            <div class="col-sm-6 "><canvas id="myChart" width="50" height="50"></canvas></div>

            <div class="col-sm-6"><canvas id="barraEmpresaMes" width="50" height="50"></canvas></div>

            </div>

            <div class="form-row">

            <div class="col-sm-12"><canvas id="barralogins" width="50" height="50"></canvas></div>


            </div>


            <strong style="color: blue" class="pull-right">Total de Vendas do Dia: <?php echo array_sum($jsonDiaQtd);?></strong>

            <form action="relatorio-geral.php" method="POST">
            <div class="form-group">
                    <div class="col-sm-3">
                      <select name="diaGrafico" class="form-control">
                      <option>Dias</option>
                      <option value="01">01</option>
                      <option value="02">02</option>
                      <option value="03">03</option>
                      <option value="04">04</option>
                      <option value="05">05</option>
                      <option value="06">06</option>
                      <option value="07">07</option>
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                      </select>
                  </div>
            <button class="btn btn-sm btn-info" type="submit">Alterar</button>
            </div>
            </form>


          <div><strong style="color: red">-> Data do Relatorio: <?php echo $novodt;?></strong></div>
        <br/>
      </div>
    </div>
    <!-- /.container-fluid-->

    <!-- Bootstrap core JavaScript-->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../chart/Chart.min.js"></script>
    <script src="../chart/utils.js"></script>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($jsonMes); ?>,
        datasets: [
        {
            label: 'VENDAS',
            data: <?php echo json_encode($jsonMesQtd); ?>,
            borderWidth: 5,
            borderColor: 'rgba(77, 166, 253, 0.85)',
            backgroundColor: 'transparent',

        },
        {

            label: 'META',
            data: [89, 168, 229, 295, 571, 1252, 1305, 1500],
            borderWidth: 5,
            borderColor: 'rgba(255,99,132,1)',
            backgroundColor: 'transparent',

        },

      ]

    },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'VENDAS BRUTAS MENSAIS - 2018'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Mes'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Vendas Brutas'
            }
          }]
        }
      }
});

</script>

<script>

var ctx = document.getElementById("myChart2").getContext('2d');
var myChart2 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($json); ?>,
        datasets: [
        {
            label: 'VENDAS',
            data: <?php echo json_encode($json2); ?>,
            backgroundColor: 'rgba(94, 172, 255, 0.8)',
            borderColor: 'rgba(94, 172, 255, 1)',
            borderWidth: 1
        },
    ]

  },
       options: {
        responsive: true,
        title: {
          display: true,
          text: 'VENDAS GERAIS DIA'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Dia'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Vendas'
            }
          }]
        }
      }


});
</script>

<script>

var ctx = document.getElementById("myChart3").getContext('2d');
var myChart3 = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: <?php echo json_encode($jsonStatus);?> ,
        datasets: [
        {
            label: 'VENDAS GERAIS DIA',
            data: <?php echo json_encode($jsonDiaQtd); ?>,
            backgroundColor: [
                'rgba(94, 182, 207, 0.9)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(0, 139, 139, 0.9)'
            ],
            borderColor: [
                'rgba(94, 182, 207, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0 , 139, 139, 1)'
            ],
            borderWidth: 2
        },
    ]

  },

   options: {
        responsive: true,
        title: {
          display: true,
          text: 'STATUS VENDAS - DIA'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        date: {
         display: true,
        },
      }

});
</script>

<script>

var ctx = document.getElementById("barraEmpresaMes").getContext('2d');
var barraEmpresaMes = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($jsonStatusMesEmpresa);?> ,
        datasets: [
        {
            label: 'VENDAS EMPRESA MES',
            data: <?php echo json_encode($jsonMesEmpresaQtd); ?>,
            backgroundColor: [
                'rgba(78, 136, 65, 0.6)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(0, 139, 139, 0.9)'
            ],
            borderColor: [
                'rgba(78, 136, 65, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0 , 139, 139, 1)'
            ],
            borderWidth: 2
        },
    ]

  },

       options: {
        responsive: true,
        title: {
          display: true,
          text: 'VENDAS EQUIPE DIA'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Dia'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Vendas'
            }
          }]
        }
      }

});
</script>


<script>

var ctx = document.getElementById("barralogins").getContext('2d');
var barralogins = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($jsonStatusMesEmpresaLogin);?> ,
        datasets: [
        {
            label: 'VENDAS LOGINS EMPRESAS - MES',
            data: <?php echo json_encode($jsonMesEmpresaLoginQtd); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
                'rgba(153, 102, 255, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(0, 139, 139, 0.8)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(0, 139, 139, 1)'
            ],
            borderWidth: 2
        },
    ]

  },

       options: {
        responsive: true,
        title: {
          display: true,
          text: 'VENDAS EQUIPE DIA'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Vendas'
            }
          }],
        }
      }

});
</script>

<script>

    // Define a plugin to provide data labels
    Chart.plugins.register({
      afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function(dataset, i) {
          var meta = chart.getDatasetMeta(i);
          if (!meta.hidden) {
            meta.data.forEach(function(element, index) {
              // Draw the text in black, with the specified font
              ctx.fillStyle = 'rgb(0, 0, 0)';

              var fontSize = 12;
              var fontStyle = 'normal';
              var fontFamily = '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol';
              ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

              // Just naively convert to string for now
              var dataString = dataset.data[index].toString();

              // Make sure alignment settings are correct
              ctx.textAlign = 'center';
              ctx.textBaseline = 'middle';

              var padding = 5;
              var position = element.tooltipPosition();
              ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
            });
          }
        });
      }
    });


</script>

  </div>
</body>
</html>

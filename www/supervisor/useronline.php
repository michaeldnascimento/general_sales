<?php
//iniciar uma sessão
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";


if($nivel == 3 OR $nivel == 4 OR $nivel == 5){


$mensagem = "";



//isset = se existe tal coisa 
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];

//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}


include_once '../funcoes/conexaoPortari.php';



/******************************Buscar os clientes - paginacao**************************/


$stringSql = "SELECT id_online, usuario_online, ip_online, date_format(tempo_online,'%T')as tempo_online, date_format(tempo_online,'%d/%m/%Y')as data_online FROM online ORDER BY id_online";


//echo $stringSql . "<br><br>";
//exit;

//mando execultar a query no banco de dados
$resultado = mysqli_query($linkComMysql, $stringSql);

//se eu quiser saber - pego a quantidade de contatos/linhas retornadas na busca
$qtdClientes = mysqli_num_rows($resultado);


$clientes = array();


while ($cliente = mysqli_fetch_assoc($resultado)) {
	$clientes[] = array(
	'id' 		  		       => $cliente ['id_online'],
	'nomeuser'  	       => $cliente ['usuario_online'],
	'ip'  	             => $cliente ['ip_online'],
	'tempo'  	           => $cliente ['tempo_online'],
  'data'               => $cliente ['data_online'],
	);
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
		<title>General Sales</title>


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



<h2><center><strong>Online</strong></center></h2>


<!--**********************************LISTAGEM******************************************** -->



		<div id="list" class="row">
		 
		    <div class="table-responsive col-md-12">
		     
		    <table id="consultas_general" class="table table-striped table-bordered" cellspacing="0" cellpadding="0">
		            <thead>
		                <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>IP</th>
                    <th>ACESSO DATA</th>
                    <th>ACESSO HORA</th>
                    <th></th>
		                </tr>
		            </thead>
		            <tbody>

	

<!--****************************************CONTATOS*********************************** -->		 

		<?php 
			date_default_timezone_set('America/Sao_Paulo');
            $hrOnline = date('H:i:s', strtotime("-5 minutes")); //data -5 minutos atrás
            $dataOnline = date('d/m/Y');

			foreach ($clientes as $key => $cliente) {


        if ($dataOnline == $cliente['data']) {


            if ($hrOnline <= $cliente['tempo']) {
            	$color = 'success';
            }

            if ($hrOnline >= $cliente['tempo']) {
            	$color = 'default';
            }

        }else{
          $color = 'default';
        }
			?>

				 	<tr>
		                    <td><?=$cliente['id'];?></td>
		                    <td><?=$cliente['nomeuser'];?></td>
		                    <td><?=$cliente['ip'];?></td>
                        <td><?=$cliente['data'];?></td>
		                    <td><?=$cliente['tempo'];?></td>
		                    <td>
		      			<a href="#" class="btn btn-circle btn-<?php echo $color ?>"></a>
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
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

		<script src="../media/js/jquery.dataTables.min.js"></script>
    	<script src="../media/js/dataTables.bootstrap.min.js"></script>
   		<script src="../media/js/tablesgeneral.js"></script>

<script type="text/javascript">
function Ajax(){
var xmlHttp;
    try{    
        xmlHttp=new XMLHttpRequest();
    }
    catch (e){
        try{
            xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e){
            try{
                xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e){
                alert("No AJAX!?");
                return false;
            }
        }
    }

xmlHttp.onreadystatechange=function(){
    if(xmlHttp.readyState==4){
        document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
        setTimeout('Ajax()',30000);
    }
}
xmlHttp.open("GET","useronline.php",true);
xmlHttp.send(null);
}

window.onload=function(){
    setTimeout('Ajax()',30000);
}
</script>


</html>

<?php }else{?>

	<script> alert('Usuario sem permissão! '); window.history.go(-1); </SCRIPT>;

<?php }?>
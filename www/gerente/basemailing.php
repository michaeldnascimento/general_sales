<?php
session_start();
include_once "../funcoes/conexaoPortariBase1.php";
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";

if($nivel == 3 OR $nivel == 4){


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
	$mensagem = $_SESSION['mensagem'];

//unset destroi uma variaevel especifica para que ela não fique mais aparecendo em outra tela
unset($_SESSION['mensagem']);
}



/******************************Buscar os clientes - paginacao**************************/
if ($_POST['status']  !="") {

  if ($_POST['bairro'] !="") {
  $neighborhood = "COMPL2 = '{$_POST['bairro']}' AND";
  $neigh = "{$_POST['bairro']}";
  }

  if ($_POST['cidade'] !="") {
  $city = "CIDADE = '{$_POST['cidade']}' AND";
  $cida = "{$_POST['cidade']}";
  }

  if ($_POST['uf'] != "T") {
  $uf = " UF = '{$_POST['uf']}'";
  $esta = "{$_POST['uf']}";
  }


$stringSql = "SELECT ID,  DDD, TELEFONE, NOME, ENDERECO, NUM, COMPL, COMPL2, CEP, CIDADE, UF, PESSOA, CPF, STATUS, DDD2, TELEFONE2 FROM base1 WHERE {$neighborhood} {$city} {$uf}  ORDER BY ID DESC";
//echo $stringSql;

$resultado = mysqli_query($linkComMysql, $stringSql);
$qtdClientes = mysqli_num_rows($resultado);

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

<h2><center><strong>PROSPECT</strong></center></h2>

<br/>
<div id="main" class="container-fluid">
		<div id="top" class="row">
		<div class="col-md-12">


          <div class="form-group">

          </div>
</div>
</div> 
<br />


<div class="form-group">

<form action="basemailing.php" method="post">
		<div class="col-sm-3">
		<label>Tipo Pesquisa :</label>
		<select id="options" onchange="optionCheck()" name="status" class="form-control">
		<option value="">SELECIONE</option>
		<option id="show" value="show" onClick="ativa()">BAIRRO /CIDADE /UF</option>
		<option id="show1" value="show1" onClick="ativa()">CEP</option>
		</select>
		</div>

<div id="hiddenDiv" style="visibility:hidden;">
		<div class="col-sm-2">
		<label>Bairro</label>
		<div class="input-group">
		<input type="text" class="form-control" name="bairro" id="bairro">
		</div>
		</div>


		<div class="col-sm-2">
		<label>Cidade</label>
		<div class="input-group">
		<input type="text" class="form-control" name="cidade" id="cidade">
		</div>
		</div>

          <div class="col-md-1">
          <label>UF</label>
          <select name="uf" class="form-control" required>
          <option value="">UF</option>
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


		<div class="col-md-3">
		<label>.</label>
		<div class="input-group">
		<button type="submit" class="btn btn-block btn-success active"><span class="glyphicon glyphicon-ok"></span></button>
		</div>
		</div>
</div>

</form>

            <div class="col-md-1">
            <label>csv</label>
            <div class="input-group">
            <form action="../exportar/exporta_csv.php" method="POST">
            <input type="text" style="display: none" name="lista_csv" class="form-control input-md" id="lista_csv" value="<?=$stringSql?>">
            <button type="submit" class="btn btn-default active btn-xl pull-right" title="Gerar CSV"><span class="glyphicon glyphicon-print"></span></button>
            </div>
            </fom>
			</div>
</div>

<br/>
<br/>
<br/>
<br/>



<!--aqui vai aparece os dados do adicionar_contato-->
		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$mensagem;?></h5>
		    	</div>
		    </div>


<!--**********************************LISTAGEM******************************************** -->



		    <div class="row">
		    	<div class="col-md-12">
		    		<h5 class="msg-padrao"><?=$neigh;?> / <?=$cida;?> / <?=$esta;?> - <?=$qtdClientes;?> Registros </h5>
		    	</div>
		    </div>
<!--*****************QUANTIDA DE COSTATOS DA PAGINA*************************** -->






		</form>

	</div>
	

</body>

		<!-- jQuery -->
		<script src="../js/jquery-2.2.3.min.js"></script>
		<script src="../js/scripts-geral.js"></script>
		<script src="../css/bootstrap/js/bootstrap.min.js"></script>
        <script src="../css/bootstrap/js/meunavbar2.js"></script>


    <script type="text/javascript">
    function optionCheck(){
        var option = document.getElementById("options").value;
        if(option == "show"){
            document.getElementById("hiddenDiv").style.visibility ="visible";
        }

    }
</script>

</html>


<?php }else{?>

	<script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

<?php }?>
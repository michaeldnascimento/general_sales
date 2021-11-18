<?php
ini_set('default_charset', 'UTF-8');
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";



          //conectar e selecionar o banco de dados mysql/agenda
          include_once '../funcoes/conexaoPortari.php';
          include_once '../funcoes/funcoes_geraisPortari.php';

          //gera uma query para buscar todos os contatos


          $campos = array(
          'id_login',
          'nome_usuario_login',
          'usuario_login',
          'senha_login',
          'statusUsuario_login',
          'funcao_login',
          'departamento_login',
          'turno_login',
          'equipe_login',
          'nivel_login',
          );

          $tabelas = array(
          array('usuario', 'id_login')

          );

          $where = array(
          'usuario_login' => $nomeUsuario
          ); 


          $stringSql = gera_select($campos, $tabelas, $where);

          //exit("TEXTO GERADO: {$stringSql}");
          //mando executar a query no banco de dados
          $resultado = mysqli_query($linkComMysql, $stringSql);

          $cliente = mysqli_fetch_assoc($resultado);



?>


<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../css/imagens/16x16.png">
		<title>Home Sales</title>


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


 <h4><center><strong>USUARIO</strong></center></h4>
 <br />
  <br />
   <br />



<!--*************************************FORM *********************************** -->


		  
<div id="main" class="form-horizontal">


			
	

	<div class="col-sm-12">

        <div class="form-group">

            <label class="col-sm-2 control-label" for="textinput">ID</label>
            <div class="col-sm-1">
             <div class="input-group">
             <input type="text" class="form-control input-md" value="<?=$cliente['id_login']?>" disabled>
             </div>
            </div>


       </div>

        <div class="form-group">



            <label class="col-sm-2 control-label" for="textinput">Nome</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" style="text-transform: uppercase" name="nome_usuario_login" class="form-control input-md" id="nome_usuario_login" value="<?=$cliente['nome_usuario_login']?>" disabled>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>





       </div>





        <!-- Text input-->
        <div class="form-group">


            <label class="col-sm-2 control-label" for="textinput">Usuario</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" style="text-transform: uppercase" name="usuario_login" class="form-control input-md" id="usuario_login" value="<?=$cliente['usuario_login']?>" disabled>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>



       </div>

        <div class="form-group">



        <label class="col-sm-2 control-label" for="textinput">Equipe</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" style="display: <?php echo $block ?>" class="form-control" name="equipe_login" id="equipe_login" value="<?=$cliente['equipe_login']?>" disabled>
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>




       </div>

       <div class="form-group">








          <label class="col-sm-2 control-label" for="textinput">Funcao</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control" required name="funcao_login" id="funcao_login" value="<?=$cliente['funcao_login']?>" disabled>
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>


       </div>







				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-2">
						<a href="usuario-alterar-senha.php" type="submit" class="btn btn-info active">Alterar Senha</a>
					</div>
				</div>

		</div>
</div>



</body>

<!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

</html>


<?php
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


          $id = $cliente['id_login'];


$mensagem = "";
if ( isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") {
  $alerta = '';
  $mensagem = $_SESSION['mensagem'];
  unset($_SESSION['mensagem']);
}else{
  $alerta = 'none';
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

<!--********NAVBAR - BARRA DE NAVEGAÇÃO DO SITE******************** -->
<?php
include_once "../css/navbar/meunavbar.php";
?>


    <div class="alert alert-info" role="alert" style="display: <?php echo $alerta ?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <strong>INFO: </strong><?=$mensagem;?>
    </div>


 <h4><center><strong>SENHA</strong></center></h4>
 <br />
  <br />
   <br />



<!--*************************************FORM *********************************** -->


		  
<div id="main" class="form-horizontal">
<div class="col-sm-12">

<form action="usuario-alterar-senha-salvar.php?id=<?=$id;?>" method="post">


        <div class="form-group">

            <label class="col-sm-2 control-label" for="textinput">ID</label>
            <div class="col-sm-1">
             <div class="input-group">
             <input type="text" class="form-control input-md" id="id_login" name="id_login" value="<?=$cliente['id_login']?>" disabled>
             </div>
            </div>


       </div>

        <div class="form-group">



            <label class="col-sm-2 control-label" for="textinput">Nome</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text"  name="" class="form-control input-md" value="<?=$cliente['nome_usuario_login']?>" disabled>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>


            <label class="col-sm-3 control-label" for="textinput">Senha Atual</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="number" style="text-transform: uppercase" name="senhaAtual" class="form-control input-md" id="senhaAtual" required>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>





       </div>





        <!-- Text input-->
        <div class="form-group">


            <label class="col-sm-2 control-label" for="textinput">Usuario</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" class="form-control input-md" value="<?=$cliente['usuario_login']?>" disabled>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>

            <label class="col-sm-3 control-label" for="textinput">Nova Senha</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="number" style="text-transform: uppercase" name="nova_senha" class="form-control input-md" id="nova_senha" required>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>



       </div>

        <div class="form-group">



        <label class="col-sm-2 control-label" for="textinput">Equipe</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control" value="<?=$cliente['equipe_login']?>" disabled>
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

           <label class="col-sm-3 control-label" for="textinput">Confirmar Senha</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="number" style="text-transform: uppercase" name="conf_senha" class="form-control input-md" id="conf_senha">
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user" required></i></span>
             </div>
            </div>




       </div>

       <div class="form-group">




          <label class="col-sm-2 control-label" for="textinput">Funcao</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control" value="<?=$cliente['funcao_login']?>" disabled>
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>


       </div>







				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-3">
            <a  href="usuario.php" class="btn btn-default active">VOLTAR</a>
						<button type="submit" class="btn btn-success active">SALVAR</button>
					</div>
				</div>


</form>
</div>
</div>



</body>

<!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

</html>


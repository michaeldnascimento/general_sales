<?php
session_start();

//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";



if($nivel == 3 OR $nivel == 4){

//LIBERAR NIVES DE CADASTRO
if ($nivel == 3) {
  $nv = 'none';
}

//LIBERA NOME DE EQUIPE
if ($nomeEquipe == 'EQUIPE 1') {
  $eq1 = '';
  $eq2 = 'none';
  $eq3 = 'none';
  $eq4 = 'none';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 2') {
  $eq1 = 'none';
  $eq2 = '';
  $eq3 = 'none';
  $eq4 = 'none';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 3') {
  $eq1 = 'none';
  $eq2 = 'none';
  $eq3 = '';
  $eq4 = 'none';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 4') {
  $eq1 = 'none';
  $eq2 = 'none';
  $eq3 = 'none';
  $eq4 = '';
  $eq5 = 'none';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'EQUIPE 5') {
  $eq1 = 'none';
  $eq2 = 'none';
  $eq3 = 'none';
  $eq4 = 'none';
  $eq5 = '';
  $eqGeral = 'none';
}
if ($nomeEquipe == 'GERAL') {
  $eq1 = '';
  $eq2 = '';
  $eq3 = '';
  $eq4 = '';
  $eq5 = '';
  $eqGeral = '';
}

//LIBERA EMPRESA

//LIBERA EMPRESA

if ($nomePrestadora == 'EMPRESA 1') {
  $em1 = '';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 2') {
  $em1 = 'none';
  $em2 = '';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 3') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = '';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 4') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = '';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 5') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = '';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 6') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = '';
  $em7 = 'none';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 7') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = '';
  $em8 = 'none';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 8') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = '';
  $emg = 'none';
}
if ($nomePrestadora == 'EMPRESA 9') {
  $em1 = 'none';
  $em2 = 'none';
  $em3 = 'none';
  $em4 = 'none';
  $em5 = 'none';
  $em6 = 'none';
  $em7 = 'none';
  $em8 = 'none';
  $em9 = '';
  $emg = 'none';
}
if ($nomePrestadora == 'GERAL') {
  $em1 = '';
  $em2 = '';
  $em3 = '';
  $em4 = '';
  $em5 = '';
  $em6 = '';
  $em7 = '';
  $em8 = '';
  $emg = '';
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





 <h4><center><strong>Novo Usuario</strong></center></h4>s
 <br />
 



<!--*************************************FORM *********************************** -->



		  
<div id="main" class="form-horizontal">
<form action="cad-usuario-salve.php" method="POST">

		
			
	

	<div class="col-sm-12">

                <!-- Text input-->
        <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput">Nome Usuario</label>
      <div class="col-sm-5">
       <div class="input-group">
       <input type="text" style="text-transform: uppercase" placeholder="Nome do usuario" name="nome_usuario_login" class="form-control input-md" id="nome_usuario_login" required>
       <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
       </div>
      </div>

      <div class="col-sm-2">
      <div class="input-group">
     <label class="radio-inline">
      <input type="radio" name="statusUsuario_login" id="statusUsuario_login" value="ATIVO" required><strong style="color:blue">ATIVO</strong>
      </label>

      <label class="radio-inline">
      <input type="radio" name="statusUsuario_login" id="statusUsuario_login" value="INATIVO"><strong style="color:red">INATIVO</strong>
      </label>
      </div>
      </div>

       </div>

		



        <!-- Text input-->
        <div class="form-group">

            <label class="col-sm-3 control-label" for="textinput">Login</label>
            <div class="col-sm-3">
             <div class="input-group">
             <input type="text" style="text-transform: uppercase"  placeholder="Nome do Login" name="usuario_login" class="form-control input-md" id="usuario_login" required>
             <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
             </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Senha</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input type="text" class="form-control" required name="senha_login" id="senha_login">
                <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

       </div>

	    <!-- Text input-->
        <div class="form-group">
                          
      

 
          <label class="col-sm-3 control-label" for="textinput">Funcao</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control" required name="funcao_login" id="funcao_login">
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>

            <label class="col-sm-1 control-label" for="textinput">Departamento</label>
            <div class="col-sm-2">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control" required name="departamento_login" id="departamento_login">
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>


         <label class="col-sm-1 control-label" for="textinput">Turno</label>
            <div class="col-sm-1">
              <div class="input-group">
                <input type="text" style="text-transform: uppercase" class="form-control"  name="turno_login" id="turno_login">
                 <span class="input-group-addon label-white"><i class="glyphicon glyphicon-user"></i></span>
              </div>
            </div>


        </div>


			<!-- Text input-->
	    <div class="form-group">


        <label class="col-sm-3 control-label" for="textinput">Equipe</label>
        <div class="col-sm-2">
        <select name="equipe_login" id="equipe_login" class="form-control" required>
        <option></option>
        <option value="EQUIPE 1" style="display: <?php echo $eq1 ?>">EQUIPE 1</option>
        <option value="EQUIPE 2" style="display: <?php echo $eq2 ?>">EQUIPE 2</option>
        <option value="EQUIPE 3" style="display: <?php echo $eq3 ?>">EQUIPE 3</option>
        <option value="EQUIPE 4" style="display: <?php echo $eq4 ?>">EQUIPE 4</option>
        <option value="EQUIPE 5" style="display: <?php echo $eq5 ?>">EQUIPE 5</option>
        <option value="NET PROSPECT">NET PROSPECT</option>
        <option value="MULTI">MULTI</option>
        <option value="CLARO">CLARO</option>
        <option value="TIM">TIM</option>
        <option value="PARCEIRO CLARO">PARCEIRO CLARO</option>
        <option value="PARCEIRO NET">PARCEIRO NET</option>
        <option value="PARCEIRO TIM">PARCEIRO TIM</option>
        <option value="JLR">JLR</option>
        <option value="FELIPE">FELIPE</option>
        <option value="GERAL"    style="display: <?php echo $eqGeral ?>">GERAL</option>
        </select>
        </div>

        <label class="col-sm-1 control-label" for="textinput">Empresa</label>
        <div class="col-sm-2">
        <select name="empresa_login" id="empresa_login" class="form-control" required>
        <option></option>
        <option value="EMPRESA 1" style="display: <?php echo $em1 ?>">EMPRESA 1-RSTELECOM</option>
        <option value="EMPRESA 2" style="display: <?php echo $em2 ?>">EMPRESA 2-MACHADO</option>
        <option value="EMPRESA 3" style="display: <?php echo $em3 ?>">EMPRESA 3-LEONARDO</option>
        <option value="EMPRESA 4" style="display: <?php echo $em4 ?>">EMPRESA 4-FLEXCELL</option>
        <option value="EMPRESA 5" style="display: <?php echo $em5 ?>">EMPRESA 5-CRISTIANO</option>
        <option value="EMPRESA 6" style="display: <?php echo $em6 ?>">EMPRESA 6-SAHIMON</option>
        <option value="EMPRESA 7" style="display: <?php echo $em7 ?>">EMPRESA 7-AGNALDO</option>
        <option value="EMPRESA 8" style="display: <?php echo $em8 ?>">EMPRESA 8-JLR</option>
        <option value="EMPRESA 9" style="display: <?php echo $em9 ?>">EMPRESA 9-FELIPE</option>
        <option value="GERAL"     style="display: <?php echo $emg ?>">GERAL</option>
        </select>
        </div>


        <label class="col-sm-1 control-label" for="textinput">Nivel</label>
        <div class="col-sm-1">
        <select name="nivel_login" id="nivel_login" class="form-control" required>
        <option></option>
        <option value="1">1 - VENDEDOR</option>
        <option value="2">2 - BACKOFFICE</option>
        <option value="3" style="display: <?php echo $nv ?>">3 - SUPERVISOR</option>
        <option value="4" style="display: <?php echo $nv ?>">4 - ADM</option>
        <option value="5" style="display: <?php echo $nv ?>">5 - LOGINS</option>
        </select>
        </div>


            
	    </div>

		
		<br/>
	     <h4><center><strong>Acessos</strong></center></h4>
		<br>


      <div class="form-group">


      <label class="col-sm-3 control-label" for="textinput">PROSPECT</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="acessoPROSPECTS_login" id="acessoPROSPECTS_login" value="SIM"> SIM
      </label>

      <label class="radio-inline">
      <input type="radio" name="acessoPROSPECTS_login" id="acessoPROSPECTS_login" value="NAO"> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">OPORTUNIDADE</label>
      <div class="col-sm-2">
          <div class="input-group">
              <label class="radio-inline">
                  <input type="radio" name="acessoCE_login" id="acessoCE_login" value="SIM"> SIM
              </label>
              <label class="radio-inline">
                  <input type="radio" name="acessoCE_login" id="acessoCE_login" value="NAO"> NAO
              </label>
          </div>
      </div>

      </div>




<!--

      <label class="col-sm-1 control-label" for="textinput">LEAD SUL</label>
      <div class="col-sm-2">
      <div class="input-group">
     <label class="radio-inline">
      <input type="radio" name="acessoSL_login" id="acessoSL_login" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="acessoSL_login" id="acessoSL_login" value="NAO"> NAO
      </label>
      </div>
      </div>

	   <div class="form-group">


      <label class="col-sm-3 control-label" for="textinput">Cancelados</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="acessoCANC_login" id="acessoCANC_login" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="acessoCANC_login" id="acessoCANC_login" value="NAO"> NAO
      </label>
      </div>
      </div>





	   </div>


      <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput">Prospects.NET</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="acessoLEADSITE_login" id="acessoLEADSITE_login" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="acessoLEADSITE_login" id="acessoLEADSITE_login" value="NAO"> NAO
      </label>
      </div>
      </div>





     </div>

      <div class="form-group">






     </div>
<br />

      <label class="col-sm-3 control-label" for="textinput">Vendas Resumidas</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="acessoVENDARS_login" id="acessoVENDARS_login" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="acessoVENDARS_login" id="acessoVENDARS_login" value="NAO"> NAO
      </label>
      </div>
      </div>
-->

<br />
<br />
      <div class="form-group">

      <label class="col-sm-3 control-label" for="textinput">LEAD GERAL</label>
      <div class="col-sm-2">
          <div class="input-group">
              <label class="radio-inline">
                  <input type="radio" name="acessoGERAL_login" id="acessoGERAL_login" value="SIM"> SIM
              </label>
              <label class="radio-inline">
                  <input type="radio" name="acessoGERAL_login" id="acessoGERAL_login" value="NAO"> NAO
              </label>
          </div>
      </div>

      <label class="col-sm-1 control-label" for="textinput">PARCEIROS</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="acessoPARCEIROS_login" id="acessoPARCEIROS_login" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="acessoPARCEIROS_login" id="acessoPARCEIROS_login" value="NAO"> NAO
      </label>
      </div>
      </div>

      <label class="col-sm-1 control-label" style="color: red" for="textinput">TODOS</label>
      <div class="col-sm-2">
      <div class="input-group">
      <label class="radio-inline">
      <input type="radio" name="acessoTODOS_login" id="acessoTODOS_login" value="SIM"> SIM
      </label>
      <label class="radio-inline">
      <input type="radio" name="acessoTODOS_login" id="acessoTODOS_login" value="NAO"> NAO
      </label>
      </div>
      </div>


      </div>


	   <br>
	   <br>






				
				
				<!-- Button trigger modal -->
				<div class="form-group">
					<label class="col-md-9 control-label" for="button1id"></label>
						<div class="col-md-2">
						<a href="con-usuario-lista.php" class="btn btn-default">Voltar</a>
						<button type="submit" class="btn btn-success active">Salvar</button>
					</div>
				</div>
				

		</div>

</form>
</div>

</body>
<!-- jQuery -->
    <script src="../js/jquery-2.2.3.min.js"></script>
    <script src="../js/scripts-geral.js"></script>
    <script src="../css/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/bootstrap/js/meunavbar2.js"></script>

</html>

<?php }else{?>

   <script> alert('Usuario sem permissão! '); window.history.go(-1); </script>;

<?php }?>   

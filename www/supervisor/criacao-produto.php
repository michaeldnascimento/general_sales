<?php
session_start();
//login_verifica pra verificar o login
include_once "../login/verifica.php";
include_once "../login/visualizarlista.php";
include_once "../funcoes/conexaoPortari.php";

//GET ID OPERADORA
$name_operadora = $_GET['operadora'];

//SELECT OPERADORA
$selectOperadora = "SELECT id, name FROM operadora WHERE status = 1  ORDER BY name";
$resultOperadora = mysqli_query($linkComMysql, $selectOperadora);
$operadora = array();

while ($op = mysqli_fetch_assoc($resultOperadora)) {
    $operadora[] = array(
        'id' 		=> $op['id'],
        'nome'  	=> $op['name'],
    );
}

//SELECT INTERNET
$selectInternet = "SELECT id, nome, operadora FROM internet WHERE status = 1 AND operadora = '$name_operadora' ORDER BY nome";
$resultInternet = mysqli_query($linkComMysql, $selectInternet);
$internet = array();

while ($int = mysqli_fetch_assoc($resultInternet)) {
    $internet[] = array(
        'id' 		=> $int['id'],
        'nome'  	=> $int['nome'],
        'operadora' => $int['operadora'],
    );
}

//SELECT FONE
$selectFone = "SELECT id, nome, operadora FROM telefonia WHERE status = 1 AND operadora = '$name_operadora' ORDER BY nome";
$resultFone = mysqli_query($linkComMysql, $selectFone);
$fone = array();

while ($phone = mysqli_fetch_assoc($resultFone)) {
    $fone[] = array(
        'id' 		=> $phone['id'],
        'nome'  	=> $phone['nome'],
        'operadora' => $phone['operadora'],
    );
}

//SELECT AGREGADO
$selectAgregado = "SELECT id, nome, operadora FROM agregado WHERE status = 1 AND operadora = '$name_operadora' ORDER BY nome";
$resultAgregado = mysqli_query($linkComMysql, $selectAgregado);
$agregado = array();

while ($agre = mysqli_fetch_assoc($resultAgregado)) {
    $agregado[] = array(
        'id' 		=> $agre['id'],
        'nome'  	=> $agre['nome'],
        'operadora' => $agre['operadora'],
    );
}

//SELECT TV
$selectTV = "SELECT id, nome, operadora FROM tv WHERE status = 1 AND operadora = '$name_operadora' ORDER BY nome";
$resultTV = mysqli_query($linkComMysql, $selectTV);
$teve = array();

while ($tv = mysqli_fetch_assoc($resultTV)) {
    $teve[] = array(
        'id' 		=> $tv['id'],
        'nome'  	=> $tv['nome'],
        'operadora' => $tv['operadora'],
    );
}



if($nivel == 3 OR $nivel == 4){


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

    <h4><center><strong>Criação Produto</strong></center></h4>
    <br />

    <!--*************************************FORM *********************************** -->

    <div id="main" class="form-horizontal">
        <form action="cad-usuario-salve.php" method="POST">

            <div class="col-sm-12">

                <!-- Text input-->

                <div class="form-group">
                    <label for="inputSala" class="col-xs-12 col-sm-2 col-md-2 control-label">Operadora:</label>
                    <div class="col-xs-12 col-sm-8 col-md-8">


                        <select class="form-control" id="name_operadora_super" name="operadora" onchange="selectOPSupervisor()" required>
                            <option value="">Selecione</option>
                            <?php
                            foreach ($operadora as $col):
                                $obj = (Object)$col;
                                ?>

                                <option value="<?= $obj->nome ?>" <?php if ($obj->nome == $name_operadora) echo 'selected' ?>>
                                    <?= $obj->nome ?>
                                </option>

                            <?php
                            endforeach;
                            ?>
                        </select>

                    </div>
                    <a class="btn btn-warning btn-mini" data-toggle="modal" data-target="#apresentacaoOperadora">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>
                <br>
                <br>


                <div class="form-group">
                    <label for="inputSala" class="col-xs-12 col-sm-2 col-md-2 control-label">Internet:</label>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <select multiple class="form-control">
                            <?php
                            foreach ($internet as $key => $int){
                                ?>
                                <option value="<?=$int['nome'];?>"><?=$int['nome'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <a class="btn btn-warning btn-mini" data-toggle="modal" data-target="#apresentacaoInternet">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>

                <div class="form-group">
                    <label for="inputSala" class="col-xs-12 col-sm-2 col-md-2 control-label">TV:</label>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <select multiple class="form-control">
                            <?php
                            foreach ($teve as $key => $tv){
                                ?>
                                <option value="<?=$tv['nome'];?>"><?=$tv['nome'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <a class="btn btn-warning btn-mini" data-toggle="modal" data-target="#apresentacaoTV">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>

                <div class="form-group">
                    <label for="inputSala" class="col-xs-12 col-sm-2 col-md-2 control-label">Telefone:</label>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <select multiple class="form-control">
                            <?php
                            foreach ($fone as $key => $phone){
                                ?>
                                <option value="<?=$phone['nome'];?>"><?=$phone['nome'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <a class="btn btn-warning btn-mini" data-toggle="modal" data-target="#apresentacaoTelefone">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>

                <div class="form-group">
                    <label for="inputSala" class="col-xs-12 col-sm-2 col-md-2 control-label">Agregado:</label>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <select multiple class="form-control">
                            <?php
                            foreach ($agregado as $key => $agre){
                                ?>
                                <option value="<?=$agre['nome'];?>"><?=$agre['nome'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <a class="btn btn-warning btn-mini" data-toggle="modal" data-target="#apresentacaoAgregado">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                </div>


            </div>

        </form>
    </div>


    <!-- Modal operadora -->
    <div class="modal fade" id="apresentacaoOperadora" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Apresentação Operadora
                    </h4>
                </div>
                <div class="modal-body">
                    <?php require_once './modal/modal-operadora.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->

    <!-- Modal internet -->
    <div class="modal fade" id="apresentacaoInternet" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Apresentação Internet
                    </h4>
                </div>
                <div class="modal-body">
                    <?php require_once './modal/modal-internet.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->

    <!-- Modal tv -->
    <div class="modal fade" id="apresentacaoTV" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Apresentação TV
                    </h4>
                </div>
                <div class="modal-body">
                    <?php require_once './modal/modal-tv.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->

    <!-- Modal telefone -->
    <div class="modal fade" id="apresentacaoTelefone" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Apresentação Telefone
                    </h4>
                </div>
                <div class="modal-body">
                    <?php require_once './modal/modal-telefone.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->

    <!-- Modal agregado -->
    <div class="modal fade" id="apresentacaoAgregado" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Apresentação Agregado
                    </h4>
                </div>
                <div class="modal-body">
                    <?php require_once './modal/modal-agregado.php'; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->

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

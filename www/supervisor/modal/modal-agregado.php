<?php
session_start();

const BASE_AGREGADO = '/';
const MODAL_AGREGADO = BASE_AGREGADO . 'supervisor/';
const AJAX_AGREGADO = MODAL_AGREGADO . 'ajax/agregado/';
$base_ajax_agregado = AJAX_AGREGADO;
?>
<!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
<style>
    .table-hover > tbody > tr:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>

<div id="principal" name="principal" class="row">
    <form class="form-horizontal" name="comboAgregado" id="comboAgregado" method="post">
        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <h1 class="featurette-heading">Editando Agregado</h1>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputDescricao" class="col-xs-1 col-sm-2 col-md-3 control-label">Nome:</label>
            <div class="col-xs-12 col-sm-10 col-md-6">
                <input type="hidden" id="id_agregado" name="id_agregado">
                <input type="hidden" id="operadora_agregado" name="operadora_agregado">
                <input type="text" id="nome_agregado" name="nome_agregado" class="form-control" placeholder="Inserir nome plano" onChange="this.value = this.value.toUpperCase()" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="btnIncluirAgregado" name="btnIncluirAgregado" onclick="incluirAgregado()">
                    <span  class="glyphicon glyphicon-plus"></span> Incluir
                </button>
                <button class="btn btn-warning" type="button" id="btnAlterarAgregado" name="btnAlterarAgregado" onclick="alterarAgregado()" disabled>
                    <span  class="glyphicon glyphicon-pencil"></span> Alterar
                </button>
                <button class="btn btn-danger" type="button" id="botaoExcluirAgregado" name="botaoExcluirAgregado" onclick="excluirAgregado()" disabled>
                    <span class="glyphicon glyphicon-remove"></span> Excluir
                </button>
                <button class="btn btn-info" type="button" id="botaoCancelarAgregado" name="botaoCancelarAgregado" onclick="cancelarAgregado()" >
                    <span class="glyphicon glyphicon-stop"></span> Limpar
                    <!--  <button class="btn btn-default" type="reset" id="botaoReset" name="botaoReset">
                    <span class="glyphicons glyphicons-restart" style="font-size: 22px;"></span>Limpar
                    </button>-->
                    <!--                <button class="btn btn-default" type="button" onclick="location.href = 'index.php'">
                    <span class="glyphicons glyphicons-unshare" style="font-size: 22px;"></span> Voltar
                    </button>-->
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <p class="lead">Lista de Resultados</p>
                </div>
            </div>
        </div>

    </form>

    <div class='table-responsive'>
        <table class='table table-bordered table-striped table-hover'>
            <thead>
            <th>Nome</th>
            </thead>
            <tbody id="apresentacaodocAgregado">
            <?php
            $cont = 1;
            foreach ($agregado as $key => $col) {
                $obj = (Object)$col;
                echo "<tr onclick='acaoAgregado(".$obj->id.",\"".$obj->nome."\",\"". $obj->operadora."\");'>" .
                    "<td>" . $obj->nome .
                    "</td>" .
                    "</tr>";
                $cont ++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">

    let urlAjaxAgregado = "<?php echo $base_ajax_agregado;?>";

    function incluirAgregado() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeAgregado = $('#nome_agregado').val();
        var operadoraAgregado = "<?php echo $name_operadora;?>";

        if (nomeAgregado === '') {
            alert("O campo nome tem que ser preenchido.");
            return false;
        }

        $.ajax({
            url: urlAjaxAgregado + "incluir.php",
            data: {"nomeagregado": nomeAgregado, "agregadooperadora": operadoraAgregado},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_agregado').val('');
            $('#nome_agregado').val('');
            $('#operadora_agregado').val('');
        });
        atualizaAgregado(operadoraAgregado);
        //$("#apresentacaoAgregado").modal("hide");


    }

    function excluirAgregado() {
        //var id = $('#hidIdTipoDoc').val();
        var operadoraAgregado = $('#operadora_agregado').val();
        var idAgregado = $('#id_agregado').val();

        if (confirm('Você deseja mesmo excluir?')) {

            // Save it!
            $.ajax({
                url: urlAjaxAgregado + "excluir.php",
                data: {"idagregado": idAgregado},
                dataType: "json",
                async: false,
                type: "post"
            }).done(function (data) {
                data = JSON.stringify(data);
                $('#id_agregado').val('');
                $('#nome_agregado').val('');
                $('#operadora_agregado').val('');
            });
            atualizaAgregado(operadoraAgregado);
            //$("#apresentacaoAgregado").modal("hide");

        }

    }

    function alterarAgregado() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeAgregado = $('#nome_agregado').val();
        var operadoraAgregado = $('#operadora_agregado').val();
        var idAgregado = $('#id_agregado').val();


        $.ajax({
            url: urlAjaxAgregado + "alterar.php",
            data: {"idagregado": idAgregado, "nomeagregado": nomeAgregado},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_agregado').val('');
            $('#nome_agregado').val('');
            $('#operadora_agregado').val('');
        });
        atualizaAgregado(operadoraAgregado);
        //$("#apresentacaoAgregado").modal("hide");


    }

    function atualizaAgregado(operadoraAgregado) {

        $.ajax({
            url: urlAjaxAgregado + "atualizar.php",
            type: "POST",
            async: false,
            data: {"agregadooperadora": operadoraAgregado},
            dataTye: "JSON"
        }).done(function (data) {
            data = JSON.parse(data);

            $('#selApresentacaoAgregado').empty();
            $('#apresentacaodocAgregado').empty();

            $('#selApresentacaoAgregado').append($('<option></option>').val('').html('Selecione'));

            for (i = 0; i < data.length; i++) {
                $('#selApresentacaoAgregado').append($('<option></option>').val(data[i].id).html(data[i].nome).html(data[i].operadora));

                $('#apresentacaodocAgregado').append($("<tr onclick=\"acaoAgregado(" + data[i].id + ",'" + data[i].nome + "','" + data[i].operadora + "')\"><td>" + data[i].nome + "</td></tr>"));
            }
        });
    }


    function cancelarAgregado() {
        $("#btnAlterarAgregado").attr("disabled", true);
        $("#botaoExcluirAgregado").attr("disabled", true);
        $("#btnIncluirAgregado").attr("disabled", false);
        $('#id_agregado').val('');
        $('#nome_agregado').val('');
        $('#operadora_agregado').val('');
    }

    function limparAgregado() {
        $("#btnAlterarAgregado").attr("disabled", true);
        $("#botaoExcluirAgregado").attr("disabled", true);
        $("#btnIncluirAgregado").attr("disabled", false);
    }

    function acaoAgregado(id, nome, operadora) {
        $("#id_agregado").val(id);
        $("#nome_agregado").val(nome);
        $("#nome_agregado").focus().val(nome);
        $("#operadora_agregado").val(operadora);
        $("#btnAlterarAgregado").attr("disabled", false);
        $("#botaoExcluirAgregado").attr("disabled", false);
        $("#btnIncluirAgregado").attr("disabled", false);
        $("#botaoCancelarAgregado").attr("disabled", false);
    }
</script>


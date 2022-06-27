<?php
session_start();

const BASE_INTERNET = '/';
const MODAL_INTERNET = BASE_INTERNET . 'supervisor/';
const AJAX_INTERNET = MODAL_INTERNET . 'ajax/internet/';
$base_ajax_internet = AJAX_INTERNET;
?>
<!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
<style>
    .table-hover > tbody > tr:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>

<div id="principal" name="principal" class="row">
    <form class="form-horizontal" name="comboInternet" id="comboInternet" method="post">
        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <h1 class="featurette-heading">Editando Internet</h1>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputDescricao" class="col-xs-1 col-sm-2 col-md-3 control-label">Nome:</label>
            <div class="col-xs-12 col-sm-10 col-md-6">
                <input type="hidden" id="id_internet" name="id_internet">
                <input type="hidden" id="operadora_internet" name="operadora_internet">
                <input type="text" id="nome_internet" name="nome_internet" class="form-control" placeholder="Inserir nome plano" onChange="this.value = this.value.toUpperCase()" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="btnIncluirInternet" name="btnIncluirInternet" onclick="incluirInternet()">
                    <span  class="glyphicon glyphicon-plus"></span> Incluir
                </button>
                <button class="btn btn-warning" type="button" id="btnAlterarInternet" name="btnAlterarInternet" onclick="alterarInternet()" disabled>
                    <span  class="glyphicon glyphicon-pencil"></span> Alterar
                </button>
                <button class="btn btn-danger" type="button" id="botaoExcluirInternet" name="botaoExcluirInternet" onclick="excluirInternet()" disabled>
                    <span class="glyphicon glyphicon-remove"></span> Excluir
                </button>
                <button class="btn btn-info" type="button" id="botaoCancelarInternet" name="botaoCancelarInternet" onclick="cancelarInternet()" >
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
            <tbody id="apresentacaodocInternet">
            <?php
            $cont = 1;
            foreach ($internet as $key => $col) {
                $obj = (Object)$col;
                echo "<tr onclick='acaoInternet(".$obj->id.",\"".$obj->nome."\",\"". $obj->operadora."\");'>" .
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

    let urlAjaxInternet = "<?php echo $base_ajax_internet;?>";

    function incluirInternet() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeInternet = $('#nome_internet').val();
        var operadoraInternet = "<?php echo $name_operadora;?>";

        if (nomeInternet === '') {
            alert("O campo nome tem que ser preenchido.");
            return false;
        }

        $.ajax({
            url: urlAjaxInternet + "incluir.php",
            data: {"nomeinternet": nomeInternet, "internetoperadora": operadoraInternet},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_internet').val('');
            $('#nome_internet').val('');
            $('#operadora_internet').val('');
        });
        atualizaInternet(operadoraInternet);
        //$("#apresentacaoInternet").modal("hide");


    }

    function excluirInternet() {
        //var id = $('#hidIdTipoDoc').val();
        var operadoraInternet = $('#operadora_internet').val();
        var idInternet = $('#id_internet').val();

        if (confirm('Você deseja mesmo excluir?')) {

            // Save it!
            $.ajax({
                url: urlAjaxInternet + "excluir.php",
                data: {"idinternet": idInternet},
                dataType: "json",
                async: false,
                type: "post"
            }).done(function (data) {
                data = JSON.stringify(data);
                $('#id_internet').val('');
                $('#nome_internet').val('');
                $('#operadora_internet').val('');
            });
            atualizaInternet(operadoraInternet);
            //$("#apresentacaoInternet").modal("hide");

        }

    }

    function alterarInternet() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeInternet = $('#nome_internet').val();
        var operadoraInternet = $('#operadora_internet').val();
        var idInternet = $('#id_internet').val();


        $.ajax({
            url: urlAjaxInternet + "alterar.php",
            data: {"idinternet": idInternet, "nomeinternet": nomeInternet},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_internet').val('');
            $('#nome_internet').val('');
            $('#operadora_internet').val('');
        });
        atualizaInternet(operadoraInternet);
        //$("#apresentacaoOperadora").modal("hide");


    }

    function atualizaInternet(operadoraInternet) {

        $.ajax({
            url: urlAjaxInternet + "atualizar.php",
            type: "POST",
            async: false,
            data: {"internetoperadora": operadoraInternet},
            dataTye: "JSON"
        }).done(function (data) {
            data = JSON.parse(data);

            $('#selApresentacaoInternet').empty();
            $('#apresentacaodocInternet').empty();

            $('#selApresentacaoInternet').append($('<option></option>').val('').html('Selecione'));

            for (i = 0; i < data.length; i++) {
                $('#selApresentacaoInternet').append($('<option></option>').val(data[i].id).html(data[i].nome).html(data[i].operadora));

                $('#apresentacaodocInternet').append($("<tr onclick=\"acaoInternet(" + data[i].id + ",'" + data[i].nome + "','" + data[i].operadora + "')\"><td>" + data[i].nome + "</td></tr>"));
            }
        });
    }


    function cancelarInternet() {
        $("#btnAlterarInternet").attr("disabled", true);
        $("#botaoExcluirInternet").attr("disabled", true);
        $("#btnIncluirInternet").attr("disabled", false);
        $('#id_internet').val('');
        $('#nome_internet').val('');
        $('#operadora_internet').val('');
    }

    function limparInternet() {
        $("#btnAlterarInternet").attr("disabled", true);
        $("#botaoExcluirInternet").attr("disabled", true);
        $("#btnIncluirInternet").attr("disabled", false);
    }

    function acaoInternet(id, nome, operadora) {
        $("#id_internet").val(id);
        $("#nome_internet").val(nome);
        $("#nome_internet").focus().val(nome);
        $("#operadora_internet").val(operadora);
        $("#btnAlterarInternet").attr("disabled", false);
        $("#botaoExcluirInternet").attr("disabled", false);
        $("#btnIncluirInternet").attr("disabled", false);
        $("#botaoCancelarInternet").attr("disabled", false);
    }
</script>


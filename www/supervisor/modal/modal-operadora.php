<?php
session_start();

const BASE_OPERADORA = '/';
const MODAL_OPERADORA = BASE_OPERADORA . 'supervisor/';
const AJAX_OPERADORA = MODAL_OPERADORA . 'ajax/operadora/';
$base_ajax_operadora = AJAX_OPERADORA;
?>
<!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
<style>
    .table-hover > tbody > tr:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>

<div id="principal" name="principal" class="row">
    <form class="form-horizontal" name="comboAndar" id="comboAndar" method="post">
        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <h1 class="featurette-heading">Editando Operadora</h1>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputDescricao" class="col-xs-1 col-sm-2 col-md-3 control-label">Nome:</label>
            <div class="col-xs-12 col-sm-10 col-md-6">
                <input type="hidden" id="hidId" name="hidId">
                <input type="text" id="txtNome" name="txtNome" class="form-control" placeholder="Inserir nome andar" onChange="this.value = this.value.toUpperCase()" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="btnIncluir" name="btnIncluir" onclick="incluir()">
                    <span  class="glyphicon glyphicon-plus"></span> Incluir
                </button>
                <button class="btn btn-warning" type="button" id="btnAlterar" name="btnAlterar" onclick="alterar()" disabled>
                    <span  class="glyphicon glyphicon-pencil"></span> Alterar
                </button>
                <button class="btn btn-danger" type="button" id="botaoExcluir" name="botaoExcluir" onclick="excluir()" disabled>
                    <span class="glyphicon glyphicon-remove"></span> Excluir
                </button>
                <button class="btn btn-info" type="button" id="botaoExcluir" name="botaoCancelar" onclick="cancelar()" >
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
            <tbody id="apresentacaodoclista">
            <?php
            $cont = 1;
            foreach ($operadora as $key => $col) {
                $obj = (Object)$col;
                echo "<tr onclick='acao(" . $obj->id . ",\"" . $obj->nome . "\");'>" .
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
    let urlAjax = "<?php echo $base_ajax_operadora;?>";
    function incluir() {

        //var id = $('#hidIdTipoDoc').val();
        var nome = $('#txtNome').val();

        if (nome === '') {
            alert("O campo nome tem que ser preenchido.");
            return false;
        }

        $.ajax({
            url: urlAjax + "incluir.php",
            data: {"txtnome": nome},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#txtNome').val('');
        });
        atualiza();
        //$("#apresentacaoDoc").modal("hide");


    }

    function excluir() {
        //var id = $('#hidIdTipoDoc').val();
        var id = $('#hidId').val();

        if (confirm('Você deseja mesmo excluir?')) {

            // Save it!
            $.ajax({
                url: urlAjax + "excluir.php",
                data: {"txtid": id},
                dataType: "json",
                async: false,
                type: "post"
            }).done(function (data) {
                data = JSON.stringify(data);
                $('#txtid').val('');
            });
            atualiza();
            //$("#apresentacaoDoc").modal("hide");

        }

    }

    function alterar() {

        //var id = $('#hidIdTipoDoc').val();
        var nome = $('#txtNome').val();
        var id = $('#hidId').val();


        $.ajax({
            url: urlAjax + "alterar.php",
            data: {"txtid": id, "txtnome": nome},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#txtNome').val('');
            $('#hidId').val('');
        });
        atualiza();
        //$("#apresentacaoDoc").modal("hide");


    }

    function atualiza() {
        $.ajax({
            url: urlAjax + "atualizar.php",
            type: "POST",
            async: false,
            data: {},
            dataTye: "JSON"
        }).done(function (data) {
            data = JSON.parse(data);

            $('#selApresentacaoAndar').empty();
            $('#apresentacaodoclista').empty();

            $('#selApresentacaoAndar').append($('<option></option>').val('').html('Selecione'));

            for (i = 0; i < data.length; i++) {
                $('#selApresentacaoAndar').append($('<option></option>').val(data[i].id).html(data[i].name));

                $('#apresentacaodoclista').append($("<tr onclick=\"acao(" + data[i].id + ",'" + data[i].name + "')\"><td>" + data[i].name + "</td></tr>"));
            }
        });
    }


    function cancelar() {
        $("#btnAlterar").attr("disabled", true);
        $("#botaoExcluir").attr("disabled", true);
        $("#btnIncluir").attr("disabled", false);
        $("#txtNome").val('');
    }

    function limpar() {
        $("#btnAlterar").attr("disabled", true);
        $("#botaoExcluir").attr("disabled", true);
        $("#btnIncluir").attr("disabled", false);
    }

    function acao(id, descricao) {
        $("#hidId").val(id);
        $("#txtNome").val(descricao);
        $("#txtNome").focus().val(descricao);
        $("#btnAlterar").attr("disabled", false);
        $("#botaoExcluir").attr("disabled", false);
        $("#btnIncluir").attr("disabled", false);
        $("#botaoCancelar").attr("disabled", false);
    }
</script>


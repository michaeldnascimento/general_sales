<?php
session_start();

const BASE_TELEFONE = '/';
const MODAL_TELEFONE = BASE_TELEFONE . 'supervisor/';
const AJAX_TELEFONE = MODAL_TELEFONE . 'ajax/telefone/';
$base_ajax_telefone = AJAX_TELEFONE;
?>
<!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
<style>
    .table-hover > tbody > tr:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>

<div id="principal" name="principal" class="row">
    <form class="form-horizontal" name="comboTelefone" id="comboTelefone" method="post">
        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <h1 class="featurette-heading">Editando Telefone</h1>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputDescricao" class="col-xs-1 col-sm-2 col-md-3 control-label">Nome:</label>
            <div class="col-xs-12 col-sm-10 col-md-6">
                <input type="hidden" id="id_telefone" name="id_telefone">
                <input type="hidden" id="operadora_telefone" name="operadora_telefone">
                <input type="text" id="nome_telefone" name="nome_telefone" class="form-control" placeholder="Inserir nome plano" onChange="this.value = this.value.toUpperCase()" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="btnIncluirTelefone" name="btnIncluirTelefone" onclick="incluirTelefone()">
                    <span  class="glyphicon glyphicon-plus"></span> Incluir
                </button>
                <button class="btn btn-warning" type="button" id="btnAlterarTelefone" name="btnAlterarTelefone" onclick="alterarTelefone()" disabled>
                    <span  class="glyphicon glyphicon-pencil"></span> Alterar
                </button>
                <button class="btn btn-danger" type="button" id="botaoExcluirTelefone" name="botaoExcluirTelefone" onclick="excluirTelefone()" disabled>
                    <span class="glyphicon glyphicon-remove"></span> Excluir
                </button>
                <button class="btn btn-info" type="button" id="botaoCancelarTelefone" name="botaoCancelarTelefone" onclick="cancelarTelefone()" >
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
            <tbody id="apresentacaodocTelefone">
            <?php
            $cont = 1;
            foreach ($fone as $key => $col) {
                $obj = (Object)$col;
                echo "<tr onclick='acaoTelefone(".$obj->id.",\"".$obj->nome."\",\"". $obj->operadora."\");'>" .
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

    let urlAjaxTelefone = "<?php echo $base_ajax_telefone;?>";

    function incluirTelefone() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeTelefone = $('#nome_telefone').val();
        var operadoraTelefone = "<?php echo $name_operadora;?>";

        if (nomeTelefone === '') {
            alert("O campo nome tem que ser preenchido.");
            return false;
        }

        $.ajax({
            url: urlAjaxTelefone + "incluir.php",
            data: {"nometelefone": nomeTelefone, "telefoneoperadora": operadoraTelefone},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_telefone').val('');
            $('#nome_telefone').val('');
            $('#operadora_telefone').val('');
        });
        atualizaTelefone(operadoraTelefone);
        //$("#apresentacaoTelefone").modal("hide");


    }

    function excluirTelefone() {
        //var id = $('#hidIdTipoDoc').val();
        var operadoraTelefone = $('#operadora_telefone').val();
        var idTelefone = $('#id_telefone').val();

        if (confirm('Você deseja mesmo excluir?')) {

            // Save it!
            $.ajax({
                url: urlAjaxTelefone + "excluir.php",
                data: {"idtelefone": idTelefone},
                dataType: "json",
                async: false,
                type: "post"
            }).done(function (data) {
                data = JSON.stringify(data);
                $('#id_telefone').val('');
                $('#nome_telefone').val('');
                $('#operadora_telefone').val('');
            });
            atualizaTelefone(operadoraTelefone);
            //$("#apresentacaoTelefone").modal("hide");

        }

    }

    function alterarTelefone() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeTelefone = $('#nome_telefone').val();
        var operadoraTelefone = $('#operadora_telefone').val();
        var idTelefone = $('#id_telefone').val();


        $.ajax({
            url: urlAjaxTelefone + "alterar.php",
            data: {"idtelefone": idTelefone, "nometelefone": nomeTelefone},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_telefone').val('');
            $('#nome_telefone').val('');
            $('#operadora_telefone').val('');
        });
        atualizaTelefone(operadoraTelefone);
        //$("#apresentacaoOperadora").modal("hide");


    }

    function atualizaTelefone(operadoraTelefone) {

        $.ajax({
            url: urlAjaxTelefone + "atualizar.php",
            type: "POST",
            async: false,
            data: {"telefoneoperadora": operadoraTelefone},
            dataTye: "JSON"
        }).done(function (data) {
            data = JSON.parse(data);

            $('#selApresentacaoTelefone').empty();
            $('#apresentacaodocTelefone').empty();

            $('#selApresentacaoTelefone').append($('<option></option>').val('').html('Selecione'));

            for (i = 0; i < data.length; i++) {
                $('#selApresentacaoTelefone').append($('<option></option>').val(data[i].id).html(data[i].nome).html(data[i].operadora));

                $('#apresentacaodocTelefone').append($("<tr onclick=\"acaoTelefone(" + data[i].id + ",'" + data[i].nome + "','" + data[i].operadora + "')\"><td>" + data[i].nome + "</td></tr>"));
            }
        });
    }


    function cancelarTelefone() {
        $("#btnAlterarTelefone").attr("disabled", true);
        $("#botaoExcluirTelefone").attr("disabled", true);
        $("#btnIncluirTelefone").attr("disabled", false);
        $('#id_telefone').val('');
        $('#nome_telefone').val('');
        $('#operadora_telefone').val('');
    }

    function limparTelefone() {
        $("#btnAlterarTelefone").attr("disabled", true);
        $("#botaoExcluirTelefone").attr("disabled", true);
        $("#btnIncluirTelefone").attr("disabled", false);
    }

    function acaoTelefone(id, nome, operadora) {
        $("#id_telefone").val(id);
        $("#nome_telefone").val(nome);
        $("#nome_telefone").focus().val(nome);
        $("#operadora_telefone").val(operadora);
        $("#btnAlterarTelefone").attr("disabled", false);
        $("#botaoExcluirTelefone").attr("disabled", false);
        $("#btnIncluirTelefone").attr("disabled", false);
        $("#botaoCancelarTelefone").attr("disabled", false);
    }
</script>


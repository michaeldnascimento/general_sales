<?php
session_start();

const BASE_TV = '/';
const MODAL_TV = BASE_TV . 'supervisor/';
const AJAX_TV = MODAL_TV . 'ajax/tv/';
$base_ajax_TV = AJAX_TV;
?>
<!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
<style>
    .table-hover > tbody > tr:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>

<div id="principal" name="principal" class="row">
    <form class="form-horizontal" name="comboTV" id="comboTV" method="post">
        <div class="form-group">
            <div class="form-group">
                <div class="col-md-12" style="text-align: center;">
                    <h1 class="featurette-heading">Editando TV</h1>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="inputDescricao" class="col-xs-1 col-sm-2 col-md-3 control-label">Nome:</label>
            <div class="col-xs-12 col-sm-10 col-md-6">
                <input type="hidden" id="id_TV" name="id_TV">
                <input type="hidden" id="operadora_TV" name="operadora_TV">
                <input type="text" id="nome_TV" name="nome_TV" class="form-control" placeholder="Inserir nome plano" onChange="this.value = this.value.toUpperCase()" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="btnIncluirTV" name="btnIncluirTV" onclick="incluirTV()">
                    <span  class="glyphicon glyphicon-plus"></span> Incluir
                </button>
                <button class="btn btn-warning" type="button" id="btnAlterarTV" name="btnAlterarTV" onclick="alterarTV()" disabled>
                    <span  class="glyphicon glyphicon-pencil"></span> Alterar
                </button>
                <button class="btn btn-danger" type="button" id="botaoExcluirTV" name="botaoExcluirTV" onclick="excluirTV()" disabled>
                    <span class="glyphicon glyphicon-remove"></span> Excluir
                </button>
                <button class="btn btn-info" type="button" id="botaoCancelarTV" name="botaoCancelarTV" onclick="cancelarTV()" >
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
            <tbody id="apresentacaodocTV">
            <?php
            $cont = 1;
            foreach ($teve as $key => $col) {
                $obj = (Object)$col;
                echo "<tr onclick='acaoTV(".$obj->id.",\"".$obj->nome."\",\"". $obj->operadora."\");'>" .
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

    let urlAjaxTV = "<?php echo $base_ajax_TV;?>";

    function incluirTV() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeTV = $('#nome_TV').val();
        var operadoraTV = "<?php echo $name_operadora;?>";

        if (nomeTV === '') {
            alert("O campo nome tem que ser preenchido.");
            return false;
        }

        $.ajax({
            url: urlAjaxTV + "incluir.php",
            data: {"nometv": nomeTV, "tvoperadora": operadoraTV},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_TV').val('');
            $('#nome_TV').val('');
            $('#operadora_TV').val('');
        });
        atualizaTV(operadoraTV);
        //$("#apresentacaoTV").modal("hide");


    }

    function excluirTV() {
        //var id = $('#hidIdTipoDoc').val();
        var operadoraTV = $('#operadora_TV').val();
        var idTV = $('#id_TV').val();

        if (confirm('Você deseja mesmo excluir?')) {

            // Save it!
            $.ajax({
                url: urlAjaxTV + "excluir.php",
                data: {"idtv": idTV},
                dataType: "json",
                async: false,
                type: "post"
            }).done(function (data) {
                data = JSON.stringify(data);
                $('#id_TV').val('');
                $('#nome_TV').val('');
                $('#operadora_TV').val('');
            });
            atualizaTV(operadoraTV);
            //$("#apresentacaoTV").modal("hide");

        }

    }

    function alterarTV() {

        //var id = $('#hidIdTipoDoc').val();
        var nomeTV = $('#nome_TV').val();
        var operadoraTV = $('#operadora_TV').val();
        var idTV = $('#id_TV').val();


        $.ajax({
            url: urlAjaxTV + "alterar.php",
            data: {"idtv": idTV, "nometv": nomeTV},
            dataType: "json",
            async: false,
            type: "post"
        }).done(function (data) {
            data = JSON.stringify(data);
            $('#id_TV').val('');
            $('#nome_TV').val('');
            $('#operadora_TV').val('');
        });
        atualizaTV(operadoraTV);
        //$("#apresentacaoOperadora").modal("hide");


    }

    function atualizaTV(operadoraTV) {

        $.ajax({
            url: urlAjaxTV + "atualizar.php",
            type: "POST",
            async: false,
            data: {"tvoperadora": operadoraTV},
            dataTye: "JSON"
        }).done(function (data) {
            data = JSON.parse(data);

            $('#selApresentacaoTV').empty();
            $('#apresentacaodocTV').empty();

            $('#selApresentacaoTV').append($('<option></option>').val('').html('Selecione'));

            for (i = 0; i < data.length; i++) {
                $('#selApresentacaoTV').append($('<option></option>').val(data[i].id).html(data[i].nome).html(data[i].operadora));

                $('#apresentacaodocTV').append($("<tr onclick=\"acaoTV(" + data[i].id + ",'" + data[i].nome + "','" + data[i].operadora + "')\"><td>" + data[i].nome + "</td></tr>"));
            }
        });
    }


    function cancelarTV() {
        $("#btnAlterarTV").attr("disabled", true);
        $("#botaoExcluirTV").attr("disabled", true);
        $("#btnIncluirTV").attr("disabled", false);
        $('#id_TV').val('');
        $('#nome_TV').val('');
        $('#operadora_TV').val('');
    }

    function limparTV() {
        $("#btnAlterarTV").attr("disabled", true);
        $("#botaoExcluirTV").attr("disabled", true);
        $("#btnIncluirTV").attr("disabled", false);
    }

    function acaoTV(id, nome, operadora) {
        $("#id_TV").val(id);
        $("#nome_TV").val(nome);
        $("#nome_TV").focus().val(nome);
        $("#operadora_TV").val(operadora);
        $("#btnAlterarTV").attr("disabled", false);
        $("#botaoExcluirTV").attr("disabled", false);
        $("#btnIncluirTV").attr("disabled", false);
        $("#botaoCancelarTV").attr("disabled", false);
    }
</script>


<?php
session_start();

    //gera o $link com o banco de dados
    include "../funcoes/conexaoPortari.php";
    include "../funcoes/funcoes_geraisPortari.php";


    $nome_cliente	        = $_POST['nome_contato_cliente'];
    $nome_contato_cliente	= $_POST['nome_contato_cliente'];
    $motivo_cliente         = $_POST['motivo_cliente'];
    $cidade_cliente 	    = $_POST['cidade_cliente'];
    $estado_cliente  	    = $_POST['estado_cliente'];
    $fone_cliente     		= $_POST['fone_cliente'];
    $data_followup_cliente  = $_POST['data_followup_cliente'];
    $hora_followup_cliente  = $_POST['hora_followup_cliente'];
    $nomeUsuario            = $_POST['nomeUsuario'];
    $nomeEquipe            = $_POST['nomeEquipe'];
    $nomeEmpresa           = $_POST['nomeEmpresa'];
    $data_venda            = $_POST['data_venda'];
    $hora_venda            = $_POST['hora_venda'];
    $observacao_cliente    = $_POST['observacao_cliente'];

    $campos = array(
        'nome_cliente',
        'nome_contato_cliente',
        'motivo_cliente',
        'cidade_cliente',
        'estado_cliente',
        'fone_cliente',
        'data_followup_cliente',
        'hora_followup_cliente',
        'nomeUsuario',
        'nomeEquipe',
        'nomeEmpresa',
        'data_venda',
        'hora_venda',
        'observacao_cliente',
    );

    $valores = array(
        $nome_cliente,
        $nome_contato_cliente,
        $motivo_cliente,
        $cidade_cliente,
        $estado_cliente,
        $fone_cliente,
        $data_followup_cliente,
        $hora_followup_cliente,
        $nomeUsuario,
        $nomeEquipe,
        $nomeEmpresa,
        $data_venda,
        $hora_venda,
        $observacao_cliente,
    );


    $queryCliente = gera_insert($campos, $valores, 'clientes');
    $resCliente  = mysqli_query($linkComMysql, $queryCliente);
    $idCliente  = mysqli_insert_id($linkComMysql);


    if ($idCliente != '') {
        $mensagem = "TABULACAO FOI SALVA COM SUCESSO";
    }

    else {
        $mensagem = "NAO FOI POSSIVEL SALVAR SUA TABULACAO";

    }

    $_SESSION['mensagem'] = $mensagem;
    header("location: ../vendedor/minha-agendaRetornos.php");

<?php

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'dao/PainelDAO.class.php';

//transforma a variavel global $_POST em um objeto
$post = new stdClass();
foreach ($_POST as $k => $v) {
    $post->$k = $v;
}

//descarta a variavel global $_POST
$_POST = null;
unset($_POST);

$dao = new PainelDAO;

if ( $post->logado == "rogerio.santos@fm.usp.br" || $post->logado == "michael.douglas@fm.usp.br" || $post->logado == "ildo.gomes@fm.usp.br") {
    $bean = $dao->getAllByAnalistas();
} else {
    $bean = $dao->getAllByLogin($post->logado);
}

header("Content-type=application/json; charset=utf-8");
print(json_encode($bean));

//print(json_encode(array("preco" => $bean->preco, "acrescentar" => $bean->acrescentar, "id" => $bean->id)));


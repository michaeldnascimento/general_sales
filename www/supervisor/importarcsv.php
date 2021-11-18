<?php 
session_start();
include_once "../login/verifica.php";
include_once "../funcoes/conexaoPortari.php";
include "../funcoes/funcoes_geraisPortari.php";
//seta o timezone para São Paulo
date_default_timezone_set('America/Sao_Paulo');

//pasta com o arquivo .csv
$target_dir = "csv/";


//nome original do arquivo que está sendo feito o upload
$originalFilename = basename($_FILES["fileToUpload"]["name"]);
$fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);
$lista         = $_POST['lista_sistema'];
$desc          = $_POST['origemCSV'];



//seta o nome do arquivo que será importado ex: nome_dia-mes-ano_hora-minuto-segundo.csv
$target_file = $target_dir.basename($originalFilename, ".".$fileExtension)."_".date('d-m-Y_H-i-s').".".$fileExtension;

$id_mailing  = basename($originalFilename)."_".date('d-m-Y_H-i-s');


//verifica se a extensão do arquivo é csv
if($fileExtension != 'csv') {
  $mensagem = "O arquivo deve ser .csv<br/>";
  $uploadOk = 0;
} 

//verifica se o upload foi feito com sucesso
if($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
  $mensagem = "Upload feito com sucesso<br />";
  $uploadOk = 1;
} else {
  $mensagem = "Upload falhou, codigo do erro: " . $_FILES['
  ']['error'];
  $uploadOk = 0;
}

//move o arquivo para a pasta /csv
if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {



  //query mysql que faz a importação para o banco a partir do arquivo csv no servidor
  //echo dirname(__FILE__)."/".$target_file;

if ($lista == 'TVBASE' OR $lista == 'MULTIBASE' OR $lista == 'EXCLUSIVO' OR $lista == 'PROSPECT' OR $lista == 'SKY' OR $lista == 'NET' OR $lista == 'TIM' OR $lista == 'VIVO' OR $lista == 'CLARO' OR $lista == 'HUGHES' OR $lista == 'OPORTUNIDADES' OR $lista == 'CORPORATIVO' OR $lista == 'GERAL') {

$query = "LOAD DATA LOCAL INFILE '".dirname(__FILE__)."/".$target_file."' INTO TABLE clientes FIELDS TERMINATED BY ';' IGNORE 1 LINES
    (codigoAntigo_cliente, codigo_cliente, nome_contato_cliente, nome_mae_cliente, cpf_cnpj_cliente, rg_ie_cliente, email_cliente, status, cidade_cliente, numHP_cliente, endereco_cliente, cep_cliente, fone_cliente, celular_cliente, fone3_cliente, fone4_cliente, fone5_cliente, observacao_cliente)
  SET ID_CLIENTE = NULL, id_mailing = '$id_mailing', lista_sistema = '$lista', origemCSV = '$desc'";

$result = mysqli_query($linkComMysql, $query);

//echo $query;
//exit;

}


  //retorna sucesso ou algum eventual erro com a query
  if($result) {
    $mensagem = "Csv importado com sucesso!";
  } else {
    $mensagem = "Query invalida: ";
  }

  //fecha a conexão com o banco de dados
  mysqli_close($linkComMysql);
} else {
  $mensagem = "Ocorreu um erro com a importacao<br/>";
}

  $_SESSION['mensagem'] = $mensagem;
  header("location: importcvs.php");


?>



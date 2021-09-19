<?php 
session_start();
include_once "../login/verifica.php";
//seta o timezone para São Paulo
date_default_timezone_set('America/Sao_Paulo');
$lista = strval($_GET['lista']);

//pasta com o arquivo .csv
$target_dir = "csv/";


//nome original do arquivo que está sendo feito o upload
$originalFilename = basename($_FILES["fileToUpload"]["name"]);
$fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

//seta o nome do arquivo que será importado ex: nome_dia-mes-ano_hora-minuto-segundo.csv
$target_file = $target_dir.basename($originalFilename, ".".$fileExtension)."_".date('d-m-Y_H-i-s').".".$fileExtension;


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
  //Configurações MySql
  $server = 'rstelecom.mysql.uhserver.com'; //servidor mysql
  $database = 'rstelecom'; //nome do banco
  $tableName = 'logins'; //nome da tabela
  $username = 'portari'; //usuÃ¡rio do mysql
  $password = 'Brasil@2016'; //senha do usuÃ¡rio mysql

  //cria a conexão com o mysql
  $connect = mysql_connect($server, $username, $password);

  //retorna erro se a conexão não foi feita
  if(!$connect) {
    $mensagem = "Nao foi possível conectar: ".mysql_error();
  }

  //seleciona o banco de dados
  $database = mysql_select_db($database, $connect);

  //query mysql que faz a importação para o banco a partir do arquivo csv no servidor
  //echo dirname(__FILE__)."/".$target_file;
  $query = "LOAD DATA LOCAL INFILE
    '".dirname(__FILE__)."/".$target_file."' INTO TABLE ".$tableName."
    FIELDS TERMINATED BY ';'
  IGNORE 1 LINES
    (lista_login, situacao_login, login, senha, data_reset, data_caiu, rg, cpf, data_nasc, nome, origem, site_local, departamento, cargo, matricula, centro_custo, enviado)
  SET id_login = NULL";

//echo $query;
$result = mysql_query($query, $connect);

//echo $query . "<br><br>";
//exit;


  //retorna sucesso ou algum eventual erro com a query
  if($result) {
    $mensagem = "Csv importado com sucesso!";
  } else {
    $mensagem = "Query invalida: ".mysql_error();
  }

  //fecha a conexão com o banco de dados
  mysql_close($connect);
} else {
  $mensagem = "Ocorreu um erro com a importacao<br/>";
}

    if ($lista == 'CITRIX') {
    $_SESSION['mensagem'] = $mensagem;
    header("location: listacitrix.php");
    exit;
    }

    if ($lista == 'SMS') {
    $_SESSION['mensagem'] = $mensagem;
    header("location: listasms.php");
    exit;
    }


?>



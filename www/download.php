<?php


// Define o tempo máximo de execução em 0 para as conexões lentas
set_time_limit(0);
// Arqui você faz as validações e/ou pega os dados do banco de dados
$id = intval($_GET['id']);
$lista = strval($_GET['lista']);
$aquivoNome = strval($_GET['file']); // nome do arquivo que será enviado p/ download
$arquivoLocal = '../audiomultisales/'.$aquivoNome; // caminho absoluto do arquivo.



// Aqui você pode aumentar o contador de downloads
// Definimos o novo nome do arquivo
$novoNome = 'audio-id-'.$id.'.MP3';
//echo $arquivoLocal;
//exit;
// Configuramos os headers que serão enviados para o browser
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="'.$novoNome.'"');
header('Content-Type: audio/mpeg');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($aquivoNome));
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Expires: 0');
// Envia o arquivo para o cliente
ob_end_clean(); //essas duas linhas antes do readfile
flush();
readfile($arquivoLocal);

?>
<?php

   //determina um tempo para a variável $tempo
   date_default_timezone_set('America/Sao_Paulo');
   $tempo = date('Y-m-d H:i:s'); //data atual

   // pega o IP do usuário
   $ip = $_SERVER['REMOTE_ADDR'];

   //faz uma consulta para verificar se o ip já existe no banco de dados
   $verifica = "SELECT * FROM online WHERE usuario_online ='$nomeUsuario'";
   $resu = mysqli_query($linkComMysql, $verifica);

   //retorna a quantidade de linhas da consulta ou seja, pode retornar 0 ou 1 linha
   $linhas  = mysqli_num_rows($resu); 

   //se não existir o ip no banco ele grava um com um tempo determinado
   if($linhas == 0)
   {
      // gravando o IP e o tempo no DB
      $acrescenta = "INSERT INTO online (usuario_online, ip_online, tempo_online) VALUES ('$nomeUsuario', '$ip', '$tempo')";
      $acres = mysqli_query($linkComMysql, $acrescenta);
   }
   else
   {
      // se o IP já existe ele o pega e atualiza o tempo no DB no IP selecionado
      //pega o IP retornado da consulta

      //faz um update para o registro do IP existente
      $atualiza = "UPDATE online SET ip_online = '$ip', tempo_online ='$tempo' WHERE usuario_online ='$nomeUsuario'"; 
      $att = mysqli_query($linkComMysql, $atualiza);
   }

?>
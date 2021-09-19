<?php
session_start();


		$img_multisales = $_FILES['img_multisales']['name'];
		$diretorio = "../print/" . $img_multisales;
		
		if (move_uploaded_file($_FILES['img_multisales']['tmp_name'], $diretorio)){
             $mensagem = "Imagem enviada...";
			 $_SESSION['mensagem'] = $mensagem;
		}else{

			$mensagem = "Imagem não enviada...";
			$_SESSION['mensagem'] = $mensagem;
		}



header("location: insert-img.php");


 ?>
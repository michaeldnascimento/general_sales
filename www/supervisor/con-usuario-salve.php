<?php
session_start();

if (isset($_POST) && isset($_GET['id']) && intval($_GET['id']) > 0) {

		if ($_POST['usuario_login'] !="" &&  $_POST['senha_login'] !=""){

				include "../funcoes/conexaoPortari.php";
				include "../funcoes/funcoes_geraisPortari.php";

				//Cliente
				$nome_usuario_login     		= $_POST['nome_usuario_login'];
				$usuario_login   				= $_POST['usuario_login'];
				$statusUsuario_login        	= $_POST['statusUsuario_login'];
				$senha_login        			= $_POST['senha_login'];
				$funcao_login        			= $_POST['funcao_login'];
				$departamento_login   			= $_POST['departamento_login'];
				$turno_login		    		= $_POST['turno_login'];
				$equipe_login	        		= $_POST['equipe_login'];
				$empresa_login	        		= $_POST['empresa_login'];
				$nivel_login   					= $_POST['nivel_login'];
				$acessoSP_login        			= $_POST['acessoSP_login'];
				$acessoBR_login 	   			= $_POST['acessoBR_login'];
				$acessoSL_login 	   			= $_POST['acessoSL_login'];
				$acessoRX_login        			= $_POST['acessoRX_login'];
				$acessoMT_login	    			= $_POST['acessoMT_login'];
				$acessoUTI_login	    		= $_POST['acessoUTI_login'];
				$acessoPROPOSTA_login   		= $_POST['acessoPROPOSTA_login'];
				$acessoPROSPECTS_login 			= $_POST['acessoPROSPECTS_login'];
				$acessoME_login  				= $_POST['acessoME_login'];
				$acessoCE_login    				= $_POST['acessoCE_login'];
				$acessoCLARO_login          	= $_POST['acessoCLARO_login'];
                $acessoOportunidadeClaro_login  = $_POST['acessoOportunidadeClaro_login'];
				$acessoCANC_login       		= $_POST['acessoCANC_login'];
				$acessoMultibase_login 			= $_POST['acessoMultibase_login'];
				$acessoLEADSITE_login 			= $_POST['acessoLEADSITE_login'];
				$acessoOportunidadeSite_login   = $_POST['acessoOportunidadeSite_login'];
				$acessoOportunidadeSAC_login    = $_POST['acessoOportunidadeSAC_login'];
				$acessoVIVO_login        = $_POST['acessoVIVO_login'];
				$acessoTIM_login         = $_POST['acessoTIM_login'];
				$acessoHUGHES_login      = $_POST['acessoHUGHES_login'];
				$acessoGERAL_login      = $_POST['acessoGERAL_login'];
				$acessoNET_login         = $_POST['acessoNET_login'];
				$acessoVENDARS_login   			= $_POST['acessoVENDARS_login'];
				$acessoPARCEIROS_login  		= $_POST['acessoPARCEIROS_login'];
				$acessoTODOS_login      		= $_POST['acessoTODOS_login'];
				
				$idLogin             			= $_GET['id'];

				
/***************************************************EDITAR clientes ***************************************/
		

	
				$campos = array(
				'nome_usuario_login',
				'usuario_login',
	  			'senha_login',
	  			'statusUsuario_login',
	   			'funcao_login',
	   			'departamento_login',
	   			'turno_login',
	   			'equipe_login',
	   			'empresa_login',
	   			'nivel_login',
	   			'acessoSP_login',
	   			'acessoBR_login',
	   			'acessoSL_login',
	   			'acessoRX_login',
	   			'acessoMT_login',
	   			'acessoUTI_login',
	   			'acessoPROPOSTA_login',
	   			'acessoPROSPECTS_login',
	   			'acessoME_login',
	   			'acessoCE_login',
	   		    'acessoCLARO_login',
	   			'acessoOportunidadeClaro_login',
	   			'acessoCANC_login',
	   			'acessoMultibase_login',
	   			'acessoLEADSITE_login',
	   			'acessoOportunidadeSite_login',
	   			'acessoOportunidadeSAC_login',
	   			'acessoVIVO_login',
	   			'acessoTIM_login',
	   			'acessoHUGHES_login',
	   			'acessoGERAL_login',
	   			'acessoNET_login',
	   			'acessoVENDARS_login',
	   			'acessoPARCEIROS_login',
	   			'acessoTODOS_login'
	   			//'comprou_cliente'
				);//campos da tabela cliente

				$valores = array(
				$nome_usuario_login,
			    $usuario_login,
	  			$senha_login,
	  			$statusUsuario_login,
	   			$funcao_login,
	   			$departamento_login,
	   			$turno_login,
	   			$equipe_login,
	   			$empresa_login,
	   			$nivel_login,
	   			$acessoSP_login,
	   			$acessoBR_login,
	   			$acessoSL_login,
	   			$acessoRX_login,
	   			$acessoMT_login,
	   			$acessoUTI_login,
	   			$acessoPROPOSTA_login,
	   			$acessoPROSPECTS_login,
	   			$acessoME_login,
	   			$acessoCE_login,
	   			$acessoCLARO_login,
	   			$acessoOportunidadeClaro_login,
	   			$acessoCANC_login,
	   			$acessoMultibase_login,
	   			$acessoLEADSITE_login,
	   			$acessoOportunidadeSite_login,
	   			$acessoOportunidadeSAC_login,
	   		    $acessoVIVO_login,
	   			$acessoTIM_login,
	   			$acessoHUGHES_login,
	   			$acessoGERAL_login,
	   			$acessoNET_login,
	   			$acessoVENDARS_login,
	   			$acessoPARCEIROS_login,
	   			$acessoTODOS_login
				//$comprou_cliente
				);//valores cliente


				$whereUsuario = array('id_login' => $idLogin);

				$queryUsuario = gera_update($campos, $valores, 'usuario', $whereUsuario);

				
				$resCliente  = mysqli_query($linkComMysql, $queryUsuario);
	
//testes			
//echo $queryUsuario . "<br><br>";
//exit;

	/*			
	//MODOS DE TESTE
	    1 exit("TEXTO GERADO: {$queryCliente}");
		2 exit($query);
		3 echo "<pre>";
		3 print_r($resCliente);		
	*/		

	

/***************************************************MENSAGENS DO SISTEMA ***************************************/

			if ($resCliente){
				$mensagem = "Usuario alterado com sucesso";
			    }

			else{
					$mensagem = "Nao foi possivel atualizar os dados de contato.
								por favor entra em contato com o administador do sistema";
			    }
		
	}
	
			else{
				$mensagem = "Necessario preencher todos os campos";
			    }

}
	
	else {// se não vier dados postados da via $_POST
		$mensagem = "Erro na envio dos dados";

	}



			$_SESSION['mensagem'] = $mensagem;
			header("location: con-usuario-lista.php");


 ?>
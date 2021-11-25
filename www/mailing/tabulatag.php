<?php 
session_start();

$lista = strval($_GET['lista']);
if(isset($_POST['id_contato']) && intval($_POST['id_contato']) > 0){


	//gera o $link com o banco de dados
	include "../funcoes/conexaoPortari.php";
	include "../funcoes/funcoes_geraisPortari.php";


//Cliente
    $id 			             = $_POST['id_contato'];
    $nome_cliente       	     = $_POST['nome_cliente'];
    $nome_contato_cliente      	 = $_POST['nome_contato_cliente'];
    $rg_ie_cliente          	 = $_POST['rg_ie_cliente'];
    $cpf_cnpj_cliente         	 = $_POST['cpf_cnpj_cliente'];
    $data_nasc_cliente           = $_POST['data_nasc_cliente'];
    $tipo_pessoa_cliente		 = $_POST['tipo_pessoa_cliente'];
    $sexo_cliente			     = $_POST['sexo_cliente'];
    $nome_mae_cliente            = $_POST['nome_mae_cliente'];
    $email_cliente               = $_POST['email_cliente'];
    $ddd_fone_cliente 	 	     = $_POST['ddd_fone_cliente'];
    $fone_cliente 	     	     = $_POST['fone_cliente'];
    $ddd_celular_cliente 	     = $_POST['ddd_celular_cliente'];
    $celular_cliente 	         = $_POST['celular_cliente'];
    $ddd_fone3_cliente 	 	     = $_POST['ddd_fone3_cliente'];
    $fone3_cliente 	     	     = $_POST['fone3_cliente'];
    $ddd_fone4_cliente 	 	     = $_POST['ddd_fone4_cliente'];
    $fone4_cliente 	     	     = $_POST['fone4_cliente'];
    $origemCSV 	     	         = $_POST['origemCSV'];
    $cep_cliente 	     	     = $_POST['cep_cliente'];
    $endereco_cliente 	         = $_POST['endereco_cliente'];
    $enderecoNumero_cliente 	 = $_POST['enderecoNumero_cliente'];
    $enderecoComplemento_cliente = $_POST['enderecoComplemento_cliente'];
    $observacao_cliente          = $_POST['observacao_cliente'];
    $bairro_cliente 	         = $_POST['bairro_cliente'];
    $cidade_cliente      	     = $_POST['cidade_cliente'];
    $estado_cliente      	     = $_POST['estado_cliente'];
    $tv_venda_cliente            = $_POST['tv_venda_cliente'];
    $internet_venda_cliente      = $_POST['internet_venda_cliente'];
    $netfone_venda_cliente       = $_POST['netfone_venda_cliente'];
    $portfone_venda_cliente      = $_POST['portfone_venda_cliente'];
    $netcelular_venda_cliente    = $_POST['netcelular_venda_cliente'];
    $portcelular_venda_cliente   = $_POST['portcelular_venda_cliente'];
    $plano_multi_cliente         = $_POST['plano_multi_cliente'];
    $qtdchip_multi_cliente       = $_POST['qtdchip_multi_cliente'];
    $agregado_venda_cliente      = $_POST['agregado_venda_cliente'];
    $tipo_servico     		     = $_POST['tipo_servico'];
    $numPacote_venda_cliente     = $_POST['numPacote_venda_cliente'];
    $valor_venda_cliente         = $_POST['valor_venda_cliente'];
    $formaPagemento_cliente      = $_POST['formaPagemento_cliente'];
    $vencimentoPagamento_cliente = $_POST['vencimentoPagamento_cliente'];
    $pagamentoBanco_cliente      = $_POST['pagamentoBanco_cliente'];
    $pagamentoAgencia_cliente    = $_POST['pagamentoAgencia_cliente'];
    $pagamentoConta_cliente      = $_POST['pagamentoConta_cliente'];
    $foneContato_venda_cliente   = $_POST['foneContato_venda_cliente'];
    $observacao_venda_cliente    = $_POST['observacao_venda_cliente'];
    $motivo_cliente              = $_POST['motivo_cliente'];
    $statusVenda_venda_cliente   = $_POST['statusVenda_venda_cliente'];
    $lista_sistema  			 = $_POST['lista_sistema'];
    $flag          				 = $_POST['flag'];
    $nomeUsuario                 = $_POST['nomeUsuario'];
    $nomeEquipe         	     = $_POST['nomeEquipe'];
    $nomeEmpresa         	     = $_POST['nomeEmpresa'];
    $login_net                   = $_POST['login_net'];
    $data_venda         	     = $_POST['data_venda'];
    $hora_venda         	     = $_POST['hora_venda'];

    $campos = array(
        'nome_cliente',
        'nome_contato_cliente',
        'rg_ie_cliente',
        'cpf_cnpj_cliente',
        'data_nasc_cliente',
        'tipo_pessoa_cliente',
        'sexo_cliente',
        'nome_mae_cliente',
        'email_cliente',
        'ddd_fone_cliente',
        'fone_cliente',
        'ddd_celular_cliente',
        'celular_cliente',
        'ddd_fone3_cliente',
        'fone3_cliente',
        'ddd_fone4_cliente',
        'fone4_cliente',
        'origemCSV',
        'cep_cliente',
        'endereco_cliente',
        'enderecoNumero_cliente',
        'enderecoComplemento_cliente',
        'observacao_cliente',
        'bairro_cliente',
        'cidade_cliente',
        'estado_cliente',
        'tv_venda_cliente',
        'internet_venda_cliente',
        'netfone_venda_cliente',
        'portfone_venda_cliente',
        'netcelular_venda_cliente',
        'portcelular_venda_cliente',
        'plano_multi_cliente',
        'qtdchip_multi_cliente',
        'agregado_venda_cliente',
        'tipo_servico',
        'numPacote_venda_cliente',
        'valor_venda_cliente',
        'formaPagemento_cliente',
        'vencimentoPagamento_cliente',
        'pagamentoBanco_cliente',
        'pagamentoAgencia_cliente',
        'pagamentoConta_cliente',
        'foneContato_venda_cliente',
        'observacao_venda_cliente',
        'motivo_cliente',
        'statusVenda_venda_cliente',
        'lista_sistema',
        'flag',
        'nomeUsuario',
        'nomeEquipe',
        'nomeEmpresa',
        'login_net',
        'data_venda',
        'hora_venda'

    );//campos da tabela cliente

    $valores = array(
        $nome_cliente,
        $nome_contato_cliente,
        $rg_ie_cliente,
        $cpf_cnpj_cliente,
        $data_nasc_cliente,
        $tipo_pessoa_cliente,
        $sexo_cliente,
        $nome_mae_cliente,
        $email_cliente,
        $ddd_fone_cliente,
        $fone_cliente,
        $ddd_celular_cliente,
        $celular_cliente,
        $ddd_fone3_cliente,
        $fone3_cliente,
        $ddd_fone4_cliente,
        $fone4_cliente,
        $origemCSV,
        $cep_cliente,
        $endereco_cliente,
        $enderecoNumero_cliente,
        $enderecoComplemento_cliente,
        $observacao_cliente,
        $bairro_cliente,
        $cidade_cliente,
        $estado_cliente,
        $tv_venda_cliente,
        $internet_venda_cliente,
        $netfone_venda_cliente,
        $portfone_venda_cliente,
        $netcelular_venda_cliente,
        $portcelular_venda_cliente,
        $plano_multi_cliente,
        $qtdchip_multi_cliente,
        $agregado_venda_cliente,
        $tipo_servico,
        $numPacote_venda_cliente,
        $valor_venda_cliente,
        $formaPagemento_cliente,
        $vencimentoPagamento_cliente,
        $pagamentoBanco_cliente,
        $pagamentoAgencia_cliente,
        $pagamentoConta_cliente,
        $foneContato_venda_cliente,
        $observacao_venda_cliente,
        $motivo_cliente,
        $statusVenda_venda_cliente,
        $lista_sistema,
        $flag,
        $nomeUsuario,
        $nomeEquipe,
        $nomeEmpresa,
        $login_net,
        $data_venda,
        $hora_venda

    );//valores cliente



		$whereCliente = array('id_cliente' => $id);
		$queryCliente = gera_update($campos, $valores, 'clientes', $whereCliente);
		$resCliente  = mysqli_query($linkComMysql, $queryCliente);


//testes
//echo $queryCliente . "<br><br>";
//exit;

    //se o motivo cliente for de um determinado grupo ele se direciona a pagina corespondente
    if ($motivo_cliente == 'VENDA - NOVO CLIENTE') {
        header("location: contratogerando_cliente.php?id=$id&lista=$lista");
        exit;
    }


    if ($motivo_cliente == 'VENDA - UPGRADE + MULTI' ) {
        header("location: contratogerando_cliente.php?id=$id&lista=$lista");
        exit;
    }


    if ($motivo_cliente == 'VENDA - BASE TV' ) {
        header("location: contratogerando_cliente.php?id=$id&lista=$lista");
        exit;
    }


		if ($resCliente) {
		$mensagem = "TABULACAO FOI SALVA COM SUCESSO";
		}

		else {
		$mensagem = "NAO FOI POSSIVEL SALVAR SUA TABULACAO";

		}


                if ($lista == 'TAG') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-tag.php");
				exit;
				}

                if ($lista == 'RETORNO') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../vendedor/minha-agendaRetornos.php");
                    exit;
                }



} else{//se não veio o id
		$mensagem = "POR FAVOR TENTE NOVAMENTE, NAO FOI POSSIVEL SALVAR A TABULACAO.";



                if ($lista == 'TAG') {
				$_SESSION['mensagem'] = $mensagem;
				header("location: ../mailing/oportunidades-tag.php");
				exit;
				}

                if ($lista == 'RETORNO') {
                    $_SESSION['mensagem'] = $mensagem;
                    header("location: ../vendedor/minha-agendaRetornos.php");
                    exit;
                }



}
 ?>
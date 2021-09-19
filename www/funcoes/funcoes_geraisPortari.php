<?php
ini_set('default_charset', 'UTF-8'); 


function gera_select($_arrayCampos, $_arrayTabela, $_arrayWhere){
		$query = "SELECT ";
		$query .= implode(",", $_arrayCampos);
		$query .= " FROM ";

		$ant = 0;

		$qtdTabelas = count($_arrayTabela);

		for ($i= 0; $i < count($_arrayTabela); $i++) { 
			
			if( $qtdTabelas > 0 ){// se houver apenas uma tabela
				
				if($i == 0) {
					$query .= " {$_arrayTabela[$i][0]}"	;
				} else {// a partir da segunda tabela
					$ant = $i -1;
					$query .= " INNER JOIN {$_arrayTabela[$i][0]} ON {$_arrayTabela[$i][0]}.{$_arrayTabela[$i][1]} = {$_arrayTabela[$ant][0]}.{$_arrayTabela[$ant][1]}";
				}

				$ant++;


			} else {
				$query .= " {$_arrayTabela[$i][0]}"	;
			}

			
		}

		$campo = key($_arrayWhere);
		$valor = $_arrayWhere[$campo];

		$query .= " WHERE {$campo} = '{$valor}' ";

		return $query;




}


function gera_insert($_arrayCampos, $_arrayValores, $_tabela){
	$query = "";
	
	$query .= "INSERT INTO {$_tabela} (";
	
	$query .= implode(", ", $_arrayCampos);
	
	$query .= ") VALUES (";

	$query .= "UPPER('";

	$query .= implode("'), UPPER('",  $_arrayValores);
	
	$query .= "'";
	
	$query .="));"; 

	return $query;


}

function gera_insert2($_arrayCampos, $_arrayValores, $_tabela){
	$query = "";
	
	$query .= "INSERT INTO {$_tabela} (";
	
	$query .= implode(", ", $_arrayCampos);
	
	$query .= ") VALUES (";

	$query .= "'";

	$query .= implode("','",  $_arrayValores);
	
	$query .= "'";
	
	$query .=");"; 

	return $query;


}
// SET NAMES utf8



function gera_update($_arrayCampos, $_arrayValores, $_tabela, $wheres){
	$retorno = false;

	if (count($wheres) > 0) {
		
		$query = "";
	
		$query .= "UPDATE {$_tabela} SET ";


		foreach ($_arrayCampos as $key => $value) {
			$query .= "{$value} = UPPER('{$_arrayValores[$key]}'), ";
		}

		$query = substr($query, 0, -2);//pra tira a ultima virgula

		$query .= " WHERE ";

		foreach ($wheres as $campo => $valor) {
			$query .= "{$campo} =  '{$valor}' AND ";
		}

		$query = substr($query, 0, -4);//pra tira a ultima AND


		$retorno = $query;

	}

	return $retorno;
}

function gera_update2($_arrayCampos, $_arrayValores, $_tabela, $wheres){
	$retorno = false;

	if (count($wheres) > 0) {
		
		$query = "";
	
		$query .= "UPDATE {$_tabela} SET ";


		foreach ($_arrayCampos as $key => $value) {
			$query .= "{$value} = '{$_arrayValores[$key]}', ";
		}

		$query = substr($query, 0, -2);//pra tira a ultima virgula

		$query .= " WHERE ";

		foreach ($wheres as $campo => $valor) {
			$query .= "{$campo} =  '{$valor}' AND ";
		}

		$query = substr($query, 0, -4);//pra tira a ultima AND


		$retorno = $query;

	}

	return $retorno;
}


function gera_delete($_tabela, $wheres){
	$query ="";

	$query ="DELETE FROM {$_tabela}";

	$query .= " WHERE ";

		foreach ($wheres as $campo => $valor) {
			$query .= "{$campo} =  '{$valor}' AND ";
		}

		$query = substr($query, 0, -4);//pra tira a ultima AND


	return $query;

}


?>
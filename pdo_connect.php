<?php
	
	function executeQuery($qry, $bnds = NULL) {
		$PDO = new PDO("mysql:host=localhost;dbname=sticky", "root", "toor");

		$result = array(
			'error' => null,
			'rows' => null,
			'insert_id' => null,
			'affected_rows' => null
		);
		
		$stmt = $PDO -> prepare($qry);

		if(!$stmt -> execute($bnds)){
			$result['error'] = $stmt->errorInfo();	
		}

		$result['rows'] = $stmt -> fetchAll(PDO::FETCH_ASSOC);
		$result['insert_id'] = $PDO -> lastInsertId('id');
		$result['affected_rows'] = $stmt->rowCount();
		return $result;
	}
?>
 

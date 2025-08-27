<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	try {
		$stmt = $pdo->prepare("
			SELECT cidadeestado.codigo, 
				   CONCAT(cidadeestado.cidade,' - ', estado.abreviacao) AS cidade 
			FROM cidadeestado 
			INNER JOIN estado 
				ON estado.codigo = cidadeestado.estado
		");
		$stmt->execute();
		$arrCombo = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
	} 
	catch(PDOException $e) {
		echo 'Erro: ' . $e->getMessage();
	}

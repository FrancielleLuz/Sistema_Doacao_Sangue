<?php
	require_once __DIR__ . '/../_bootstrap.php'; // Conexão com o banco de dados

	try {
		$stmt = $pdo->prepare(
			'SELECT 
				tutor.*,
				cidadeestado.cidade,
				cidadeestado.estado
			FROM tutor
			INNER JOIN cidadeestado ON tutor.cidadeestado = cidadeestado.codigo'
		);
		$stmt->execute();
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}

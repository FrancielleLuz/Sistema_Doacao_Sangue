<?php
	require_once __DIR__ . '/../_bootstrap.php'; // Conexão com o banco de dados

	try {
		$stmt = $pdo->prepare(
			'SELECT 
				tutor.*,
				cidadeestado.cidade,
				estado.abreviacao estado
			FROM tutor
			INNER JOIN cidadeestado 
			ON tutor.cidadeestado = cidadeestado.codigo
			INNER JOIN estado 
            ON cidadeestado.estado = estado.codigo
			WHERE
			tutor.codigo=:codigo');
        $stmt->execute(array(':codigo' => $_GET['id']));
		$stmt->execute();
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}

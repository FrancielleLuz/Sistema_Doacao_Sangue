<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	try{ 
		$stmt = $pdo->prepare('SELECT * FROM historicopeso');
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
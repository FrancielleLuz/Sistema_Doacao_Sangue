<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
    
	try{
		$stmt = $pdo->prepare('SELECT * FROM raca');
        
		$stmt->execute();
        $arrCombo3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
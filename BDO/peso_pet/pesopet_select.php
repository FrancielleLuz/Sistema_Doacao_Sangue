<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try{ 
		$stmt = $pdo->prepare('SELECT * FROM historicopeso WHERE historicopeso.codPet=:codPet');
        $stmt->execute(array(':codPet' => $codPet));
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
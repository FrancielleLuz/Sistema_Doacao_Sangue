<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
		
	//Buscando
	try{ 
		$stmt = $pdo->prepare('SELECT * FROM usuario_perfil');
		$stmt->execute();
	} catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	} 
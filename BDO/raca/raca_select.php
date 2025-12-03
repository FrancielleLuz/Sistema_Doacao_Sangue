<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Buscando
	try{ 
		$stmt = $pdo->prepare('SELECT raca.codigo, raca.nome, especie.nome especie 
                               FROM raca 
                               INNER JOIN especie ON 
                               especie.codigo = raca.codespecie');
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
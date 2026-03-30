<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Buscando
	try{ 
		$stmt = $pdo->prepare('SELECT e.*,
								t.nome AS nomeTip
								FROM entradadoacao e
								LEFT JOIN tiposanguineo t ON t.codigo = e.codtip								
								WHERE sitcol = "A"');
		$stmt->execute();
    }
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
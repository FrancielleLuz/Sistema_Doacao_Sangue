<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	try {
		// Seleciona os dados do tutor junto com a cidade
		$stmt = $pdo->prepare('SELECT * FROM tutor WHERE codigo = :codigo');
			$stmt->execute([':codigo' => $_POST['codigo']]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		
		echo json_encode($result);
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}
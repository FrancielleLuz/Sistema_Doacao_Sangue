<?php 
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try {
  		$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE codigo=:codigo');
		$stmt->execute(array(':codigo' => $_POST['codigo']));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		echo json_encode($result);
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

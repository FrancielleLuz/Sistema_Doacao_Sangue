<?php  
	require_once __DIR__ . '/../_bootstrap.php'; // Conexão com o banco

	try {
		// Preparar UPDATE
		$stmt = $pdo->prepare('
			UPDATE tipoSanguineoEspecie 
			SET codEspecie = :codEspecie, codTipoSanguineo = :codTipoSanguineo 
			WHERE codigo = :codigo
		');

		// Executar
		$stmt->execute([
			':codEspecie' => $_POST['codEspecie'] ?? null,
			':codTipoSanguineo' => $_POST['codTipoSanguineo'] ?? null,
			':codigo' => $_POST['codigo'] ?? null
		]);

		echo $stmt->rowCount(); // retorna 1 se atualizou
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}

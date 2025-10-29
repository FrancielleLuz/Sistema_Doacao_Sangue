<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	try {
		if (!isset($_POST['codigo'])) {
			throw new Exception("Código do espécie não informado.");
		}
		
		//Deletanto
		$stmt = $pdo->prepare('DELETE FROM especie WHERE codigo = :codigo');
		$stmt->bindParam(':codigo', $_POST['codigo'], PDO::PARAM_INT);
		$stmt->execute();

		echo $stmt->rowCount(); // retorna 1 se deletou, 0 se não encontrou
	} catch (Exception $e) {
		echo 'Erro: ' . $e->getMessage();
	}
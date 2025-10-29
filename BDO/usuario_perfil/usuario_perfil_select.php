<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
		
	//Buscando
	try{ 
		$stmt = $pdo->prepare('SELECT * FROM usuario_perfil');
		$stmt->execute();
	} catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	} 
	
	try {
    $stmt = $pdo->prepare("SELECT codigo, nome FROM usuario_perfil WHERE situacao = 'A' ORDER BY nome");
    $stmt->execute();
    $perfis = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna em JSON
    header('Content-Type: application/json');
    echo json_encode($perfis);
	} catch (PDOException $e) {
		echo json_encode(["erro" => "Erro ao carregar perfis: " . $e->getMessage()]);
	}
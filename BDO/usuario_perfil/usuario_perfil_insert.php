<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try {
  		$stmt = $pdo->prepare('INSERT INTO usuario_perfil (codigo, nome, situacao) VALUES (null,:nome, :situacao)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':situacao' => $_POST['situacao']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

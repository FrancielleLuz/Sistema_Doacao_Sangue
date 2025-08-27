<?php
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try {
  		$stmt = $pdo->prepare('INSERT INTO usuarios (codigo, nome, email, situacao, login, senha) VALUES (null,:nome, :email, :situacao, :login, :senha)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':email' => $_POST['email'], ':situacao' => $_POST['situacao'], ':login' => $_POST['login'], ':senha' => $_POST['senha']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

		//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO doenca (codigo, nome, descricao) VALUES (null,:nome, :descricao)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':descricao' => $_POST['descricao']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

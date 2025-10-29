<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO tiposanguineo (codigo, nome) 
                                VALUES (null,:nome)');
		$stmt->execute(array(':nome' => $_POST['nome']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
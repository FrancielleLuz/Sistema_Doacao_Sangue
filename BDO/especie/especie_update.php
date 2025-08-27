<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('UPDATE especie SET nome=:nome WHERE codigo=:codigo');
		$stmt->execute(array(':nome' => $_POST['nome'], ':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
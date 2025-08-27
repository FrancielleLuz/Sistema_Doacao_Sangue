<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Deletando
	try {
     
  		$stmt = $pdo->prepare('DELETE FROM vacina WHERE codigo=:codigo');
		$stmt->execute(array(':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
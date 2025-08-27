<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
		
	//Alterando
	try {
     
  		$stmt = $pdo->prepare('UPDATE raca SET nome=:nome, especie=:especie WHERE codigo=:codigo');
		$stmt->execute(array(':nome' => $_POST['nome'], ':especie' => $_POST['especie'],':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
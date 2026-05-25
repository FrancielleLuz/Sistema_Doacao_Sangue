<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO veterinario (nome, crmv, cidadeestado, clinica, telefone) VALUES (:nome, :crmv, :cidadeestado, :clinica, :telefone)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':crmv' => $_POST['crmv'], ':cidadeestado' => $_POST['cidadeestado'], ':clinica' => $_POST['clinica'], ':telefone' => $_POST['telefone']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
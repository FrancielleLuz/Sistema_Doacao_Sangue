<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Alterando
	try {
     
  		$stmt = $pdo->prepare('UPDATE clinica SET razaoSocial=:razaoSocial, cep=:cep WHERE codigo=:codigo');
		$stmt->execute(array(':razaoSocial' => $_POST['razaoSocial'],':cep' => $_POST['cep'], ':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

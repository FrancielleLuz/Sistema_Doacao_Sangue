<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Alterando
	try {
     
  		$stmt = $pdo->prepare('UPDATE doenca SET nome=:nome, descricao=:descricao WHERE codigo=:codigo');
		$stmt->execute(array(':nome' => $_POST['nome'], ':descricao' => $_POST['descricao'],':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	} 
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 
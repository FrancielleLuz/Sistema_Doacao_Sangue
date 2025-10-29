<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('UPDATE usuario_perfil SET nome=:nome, situacao=:situacao WHERE codigo=:codigo');
		$stmt->execute(array(':codigo' => $_POST['codigo'],':nome' => $_POST['nome'], ':situacao' => $_POST['situacao']));
   
		echo $stmt->rowCount(); 
	} catch(PDOExlogintion $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

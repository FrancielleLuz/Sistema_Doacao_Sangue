<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('UPDATE usuarios SET nome=:nome, email=:email, situacao=:situacao, login=:login, senha=:senha WHERE codigo=:codigo');
		$stmt->execute(array(':codigo' => $_POST['codigo'],':nome' => $_POST['nome'], ':email' => $_POST['email'], ':situacao' => $_POST['situacao'], ':login' => $_POST['login'], ':senha' => $_POST['senha']));
   
		echo $stmt->rowCount(); 
	} catch(PDOExlogintion $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

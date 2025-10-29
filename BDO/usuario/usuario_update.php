<?php  
	require_once __DIR__ . '/../_bootstrap.php'; // Conexão com o banco de dados
	
	try {
		$stmt = $pdo->prepare('
			UPDATE usuarios 
			SET nome = :nome,
				email = :email,
				situacao = :situacao,
				login = :login,
				senha = :senha,
				fk_perfil = :fk_perfil
			WHERE codigo = :codigo
		');
		
		$stmt->execute(array(
			':codigo' => $_POST['codigo'],
			':nome' => $_POST['nome'],
			':email' => $_POST['email'],
			':situacao' => $_POST['situacao'],
			':login' => $_POST['login'],
			':senha' => $_POST['senha'],
			':fk_perfil' => $_POST['fk_perfil']
		));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
	}

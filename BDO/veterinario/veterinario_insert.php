<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO veterinario (codigo, nome, cpf, cep, rua, complemento, bairro, cidadeestado, email, telefone, login, senha) VALUES (null,:nome, :cpf, :cep, :rua, :complemento, :bairro, :cidadeestado, :email, :telefone, :login, :senha)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':cpf' => $_POST['cpf'], ':cep' => $_POST['cep'], ':rua' => $_POST['rua'], ':complemento' => $_POST['complemento'], ':bairro' => $_POST['bairro'], ':cidadeestado' => $_POST['cidadeestado'], ':email' => $_POST['email'], ':telefone' => $_POST['telefone'], ':login' => $_POST['login'], ':senha' => $_POST['senha']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
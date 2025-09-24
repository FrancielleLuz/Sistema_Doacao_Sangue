<?php 
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
 

 
	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO tutor (codigo,nome, cpf, dtnascimento, cep, rua, complemento, bairro, cidadeestado, email, telefone) VALUES (null,:nome, :cpf, :dtnascimento, :cep, :rua, :complemento, :bairro, :cidadeestado, :email, :telefone)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':cpf' => $_POST['cpf'], ':dtnascimento' => $_POST['dtnascimento'], ':cep' => $_POST['cep'], ':rua' => $_POST['rua'], ':complemento' => $_POST['complemento'], ':bairro' => $_POST['bairro'], ':cidadeestado' => $_POST['cidadeestado'], ':email' => $_POST['email'], ':telefone' => $_POST['telefone']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 

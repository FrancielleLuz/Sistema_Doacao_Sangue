<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Alterando
	try {
     
  		$stmt = $pdo->prepare('UPDATE tutor SET nome=:nome, cpf=:cpf, dtnascimento=:dtnascimento, cep=:cep, rua=:rua, complemento=:complemento, bairro=:bairro, cidadeestado=:cidadeestado, email=:email, telefone=:telefone, WHERE codigo=:codigo');
		$stmt->execute(array(':nome' => $_POST['nome'], ':cpf' => $_POST['cpf'], ':dtnascimento' => $_POST['dtnascimento'], ':cep' => $_POST['cep'], ':rua' => $_POST['rua'], ':complemento' => $_POST['complemento'], ':bairro' => $_POST['bairro'], ':cidadeestado' => $_POST['cidadeestado'], ':email' => $_POST['email'], ':telefone' => $_POST['telefone'], ':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
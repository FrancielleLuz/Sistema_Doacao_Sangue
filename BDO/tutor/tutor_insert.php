<?php
	require_once __DIR__ . '/../_bootstrap.php'; // conexão com o banco
	
	function limparMascara($valor) {
		return preg_replace('/\D/', '', $valor); // Remove tudo que não é número
	}

	$cpf = limparMascara($_POST['cpf']);
	$telefone = limparMascara($_POST['telefone']);
	$cep = limparMascara($_POST['cep']);
		
	try {
		// Preparar o INSERT
		$stmt = $pdo->prepare('
			INSERT INTO tutor 
				(nome, cpf, dtnascimento, cep, rua, complemento, bairro, cidadeestado, email, telefone)
			VALUES 
				(:nome, :cpf, :dtnascimento, :cep, :rua, :complemento, :bairro, :cidadeestado, :email, :telefone)
		');

		// Executar com os dados vindos do formulário (POST)
		$stmt->execute([
			':nome'        => $_POST['nome'],
			':cpf'         => $_POST['cpf'],
			':dtnascimento'=> $_POST['dtnascimento'],
			':cep'         => $_POST['cep'],
			':rua'         => $_POST['rua'],
			':complemento' => $_POST['complemento'],
			':bairro'      => $_POST['bairro'],
			':cidadeestado'=> $_POST['cidadeestado'], // aqui vai o código da cidade
			':email'       => $_POST['email'],
			':telefone'    => $_POST['telefone']
		]);

		// Retornar mensagem de sucesso e quantidade de registros inseridos
		echo "OK:" . $stmt->rowCount();

	} catch (PDOException $e) {
		// Registrar erro no log e retornar mensagem genérica
		error_log("Erro ao inserir tutor: " . $e->getMessage());
		echo "Erro ao inserir tutor.";
	}

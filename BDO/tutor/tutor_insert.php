<?php
	require_once __DIR__ . '/../_bootstrap.php'; // conexão com o banco

	function limparMascara($valor) {
		return preg_replace('/\D/', '', $valor); // Remove tudo que não é número
	}

	try {
		// Limpar máscaras dos campos numéricos
		$cpf       = limparMascara($_POST['cpf'] ?? '');
		$telefone  = limparMascara($_POST['telefone'] ?? '');
		$cep       = limparMascara($_POST['cep'] ?? '');
		$dataNasc  = $_POST['dtnascimento'] ?? '';

		// Preparar o INSERT
		$stmt = $pdo->prepare('
			INSERT INTO tutor 
				(nome, cpf, dtnascimento, cep, rua, complemento, bairro, cidadeestado, email, telefone)
			VALUES 
				(:nome, :cpf, :dtnascimento, :cep, :rua, :complemento, :bairro, :cidadeestado, :email, :telefone)
		');

		// Executar com os dados vindos do formulário (POST)
		$stmt->execute([
			':nome'         => $_POST['nome'] ?? '',
			':cpf'          => $cpf,
			':dtnascimento' => $dataNasc,
			':cep'          => $cep,
			':rua'          => $_POST['rua'] ?? '',
			':complemento'  => $_POST['complemento'] ?? '',
			':bairro'       => $_POST['bairro'] ?? '',
			':cidadeestado' => $_POST['cidadeestado'] ?? '',
			':email'        => $_POST['email'] ?? '',
			':telefone'     => $telefone
		]);

		echo "OK:" . $stmt->rowCount();
	} catch (PDOException $e) {
		echo "Erro ao inserir tutor: " . $e->getMessage();
	}

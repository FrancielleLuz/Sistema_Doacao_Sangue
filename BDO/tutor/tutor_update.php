<?php
	require_once __DIR__ . '/../_bootstrap.php'; // conexão (usa $pdo)

	// não mostrar erros na saída (para não quebrar o AJAX)
	// mas registrar no log do servidor
	error_reporting(E_ALL);
	ini_set('display_errors', 0);

	// registrar POST recebido no log (útil para debug)
	error_log("tutor_update.php POST: " . print_r($_POST, true));

	try {
		// Verifica se o código foi enviado
		if (!isset($_POST['codigo']) || trim($_POST['codigo']) === '') {
			echo "ERROR: Código não informado.";
			exit;
		}
		
		function limparMascara($valor) {
			return preg_replace('/\D/', '', $valor); // Remove tudo que não é número
		}

		$cpf = limparMascara($_POST['cpf']);
		$telefone = limparMascara($_POST['telefone']);
		$cep = limparMascara($_POST['cep']);


		// Recebe os campos (ajuste nomes se seus campos forem diferentes)
		$codigo = $_POST['codigo'];
		$nome = $_POST['nome'] ?? null;
		$cpf = $_POST['cpf'] ?? null;
		$dtnascimento = $_POST['dtnascimento'] ?? null;
		$cep = $_POST['cep'] ?? null;
		$rua = $_POST['rua'] ?? null;
		$complemento = $_POST['complemento'] ?? null;
		$bairro = $_POST['bairro'] ?? null;
		$cidadeestado = $_POST['cidadeestado'] ?? null; // deve ser o código da cidade
		$email = $_POST['email'] ?? null;
		$telefone = $_POST['telefone'] ?? null;

		// Prepara e executa o UPDATE
		$sql = "UPDATE tutor
				SET nome = :nome,
					cpf = :cpf,
					dtnascimento = :dtnascimento,
					cep = :cep,
					rua = :rua,
					complemento = :complemento,
					bairro = :bairro,
					cidadeestado = :cidadeestado,
					email = :email,
					telefone = :telefone
				WHERE codigo = :codigo";

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
			':nome' => $nome,
			':cpf' => $cpf,
			':dtnascimento' => $dtnascimento,
			':cep' => $cep,
			':rua' => $rua,
			':complemento' => $complemento,
			':bairro' => $bairro,
			':cidadeestado' => $cidadeestado,
			':email' => $email,
			':telefone' => $telefone,
			':codigo' => $codigo
		]);

		$rows = $stmt->rowCount();
		error_log("tutor_update.php: UPDATE executado para codigo={$codigo}, linhas afetadas={$rows}");

		// Retorna texto simples para o AJAX (não JSON -- mantém compatibilidade com seu JS atual)
		if ($rows > 0) {
			echo "OK";
		} else {
			// 0 linhas pode significar "nenhuma mudança" ou código não encontrado
			echo "OK:0";
		}
		exit;
	} catch (PDOException $e) {
		error_log("tutor_update.php Erro PDO: " . $e->getMessage());
		echo "ERROR: " . $e->getMessage(); // será capturado no front-end
		exit;
	}

<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try{ 
		$stmt = $pdo->prepare('Select 
								tutor.nome,tutor.dtNascimento,tutor.cpf,tutor.telefone,tutor.email,tutor.cep,tutor.rua,tutor.complemento,tutor.bairro,
								cidadeestado.cidade,estado.abreviacao estado,
								pet.nome pet,pet.doador,especie.nome especie
							FROM tutor 
								INNER JOIN pet ON
								pet.codTutor = tutor.codigo
								INNER JOIN especie ON 
								especie.codigo = pet.codEspecie
								INNER JOIN cidadeestado 
								ON tutor.cidadeestado = cidadeestado.codigo
								INNER JOIN estado 
								ON cidadeestado.estado = estado.codigo
								WHERE
								tutor.codigo=:codigo');
        $stmt->execute(array(':codigo' => $_GET['id']));
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
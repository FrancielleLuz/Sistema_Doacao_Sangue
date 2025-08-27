<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try{ 
		$stmt = $pdo->prepare('SELECT vacina.codigo, vacina.nome FROM vacinapet
                               INNER JOIN vacina ON
                               vacina.codigo = vacinapet.codVacina
                               WHERE vacinapet.codPet=:codPet');
        $stmt->execute(array(':codPet' => $codPet));
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
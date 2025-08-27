<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try{ 
		$stmt = $pdo->prepare('SELECT doenca.codigo, doenca.nome FROM doencapet
                               INNER JOIN doenca ON
                               doenca.codigo = doencapet.codDoenca
                               WHERE doencapet.codPet=:codPet');
        $stmt->execute(array(':codPet' => $codPet));
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	try{ 
		$stmt = $pdo->prepare('SELECT exame.codigo, exame.nome FROM examepet
                               INNER JOIN exame ON
                               exame.codigo = examepet.codExame
                               WHERE examepet.codPet=:codPet');
        $stmt->execute(array(':codPet' => $codPet));
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
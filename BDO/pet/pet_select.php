<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	try{ 
		$stmt = $pdo->prepare('SELECT pet.codigo, pet.nome, pet.dtNascimento, pet.dtFalecimento, pet.sexo, pet.doador, pet.comportamento, especie.nome especie, tipoSanguineo.nome tipoSanguineo, raca.nome raca, tutor.nome tutor
                               FROM pet 
                               INNER JOIN especie ON 
                               especie.codigo = pet.codEspecie
                               INNER JOIN tipoSanguineo ON
                               tipoSanguineo.codigo = pet.codTipoSanguineo
                               INNER JOIN raca ON
                               raca.codigo = pet.codRaca
                               INNER JOIN tutor ON
                               tutor.codigo = pet.codTutor');
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
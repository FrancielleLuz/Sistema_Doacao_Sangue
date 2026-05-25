<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	try{ 
		$stmt = $pdo->prepare("SELECT 
        pet.codigo,
        pet.nome,
        pet.dtNascimento,
        pet.dtFalecimento,
        pet.sexo,
        pet.doador,
        pet.comportamento,

        especie.nome especie,
        tipoSanguineo.nome tipoSanguineo,
        raca.nome raca,

        tutor.codigo codtutor,
        tutor.nome tutor,
        tutor.telefone,
        tutor.email

    FROM pet 

    INNER JOIN especie 
        ON especie.codigo = pet.codEspecie

    INNER JOIN tipoSanguineo 
        ON tipoSanguineo.codigo = pet.codTipoSanguineo

    INNER JOIN raca 
        ON raca.codigo = pet.codRaca

    INNER JOIN tutor 
        ON tutor.codigo = pet.codTutor

    WHERE pet.doador = 'S'
      AND pet.dtFalecimento IS NULL

      AND NOT EXISTS (
            SELECT 1
            FROM entradadoacao e
            WHERE e.codpet = pet.codigo
              AND e.datent >= CURDATE() - INTERVAL 90 DAY
      )");
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
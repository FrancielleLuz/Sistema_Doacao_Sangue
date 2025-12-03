<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	$sql = "SELECT 
				vp.codigo,
				vp.codPet,
				vp.codVacina,
				vp.dtVacina,
				vp.descricao,
				v.nome as nomeVacina
			FROM vacinapet vp
			INNER JOIN vacina v ON vp.codVacina = v.codigo
			WHERE vp.codPet = :codPet
			ORDER BY vp.dtVacina DESC";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([':codPet' => $codPet]);
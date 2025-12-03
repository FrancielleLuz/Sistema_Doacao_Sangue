<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	$sql = "SELECT 
				ep.codigo,
				ep.codPet,
				ep.codExame,
				ep.dtExame,
				ep.descricao,
				e.nome as nomeExame
			FROM examepet ep
			INNER JOIN exame e ON ep.codExame = e.codigo
			WHERE ep.codPet = :codPet
			ORDER BY ep.dtExame DESC";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([':codPet' => $codPet]);
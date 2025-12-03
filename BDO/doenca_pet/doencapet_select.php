<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	$sql = "SELECT 
				dp.codigo,
				dp.codPet,
				dp.codDoenca,
				dp.dtDoenca,
				dp.descricao,
				d.nome as nomeDoenca
			FROM doencapet dp
			INNER JOIN doenca d ON dp.codDoenca = d.codigo
			WHERE dp.codPet = :codPet
			ORDER BY dp.dtDoenca DESC";

	$stmt = $pdo->prepare($sql);
	$stmt->execute([':codPet' => $codPet]);
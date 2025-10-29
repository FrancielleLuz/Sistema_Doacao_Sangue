<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Buscando
	try{ 
		$stmt = $pdo->prepare('SELECT tipoSanguineoEspecie.codigo, tipoSanguineo.nome tipoSanguineo, especie.nome especie 
                               FROM tipoSanguineoEspecie 
                               INNER JOIN especie ON 
                               especie.codigo = tipoSanguineoEspecie.codEspecie
                               INNER JOIN tipoSanguineo ON
                               tipoSanguineo.codigo = tipoSanguineoEspecie.codTipoSanguineo');
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
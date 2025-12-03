<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Buscando
	try{ 
		$stmt = $pdo->prepare('SELECT * FROM clinica, cidadeestado,estado WHERE clinica.cidadeestado=cidadeestado.codigo 
		AND cidadeestado.estado=estado.codigo');
		$stmt->execute();
	} catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	} 

?>
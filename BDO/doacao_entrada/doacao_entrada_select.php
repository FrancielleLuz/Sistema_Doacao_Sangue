<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Buscando
	try{ 
		$stmt = $pdo->prepare('	SELECT 
									e.*,
									t.nome AS nomeTip,
									v.status
								FROM vw_status_coleta v
								JOIN entradadoacao e ON e.codigo = v.codigo
								JOIN tiposanguineo t ON t.codigo = e.codtip');
		$stmt->execute();
    }
	catch(PDOException $e) {
		echo 'Error: ' . $e -> getMessage();
	}
	
	

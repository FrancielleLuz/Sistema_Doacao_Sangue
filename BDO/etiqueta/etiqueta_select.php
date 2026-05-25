<?php  

	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados 

	//Buscando
	$id = $_GET['id'];

	$sql = "
	SELECT 
		e.codigo,
		e.codlot,
		e.datven,
		e.qtdcol,
		t.nome as nomeTip
	FROM vw_status_coleta v
	JOIN entradadoacao e ON e.codigo = v.codigo
	JOIN tiposanguineo t ON t.codigo = e.codtip
	WHERE e.codigo = :id
	";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	$dado = $stmt->fetch();
	?>
<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO tipoSanguineoEspecie (codigo, codEspecie, codTipoSanguineo) 
                                VALUES (null,:codEspecie, :codTipoSanguineo)');
		$stmt->execute(array(':codEspecie' => $_POST['codEspecie'], ':codTipoSanguineo' => $_POST['codTipoSanguineo']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
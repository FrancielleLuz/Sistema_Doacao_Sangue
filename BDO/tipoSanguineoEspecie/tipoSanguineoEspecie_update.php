<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Alterando
	try {
     
  		$stmt = $pdo->prepare('UPDATE tipoSanguineoEspecie 
                                SET codEspecie=:codEspecie, codTipoSanguineo=:codTipoSanguineo 
                                WHERE codigo=:codigo');
		$stmt->execute(array(':codEspecie' => $_POST['codEspecie'], ':codTipoSanguineo' => $_POST['codTipoSanguineo'],':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
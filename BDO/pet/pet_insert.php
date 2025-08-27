<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

	//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO pet (codigo, nome, dtNascimento, sexo, doador,                                                               comportamento, codEspecie, codRaca, codTipoSanguineo, codTutor) 
                                VALUES (null,:nome, :dtNascimento, :sexo, :doador, :comportamento,                          
                                :codEspecie, :codRaca, :codTipoSanguineo, :codTutor)');
        
		$stmt->execute(array(':nome' => $_POST['nome'], 
                             ':dtNascimento' => $_POST['dtNascimento'],
                             ':sexo' => $_POST['sexo'],
                             ':doador' => $_POST['doador'],
                             ':comportamento' => $_POST['comportamento'],
                             ':codEspecie' => $_POST['codEspecie'],
                             ':codRaca' => $_POST['codRaca'],
                             ':codTipoSanguineo' => $_POST['codTipoSanguineo'],
                             ':codTutor' => $_POST['codTutor']));
   		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
<?php  
	require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados
	
	//Alterando
	try {
     
  		$stmt = $pdo->prepare('UPDATE pet 
                                SET nome=:nome, dtNascimento=:dtNascimento, dtFalecimento=:dtFalecimento, sexo=:sexo,             doador=:doador, comportamento=:comportamento, codEspecie=:codEspecie, codRaca=:codRaca,       codTipoSanguineo=:codTipoSanguineo, codTutor=:codTutor 
                                WHERE codigo=:codigo');
        
		$stmt->execute(array(':nome' => $_POST['nome'], 
                             ':dtNascimento' => $_POST['dtNascimento'],
                             ':dtFalecimento' => $_POST['dtFalecimento'],
                             ':sexo' => $_POST['sexo'],
                             ':doador' => $_POST['doador'],
                             ':comportamento' => $_POST['comportamento'],
                             ':codEspecie' => $_POST['codEspecie'],
                             ':codRaca' => $_POST['codRaca'],
                             ':codTipoSanguineo' => $_POST['codTipoSanguineo'],
                             ':codTutor' => $_POST['codTutor'],
                             ':codigo' => $_POST['codigo']));
   
		echo $stmt->rowCount(); 
	}
	catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	}
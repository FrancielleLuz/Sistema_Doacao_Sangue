<?php  


		//Inserindo
	try {
     
  		$stmt = $pdo->prepare('INSERT INTO doenca (codigo, nome, descricao) VALUES (null,:nome, :descricao)');
		$stmt->execute(array(':nome' => $_POST['nome'], ':descricao' => $_POST['descricao']));
   
		echo $stmt->rowCount(); 
	} catch(PDOException $e) {
    	echo 'Error: ' . $e -> getMessage();
	} 
?>

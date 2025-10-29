<?php
require_once __DIR__ . '/../_bootstrap.php'; // Conexão com o banco

try {
    $stmt = $pdo->prepare('
        INSERT INTO usuarios 
            (codigo, nome, email, situacao, login, senha, fk_perfil) 
        VALUES 
            (null, :nome, :email, :situacao, :login, :senha, :fk_perfil)
    ');

    $stmt->execute(array(
        ':nome'       => $_POST['nome'],
        ':email'      => $_POST['email'],
        ':situacao'   => $_POST['situacao'],
        ':login'      => $_POST['login'],
        ':senha'      => $_POST['senha'],
        ':fk_perfil'  => $_POST['fk_perfil']
    ));

    echo $stmt->rowCount(); 

} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

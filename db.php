<?php
// db.php - conexão central ao banco de dados

// Puxa as configurações do Config.php
$config = include __DIR__ . '/Config.php';

try {
    // Cria a conexão PDO usando as configs
    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4",
        $config['user'],
        $config['password']
    );

    // Define que erros do PDO vão lançar exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

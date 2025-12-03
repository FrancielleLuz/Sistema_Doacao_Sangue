<?php  
require_once __DIR__ . '/../_bootstrap.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $stmt = $pdo->prepare('SELECT * FROM pet WHERE codigo=:codigo');
    $stmt->execute([':codigo' => $_POST['codigo']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}
catch(PDOException $e) {
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ]);
}

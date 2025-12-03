<?php
// BDO/pet/pet_raca_select.php
require_once __DIR__ . '/../_bootstrap.php'; // ajusta conforme sua estrutura: deve definir $pdo

header('Content-Type: application/json; charset=utf-8');

$codEspecie = $_POST['codEspecie'] ?? null;

if (!$codEspecie) {
    http_response_code(400);
    echo json_encode(['erro' => 'Código da espécie não informado no arquivo pet_raca_select.php']);
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT codigo, nome FROM raca WHERE codEspecie = :codEspecie ORDER BY nome');
    $stmt->bindValue(':codEspecie', $codEspecie);
    $stmt->execute();
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($arr);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => $e->getMessage()]);
}

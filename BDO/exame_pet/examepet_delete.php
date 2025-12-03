<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codigo = $_POST['codigo'] ?? null;

    if (!$codigo) {
        echo json_encode(['status'=>'error','msg'=>'Código é obrigatório']);
        exit;
    }

    $sql = "DELETE FROM examepet WHERE codigo = :codigo";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codigo', $codigo);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Exame excluído com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
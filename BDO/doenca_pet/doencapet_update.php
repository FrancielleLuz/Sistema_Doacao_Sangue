<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codigo = $_POST['codigo'] ?? null;
    $codDoenca = $_POST['codDoenca'] ?? null;
    $dtDoenca = $_POST['dtDoenca'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codigo || !$codDoenca || !$dtDoenca) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "UPDATE doencapet SET 
            codDoenca = :codDoenca,
            dtDoenca = :dtDoenca,
            descricao = :descricao
            WHERE codigo = :codigo";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codDoenca', $codDoenca);
    $stmt->bindValue(':dtDoenca', $dtDoenca);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':codigo', $codigo);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Doença atualizada com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codigo = $_POST['codigo'] ?? null;
    $codExame = $_POST['codExame'] ?? null;
    $dtExame = $_POST['dtExame'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codigo || !$codExame || !$dtExame) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "UPDATE examepet SET 
            codExame = :codExame,
            dtExame = :dtExame,
            descricao = :descricao
            WHERE codigo = :codigo";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codExame', $codExame);
    $stmt->bindValue(':dtExame', $dtExame);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':codigo', $codigo);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Exame atualizado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
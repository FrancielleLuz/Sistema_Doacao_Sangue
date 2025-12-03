<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codigo = $_POST['codigo'] ?? null;
    $codVacina = $_POST['codVacina'] ?? null;
    $dtVacina = $_POST['dtVacina'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codigo || !$codVacina || !$dtVacina) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "UPDATE vacinapet SET 
            codVacina = :codVacina,
            dtVacina = :dtVacina,
            descricao = :descricao
            WHERE codigo = :codigo";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codVacina', $codVacina);
    $stmt->bindValue(':dtVacina', $dtVacina);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':codigo', $codigo);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Vacina atualizada com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
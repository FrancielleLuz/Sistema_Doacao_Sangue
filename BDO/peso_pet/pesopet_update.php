<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codigo = $_POST['codigo'] ?? null;
    $dtPeso = $_POST['dtPeso'] ?? null;
    $peso = $_POST['peso'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codigo || !$dtPeso || !$peso) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "UPDATE historicopeso SET 
            dtPeso = :dtPeso,
            peso = :peso,
            descricao = :descricao
            WHERE codigo = :codigo";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':dtPeso', $dtPeso);
    $stmt->bindValue(':peso', $peso);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':codigo', $codigo);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Peso atualizado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
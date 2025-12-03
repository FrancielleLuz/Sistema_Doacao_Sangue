<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codPet = $_POST['codPet'] ?? null;
    $codDoenca = $_POST['codDoenca'] ?? null;
    $dtDoenca = $_POST['dtDoenca'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codPet || !$codDoenca || !$dtDoenca) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "INSERT INTO doencapet (codPet, codDoenca, dtDoenca, descricao) 
            VALUES (:codPet, :codDoenca, :dtDoenca, :descricao)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codPet', $codPet);
    $stmt->bindValue(':codDoenca', $codDoenca);
    $stmt->bindValue(':dtDoenca', $dtDoenca);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Doença adicionada com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
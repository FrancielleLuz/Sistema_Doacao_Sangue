<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codPet = $_POST['codPet'] ?? null;
    $codExame = $_POST['codExame'] ?? null;
    $dtExame = $_POST['dtExame'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codPet || !$codExame || !$dtExame) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "INSERT INTO examepet (codPet, codExame, dtExame, descricao) 
            VALUES (:codPet, :codExame, :dtExame, :descricao)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codPet', $codPet);
    $stmt->bindValue(':codExame', $codExame);
    $stmt->bindValue(':dtExame', $dtExame);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Exame adicionado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
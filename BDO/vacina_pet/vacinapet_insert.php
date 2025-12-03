<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codPet = $_POST['codPet'] ?? null;
    $codVacina = $_POST['codVacina'] ?? null;
    $dtVacina = $_POST['dtVacina'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codPet || !$codVacina || !$dtVacina) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "INSERT INTO vacinapet (codPet, codVacina, dtVacina, descricao) 
            VALUES (:codPet, :codVacina, :dtVacina, :descricao)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codPet', $codPet);
    $stmt->bindValue(':codVacina', $codVacina);
    $stmt->bindValue(':dtVacina', $dtVacina);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Vacina adicionada com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
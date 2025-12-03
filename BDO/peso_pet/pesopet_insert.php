<?php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codPet = $_POST['codPet'] ?? null;
    $dtPeso = $_POST['dtPeso'] ?? null;
    $peso = $_POST['peso'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    if (!$codPet || !$dtPeso || !$peso) {
        echo json_encode(['status'=>'error','msg'=>'Campos obrigatórios faltando']);
        exit;
    }

    $sql = "INSERT INTO historicopeso (codPet, dtPeso, peso, descricao) 
            VALUES (:codPet, :dtPeso, :peso, :descricao)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codPet', $codPet);
    $stmt->bindValue(':dtPeso', $dtPeso);
    $stmt->bindValue(':peso', $peso);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Peso adicionado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
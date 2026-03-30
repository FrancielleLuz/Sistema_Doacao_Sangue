<?php
require_once __DIR__ . '/../_bootstrap.php'; //Conexão com o banco de dados

try {

    $codPet = $_POST['codPet'] ?? null;

    if (!$codPet) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Pet não informado"
        ]);
        exit;
    }

    $sql = "SELECT ts.nome,ts.codigo
            FROM pet p
            JOIN tiposanguineo ts 
                ON ts.codigo = p.codTipoSanguineo
            WHERE p.codigo = :cod";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cod', $codPet);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo json_encode([
            "status" => "ok",
			"codigo" => $row['codigo'],
            "tipoSanguineo" => $row['nome']
        ]);
    } else {
        echo json_encode([
            "status" => "erro",
            "msg" => "Tipo sanguíneo não encontrado"
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        "status" => "erro",
        "msg" => $e->getMessage()
    ]);
}
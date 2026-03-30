<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../_bootstrap.php';

try {

    $codentdoa = $_POST['codentdoa'] ?? null;

    if (!$codentdoa) {
        echo json_encode(["status" => "erro"]);
        exit;
    }

    $sql = "SELECT e.*,
                   p.nome AS nomePet,
                   t.nome AS nomeTip
            FROM entradadoacao e
            LEFT JOIN pet p ON p.codigo = e.codpet
            LEFT JOIN tiposanguineo t ON t.codigo = e.codtip
            WHERE e.codigo = :cod";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cod', $codentdoa);
    $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        echo json_encode([
            "status" => "ok",
            "pet" => $dados['nomePet'],
            "codpet" => $dados['codpet'],
            "tipo" => $dados['nomeTip'],
            "validade" => $dados['datven'],
            "qtd" => $dados['qtdcol'],
            "lote" => $dados['codlot']
        ]);
    } else {
        echo json_encode(["status" => "erro"]);
    }

} catch (Exception $e) {
    echo json_encode([
        "status" => "erro",
        "msg" => $e->getMessage()
    ]);
}
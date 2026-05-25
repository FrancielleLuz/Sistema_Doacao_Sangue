<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../_bootstrap.php';

$codtip = $_POST['codtip'] ?? null;

if (!$codtip) {
    echo json_encode(["status" => "erro", "msg" => "Tipo sanguíneo não informado."]);
    exit;
}

try {
    $stmt = $pdo->prepare("
        SELECT 
            e.codigo,
            e.codlot,
            e.datent,
            e.datven,
            e.qtdcol,
            DATEDIFF(e.datven, CURDATE()) AS dias_validade,
            p.nome  AS nomePet,
            v.nome  AS nomeVet
        FROM entradadoacao e
        INNER JOIN pet p        ON p.codigo = e.codpet
        INNER JOIN veterinario v ON v.codigo = e.codVet
        LEFT  JOIN saidadoacao s ON s.codentdoa = e.codigo
        WHERE e.codtip = :codtip
          AND e.sitcol = 'A'
          AND s.codigo IS NULL
        ORDER BY e.datven ASC
    ");
    $stmt->bindParam(':codtip', $codtip);
    $stmt->execute();
    $lotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "ok", "lotes" => $lotes]);

} catch (PDOException $e) {
    echo json_encode(["status" => "erro", "msg" => $e->getMessage()]);
}

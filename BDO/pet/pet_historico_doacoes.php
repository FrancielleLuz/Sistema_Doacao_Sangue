<?php
require_once __DIR__ . '/../_bootstrap.php';

try {
    $stmtDoacoes = $pdo->prepare("
        SELECT 
            e.codigo,
            e.datent,
            e.codlot,
            e.qtdcol,
            e.datven,
            e.sitcol,
            t.nome AS nomeTip,
            v.nome AS nomeVet
        FROM entradadoacao e
        INNER JOIN tiposanguineo t ON t.codigo = e.codtip
        INNER JOIN veterinario v   ON v.codigo = e.codVet
        WHERE e.codpet = :codpet
        ORDER BY e.datent DESC
    ");
    $stmtDoacoes->bindParam(':codpet', $codPet);
    $stmtDoacoes->execute();

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}

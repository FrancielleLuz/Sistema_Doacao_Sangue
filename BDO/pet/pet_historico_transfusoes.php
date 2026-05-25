<?php
require_once __DIR__ . '/../_bootstrap.php';

try {
    $stmtTransfusoes = $pdo->prepare("
        SELECT 
            s.codigo,
            s.datasaida,
            e.codlot,
            s.qtdsaida,
            t.nome  AS nomeTip,
            pd.nome AS nomePetDoador,
            v.nome  AS nomeVet
        FROM saidadoacao s
        INNER JOIN entradadoacao e  ON e.codigo  = s.codentdoa
        INNER JOIN tiposanguineo t  ON t.codigo  = e.codtip
        INNER JOIN pet pd           ON pd.codigo = s.codpet
        INNER JOIN veterinario v    ON v.codigo  = s.codvet
        WHERE s.codpetrec = :codpet
        ORDER BY s.datasaida DESC
    ");
    $stmtTransfusoes->bindParam(':codpet', $codPet);
    $stmtTransfusoes->execute();

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}

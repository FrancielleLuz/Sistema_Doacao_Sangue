<?php
require_once __DIR__ . '/../_bootstrap.php';

try {
    // Bolsas vencendo em até 7 dias (ainda disponíveis)
    $stmtVencendo = $pdo->prepare("
        SELECT 
            e.codigo,
            e.codlot,
            e.datven,
            DATEDIFF(e.datven, CURDATE()) AS dias_restantes,
            t.nome  AS nomeTip,
            esp.nome AS nomeEspecie
        FROM entradadoacao e
        INNER JOIN tiposanguineo t         ON t.codigo  = e.codtip
        INNER JOIN tiposanguineoespecie te ON te.codTipoSanguineo = t.codigo
        INNER JOIN especie esp             ON esp.codigo = te.codEspecie
        LEFT  JOIN saidadoacao s           ON s.codentdoa = e.codigo
        WHERE e.sitcol = 'A'
          AND s.codigo IS NULL
          AND e.datven BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        ORDER BY e.datven ASC
    ");
    $stmtVencendo->execute();
    $alertasVencendo = $stmtVencendo->fetchAll(PDO::FETCH_ASSOC);

    // Tipos sanguíneos com estoque crítico (≤2 bolsas disponíveis)
    $stmtCritico = $pdo->prepare("
        SELECT 
            t.nome  AS nomeTip,
            esp.nome AS nomeEspecie,
            COUNT(disp.codigo) AS qtd_bolsas
        FROM tiposanguineo t
        INNER JOIN tiposanguineoespecie te ON te.codTipoSanguineo = t.codigo
        INNER JOIN especie esp             ON esp.codigo = te.codEspecie
        LEFT JOIN (
            SELECT ed.codigo, ed.codtip
            FROM entradadoacao ed
            LEFT JOIN saidadoacao sd ON sd.codentdoa = ed.codigo
            WHERE ed.sitcol = 'A' AND sd.codigo IS NULL
        ) disp ON disp.codtip = t.codigo
        GROUP BY t.codigo, t.nome, esp.codigo, esp.nome
        HAVING COUNT(disp.codigo) <= 2
        ORDER BY COUNT(disp.codigo) ASC
    ");
    $stmtCritico->execute();
    $alertasCritico = $stmtCritico->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $alertasVencendo = [];
    $alertasCritico  = [];
}

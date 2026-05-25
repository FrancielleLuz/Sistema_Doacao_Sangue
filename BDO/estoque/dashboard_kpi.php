<?php  
// $pdo já disponível via estoque_por_especie.php → _bootstrap.php

try {
    $stmt_kpi = $pdo->prepare("
        SELECT 
            (SELECT COUNT(*)
             FROM entradadoacao e
             LEFT JOIN saidadoacao s ON s.codentdoa = e.codigo
             WHERE s.codigo IS NULL AND e.sitcol = 'A'
            ) AS total_bolsas,

            (SELECT COALESCE(SUM(e.qtdcol), 0)
             FROM entradadoacao e
             LEFT JOIN saidadoacao s ON s.codentdoa = e.codigo
             WHERE s.codigo IS NULL AND e.sitcol = 'A'
            ) AS total_volume,

            (SELECT COUNT(*)
             FROM entradadoacao e
             LEFT JOIN saidadoacao s ON s.codentdoa = e.codigo
             WHERE s.codigo IS NULL AND e.sitcol = 'A'
               AND e.datven BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            ) AS vencendo_7d,

            (SELECT COUNT(*)
             FROM entradadoacao
             WHERE MONTH(datent) = MONTH(CURDATE())
               AND YEAR(datent)  = YEAR(CURDATE())
            ) AS doacoes_mes
    ");
    $stmt_kpi->execute();
    $kpi = $stmt_kpi->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $kpi = ['total_bolsas' => 0, 'total_volume' => 0, 'vencendo_7d' => 0, 'doacoes_mes' => 0];
}

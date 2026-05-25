<?php  
require_once __DIR__ . '/../_bootstrap.php';

try {
    $stmt_estoque = $pdo->prepare("
        SELECT 
            esp.codigo AS cod_especie,
            esp.nome   AS nome_especie,
            t.codigo   AS codtip,
            t.nome     AS nome_tipo,
            COUNT(disp.codigo)               AS qtd_bolsas,
            COALESCE(SUM(disp.qtdcol), 0)    AS total_volume,
            COALESCE(SUM(
                CASE WHEN disp.datven BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                     THEN 1 ELSE 0 END
            ), 0) AS vencendo_7d
        FROM tiposanguineo t
        INNER JOIN tiposanguineoespecie te ON te.codTipoSanguineo = t.codigo
        INNER JOIN especie esp             ON esp.codigo = te.codEspecie
        LEFT JOIN (
            SELECT ed.codigo, ed.codtip, ed.qtdcol, ed.datven
            FROM entradadoacao ed
            LEFT JOIN saidadoacao sd ON sd.codentdoa = ed.codigo
            WHERE ed.sitcol = 'A' AND sd.codigo IS NULL
        ) disp ON disp.codtip = t.codigo
        GROUP BY esp.codigo, esp.nome, t.codigo, t.nome
        ORDER BY esp.nome, qtd_bolsas ASC
    ");
    $stmt_estoque->execute();

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}

<?php  
require_once __DIR__ . '/../_bootstrap.php';

try {

    $stmt = $pdo->prepare("
        SELECT 
            e.codtip,
			t.nome,
            COUNT(e.codigo) AS qtd_bolsas,
            SUM(e.qtdcol) AS total_volume
        FROM entradadoacao e
        LEFT JOIN saidadoacao s 
            ON s.codentdoa = e.codigo
		LEFT JOIN tiposanguineo t 
			ON t.codigo = e.codTip
        WHERE s.codigo IS NULL
        AND e.sitcol = 'A'
        GROUP BY e.codtip
        ORDER BY qtd_bolsas ASC
    ");


    $stmt->execute();

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
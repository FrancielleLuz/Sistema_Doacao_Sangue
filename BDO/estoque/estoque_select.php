<?php  
require_once __DIR__ . '/../_bootstrap.php';

try {

    $stmt = $pdo->prepare("
        SELECT 
			t.codigo AS codtip,
			t.nome AS nome,
			COUNT(e.codigo) AS qtd_bolsas,
			COALESCE(SUM(e.qtdcol), 0) AS total_volume
		FROM tiposanguineo t
		LEFT JOIN entradadoacao e 
			ON e.codtip = t.codigo
		LEFT JOIN saidadoacao s 
			ON s.codentdoa = e.codigo
		WHERE (s.codigo IS NULL OR e.codigo IS NULL)
		AND (e.sitcol = 'A' OR e.sitcol IS NULL)
		GROUP BY t.codigo, t.nome
		ORDER BY qtd_bolsas ASC
    ");


    $stmt->execute();

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
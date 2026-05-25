<?php
require_once __DIR__ . '/../_bootstrap.php';

$sql = "SELECT e.*,
		e.codlot,
	   p.nome AS nomePet,
       t.nome AS nomeTip
        FROM entradadoacao e
       		LEFT JOIN pet p ON p.codigo = e.codpet
		LEFT JOIN tiposanguineo t ON t.codigo = e.codtip
       WHERE e.sitcol = 'A'
        AND e.datven < CURDATE()
        AND NOT EXISTS (
            SELECT 1 
            FROM saidadoacao s 
            WHERE s.codentdoa = e.codigo
        )
        ORDER BY e.datven";

$stmtLote = $pdo->query($sql);
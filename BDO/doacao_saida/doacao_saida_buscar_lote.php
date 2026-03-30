<?php
require_once __DIR__ . '/../_bootstrap.php';

$sql = "SELECT e.codigo, e.codlot 
        FROM entradadoacao e
        WHERE e.sitcol = 'A'
        AND NOT EXISTS (
            SELECT 1 
            FROM saidadoacao s 
            WHERE s.codentdoa = e.codigo
        )";

$stmtLote = $pdo->query($sql);
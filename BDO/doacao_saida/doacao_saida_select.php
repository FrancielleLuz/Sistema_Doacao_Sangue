<?php
require_once __DIR__ . '/../_bootstrap.php';

$sql = "SELECT s.codigo,
               s.datasaida,
               s.qtdsaida,
               e.codlot,
               p.nome AS nomePet,
               v.nome AS nomeVet
        FROM saidadoacao s
        JOIN entradadoacao e ON e.codigo = s.codentdoa
        LEFT JOIN pet p ON p.codigo = s.codpet
        LEFT JOIN veterinario v ON v.codigo = s.codvet
        WHERE s.sitcol = 'A'
        ORDER BY s.codigo DESC";

$stmt = $pdo->query($sql);
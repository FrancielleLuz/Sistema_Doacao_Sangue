<?php
require_once __DIR__ . '/../_bootstrap.php';

$sql = "SELECT s.*,
		p.nome AS nomePet,
		e.codlot,
		v.nome AS nomeVet
		FROM saidadoacao s  
		LEFT JOIN pet p ON p.codigo = s.codpet
		LEFT JOIN entradadoacao e ON e.codigo = s.codentdoa
		LEFT JOIN veterinario v ON v.codigo = s.codvet
		WHERE s.codpetrec is NULL";

$stmt = $pdo->query($sql);
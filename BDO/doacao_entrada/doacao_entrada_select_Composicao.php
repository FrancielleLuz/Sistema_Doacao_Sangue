<?php
require_once __DIR__ . '/../_bootstrap.php';

$codigo = $_GET['id'] ?? null;

if (!$codigo) {
    return;
}

$sql = "SELECT e.*,
               p.nome AS nomePet,
               v.nome AS nomeVet,
			   t.nome AS nomeTip
        FROM entradadoacao e
        LEFT JOIN pet p ON p.codigo = e.codpet
        LEFT JOIN veterinario v ON v.codigo = e.codvet
		LEFT JOIN tiposanguineo t ON t.codigo = e.codtip
        WHERE e.codigo = :codigo";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':codigo', $codigo);
$stmt->execute();

$dados = $stmt->fetch(PDO::FETCH_ASSOC);
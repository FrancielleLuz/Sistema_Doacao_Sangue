<?php
require_once __DIR__ . '/../_bootstrap.php';

$codigo = $_GET['id'] ?? null;

if (!$codigo) {
    return;
}

$sql = "SELECT s.*,

               e.codlot,
               e.datent,
               e.datven,
               e.qtdcol,

               p.nome AS nomePet,
               pr.nome AS nomePetRec,

               t.nome AS nomeTip,

               v.nome AS nomeVet

        FROM saidadoacao s

        JOIN entradadoacao e 
            ON e.codigo = s.codentdoa

        LEFT JOIN pet p 
            ON p.codigo = s.codpet

        LEFT JOIN pet pr 
            ON pr.codigo = s.codpetrec

        LEFT JOIN tiposanguineo t 
            ON t.codigo = e.codtip

        LEFT JOIN veterinario v 
            ON v.codigo = s.codvet

        WHERE s.codigo = :codigo";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':codigo', $codigo);
$stmt->execute();

$dados = $stmt->fetch(PDO::FETCH_ASSOC);
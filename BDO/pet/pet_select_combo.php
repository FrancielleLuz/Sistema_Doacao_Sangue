<?php
include("../conexao.php");

// Busca pets ativos (se tiver controle de status)
$sql = "SELECT codigo, nome 
        FROM pet WHERE doador = 'S'
        ORDER BY nome";

$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
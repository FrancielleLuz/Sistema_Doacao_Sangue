<?php
include("BDO/conn.php"); // arquivo com a conexão ao DB

$codEspecie = $_POST['codEspecie'];

$stmt = $pdo->prepare('SELECT codigo, nome FROM raca WHERE codEspecie = ?');
$stmt->execute([$codEspecie]);
$racas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($racas);

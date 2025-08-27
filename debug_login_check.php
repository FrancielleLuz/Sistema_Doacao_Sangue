<?php
// debug_login_check.php — APAGUE DEPOIS DE TESTAR
require __DIR__ . '/db.php';

$u = $_GET['u'] ?? 'adm';

// Mostra qual banco está conectado
$dbname = $pdo->query("SELECT DATABASE()")->fetchColumn();
echo "<p><b>Banco atual:</b> " . htmlspecialchars($dbname) . "</p>";

// Conta usuários na tabela
$total = $pdo->query("SELECT COUNT(*) FROM usuarios")->fetchColumn();
echo "<p><b>Total de registros em usuarios:</b> $total</p>";

// Busca o usuário informado por login OU email
$stmt = $pdo->prepare("
  SELECT codigo, nome, login, email, senha, situacao
  FROM usuarios
  WHERE (login = ? OR email = ?)
  LIMIT 1
");
$stmt->execute([$u, $u]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($row);
echo "</pre>";

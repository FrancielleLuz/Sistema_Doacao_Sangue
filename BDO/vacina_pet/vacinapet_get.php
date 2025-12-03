<?php
require_once __DIR__ . '/../_bootstrap.php';
$codigo = $_GET['codigo'] ?? 0;
try {
  $stmt = $pdo->prepare('SELECT * FROM vacinapet WHERE codigo = :codigo');
  $stmt->execute([':codigo' => $codigo]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  echo json_encode($row ?: new stdClass());
} catch (PDOException $e) {
  echo json_encode(new stdClass());
}
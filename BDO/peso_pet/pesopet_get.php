<?php
require_once __DIR__ . '/../_bootstrap.php';
$codigo = $_GET['codigo'] ?? 0;
try {
  $stmt = $pdo->prepare('SELECT * FROM historicopeso WHERE codigo = :codigo');
  $stmt->execute([':codigo' => $codigo]);
  header('Content-Type: application/json');
  echo json_encode($stmt->fetch(PDO::FETCH_ASSOC) ?: new stdClass());
} catch (PDOException $e) {
  echo json_encode(new stdClass());
}
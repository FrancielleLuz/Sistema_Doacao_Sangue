<?php
require_once __DIR__ . '/../_bootstrap.php';
$codPet = $_GET['codPet'] ?? 0;
try {
  $stmt = $pdo->prepare('SELECT hp.codigo, hp.dtPeso, hp.peso, hp.descricao FROM historicopeso hp WHERE hp.codPet = :codPet ORDER BY hp.dtPeso DESC');
  $stmt->execute([':codPet' => $codPet]);
  header('Content-Type: application/json');
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
  echo json_encode([]);
}
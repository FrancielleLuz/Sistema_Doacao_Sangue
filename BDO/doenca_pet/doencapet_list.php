<?php
require_once __DIR__ . '/../_bootstrap.php';
$codPet = $_GET['codPet'] ?? 0;
try {
  $stmt = $pdo->prepare('SELECT dp.codigo, dp.dtDoenca, d.nome, dp.descricao FROM doencapet dp LEFT JOIN doenca d ON dp.codDoenca = d.codigo WHERE dp.codPet = :codPet ORDER BY dp.dtDoenca DESC');
  $stmt->execute([':codPet' => $codPet]);
  header('Content-Type: application/json');
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
  echo json_encode([]);
}

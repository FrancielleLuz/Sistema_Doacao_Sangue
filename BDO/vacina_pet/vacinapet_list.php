<?php
require_once __DIR__ . '/../_bootstrap.php';
$codPet = $_GET['codPet'] ?? 0;
try {
  $stmt = $pdo->prepare('SELECT vp.codigo, vp.dtVacina, v.nome, vp.descricao FROM vacinapet vp LEFT JOIN vacina v ON vp.codVacina = v.codigo WHERE vp.codPet = :codPet ORDER BY vp.dtVacina DESC');
  $stmt->execute([':codPet' => $codPet]);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json');
  echo json_encode($rows);
} catch (PDOException $e) {
  echo json_encode([]);
}
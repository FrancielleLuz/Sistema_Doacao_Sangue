<?php
require_once __DIR__ . '/../_bootstrap.php';
$codPet = $_GET['codPet'] ?? 0;
try {
  $stmt = $pdo->prepare('SELECT ep.codigo, ep.dtExame, e.nome, ep.descricao FROM examepet ep LEFT JOIN exame e ON ep.codExame = e.codigo WHERE ep.codPet = :codPet ORDER BY ep.dtExame DESC');
  $stmt->execute([':codPet' => $codPet]);
  header('Content-Type: application/json');
  echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
  echo json_encode([]);
}
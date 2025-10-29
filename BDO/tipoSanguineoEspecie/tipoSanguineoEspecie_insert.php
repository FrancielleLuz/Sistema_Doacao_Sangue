<?php  
require_once __DIR__ . '/../_bootstrap.php'; // Conexão com o banco de dados

// Recebe os dados do POST
$codEspecie = $_POST['codEspecie'] ?? null;
$codTipoSanguineo = $_POST['codTipoSanguineo'] ?? null;

if ($codEspecie && $codTipoSanguineo) {
    try {
        $stmt = $pdo->prepare('INSERT INTO tipoSanguineoEspecie (codigo,codEspecie, codTipoSanguineo) VALUES (null,:codEspecie, :codTipoSanguineo)');
        $stmt->execute([
            ':codEspecie' => $codEspecie,
            ':codTipoSanguineo' => $codTipoSanguineo
        ]);

        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
}

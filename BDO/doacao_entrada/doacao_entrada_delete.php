<?php  
header('Content-Type: application/json');

require_once __DIR__ . '/../_bootstrap.php';

try {
     
    $codigo = $_POST['codigo'] ?? null;

    if (!$codigo) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Código não informado"
        ]);
        exit;
    }

    $stmt = $pdo->prepare('UPDATE entradadoacao SET sitcol="I" WHERE codigo=:codigo');
    $stmt->execute([':codigo' => $codigo]);

    echo json_encode([
        "status" => "ok",
        "msg" => "Registro excluído com sucesso!"
    ]);

} catch(PDOException $e) {
    echo json_encode([
        "status" => "erro",
        "msg" => $e->getMessage()
    ]);
}
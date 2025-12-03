<?php
require_once __DIR__ . '/../_bootstrap.php';

header('Content-Type: application/json; charset=utf-8');

$codEspecie = $_POST['codEspecie'] ?? null;

if (!$codEspecie) {
    http_response_code(400);
    echo json_encode(['erro' => 'codEspecie não enviado']);
    exit;
}

try {
    /*
        Consulta correta usando a tabela RELACIONAL tiposanguineoespecie
        Busca apenas os tipos sanguíneos vinculados à espécie escolhida
    */
    $sql = "
        SELECT ts.codigo, ts.nome AS tipoSanguineo
        FROM tiposanguineo ts
        INNER JOIN tiposanguineoespecie tse 
            ON tse.codTipoSanguineo = ts.codigo
        WHERE tse.codEspecie = :codEspecie
        ORDER BY ts.nome
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':codEspecie', $codEspecie);
    $stmt->execute();

    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($arr);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => $e->getMessage()]);
}

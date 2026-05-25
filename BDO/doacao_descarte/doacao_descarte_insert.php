<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../_bootstrap.php';

try {

    // RECEBE DADOS
    $codentdoa = $_POST['codsaides'] ?? null;
    $codpet    = $_POST['codpet'] ?? null;      // doador
    $codvet    = $_POST['codvet'] ?? null;
    $obsdoc    = $_POST['obsdoc'] ?? null;
	
	// BUSCA QTD
	$sqlQtd = "SELECT qtdcol
			   FROM entradadoacao
			   WHERE codigo = :codentdoa";

	$stmtQtd = $pdo->prepare($sqlQtd);
	$stmtQtd->bindParam(':codentdoa', $codentdoa);
	$stmtQtd->execute();

	$entrada = $stmtQtd->fetch(PDO::FETCH_ASSOC);

	$qtdsaida = $entrada['qtdcol'] ?? 0;

    // DATA AUTOMÁTICA
    $datasaida = date('Y-m-d');
    $horasaida = date('H:i:s');

    $datres = date('Y-m-d');
    $horres = date('H:i:s');

    // VALIDAÇÃO
    if (!$codentdoa  || !$codpet || !$codvet || !$obsdoc) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Preencha todos os campos obrigatórios"
        ]);
        exit;
    }



    // INSERT
    $sql = "INSERT INTO saidadoacao
        (codentdoa, codpet, codpetrec, codvet, datasaida, horasaida, qtdsaida, obsdoc, sitcol, datres, horres)
        VALUES
        (:codentdoa, :codpet, NULL, :codvet, :datasaida, :horasaida, :qtdsaida, :obsdoc, 'A', :datres, :horres)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':codentdoa', $codentdoa);
    $stmt->bindParam(':codpet', $codpet);
    $stmt->bindParam(':codvet', $codvet);
    $stmt->bindParam(':datasaida', $datasaida);
    $stmt->bindParam(':horasaida', $horasaida);
    $stmt->bindParam(':qtdsaida', $qtdsaida);
    $stmt->bindParam(':obsdoc', $obsdoc);
    $stmt->bindParam(':datres', $datres);
    $stmt->bindParam(':horres', $horres);

    $stmt->execute();

    echo json_encode([
        "status" => "ok",
        "msg" => "Saída registrada com sucesso!"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => "erro",
        "msg" => $e->getMessage()
    ]);
}
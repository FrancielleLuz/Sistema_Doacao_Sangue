<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../_bootstrap.php';

try {

    // RECEBE DADOS
    $codentdoa = $_POST['codentdoa'] ?? null;
    $qtdsaida  = $_POST['qtdsaida'] ?? null;
    $codpet    = $_POST['codpet'] ?? null;      // doador
    $codpetrec = $_POST['codpetrec'] ?? null;   // receptor
    $codvet    = $_POST['codvet'] ?? null;
    $obsdoc    = $_POST['obsdoc'] ?? null;

    // DATA AUTOMÁTICA
    $datasaida = date('Y-m-d');
    $horasaida = date('H:i:s');

    $datres = date('Y-m-d');
    $horres = date('H:i:s');

    // VALIDAÇÃO
    if (!$codentdoa || !$qtdsaida || !$codpet || !$codpetrec || !$codvet) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Preencha todos os campos obrigatórios"
        ]);
        exit;
    }

    // 🚨 REGRA 1: NÃO PERMITIR DUPLICIDADE (1 bolsa = 1 saída)
    $sqlCheck = "SELECT COUNT(*) as total 
                 FROM saidadoacao 
                 WHERE codentdoa = :codentdoa";

    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->bindParam(':codentdoa', $codentdoa);
    $stmtCheck->execute();

    $row = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($row['total'] > 0) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Essa bolsa já foi utilizada ou descartada!"
        ]);
        exit;
    }

    // 🚨 REGRA 2 (OPCIONAL): NÃO SAIR MAIS DO QUE TEM
    $sqlEntrada = "SELECT qtdcol FROM entradadoacao WHERE codigo = :cod";
    $stmtEntrada = $pdo->prepare($sqlEntrada);
    $stmtEntrada->bindParam(':cod', $codentdoa);
    $stmtEntrada->execute();

    $entrada = $stmtEntrada->fetch(PDO::FETCH_ASSOC);

    if ($entrada && $qtdsaida > $entrada['qtdcol']) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Quantidade de saída maior que a coletada!"
        ]);
        exit;
    }
	
	// REGRA: DOADOR NÃO PODE SER RECEPTOR
	if ($codpet == $codpetrec) {
		echo json_encode([
			"status" => "erro",
			"msg" => "O pet receptor não pode ser o mesmo doador!"
		]);
		exit;
	}

    // INSERT
    $sql = "INSERT INTO saidadoacao
        (codentdoa, codpet, codpetrec, codvet, datasaida, horasaida, qtdsaida, obsdoc, sitcol, datres, horres)
        VALUES
        (:codentdoa, :codpet, :codpetrec, :codvet, :datasaida, :horasaida, :qtdsaida, :obsdoc, 'A', :datres, :horres)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':codentdoa', $codentdoa);
    $stmt->bindParam(':codpet', $codpet);
    $stmt->bindParam(':codpetrec', $codpetrec);
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
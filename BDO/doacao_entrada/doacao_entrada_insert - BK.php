<?php
header('Content-Type: application/json');

// CONEXÃO PADRÃO DO PROJETO
require_once __DIR__ . '/../_bootstrap.php';

try {
	
	$dataHoje = date('Ymd');

	// busca última sequência do lote do dia
	$sqlSeq = "SELECT COUNT(*) as total 
			   FROM entradadoacao 
			   WHERE datent = CURDATE()";

	$stmtSeq = $pdo->query($sqlSeq);
	$rowSeq = $stmtSeq->fetch(PDO::FETCH_ASSOC);

	$sequencia = str_pad($rowSeq['total'] + 1, 3, '0', STR_PAD_LEFT);

	// DEFINIÇÃO DO LOTE
	$codlot = $dataHoje . '-' . $sequencia;
	
    // RECEBE DADOS
    $datent = $_POST['datent'] ?? null;
    $horent = $_POST['horent'] ?? null;
    $codpet = $_POST['codpet'] ?? null;
    $codtip = $_POST['codtip'] ?? null;
    $qtdcol = $_POST['qtdcol'] ?? null;
    $datven = $_POST['datven'] ?? null;
    $codvet = $_POST['codvet'] ?? null;
    $obsdoc = $_POST['obsdoc'] ?? null;

    // VALIDAÇÃO
    if (!$datent || !$horent || !$codpet || !$codtip || !$qtdcol || !$datven || !$codvet || !$codlot) {
        echo json_encode([
            "status" => "erro",
            "msg" => "Preencha todos os campos obrigatórios"
        ]);
        exit;
    }


    // INSERT
	
	$datres = date('Y-m-d');
	$horres = date('H:i:s');
	
    $sql = "INSERT INTO entradadoacao 
            (datent, horent, codpet, codtip, qtdcol, datven, codvet, codlot, obsdoc, datres, horres)
            VALUES 
            (:datent, :horent, :codpet, :codtip, :qtdcol, :datven, :codvet, :codlot, :obsdoc, :datres, :horres)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':datent', $datent);
    $stmt->bindParam(':horent', $horent);
    $stmt->bindParam(':codpet', $codpet);
    $stmt->bindParam(':codtip', $codtip);
    $stmt->bindParam(':qtdcol', $qtdcol);
    $stmt->bindParam(':datven', $datven);
    $stmt->bindParam(':codvet', $codvet);
    $stmt->bindParam(':codlot', $codlot);
    $stmt->bindParam(':obsdoc', $obsdoc);
	$stmt->bindParam(':datres', $datres);
	$stmt->bindParam(':horres', $horres);

    $stmt->execute();

    echo json_encode([
        "status" => "ok",
        "msg" => "Registro inserido com sucesso!"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => "erro",
        "msg" => "Erro ao inserir: " . $e->getMessage()
    ]);
}
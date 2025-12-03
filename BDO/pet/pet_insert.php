<?php
// BDO/pet/pet_insert.php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    // Ler campos esperados
    $nome = $_POST['nome'] ?? null;
    $dtNascimento = $_POST['dtNascimento'] ?? null;
    $sexo = $_POST['sexo'] ?? null;
    $doador = $_POST['doador'] ?? null;
    $comportamento = $_POST['comportamento'] ?? null;
    $caracteristicas = $_POST['caracteristica'] ?? null; // Recebe 'caracteristica' mas salva em 'caracteristicas'
    $codEspecie = $_POST['codEspecie'] ?? null;
    $codRaca = $_POST['codRaca'] ?? null;
    $codTipoSanguineo = $_POST['codTipoSanguineo'] ?? null;
    $codTutor = $_POST['codTutor'] ?? null;

    // Validações simples
    if (!$nome) {
        echo json_encode(['status'=>'error','msg'=>'Nome é obrigatório']);
        exit;
    }
    if (!$codEspecie) {
        echo json_encode(['status'=>'error','msg'=>'Espécie é obrigatória']);
        exit;
    }

    // Função para converter data de DD/MM/YYYY para YYYY-MM-DD
    function converterData($data) {
        if (empty($data)) return null;
        if (preg_match('/^\d{4}-\d{2}-\d{2}/', $data)) return $data;
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data, $matches)) {
            return $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }
        return null;
    }

    // Converte a data
    $dtNascimento = converterData($dtNascimento);

    // INSERT com o nome correto da coluna: caracteristicas (plural)
    $sql = "INSERT INTO pet (nome, dtNascimento, sexo, doador, comportamento, caracteristicas, codEspecie, codRaca, codTipoSanguineo, codTutor)
            VALUES (:nome, :dtNascimento, :sexo, :doador, :comportamento, :caracteristicas, :codEspecie, :codRaca, :codTipoSanguineo, :codTutor)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':dtNascimento', $dtNascimento);
    $stmt->bindValue(':sexo', $sexo);
    $stmt->bindValue(':doador', $doador);
    $stmt->bindValue(':comportamento', $comportamento);
    $stmt->bindValue(':caracteristicas', $caracteristicas);
    $stmt->bindValue(':codEspecie', $codEspecie);
    $stmt->bindValue(':codRaca', $codRaca);
    $stmt->bindValue(':codTipoSanguineo', $codTipoSanguineo);
    $stmt->bindValue(':codTutor', $codTutor);
    
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Registro inserido com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
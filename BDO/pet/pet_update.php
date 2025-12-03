<?php
// BDO/pet/pet_update.php
require_once __DIR__ . '/../_bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

try {
    $codigo = $_POST['update_codigo'] ?? null;
    
    if (!$codigo) {
        echo json_encode(['status'=>'error','msg'=>'Código é obrigatório']);
        exit;
    }

    $nome = $_POST['nome'] ?? null;
    $dtNascimento = $_POST['dtNascimento'] ?? null;
    $dtFalecimento = $_POST['dtFalecimento'] ?? null;
    $sexo = $_POST['sexo'] ?? null;
    $doador = $_POST['doador'] ?? null;
    $comportamento = $_POST['comportamento'] ?? null;
    $caracteristicas = $_POST['caracteristica'] ?? null; // Note: recebe 'caracteristica' mas salva em 'caracteristicas'
    $codEspecie = $_POST['codEspecie'] ?? null;
    $codRaca = $_POST['codRaca'] ?? null;
    $codTipoSanguineo = $_POST['codTipoSanguineo'] ?? null;
    $codTutor = $_POST['codTutor'] ?? null;

    // Função para converter data de DD/MM/YYYY para YYYY-MM-DD
    function converterData($data) {
        if (empty($data)) return null;
        if (preg_match('/^\d{4}-\d{2}-\d{2}/', $data)) return $data;
        if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $data, $matches)) {
            return $matches[3] . '-' . $matches[2] . '-' . $matches[1];
        }
        return null;
    }

    // Converte as datas
    $dtNascimento = converterData($dtNascimento);
    $dtFalecimento = converterData($dtFalecimento);

    // UPDATE com o nome correto da coluna: caracteristicas (plural)
    $sql = "UPDATE pet SET
                nome = :nome,
                dtNascimento = :dtNascimento,
                dtFalecimento = :dtFalecimento,
                sexo = :sexo,
                doador = :doador,
                comportamento = :comportamento,
                caracteristicas = :caracteristicas,
                codEspecie = :codEspecie,
                codRaca = :codRaca,
                codTipoSanguineo = :codTipoSanguineo,
                codTutor = :codTutor
            WHERE codigo = :codigo";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':dtNascimento', $dtNascimento);
    $stmt->bindValue(':dtFalecimento', $dtFalecimento);
    $stmt->bindValue(':sexo', $sexo);
    $stmt->bindValue(':doador', $doador);
    $stmt->bindValue(':comportamento', $comportamento);
    $stmt->bindValue(':caracteristicas', $caracteristicas);
    $stmt->bindValue(':codEspecie', $codEspecie);
    $stmt->bindValue(':codRaca', $codRaca);
    $stmt->bindValue(':codTipoSanguineo', $codTipoSanguineo);
    $stmt->bindValue(':codTutor', $codTutor);
    $stmt->bindValue(':codigo', $codigo);
    
    $stmt->execute();

    echo json_encode(['status'=>'ok','msg'=>'Registro atualizado com sucesso']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status'=>'error','msg'=>$e->getMessage()]);
}
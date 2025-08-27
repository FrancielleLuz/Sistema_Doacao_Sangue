<?php
require_once __DIR__ . '/../_bootstrap.php';
session_start();

// usa a conexão centralizada
require_once __DIR__ . '/../_bootstrap.php';

// Recebe dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (!$email || !$senha) {
    die("Por favor, preencha email e senha.");
}

// Busca usuário ativo pelo e-mail
$sql = "SELECT codigo, nome, senha 
        FROM usuarios 
        WHERE email = :email AND situacao = 'A' 
        LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado ou inativo.");
}

// Verifica senha
if (password_verify($senha, $usuario['senha']) || $usuario['senha'] === $senha) {
    // Login bem-sucedido
    $_SESSION['usuario_codigo'] = $usuario['codigo'];
    $_SESSION['usuario_nome']   = $usuario['nome'];

    echo "Login realizado com sucesso! Bem-vindo, " . htmlspecialchars($usuario['nome']) . ".";
    // ou redirecione:
    // header('Location: /Sistema_Doacao_Sangue/index.php');
    // exit;

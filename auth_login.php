<?php
// auth_login.php — processa o login com hash e upgrade automático
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth_password.php';

function volta($msg) {
    header('Location: login.php?erro=' . urlencode($msg));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    volta('Método inválido.');
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    volta('Informe e-mail e senha.');
}

try {
    $pdo = db_pdo();
    $st = $pdo->prepare('SELECT codigo, nome, email, senha, situacao FROM usuarios WHERE email = ? LIMIT 1');
    $st->execute([$email]);
    $u = $st->fetch();

    if (!$u) volta('Usuário não encontrado.');
    if ($u['situacao'] !== 'A') volta('Usuário inativo.');

    // ✅ Verifica e faz upgrade para hash se a senha estiver em texto puro
    $ok = senha_verify_upgrade($senha, $u['senha'], (int)$u['codigo'], $pdo);
    if (!$ok) volta('Senha inválida.');

    // OK: cria sessão
    $_SESSION['usuario_id']    = (int)$u['codigo'];
    $_SESSION['usuario_nome']  = $u['nome'];
    $_SESSION['usuario_email'] = $u['email'];

    header('Location: index.php');
    exit;
} catch (Throwable $e) {
    volta('Erro: ' . $e->getMessage());
}

<?php
session_start();
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /Sistema_Doacao_Sangue/login.php');
  exit;
}

$usuarioEntrada = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$senhaEntrada   = isset($_POST['senha'])   ? trim($_POST['senha'])   : '';

if ($usuarioEntrada === '' || $senhaEntrada === '') {
  $_SESSION['erro_login'] = 'Informe usuário e senha.';
  header('Location: /Sistema_Doacao_Sangue/login.php');
  exit;
}

$stmt = $pdo->prepare("
  SELECT codigo, nome, login, email, senha, situacao
  FROM usuarios
  WHERE (email = ? OR login = ?)
  LIMIT 1
");
$stmt->execute([$usuarioEntrada, $usuarioEntrada]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);

$autenticado = false;

if ($u && strtoupper(trim($u['situacao'])) === 'A') {
  $banco  = (string)$u['senha'];
  $entrada = (string)$senhaEntrada;

  // 1) Igual texto puro
  if (hash_equals($banco, $entrada)) {
    $autenticado = true;
  }
  // 2) Igual MD5 legado
  elseif (hash_equals($banco, md5($entrada))) {
    $autenticado = true;
  }
  // 3) Hash moderno (password_hash)
  elseif (password_verify($entrada, $banco)) {
    $autenticado = true;
  }
}

if ($autenticado) {
  // seta variáveis de sessão compatíveis com todo o sistema
  $_SESSION['usuario_id']     = $u['codigo']; 
  $_SESSION['usuario_codigo'] = $u['codigo'];
  $_SESSION['usuario_nome']   = $u['nome'];

  header('Location: /Sistema_Doacao_Sangue/index.php');
  exit;
}

$_SESSION['erro_login'] = 'Usuário ou senha inválidos!';
header('Location: /Sistema_Doacao_Sangue/login.php');
exit;

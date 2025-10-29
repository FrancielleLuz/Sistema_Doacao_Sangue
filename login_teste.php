<?php
// login_teste.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/config.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = db_pdo();
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        $st = $pdo->prepare("SELECT codigo, nome, email, senha, situacao FROM usuarios WHERE email = ? LIMIT 1");
        $st->execute([$email]);
        $u = $st->fetch();

        if (!$u) {
            $msg = 'Usuário não encontrado.';
        } elseif ($u['situacao'] !== 'A') {
            $msg = 'Usuário inativo.';
        } elseif (!password_verify($senha, $u['senha'])) {
            $msg = 'Senha inválida.';
        } else {
            $_SESSION['usuario_id'] = $u['codigo'];
            $_SESSION['usuario_nome'] = $u['nome'];
            $msg = 'SUCESSO: autenticado como '.$u['nome'].' ('.$u['email'].')';
        }
    } catch (Throwable $e) {
        $msg = 'Erro: '.$e->getMessage();
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Login - Teste</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;max-width:420px;margin:40px auto;padding:0 16px}
form{display:grid;gap:12px;margin-top:12px}
input[type="email"],input[type="password"]{padding:10px;border:1px solid #ccc;border-radius:8px}
button{padding:10px 14px;border:0;border-radius:8px;cursor:pointer}
button{background:#0d6efd;color:#fff}
.alert{margin-top:12px;padding:10px;border-radius:8px;background:#f6f7f9}
.success{background:#e7f7ee}
</style>
</head>
<body>
  <h1>Login (teste)</h1>
  <p>Use o admin semeado: <b>admin@local</b> / <b>123456</b></p>

  <?php if ($msg): ?>
    <div class="alert <?= strpos($msg,'SUCESSO')===0 ? 'success':'' ?>"><?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?></div>
  <?php endif; ?>

  <form method="post" autocomplete="on">
    <label>E-mail:<br>
      <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? 'admin@local', ENT_QUOTES, 'UTF-8') ?>">
    </label>
    <label>Senha:<br>
      <input type="password" name="senha" required value="123456">
    </label>
    <button type="submit">Entrar</button>
  </form>

  <?php if (!empty($_SESSION['usuario_id'])): ?>
    <p style="margin-top:16px">Sessão ativa: #<?= (int)$_SESSION['usuario_id'] ?> - <?= htmlspecialchars($_SESSION['usuario_nome']) ?></p>
  <?php endif; ?>
</body>
</html>

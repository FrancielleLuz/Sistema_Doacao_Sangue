<?php
// esqueci_enviar.php — gera token, grava na tabela e mostra o link de redefinição
session_start();
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: esqueci.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
if ($email === '') {
    header('Location: esqueci.php?erro=' . urlencode('Informe o e-mail.'));
    exit;
}

$pdo = db_pdo();

// Função para montar URL absoluta do reset
function make_reset_url(string $token): string {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $base   = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); // ex: /Sistema_Doacao_Sangue
    return $scheme.'://'.$host.$base.'/resetar.php?token='.$token;
}

try {
    // 1) Busca usuário (sem revelar se existe)
    $st = $pdo->prepare('SELECT codigo, email FROM usuarios WHERE email = ? LIMIT 1');
    $st->execute([$email]);
    $user = $st->fetch();

    // 2) Se existir, invalida tokens antigos e cria um novo
    $link = null;
    if ($user) {
        $userId = (int)$user['codigo'];

        // Invalida tokens anteriores não usados
        $pdo->prepare('UPDATE password_resets SET used = 1 WHERE user_id = ? AND used = 0')->execute([$userId]);

        // Gera token (64 hex) e guarda hash SHA-256
        $token      = bin2hex(random_bytes(32));
        $token_hash = hash('sha256', $token);
        $expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hora

        $ins = $pdo->prepare('INSERT INTO password_resets (user_id, token_hash, expires_at) VALUES (?, ?, ?)');
        $ins->execute([$userId, $token_hash, $expires_at]);

        // Monta link para exibir na tela (ambiente de desenvolvimento)
        $link = make_reset_url($token);
    }

} catch (Throwable $e) {
    header('Location: esqueci.php?erro=' . urlencode('Erro: '.$e->getMessage()));
    exit;
}

// 3) Exibe página de confirmação (sem revelar se o e-mail existe).
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Redefinição enviada</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f6f7f9}
    .box{max-width:600px;margin:60px auto;padding:24px;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
    .title{margin:0 0 16px;font-weight:600}
    code{word-break:break-all}
  </style>
</head>
<body>
  <div class="box">
    <h3 class="title">Verifique seu e-mail</h3>
    <p>Se <b><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></b> estiver cadastrado, enviamos um link para redefinição de senha.
       O link expira em <b>1 hora</b>.</p>

    <?php if ($link): ?>
      <div class="alert alert-info">
        <b>Ambiente de desenvolvimento:</b><br>
        Use o link abaixo para redefinir agora (sem enviar e-mail):
        <div style="margin-top:8px">
          <a class="btn btn-primary" href="<?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?>">Abrir página de redefinição</a>
        </div>
        <div style="margin-top:8px"><small>URL: <code><?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?></code></small></div>
      </div>
    <?php endif; ?>

    <div style="margin-top:10px">
      <a class="btn btn-default" href="login.php">Voltar ao login</a>
    </div>
  </div>
</body>
</html>

<?php
// resetar.php — valida o token e exibe formulário de nova senha
session_start();
require_once __DIR__ . '/config.php';

$token = $_GET['token'] ?? '';
$erro  = '';
$ok    = '';

// Se não veio token, mostra erro direto
if ($token === '') {
  $erro = 'Link inválido ou ausente. Solicite novamente.';
} else {
  try {
    $pdo = db_pdo();
    $hash = hash('sha256', $token);

    $st = $pdo->prepare(
      'SELECT pr.id, pr.user_id, pr.expires_at, pr.used
         FROM password_resets pr
        WHERE pr.token_hash = ?
        ORDER BY pr.id DESC
        LIMIT 1'
    );
    $st->execute([$hash]);
    $row = $st->fetch();

    if (!$row) {
      $erro = 'Link de redefinição inválido. Solicite novamente.';
    } elseif ((int)$row['used'] === 1) {
      $erro = 'Este link já foi usado. Solicite um novo.';
    } elseif (strtotime($row['expires_at']) < time()) {
      $erro = 'Este link expirou. Solicite um novo.';
    } else {
      // OK, token válido — seguimos e mostramos o formulário
      $reset_id = (int)$row['id'];
    }
  } catch (Throwable $e) {
    $erro = 'Erro ao validar link: ' . $e->getMessage();
  }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Redefinir senha</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background:#f6f7f9}
    .box{max-width:480px;margin:60px auto;padding:24px;background:#fff;border-radius:8px;box-shadow:0 2px 12px rgba(0,0,0,.08)}
    .title{margin:0 0 16px;font-weight:600}
  </style>
</head>
<body>
  <div class="box">
    <h3 class="title">Redefinir senha</h3>

    <?php if ($erro): ?>
      <div class="alert alert-danger" role="alert"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></div>
      <a class="btn btn-default" href="esqueci.php">Voltar</a>
    <?php else: ?>
      <p>Defina sua nova senha. O link expira em até 1 hora a partir da solicitação.</p>
      <form method="post" action="resetar_salvar.php" autocomplete="off">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
        <div class="form-group">
          <label for="senha">Nova senha</label>
          <input class="form-control" id="senha" name="senha" type="password" required>
          <p class="help-block">Mínimo de 6 caracteres.</p>
        </div>
        <div class="form-group">
          <label for="senha2">Confirmar nova senha</label>
          <input class="form-control" id="senha2" name="senha2" type="password" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Salvar nova senha</button>
      </form>
      <div style="margin-top:10px">
        <a class="btn btn-default btn-block" href="login.php">Cancelar</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>

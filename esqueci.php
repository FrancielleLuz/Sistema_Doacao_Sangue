<?php
// esqueci.php � formul�rio para solicitar redefini��o de senha
session_start();
if (isset($_SESSION['usuario_id'])) {
  header('Location: index.php');
  exit;
}
$ok   = $_GET['ok']   ?? '';
$erro = $_GET['erro'] ?? '';
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Esqueci minha senha</title>
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
    <h3 class="title">Esqueci minha senha</h3>

    <?php if ($ok): ?>
      <div class="alert alert-success"><?= htmlspecialchars($ok,ENT_QUOTES,'UTF-8') ?></div>
    <?php endif; ?>
    <?php if ($erro): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($erro,ENT_QUOTES,'UTF-8') ?></div>
    <?php endif; ?>

    <form method="post" action="esqueci_enviar.php" autocomplete="on">
      <div class="form-group">
        <label for="email">E-mail cadastrado</label>
        <input class="form-control" id="email" name="email" type="email" required>
      </div>
      <button class="btn btn-primary btn-block" type="submit">Enviar link de redefini��o</button>
    </form>

    <div style="margin-top:10px">
      <a href="login.php">Voltar ao login</a>
    </div>
  </div>
</body>
</html>

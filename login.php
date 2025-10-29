<?php
session_start();
$erro = $_SESSION['erro_login'] ?? null;
unset($_SESSION['erro_login']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- mesmos assets do index -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
    /* toquezinho pra centralizar o card mantendo seu tema */
    .login-wrapper{min-height:calc(100vh - 120px); display:flex; align-items:center; justify-content:center;}
    .login-card{max-width:420px; width:100%; padding:24px; border:1px solid #ddd; border-radius:8px; background:#fff;}
    .login-title{text-align:center; margin-bottom:16px;}
    .text-danger{margin-bottom:10px;}
  </style>
</head>
<body>
   <?php //require_once 'NavBar.html'; ?> <!-- comentado para não aparecer o menu -->

  <div class="container login-wrapper">
    <div class="login-card">
      <h3 class="login-title">Acesso ao Sistema</h3>

      <?php if ($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
      <?php endif; ?>

      <form action="processa_login.php" method="POST" autocomplete="off">
        <div class="form-group">
          <label for="usuario">E-mail ou Login</label>
          <input type="text" class="form-control" name="usuario" id="usuario" required>
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" class="form-control" name="senha" id="senha" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>

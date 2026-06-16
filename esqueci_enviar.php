<?php
// esqueci_enviar.php — gera token, grava na tabela e envia e-mail via Gmail SMTP
session_start();
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/lib/PHPMailer/Exception.php';
require_once __DIR__ . '/lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/lib/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

// ─── CONFIGURAÇÕES DE E-MAIL ────────────────────────────────────────────────
define('MAIL_FROM',     'herman.alvesgomes@gmail.com');
define('MAIL_PASSWORD', 'rowujzirnmoofogo');
define('MAIL_FROM_NAME','PetSis - Doação de Sangue');
// ────────────────────────────────────────────────────────────────────────────

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: esqueci.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
if ($email === '') {
    header('Location: esqueci.php?erro=' . urlencode('Informe o e-mail.'));
    exit;
}

// Função para montar URL absoluta do reset
function make_reset_url(string $token): string {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $base   = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    return $scheme.'://'.$host.$base.'/resetar.php?token='.$token;
}

$link      = null;
$emailEnviado = false;
$erroMail  = null;

try {
    // 1) Busca usuário (sem revelar se existe)
    $st = $pdo->prepare('SELECT codigo, nome, email FROM usuarios WHERE email = ? LIMIT 1');
    $st->execute([$email]);
    $user = $st->fetch();

    if ($user) {
        $userId = (int)$user['codigo'];

        // 2) Invalida tokens anteriores não usados
        $pdo->prepare('UPDATE password_resets SET used = 1 WHERE user_id = ? AND used = 0')->execute([$userId]);

        // 3) Gera token e salva hash
        $token      = bin2hex(random_bytes(32));
        $token_hash = hash('sha256', $token);
        $expires_at = date('Y-m-d H:i:s', time() + 3600); // 1 hora

        $ins = $pdo->prepare('INSERT INTO password_resets (user_id, token_hash, expires_at) VALUES (?, ?, ?)');
        $ins->execute([$userId, $token_hash, $expires_at]);

        $link = make_reset_url($token);

        // 4) Envia e-mail via Gmail SMTP
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_FROM;
        $mail->Password   = MAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($user['email'], $user['nome'] ?? '');
        $mail->Subject = 'Redefinição de senha — PetSis';
        $mail->isHTML(true);
        $mail->Body = "
            <p>Olá, <b>" . htmlspecialchars($user['nome'] ?? '', ENT_QUOTES, 'UTF-8') . "</b>!</p>
            <p>Recebemos uma solicitação para redefinir a senha da sua conta no <b>PetSis</b>.</p>
            <p>Clique no botão abaixo para criar uma nova senha. O link é válido por <b>1 hora</b>.</p>
            <p style='margin:24px 0'>
                <a href='" . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . "'
                   style='background:#435d7d;color:#fff;padding:12px 24px;border-radius:4px;text-decoration:none;font-size:15px'>
                   Redefinir minha senha
                </a>
            </p>
            <p style='color:#888;font-size:12px'>Se você não solicitou isso, ignore este e-mail. Sua senha permanece a mesma.</p>
        ";
        $mail->AltBody = "Acesse o link para redefinir sua senha: " . $link;

        $mail->send();
        $emailEnviado = true;
    }

} catch (MailException $e) {
    $erroMail = $e->getMessage();
} catch (Throwable $e) {
    header('Location: esqueci.php?erro=' . urlencode('Erro: '.$e->getMessage()));
    exit;
}
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

    <?php if ($emailEnviado): ?>
      <div class="alert alert-success">E-mail enviado com sucesso! Verifique sua caixa de entrada.</div>
    <?php endif; ?>

    <?php if ($erroMail && $link): ?>
      <div class="alert alert-warning">
        <b>Não foi possível enviar o e-mail.</b> Use o link abaixo para redefinir sua senha:
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
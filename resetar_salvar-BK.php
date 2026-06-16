<?php
// resetar_salvar.php — valida token, salva a nova senha (hash) e invalida o token
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth_password.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: esqueci.php');
  exit;
}

$token  = $_POST['token']  ?? '';
$senha  = $_POST['senha']  ?? '';
$senha2 = $_POST['senha2'] ?? '';

if ($token === '') {
  header('Location: esqueci.php?erro=' . urlencode('Link inválido. Solicite novamente.'));
  exit;
}
if ($senha === '' || $senha2 === '') {
  header('Location: esqueci.php?erro=' . urlencode('Informe a nova senha e a confirmação.'));
  exit;
}
if ($senha !== $senha2) {
  header('Location: esqueci.php?erro=' . urlencode('As senhas não conferem.'));
  exit;
}
if (mb_strlen($senha) < 6) {
  header('Location: esqueci.php?erro=' . urlencode('A senha deve ter pelo menos 6 caracteres.'));
  exit;
}

$pdo = db_pdo();

try {
  $pdo->beginTransaction();

  // 1) Revalida o token
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

  if (!$row || (int)$row['used'] === 1 || strtotime($row['expires_at']) < time()) {
    // invalida este token por segurança
    if ($row && (int)$row['used'] === 0) {
      $pdo->prepare('UPDATE password_resets SET used = 1 WHERE id = ?')->execute([(int)$row['id']]);
    }
    $pdo->commit();
    header('Location: esqueci.php?erro=' . urlencode('Link inválido ou expirado. Solicite um novo.'));
    exit;
  }

  $userId = (int)$row['user_id'];

  // 2) Atualiza a senha do usuário (hash)
  $novoHash = senha_hash($senha);
  $upd = $pdo->prepare('UPDATE usuarios SET senha = ? WHERE codigo = ?');
  $upd->execute([$novoHash, $userId]);

  // 3) Invalida o token atual e, opcionalmente, todos os anteriores não usados
  $pdo->prepare('UPDATE password_resets SET used = 1 WHERE id = ?')->execute([(int)$row['id']]);
  $pdo->prepare('UPDATE password_resets SET used = 1 WHERE user_id = ? AND used = 0')->execute([$userId]);

  $pdo->commit();

  // 4) Redireciona ao login
  header('Location: login.php?ok=' . urlencode('Senha redefinida com sucesso. Faça o login.'));
  exit;

} catch (Throwable $e) {
  if ($pdo->inTransaction()) $pdo->rollBack();
  header('Location: esqueci.php?erro=' . urlencode('Erro ao redefinir: ' . $e->getMessage()));
  exit;
}

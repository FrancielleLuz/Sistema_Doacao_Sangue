<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/config.php';

$ok = true;
$msgs = [];

try {
    // Teste com PDO
    $pdo = db_pdo();
    $msgs[] = 'PDO conectado';
    $count = $pdo->query("SELECT COUNT(*) AS n FROM usuarios")->fetch()['n'];
    $msgs[] = "usuarios: $count";
    $st = $pdo->prepare("SELECT codigo, email FROM usuarios WHERE email=?");
    $st->execute(['admin@local']);
    $row = $st->fetch();
    $msgs[] = $row ? 'admin@local ok' : 'admin@local NÃO encontrado';

    // Listar tabelas
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
} catch (Throwable $e) {
    $ok = false;
    $errPdo = $e->getMessage();
}

try {
    // Teste com mysqli
    $cx = db_mysqli();
    $msgs[] = 'MySQLi conectado';
} catch (Throwable $e) {
    $ok = false;
    $errMy = $e->getMessage();
}

header('Content-Type: text/plain; charset=utf-8');
echo $ok ? "OK\n" : "ERRO\n";
foreach ($msgs as $m) echo "- $m\n";

if (!$ok) {
    if (isset($errPdo)) echo "PDO: $errPdo\n";
    if (isset($errMy)) echo "MySQLi: $errMy\n";
}

if (isset($tables)) {
    echo "\nTabelas:\n";
    foreach ($tables as $t) echo " - $t\n";
}

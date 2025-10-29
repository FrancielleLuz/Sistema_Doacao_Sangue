<?php
// auth_password.php — utilitários de senha (hash/upgrade)
require_once __DIR__ . '/config.php';

function senha_hash(string $plain): string {
    return password_hash($plain, PASSWORD_BCRYPT);
}

function senha_is_hash(string $s): bool {
    $info = password_get_info($s);
    return ($info['algo'] !== 0); // 0 = não é hash reconhecido
}

/**
 * Verifica a senha:
 * - Se já for hash, usa password_verify e re-hash se necessário.
 * - Se for senha em texto puro (legado), compara, faz upgrade para hash e retorna OK.
 */
function senha_verify_upgrade(string $plain, string $hashOrPlain, int $userId, PDO $pdo): bool {
    if (senha_is_hash($hashOrPlain)) {
        $ok = password_verify($plain, $hashOrPlain);
        if ($ok && password_needs_rehash($hashOrPlain, PASSWORD_BCRYPT)) {
            $novo = senha_hash($plain);
            $st = $pdo->prepare('UPDATE usuarios SET senha = ? WHERE codigo = ?');
            $st->execute([$novo, $userId]);
        }
        return $ok;
    } else {
        // legado: senha salva em texto puro
        if (hash_equals($hashOrPlain, $plain)) {
            $novo = senha_hash($plain);
            $st = $pdo->prepare('UPDATE usuarios SET senha = ? WHERE codigo = ?');
            $st->execute([$novo, $userId]);
            return true;
        }
        return false;
    }
}

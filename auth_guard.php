<?php
// auth_guard.php — protege páginas que exigem login
session_start();

// Permite chamadas AJAX públicas específicas (se precisar, ajuste aqui)
$public_paths = [
  '/login.php',
  '/auth_login.php',
  '/logout.php',
  '/esqueci.php',
  '/esqueci_enviar.php',
  '/resetar.php',
  '/resetar_salvar.php',
];
// Normaliza caminho atual (apenas para referência futura se necessário)
$current = '/' . ltrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

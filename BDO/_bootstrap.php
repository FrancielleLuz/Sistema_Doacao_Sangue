<?php
require_once __DIR__ . '/_bootstrap.php';
// BDO/_bootstrap.php — centraliza a conexão para todos os arquivos dentro de BDO/
require_once dirname(__DIR__) . '/db.php';

// Se alguns arquivos usam $conexao ao invés de $pdo, descomente a linha abaixo:
// $conexao = $pdo;

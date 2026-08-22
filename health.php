<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');
$checks = ['php' => PHP_VERSION, 'application' => 'ok'];
$status = 'ok';
try {
    require_once __DIR__ . '/01_Core/Database/Database.php';
    $pdo = \SGW\Repository\Database::connection();
    $pdo->query('SELECT 1');
    $checks['database'] = 'ok';
} catch (Throwable $e) {
    $checks['database'] = 'unavailable';
    $status = 'degraded';
}
http_response_code($status === 'ok' ? 200 : 503);
echo json_encode(['status' => $status, 'checks' => $checks, 'timestamp' => gmdate('c')], JSON_UNESCAPED_SLASHES) . PHP_EOL;

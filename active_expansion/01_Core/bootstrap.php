<?php
declare(strict_types=1);

require_once __DIR__ . '/Database.php';

$db = Database::connection();

spl_autoload_register(function (string $class): void {
    $prefix = 'MMO\\';
    if (!str_starts_with($class, $prefix)) return;
    $relative = str_replace('\\', '/', substr($class, strlen($prefix)));
    $file = dirname(__DIR__) . '/' . $relative . '.php';
    if (is_file($file)) require_once $file;
});

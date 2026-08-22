<?php
declare(strict_types=1);
return [
    'host' => getenv('DB_HOST') ?: '127.0.0.1',
    'port' => (int)(getenv('DB_PORT') ?: 3306),
    'database' => getenv('DB_DATABASE') ?: 'stargatewars',
    'username' => getenv('DB_USERNAME') ?: 'stargate_app',
    'password' => getenv('DB_PASSWORD') ?: 'StargateLocal2026',
    'charset' => 'utf8mb4',
];

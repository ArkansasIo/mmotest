<?php
declare(strict_types=1);

use PDO;

final class Database
{
    public static function connection(): PDO
    {
        static $pdo;
        if ($pdo instanceof PDO) return $pdo;

        $dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=mmotest;charset=utf8mb4';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';

        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    }
}

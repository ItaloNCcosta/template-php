<?php

declare(strict_types=1);

namespace App\Connection;

final class DatabaseManager
{
    private const sqlite = 'sqlite';
    private const mysql = 'mysql';

    public function __construct()
    {
        $this->getConnection();
    }

    public function getConnection(): \PDO
    {
        $connectionType = $_ENV['DB_CONNECTION'];

        return match ($connectionType) {
            self::sqlite => (new Sqlite())->getInstance(),
            self::mysql => (new Mysql)->getInstance(),
            default => throw new \Exception("Connection type {$connectionType} not supported")
        };
    }
}

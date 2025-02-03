<?php

declare(strict_types=1);

namespace App\Connection;

final class Sqlite
{
    private static \PDO $instance;

    public function __construct()
    {
        if (!isset(self::$instance)) {
            $this->connect();
            $this->executeDump();
        }
    }

    private function connect(): void
    {
        self::$instance = new \PDO("sqlite:../database/database.sqlite");
        self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getInstance(): \PDO
    {
        return self::$instance;
    }

    private function executeDump(): void
    {
        $dumpFile = '../database/dumpsqlite.sql';

        $sql = file_get_contents($dumpFile);

        if ($sql === false) {
            throw new \Exception('Não foi possível ler o arquivo dump.sql');
        }

        self::$instance->exec($sql);
    }
}

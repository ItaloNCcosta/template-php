<?php

declare(strict_types=1);

namespace App\Connection;

final class Mysql
{
    private static \PDO $instance;

    public function __construct()
    {
        if(!isset(self::$instance)) {
            $this->connect();
        }
    }

    private function connect(): void
    {
        self::$instance = new \PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    public function getInstance(): \PDO
    {
        return self::$instance;
    }
}

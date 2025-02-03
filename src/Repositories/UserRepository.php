<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Connection\DatabaseManager;
use App\Entity\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    private \PDO $pdo;
    private string $table = 'users';

    public function __construct()
    {
        $this->pdo = (new DatabaseManager())->getConnection();
    }

    public function list(): array
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            $users = $stmt->fetchAll(\PDO::FETCH_OBJ);

            return $users;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function find(int $id): User
    {
        try {
            $sql = "SELECT id, name, email, password FROM $this->table WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $user = $stmt->fetchObject(User::class);

            if (!$user) {
                throw new \Exception('User not found');
            }

            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function save(User $user): void
    {
        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->execute();

            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();

            throw $e;
        }
    }

    public function update(User $user): void
    {
        try {
            $sql = "UPDATE $this->table SET name=:name, email=:email, password=:password WHERE id = :id";

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $user->getId());
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->execute();

            $this->pdo->commit();
        } catch (\Exception $e) {
            $this->pdo->rollBack();

            throw $e;
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->find($id);

            $sql = "DELETE FROM $this->table WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}

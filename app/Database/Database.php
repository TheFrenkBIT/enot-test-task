<?php

namespace App\Database;
use App\Database\DatabaseInterface;
class Database implements DatabaseInterface
{
    private \PDO $pdo;
    public function __construct()
    {
        $this->connect();
    }

    public function insert(string $table, array $data): bool
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($fields) => ":$fields", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }
        return true;
    }
    public function update(string $table, string $rateId, array $data) : bool
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($fields) => "SET $fields = :$fields", $fields));
        $sql = "UPDATE $table $binds WHERE rate_id = $rateId";
        dd($sql);
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }
        return true;
    }
    public function getAll(string $table) : ?array
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    private function connect()
    {
        try
        {
            $this->pdo = new \PDO('pgsql:host=172.19.0.2;port=5432;dbname=Test-Projects', 'test', 'root');
        }
        catch (\PDOException $exception)
        {
            exit($exception->getMessage());
        }
    }
}
<?php

namespace App\Database;

interface DatabaseInterface
{
    public function insert (string $table, array $data) : bool;
    public function first (string $table, array $conditions = []) : ?array;
    public function getAll (string $table) : ?array;
    public function update (string $table, string $rateId, array $data) : bool;
}
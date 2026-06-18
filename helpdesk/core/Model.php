<?php

abstract class Model
{
    protected Database $db;
    protected string $table;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all(): array
    {
        $stmt = $this->db->getConnection()
            ->query("SELECT * FROM {$this->table}");

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->getConnection()
            ->prepare("SELECT * FROM {$this->table} WHERE id = ?");

        $stmt->execute([$id]);

        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->getConnection()
            ->prepare("DELETE FROM {$this->table} WHERE id = ?");

        return $stmt->execute([$id]);
    }

    public function create(array $data): int
    {
        $columns = implode(',', array_keys($data));

        $placeholders = implode(
            ',',
            array_fill(0, count($data), '?')
        );

        $sql =
            "INSERT INTO {$this->table}
            ({$columns})
            VALUES ({$placeholders})";

        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->execute(array_values($data));

        return (int)$this->db->getConnection()->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $fields = [];

        foreach(array_keys($data) as $key)
        {
            $fields[] = "{$key} = ?";
        }

        $sql =
            "UPDATE {$this->table}
             SET ".implode(',', $fields)."
             WHERE id = ?";

        $stmt = $this->db->getConnection()->prepare($sql);

        return $stmt->execute([
            ...array_values($data),
            $id
        ]);
    }
}
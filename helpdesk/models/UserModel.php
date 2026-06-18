<?php

require_once 'core/Model.php';

class UserModel extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare(
                "SELECT *
                 FROM users
                 WHERE email = ?"
            );

        $stmt->execute([$email]);

        return $stmt->fetch() ?: null;
    }

    public function getStaffByDepartment(
        int $departmentId
    ): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare(
                "SELECT *
                 FROM users
                 WHERE department_id = ?
                 AND role IN ('staff','admin')
                 AND is_active = 1"
            );

        $stmt->execute([$departmentId]);

        return $stmt->fetchAll();
    }

    public function getActiveUsers(): array
    {
        $stmt = $this->db
            ->getConnection()
            ->query(
                "SELECT *
                 FROM users
                 WHERE is_active = 1"
            );

        return $stmt->fetchAll();
    }
}
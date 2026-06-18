<?php

require_once 'core/Model.php';

class CategoryModel extends Model
{
    protected string $table = 'ticket_categories';

    public function getByDepartment(int $departmentId): array
    {
        return $this->db->query(
            "SELECT *
             FROM ticket_categories
             WHERE department_id=?",
            [$departmentId]
        )->fetchAll();
    }
}
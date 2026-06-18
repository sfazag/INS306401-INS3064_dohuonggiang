<?php

require_once 'core/Model.php';

class RoutingKeywordModel extends Model
{
    protected string $table = 'routing_keywords';

    public function getKeywordsByCategory(
        int $categoryId
    ): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT *
                FROM routing_keywords
                WHERE category_id = ?
            ");

        $stmt->execute([$categoryId]);

        return $stmt->fetchAll();
    }
}
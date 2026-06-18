<?php

require_once 'core/Model.php';

class AssignmentModel extends Model
{
    protected string $table = 'ticket_assignments';

    public function getByTicket(int $ticketId): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT *
                FROM ticket_assignments
                WHERE ticket_id = ?
                ORDER BY assigned_at DESC
            ");

        $stmt->execute([$ticketId]);

        return $stmt->fetchAll();
    }
}
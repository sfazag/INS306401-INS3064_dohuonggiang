<?php

require_once 'core/Model.php';

class TicketModel extends Model
{
    protected string $table = 'tickets';

    public function findWithDetails(int $id): ?array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT
                    t.*,
                    c.name AS category_name,
                    s.full_name AS submitter_name,
                    a.full_name AS assigned_name

                FROM tickets t

                LEFT JOIN ticket_categories c
                    ON t.category_id = c.id

                LEFT JOIN users s
                    ON t.submitter_id = s.id

                LEFT JOIN users a
                    ON t.assigned_to = a.id

                WHERE t.id = ?
            ");

        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public function getOpenTickets(): array
    {
        return $this->db
            ->query("
                SELECT *
                FROM tickets
                WHERE status NOT IN
                ('resolved','closed','cancelled')
            ")
            ->fetchAll();
    }

    public function getByStaff(int $staffId): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT *
                FROM tickets
                WHERE assigned_to = ?
            ");

        $stmt->execute([$staffId]);

        return $stmt->fetchAll();
    }
}
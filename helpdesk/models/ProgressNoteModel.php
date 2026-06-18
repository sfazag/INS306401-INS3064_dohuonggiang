<?php

require_once 'core/Model.php';

class ProgressNoteModel extends Model
{
    protected string $table =
        'ticket_progress_notes';

    public function getByTicket(
        int $ticketId
    ): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT
                    pn.*,
                    u.full_name

                FROM ticket_progress_notes pn

                JOIN users u
                    ON pn.staff_id = u.id

                WHERE ticket_id = ?

                ORDER BY created_at DESC
            ");

        $stmt->execute([$ticketId]);

        return $stmt->fetchAll();
    }
}
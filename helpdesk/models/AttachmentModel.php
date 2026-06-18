<?php

require_once 'core/Model.php';

class AttachmentModel extends Model
{
    protected string $table =
        'ticket_attachments';

    public function getByTicket(
        int $ticketId
    ): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT *
                FROM ticket_attachments
                WHERE ticket_id = ?
            ");

        $stmt->execute([$ticketId]);

        return $stmt->fetchAll();
    }
}
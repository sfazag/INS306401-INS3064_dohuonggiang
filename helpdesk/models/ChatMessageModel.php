<?php

require_once 'core/Model.php';

class ChatMessageModel extends Model
{
    protected string $table =
        'chat_messages';

    public function getByTicket(
        int $ticketId
    ): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT
                    cm.*,
                    u.full_name

                FROM chat_messages cm

                JOIN users u
                    ON cm.sender_id = u.id

                WHERE ticket_id = ?

                ORDER BY sent_at ASC
            ");

        $stmt->execute([$ticketId]);

        return $stmt->fetchAll();
    }
}
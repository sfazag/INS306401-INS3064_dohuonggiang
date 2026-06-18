<?php

require_once 'core/Model.php';

class NotificationModel extends Model
{
    protected string $table =
        'notifications';

    public function getByUser(
        int $userId
    ): array
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT *
                FROM notifications
                WHERE user_id = ?
                ORDER BY created_at DESC
            ");

        $stmt->execute([$userId]);

        return $stmt->fetchAll();
    }

    public function unreadCount(
        int $userId
    ): int
    {
        $stmt = $this->db
            ->getConnection()
            ->prepare("
                SELECT COUNT(*) total
                FROM notifications
                WHERE user_id = ?
                AND is_read = 0
            ");

        $stmt->execute([$userId]);

        return (int)
            $stmt->fetch()['total'];
    }

    public function markAsRead(
        int $id
    ): bool
    {
        return $this->update(
            $id,
            ['is_read' => 1]
        );
    }
}
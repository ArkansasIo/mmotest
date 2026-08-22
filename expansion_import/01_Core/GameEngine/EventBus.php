<?php
declare(strict_types=1);

namespace MMO\Core\GameEngine;

use PDO;

final class EventBus
{
    public function __construct(private PDO $db) {}

    public function dispatch(string $type, int $actorId, array $payload = []): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO game_events (event_type, actor_id, payload_json, execute_at, created_at)
             VALUES (:type, :actor, :payload, UTC_TIMESTAMP(), UTC_TIMESTAMP())'
        );
        $stmt->execute([
            'type' => $type,
            'actor' => $actorId,
            'payload' => json_encode($payload, JSON_THROW_ON_ERROR),
        ]);
        return (int)$this->db->lastInsertId();
    }
}

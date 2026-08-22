<?php
declare(strict_types=1);

namespace MMO\Gameplay\Research;

use PDO;
use RuntimeException;

final class ResearchService
{
    public function __construct(private PDO $db) {}

    public function start(int $playerId, int $technologyId): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO research_queue
             (player_id, technology_id, execute_at, created_at)
             VALUES (:player,:technology,DATE_ADD(UTC_TIMESTAMP(), INTERVAL 300 SECOND),UTC_TIMESTAMP())'
        );
        $stmt->execute(['player'=>$playerId,'technology'=>$technologyId]);
        return (int)$this->db->lastInsertId();
    }
}

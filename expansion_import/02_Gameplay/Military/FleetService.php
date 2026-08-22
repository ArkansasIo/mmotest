<?php
declare(strict_types=1);

namespace MMO\Gameplay\Military;

use PDO;
use RuntimeException;

final class FleetService
{
    public function __construct(private PDO $db) {}

    public function launch(int $playerId, int $fleetId, string $mission, string $destination): int
    {
        $allowed = ['attack','defend','transport','colonize','scout','espionage','explore','deploy','reinforce'];
        if (!in_array($mission, $allowed, true)) {
            throw new RuntimeException('Invalid fleet mission.');
        }

        $stmt = $this->db->prepare(
            'INSERT INTO fleet_missions
             (player_id, fleet_id, mission_type, destination, status, execute_at, created_at)
             VALUES (:player,:fleet,:mission,:destination,"traveling",
                     DATE_ADD(UTC_TIMESTAMP(), INTERVAL 60 SECOND),UTC_TIMESTAMP())'
        );
        $stmt->execute([
            'player'=>$playerId,'fleet'=>$fleetId,
            'mission'=>$mission,'destination'=>$destination
        ]);
        return (int)$this->db->lastInsertId();
    }
}

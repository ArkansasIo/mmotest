<?php
declare(strict_types=1);

namespace MMO\Core\GameEngine;

use PDO;

final class TurnProcessor
{
    public function __construct(private PDO $db) {}

    public function process(int $turnId): void
    {
        $this->db->beginTransaction();
        try {
            $this->processQueue('construction_queue', $turnId);
            $this->processQueue('research_queue', $turnId);
            $this->processQueue('fleet_missions', $turnId);
            $this->processQueue('game_events', $turnId);
            $this->db->commit();
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    private function processQueue(string $table, int $turnId): void
    {
        $allowed = ['construction_queue','research_queue','fleet_missions','game_events'];
        if (!in_array($table, $allowed, true)) return;
        $sql = "UPDATE {$table} SET processed_turn_id = :turn
                WHERE processed_turn_id IS NULL AND execute_at <= UTC_TIMESTAMP()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['turn' => $turnId]);
    }
}

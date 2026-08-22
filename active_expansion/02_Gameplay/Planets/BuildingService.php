<?php
declare(strict_types=1);

namespace MMO\Gameplay\Planets;

use PDO;
use RuntimeException;

final class BuildingService
{
    public function __construct(private PDO $db) {}

    public function queueUpgrade(int $planetId, int $buildingTypeId): int
    {
        $this->db->beginTransaction();
        try {
            $q = $this->db->prepare(
                'SELECT level FROM planet_buildings WHERE planet_id=:planet AND building_type_id=:type FOR UPDATE'
            );
            $q->execute(['planet'=>$planetId,'type'=>$buildingTypeId]);
            $row = $q->fetch(PDO::FETCH_ASSOC);
            $level = $row ? (int)$row['level'] + 1 : 1;

            $i = $this->db->prepare(
                'INSERT INTO construction_queue
                 (planet_id, building_type_id, target_level, execute_at, created_at)
                 VALUES (:planet,:type,:level,DATE_ADD(UTC_TIMESTAMP(), INTERVAL :seconds SECOND),UTC_TIMESTAMP())'
            );
            $seconds = max(30, $level * 60);
            $i->bindValue(':planet', $planetId, PDO::PARAM_INT);
            $i->bindValue(':type', $buildingTypeId, PDO::PARAM_INT);
            $i->bindValue(':level', $level, PDO::PARAM_INT);
            $i->bindValue(':seconds', $seconds, PDO::PARAM_INT);
            $i->execute();

            $id = (int)$this->db->lastInsertId();
            $this->db->commit();
            return $id;
        } catch (\Throwable $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}

<?php
declare(strict_types=1);

namespace MMO\Gameplay\Economy;

use PDO;
use RuntimeException;

final class EconomyService
{
    public function __construct(private PDO $db) {}

    public function producePlanet(int $planetId): void
    {
        $q = $this->db->prepare(
            'SELECT p.*, COALESCE(SUM(pb.production_bonus),0) building_bonus
             FROM planets p
             LEFT JOIN planet_buildings pb ON pb.planet_id = p.id
             WHERE p.id = :id GROUP BY p.id'
        );
        $q->execute(['id' => $planetId]);
        $planet = $q->fetch(PDO::FETCH_ASSOC);
        if (!$planet) throw new RuntimeException('Planet not found.');

        $metal = max(0, (int)$planet['metal_production'] + (int)$planet['building_bonus']);
        $crystal = max(0, (int)$planet['crystal_production']);
        $naquadah = max(0, (int)$planet['naquadah_production']);

        $u = $this->db->prepare(
            'UPDATE planets SET metal = metal + :m, crystal = crystal + :c,
             naquadah = naquadah + :n WHERE id = :id'
        );
        $u->execute(['m'=>$metal,'c'=>$crystal,'n'=>$naquadah,'id'=>$planetId]);
    }
}

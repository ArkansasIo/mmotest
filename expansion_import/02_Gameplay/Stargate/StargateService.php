<?php
declare(strict_types=1);

namespace MMO\Gameplay\Stargate;

use PDO;
use RuntimeException;

final class StargateService
{
    public function __construct(private PDO $db) {}

    public function activate(int $gateId, int $playerId, int $energyCost = 100): int
    {
        $q = $this->db->prepare('SELECT id, energy, cooldown_until FROM stargates WHERE id=:id FOR UPDATE');
        $q->execute(['id'=>$gateId]);
        $gate = $q->fetch(PDO::FETCH_ASSOC);

        if (!$gate) throw new RuntimeException('Stargate not found.');
        if ((int)$gate['energy'] < $energyCost) throw new RuntimeException('Insufficient gate energy.');
        if (!empty($gate['cooldown_until']) && strtotime($gate['cooldown_until']) > time()) {
            throw new RuntimeException('Stargate is on cooldown.');
        }

        $u = $this->db->prepare(
            'UPDATE stargates SET energy=energy-:cost,
             cooldown_until=DATE_ADD(UTC_TIMESTAMP(), INTERVAL 60 SECOND),
             last_activated_by=:player WHERE id=:id'
        );
        $u->execute(['cost'=>$energyCost,'player'=>$playerId,'id'=>$gateId]);
        return $gateId;
    }
}

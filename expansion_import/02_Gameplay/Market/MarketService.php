<?php
declare(strict_types=1);

namespace MMO\Gameplay\Market;

use PDO;

final class MarketService
{
    public function __construct(private PDO $db) {}

    public function createOrder(int $playerId, string $resource, string $side, int $quantity, int $price): int
    {
        $allowedResources = ['metal','crystal','naquadah','food','water'];
        if (!in_array($resource, $allowedResources, true)) throw new \InvalidArgumentException('Invalid resource.');
        if (!in_array($side, ['buy','sell'], true)) throw new \InvalidArgumentException('Invalid side.');
        if ($quantity <= 0 || $price <= 0) throw new \InvalidArgumentException('Invalid order.');

        $stmt = $this->db->prepare(
            'INSERT INTO market_orders
             (player_id, resource, side, quantity, unit_price, status, created_at)
             VALUES (:player,:resource,:side,:quantity,:price,"open",UTC_TIMESTAMP())'
        );
        $stmt->execute(compact('playerId','resource','side','quantity','price'));
        return (int)$this->db->lastInsertId();
    }
}

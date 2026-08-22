<?php
declare(strict_types=1);

/**
 * Translates the Deep MMO Expansion write model into the canonical schema.
 *
 * Callers should pass an existing PDO instance. Every mutating method is
 * transactional; if the caller already owns a transaction, the adapter uses
 * that transaction and does not commit or roll it back independently.
 */
final class MmoExpansionCompatibilityAdapter
{
    public function __construct(private PDO $pdo) {}

    /** @template TReturn @param callable():TReturn $operation @return TReturn */
    public function transactional(callable $operation): mixed
    {
        $owner = !$this->pdo->inTransaction();
        if ($owner) {
            $this->pdo->beginTransaction();
        }
        try {
            $result = $operation();
            if ($owner) {
                $this->pdo->commit();
            }
            return $result;
        } catch (Throwable $e) {
            if ($owner && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function recordEvent(
        string $eventType,
        array $payload,
        ?int $playerId = null,
        ?int $actorId = null,
        ?string $executeAt = null,
        ?int $processedTurnId = null,
        ?string $entityType = 'mmo_expansion',
        ?int $entityId = null
    ): int {
        if ($eventType === '' || strlen($eventType) > 80) {
            throw new InvalidArgumentException('Invalid event type');
        }
        $json = json_encode($payload, JSON_THROW_ON_ERROR);
        return (int)$this->transactional(function () use ($eventType, $json, $playerId, $actorId, $executeAt, $processedTurnId, $entityType, $entityId): int {
            $sql = 'INSERT INTO game_events
                (player_id, event_type, entity_type, entity_id, payload, actor_id, payload_json, execute_at, processed_turn_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$playerId, $eventType, $entityType, $entityId, $json, $actorId, $json, $executeAt, $processedTurnId]);
            return (int)$this->pdo->lastInsertId();
        });
    }

    public function queueConstruction(
        int $playerId,
        int $planetId,
        int $buildingTypeId,
        int $targetLevel,
        string $startsAt,
        string $completesAt,
        ?int $quantity = 1
    ): int {
        if ($playerId < 1 || $planetId < 1 || $buildingTypeId < 1 || $targetLevel < 0 || ($quantity ?? 0) < 1) {
            throw new InvalidArgumentException('Invalid construction queue values');
        }
        return (int)$this->transactional(function () use ($playerId, $planetId, $buildingTypeId, $targetLevel, $startsAt, $completesAt, $quantity): int {
            $stmt = $this->pdo->prepare('INSERT INTO construction_queue
                (player_id, colony_id, queue_type, item_key, quantity, level_before, starts_at, completes_at,
                 planet_id, building_type_id, target_level, execute_at)
                VALUES (?, ?, \'building\', ?, ?, 0, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$playerId, $planetId, 'expansion_building:' . $buildingTypeId, $quantity, $startsAt, $completesAt, $planetId, $buildingTypeId, $targetLevel, $completesAt]);
            return (int)$this->pdo->lastInsertId();
        });
    }

    public function queueFleetMission(
        int $playerId,
        int $fleetId,
        int $sourceColonyId,
        ?int $targetColonyId,
        string $missionType,
        string $destination,
        string $departureAt,
        string $arrivalAt,
        ?string $payload = null
    ): int {
        if ($playerId < 1 || $fleetId < 1 || $sourceColonyId < 1 || $missionType === '' || $destination === '') {
            throw new InvalidArgumentException('Invalid fleet mission values');
        }
        return (int)$this->transactional(function () use ($playerId, $fleetId, $sourceColonyId, $targetColonyId, $missionType, $destination, $departureAt, $arrivalAt, $payload): int {
            $stmt = $this->pdo->prepare('INSERT INTO fleet_missions
                (player_id, source_colony_id, target_colony_id, fleet_id, mission_type, destination, payload,
                 departure_at, arrival_at, execute_at, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, \'scheduled\')');
            $stmt->execute([$playerId, $sourceColonyId, $targetColonyId, $fleetId, $missionType, $destination, $payload ?? '{}', $departureAt, $arrivalAt, $arrivalAt]);
            return (int)$this->pdo->lastInsertId();
        });
    }

    public function createMarketOrder(
        int $playerId,
        string $resource,
        string $side,
        int $quantity,
        int $unitPrice,
        ?string $expiresAt = null
    ): int {
        if ($playerId < 1 || $resource === '' || !in_array($side, ['buy', 'sell'], true) || $quantity < 1 || $unitPrice < 1) {
            throw new InvalidArgumentException('Invalid market order values');
        }
        return (int)$this->transactional(function () use ($playerId, $resource, $side, $quantity, $unitPrice, $expiresAt): int {
            $stmt = $this->pdo->prepare('INSERT INTO market_orders
                (seller_id, player_id, resource_type, resource, side, quantity, unit_price, status, expires_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, \'open\', ?)');
            $stmt->execute([$playerId, $playerId, $resource, $resource, $side, $quantity, $unitPrice, $expiresAt]);
            return (int)$this->pdo->lastInsertId();
        });
    }
}

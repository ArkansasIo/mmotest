-- MMO Expansion compatibility migration 49
-- Purpose: preserve canonical tables while adding nullable expansion fields.
-- Safe to run repeatedly on MariaDB 10.11. No data is deleted or renamed.
-- Review and execute through the normal migration runner only.

ALTER TABLE game_events
  ADD COLUMN IF NOT EXISTS actor_id BIGINT UNSIGNED NULL AFTER event_type,
  ADD COLUMN IF NOT EXISTS payload_json JSON NULL AFTER payload,
  ADD COLUMN IF NOT EXISTS execute_at DATETIME NULL AFTER created_at,
  ADD COLUMN IF NOT EXISTS processed_turn_id BIGINT UNSIGNED NULL AFTER execute_at,
  ADD INDEX IF NOT EXISTS idx_game_events_expansion_due (execute_at, processed_turn_id),
  ADD INDEX IF NOT EXISTS idx_game_events_expansion_actor (actor_id);

ALTER TABLE construction_queue
  ADD COLUMN IF NOT EXISTS planet_id BIGINT UNSIGNED NULL AFTER id,
  ADD COLUMN IF NOT EXISTS building_type_id BIGINT UNSIGNED NULL AFTER planet_id,
  ADD COLUMN IF NOT EXISTS target_level INT NULL AFTER building_type_id,
  ADD COLUMN IF NOT EXISTS execute_at DATETIME NULL AFTER completes_at,
  ADD COLUMN IF NOT EXISTS processed_turn_id BIGINT UNSIGNED NULL AFTER execute_at,
  ADD INDEX IF NOT EXISTS idx_construction_expansion_due (execute_at, processed_turn_id);

ALTER TABLE fleet_missions
  ADD COLUMN IF NOT EXISTS fleet_id BIGINT UNSIGNED NULL AFTER player_id,
  ADD COLUMN IF NOT EXISTS destination VARCHAR(32) NULL AFTER target_colony_id,
  ADD COLUMN IF NOT EXISTS execute_at DATETIME NULL AFTER arrival_at,
  ADD COLUMN IF NOT EXISTS processed_turn_id BIGINT UNSIGNED NULL AFTER execute_at,
  ADD INDEX IF NOT EXISTS idx_fleet_expansion_due (execute_at, processed_turn_id);

ALTER TABLE market_orders
  ADD COLUMN IF NOT EXISTS player_id BIGINT UNSIGNED NULL AFTER id,
  ADD COLUMN IF NOT EXISTS resource VARCHAR(32) NULL AFTER resource_type,
  ADD COLUMN IF NOT EXISTS side ENUM('buy','sell') NULL AFTER resource,
  ADD INDEX IF NOT EXISTS idx_market_expansion_match (resource, side, status, unit_price);

-- Conservative backfills only populate newly-added aliases when unambiguous.
UPDATE game_events
SET payload_json = payload
WHERE payload_json IS NULL AND payload IS NOT NULL AND JSON_VALID(payload);

UPDATE construction_queue
SET planet_id = colony_id
WHERE planet_id IS NULL AND colony_id IS NOT NULL;

UPDATE construction_queue
SET execute_at = completes_at
WHERE execute_at IS NULL AND completes_at IS NOT NULL;

UPDATE fleet_missions
SET execute_at = arrival_at
WHERE execute_at IS NULL AND arrival_at IS NOT NULL;

UPDATE market_orders
SET player_id = seller_id
WHERE player_id IS NULL AND seller_id IS NOT NULL;

UPDATE market_orders
SET resource = resource_type
WHERE resource IS NULL AND resource_type IS NOT NULL;

-- The following columns intentionally remain nullable because existing rows cannot
-- be assigned expansion-only actor, building, fleet, turn, or order-side values
-- without domain-specific application context.

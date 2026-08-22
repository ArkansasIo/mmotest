-- MMO Expansion compatibility migration 49 rollback
-- Run only if migration 49 has been reviewed and no expansion code depends on it.
-- Existing canonical columns are never removed by this rollback.

ALTER TABLE game_events
  DROP INDEX IF EXISTS idx_game_events_expansion_due,
  DROP INDEX IF EXISTS idx_game_events_expansion_actor,
  DROP COLUMN IF EXISTS processed_turn_id,
  DROP COLUMN IF EXISTS execute_at,
  DROP COLUMN IF EXISTS payload_json,
  DROP COLUMN IF EXISTS actor_id;

ALTER TABLE construction_queue
  DROP INDEX IF EXISTS idx_construction_expansion_due,
  DROP COLUMN IF EXISTS processed_turn_id,
  DROP COLUMN IF EXISTS execute_at,
  DROP COLUMN IF EXISTS target_level,
  DROP COLUMN IF EXISTS building_type_id,
  DROP COLUMN IF EXISTS planet_id;

ALTER TABLE fleet_missions
  DROP INDEX IF EXISTS idx_fleet_expansion_due,
  DROP COLUMN IF EXISTS processed_turn_id,
  DROP COLUMN IF EXISTS execute_at,
  DROP COLUMN IF EXISTS destination,
  DROP COLUMN IF EXISTS fleet_id;

ALTER TABLE market_orders
  DROP INDEX IF EXISTS idx_market_expansion_match,
  DROP COLUMN IF EXISTS side,
  DROP COLUMN IF EXISTS resource,
  DROP COLUMN IF EXISTS player_id;

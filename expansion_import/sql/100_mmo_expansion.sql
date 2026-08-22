CREATE TABLE IF NOT EXISTS game_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  event_type VARCHAR(80) NOT NULL,
  actor_id BIGINT UNSIGNED NULL,
  payload_json JSON NOT NULL,
  execute_at DATETIME NOT NULL,
  processed_turn_id BIGINT UNSIGNED NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_events_due (execute_at, processed_turn_id),
  INDEX idx_events_actor (actor_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS construction_queue (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  planet_id BIGINT UNSIGNED NOT NULL,
  building_type_id BIGINT UNSIGNED NOT NULL,
  target_level INT NOT NULL,
  execute_at DATETIME NOT NULL,
  processed_turn_id BIGINT UNSIGNED NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_construction_due (execute_at, processed_turn_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS research_queue (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id BIGINT UNSIGNED NOT NULL,
  technology_id BIGINT UNSIGNED NOT NULL,
  execute_at DATETIME NOT NULL,
  processed_turn_id BIGINT UNSIGNED NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_research_due (execute_at, processed_turn_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fleet_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id BIGINT UNSIGNED NOT NULL,
  fleet_id BIGINT UNSIGNED NOT NULL,
  mission_type VARCHAR(40) NOT NULL,
  destination VARCHAR(32) NOT NULL,
  status VARCHAR(30) NOT NULL,
  execute_at DATETIME NOT NULL,
  processed_turn_id BIGINT UNSIGNED NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_fleet_due (execute_at, processed_turn_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS market_orders (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id BIGINT UNSIGNED NOT NULL,
  resource VARCHAR(32) NOT NULL,
  side ENUM('buy','sell') NOT NULL,
  quantity BIGINT UNSIGNED NOT NULL,
  unit_price BIGINT UNSIGNED NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'open',
  created_at DATETIME NOT NULL,
  INDEX idx_market_match (resource, side, status, unit_price)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stargates (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  planet_id BIGINT UNSIGNED NOT NULL,
  energy BIGINT UNSIGNED NOT NULL DEFAULT 0,
  cooldown_until DATETIME NULL,
  last_activated_by BIGINT UNSIGNED NULL,
  destination VARCHAR(32) NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'offline',
  created_at DATETIME NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS planet_buildings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  planet_id BIGINT UNSIGNED NOT NULL,
  building_type_id BIGINT UNSIGNED NOT NULL,
  level INT NOT NULL DEFAULT 0,
  production_bonus INT NOT NULL DEFAULT 0,
  UNIQUE KEY uq_planet_building (planet_id, building_type_id)
) ENGINE=InnoDB;

# Staged SQL Simulation

Temporary schema: stargate_expansion_sim_1787374774

## Result
SQL exit code: 0
Created table count: 7

## Simulated tables
construction_queue
fleet_missions
game_events
market_orders
planet_buildings
research_queue
stargates

## Existing-schema overlap

### game_events
Current columns:
id | bigint(20) unsigned | NO | NULL
player_id | int(10) unsigned | YES | NULL
event_type | varchar(80) | NO | NULL
entity_type | varchar(80) | YES | NULL
entity_id | bigint(20) unsigned | YES | NULL
payload | longtext | NO | NULL
created_at | timestamp | YES | current_timestamp()
Staged columns:
id | bigint(20) unsigned | NO | NULL
event_type | varchar(80) | NO | NULL
actor_id | bigint(20) unsigned | YES | NULL
payload_json | longtext | NO | NULL
execute_at | datetime | NO | NULL
processed_turn_id | bigint(20) unsigned | YES | NULL
created_at | datetime | NO | NULL

### construction_queue
Current columns:
id | bigint(20) unsigned | NO | NULL
player_id | int(10) unsigned | NO | NULL
colony_id | int(10) unsigned | YES | NULL
queue_type | enum('building','research','fleet','defense','ship','weapon_repair') | NO | NULL
item_key | varchar(80) | NO | NULL
quantity | int(10) unsigned | NO | 1
level_before | int(10) unsigned | NO | 0
starts_at | datetime | NO | NULL
completes_at | datetime | NO | NULL
status | enum('queued','processing','completed','cancelled') | NO | 'queued'
created_at | timestamp | NO | current_timestamp()
Staged columns:
id | bigint(20) unsigned | NO | NULL
planet_id | bigint(20) unsigned | NO | NULL
building_type_id | bigint(20) unsigned | NO | NULL
target_level | int(11) | NO | NULL
execute_at | datetime | NO | NULL
processed_turn_id | bigint(20) unsigned | YES | NULL
created_at | datetime | NO | NULL

research_queue: not present in live schema

### fleet_missions
Current columns:
id | bigint(20) unsigned | NO | NULL
player_id | int(10) unsigned | NO | NULL
source_colony_id | int(10) unsigned | NO | NULL
target_colony_id | int(10) unsigned | YES | NULL
distance_units | int(10) unsigned | NO | 1
fuel_cost | bigint(20) unsigned | NO | 0
hull_mass | decimal(14,3) | NO | 0.000
propulsion_modifier | decimal(8,4) | NO | 1.0000
calculated_speed | decimal(12,4) | NO | 0.0000
fuel_consumed | decimal(14,3) | NO | 0.000
alliance_operation_id | bigint(20) unsigned | YES | NULL
mission_seed | char(64) | YES | NULL
mission_type | enum('transport','attack','raid','espionage','colonize','recycle','explore','return') | NO | NULL
payload | longtext | NO | NULL
departure_at | datetime | NO | NULL
arrival_at | datetime | NO | NULL
return_at | datetime | YES | NULL
status | enum('scheduled','outbound','arrived','returning','completed','failed','cancelled') | NO | 'scheduled'
resolved_at | datetime | YES | NULL
created_at | timestamp | NO | current_timestamp()
Staged columns:
id | bigint(20) unsigned | NO | NULL
player_id | bigint(20) unsigned | NO | NULL
fleet_id | bigint(20) unsigned | NO | NULL
mission_type | varchar(40) | NO | NULL
destination | varchar(32) | NO | NULL
status | varchar(30) | NO | NULL
execute_at | datetime | NO | NULL
processed_turn_id | bigint(20) unsigned | YES | NULL
created_at | datetime | NO | NULL

### market_orders
Current columns:
id | bigint(20) unsigned | NO | NULL
seller_id | int(10) unsigned | NO | NULL
resource_type | varchar(40) | NO | NULL
weapon_type_id | int(10) unsigned | YES | NULL
quantity | int(10) unsigned | NO | NULL
unit_price | bigint(20) unsigned | NO | NULL
status | enum('open','filled','cancelled') | NO | 'open'
expires_at | datetime | YES | NULL
created_at | timestamp | YES | current_timestamp()
Staged columns:
id | bigint(20) unsigned | NO | NULL
player_id | bigint(20) unsigned | NO | NULL
resource | varchar(32) | NO | NULL
side | enum('buy','sell') | NO | NULL
quantity | bigint(20) unsigned | NO | NULL
unit_price | bigint(20) unsigned | NO | NULL
status | varchar(20) | NO | 'open'
created_at | datetime | NO | NULL

stargates: not present in live schema

planet_buildings: not present in live schema

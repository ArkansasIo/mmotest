<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'PageService',
    1 => 'SettlementConstructionService',
    2 => 'PowerGridService',
  ),
  'reads' => 
  array (
    0 => 'construction_queue',
    1 => 'settlement_construction_queues',
    2 => 'player_resources',
    3 => 'building_types',
    4 => 'settlement_fields',
    5 => 'settlement_buildings',
    6 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'settlement_construction_queues',
    1 => 'settlement_buildings',
    2 => 'player_resources',
  ),
  'actions' => 
  array (
    0 => 'inspect_page',
    1 => 'refresh_page',
  ),
  'permissions' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF',
    2 => 'RBAC',
    3 => 'ownership scope',
    4 => 'cooldown validation',
    5 => 'queue capacity validation',
    6 => 'prerequisite validation',
    7 => 'power-grid validation',
    8 => 'transaction rollback',
  ),
);

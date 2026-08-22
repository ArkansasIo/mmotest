<?php
declare(strict_types=1);
return array (
  'services' => array (0 => 'PageService', 1 => 'SettlementConstructionService', 2 => 'PowerGridService'),
  'reads' => array (0 => 'building_types', 1 => 'settlement_fields', 2 => 'settlement_buildings', 3 => 'settlement_construction_queues', 4 => 'construction_queue', 5 => 'player_resources', 6 => 'game_events'),
  'writes' => array (0 => 'settlement_construction_queues', 1 => 'settlement_buildings', 2 => 'player_resources'),
  'actions' => array (0 => 'inspect_page', 1 => 'refresh_page'),
  'permissions' => array (0 => 'authenticated commander', 1 => 'CSRF', 2 => 'RBAC', 3 => 'ownership scope', 4 => 'prerequisite validation', 5 => 'power-grid validation', 6 => 'queue capacity validation', 7 => 'transaction rollback'),
);

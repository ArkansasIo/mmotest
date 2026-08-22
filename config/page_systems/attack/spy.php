<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'PageService',
  ),
  'reads' => 
  array (
    0 => 'target_realms',
    1 => 'players',
    2 => 'player_resources',
    3 => 'protection_states',
    4 => 'battles',
    5 => 'battle_reports',
    6 => 'covert_missions',
    7 => 'intelligence_reports',
    8 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'target_realms',
    1 => 'players',
    2 => 'player_resources',
    3 => 'protection_states',
    4 => 'battles',
    5 => 'battle_reports',
    6 => 'covert_missions',
    7 => 'intelligence_reports',
    8 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'combat',
    1 => 'covert:recon',
    2 => 'covert:spy',
    3 => 'covert:sabotage',
    4 => 'refresh_page',
  ),
  'permissions' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF',
    2 => 'RBAC',
    3 => 'ownership scope',
    4 => 'cooldown validation',
  ),
);

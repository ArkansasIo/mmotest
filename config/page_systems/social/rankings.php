<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'PageService',
    1 => 'RankingsService',
  ),
  'reads' => 
  array (
    0 => 'players',
    1 => 'rankings',
    2 => 'rank_snapshots',
    3 => 'glory_reputation',
    4 => 'player_resources',
    5 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'rankings',
    1 => 'rank_snapshots',
    2 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'inspect_page',
    1 => 'refresh_rankings',
  ),
  'permissions' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF',
    2 => 'RBAC',
    3 => 'ownership scope',
    4 => 'cooldown validation',
    5 => 'filter and sort allowlist',
    6 => 'public profile field allowlist',
    7 => 'transaction rollback',
  ),
);

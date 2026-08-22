<?php
declare(strict_types=1);
return array (
  'route' => 'rankings',
  'group' => 'social',
  'group_label' => 'Social',
  'title' => 'Rankings',
  'layout' => 'rankings',
  'purpose' => 'Rankings subsystem console with server-authoritative state, controls, dependencies, and feedback.',
  'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
  'controls' => 
  array (
    0 => 'open overview',
    1 => 'filter operational state',
    2 => 'review season movement',
    3 => 'open public commander profile',
  ),
  'actions' => 
  array (
    0 => 'inspect_page',
    1 => 'refresh_rankings',
  ),
  'tables' => 
  array (
    0 => 'players',
    1 => 'rankings',
    2 => 'rank_snapshots',
    3 => 'glory_reputation',
    4 => 'player_resources',
    5 => 'game_events',
  ),
  'details' => 
  array (
    'current state' => 'server-calculated telemetry',
    'available controls' => 'permission-aware operations',
    'dependencies' => 'validated prerequisites and cooldowns',
    'audit' => 'transactional event history',
  ),
  'logic' => 
  array (
    'purpose' => 'Server-authoritative commander rankings console',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'workflow' => 
    array (
      0 => 'load authenticated commander and public ranking scope',
      1 => 'validate filter, sort, page size, and requested target',
      2 => 'calculate weighted score from canonical player dimensions',
      3 => 'lock ranking rows and snapshot date for refresh mutations',
      4 => 'persist rank positions and snapshot atomically',
      5 => 'return public rows without private commander fields',
      6 => 'return standardized feedback state',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF token for refresh mutations',
      2 => 'RBAC ranking policy',
      3 => 'public profile and row ownership scope',
      4 => 'validated filter and sort allowlists',
      5 => 'refresh cooldown validation',
      6 => 'transaction boundary with rollback',
    ),
    'calculations' => 
    array (
      0 => 'ranking score = economy + military + technology + glory − penalties',
      1 => 'rank position = deterministic descending score with stable player-id tie break',
      2 => 'season movement = current position compared with the persisted snapshot',
      3 => 'public ranking row = approved score fields only; private account fields excluded',
    ),
      'mutations' => 
      array (
        0 => 'refresh_rankings',
      ),
  ),
  'features' => 
  array (
    0 => 'commander ladder',
    1 => 'summary metrics',
    2 => 'military, economy, technology, glory, and penalty scores',
    3 => 'season movement indicators',
    4 => 'status badges',
    5 => 'related-page navigation',
    6 => 'empty-state guidance',
  ),
  'sub_features' => 
  array (
    0 => 'loading and refresh state',
    1 => 'permission-aware controls',
    2 => 'score-dimension filtering',
    3 => 'deterministic score sorting',
    4 => 'public commander profile preview',
    5 => 'season movement comparison',
    6 => 'related-page navigation',
    7 => 'empty-state explanation',
    8 => 'audit and feedback detail',
  ),
  'design' => 
  array (
    'template' => 'specification-dashboard',
    'sections' => 
    array (
      0 => 'overview',
      1 => 'controls',
      2 => 'features',
      3 => 'system-design',
      4 => 'information',
      5 => 'feedback-states',
    ),
    'components' => 
    array (
      0 => 'metric-strip',
      1 => 'operation-controls',
      2 => 'status-badge',
      3 => 'data-table',
      4 => 'feedback-panel',
    ),
    'responsive' => 'horizontal dashboard with stacked mobile layout',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'PageService',
      1 => 'RankingsService',
    ),
    'reads' => 
    array (
      0 => 'players',
      1 => 'player_resources',
      2 => 'game_events',
    ),
    'writes' => 
    array (
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
  ),
  'feedback_states' => 
  array (
    0 => 'loading',
    1 => 'ready',
    2 => 'empty',
    3 => 'protected',
    4 => 'cooldown',
    5 => 'insufficient-resource',
    6 => 'success',
    7 => 'error',
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/social/rankings.php',
    'features' => 'config/page_features/social/rankings.php',
    'design' => 'config/page_design_specs/social/rankings.php',
    'systems' => 'config/page_systems/social/rankings.php',
    'module' => 'includes/page_modules/social/rankings.php',
  ),
);

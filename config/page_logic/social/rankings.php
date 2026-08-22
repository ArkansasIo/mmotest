<?php
declare(strict_types=1);
return array (
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
);

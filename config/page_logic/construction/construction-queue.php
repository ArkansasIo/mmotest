<?php
declare(strict_types=1);
return array (
  'purpose' => 'Construction Queue construction console',
  'mechanic' => 'queue state = validated work item + completion time + ownership + resource lock',
  'workflow' => array (
    0 => 'load authenticated commander and owned settlement scope',
    1 => 'inspect catalogue, queue, prerequisites, and current state',
    2 => 'validate target, placement, capacity, power, and resources',
    3 => 'lock scoped records and commit mutations transactionally',
    4 => 'process due work and write audit event',
    5 => 'return standardized feedback state',
  ),
  'validation' => array (
    0 => 'authenticated commander', 1 => 'CSRF token', 2 => 'RBAC policy',
    3 => 'ownership scope', 4 => 'prerequisite validation', 5 => 'resource validation',
    6 => 'power and queue capacity', 7 => 'cooldown validation', 8 => 'transaction rollback',
  ),
  'calculations' => array (
    0 => 'queue state = validated work item + completion time + ownership + resource lock',
    1 => 'server-authoritative completion time and cost',
    2 => 'power balance and brownout protection',
  ),
  'mutations' => array (0 => 'queue_building', 1 => 'process_construction_due'),
);

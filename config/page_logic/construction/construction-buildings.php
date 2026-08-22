<?php
declare(strict_types=1);
return array (
  'purpose' => 'Server-authoritative building construction console',
  'mechanic' => 'construction state = validated design + prerequisites + resources + queue capacity',
  'workflow' => 
  array (
    0 => 'load authenticated commander and owned settlement scope',
    1 => 'inspect active building catalogue and field availability',
    2 => 'validate design, placement, prerequisites, power draw, and queue capacity',
    3 => 'lock colony, fields, queue, and resource records for mutations',
    4 => 'deduct resources and enqueue construction atomically',
    5 => 'process due work and persist completion audit events',
    6 => 'return scoped feedback state and refreshed view model',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF token for mutations',
    2 => 'RBAC construction policy',
    3 => 'owned colony and field scope',
    4 => 'building catalogue availability',
    5 => 'technology and building prerequisites',
    6 => 'power-grid capacity and brownout rules',
    7 => 'queue capacity and cooldown validation',
    8 => 'transaction boundary with rollback',
  ),
  'calculations' => 
  array (
    0 => 'construction state = validated design + prerequisites + resources + queue capacity',
    1 => 'build time = base time × level progression × technology modifier',
    2 => 'power balance = generated output − active consumption − queued draw',
    3 => 'placement validity = location type + field kind + field size + placement rule',
  ),
  'mutations' => 
  array (
    0 => 'queue_building',
    1 => 'process_construction_due',
  ),
);

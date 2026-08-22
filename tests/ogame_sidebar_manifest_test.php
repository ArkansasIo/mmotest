<?php
declare(strict_types=1);
$manifest = require __DIR__ . '/../config/navigation/ogame_sidebar_manifest.php';
$registry = require __DIR__ . '/../config/page_registry.php';
$expected = [];
foreach ($registry as $group => $definition) foreach (($definition['pages'] ?? []) as $page => $_) $expected[$group . '/' . $page] = true;
$actual = [];
$failures = [];
$labels = array_column($manifest['sections'] ?? [], 'label');
$wanted = ['Overview','Resources','Facilities','Research','Shipyard','Fleet','Galaxy','Alliance','Community','Progression'];
if ($labels !== $wanted) $failures[] = 'OGame-style section order is incorrect';
foreach (($manifest['sections'] ?? []) as $section) {
    foreach (($section['groups'] ?? []) as $group) {
        foreach (($group['pages'] ?? []) as $page) {
            $route = (string)($page['route'] ?? '');
            if (isset($actual[$route])) $failures[] = "duplicate route {$route}";
            $actual[$route] = true;
            if (!isset($expected[$route])) $failures[] = "unregistered route {$route}";
            if (($page['href'] ?? '') !== 'javascript:void(0)') $failures[] = "invalid SPA href {$route}";
            if (!str_contains((string)($page['intent'] ?? ''), "sendData('pages','get'")) $failures[] = "missing intent {$route}";
        }
    }
}
foreach (array_keys($expected) as $route) if (!isset($actual[$route])) $failures[] = "missing route {$route}";
$commands = array_column($manifest['commands'] ?? [], 'key');
if ($commands !== ['settings','logout']) $failures[] = 'settings and logout commands are missing or out of order';
if ($failures) { foreach ($failures as $failure) echo "FAIL: {$failure}\n"; exit(1); }
echo 'PASS: OGame-style sidebar sections ordered\n';
echo 'PASS: ' . count($actual) . " canonical page and submenu routes\n";
echo "PASS: Settings and Logout commands registered\n";
echo "All OGame-style sidebar manifest checks passed.\n";

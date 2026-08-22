<?php
declare(strict_types=1);

$manifest = require __DIR__ . '/../config/navigation/sidebar_manifest.php';
$registry = require __DIR__ . '/../config/page_registry.php';
$expected = [];
foreach ($registry as $group => $definition) {
    foreach (($definition['pages'] ?? []) as $page => $_) {
        $expected[$group . '/' . $page] = true;
    }
}
$actual = [];
$failures = [];
$sections = $manifest['sections'] ?? [];
if (count($sections) !== 7) {
    $failures[] = 'expected 7 ordered sidebar sections';
}
foreach ($sections as $section) {
    foreach (($section['groups'] ?? []) as $group) {
        foreach (($group['pages'] ?? []) as $page) {
            $route = (string)($page['route'] ?? '');
            if ($route === '') { $failures[] = 'empty route in manifest'; continue; }
            if (isset($actual[$route])) { $failures[] = "duplicate route {$route}"; }
            $actual[$route] = true;
            if (!isset($expected[$route])) { $failures[] = "unregistered route {$route}"; }
            if (($page['href'] ?? '') !== 'javascript:void(0)') { $failures[] = "invalid href for {$route}"; }
            if (!str_contains((string)($page['intent'] ?? ''), "sendData('pages','get'")) { $failures[] = "missing SPA intent for {$route}"; }
        }
    }
}
foreach (array_keys($expected) as $route) {
    if (!isset($actual[$route])) { $failures[] = "missing manifest route {$route}"; }
}
if ($failures) {
    foreach ($failures as $failure) { echo "FAIL: {$failure}\n"; }
    exit(1);
}
echo 'PASS: 7 sidebar sections\n';
echo 'PASS: ' . count($actual) . ' canonical menu and submenu page links\n';
echo "All sidebar manifest integrity checks passed.\n";

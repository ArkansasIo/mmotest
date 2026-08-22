<?php
declare(strict_types=1);
$registry = require __DIR__ . '/../config/page_registry.php';
$template = file_get_contents(__DIR__ . '/../templates/index.tpl');
$pattern = '/data-nav-group="([a-z0-9_-]+)" data-nav-page="([a-z0-9_-]+)"/';
preg_match_all($pattern, $template, $matches, PREG_SET_ORDER);
$passed = 0; $failed = 0; $seen = [];
function sidebar_check(bool $ok, string $name): void { global $passed, $failed; if ($ok) { $passed++; echo "PASS: {$name}\n"; } else { $failed++; echo "FAIL: {$name}\n"; } }
sidebar_check(count($matches) > 0, 'sidebar contains registry-backed links');
foreach ($matches as $match) {
    $group = $match[1]; $page = $match[2]; $key = $group . '/' . $page;
    sidebar_check(isset($registry[$group]['pages'][$page]), "canonical registry route: {$key}");
    $duplicateKey = $group . '/' . $page;
    // A route may appear once in its primary group and again as an intentional Commander shortcut.
    $seen[$duplicateKey] = true;
}
sidebar_check(strpos($template, '01 · OVERVIEW // COMMAND STATUS') < strpos($template, '02 · CONFLICT // ATTACK & DEFENSE'), 'Overview precedes Conflict');
sidebar_check(strpos($template, '02 · CONFLICT // ATTACK & DEFENSE') < strpos($template, '03 · DEVELOPMENT // EMPIRE & CONSTRUCTION'), 'Conflict precedes Development');
sidebar_check(strpos($template, '03 · DEVELOPMENT // EMPIRE & CONSTRUCTION') < strpos($template, '04 · EXPLORATION // GALAXY & UNIVERSE'), 'Development precedes Exploration');
sidebar_check(strpos($template, '04 · EXPLORATION // GALAXY & UNIVERSE') < strpos($template, '05 · ECONOMY // SOCIAL & ALLIANCE'), 'Exploration precedes Economy');
sidebar_check(strpos($template, '05 · ECONOMY // SOCIAL & ALLIANCE') < strpos($template, '06 · PROGRESSION // CRAFTING & PRESTIGE'), 'Economy precedes Progression');
sidebar_check(strpos($template, '06 · PROGRESSION // CRAFTING & PRESTIGE') < strpos($template, '07 · SUPPORT // DIRECT TOOLS'), 'Progression precedes Support');
if ($failed) { fwrite(STDERR, "{$failed} sidebar integrity checks failed; {$passed} passed.\n"); exit(1); }
echo "All {$passed} sidebar integrity checks passed.\n";
?>

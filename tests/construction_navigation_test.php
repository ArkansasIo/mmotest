<?php
declare(strict_types=1);
$template = file_get_contents(__DIR__ . '/../templates/index.tpl');
$pages = file_get_contents(__DIR__ . '/../modules/pages.php');
$routes = ['construction-buildings','construction-facilities','construction-queue','shipyard','defense','robotics','nanite-factory','terraformer','space-dock'];
$passed = 0; $failed = 0;
function construction_nav_check(bool $ok, string $name): void { global $passed, $failed; if ($ok) { $passed++; echo "PASS: {$name}\n"; } else { $failed++; echo "FAIL: {$name}\n"; } }
construction_nav_check(strpos($template, '03 · DEVELOPMENT // EMPIRE & CONSTRUCTION') !== false, 'construction section exists');
construction_nav_check(strpos($template, 'Construction Subsystems') !== false, 'construction submenu exists');
construction_nav_check(strpos($pages, "'construction' => 'Construction Directorate'") !== false, 'construction main domain registered');
construction_nav_check(strpos($pages, "'construction' => 'construction-buildings'") !== false, 'construction default route registered');
foreach ($routes as $route) construction_nav_check(strpos($template, "'construction','{$route}'") !== false && (is_file(__DIR__ . "/../pages/{$route}.php") || is_file(__DIR__ . "/../pages/construction/subpages/{$route}.php")), "route and wrapper: {$route}");
if ($failed > 0) { fwrite(STDERR, "{$failed} construction navigation checks failed; {$passed} passed.\n"); exit(1); }
echo "All {$passed} construction navigation checks passed.\n";

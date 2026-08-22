<?php
declare(strict_types=1);
$template = file_get_contents(__DIR__ . '/../templates/index.tpl');
$pages = file_get_contents(__DIR__ . '/../modules/pages.php');
$passed = 0; $failed = 0;
function overview_nav_check(bool $ok, string $name): void { global $passed, $failed; if ($ok) { $passed++; echo "PASS: {$name}\n"; } else { $failed++; echo "FAIL: {$name}\n"; } }
overview_nav_check(strpos($template, 'OVERVIEW // COMMAND STATUS') !== false, 'overview section is present');
overview_nav_check(strpos($template, '<span>Commander</span>') !== false, 'commander submenu is present');
overview_nav_check(strpos($pages, "'overview' => 'Overview Command'") !== false, 'overview domain is registered');
overview_nav_check(strpos($pages, "'overview-dashboard' => 'Dashboard'") !== false, 'dashboard subroute is registered');
$routes = ['overview-dashboard','empire-overview','active-operations','alerts','tutorial-objectives'];
foreach ($routes as $route) overview_nav_check(strpos($template, "'overview','{$route}'") !== false && (is_file(__DIR__ . "/../pages/{$route}.php") || is_file(__DIR__ . "/../pages/overview/subpages/{$route}.php")), "overview route and wrapper: {$route}");
$commanderRoutes = ['account','race','vacation','ascension'];
foreach ($commanderRoutes as $route) {
    $routePresent = $route === 'account'
        ? strpos($template, "'command-center','account-info'") !== false
        : strpos($template, "'account','{$route}'") !== false;
    $wrapperPresent = $route === 'account' || is_file(__DIR__ . "/../pages/{$route}.php") || is_file(__DIR__ . "/../pages/account/subpages/{$route}.php");
    overview_nav_check($routePresent && $wrapperPresent, "commander route: {$route}");
}
if ($failed > 0) { fwrite(STDERR, "{$failed} Overview navigation checks failed; {$passed} passed.\n"); exit(1); }
echo "All {$passed} Overview navigation checks passed.\n";

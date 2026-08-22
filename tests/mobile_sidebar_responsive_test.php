<?php
declare(strict_types=1);
$template = file_get_contents(__DIR__ . '/../templates/index.tpl');
$css = file_get_contents(__DIR__ . '/../main.css');
$passed = 0; $failed = 0;
function mobile_nav_check(bool $ok, string $name): void { global $passed, $failed; if ($ok) { $passed++; echo "PASS: {$name}\n"; } else { $failed++; echo "FAIL: {$name}\n"; } }
mobile_nav_check(substr_count($template, '<details') > 20, 'grouped and nested disclosure menus are present');
mobile_nav_check(substr_count($template, '<summary') > 20, 'all disclosure groups have summaries');
mobile_nav_check(strpos($css, '@media (max-width: 900px)') !== false, 'tablet breakpoint exists');
mobile_nav_check(strpos($css, '@media (max-width: 700px)') !== false, 'mobile breakpoint exists');
mobile_nav_check(strpos($css, '.main-layout {') !== false && strpos($css, 'flex-direction: column;') !== false, 'mobile layout collapses into a column');
mobile_nav_check(strpos($css, 'max-height: 360px') !== false, 'tablet sidebar height is bounded');
mobile_nav_check(strpos($css, 'min-height:44px') !== false, 'mobile controls use 44px touch targets');
mobile_nav_check(strpos($css, 'touch-action:manipulation') !== false, 'mobile controls use touch-action manipulation');
mobile_nav_check(strpos($css, '.left-menu{width:100%;max-width:none') !== false, 'mobile sidebar expands to full width');
mobile_nav_check(strpos($css, '.left-menu details details') !== false, 'nested submenu styling exists');
if ($failed) { fwrite(STDERR, "{$failed} mobile sidebar checks failed; {$passed} passed.\n"); exit(1); }
echo "All {$passed} mobile sidebar checks passed.\n";
?>

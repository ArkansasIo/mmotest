<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$paths = is_file($root . '/config/menu_page_paths.php') ? require $root . '/config/menu_page_paths.php' : [];
$lines = ['# Navigation Sitemap', '', '| Menu | Page | Route | Named submenu PHP | Layout | Actions | Tables | Feedback states |', '|---|---|---|---|---|---|---|---|'];
$count = 0;
foreach ($registry as $group => $block) {
    foreach (($block['pages'] ?? []) as $route => $page) {
        $count++;
        $path = $paths[$route] ?? [];
        $actions = implode(', ', $page['actions'] ?? []);
        $tables = implode(', ', $page['tables'] ?? []);
        $feedback = 'ready, empty, protected, cooldown, insufficient-resource, success, error';
        $lines[] = sprintf('| %s | %s | `%s` | `%s` | `%s` | %s | %s | %s |', $block['label'] ?? $group, $page['title'] ?? $route, $route, $path['submenu'] ?? '', $page['layout'] ?? 'dashboard', $actions ?: 'read-only', $tables ?: 'game_events', $feedback);
    }
}
$lines[] = '';
$lines[] = "**Routes documented:** $count";
file_put_contents($root . '/docs/navigation_sitemap.md', implode(PHP_EOL, $lines) . PHP_EOL);
echo "Generated navigation sitemap for $count routes\n";

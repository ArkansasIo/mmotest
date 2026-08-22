<?php
declare(strict_types=1);

/**
 * OGame-style left-sidebar organization for Universe Civilization: Empire at Wars.
 * Route pages are sourced from the canonical registry; Settings and Logout are
 * command links because they are not page-registry routes.
 */
$registry = require __DIR__ . '/../page_registry.php';

$layout = [
    ['key' => 'overview', 'label' => 'Overview', 'groups' => ['overview', 'command-center', 'account']],
    ['key' => 'resources', 'label' => 'Resources', 'groups' => ['resources', 'economy']],
    ['key' => 'facilities', 'label' => 'Facilities', 'groups' => ['empire', 'construction', 'planets']],
    ['key' => 'research', 'label' => 'Research', 'groups' => ['research', 'technology']],
    ['key' => 'shipyard', 'label' => 'Shipyard', 'groups' => ['mothership', 'armory', 'training']],
    ['key' => 'fleet', 'label' => 'Fleet', 'groups' => ['fleet', 'military', 'attack']],
    ['key' => 'galaxy', 'label' => 'Galaxy', 'groups' => ['universe', 'galaxy', 'intelligence']],
    ['key' => 'alliance', 'label' => 'Alliance', 'groups' => ['alliance', 'social']],
    ['key' => 'community', 'label' => 'Community', 'groups' => ['market', 'activities', 'rankings']],
    ['key' => 'progression', 'label' => 'Progression', 'groups' => ['crafting', 'lifeforms', 'prestige', 'premium']],
];

$label = static fn(string $key): string => ucwords(str_replace(['-', '_'], ' ', $key));
$tree = [];
$covered = [];
foreach ($layout as $section) {
    $entry = ['key' => $section['key'], 'label' => $section['label'], 'groups' => []];
    foreach ($section['groups'] as $group) {
        if (!isset($registry[$group])) continue;
        $pages = [];
        foreach (($registry[$group]['pages'] ?? []) as $pageKey => $page) {
            $route = $group . '/' . $pageKey;
            $covered[$route] = true;
            $pages[] = [
                'key' => $pageKey,
                'label' => $page['title'] ?? $label($pageKey),
                'route' => $route,
                'group' => $group,
                'page' => $pageKey,
                'href' => 'javascript:void(0)',
                'intent' => "sendData('pages','get'," . var_export($group, true) . ',' . var_export($pageKey, true) . ')',
            ];
        }
        $entry['groups'][] = [
            'key' => $group,
            'label' => $label($group),
            'submenu_label' => $label($group) . ' Submenu',
            'pages' => $pages,
        ];
    }
    $tree[] = $entry;
}

return [
    'version' => '1.0.0-ogame-layout',
    'style' => 'ogame-left-sidebar',
    'sections' => $tree,
    'commands' => [
        ['key' => 'settings', 'label' => 'Settings', 'href' => 'config/settings.php', 'type' => 'external'],
        ['key' => 'logout', 'label' => 'Logout', 'href' => 'logout.php', 'type' => 'external'],
    ],
    'covered_routes' => array_keys($covered),
];

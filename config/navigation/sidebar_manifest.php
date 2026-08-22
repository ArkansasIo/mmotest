<?php
declare(strict_types=1);

/**
 * Canonical left-sidebar navigation manifest.
 *
 * The page registry remains authoritative for route existence and page metadata.
 * This file adds stable display grouping and link metadata for the sidebar,
 * including nested submenu groups and canonical SPA intents.
 */

$registry = require __DIR__ . '/../page_registry.php';

$sectionMap = [
    'Overview' => ['overview'],
    'Conflict' => ['attack', 'armory', 'training', 'technology', 'intelligence', 'fleet', 'military'],
    'Development' => ['command-center', 'account', 'empire', 'resources', 'construction', 'research', 'planets', 'mothership'],
    'Exploration' => ['universe', 'galaxy'],
    'Economy' => ['market', 'economy', 'social', 'alliance'],
    'Progression' => ['crafting', 'lifeforms', 'activities', 'prestige', 'rankings', 'premium'],
    'Support' => [],
];

$icons = [
    'Overview' => 'core-command.svg',
    'Conflict' => 'core-command.svg',
    'Development' => 'core-command.svg',
    'Exploration' => 'core-command.svg',
    'Economy' => 'core-command.svg',
    'Progression' => 'core-command.svg',
    'Support' => 'core-command.svg',
];

$label = static function (string $key): string {
    $key = preg_replace('/^construction-/', '', $key);
    $key = preg_replace('/^research-/', '', $key);
    $key = preg_replace('/^intelligence-/', '', $key);
    $key = preg_replace('/^technology-/', '', $key);
    return ucwords(str_replace(['-', '_'], ' ', $key));
};

$manifest = [];
foreach ($sectionMap as $section => $groups) {
    $sectionEntry = [
        'key' => strtolower(str_replace(' ', '-', $section)),
        'label' => $section,
        'icon' => 'images/ui/' . ($icons[$section] ?? 'core-command.svg'),
        'groups' => [],
    ];

    foreach ($groups as $group) {
        if (!isset($registry[$group])) {
            continue;
        }
        $pages = [];
        foreach (($registry[$group]['pages'] ?? []) as $pageKey => $page) {
            $pages[] = [
                'key' => $pageKey,
                'label' => $page['title'] ?? $label($pageKey),
                'group' => $group,
                'page' => $pageKey,
                'href' => 'javascript:void(0)',
                'intent' => "sendData('pages','get'," . var_export($group, true) . ',' . var_export($pageKey, true) . ')',
                'route' => $group . '/' . $pageKey,
                'subgroup' => $group . ' Subsystems',
            ];
        }
        if ($pages === []) {
            continue;
        }
        $sectionEntry['groups'][] = [
            'key' => $group,
            'label' => ucfirst(str_replace('-', ' ', $group)),
            'subgroup_label' => ucfirst(str_replace('-', ' ', $group)) . ' Subsystems',
            'pages' => $pages,
        ];
    }
    $manifest[] = $sectionEntry;
}

return [
    'version' => '1.0.0',
    'source' => 'config/page_registry.php',
    'sections' => $manifest,
];

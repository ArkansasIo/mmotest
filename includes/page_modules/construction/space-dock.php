<?php
declare(strict_types=1);
function stargatewars_construction_space_dock_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/space-dock.php'; }
function stargatewars_construction_space_dock_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/space-dock.php'; }
function stargatewars_construction_space_dock_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/space-dock.php'; }
function stargatewars_construction_space_dock_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/space-dock.php'; }
function stargatewars_construction_space_dock_actions(): array { return stargatewars_construction_space_dock_systems()['actions'] ?? []; }
function stargatewars_construction_space_dock_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_space_dock_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_space_dock_preview(array $context = []): array {
    return ['route' => 'space-dock', 'title' => 'Space Dock', 'logic' => stargatewars_construction_space_dock_logic(), 'features' => stargatewars_construction_space_dock_features(), 'design' => stargatewars_construction_space_dock_design(), 'systems' => stargatewars_construction_space_dock_systems(), 'context' => $context];
}

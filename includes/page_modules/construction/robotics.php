<?php
declare(strict_types=1);
function stargatewars_construction_robotics_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/robotics.php'; }
function stargatewars_construction_robotics_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/robotics.php'; }
function stargatewars_construction_robotics_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/robotics.php'; }
function stargatewars_construction_robotics_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/robotics.php'; }
function stargatewars_construction_robotics_actions(): array { return stargatewars_construction_robotics_systems()['actions'] ?? []; }
function stargatewars_construction_robotics_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_robotics_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_robotics_preview(array $context = []): array {
    return ['route' => 'robotics', 'title' => 'Robotics', 'logic' => stargatewars_construction_robotics_logic(), 'features' => stargatewars_construction_robotics_features(), 'design' => stargatewars_construction_robotics_design(), 'systems' => stargatewars_construction_robotics_systems(), 'context' => $context];
}

<?php
declare(strict_types=1);
function stargatewars_construction_defense_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/defense.php'; }
function stargatewars_construction_defense_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/defense.php'; }
function stargatewars_construction_defense_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/defense.php'; }
function stargatewars_construction_defense_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/defense.php'; }
function stargatewars_construction_defense_actions(): array { return stargatewars_construction_defense_systems()['actions'] ?? []; }
function stargatewars_construction_defense_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_defense_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_defense_preview(array $context = []): array {
    return ['route' => 'defense', 'title' => 'Defense', 'logic' => stargatewars_construction_defense_logic(), 'features' => stargatewars_construction_defense_features(), 'design' => stargatewars_construction_defense_design(), 'systems' => stargatewars_construction_defense_systems(), 'context' => $context];
}

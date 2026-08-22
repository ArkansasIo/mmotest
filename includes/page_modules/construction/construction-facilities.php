<?php
declare(strict_types=1);
function stargatewars_construction_construction_facilities_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/construction-facilities.php'; }
function stargatewars_construction_construction_facilities_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/construction-facilities.php'; }
function stargatewars_construction_construction_facilities_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/construction-facilities.php'; }
function stargatewars_construction_construction_facilities_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/construction-facilities.php'; }
function stargatewars_construction_construction_facilities_actions(): array { return stargatewars_construction_construction_facilities_systems()['actions'] ?? []; }
function stargatewars_construction_construction_facilities_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_construction_facilities_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_construction_facilities_preview(array $context = []): array {
    return ['route' => 'construction-facilities', 'title' => 'Facilities', 'logic' => stargatewars_construction_construction_facilities_logic(), 'features' => stargatewars_construction_construction_facilities_features(), 'design' => stargatewars_construction_construction_facilities_design(), 'systems' => stargatewars_construction_construction_facilities_systems(), 'context' => $context];
}

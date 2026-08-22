<?php
declare(strict_types=1);
function stargatewars_construction_shipyard_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/shipyard.php'; }
function stargatewars_construction_shipyard_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/shipyard.php'; }
function stargatewars_construction_shipyard_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/shipyard.php'; }
function stargatewars_construction_shipyard_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/shipyard.php'; }
function stargatewars_construction_shipyard_actions(): array { return stargatewars_construction_shipyard_systems()['actions'] ?? []; }
function stargatewars_construction_shipyard_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_shipyard_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_shipyard_preview(array $context = []): array {
    return ['route' => 'shipyard', 'title' => 'Shipyard', 'logic' => stargatewars_construction_shipyard_logic(), 'features' => stargatewars_construction_shipyard_features(), 'design' => stargatewars_construction_shipyard_design(), 'systems' => stargatewars_construction_shipyard_systems(), 'context' => $context];
}

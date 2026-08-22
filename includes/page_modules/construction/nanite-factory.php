<?php
declare(strict_types=1);
function stargatewars_construction_nanite_factory_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/nanite-factory.php'; }
function stargatewars_construction_nanite_factory_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/nanite-factory.php'; }
function stargatewars_construction_nanite_factory_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/nanite-factory.php'; }
function stargatewars_construction_nanite_factory_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/nanite-factory.php'; }
function stargatewars_construction_nanite_factory_actions(): array { return stargatewars_construction_nanite_factory_systems()['actions'] ?? []; }
function stargatewars_construction_nanite_factory_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_nanite_factory_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_nanite_factory_preview(array $context = []): array {
    return ['route' => 'nanite-factory', 'title' => 'Nanite Factory', 'logic' => stargatewars_construction_nanite_factory_logic(), 'features' => stargatewars_construction_nanite_factory_features(), 'design' => stargatewars_construction_nanite_factory_design(), 'systems' => stargatewars_construction_nanite_factory_systems(), 'context' => $context];
}

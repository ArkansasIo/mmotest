<?php
declare(strict_types=1);
function stargatewars_construction_terraformer_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/terraformer.php'; }
function stargatewars_construction_terraformer_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/terraformer.php'; }
function stargatewars_construction_terraformer_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/terraformer.php'; }
function stargatewars_construction_terraformer_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/terraformer.php'; }
function stargatewars_construction_terraformer_actions(): array { return stargatewars_construction_terraformer_systems()['actions'] ?? []; }
function stargatewars_construction_terraformer_validate_intent(array $input): array {
    $action = (string)($input['action'] ?? '');
    $errors = [];
    if ($action === '' || !in_array($action, stargatewars_construction_terraformer_actions(), true)) $errors['action'] = 'Action is not permitted for this page.';
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_terraformer_preview(array $context = []): array {
    return ['route' => 'terraformer', 'title' => 'Terraformer', 'logic' => stargatewars_construction_terraformer_logic(), 'features' => stargatewars_construction_terraformer_features(), 'design' => stargatewars_construction_terraformer_design(), 'systems' => stargatewars_construction_terraformer_systems(), 'context' => $context];
}

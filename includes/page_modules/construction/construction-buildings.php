<?php
declare(strict_types=1);

function stargatewars_construction_construction_buildings_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/construction/construction-buildings.php'; }
function stargatewars_construction_construction_buildings_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/construction/construction-buildings.php'; }
function stargatewars_construction_construction_buildings_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/construction/construction-buildings.php'; }
function stargatewars_construction_construction_buildings_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/construction/construction-buildings.php'; }
function stargatewars_construction_construction_buildings_actions(): array { return stargatewars_construction_construction_buildings_systems()['actions'] ?? []; }
function stargatewars_construction_construction_buildings_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    if ($action === '' || !in_array($action, stargatewars_construction_construction_buildings_actions(), true)) {
        $errors['action'] = 'Action is not permitted for this page.';
    }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action];
}
function stargatewars_construction_construction_buildings_state(PDO $pdo, int $playerId, int $colonyId): array {
    if ($playerId < 1 || $colonyId < 1) throw new InvalidArgumentException('A valid commander and colony are required.');
    require_once '/home/ubuntu/stargatewars/includes/services/SettlementConstructionService.php';
    return (new SettlementConstructionService($pdo))->state($playerId, $colonyId);
}
function stargatewars_construction_construction_buildings_preview(array $context = []): array {
    return ['route' => 'construction-buildings', 'title' => 'Buildings', 'logic' => stargatewars_construction_construction_buildings_logic(), 'features' => stargatewars_construction_construction_buildings_features(), 'design' => stargatewars_construction_construction_buildings_design(), 'systems' => stargatewars_construction_construction_buildings_systems(), 'context' => $context];
}

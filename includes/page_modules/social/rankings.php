<?php
declare(strict_types=1);

function stargatewars_social_rankings_logic(): array { return require '/home/ubuntu/stargatewars/config/page_logic/social/rankings.php'; }
function stargatewars_social_rankings_features(): array { return require '/home/ubuntu/stargatewars/config/page_features/social/rankings.php'; }
function stargatewars_social_rankings_design(): array { return require '/home/ubuntu/stargatewars/config/page_design_specs/social/rankings.php'; }
function stargatewars_social_rankings_systems(): array { return require '/home/ubuntu/stargatewars/config/page_systems/social/rankings.php'; }
function stargatewars_social_rankings_actions(): array { return stargatewars_social_rankings_systems()['actions'] ?? []; }
function stargatewars_social_rankings_validate_intent(array $input): array {
    $errors = [];
    $action = (string)($input['action'] ?? '');
    $allowedActions = stargatewars_social_rankings_actions();
    if ($action === '' || !in_array($action, $allowedActions, true)) { $errors['action'] = 'Action is not permitted for this page.'; }
    $allowedFilters = ['overall','military','economy','technology','glory','penalties'];
    $filter = (string)($input['filter'] ?? 'overall');
    if (!in_array($filter, $allowedFilters, true)) { $errors['filter'] = 'Ranking filter is not permitted.'; }
    $allowedSorts = ['rank','score','military','economy','technology','glory'];
    $sort = (string)($input['sort'] ?? 'rank');
    if (!in_array($sort, $allowedSorts, true)) { $errors['sort'] = 'Ranking sort is not permitted.'; }
    $limit = (int)($input['limit'] ?? 50);
    if ($limit < 1 || $limit > 200) { $errors['limit'] = 'Ranking limit must be between 1 and 200.'; }
    if ($action === 'open_player' && (int)($input['target_id'] ?? 0) <= 0) { $errors['target_id'] = 'A valid public commander is required.'; }
    return ['valid' => $errors === [], 'errors' => $errors, 'action' => $action, 'filter' => $filter, 'sort' => $sort, 'limit' => $limit];
}
function stargatewars_social_rankings_preview(array $context = []): array {
    $state = (string)($context['state'] ?? 'ready');
    $allowedStates = ['loading','ready','empty','protected','cooldown','insufficient-resource','success','error'];
    if (!in_array($state, $allowedStates, true)) { $state = 'error'; }
    return ['route' => 'rankings', 'title' => 'Rankings', 'mechanic' => 'ranking score = economy + military + technology + glory − penalties', 'logic' => stargatewars_social_rankings_logic(), 'features' => stargatewars_social_rankings_features(), 'design' => stargatewars_social_rankings_design(), 'systems' => stargatewars_social_rankings_systems(), 'feedback_state' => $state, 'context' => $context];
}

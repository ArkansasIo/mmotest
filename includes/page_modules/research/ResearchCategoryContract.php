<?php
declare(strict_types=1);

/** Shared server contract for the Research route category. */
final class ResearchCategoryContract
{
    public const ACTIONS = ['technology', 'refresh_page'];
    public const FEEDBACK_STATES = ['loading', 'ready', 'empty', 'locked', 'queued', 'insufficient-resource', 'success', 'error'];
    public const TABLES = ['technologies', 'technology_prerequisites', 'player_technologies', 'research_queues', 'player_resources', 'game_events'];

    public static function validateIntent(array $input): array
    {
        $action = (string)($input['action'] ?? '');
        $errors = [];
        if (!in_array($action, self::ACTIONS, true)) $errors['action'] = 'Research action is not permitted.';
        if ($action === 'technology' && trim((string)($input['technology_key'] ?? '')) === '') $errors['technology_key'] = 'A technology key is required.';
        if (isset($input['technology_level']) && (int)$input['technology_level'] < 0) $errors['technology_level'] = 'Technology level cannot be negative.';
        return ['valid' => $errors === [], 'action' => $action, 'errors' => $errors];
    }

    public static function formula(): array
    {
        return [
            'next_cost' => 'base cost × level coefficient × branch modifier',
            'research_time' => 'base time × level coefficient ÷ laboratory modifier',
            'applied_effect' => 'level × tier coefficient × race/government modifier',
        ];
    }
}

<?php
declare(strict_types=1);

namespace MMO\Gameplay\Intelligence;

final class IntelligenceService
{
    public function resolveOperation(int $agentSkill, int $targetSecurity, int $technologyBonus = 0): array
    {
        $score = $agentSkill + $technologyBonus - $targetSecurity;
        $roll = random_int(1, 100);
        $threshold = max(5, min(95, 50 + $score));

        return [
            'success' => $roll <= $threshold,
            'roll' => $roll,
            'threshold' => $threshold,
            'detected' => $roll > $threshold + 20,
        ];
    }
}

<?php
declare(strict_types=1);

namespace MMO\Gameplay\Military;

final class CombatService
{
    public function resolve(array $attacker, array $defender): array
    {
        $attack = max(1, (int)($attacker['attack'] ?? 1));
        $defense = max(0, (int)($defender['defense'] ?? 0));
        $shield = max(0, (int)($defender['shield'] ?? 0));

        $raw = $attack;
        $shieldDamage = min($shield, $raw);
        $hullDamage = max(0, $raw - $shieldDamage - $defense);

        return [
            'attacker_damage' => max(0, (int)($defender['attack'] ?? 0) - (int)($attacker['defense'] ?? 0)),
            'shield_damage' => $shieldDamage,
            'hull_damage' => $hullDamage,
            'destroyed' => $hullDamage >= max(1, (int)($defender['hull'] ?? 1)),
        ];
    }
}

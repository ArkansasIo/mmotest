<?php
declare(strict_types=1);

namespace MMO\Gameplay\Galaxy;

final class GalaxyGenerator
{
    public function generate(int $seed, int $systems = 100): array
    {
        mt_srand($seed);
        $result = [];

        for ($i = 1; $i <= $systems; $i++) {
            $planets = [];
            $count = mt_rand(3, 12);
            for ($p = 1; $p <= $count; $p++) {
                $planets[] = [
                    'position' => $p,
                    'type' => ['terran','desert','ocean','ice','volcanic','barren'][mt_rand(0,5)],
                    'size' => mt_rand(50, 500),
                    'temperature' => mt_rand(-150, 250),
                ];
            }
            $result[] = ['system'=>$i,'planets'=>$planets];
        }
        return $result;
    }
}

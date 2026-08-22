<?php
declare(strict_types=1);

require_once __DIR__ . '/../01_Core/bootstrap.php';

use MMO\Core\GameEngine\TurnProcessor;

$processor = new TurnProcessor($db);
$turnId = (int)($argv[1] ?? 0);
if ($turnId <= 0) {
    fwrite(STDERR, "Usage: php turn_processor.php <turn_id>\n");
    exit(1);
}
$processor->process($turnId);
echo "Turn {$turnId} processed.\n";

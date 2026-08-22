<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/SettlementConstructionService.php';

$pdo = db();
$colony = $pdo->query('SELECT id,player_id FROM player_colonies ORDER BY id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if (!$colony) {
    echo json_encode(['status' => 'skipped', 'reason' => 'No seeded player colony available.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$playerId = (int)$colony['player_id'];
$colonyId = (int)$colony['id'];
$service = new SettlementConstructionService($pdo);
$before = $service->state($playerId, $colonyId);
$empty = array_values(array_filter($before['fields'], static fn(array $field): bool => empty($field['building_id'])));
if (!$empty) {
    echo json_encode(['status' => 'skipped', 'reason' => 'No empty settlement field available.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$type = null;
foreach ($before['building_classes'] as $candidate) {
    if ((string)($candidate['building_key'] ?? '') === 'command_center') {
        $type = $candidate;
        break;
    }
}
$type ??= $before['building_classes'][0] ?? null;
if (!$type) {
    echo json_encode(['status' => 'skipped', 'reason' => 'No active building catalogue entry available.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$resources = $pdo->prepare('SELECT metal,crystal,deuterium,naquadah,energy FROM player_resources WHERE player_id=?');
$resources->execute([$playerId]);
$resourceBefore = $resources->fetch(PDO::FETCH_ASSOC);
if (!$resourceBefore) {
    echo json_encode(['status' => 'skipped', 'reason' => 'No player resource row available.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$event = $pdo->prepare('SELECT COALESCE(MAX(id),0) FROM game_events WHERE player_id=?');
$event->execute([$playerId]);
$eventCutoff = (int)$event->fetchColumn();
$queueId = 0;
$buildingId = 0;
$checks = [];
$now = new DateTimeImmutable('2020-01-01T00:00:00+00:00');
try {
    $pdo->exec('UPDATE player_resources SET metal=metal+10000000,crystal=crystal+10000000,deuterium=deuterium+1000000,naquadah=naquadah+1000000,energy=energy+1000000 WHERE player_id=' . $playerId);
    $fieldIndex = (int)$empty[0]['field_index'];
    $result = $service->construct($playerId, $colonyId, $fieldIndex, (string)$type['building_key'], $now);
    $queueId = (int)$result['queue_id'];
    $resourceAfterStmt = $pdo->prepare('SELECT metal,crystal,deuterium,naquadah,energy FROM player_resources WHERE player_id=?');
    $resourceAfterStmt->execute([$playerId]);
    $resourceAfter = $resourceAfterStmt->fetch(PDO::FETCH_ASSOC);
    foreach (['metal','crystal','deuterium','naquadah','energy'] as $key) {
        $bonus = in_array($key, ['deuterium', 'naquadah', 'energy'], true) ? 1000000 : 10000000;
        $expected = (int)$resourceBefore[$key] + $bonus - (int)$result['cost'][$key];
        $checks['resource_lock_' . $key] = (int)$resourceAfter[$key] === $expected;
    }
    $queueStmt = $pdo->prepare('SELECT starts_at,completes_at,status FROM settlement_construction_queues WHERE id=? AND player_id=?');
    $queueStmt->execute([$queueId, $playerId]);
    $queue = $queueStmt->fetch(PDO::FETCH_ASSOC);
    $start = new DateTimeImmutable($queue['starts_at']);
    $complete = new DateTimeImmutable($queue['completes_at']);
    $checks['queue_status_building'] = $queue['status'] === 'building';
    $checks['completion_time_matches_result'] = $queue['completes_at'] === $result['completes_at'];
    $checks['completion_time_is_positive'] = ($complete->getTimestamp() - $start->getTimestamp()) === (int)$result['build_seconds'];
    $early = $service->processDue($complete->modify('-1 second'));
    $checks['early_processing_does_not_complete'] = (int)$early['count'] === 0;
    $late = $service->processDue($complete->modify('+1 second'));
    $checks['due_processing_completes_queue'] = (int)$late['count'] === 1;
    $buildingStmt = $pdo->prepare('SELECT id FROM settlement_buildings WHERE settlement_key=? AND field_id=? ORDER BY id DESC LIMIT 1');
    $buildingStmt->execute([$before['settlement']['settlement_key'], (int)$empty[0]['id']]);
    $buildingId = (int)$buildingStmt->fetchColumn();
    $checks['completed_building_persisted'] = $buildingId > 0;
    foreach ($checks as $name => $passed) if (!$passed) throw new RuntimeException('Failed check: ' . $name);
    echo json_encode(['status' => 'passed', 'player_id' => $playerId, 'colony_id' => $colonyId, 'queue_id' => $queueId, 'build_seconds' => (int)$result['build_seconds'], 'checks' => $checks], JSON_PRETTY_PRINT) . PHP_EOL;
} finally {
    if ($queueId > 0) $pdo->prepare('DELETE FROM settlement_construction_queues WHERE id=?')->execute([$queueId]);
    if ($buildingId > 0) $pdo->prepare('DELETE FROM settlement_buildings WHERE id=?')->execute([$buildingId]);
    $pdo->prepare('UPDATE settlement_fields SET building_id=NULL WHERE id=? AND building_id=?')->execute([(int)$empty[0]['id'], $buildingId]);
    foreach ($resourceBefore as $key => $value) $pdo->prepare("UPDATE player_resources SET {$key}=? WHERE player_id=?")->execute([(int)$value, $playerId]);
    $pdo->prepare('DELETE FROM game_events WHERE id>? AND player_id=?')->execute([$eventCutoff, $playerId]);
}

<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$tests = [
    'detailed_specs' => ['php', 'tools/validate_detailed_page_specs.php'],
    'generated_routes' => ['php', 'tools/test_all_generated_routes.php'],
    'ajax_routes' => ['php', 'tools/test_all_ajax_routes.php'],
    'navigation' => ['php', 'tests/navigation_redesign_test.php'],
    'page_modules' => ['php', 'tests/page_modules_integration.php'],
    'coordinate_search' => ['php', 'tests/coordinate_search_contract_test.php'],
    'route_stress' => ['php', 'tests/route_stress_test.php'],
];

$results = [];
$overall = true;
foreach ($tests as $name => $command) {
    $descriptor = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
    $process = proc_open(implode(' ', array_map('escapeshellarg', $command)), $descriptor, $pipes, $root);
    if (!is_resource($process)) {
        $results[$name] = ['status' => 'failed', 'exit_code' => 127, 'output' => 'Unable to start process'];
        $overall = false;
        continue;
    }
    $output = stream_get_contents($pipes[1]) . stream_get_contents($pipes[2]);
    foreach ($pipes as $pipe) fclose($pipe);
    $exit = proc_close($process);
    $results[$name] = ['status' => $exit === 0 ? 'passed' : 'failed', 'exit_code' => $exit, 'output' => trim($output)];
    $overall = $overall && $exit === 0;
}

$summary = [
    'status' => $overall ? 'passed' : 'failed',
    'generated_at' => gmdate('c'),
    'tests' => $results,
];
file_put_contents($root . '/docs/test-run-latest.json', json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
echo json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($overall ? 0 : 1);

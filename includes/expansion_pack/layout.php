<?php
declare(strict_types=1);
$title = $title ?? 'MMO Command';
$content = $content ?? '';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($title) ?></title>
<link rel="stylesheet" href="/assets/css/mmo.css">
</head>
<body>
<header class="topbar">
  <div class="brand">STARGATE EMPIRE</div>
  <div class="resources">
    <span>Metal <b id="metal">820,000</b></span>
    <span>Crystal <b id="crystal">460,000</b></span>
    <span>Naquadah <b id="naquadah">1,240,000</b></span>
    <span>Energy <b id="energy">640</b></span>
  </div>
  <div class="player">Commander <b>Player</b></div>
</header>
<div class="app">
<aside class="sidebar">
<?php
$menu = [
'Overview'=>['Dashboard'=>'/pages/dashboard/index.php','Empire'=>'/pages/empire/index.php'],
'Economy'=>['Resources'=>'/pages/resources/index.php','Buildings'=>'/pages/buildings/index.php','Market'=>'/pages/market/index.php'],
'Research'=>['Technology'=>'/pages/research/index.php','Research Queue'=>'/pages/research/queue.php'],
'Military'=>['Fleet'=>'/pages/fleet/index.php','Shipyard'=>'/pages/fleet/shipyard.php','Combat'=>'/pages/combat/index.php'],
'Planets'=>['Planets'=>'/pages/planets/index.php','Construction'=>'/pages/planets/construction.php'],
'Galaxy'=>['Galaxy Map'=>'/pages/galaxy/index.php','Exploration'=>'/pages/galaxy/exploration.php','Stargates'=>'/pages/stargate/index.php'],
'Intelligence'=>['Overview'=>'/pages/intelligence/index.php','Operations'=>'/pages/intelligence/operations.php'],
'Social'=>['Alliance'=>'/pages/alliance/index.php','Diplomacy'=>'/pages/diplomacy/index.php','Messages'=>'/pages/messages/index.php'],
'Progression'=>['Commanders'=>'/pages/commanders/index.php','Achievements'=>'/pages/progression/achievements.php','Ascension'=>'/pages/progression/ascension.php']
];
foreach ($menu as $section=>$items):
?>
<section class="nav-section">
<h3><?= htmlspecialchars($section) ?></h3>
<?php foreach ($items as $label=>$url): ?>
<a href="<?= htmlspecialchars($url) ?>"><?= htmlspecialchars($label) ?></a>
<?php endforeach; ?>
</section>
<?php endforeach; ?>
</aside>
<main class="main">
<?= $content ?>
</main>
</div>
<script src="/assets/js/mmo.js"></script>
</body>
</html>

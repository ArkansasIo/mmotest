# Overlapping File Review

This review compares the 13 archive files with their canonical counterparts. The canonical files remain active; expansion copies are preserved under `expansion_import/` and `pages/expansion_pack/`.

## Summary

| File | Canonical | Expansion | Main difference | Decision |
|---|---:|---:|---|---|
| `includes/layout.php` | 57 lines | 55 lines | Shared layout differs substantially; canonical layout contains project-wide auth/theme/navigation integration. | Keep canonical layout; adapt expansion presentation elements through a namespaced partial. |
| `pages/alliance/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/economy/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/empire/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/fleet/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/galaxy/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/intelligence/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/market/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/military/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/planets/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/rankings/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/research/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |
| `pages/resources/index.php` | 3 lines | 17 lines | Canonical file is a thin registry/page-loader wrapper; expansion file is a standalone scaffold/controller with its own output and assumptions. | Keep canonical route wrapper; use expansion copy only after adapting it to the page contract. |

## Detailed findings

### \

```diff
--- includes/layout.php	2026-08-20 23:28:36.696609604 +0000
+++ expansion_import/includes/layout.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,57 +1,55 @@
 <?php
-require_once __DIR__ . '/../config/auth.php';
-require_auth();
-$route = $_GET['page'] ?? 'dashboard';
-require_route_access($route);
-$menu = menu_tree();
-$activeParent = $route;
-foreach ($menu as $item) {
-    foreach ($item['children'] as $child) if ($child['route'] === $route) $activeParent = $item['route'];
-}
-$pdo = db();
-$sessionUser = current_user();
-$player = $sessionUser ?? ['id'=>0,'username'=>'demo_commander','display_name'=>'Commander Tanang','race'=>'Tau\'ri','government'=>'Republic','rank_level'=>1,'rank_name'=>'Initiate'];
-$resources = ['naquadah'=>125000,'dark_matter'=>2500,'metal'=>820000,'crystal'=>460000,'energy'=>640,'banked_naquadah'=>500000,'attack_turns'=>48,'market_turns'=>3,'untrained_units'=>1600,'unit_production'=>12,'miners'=>120,'lifers'=>12,'attack_units'=>850,'defense_units'=>1200,'spies'=>160,'anti_spies'=>140,'food'=>10000,'water'=>10000,'population'=>100,'population_capacity'=>1000];
-if ($pdo && $sessionUser) {
-    try {
-        $stmt = $pdo->prepare("SELECT p.*,r.name AS race,g.name AS government FROM players p JOIN races r ON r.id=p.race_id LEFT JOIN government_types g ON g.id=p.government_id WHERE p.id=? LIMIT 1");
-        $stmt->execute([(int)$sessionUser['id']]);
-        if ($row = $stmt->fetch()) $player = $row;
-        $stmt = $pdo->prepare('SELECT * FROM player_resources WHERE player_id=? LIMIT 1');
-        $stmt->execute([(int)$sessionUser['id']]);
-        if ($row = $stmt->fetch()) $resources = array_merge($resources, $row);
-    } catch (Throwable $e) {}
-}
-function render_menu(array $items, string $activeParent, string $route): void {
-    foreach ($items as $item) {
-        $isActive = $activeParent === $item['route'] || $route === $item['route'];
-        echo '<li class="nav-group ' . ($isActive ? 'open' : '') . '">';
-        echo '<a class="nav-link ' . ($route === $item['route'] ? 'active' : '') . '" href="?page=' . e($item['route']) . '"><span class="nav-icon">' . e($item['icon'] ?? '•') . '</span><span>' . e($item['label']) . '</span>' . (count($item['children']) ? '<span class="chevron">›</span>' : '') . '</a>';
-        if (count($item['children'])) {
-            echo '<ul class="submenu">';
-            foreach ($item['children'] as $child) echo '<li><a class="sub-link ' . ($route === $child['route'] ? 'active' : '') . '" href="?page=' . e($child['route']) . '">' . e($child['label']) . '</a></li>';
-            echo '</ul>';
-        }
-        echo '</li>';
-    }
-}
+declare(strict_types=1);
+$title = $title ?? 'MMO Command';
+$content = $content ?? '';
 ?>
 <!doctype html>
 <html lang="en">
 <head>
 <meta charset="utf-8">
-<meta name="viewport" content="width=device-width, initial-scale=1">
-<title><?= e(page_title($route)) ?> · Universe Civilization: Empire at Wars</title>
-<link rel="stylesheet" href="assets/app.css">
+<meta name="viewport" content="width=device-width,initial-scale=1">
+<title><?= htmlspecialchars($title) ?></title>
+<link rel="stylesheet" href="/assets/css/mmo.css">
 </head>
 <body>
-<div class="app-shell">
+<header class="topbar">
+  <div class="brand">STARGATE EMPIRE</div>
+  <div class="resources">
+    <span>Metal <b id="metal">820,000</b></span>
+    <span>Crystal <b id="crystal">460,000</b></span>
+    <span>Naquadah <b id="naquadah">1,240,000</b></span>
+    <span>Energy <b id="energy">640</b></span>
+  </div>
+  <div class="player">Commander <b>Player</b></div>
+</header>
+<div class="app">
 <aside class="sidebar">
-  <div class="brand"><div class="brand-mark">S</div><div><strong>UNIVERSE CIVILIZATION: EMPIRE AT WARS</strong><small>COMMAND INTERFACE</small></div></div>
-  <div class="profile"><div class="avatar">CT</div><div><strong><?= e($player['display_name']) ?></strong><span><?= e($player['race']) ?> · <?= e($player['government'] ?? 'Republic') ?> · <?= e($player['rank_name'] ?? 'Initiate') ?></span></div></div>
-  <nav class="main-nav"><div class="nav-caption">Navigation</div><ul><?php render_menu($menu, $activeParent, $route); ?></ul></nav>
-  <div class="sidebar-foot"><span class="status-dot"></span> Systems operational<br><small>Turn cycle: 30 minutes</small></div>
+<?php
+$menu = [
+'Overview'=>['Dashboard'=>'/pages/dashboard/index.php','Empire'=>'/pages/empire/index.php'],
+'Economy'=>['Resources'=>'/pages/resources/index.php','Buildings'=>'/pages/buildings/index.php','Market'=>'/pages/market/index.php'],
+'Research'=>['Technology'=>'/pages/research/index.php','Research Queue'=>'/pages/research/queue.php'],
+'Military'=>['Fleet'=>'/pages/fleet/index.php','Shipyard'=>'/pages/fleet/shipyard.php','Combat'=>'/pages/combat/index.php'],
+'Planets'=>['Planets'=>'/pages/planets/index.php','Construction'=>'/pages/planets/construction.php'],
+'Galaxy'=>['Galaxy Map'=>'/pages/galaxy/index.php','Exploration'=>'/pages/galaxy/exploration.php','Stargates'=>'/pages/stargate/index.php'],
+'Intelligence'=>['Overview'=>'/pages/intelligence/index.php','Operations'=>'/pages/intelligence/operations.php'],
+'Social'=>['Alliance'=>'/pages/alliance/index.php','Diplomacy'=>'/pages/diplomacy/index.php','Messages'=>'/pages/messages/index.php'],
+'Progression'=>['Commanders'=>'/pages/commanders/index.php','Achievements'=>'/pages/progression/achievements.php','Ascension'=>'/pages/progression/ascension.php']
+];
+foreach ($menu as $section=>$items):
+?>
+<section class="nav-section">
+<h3><?= htmlspecialchars($section) ?></h3>
+<?php foreach ($items as $label=>$url): ?>
+<a href="<?= htmlspecialchars($url) ?>"><?= htmlspecialchars($label) ?></a>
+<?php endforeach; ?>
+</section>
+<?php endforeach; ?>
 </aside>
-<main class="main-content">
-  <header class="topbar"><div><div class="eyebrow">UNIVERSE CIVILIZATION: EMPIRE AT WARS / <?= e(strtoupper($activeParent)) ?></div><h1><?= e(page_title($route)) ?></h1></div><div class="resource-header" aria-label="Strategic resources"><div class="resource-item resource-metal"><span class="resource-icon">M</span><span><small>Metal</small><strong><?= number((int)$resources['metal']) ?></strong></span></div><div class="resource-item resource-crystal"><span class="resource-icon">C</span><span><small>Crystal</small><strong><?= number((int)$resources['crystal']) ?></strong></span></div><div class="resource-item resource-naquadah"><span class="resource-icon">N</span><span><small>Naquadah</small><strong><?= number((int)$resources['naquadah']) ?></strong></span></div><div class="resource-item resource-energy"><span class="resource-icon">E</span><span><small>Energy</small><strong><?= number((int)$resources['energy']) ?></strong></span></div><div class="resource-item resource-dark-matter"><span class="resource-icon">DM</span><span><small>Dark Matter</small><strong><?= number((int)$resources['dark_matter']) ?></strong></span></div><div class="resource-item resource-food"><span class="resource-icon">F</span><span><small>Food</small><strong><?= number((int)$resources['food']) ?></strong></span></div><div class="resource-item resource-water"><span class="resource-icon">W</span><span><small>Water</small><strong><?= number((int)$resources['water']) ?></strong></span></div><div class="resource-item resource-population"><span class="resource-icon">POP</span><span><small>Population</small><strong><?= number((int)$resources['population']) ?> / <?= number((int)$resources['population_capacity']) ?></strong></span></div><span class="turn-pill">TURN <b><?= number($resources['attack_turns']) ?></b></span><a href="?page=account" class="profile-chip"><?= e($player['username']) ?> <span>⌄</span></a><a href="logout.php" class="logout-link">Log out</a></div></header>
-  <section class="page-content">
+<main class="main">
+<?= $content ?>
+</main>
+</div>
+<script src="/assets/js/mmo.js"></script>
+</body>
+</html>
```

### \

```diff
--- pages/alliance/index.php	2026-08-21 23:53:26.646906435 +0000
+++ expansion_import/pages/alliance/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'alliance'; $group = 'alliance'; $label = 'Alliance'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/alliance/alliance.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/alliance/alliance.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Alliance';
+ob_start();
+?>
+<div class="page-title"><h1>Alliance</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Alliance</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/economy/index.php	2026-08-21 23:53:26.642906400 +0000
+++ expansion_import/pages/economy/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'economy'; $group = 'economy'; $label = 'Economy'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/economy/economy.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/economy/economy.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Economy';
+ob_start();
+?>
+<div class="page-title"><h1>Economy</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Economy</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/empire/index.php	2026-08-21 23:53:26.630906296 +0000
+++ expansion_import/pages/empire/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'empire'; $group = 'empire'; $label = 'Empire'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/empire/empire.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/empire/empire.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Empire Overview';
+ob_start();
+?>
+<div class="page-title"><h1>Empire Overview</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Empire Overview</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/fleet/index.php	2026-08-21 23:53:26.638906366 +0000
+++ expansion_import/pages/fleet/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'fleet'; $group = 'fleet'; $label = 'Fleet'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/fleet/fleet.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/fleet/fleet.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Fleet Command';
+ob_start();
+?>
+<div class="page-title"><h1>Fleet Command</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Fleet Command</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/galaxy/index.php	2026-08-21 23:53:26.638906366 +0000
+++ expansion_import/pages/galaxy/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'galaxy'; $group = 'galaxy'; $label = 'Galaxy'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/galaxy/galaxy.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/galaxy/galaxy.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Galaxy Map';
+ob_start();
+?>
+<div class="page-title"><h1>Galaxy Map</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Galaxy Map</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/intelligence/index.php	2026-08-21 23:53:26.622906226 +0000
+++ expansion_import/pages/intelligence/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'intelligence'; $group = 'intelligence'; $label = 'Intelligence'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/intelligence/intelligence.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/intelligence/intelligence.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Intelligence';
+ob_start();
+?>
+<div class="page-title"><h1>Intelligence</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Intelligence</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/market/index.php	2026-08-21 23:53:26.626906261 +0000
+++ expansion_import/pages/market/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'market'; $group = 'market'; $label = 'Market'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/market/market.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/market/market.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Market';
+ob_start();
+?>
+<div class="page-title"><h1>Market</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Market</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/military/index.php	2026-08-21 23:53:26.638906366 +0000
+++ expansion_import/pages/military/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'military'; $group = 'military'; $label = 'Military'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/military/military.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/military/military.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Military Overview';
+ob_start();
+?>
+<div class="page-title"><h1>Military Overview</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Military Overview</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/planets/index.php	2026-08-21 23:53:26.626906261 +0000
+++ expansion_import/pages/planets/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'planets'; $group = 'planets'; $label = 'Planets'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/planets/planets.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/planets/planets.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Planets';
+ob_start();
+?>
+<div class="page-title"><h1>Planets</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Planets</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/rankings/index.php	2026-08-21 23:53:26.650906470 +0000
+++ expansion_import/pages/rankings/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'rankings'; $group = 'rankings'; $label = 'Rankings'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/rankings/rankings.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/rankings/rankings.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Rankings';
+ob_start();
+?>
+<div class="page-title"><h1>Rankings</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Rankings</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/research/index.php	2026-08-21 23:53:26.634906331 +0000
+++ expansion_import/pages/research/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'research'; $group = 'research'; $label = 'Research'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/research/research.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/research/research.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Technology';
+ob_start();
+?>
+<div class="page-title"><h1>Technology</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Technology</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

### \

```diff
--- pages/resources/index.php	2026-08-21 23:53:26.634906331 +0000
+++ expansion_import/pages/resources/index.php	2026-08-22 03:46:50.000000000 +0000
@@ -1,3 +1,17 @@
 <?php
 declare(strict_types=1);
-$route = 'resources'; $group = 'resources'; $label = 'Resources'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/resources/resources.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/resources/resources.php' : null; require __DIR__ . '/../_nested_entry.php';
+$title = 'Resources';
+ob_start();
+?>
+<div class="page-title"><h1>Resources</h1><span class="muted">Turn 84</span></div>
+<div class="grid">
+  <section class="panel"><h2>Resources</h2><div class="panel-body">
+    <div class="metric">System Ready</div>
+    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
+  </div></section>
+  <section class="panel"><h2>Activity</h2><div class="panel-body">
+    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
+    <div class="bar"><i style="width:64%"></i></div>
+  </div></section>
+</div>
+<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>
```

## Cross-cutting risks

The expansion page files do not implement the canonical registry-driven six-layer route contract, and the standalone expansion layout is not a drop-in replacement for the current authenticated SPA shell. Direct replacement would therefore risk broken navigation, inconsistent theme handling, missing CSRF/RBAC hooks, and divergent AJAX response states.

The safe integration path is to retain canonical wrappers and progressively port expansion presentation and mechanics behind existing authenticated action contracts. Expansion service classes should be reconciled with the canonical service/autoload conventions before use. The seven staged SQL tables also require column-level migration work because several names, types, timestamps, and payload fields differ from the live schema.

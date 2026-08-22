<?php
declare(strict_types=1);
$title = 'Ascension';
ob_start();
?>
<div class="page-title"><h1>Ascension</h1><span class="muted">Turn 84</span></div>
<div class="grid">
  <section class="panel"><h2>Ascension</h2><div class="panel-body">
    <div class="metric">System Ready</div>
    <p class="muted">This page is wired to the shared MMO shell and is ready for its domain controller/service.</p>
  </div></section>
  <section class="panel"><h2>Activity</h2><div class="panel-body">
    <p>Next update <b data-countdown="<?= date('c', time()+300) ?>">00:05:00</b></p>
    <div class="bar"><i style="width:64%"></i></div>
  </div></section>
</div>
<?php $content = ob_get_clean(); require __DIR__ . '/../../includes/layout.php'; ?>

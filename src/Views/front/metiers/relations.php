<?php
$others  = array_values(array_filter($metiers, fn($m) => $m['id'] !== $jobId));
$total   = count($others);
$radius  = 190;
$svgSize = 560;
$cx      = $svgSize / 2;
$cy      = $svgSize / 2;

$colors = [
    1 => '#FF806B', 2 => '#FBC246', 3 => '#6B7FFF', 4 => '#C5B0FF',
    5 => '#4DE8D0', 6 => '#E85D75', 7 => '#FF9A56', 8 => '#95D47A',
];
$currentColor = $colors[$jobId] ?? '#FF6B35';
?>

<div class="relations-wrapper">

    <!-- Graphe radial -->
    <div class="relations-graph" aria-label="Graphe des relations entre métiers">

        <!-- Lignes SVG de connexion -->
        <svg class="relations-svg" viewBox="0 0 <?= $svgSize ?> <?= $svgSize ?>" aria-hidden="true">
            <?php for ($i = 0; $i < $total; $i++):
                $angle = deg2rad($i * 360 / $total - 90);
                $x2 = round($cx + $radius * cos($angle), 2);
                $y2 = round($cy + $radius * sin($angle), 2);
                $color = $colors[$others[$i]['id']] ?? '#444';
            ?>
            <line
                x1="<?= $cx ?>" y1="<?= $cy ?>"
                x2="<?= $x2 ?>" y2="<?= $y2 ?>"
                stroke="<?= htmlspecialchars($color) ?>"
                stroke-width="1.5"
                stroke-dasharray="4 4"
                opacity="0.35"
            />
            <?php endfor; ?>
        </svg>

        <!-- Nœud central -->
        <div class="relations-node relations-node--center" style="--node-color: <?= htmlspecialchars($currentColor) ?>">
            <span class="relations-node__name"><?= htmlspecialchars($currentName) ?></span>
            <span class="relations-node__badge">En focus</span>
        </div>

        <!-- Nœuds satellites -->
        <?php foreach ($others as $i => $m):
            $angle  = $i * 360 / $total - 90;
            $color  = $colors[$m['id']] ?? '#444';
        ?>
        <a href="?job=<?= $m['id'] ?>"
           class="relations-node relations-node--satellite"
           style="--node-color: <?= htmlspecialchars($color) ?>; --angle: <?= $angle ?>deg;"
           title="Explorer le métier : <?= htmlspecialchars($m['titre']) ?>">
            <span class="relations-node__name"><?= htmlspecialchars($m['titre']) ?></span>
        </a>
        <?php endforeach; ?>

    </div>

    <p class="relations-caption">Clique sur un métier pour l'explorer</p>
</div>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métiers du Digital | Digital Maker Lab</title>
    <link rel="stylesheet" href="/assets/css/design-system.css">
    <link rel="stylesheet" href="/assets/css/metiers.css">
    <link rel="stylesheet" href="/assets/css/metiers-relations.css">
    <link rel="stylesheet" href="/assets/css/assistant-ia.css">
</head>
<body class="metiers-body">

    <!-- Header -->
    <header class="metiers-header">
        <div class="metiers-header__inner">
            <a href="/" class="metiers-logo">Digital Maker Lab</a>

            <!-- Sélecteur de métier -->
            <nav class="metiers-job-nav" aria-label="Sélection du métier">
                <?php foreach ($metiers as $m): ?>
                    <a href="?job=<?= $m['id'] ?>"
                       class="metiers-job-btn<?= ($m['id'] === $jobId) ? ' is-active' : '' ?>">
                        <?= htmlspecialchars($m['titre']) ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="metiers-main">

        <!-- Titre de la page -->
        <div class="metiers-intro">
            <?php
                $current = array_values(array_filter($metiers, fn($m) => $m['id'] === $jobId));
                $currentName = $current[0]['titre'] ?? 'Métier';
                $currentSpecialty = $current[0]['specialite'] ?? '';
            ?>
            <div class="metiers-intro__badge"><?= htmlspecialchars($currentSpecialty) ?></div>
            <h1 class="metiers-intro__title"><?= htmlspecialchars($currentName) ?></h1>
            <p class="metiers-intro__sub">Explore les relations et l'impact de ce métier dans l'écosystème digital</p>
        </div>

        <!-- Onglets -->
        <div class="metiers-tabs" role="tablist">
            <button class="metiers-tab is-active" data-tab="relations" role="tab" aria-selected="true" aria-controls="panel-relations">
                Relations entre métiers
            </button>
            <button class="metiers-tab" data-tab="impact" role="tab" aria-selected="false" aria-controls="panel-impact">
                Impact sur tes apps
            </button>
        </div>

        <!-- Panneau : Relations -->
        <div class="metiers-panel is-active" id="panel-relations" role="tabpanel">
            <?php include __DIR__ . '/relations.php'; ?>
        </div>

        <!-- Panneau : Impact apps -->
        <div class="metiers-panel" id="panel-impact" role="tabpanel" aria-hidden="true">
            <div class="metiers-impact">
                <div class="metiers-impact__prompt">
                    <div class="metiers-impact__icon" aria-hidden="true">&#10022;</div>
                    <h2 class="metiers-impact__title">Découvre les outils du <?= htmlspecialchars($currentName) ?></h2>
                    <p class="metiers-impact__text">
                        Clique sur la bulle <strong>Assistant Digital Maker Lab</strong> en bas de page
                        pour explorer les 3 applications incontournables de ce métier.
                    </p>
                    <button class="metiers-impact__cta js-open-bubble" type="button">
                        Ouvrir l'assistant &#8594;
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- Bulle IA — ticket #69 -->
    <?php include __DIR__ . '/assistant-ia-bubble.php'; ?>

    <script src="/assets/js/assistant-ia.js" defer></script>
    <script src="/assets/js/metiers.js" defer></script>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des métiers</title>
    <link rel="stylesheet" href="/assets/css/design-system.css">
    <link rel="stylesheet" href="/assets/css/back-office-default-settings.css">
    <link rel="stylesheet" href="/assets/css/back-office-form.css">
    <link rel="stylesheet" href="/assets/css/back-office-list.css">
    
    <script src="/assets/js/toggle-display.js" defer></script>
</head>
<body>
    <div class="main-container">
        <header>
            <nav>
                <a href="/test_admin_specialties.php" class="tab">Spécialité</a>
                <a href="/test_admin_jobs.php" class="tab active">Métier</a>
            </nav>
        </header>
        <main>
            <div class="main-section-container">
                <div class="main-title-container">
                    <h1 class="main-title">Liste des métiers</h1>
                    <div></div>
                </div>
                
                <div class="jobs-container">
                    <?php if (!empty($jobs)): ?>
                        <?php foreach ($jobs as $job): ?>
                            <div class="job-container">
                                
                                <div class="job-name"><?= htmlspecialchars($job['job_name']) ?></div>
                                
                                <div class="icon-interaction-with-job-container">
                                    
                                    <a href="/test_admin_jobs.php?action=edit&id=<?= $job['id_job'] ?>" class="icon-interaction-with-job position-centered pencil">
                                        <img src="/assets/images/icons/icon-pencil.svg" alt="Modifier le métier">
                                    </a>
                                    
                                    <div class="icon-interaction-with-job position-centered eye toggle-btn"
                                         data-id="<?= $job['id_job'] ?>"
                                         data-display="<?= $job['display'] ?? 0 ?>"
                                         data-type="job"
                                         style="cursor: pointer;">
                                        <?php if (($job['display'] ?? 0) == 1): ?>
                                            <img src="/assets/images/icons/icon-eye-opened.svg" alt="Métier visible">
                                        <?php else: ?>
                                            <img src="/assets/images/icons/icon-eye-closed.svg" alt="Métier masqué">
                                        <?php endif; ?>
                                    </div>
                                    
                                    <a href="/test_admin_jobs.php?action=delete&id=<?= $job['id_job'] ?>" class="icon-interaction-with-job position-centered trash" onclick="return confirm('Es-tu sûr de vouloir supprimer ce métier ?');">
                                        <img src="/assets/images/icons/icon-trash.svg" alt="Supprimer le métier">
                                    </a>
                                    
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-job-msg">Aucun métier trouvé en base de données.</p>
                    <?php endif; ?>
                </div>

                <div class="btn-add-container">
                    <a href="/test_admin_jobs.php?action=create" class="icon-interaction-with-job position-centered btn-add">
                        <div class="plus-bar horizontal-bar"></div>
                        <div class="plus-bar vertical-bar"></div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
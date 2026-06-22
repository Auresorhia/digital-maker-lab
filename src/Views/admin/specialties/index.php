<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des spécialités</title>
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
                <a href="/test_admin_specialties.php" class="tab active">Spécialité</a>
                <a href="/test_admin_jobs.php" class="tab">Métier</a>
            </nav>
        </header>
        <main>
            <div class="main-section-container">
                <div class="main-title-container">
                    <h1 class="main-title">Liste des spécialités</h1>
                    <div></div>
                </div>
                
                <div class="jobs-container">
                    <?php if (!empty($specialties)): ?>
                        
                        <?php foreach ($specialties as $specialty): ?>
                            <div class="job-container">
                                
                                <div class="job-name"><?= htmlspecialchars($specialty['specialty']) ?></div>
                                
                                <div class="icon-interaction-with-job-container">
                                    
                                    <a href="/test_admin_specialties.php?action=edit&id=<?= $specialty['id_specialty'] ?>" class="icon-interaction-with-job position-centered pencil">
                                        <img src="/assets/images/icons/icon-pencil.svg" alt="Modifier la spécialité">
                                    </a>
                                    
                                    <div class="icon-interaction-with-job position-centered eye toggle-btn" 
                                        data-id="<?= $specialty['id_specialty'] ?>" 
                                        data-display="<?= $specialty['display'] ?? 0 ?>"
                                        data-type="specialty" style="cursor: pointer;">
                                        
                                        <?php if (($specialty['display'] ?? 0) == 1): ?>
                                            <img src="/assets/images/icons/icon-eye-opened.svg" alt="Spécialité visible">
                                        <?php else: ?>
                                            <img src="/assets/images/icons/icon-eye-closed.svg" alt="Spécialité masquée">
                                        <?php endif; ?>

                                    </div>
                                    
                                    <a href="/test_admin_specialties.php?action=delete&id=<?= $specialty['id_specialty'] ?>" class="icon-interaction-with-job position-centered trash" onclick="return confirm('Es-tu sûr de vouloir supprimer cette spécialité ?');">
                                        <img src="/assets/images/icons/icon-trash.svg" alt="Supprimer la spécialité">
                                    </a>
                                    
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    <?php else: ?>
                        <p class="empty-job-msg">Aucune spécialité trouvée en base de données.</p>
                    <?php endif; ?>
                </div>

                <div class="btn-add-container">
                    <a href="/test_admin_specialties.php?action=create" class="icon-interaction-with-job position-centered btn-add">
                        <div class="plus-bar horizontal-bar"></div>
                        <div class="plus-bar vertical-bar"></div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
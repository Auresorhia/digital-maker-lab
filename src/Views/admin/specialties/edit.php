<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Spécialité</title>
    <link rel="stylesheet" href="/assets/css/design-system.css">
    <link rel="stylesheet" href="/assets/css/back-office-default-settings.css">
    <link rel="stylesheet" href="/assets/css/back-office-form.css">
</head>
<body>
    <div class="main-container">
        <header>
            <nav>
                <a href="/admin/specialties" class="tab active">Spécialité</a>
                <a href="/admin/jobs" class="tab">Métier</a>
            </nav>
        </header>
        <main>
            <div class="go-back-and-main-title-container">
                <a href="/admin/specialties" class="go-back">
                    <div>←</div>
                    <div>Retour vers la liste des spécialités</div>
                </a>
                <h1 class="main-title">Modifier la spécialité</h1>
                <div></div>
            </div>

            <form action="/admin/specialties/<?= $specialty['id_specialty'] ?>/update" method="POST" class="form-container">
                
                <div class="form-label-input-container">
                    <label for="input-add-specialty" class="input-title">Nom de la spécialité</label>
                    <input type="text" id="input-add-specialty" name="specialty" class="input" placeholder="Ex: Motion Designer" value="<?= htmlspecialchars($specialty['specialty'] ?? '') ?>" required>
                </div>
                
                <div class="switch-container">
                    <label for="input-visibility" class="input-title">Visible</label>
                    <div class="switch-choices-container">
                        <div class="switch-choices">Non</div>
                        <label class="switch">
                            <input type="checkbox" id="input-visibility" name="is_visible" value="1" <?= (!empty($specialty['is_visible'])) ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>
                        <div class="switch-choices">Oui</div>
                    </div>
                </div>
                
                <div class="btn-container">
                    <button type="submit" class="btn-validation">Enregistrer les modifications</button>
                </div>
                
            </form>
        </main>
    </div>
</body>
</html>
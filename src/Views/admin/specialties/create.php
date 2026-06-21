<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Spécialité</title>
    <link rel="stylesheet" href="/assets/css/design-system.css">
    <link rel="stylesheet" href="/assets/css/back-office-default-settings.css">
    <link rel="stylesheet" href="/assets/css/back-office-form.css">
</head>
<body>
    <div class="main-container">
        <header>
            <nav>
                <a class="tab active">Spécialité</a>
                <a class="tab">Métier</a>
            </nav>
        </header>
        <main>
            <div class="go-back-and-main-title-container">
                <a href="" class="go-back">
                    <div>←</div>
                    <div>Retour vers la liste des spécialités</div>
                </a>
                <h1 class="main-title">Ajouter une nouvelle spécialité</h1>
                <div></div>
            </div>

            <form action="" class="form-container">
                <div class="form-label-input-container">
                    <label for="input-add-specialty" class="input-title">Nom de la spécialité à ajouter en base</label>
                    <input type="text" id="input-add-specialty" class="input" placeholder="Motion Designer">
                </div>
                <div class="switch-container">
                    <label for="switch" class="input-title">Visible</label>
                    <div class="switch-choices-container">
                        <div class="switch-choices">Non</div>
                        <label class="switch">
                            <input id="checkbox" type="checkbox">
                            <span class="slider"></span>
                        </label>
                        <div class="switch-choices">Oui</div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="submit" class="btn-validation">Ajouter la nouvelle spécialité</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
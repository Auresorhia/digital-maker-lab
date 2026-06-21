<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Métier</title>
    <link rel="stylesheet" href="/assets/css/design-system.css">
    <link rel="stylesheet" href="/assets/css/back-office-default-settings.css">
    <link rel="stylesheet" href="/assets/css/back-office-form.css">
</head>
<body>
    <div class="main-container">
        <header>
            <nav>
                <a href="/admin/specialties" class="tab">Spécialité</a>
                <a href="/admin/jobs" class="tab active">Métier</a>
            </nav>
        </header>
        <main>
            <div class="go-back-and-main-title-container">
                <a href="/admin/jobs" class="go-back">
                    <div>←</div>
                    <div>Retour vers la liste des métiers</div>
                </a>
                <h1 class="main-title">Ajouter un nouveau métier</h1>
                <div></div>
            </div>

            <form action="/admin/jobs/store" method="POST" class="form-container">
                
                <div class="form-label-input-container">
                    <label for="input-main-title" class="input-title">Titre principal</label>
                    <input type="text" id="input-main-title" name="main_title" class="input" placeholder="Le métier de consultant SEO" required>
                </div>

                <div class="form-label-input-container">
                    <label for="input-specialty-id" class="input-title">Spécialité associée</label>
                    <select id="input-specialty-id" name="specialty_id" class="input" required>
                        <option value="">-- Sélectionnez une spécialité --</option>
                        <?php foreach ($specialties as $specialty): ?>
                            <option value="<?= htmlspecialchars($specialty['id_specialty']) ?>">
                                <?= htmlspecialchars($specialty['specialty']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-label-input-container">
                    <label for="input-icon" class="input-title">Icon de spécialité</label>
                    <input type="text" id="input-icon" name="specialty_icon" class="input" placeholder="***** À modifier *****" disabled>
                </div>

                <div class="form-label-input-container">
                    <label for="input-explainer-title" class="input-title">Titre de la partie explainer</label>
                    <input type="text" id="input-explainer-title" name="explainer_title" class="input" placeholder="Le métier de consultant SEO, c’est quoi ?">
                </div>

                <div class="form-label-input-container">
                    <label for="input-explainer-text" class="input-title">Texte de la partie explainer</label>
                    <input type="text" id="input-explainer-text" name="explainer_text" class="input" placeholder="Le métier de consultant SEO, c'est bla-bla-bla">
                </div>

                <div class="form-label-input-container">
                    <label for="input-title-pro" class="input-title">Titre de l'interview du professionnel</label>
                    <input type="text" id="input-title-pro" name="interview_pro_title" class="input" placeholder="Tes missions en tant que consultant SEO">
                </div>

                <div class="form-label-input-container">
                    <label for="input-link-pro" class="input-title">Lien de l'interview du professionnel</label>
                    <input type="text" id="input-link-pro" name="interview_pro_link" class="input" placeholder="***** À modifier *****" disabled>
                </div>

                <div class="form-label-input-container">
                    <label for="input-qualities-title" class="input-title">Titre de la section sur les qualités</label>
                    <input type="text" id="input-qualities-title" name="qualities_title" class="input" placeholder="Les compétences indispensables pour être consultant SEO">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-one" class="input-title">Titre de la qualité numéro une</label>
                    <input type="text" id="input-quality-number-one" name="quality_1_title" class="input" placeholder="Les qualités incontournables">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-one-text" class="input-title">Texte de la qualité numéro une</label>
                    <input type="text" id="input-quality-number-one-text" name="quality_1_text" class="input" placeholder="Savoir-être">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-two" class="input-title">Titre de la qualité numéro deux</label>
                    <input type="text" id="input-quality-number-two" name="quality_2_title" class="input" placeholder="Les compétences techniques">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-two-text" class="input-title">Texte de la qualité numéro deux</label>
                    <input type="text" id="input-quality-number-two-text" name="quality_2_text" class="input" placeholder="Savoir-faire">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-three" class="input-title">Titre de la qualité numéro trois</label>
                    <input type="text" id="input-quality-number-three" name="quality_3_title" class="input" placeholder="Les outils que tu vas utiliser">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-three-text" class="input-title">Texte de la qualité numéro trois</label>
                    <input type="text" id="input-quality-number-three-text" name="quality_3_text" class="input" placeholder="Exemple d’outils (Semrush, etc)">
                </div>

                <div class="form-label-input-container">
                    <label for="input-working-site-title" class="input-title">Titre de la section du lieu de travail</label>
                    <input type="text" id="input-working-site-title" name="working_site_title" class="input" placeholder="Où travaille un consultant SEO ?">
                </div>

                <div class="form-label-input-container">
                    <label for="input-working-site-text" class="input-title">Texte de la section du lieu de travail</label>
                    <input type="text" id="input-working-site-text" name="working_site_text" class="input" placeholder="Sur Mars">
                </div>

                <div class="form-label-input-container">
                    <label for="input-student-video-title" class="input-title">Titre de la vidéo sur l'étudiant</label>
                    <input type="text" id="input-student-video-title" name="student_video_title" class="input" placeholder="Où se former pour devenir consultant SEO ?">
                </div>

                <div class="form-label-input-container">
                    <label for="input-student-video-link" class="input-title">Lien de la vidéo sur l'étudiant</label>
                    <input type="text" id="input-student-video-link" name="student_video_link" class="input" placeholder="***** À modifier *****" disabled>
                </div>

                <div class="form-label-input-container">
                    <label for="input-money-title" class="input-title">Titre de la section sur la rémunération</label>
                    <input type="text" id="input-money-title" name="money_title" class="input" placeholder="Combien gagne un consultant SEO ?">
                </div>

                <div class="form-label-input-container">
                    <label for="input-money-text" class="input-title">Texte de la section sur la rémunération</label>
                    <input type="text" id="input-money-text" name="money_text" class="input" placeholder="Argentttt">
                </div>

                <div class="form-label-input-container">
                    <label for="input-career-development-title" class="input-title">Titre de la section sur l'évolution de carrière</label>
                    <input type="text" id="input-career-development-title" name="career_development_title" class="input" placeholder="Quelles sont les évolutions possibles après quelques années d’expérience ?">
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn-validation">Créer la page métier</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
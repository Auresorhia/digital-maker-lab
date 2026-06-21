<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Métier</title>
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
                <h1 class="main-title">Modifier le métier</h1>
                <div></div>
            </div>

            <form action="/admin/jobs/<?= $job['id_job'] ?>/update" method="POST" class="form-container">
                
                <div class="form-label-input-container">
                    <label for="input-main-title" class="input-title">Titre principal</label>
                    <input type="text" id="input-main-title" name="main_title" class="input" placeholder="Le métier de consultant SEO" value="<?= htmlspecialchars($job['job_name'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-icon" class="input-title">Icon de spécialité</label>
                    <input type="text" id="input-icon" name="specialty_icon" class="input" placeholder="***** À modifier *****" value="<?= htmlspecialchars($job['specialty_icon'] ?? '') ?>" disabled>
                </div>

                <div class="form-label-input-container">
                    <label for="input-explainer-title" class="input-title">Titre de la partie explainer</label>
                    <input type="text" id="input-explainer-title" name="explainer_title" class="input" placeholder="Le métier de consultant SEO, c’est quoi ?" value="<?= htmlspecialchars($job['explainer_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-explainer-text" class="input-title">Texte de la partie explainer</label>
                    <input type="text" id="input-explainer-text" name="explainer_text" class="input" placeholder="Le métier de consultant SEO, c'est bla-bla-bla" value="<?= htmlspecialchars($job['explainer_text'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-title-pro" class="input-title">Titre de l'interview du professionnel</label>
                    <input type="text" id="input-title-pro" name="interview_pro_title" class="input" placeholder="Tes missions en tant que consultant SEO" value="<?= htmlspecialchars($job['interview_pro_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-link-pro" class="input-title">Lien de l'interview du professionnel</label>
                    <input type="text" id="input-link-pro" name="interview_pro_link" class="input" placeholder="***** À modifier *****" value="<?= htmlspecialchars($job['interview_pro_link'] ?? '') ?>" disabled>
                </div>

                <div class="form-label-input-container">
                    <label for="input-qualities-title" class="input-title">Titre de la section sur les qualités</label>
                    <input type="text" id="input-qualities-title" name="qualities_title" class="input" placeholder="Les compétences indispensables pour être consultant SEO" value="<?= htmlspecialchars($job['qualities_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-one" class="input-title">Titre de la qualité numéro une</label>
                    <input type="text" id="input-quality-number-one" name="quality_1_title" class="input" placeholder="Les qualités incontournables" value="<?= htmlspecialchars($job['quality_1_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-one-text" class="input-title">Texte de la qualité numéro une</label>
                    <input type="text" id="input-quality-number-one-text" name="quality_1_text" class="input" placeholder="Savoir-être" value="<?= htmlspecialchars($job['quality_1_text'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-two" class="input-title">Titre de la qualité numéro deux</label>
                    <input type="text" id="input-quality-number-two" name="quality_2_title" class="input" placeholder="Les compétences techniques" value="<?= htmlspecialchars($job['quality_2_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-two-text" class="input-title">Texte de la qualité numéro deux</label>
                    <input type="text" id="input-quality-number-two-text" name="quality_2_text" class="input" placeholder="Savoir-faire" value="<?= htmlspecialchars($job['quality_2_text'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-three" class="input-title">Titre de la qualité numéro trois</label>
                    <input type="text" id="input-quality-number-three" name="quality_3_title" class="input" placeholder="Les outils que tu vas utiliser" value="<?= htmlspecialchars($job['quality_3_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-quality-number-three-text" class="input-title">Texte de la qualité numéro trois</label>
                    <input type="text" id="input-quality-number-three-text" name="quality_3_text" class="input" placeholder="Exemple d’outils (Semrush, etc)" value="<?= htmlspecialchars($job['quality_3_text'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-working-site-title" class="input-title">Titre de la section du lieu de travail</label>
                    <input type="text" id="input-working-site-title" name="working_site_title" class="input" placeholder="Où travaille un consultant SEO ?" value="<?= htmlspecialchars($job['working_site_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-working-site-text" class="input-title">Texte de la section du lieu de travail</label>
                    <input type="text" id="input-working-site-text" name="working_site_text" class="input" placeholder="Sur Mars" value="<?= htmlspecialchars($job['working_site_text'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-student-video-title" class="input-title">Titre de la vidéo sur l'étudiant</label>
                    <input type="text" id="input-student-video-title" name="student_video_title" class="input" placeholder="Où se former pour devenir consultant SEO ?" value="<?= htmlspecialchars($job['student_video_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-student-video-link" class="input-title">Lien de la vidéo sur l'étudiant</label>
                    <input type="text" id="input-student-video-link" name="student_video_link" class="input" placeholder="***** À modifier *****" value="<?= htmlspecialchars($job['student_video_link'] ?? '') ?>" disabled>
                </div>

                <div class="form-label-input-container">
                    <label for="input-money-title" class="input-title">Titre de la section sur la rémunération</label>
                    <input type="text" id="input-money-title" name="money_title" class="input" placeholder="Combien gagne un consultant SEO ?" value="<?= htmlspecialchars($job['money_title'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-money-text" class="input-title">Texte de la section sur la rémunération</label>
                    <input type="text" id="input-money-text" name="money_text" class="input" placeholder="Argentttt" value="<?= htmlspecialchars($job['money_text'] ?? '') ?>">
                </div>

                <div class="form-label-input-container">
                    <label for="input-career-development-title" class="input-title">Titre de la section sur l'évolution de carrière</label>
                    <input type="text" id="input-career-development-title" name="career_development_title" class="input" placeholder="Quelles sont les évolutions possibles après quelques années d’expérience ?" value="<?= htmlspecialchars($job['career_development_title'] ?? '') ?>">
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn-validation">Modifier la page métier</button>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
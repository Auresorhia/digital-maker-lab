<?php
$articles = [
    [
        'id'          => 1,
        'titre'       => 'TechFest 2026',
        'description' => "L'édition annuel du plus grand rassemblement de l'année.",
        'image'       => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
        'date'        => '12 juin 2026',
        'lieu'        => 'Paris, Grande Halle de la Villette',
        'detail'      => "TechFest 2026 rassemble les plus grandes entreprises tech mondiales pour trois jours d'innovation, de conférences et de networking. Au programme : keynotes exclusifs, démonstrations de produits en avant-première, ateliers pratiques et rencontres avec des experts du secteur. Un événement incontournable pour tous les professionnels du digital.",
    ],
    [
        'id'          => 2,
        'titre'       => 'TechFest 2026',
        'description' => "L'édition annuel du plus grand rassemblement de l'année.",
        'image'       => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=800&q=80',
        'date'        => '14 juin 2026',
        'lieu'        => 'Lyon, Cité Internationale',
        'detail'      => "La deuxième édition régionale de TechFest débarque à Lyon avec un programme axé sur l'intelligence artificielle et la transformation digitale des entreprises. Venez découvrir les dernières innovations en matière d'IA générative, de cybersécurité et de cloud computing.",
    ],
    [
        'id'          => 3,
        'titre'       => 'TechFest 2026',
        'description' => "L'édition annuel du plus grand rassemblement de l'année.",
        'image'       => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
        'date'        => '18 juin 2026',
        'lieu'        => 'Bordeaux, Hangar 14',
        'detail'      => "TechFest Bordeaux met à l'honneur les startups et l'entrepreneuriat digital. Pitchs en direct, tables rondes avec des investisseurs, speed dating professionnel et exposition de projets innovants. L'occasion idéale pour faire décoller votre projet ou trouver les partenaires de demain.",
    ],
    [
        'id'          => 4,
        'titre'       => 'TechFest 2026',
        'description' => "L'édition annuel du plus grand rassemblement de l'année.",
        'image'       => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=800&q=80',
        'date'        => '22 juin 2026',
        'lieu'        => 'Marseille, Palais des Congrès',
        'detail'      => "Cap sur le Sud pour cette édition méditerranéenne de TechFest, dédiée aux technologies vertes et à l'innovation durable. Découvrez comment le numérique peut accélérer la transition écologique à travers des démonstrations, des talks inspirants et des rencontres avec des pionniers du secteur.",
    ],
    [
        'id'          => 5,
        'titre'       => 'AI Summit 2026',
        'description' => "Le sommet mondial dédié à l'intelligence artificielle.",
        'image'       => 'https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=800&q=80',
        'date'        => '25 juin 2026',
        'lieu'        => 'Paris, Palais des Congrès',
        'detail'      => "L'AI Summit 2026 réunit les plus grandes têtes pensantes de l'intelligence artificielle mondiale. Deux jours de conférences de haut niveau, de workshops techniques et de démonstrations live autour des LLM, de la vision par ordinateur, de la robotique et de l'IA appliquée à la santé et à l'industrie.",
    ],
    [
        'id'          => 6,
        'titre'       => 'Web3 Forum',
        'description' => "Blockchain, NFT et décentralisation au cœur du débat.",
        'image'       => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?w=800&q=80',
        'date'        => '30 juin 2026',
        'lieu'        => 'Paris, Station F',
        'detail'      => "Le Web3 Forum réunit développeurs, investisseurs et entrepreneurs autour des technologies décentralisées. Au menu : présentations de protocoles blockchain innovants, débats sur la régulation des cryptomonnaies, démonstrations de DApps et tables rondes sur l'avenir du Web décentralisé.",
    ],
];

$articles_par_page = 4;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$total = count($articles);
$total_pages = ceil($total / $articles_par_page);
$offset = ($page - 1) * $articles_par_page;
$articles_affiches = array_slice($articles, $offset, $articles_par_page);
?>

<!-- ══ Section Actualités ══ -->
<section class="section-actu" id="news">

    <p class="section-label">// 04</p>
    <h2 class="section-title">Actualité et événements</h2>

    <div class="articles-grid">
        <?php foreach ($articles_affiches as $article): ?>
            <div class="article-card"
                onclick="ouvrirPopup(
                 <?= htmlspecialchars(json_encode($article['titre'])) ?>,
                 <?= htmlspecialchars(json_encode($article['image'])) ?>,
                 <?= htmlspecialchars(json_encode($article['date'])) ?>,
                 <?= htmlspecialchars(json_encode($article['lieu'])) ?>,
                 <?= htmlspecialchars(json_encode($article['detail'])) ?>
             )">
                <img src="<?= htmlspecialchars($article['image']) ?>"
                    alt="<?= htmlspecialchars($article['titre']) ?>">
                <div class="card-overlay">
                    <p class="card-title"><?= htmlspecialchars($article['titre']) ?></p>
                    <p class="card-desc"><?= htmlspecialchars($article['description']) ?></p>
                </div>
                <div class="card-arrow">&#8599;</div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cta-wrapper">
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>" class="cta-btn">Découvrir plus d'articles</a>
        <?php else: ?>
            <span class="cta-btn disabled">Plus d'articles disponibles</span>
        <?php endif; ?>
    </div>

</section>

<!-- ══ Popup détail événement ══ -->
<div class="popup-overlay" id="popupOverlay" onclick="fermerPopup(event)">
    <div class="popup">
        <button class="popup-close" type="button" onclick="fermerPopup(null, true)">&#10005;</button>
        <div id="eventDetailView">
            <img id="popupImg" src="" alt="" class="popup-img">
            <div class="popup-body">
                <div class="popup-meta">
                    <span>📅 <span id="popupDate"></span></span>
                    <span>📍 <span id="popupLieu"></span></span>
                </div>
                <h3 class="popup-title" id="popupTitre"></h3>
                <p class="popup-text" id="popupDetail"></p>
                <button type="button" class="popup-cta" onclick="ouvrirPopupInscription()">S'inscrire &agrave; l'&eacute;v&eacute;nement</button>
            </div>
        </div>

        <div class="event-signup-view" id="eventSignupView" hidden>
            <button class="popup-back" type="button" onclick="retourPopupEvenement()" aria-label="Retour au détail de l'événement">←</button>
            <div class="popup-body">
                <p class="popup-signup__eyebrow">Inscription &agrave; l'&eacute;v&eacute;nement</p>
                <h3 class="popup-title" id="signupEventTitle">TechFest 2026</h3>
                <p class="popup-text">Complete ces informations pour confirmer ton inscription.</p>

                <form class="event-signup-form" id="eventSignupForm">
                    <label>
                        Nom
                        <input type="text" name="nom" required>
                    </label>
                    <label>
                        Prenom
                        <input type="text" name="prenom" required>
                    </label>
                    <label>
                        Classe
                        <input type="text" name="classe" required>
                    </label>
                    <label>
                        Email
                        <input type="email" name="email" required>
                    </label>

                    <button type="submit" class="popup-cta event-signup-form__submit">Valider l'inscription</button>
                    <p class="event-signup-success" id="eventSignupSuccess" hidden>Inscription confirmee, merci !</p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function ouvrirPopup(titre, image, date, lieu, detail) {
        document.getElementById('popupTitre').textContent = titre;
        document.getElementById('popupImg').src = image;
        document.getElementById('popupImg').alt = titre;
        document.getElementById('popupDate').textContent = date;
        document.getElementById('popupLieu').textContent = lieu;
        document.getElementById('popupDetail').textContent = detail;
        document.getElementById('signupEventTitle').textContent = titre;
        document.getElementById('eventDetailView').hidden = false;
        document.getElementById('eventSignupView').hidden = true;
        document.getElementById('eventSignupSuccess').hidden = true;
        document.getElementById('eventSignupForm').reset();
        document.getElementById('popupOverlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function fermerPopup(event, force) {
        if (force || (event && event.target === document.getElementById('popupOverlay'))) {
            document.getElementById('popupOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    function ouvrirPopupInscription() {
        document.getElementById('eventDetailView').hidden = true;
        document.getElementById('eventSignupView').hidden = false;
        document.getElementById('eventSignupSuccess').hidden = true;
        document.getElementById('eventSignupForm').reset();
    }

    function retourPopupEvenement() {
        document.getElementById('eventSignupView').hidden = true;
        document.getElementById('eventDetailView').hidden = false;
    }

    document.getElementById('eventSignupForm').addEventListener('submit', function(event) {
        event.preventDefault();
        event.currentTarget.reset();
        document.getElementById('eventSignupSuccess').hidden = false;
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            fermerPopup(null, true);
        }
    });
</script>

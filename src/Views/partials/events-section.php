
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Maker Lab – Actualités</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
 
        body {
            background-color: #eeeef5;
            font-family: 'Courier New', Courier, monospace;
            color: #1a1a2e;
        }
 
        /* ── Section principale ── */
        .section-actu {
            padding: 40px 40px 60px;
            max-width: 1100px;
            margin: 0 auto;
        }
 
        .section-label { font-size: 0.85rem; color: #5b5bcc; letter-spacing: 0.05em; margin-bottom: 6px; }
        .section-title { font-size: 1.5rem; font-weight: 400; color: #5b5bcc; letter-spacing: 0.03em; margin-bottom: 36px; }
 
        /* ── Grille ── */
        .articles-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 44px;
        }
 
        /* ── Carte ── */
        .article-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            aspect-ratio: 16 / 9;
            display: block;
            text-decoration: none;
            cursor: pointer;
        }
 
        .article-card img {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform 0.4s ease;
        }
        .article-card:hover img { transform: scale(1.04); }
 
        .card-overlay {
            position: absolute; bottom: 14px; left: 14px; right: 48px;
            background: rgba(255,255,255,0.93); border-radius: 12px; padding: 12px 14px;
        }
        .card-title { font-family: 'Courier New', monospace; font-size: 0.88rem; font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
        .card-desc  { font-family: Arial, sans-serif; font-size: 0.75rem; color: #555; line-height: 1.4; }
 
        .card-arrow {
            position: absolute; bottom: 18px; right: 14px;
            width: 30px; height: 30px; background: rgba(255,255,255,0.93);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: #1a1a2e; transition: background 0.2s, color 0.2s;
        }
        .article-card:hover .card-arrow { background: #5b5bcc; color: #fff; }
 
        /* ── CTA ── */
        .cta-wrapper { display: flex; justify-content: center; }
        .cta-btn {
            display: inline-block; padding: 15px 56px;
            background: linear-gradient(135deg, #a78bfa 0%, #818cf8 100%);
            color: #fff; font-family: Arial, sans-serif; font-size: 0.92rem;
            border-radius: 50px; text-decoration: none;
            transition: opacity 0.2s, transform 0.2s;
        }
        .cta-btn:hover { opacity: 0.88; transform: translateY(-1px); }
        .cta-btn.disabled { opacity: 0.4; pointer-events: none; }
 
        /* ── Footer ── */
        .site-footer {
            background-color: #e8400a;
            padding: 40px 40px 24px;
            display: flex; justify-content: space-between; align-items: flex-start; gap: 24px;
        }
        .footer-left  { display: flex; gap: 48px; align-items: flex-start; }
        .footer-nav   { display: flex; flex-direction: column; gap: 8px; }
        .footer-nav a { color: #fff; text-decoration: none; font-family: Arial, sans-serif; font-size: 0.72rem; letter-spacing: 0.08em; text-transform: uppercase; opacity: 0.88; }
        .footer-nav a:hover { opacity: 1; text-decoration: underline; }
        .footer-socials { display: flex; flex-direction: column; gap: 14px; padding-top: 2px; }
        .footer-socials a svg { fill: white; opacity: 0.9; display: block; }
        .footer-socials a:hover svg { opacity: 1; }
        .footer-right { display: flex; flex-direction: column; align-items: flex-end; gap: 6px; }
        .footer-logo-stack { display: flex; flex-direction: column; align-items: flex-start; }
        .logo-digital { font-family: Arial Black, Arial, sans-serif; font-size: 3.2rem; font-weight: 900; color: #fff; line-height: 1; letter-spacing: -0.01em; }
        .logo-row     { display: flex; align-items: baseline; }
        .logo-maker   { font-family: Arial Black, Arial, sans-serif; font-size: 3.2rem; font-weight: 900; color: #fff; line-height: 1; letter-spacing: -0.01em; }
        .logo-lab     { font-family: Arial Black, Arial, sans-serif; font-size: 4.4rem; font-weight: 900; color: rgba(255,255,255,0.2); line-height: 1; letter-spacing: -0.01em; }
        .footer-copy  { font-family: Arial, sans-serif; font-size: 0.68rem; color: rgba(255,255,255,0.45); }
 
        /* ── Popup ── */
        .popup-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 1000;
            align-items: center; justify-content: center;
        }
        .popup-overlay.active { display: flex; }
 
        .popup {
            background: #fff;
            border-radius: 20px;
            max-width: 600px;
            width: 90%;
            overflow: hidden;
            position: relative;
            animation: popIn 0.25s ease;
        }
        @keyframes popIn {
            from { transform: scale(0.92); opacity: 0; }
            to   { transform: scale(1);    opacity: 1; }
        }
 
        .popup-img {
            width: 100%; height: 220px; object-fit: cover; display: block;
        }
 
        .popup-body { padding: 28px 30px 30px; }
 
        .popup-meta {
            display: flex; gap: 20px; margin-bottom: 14px;
        }
        .popup-meta span {
            font-family: Arial, sans-serif; font-size: 0.78rem; color: #5b5bcc;
            display: flex; align-items: center; gap: 5px;
        }
 
        .popup-title { font-family: 'Courier New', monospace; font-size: 1.3rem; font-weight: 700; color: #1a1a2e; margin-bottom: 14px; }
        .popup-text  { font-family: Arial, sans-serif; font-size: 0.88rem; color: #444; line-height: 1.7; }
 
        .popup-close {
            position: absolute; top: 14px; right: 14px;
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.9); border: none; cursor: pointer;
            font-size: 1.1rem; color: #1a1a2e;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .popup-close:hover { background: #fff; }
 
        .popup-cta {
            display: inline-block; margin-top: 22px; padding: 12px 32px;
            background: linear-gradient(135deg, #a78bfa, #818cf8);
            color: #fff; font-family: Arial, sans-serif; font-size: 0.88rem;
            border-radius: 50px; text-decoration: none; transition: opacity 0.2s;
        }
        .popup-cta:hover { opacity: 0.88; }
 
        /* ── Responsive ── */
        @media (max-width: 700px) {
            .articles-grid { grid-template-columns: 1fr; }
            .site-footer   { flex-direction: column; }
            .logo-digital, .logo-maker { font-size: 2.2rem; }
            .logo-lab { font-size: 3rem; }
        }
    </style>
</head>
<body>
 
<!-- ══ Section Actualités ══ -->
<section class="section-actu">
 
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
        <button class="popup-close" onclick="fermerPopup(null, true)">&#10005;</button>
        <img id="popupImg" src="" alt="" class="popup-img">
        <div class="popup-body">
            <div class="popup-meta">
                <span>📅 <span id="popupDate"></span></span>
                <span>📍 <span id="popupLieu"></span></span>
            </div>
            <h3 class="popup-title" id="popupTitre"></h3>
            <p class="popup-text" id="popupDetail"></p>
            <a href="#" class="popup-cta">S'inscrire à l'événement</a>
        </div>
    </div>
</div>
 
<!-- ══ Footer ══ -->
<footer class="site-footer">
    <div class="footer-left">
        <nav class="footer-nav">
            <a href="#">Accueil</a>
            <a href="#">À propos</a>
            <a href="#">Les métiers du digital</a>
            <a href="#">Actualités</a>
        </nav>
        <div class="footer-socials">
            <a href="#" aria-label="YouTube">
                <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M23.5 6.2s-.2-1.6-.9-2.3c-.9-.9-1.9-.9-2.3-1C17.5 2.7 12 2.7 12 2.7s-5.5 0-8.3.2c-.4.1-1.4.1-2.3 1C.7 4.6.5 6.2.5 6.2S.3 8 .3 9.8v1.7c0 1.8.2 3.6.2 3.6s.2 1.6.9 2.3c.9.9 2 .9 2.6 1C5.8 18.6 12 18.6 12 18.6s5.5 0 8.3-.2c.4-.1 1.4-.1 2.3-1 .7-.7.9-2.3.9-2.3s.2-1.8.2-3.6V9.8c0-1.8-.2-3.6-.2-3.6zM9.7 13.8V7.4l6.3 3.2-6.3 3.2z"/>
                </svg>
            </a>
            <a href="#" aria-label="Instagram">
                <svg width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2.2c3.2 0 3.6 0 4.9.1 3.3.1 4.8 1.7 4.9 4.9.1 1.3.1 1.6.1 4.8 0 3.2 0 3.6-.1 4.8-.1 3.2-1.7 4.8-4.9 4.9-1.3.1-1.6.1-4.9.1-3.2 0-3.6 0-4.8-.1-3.3-.1-4.8-1.7-4.9-4.9C2.2 15.6 2.2 15.3 2.2 12c0-3.2 0-3.6.1-4.8C2.4 3.9 4 2.3 7.2 2.3c1.2-.1 1.6-.1 4.8-.1zm0-2.2C8.7 0 8.3 0 7.1.1 2.7.3.3 2.7.1 7.1 0 8.3 0 8.7 0 12c0 3.3 0 3.7.1 4.9.2 4.4 2.6 6.8 7 7C8.3 24 8.7 24 12 24c3.3 0 3.7 0 4.9-.1 4.4-.2 6.8-2.6 7-7C24 15.7 24 15.3 24 12c0-3.3 0-3.7-.1-4.9-.2-4.3-2.6-6.8-7-7C15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4A6.2 6.2 0 0 0 12 5.8zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.44 1.44 0 1 0 0 2.88 1.44 1.44 0 0 0 0-2.88z"/>
                </svg>
            </a>
        </div>
    </div>
 
    <div class="footer-right">
        <div class="footer-logo-stack">
            <span class="logo-digital">DIGITAL</span>
            <div class="logo-row">
                <span class="logo-maker">MAKER</span>
                <span class="logo-lab">LAB</span>
            </div>
        </div>
        <p class="footer-copy">Tous droits réservés, 2026 – made by DC Paris</p>
    </div>
</footer>
 
<script>
function ouvrirPopup(titre, image, date, lieu, detail) {
    document.getElementById('popupTitre').textContent  = titre;
    document.getElementById('popupImg').src            = image;
    document.getElementById('popupImg').alt            = titre;
    document.getElementById('popupDate').textContent   = date;
    document.getElementById('popupLieu').textContent   = lieu;
    document.getElementById('popupDetail').textContent = detail;
    document.getElementById('popupOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}
 
function fermerPopup(event, force) {
    if (force || (event && event.target === document.getElementById('popupOverlay'))) {
        document.getElementById('popupOverlay').classList.remove('active');
        document.body.style.overflow = '';
    }
}
 
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') fermerPopup(null, true);
});
</script>
 
</body>
</html>
 
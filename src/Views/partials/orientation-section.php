<link rel="stylesheet" href="assets/css/orientation.css">

<section class="orientation-preview" id="orientation" aria-labelledby="orientation-title">
    <div class="orientation-preview__cards" aria-hidden="true">
        <div class="orientation-preview__card">
            <img src="assets/images/finder/icon-cursor.webp" alt="">
            <span>Tu aimes r&eacute;soudre des probl&egrave;mes et construire des solutions&nbsp;?</span>
        </div>
        <div class="orientation-preview__card">
            <img src="assets/images/finder/icon-cursor.webp" alt="">
            <span>Tu es cr&eacute;atif et tu aimes imaginer des univers visuels&nbsp;?</span>
        </div>
        <div class="orientation-preview__card">
            <img src="assets/images/finder/icon-cursor.webp" alt="">
            <span>Tu aimes communiquer, convaincre et faire conna&icirc;tre des projets&nbsp;?</span>
        </div>
        <div class="orientation-preview__card">
            <img src="assets/images/finder/icon-cursor.webp" alt="">
            <span>Tu aimes organiser des projets et travailler avec diff&eacute;rents profils&nbsp;?</span>
        </div>
        <div class="orientation-preview__card">
            <img src="assets/images/finder/icon-cursor.webp" alt="">
            <span>Tu aimes cr&eacute;er des vid&eacute;os et raconter des histoires en images&nbsp;?</span>
        </div>
    </div>

    <div class="orientation-preview__content">
        <div class="orientation-preview__heading">
            <p class="section-label">// 03</p>
            <h2 class="section-title" id="orientation-title">Comment savoir quel m&eacute;tier est fait pour toi&nbsp;?</h2>
        </div>
        <div class="orientation-preview__body">
            <p>D&eacute;couvre les diff&eacute;rentes sp&eacute;cialit&eacute;s du digital et identifie celles qui correspondent le mieux &agrave; tes centres d'int&eacute;r&ecirc;t, tes qualit&eacute;s et tes envies.</p>
            <p>Notre bot d&rsquo;orientation te pose quelques questions simples pour t&rsquo;aider &agrave; trouver les m&eacute;tiers du digital qui pourraient te correspondre.</p>
        </div>
        <button class="orientation-preview__button" type="button">Faire le test&nbsp;!</button>
    </div>
</section>

<div class="orientation-modal" id="orientation-modal" aria-hidden="true">
    <div class="orientation-modal__backdrop" data-orientation-close></div>
    <section class="orientation-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="orientation-modal-title">
        <div class="orientation-modal__panel">
            <header class="orientation-modal__hero">
                <button class="orientation-modal__close" type="button" aria-label="Fermer le questionnaire" data-orientation-close>&times;</button>
                <h2 id="orientation-modal-title">QUESTIONNAIRES<br>D&rsquo;ORIENTATION</h2>
            </header>
            <div class="orientation-modal__content" data-orientation-content></div>
        </div>
    </section>
</div>

<script src="assets/js/orientation.js" defer></script>

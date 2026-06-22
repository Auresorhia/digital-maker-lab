<?php
$metiersPath = __DIR__ . '/../../metiers_articles';

function blogEscape($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function blogArticleFromText($text, $fallbackTitle)
{
    $text = str_replace(["\r\n", "\r"], "\n", trim($text));
    $lines = array_values(array_filter(array_map('trim', explode("\n", $text)), static function ($line) {
        return $line !== '';
    }));

    $title = $fallbackTitle;
    $sommaire = [];
    $html = '';
    $hasTitle = false;
    $introDone = false;

    foreach ($lines as $line) {
        if (preg_match('/<img\b/i', $line)) {
            continue;
        }

        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/i', $line, $match)) {
            $title = trim(strip_tags($match[1]));
            $html .= '<h1 class="article__title">' . blogEscape($title) . '</h1>';
            $hasTitle = true;
            continue;
        }

        if (preg_match('/<h[23][^>]*>(.*?)<\/h[23]>/i', $line, $match)) {
            $heading = trim(strip_tags($match[1]));
            $sommaire[] = $heading;
            $html .= '<h2 class="article__h2">' . blogEscape($heading) . '</h2>';
            continue;
        }

        $plainLine = trim(strip_tags($line));

        if (!$hasTitle) {
            $title = $plainLine;
            $html .= '<h1 class="article__title">' . blogEscape($title) . '</h1>';
            $hasTitle = true;
            continue;
        }

        if (strtolower($plainLine) === 'introduction') {
            continue;
        }

        $isHeading = strlen($plainLine) <= 120
            && !preg_match('/[.;:]$/u', $plainLine);

        if ($isHeading) {
            $sommaire[] = $plainLine;
            $html .= '<h2 class="article__h2">' . blogEscape($plainLine) . '</h2>';
            continue;
        }

        $className = $introDone ? 'article__p' : 'article__intro';
        $html .= '<p class="' . $className . '">' . blogEscape($plainLine) . '</p>';
        $introDone = true;
    }

    return [
        'title' => $title,
        'tag' => 'Découverte du métier',
        'sommaire' => array_values(array_slice(array_unique($sommaire), 0, 8)),
        'content' => $html,
    ];
}

function blogBuildMetiers($metiersPath)
{
    if (!is_dir($metiersPath)) {
        return [];
    }

    $labels = [
        "créateur d'entreprise" => "Créateur d'entreprise",
        'developpeur web' => 'Développeur web',
        'consultant SEO' => 'Consultant SEO',
        'community manager' => 'Community manager',
        'designer' => 'Graphiste',
        'responsable CRM' => 'Responsable CRM',
        'game designer' => 'Game designer',
        'videaste' => 'Vidéaste',
    ];
    $order = array_keys($labels);
    $directories = array_filter(glob($metiersPath . '/*'), 'is_dir');

    usort($directories, static function ($a, $b) use ($order) {
        $aName = basename($a);
        $bName = basename($b);
        $aRank = array_search($aName, $order, true);
        $bRank = array_search($bName, $order, true);
        return ($aRank === false ? 99 : $aRank) <=> ($bRank === false ? 99 : $bRank);
    });

    $metiers = [];

    foreach ($directories as $index => $directory) {
        $folderName = basename($directory);
        $files = glob($directory . '/*.txt');
        sort($files, SORT_NATURAL | SORT_FLAG_CASE);

        $articles = [];
        foreach ($files as $file) {
            if (filesize($file) === 0) {
                continue;
            }

            $content = file_get_contents($file);
            if (trim($content) === '') {
                continue;
            }

            $articles[] = blogArticleFromText($content, pathinfo($file, PATHINFO_FILENAME));
        }

        if (!$articles) {
            continue;
        }

        $metiers['metier_' . $index] = [
            'label' => $labels[$folderName] ?? ucfirst($folderName),
            'articles' => $articles,
            'links' => [],
        ];
    }

    return $metiers;
}

$blogMetiers = blogBuildMetiers($metiersPath);
$firstMetierKey = array_key_first($blogMetiers);
$firstMetierLabel = $firstMetierKey ? $blogMetiers[$firstMetierKey]['label'] : 'Blog';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Digital Maker Lab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/design-system.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-family-main);
            background-color: #0f0f0f;
            color: #d4d4d4;
            min-height: 100vh;
        }

        /* ── TOP BAR ── */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 24px;
            border-bottom: 1px solid #1e1e1e;
            background: #0f0f0f;
            position: sticky;
            top: 0;
            z-index: 100;
            height: 44px;
        }

        .topbar__left {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 400;
            font-style: normal;
            font-size: 12px;
            line-height: 16px;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #FF6B35;
        }

        .topbar__breadcrumb {
            font-size: 12px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .topbar__breadcrumb a { color: #555; text-decoration: none; transition: color var(--transition-fast); }
        .topbar__breadcrumb a:hover { color: #fff; }
        .topbar__breadcrumb .sep { color: #333; }
        .topbar__breadcrumb .current { color: #aaa; }

        /* ── DROPDOWN ── */
        .dropdown { position: relative; }

        .dropdown__btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 191px;
            height: 38px;
            padding: 8px 16px;
            background: transparent;
            color: var(--color-brand-orange);
            border: 1px solid #FF6B35;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            font-family: var(--font-family-main);
            cursor: pointer;
            transition: background var(--transition-fast), opacity var(--transition-fast);
            white-space: nowrap;
            opacity: 1;
        }
        .dropdown__btn:hover { background: #FF6B350D; }
        .dropdown__btn .arrow { transition: transform var(--transition-fast); display: inline-block; color: var(--color-brand-orange); }
        .dropdown.is-open .dropdown__btn .arrow { transform: rotate(180deg); }

        .dropdown__menu {
            display: none;
            position: absolute;
            top: calc(100% + 6px);
            right: 0;
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: var(--radius-card);
            min-width: 220px;
            overflow: hidden;
            box-shadow: 0 16px 48px rgba(0,0,0,0.7);
        }
        .dropdown.is-open .dropdown__menu { display: block; }

        .dropdown__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            font-size: 13px;
            color: #999;
            text-decoration: none;
            border-bottom: 1px solid #222;
            transition: background var(--transition-fast), color var(--transition-fast);
            cursor: pointer;
        }
        .dropdown__item:last-child { border-bottom: none; }
        .dropdown__item:hover { background: #222; color: #fff; }
        .dropdown__item.active { color: var(--color-brand-orange); font-weight: 700; }
        .dropdown__item .badge {
            font-size: 10px;
            background: #2a2a2a;
            color: #666;
            padding: 2px 6px;
            border-radius: 4px;
        }
        .dropdown__item.active .badge { background: rgba(255,107,53,0.15); color: var(--color-brand-orange); }

        .blog-main-nav-wrap {
            display: flex;
            justify-content: center;
            padding: 24px 20px 18px;
            background: #0f0f0f;
        }

        .blog-main-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            width: min(647px, calc(100vw - 40px));
            height: 56px;
            padding: 6px;
            background: #555553;
            border-radius: 18px;
            overflow: hidden;
        }

        .blog-main-nav__link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            padding: 0 16px;
            border-radius: 18px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            white-space: nowrap;
            transition: background var(--transition-fast), color var(--transition-fast);
        }

        .blog-main-nav__link:hover,
        .blog-main-nav__link.active {
            background: #ff6334;
            color: #fff;
            font-weight: 800;
        }

        /* ── LAYOUT ── */
        .blog-layout {
            position: relative;
            min-height: calc(100vh - 146px);
        }

        /* ── SIDEBAR ── */
        .sidebar {
            border-right: 1px solid #1a1a1a;
            padding: 28px 16px 40px;
            position: fixed;
            top: 146px;
            left: 20px;
            width: 288px;
            height: calc(100vh - 170px);
            opacity: 1;
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 2px; }

        .sidebar__label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #444;
            margin-bottom: 14px;
            padding: 0 4px;
            font-family: 'JetBrains Mono', monospace;
        }

        .sidebar__articles { display: flex; flex-direction: column; gap: 2px; margin-bottom: 28px; }

        .sidebar__article {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            transition: background var(--transition-fast);
        }
        .sidebar__article:hover { background: #161616; }
        .sidebar__article.active {
            background: #FF6B3515;
            border-top: 1px solid #FF6B3540;
        }

        .sidebar__num {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            background: #1c1c1c;
            border: 1px solid #2a2a2a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            color: #555;
            flex-shrink: 0;
            transition: all var(--transition-fast);
            font-family: 'JetBrains Mono', monospace;
        }
        .sidebar__article.active .sidebar__num {
            background: var(--color-brand-orange);
            border-color: var(--color-brand-orange);
            color: #fff;
        }

        .sidebar__art-title {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            line-height: 1.45;
            padding-top: 4px;
            transition: color var(--transition-fast);
        }
        .sidebar__article.active .sidebar__art-title { color: #ccc; }
        .sidebar__article:hover .sidebar__art-title { color: #bbb; }

        .sidebar__divider { height: 1px; background: #1a1a1a; margin: 20px 4px; }

        .sommaire__list { display: flex; flex-direction: column; gap: 2px; }
        .sommaire__item {
            width: 100%;
            background: transparent;
            font-family: inherit;
            text-align: left;
            font-size: 12px;
            color: #555;
            text-decoration: none;
            padding: 7px 10px;
            border-radius: 6px;
            border: 1px solid transparent;
            transition: all var(--transition-fast);
            line-height: 1.4;
            cursor: pointer;
            display: block;
        }
        .sommaire__item { cursor: pointer; pointer-events: auto; }
        .sommaire__item.active { color: var(--color-brand-orange); border: 1px solid #FF6B35; background: #FF6B350D; }

        /* ── PROGRESS BARS ── */
        .progress-bars {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 0 4px;
            margin-top: 14px;
        }
        .progress-bar {
            flex: 1;
            height: 3px;
            background: #2a2a2a;
            border-radius: 2px;
            transition: background var(--transition-fast);
        }
        .progress-bar.active { background: var(--color-brand-orange); }
        .progress-sep { color: #2e2e2e; font-size: 10px; flex-shrink: 0; }

        /* ── ARTICLE ── */
        .article {
            padding: 44px 60px 80px;
            position: absolute;
            left: 335px;
            width: 864px;
            min-height: 2721.5px;
            opacity: 1;
        }

        .article__tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: auto;
            height: 26px;
            border-radius: 999px;
            background: #FF6B351A;
            border: 1px solid #FF6B3533;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
            color: var(--color-brand-orange);
            margin-bottom: 20px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            white-space: nowrap;
            opacity: 1;
            font-family: 'JetBrains Mono', monospace;
        }
        .article__tag::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--color-brand-orange);
            flex-shrink: 0;
        }

        .article__title {
            font-size: clamp(24px, 2.8vw, 36px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 22px;
        }

        .article__intro {
            font-size: 14px;
            color: #777;
            line-height: 1.75;
            margin-bottom: 36px;
            padding-bottom: 36px;
            border-bottom: 1px solid #1a1a1a;
        }

        .article__h2 {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
            margin-top: 36px;
        }

        .article__p {
            font-size: 14px;
            color: #888;
            line-height: 1.8;
            margin-bottom: 12px;
        }

        .article__list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 12px 0 12px 2px;
        }
        .article__list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 14px;
            color: #888;
            line-height: 1.6;
        }
        .article__list li::before {
            content: "→";
            color: var(--color-brand-orange);
            flex-shrink: 0;
        }

        .article__callout {
            background: #161616;
            border: 1px solid #252525;
            border-radius: 12px;
            padding: 20px 24px;
            margin: 28px 0;
            font-size: 14px;
            color: #bbb;
            line-height: 1.75;
            font-style: normal;
        }
        .article__callout-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--color-brand-orange);
            margin-bottom: 12px;
            font-family: 'JetBrains Mono', monospace;
        }

        .article__divider { height: 1px; background: #1a1a1a; margin: 40px 0; }

        .article__next {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 767px;
            height: 80px;
            border-radius: 12px;
            padding: 20px;
            background: linear-gradient(135deg, #FF6B35 0%, #C74E1A 100%);
            text-decoration: none;
            opacity: 1;
            transition: opacity var(--transition-fast);
            border: none;
        }
        .article__next:hover { opacity: 0.88; }
        .article__next-label { font-size: 10px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.65); margin-bottom: 4px; font-family: 'JetBrains Mono', monospace; }
        .article__next-title { font-size: 14px; font-weight: 800; color: #fff; }
        .article__next-arrow { font-size: 22px; color: #fff; flex-shrink: 0; margin-left: 16px; }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .blog-main-nav-wrap { padding: 16px 12px; overflow-x: auto; justify-content: flex-start; }
            .blog-main-nav { width: 647px; min-width: 647px; }
            .blog-layout { grid-template-columns: 1fr; }
            .sidebar { display: none; }
            .article { padding: 24px 20px 60px; }
            .topbar__breadcrumb { display: none; }
        }
    </style>
</head>
<body>

<!-- TOP BAR -->
<header class="topbar">
    <span class="topbar__left">Blog</span>

    <nav class="topbar__breadcrumb">
        <a href="/">Digital Maker Lab</a>
        <span class="sep">/</span>
        <span class="current" id="topbar-metier"><?= blogEscape($firstMetierLabel) ?></span>
    </nav>

    <div class="dropdown" id="dropdown">
        <button class="dropdown__btn" onclick="toggleDropdown()">
            Changer de métier <span class="arrow">▾</span>
        </button>
        <div class="dropdown__menu">
            <?php foreach ($blogMetiers as $key => $metier): ?>
                <a class="dropdown__item <?= $key === $firstMetierKey ? 'active' : '' ?>" data-key="<?= blogEscape($key) ?>" onclick="switchMetier('<?= blogEscape($key) ?>', this)">
                    <?= blogEscape($metier['label']) ?> <span class="badge"><?= $key === $firstMetierKey ? 'actif' : count($metier['articles']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<div class="blog-main-nav-wrap">
    <nav class="blog-main-nav" aria-label="Navigation principale">
        <a class="blog-main-nav__link" href="/">Accueil</a>
        <a class="blog-main-nav__link" href="/#about">À Propos</a>
        <a class="blog-main-nav__link" href="/#jobs">Métiers Du Digital</a>
        <a class="blog-main-nav__link" href="/#news">Actualités</a>
        <a class="blog-main-nav__link active" href="/blog">Blog</a>
    </nav>
</div>

<!-- LAYOUT -->
<div class="blog-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <p class="sidebar__label">Parcours du lecteur</p>
        <div class="sidebar__articles" id="sidebar-articles"></div>

        <div class="progress-bars">
            <span class="progress-bar active" id="pb-0"></span>
            <span class="progress-sep">›</span>
            <span class="progress-bar" id="pb-1"></span>
            <span class="progress-sep">›</span>
            <span class="progress-bar" id="pb-2"></span>
        </div>

        <div class="sidebar__divider"></div>

        <p class="sidebar__label">/ Sommaire</p>
        <div class="sommaire__list" id="sidebar-sommaire"></div>
    </aside>

    <!-- ARTICLE -->
    <main class="article" id="article-content"></main>

</div>

<script>
    /* ── DONNÉES PAR MÉTIER ── */
    const metiers = <?= json_encode($blogMetiers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    let currentMetier = Object.keys(metiers)[0] || '';
    let currentArticle = 0;

    function toggleDropdown() {
        document.getElementById('dropdown').classList.toggle('is-open');
    }

    document.addEventListener('click', function(e) {
        const d = document.getElementById('dropdown');
        if (!d.contains(e.target)) d.classList.remove('is-open');
    });

    function switchMetier(key, el) {
        currentMetier = key;
        currentArticle = 0;
        document.querySelectorAll('.dropdown__item').forEach(i => {
            const itemKey = i.dataset.key;
            i.classList.remove('active');
            i.querySelector('.badge').textContent = metiers[itemKey].articles.length;
        });
        el.classList.add('active');
        el.querySelector('.badge').textContent = 'actif';
        document.getElementById('topbar-metier').textContent = metiers[key].label;
        document.getElementById('dropdown').classList.remove('is-open');
        render();
    }

    function showArticle(idx) {
        currentArticle = idx;
        currentSommaire = 0;
        render();
    }

    let currentSommaire = 0;

    function render() {
        const m = metiers[currentMetier];
        const arts = m.articles;
        const art = arts[currentArticle];
        const nextArt = arts[currentArticle + 1] || null;

        /* Sidebar articles */
        document.getElementById('sidebar-articles').innerHTML = arts.map((a, i) => `
            <a class="sidebar__article ${i === currentArticle ? 'active' : ''}" onclick="showArticle(${i}); return false;" href="#">
                <span class="sidebar__num">0${i + 1}</span>
                <span class="sidebar__art-title">${a.title}</span>
            </a>
        `).join('');

        /* Progress bars */
        document.querySelectorAll('.progress-bar').forEach((bar, i) => {
            bar.classList.toggle('active', i === currentArticle);
        });

        /* Sidebar sommaire */
        document.getElementById('sidebar-sommaire').innerHTML = art.sommaire.map((s, i) => `
            <button class="sommaire__item ${i === 0 ? 'active' : ''}" onclick="scrollToSection(${i})">${s}</button>
        `).join('');

        /* Article content */
        document.getElementById('article-content').innerHTML =
            `<span class="article__tag">${art.tag}</span>` +
            art.content + `
            ${nextArt ? `
                <div class="article__divider"></div>
                <a href="#" class="article__next" onclick="showArticle(${currentArticle + 1}); return false;">
                    <div>
                        <p class="article__next-label">Article suivant</p>
                        <p class="article__next-title">${nextArt.title}</p>
                    </div>
                    <span class="article__next-arrow">→</span>
                </a>
            ` : ''}
        `;

        /* Ajouter des IDs aux h2 et observer le scroll */
        const h2s = document.querySelectorAll('#article-content .article__h2');
        h2s.forEach((h2, i) => { h2.id = 'section-' + i; });

        if (window._sectionObserver) window._sectionObserver.disconnect();
        window._sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const idx = parseInt(entry.target.id.replace('section-', ''));
                    document.querySelectorAll('.sommaire__item').forEach((el, i) => {
                        el.classList.toggle('active', i === idx);
                    });
                }
            });
        }, { rootMargin: '-15% 0px -75% 0px', threshold: 0 });

        h2s.forEach(h2 => window._sectionObserver.observe(h2));
    }

    function activeSommaire(idx) {
        currentSommaire = idx;
        document.querySelectorAll('.sommaire__item').forEach((el, i) => {
            el.classList.toggle('active', i === idx);
        });
    }

    function scrollToSection(idx) {
        const section = document.getElementById('section-' + idx);
        if (!section) return;
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        activeSommaire(idx);
    }

    render();
</script>
</body>
</html>

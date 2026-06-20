<?php
if (!isset($_SESSION['admin_id'])) {
    header('Location: /login');
    exit;
}
$basePath = rtrim(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Digital Maker Lab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/design-system.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-family-main);
            background-color: var(--color-background);
            min-height: 100vh;
        }

        /* --- NAVBAR --- */
        .admin-nav {
            background-color: var(--color-dark);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: var(--spacing-lg);
        }

        .admin-nav__logo {
            height: 36px;
            width: auto;
        }

        .admin-nav__right {
            display: flex;
            align-items: center;
            gap: var(--spacing-lg);
        }

        .admin-nav__user {
            color: var(--color-white);
            font-size: 14px;
            font-weight: 600;
            opacity: 0.8;
        }

        .btn-logout {
            background: linear-gradient(90deg, #FF8B6B 0%, #FF6B35 100%);
            color: var(--color-white);
            padding: 10px 24px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 107, 53, 0.4);
        }

        /* --- CONTENU --- */
        .admin-container {
            max-width: 1200px;
            margin: var(--spacing-3xl) auto;
            padding: 0 var(--spacing-xl);
        }

        .admin-welcome {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--spacing-md);
            text-align: center;
            padding: var(--spacing-3xl) var(--spacing-lg);
            background: var(--color-white);
            border-radius: var(--radius-card);
        }

        .admin-welcome__badge {
            background: var(--color-brand-orange);
            color: var(--color-white);
            font-size: 15px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 32px;
            border-radius: 16px;
        }

        .admin-welcome__title {
            font-size: 28px;
            font-weight: 900;
            color: var(--color-dark);
        }

        .admin-welcome__sub {
            color: #777;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .admin-nav { padding: 14px 20px; }
            .admin-nav__logo { height: 28px; }
            .admin-container { padding: 0 var(--spacing-md); margin: var(--spacing-xl) auto; }
        }
    </style>
</head>
<body>

    <nav class="admin-nav">
        <img class="admin-nav__logo" src="<?= $basePath ?>/assets/images/logos/logo_digital_maker_lab_orange.webp" alt="Digital Maker Lab">
        <div class="admin-nav__right">
            <span class="admin-nav__user"><?= htmlspecialchars($_SESSION['admin_identifiant'] ?? 'Admin') ?></span>
            <a href="/logout" class="btn-logout">Déconnexion</a>
        </div>
    </nav>

    <div class="admin-container">
        <div class="admin-welcome">
            <div class="admin-welcome__badge">Espace Admin</div>
            <p class="admin-welcome__title">Bienvenue, <?= htmlspecialchars($_SESSION['admin_identifiant'] ?? 'Admin') ?> !</p>
            <p class="admin-welcome__sub">Vous êtes connecté au CMS de Digital Maker Lab.</p>
        </div>
    </div>

</body>
</html>
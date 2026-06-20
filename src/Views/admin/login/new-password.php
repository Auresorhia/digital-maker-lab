<?php $basePath = rtrim(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe - Digital Maker Lab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $basePath ?>/assets/css/design-system.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-family-main);
            background-color: var(--color-white);
            background-repeat: repeat;
            background-size: 1244px auto;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .login-icon { position: fixed; pointer-events: none; user-select: none; }
        .login-icon--dev    { top: 0px; left: -10px; width: 176px; transform: rotate(13.15deg); opacity: 1; }
        .login-icon--like   { top: 145px; left: 1082px; width: 157px; transform: rotate(-25deg); opacity: 1; }
        .login-icon--camera { top: 563px; left: 917px; width: 296px; opacity: 1; }
        .login-icon--micro  { top: 466px; left: -40px; width: 367px; transform: rotate(-2.69deg); opacity: 1; }
        .login-icon--mac    { top: 270px; left: 96px; width: 104px; transform: rotate(-21.39deg); opacity: 1; }

        .login-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 30px;
            width: 812px;
            max-width: 100%;
            min-height: 678px;
            padding: 0 var(--spacing-lg);
            margin-top: 77px;
            position: relative;
            z-index: 1;
        }

        .login-logo { position: relative; width: 260px; max-width: 100%; margin: 0 auto; }
        .login-logo__img { display: block; width: 100%; height: auto; }
        .login-logo__highlight { position: absolute; width: 285px; height: 89px; object-fit: fill; pointer-events: none; left: -11px; top: -15px; }

        .login-badge {
            background: var(--color-brand-orange);
            color: var(--color-white);
            font-size: 18px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 16px 40px;
            border-radius: 16px;
            text-align: center;
            width: 100%;
            max-width: 440px;
        }

        .login-form { width: 100%; display: flex; flex-direction: column; gap: var(--spacing-lg); }
        .form-group { display: flex; flex-direction: column; gap: var(--spacing-xs); }
        .form-group label { color: var(--color-blue); font-weight: 700; font-size: 16px; }

        .form-group input {
            width: 100%;
            padding: 18px 20px;
            background-color: #E8E4F8;
            border: none;
            border-radius: 16px;
            font-size: 15px;
            font-family: var(--font-family-main);
            color: var(--color-dark);
            transition: box-shadow var(--transition-fast);
        }

        .form-group input:focus { outline: none; box-shadow: 0 0 0 3px rgba(107, 127, 255, 0.25); }

        .alert { padding: 14px 18px; border-radius: var(--radius-card); font-size: 14px; font-weight: 600; }
        .alert--error   { background: #fde8e8; border-left: 4px solid #e53e3e; color: #c53030; }
        .alert--success { background: #e6f4ea; border-left: 4px solid #38a169; color: #276749; }

        .login-back { text-align: center; margin-top: 24px; }
        .login-back a { color: var(--color-blue); font-size: 15px; font-weight: 600; text-decoration: underline; text-underline-offset: 3px; transition: color var(--transition-fast); }
        .login-back a:hover { color: var(--color-purple); }

        .btn-login {
            align-self: center;
            padding: 16px 48px;
            background: var(--gradient-button-hover);
            color: var(--color-white);
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 800;
            font-family: var(--font-family-main);
            cursor: pointer;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(107, 127, 255, 0.35); }
        .btn-login:active { transform: translateY(0); }

        .btn-home { display: inline-flex; align-items: center; gap: 8px; align-self: center; padding: 12px 28px; background: transparent; color: var(--color-blue); border: 2px solid var(--color-blue); border-radius: 16px; font-size: 14px; font-weight: 700; font-family: var(--font-family-main); text-decoration: none; transition: background var(--transition-fast), color var(--transition-fast); }
        .btn-home:hover { background: var(--color-blue); color: var(--color-white); }

        @media (max-width: 768px) {
            body { overflow-y: auto; align-items: flex-start; }
            .login-wrapper { padding: 200px var(--spacing-lg) 160px; gap: 0; width: 402px; max-width: 100%; }
            .login-logo { width: 180px; margin-bottom: 110px; align-self: center; margin-left: auto; margin-right: auto; }
            .login-logo__highlight { width: 197px; height: 61px; left: -8px; top: -10px; }
            .login-badge { margin-bottom: 30px; align-self: center; max-width: 340px; width: 100%; text-align: center; font-size: 15px; padding: 14px 24px; }
            .btn-login { width: 100%; }
            .btn-home { margin-top: 24px; width: 100%; justify-content: center; }
            .login-icon--micro  { top: 75px;  left: -14px; width: 175px; transform: rotate(-2.69deg);  right: auto; bottom: auto; }
            .login-icon--camera { top: -36px; left: 134px; width: 296px; transform: rotate(0deg);     right: auto; bottom: auto; }
            .login-icon--mac    { top: 321px; left: 265px; width: 104px; transform: rotate(-21.39deg); right: auto; bottom: auto; }
            .login-icon--like   { top: 631px; left: -8px;  width: 157px; transform: rotate(-25deg);   right: auto; bottom: auto; }
            .login-icon--dev    { top: 724px; left: 260px; width: 143px; transform: rotate(13.15deg);  right: auto; bottom: auto; }
        }
    </style>
</head>
<body style="background-image: url('<?= $basePath ?>/assets/images/home/backgrounds/FOND.svg');">

    <img class="login-icon login-icon--like"   src="<?= $basePath ?>/assets/images/home/hero/icon-like.webp"   alt="" aria-hidden="true">
    <img class="login-icon login-icon--mac"    src="<?= $basePath ?>/assets/images/home/hero/icon-mac.svg"     alt="" aria-hidden="true">
    <img class="login-icon login-icon--micro"  src="<?= $basePath ?>/assets/images/home/hero/icon-micro.webp"  alt="" aria-hidden="true">
    <img class="login-icon login-icon--camera" src="<?= $basePath ?>/assets/images/home/hero/icon-camera.webp" alt="" aria-hidden="true">
    <img class="login-icon login-icon--dev"    src="<?= $basePath ?>/assets/images/home/hero/icon-dev.svg"     alt="" aria-hidden="true">

    <div class="login-wrapper">

        <div class="login-logo">
            <img class="login-logo__img" src="<?= $basePath ?>/assets/images/logos/hero/logo_digital_maker_lab_rectangle_orange.webp" alt="Digital Maker Lab">
            <img class="login-logo__highlight" src="<?= $basePath ?>/assets/images/logos/hero/effet-surligne.webp" alt="" aria-hidden="true">
        </div>

        <div class="login-badge">Nouveau mot de passe</div>

        <form class="login-form" action="/new-password" method="POST">

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert--error"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <div class="form-group">
                <label for="password">Nouveau mot de passe :</label>
                <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password" autofocus>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirmer le mot de passe :</label>
                <input type="password" id="password_confirm" name="password_confirm" minlength="8" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-login">Enregistrer !</button>

        </form>

        <div class="login-back">
            <a href="/login">← Retour à la connexion</a>
        </div>

        <a href="/" class="btn-home">← Retour à l'accueil</a>

    </div>

</body>
</html>

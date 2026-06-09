<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe - Digital Maker Lab</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-header h1 { font-size: 24px; margin-bottom: 10px; }
        .login-header p { font-size: 14px; opacity: 0.9; }

        .login-form { padding: 40px 30px; }

        .intro-text {
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .form-group { margin-bottom: 25px; }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input.code-input {
            text-align: center;
            letter-spacing: 12px;
            font-size: 24px;
            font-weight: 700;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .error-message {
            background: #fee;
            border-left: 4px solid #f44336;
            color: #c62828;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success-message {
            background: #e8f5e9;
            border-left: 4px solid #4caf50;
            color: #2e7d32;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .form-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>🔒 Nouveau mot de passe</h1>
            <p>Digital Maker Lab</p>
        </div>

        <div class="login-form">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <p class="intro-text">
                Saisissez le code à 4 chiffres reçu par email, puis choisissez
                votre nouveau mot de passe.
            </p>

            <form action="/reset-password" method="POST">
                <?php $resetEmail = $_SESSION['reset_email'] ?? ''; ?>
                <?php if ($resetEmail !== ''): ?>
                    <input type="hidden" name="email" value="<?= htmlspecialchars($resetEmail) ?>">
                <?php else: ?>
                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="vous@exemple.com"
                            required
                            autocomplete="email"
                        >
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="code">Code à 4 chiffres</label>
                    <input
                        type="text"
                        id="code"
                        name="code"
                        class="code-input"
                        placeholder="0000"
                        maxlength="4"
                        inputmode="numeric"
                        pattern="\d{4}"
                        required
                        autocomplete="one-time-code"
                    >
                </div>

                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        id="password_confirm"
                        name="password_confirm"
                        placeholder="••••••••"
                        minlength="8"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <button type="submit" class="btn-login">
                    Réinitialiser le mot de passe
                </button>
            </form>

            <div class="form-footer">
                <a href="/forgot-password">Renvoyer un code</a>
            </div>

            <div class="form-footer">
                <a href="/login">← Retour à la connexion</a>
            </div>
        </div>
    </div>
</body>
</html>

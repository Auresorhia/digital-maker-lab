<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo — Assistant IA | Digital Maker Lab</title>
    <link rel="stylesheet" href="/assets/css/design-system.css">
    <link rel="stylesheet" href="/assets/css/assistant-ia.css">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background: #0B0B0B;
            color: #F3F1EA;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 32px;
            padding: 40px 20px 120px;
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            text-align: center;
        }

        p {
            font-size: 14px;
            color: rgba(243,241,234,0.45);
            margin: 0;
            text-align: center;
        }

        .jobs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            max-width: 600px;
        }

        .jobs a {
            padding: 8px 18px;
            border: 1.5px solid #262628;
            border-radius: 50px;
            color: rgba(243,241,234,0.6);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: border-color 180ms ease, color 180ms ease;
        }

        .jobs a:hover,
        .jobs a.active {
            border-color: #FF6B35;
            color: #FF6B35;
        }
    </style>
</head>
<body>

    <div>
        <h1>Assistant Digital Maker Lab</h1>
        <p style="margin-top:8px;">Page de démonstration — clique sur un métier puis sur la bulle en bas</p>
    </div>

    <div class="jobs">
        <?php
        $metiers = [
            1 => 'Entrepreneur',
            2 => 'Responsable CRM',
            3 => 'Consultant SEO',
            4 => 'Game Designer',
            5 => 'Développeur Web',
            6 => 'Community Manager',
            7 => 'Vidéaste',
            8 => 'Graphiste',
        ];
        $currentId = isset($_GET['job']) ? (int) $_GET['job'] : 5;
        foreach ($metiers as $id => $nom) {
            $active = ($id === $currentId) ? ' class="active"' : '';
            echo '<a href="?job=' . $id . '"' . $active . '>' . htmlspecialchars($nom) . '</a>';
        }
        ?>
    </div>

    <?php
    $jobId = isset($_GET['job']) ? (int) $_GET['job'] : 5;
    include __DIR__ . '/assistant-ia-bubble.php';
    ?>

    <script src="/assets/js/assistant-ia.js" defer></script>

</body>
</html>

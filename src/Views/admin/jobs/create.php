<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Métier</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Ajouter un nouveau métier</h1>

    <form action="/admin/jobs/store" method="POST">
        <div class="form-group">
            <label for="job_name">Nom du métier :</label>
            <input type="text" id="job_name" name="job_name" required placeholder="Ex: Développeur Front-End">
        </div>

        <div class="form-group">
            <label for="specialty_id">Spécialité associée :</label>
            <select id="specialty_id" name="specialty_id" required>
                <option value="">-- Sélectionnez une spécialité --</option>
                
                <?php foreach ($specialties as $specialty): ?>
                    <option value="<?= htmlspecialchars($specialty['id_specialty']) ?>">
                        <?= htmlspecialchars($specialty['specialty']) ?>
                    </option>
                <?php endforeach; ?>
                
            </select>
        </div>

        <button type="submit">Enregistrer le métier</button>
        <a href="/admin/jobs" style="margin-left: 10px; color: #666;">Annuler</a>
    </form>
</body>
</html>
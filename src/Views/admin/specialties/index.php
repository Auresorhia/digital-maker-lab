<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Spécialités - Back-Office</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; color: white; }
        .btn-add { background-color: #28a745; display: inline-block; margin-bottom: 15px; }
        .btn-edit { background-color: #007bff; }
        .btn-delete { background-color: #dc3545; }
    </style>
</head>
<body>
    <h1>Liste des Spécialités</h1>
    
    <a href="/admin/specialties/create" class="btn btn-add">+ Ajouter une spécialité</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom de la Spécialité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($specialties as $specialty): ?>
                <tr>
                    <td><?= htmlspecialchars($specialty['id_specialty']) ?></td>
                    <td><?= htmlspecialchars($specialty['specialty']) ?></td>
                    <td>
                        <a href="/admin/specialties/<?= $specialty['id_specialty'] ?>/edit" class="btn btn-edit">Modifier</a>
                        <form action="/admin/specialties/<?= $specialty['id_specialty'] ?>/delete" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Attention, cela pourrait impacter les métiers liés. Supprimer ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php if (empty($specialties)): ?>
                <tr>
                    <td colspan="3">Aucune spécialité enregistrée pour le moment.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Métiers - Back-Office</title>
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
    <h1>Liste des Métiers</h1>
    
    <a href="/admin/jobs/create" class="btn btn-add">+ Ajouter un métier</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Métier</th>
                <th>ID Spécialité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?= htmlspecialchars($job['id_job']) ?></td>
                    <td><?= htmlspecialchars($job['job_name']) ?></td>
                    <td><?= htmlspecialchars($job['specialty_id']) ?></td>
                    <td>
                        <a href="/admin/jobs/<?= $job['id_job'] ?>/edit" class="btn btn-edit">Modifier</a>
                        <form action="/admin/jobs/<?= $job['id_job'] ?>/delete" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Sûr de vouloir supprimer ?');">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <?php if (empty($jobs)): ?>
                <tr>
                    <td colspan="4">Aucun métier enregistré pour le moment.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une Spécialité</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Ajouter une nouvelle spécialité</h1>

    <form action="/admin/specialties/store" method="POST">
        <div class="form-group">
            <label for="specialty">Nom de la spécialité :</label>
            <input type="text" id="specialty" name="specialty" required placeholder="Ex: Développement Web">
        </div>

        <button type="submit">Enregistrer la spécialité</button>
        <a href="/admin/specialties" style="margin-left: 10px; color: #666;">Annuler</a>
    </form>
</body>
</html>
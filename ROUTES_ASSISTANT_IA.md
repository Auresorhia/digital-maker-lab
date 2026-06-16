# Routes à ajouter — Feature Assistant IA

> ⚠️ À communiquer au responsable de `src/core/Router.php` (ticket #31)

## Route API à ajouter dans `src/core/Router.php`

Insérer le bloc suivant dans la méthode `start()` du Router, **avant** le bloc `else` (404) :

```php
} elseif (preg_match('#^/api/assistant/(\d+)$#', $chemin, $matches)) {
    require_once '../config/database.php';
    require_once '../src/Models/AssistantIA/AssistantIAModel.php';
    require_once '../src/Controllers/AssistantIA/AssistantIAController.php';
    $controller = new \Controllers\AssistantIA\AssistantIAController(Database::getInstance());
    $controller->getApps((int) $matches[1]);
```

## Exemple de réponse JSON

`GET /api/assistant/5` retourne :

```json
{
  "success": true,
  "metier_id": 5,
  "apps": [
    {
      "id": 13,
      "app_name": "VS Code",
      "tags": "IDE, Éditeur de code, Extensions",
      "description": "VS Code est l'éditeur de code le plus utilisé...",
      "source": "code.visualstudio.com"
    },
    { ... },
    { ... }
  ]
}
```

## Intégration dans une page métier (ticket #32)

Dans le `<head>` de la vue :
```html
<link rel="stylesheet" href="assets/css/design-system.css">
<link rel="stylesheet" href="assets/css/assistant-ia.css">
```

Avant `</body>` :
```html
<?php $jobId = 5; include __DIR__ . '/../metiers/assistant-ia-bubble.php'; ?>
<script src="assets/js/assistant-ia.js" defer></script>
```

## IDs des métiers en base

| job_id | Métier                    |
|--------|---------------------------|
| 1      | Créateur d'entreprise     |
| 2      | Responsable CRM           |
| 3      | Consultant SEO            |
| 4      | Game Designer             |
| 5      | Développeur Web           |
| 6      | Community Manager         |
| 7      | Vidéaste                  |
| 8      | Graphiste                 |

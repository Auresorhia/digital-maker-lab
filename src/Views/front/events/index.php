<?php 
$title = "Événements - Digital Maker Lab";
require_once __DIR__ . '/../../layout/header.php'; 
?>

<div class="container">
    <h1>Fil d'actualité - Événements du Digital</h1>
    <p class="lead">Découvrez les conférences, salons, webinars et meetups du secteur digital</p>

    <div class="events-grid">
        <?php if (empty($events)): ?>
            <p>Aucun événement à venir pour le moment.</p>
        <?php else: ?>
            <?php foreach($events as $event): ?>
                <div class="event-card">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    
                    <p><strong>Date :</strong> 
                        <?= date('d/m/Y à H:i', strtotime($event['date_start'])) ?>
                    </p>
                    
                    <p><strong>Lieu :</strong> 
                        <?= htmlspecialchars($event['location'] ?? 'En ligne') ?>
                    </p>
                    
                    <?php if (!empty($event['format'])): ?>
                        <span class="badge"><?= ucfirst($event['format']) ?></span>
                    <?php endif; ?>

                    <a href="/evenement/<?= $event['id'] ?>" class="btn btn-primary">
                        Voir les détails
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../../layout/footer.php'; ?>
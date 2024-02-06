<?php include_once '../views/partials/_headerView.php'; ?>

<main class="container py-4">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
    
    <h2 class="mb-4">Missions</h2>
    <?php if (empty($missions)): ?>
        <div class="alert alert-warning" role="alert">
            Aucune mission n'a été trouvée.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($missions as $mission): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($mission['titre']) ?></h5>
                            <p class="card-text"><strong>Description:</strong> <?= htmlspecialchars($mission['description']) ?></p>
                            <p class="card-text"><strong>Pays:</strong> <?= htmlspecialchars($mission['pays']) ?></p>
                            <p class="card-text"><strong>Type de mission:</strong> <?= htmlspecialchars($mission['typeMission']) ?></p>
                            <p class="card-text"><strong>Statut:</strong> <?= htmlspecialchars($mission['statut']) ?></p>
                            <p class="card-text"><strong>Date de début:</strong> <?= htmlspecialchars($mission['dateDebut']) ?></p>
                            <p class="card-text"><strong>Date de fin:</strong> <?= htmlspecialchars($mission['dateFin']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include_once '../views/partials/_footerView.php'; ?>

<?php include_once BASE_PATH . '/app/Views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h1 class="mb-4">Missions :</h1>
    <?php if (empty($missions)): ?>
        <div class="alert alert-warning" role="alert">
            Aucune mission n'a été trouvée.
        </div>
    <?php else: ?>
        <?php foreach (['En préparation', 'En cours', 'Terminé', 'Echec'] as $statut): ?>
            <h3 class="my-4"><i><?= $statut ?></i></h3>
            <?php $found = false; ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($missions as $mission): ?>
                    <?php if ($mission['Statut'] === $statut): ?>
                        <?php $found = true; ?>
                        <div class="col">
                            <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($mission['Titre']) ?></h5>
                                <p class="card-text"><strong>Date de début:</strong> <?= htmlspecialchars($mission['DateDebut']) ? date('d/m/Y', strtotime($mission['DateDebut'])) : 'Non défini' ?></p>
                                <p class="card-text"><strong>Date de fin:</strong> <?= !empty($mission['DateFin']) ? date('d/m/Y', strtotime($mission['DateFin'])) : 'Non défini' ?></p>
                                <p class="card-text"><strong>Statut:</strong> <?= htmlspecialchars($mission['Statut']) ?></p>
                                <a href="<?= BASE_URL ?>/missions/details?nomCode=<?= $mission['NomCode'] ?>" class="btn btn-primary">Détails</a>
                            </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php if (!$found): ?>
                <p class="m-2">Aucune mission n'a été trouvée.</p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php include_once BASE_PATH . '/app/Views/partials/_footerView.php'; ?>

<?php include_once BASE_PATH . '/app/views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h2>Gestion des Missions</h2>
    <a href="<?= BASE_URL ?>/missions/add" class="btn btn-primary mb-3">Ajouter une nouvelle mission</a>
    <?php if (empty($missions)): ?>
        <div class="alert alert-warning" role="alert">
            Aucune mission n'a été trouvée.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($missions as $mission): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($mission['Titre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($mission['Description']) ?></p>
                            <p class="card-text"><strong>Statut:</strong> <?= htmlspecialchars($mission['Statut']) ?></p>
                            <form action="<?= BASE_URL ?>/admin/missions/changeStatus" method="post">
                                <input type="hidden" name="missionId" value="<?= $mission['NomCode'] ?>">
                                <select name="newStatus" class="form-select mb-2">
                                    <option value="En cours">Mettre en cours</option>
                                    <option value="Terminé">Terminer</option>
                                    <option value="Echec">Échec</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Changer le statut</button>
                            </form>
                            <form action="<?= BASE_URL ?>/admin/missions/delete" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?');">
                                <input type="hidden" name="missionId" value="<?= $mission['NomCode'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm mt-2">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include_once BASE_PATH . '/app/views/partials/_footerView.php'; ?>

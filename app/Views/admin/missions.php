<?php include_once BASE_PATH . '/app/Views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h2>Gestion des Missions</h2>
    <a href="<?= BASE_URL ?>/missions/add" class="btn btn-primary mb-3">Ajouter une nouvelle mission</a>
    <?php foreach (['En préparation', 'En cours', 'Terminé', 'Echec'] as $statut): ?>
        <h3 class="my-4"><i><?= $statut ?></i></h3>
        <?php $found = false; ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($missions as $mission): ?>
                    <?php if ($mission['Statut'] === $statut): ?>
                        <?php $found = true; ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars_decode($mission['Titre']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars_decode($mission['Description']) ?></p>
                                    <p class="card-text"><strong>Statut:</strong> <?= htmlspecialchars($mission['Statut']) ?></p>
                                    <?php if ($mission['Statut'] !== 'Terminé' && $mission['Statut'] !== 'Echec'): ?>
                                        <form action="<?= BASE_URL ?>/admin/missions/changeStatus" method="post">
                                            <input type="hidden" name="missionId" value="<?= $mission['NomCode'] ?>">
                                            <select name="newStatus" class="form-select mb-2">
                                                <?php if ($mission['Statut'] !== 'En cours'): ?>
                                                    <option value="En cours">Débuter la mission</option>
                                                <?php endif; ?>
                                                <option value="Terminé">Terminer la mission</option>
                                                <option value="Echec">Échec</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Changer le statut</button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?= BASE_URL ?>/admin/missions/delete" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ?');">
                                        <input type="hidden" name="missionId" value="<?= $mission['NomCode'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm mt-2">Supprimer</button>
                                    </form>
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
</main>

<?php include_once BASE_PATH . '/app/Views/partials/_footerView.php'; ?>

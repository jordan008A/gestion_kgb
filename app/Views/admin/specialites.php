<?php include_once BASE_PATH . '/app/Views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h2 class="mb-4">Gestion des Spécialités</h2>

    <div class="card mb-4">
        <div class="card-header">
            Ajouter une nouvelle spécialité
        </div>
        <div class="card-body">
            <form action="<?= BASE_URL ?>/admin/specialites/create" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de la spécialité</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Spécialités existantes
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($specialites as $specialite): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($specialite['Nom']) ?>
                    <form action="<?= BASE_URL ?>/admin/specialites/delete" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette spécialité ?');">
                        <input type="hidden" name="nom" value="<?= $specialite['Nom']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php include_once BASE_PATH . '/app/Views/partials/_footerView.php'; ?>

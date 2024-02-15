<?php include_once BASE_PATH . '/app/views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h1 class="mb-4"><u>Gestion des Planques</u></h1>

    <h3>Ajouter une nouvelle planque</h3>
    <form action="<?= BASE_URL ?>/admin/planques/create" method="post" class="my-4">
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" required>
        </div>
        <div class="mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" class="form-control" id="pays" name="pays" placeholder="Pays" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="">Sélectionner un type</option>
                <option value="Appartement">Appartement</option>
                <option value="Maison">Maison</option>
                <option value="Bureau">Bureau</option>
                <option value="Entrepôt">Entrepôt</option>
                <option value="Safe house">Safe house</option>
            </select>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>

    <hr>

    <h3>Liste des Planques</h3>
    <?php foreach ($planques as $planque): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($planque['Adresse']) . ' ' . htmlspecialchars($planque['Pays']) . ' - ' . htmlspecialchars($planque['Type']) ?></h5>
                <form action="<?= BASE_URL ?>/admin/planques/delete" method="post" style="display: inline-block;">
                    <input type="hidden" name="planqueId" value="<?= $planque['Code'] ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
                </form>
                <button type="button" class="btn btn-primary edit-planque-btn" data-planque-id="<?= $planque['Code'] ?>">Modifier</button>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<div class="modal fade" id="editPlanqueModal" tabindex="-1" aria-labelledby="editPlanqueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editPlanqueModalLabel">Modifier Planque</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="edit-planque-form" action="<?= BASE_URL ?>/admin/planques/edit" method="post">
                    <input type="hidden" name="planqueId" id="edit-planque-id">
                    <div class="mb-3">
                        <label for="edit-adresse" class="form-label text-primary">Adresse</label>
                        <input type="text" class="form-control" id="edit-adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-pays" class="form-label text-primary">Pays</label>
                        <input type="text" class="form-control" id="edit-pays" name="pays" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-type" class="form-label">Type</label>
                        <select class="form-select" id="edit-type" name="type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="Appartement">Appartement</option>
                            <option value="Maison">Maison</option>
                            <option value="Bureau">Bureau</option>
                            <option value="Entrepôt">Entrepôt</option>
                            <option value="Safe house">Safe house</option>
                        </select>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                </form>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="edit-planque-form" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/javascript/edit-planque-modal.js"></script>

<?php include_once BASE_PATH . '/app/views/partials/_footerView.php'; ?>

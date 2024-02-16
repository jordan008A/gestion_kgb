<?php include_once BASE_PATH . '/app/Views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h1 class="mb-4"><u>Gestion des Cibles</u></h1>

    <h3>Ajouter une nouvelle cible</h3>
    <form action="<?= BASE_URL ?>/admin/cibles/create" method="post" class="my-4">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
        </div>
        <div class="mb-3">
            <label for="dateNaissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
        </div>
        <div class="mb-3">
            <label for="nationalite" class="form-label">Nationalité</label>
            <input type="text" class="form-control" id="nationalite" name="nationalite" placeholder="Nationalité" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>

    <hr>

    <h3>Liste des Cibles</h3>
    <?php foreach ($cibles as $cible): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($cible['Nom']) . ' ' . htmlspecialchars($cible['Prenom']) . ' - ' . htmlspecialchars($cible['Nationalite']) ?></h5>
                <form action="<?= BASE_URL ?>/admin/cibles/delete" method="post" style="display: inline-block;">
                    <input type="hidden" name="cibleId" value="<?= $cible['NomCode'] ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
                </form>
                <button type="button" class="btn btn-primary edit-cible-btn" data-cible-id="<?= $cible['NomCode'] ?>">Modifier</button>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<div class="modal fade" id="editCibleModal" tabindex="-1" aria-labelledby="editCibleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editCibleModalLabel">Modifier Cible</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="edit-cible-form" action="<?= BASE_URL ?>/admin/cibles/edit" method="post">
                    <input type="hidden" name="cibleId" id="edit-cible-id">
                    <div class="mb-3">
                        <label for="edit-nom" class="form-label text-primary">Nom</label>
                        <input type="text" class="form-control" id="edit-nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-prenom" class="form-label text-primary">Prénom</label>
                        <input type="text" class="form-control" id="edit-prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-dateNaissance" class="form-label text-primary">Date de Naissance</label>
                        <input type="date" class="form-control" id="edit-dateNaissance" name="dateNaissance" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-nationalite" class="form-label text-primary">Nationalité</label>
                        <input type="text" class="form-control" id="edit-nationalite" name="nationalite" required>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                </form>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="edit-cible-form" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/javascript/edit-cible-modal.js"></script>

<?php include_once BASE_PATH . '/app/Views/partials/_footerView.php'; ?>

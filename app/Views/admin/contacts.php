<?php include_once BASE_PATH . '/app/Views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h1 class="mb-4"><u>Gestion des Contacts</u></h1>

    <h3>Ajouter un nouveau contact</h3>
    <form action="<?= BASE_URL ?>/admin/contacts/create" method="post" class="my-4">
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
        <div class="mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" class="form-control" id="pays" name="pays" placeholder="Pays" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>

    <hr>

    <h3>Liste des Contacts</h3>
    <?php foreach ($contacts as $contact): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($contact['Nom']) . ' ' . htmlspecialchars($contact['Prenom']) . ' Nationalité : ' . htmlspecialchars($contact['Nationalite']) . ' - Pays : ' . htmlspecialchars($contact['Pays']) ?></h5>
                <form action="<?= BASE_URL ?>/admin/contacts/delete" method="post" style="display: inline-block;">
                    <input type="hidden" name="contactId" value="<?= $contact['NomCode'] ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
                </form>
                <button type="button" class="btn btn-primary edit-contact-btn" data-contact-id="<?= $contact['NomCode'] ?>">Modifier</button>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editContactModalLabel">Modifier Contact</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form id="edit-contact-form" action="<?= BASE_URL ?>/admin/contacts/edit" method="post">
                    <input type="hidden" name="contactId" id="edit-contact-id">
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
                    <div class="mb-3">
                        <label for="edit-pays" class="form-label text-primary">Pays</label>
                        <input type="text" class="form-control" id="edit-pays" name="pays" required>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
                </form>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="edit-contact-form" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>/javascript/edit-contact-modal.js"></script>

<?php include_once BASE_PATH . '/app/Views/partials/_footerView.php'; ?>

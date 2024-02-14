<?php include_once BASE_PATH . '/app/views/partials/_headerView.php'; ?>

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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCibleModalLabel">Modifier Cible</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-cible-form" action="<?= BASE_URL ?>/admin/cibles/edit" method="post">
                    <input type="hidden" name="cibleId" id="edit-cible-id">
                    <div class="mb-3">
                        <label for="edit-nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="edit-nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="edit-prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-dateNaissance" class="form-label">Date de Naissance</label>
                        <input type="date" class="form-control" id="edit-dateNaissance" name="dateNaissance" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-nationalite" class="form-label">Nationalité</label>
                        <input type="text" class="form-control" id="edit-nationalite" name="nationalite" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="edit-cible-form" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>

<script>

    const BASE_URL = '<?= BASE_URL ?>';

    document.querySelectorAll('.edit-cible-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const cibleId = this.dataset.cibleId;
          
            fetch(`${BASE_URL}/admin/cibles/details?cibleId=${cibleId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cible = data.data;
                        document.getElementById('edit-cible-id').value = cibleId;
                        document.getElementById('edit-nom').value = cible.Nom;
                        document.getElementById('edit-prenom').value = cible.Prenom;
                        document.getElementById('edit-dateNaissance').value = cible.DateNaissance;
                        document.getElementById('edit-nationalite').value = cible.Nationalite;

                        let editCibleModal = new bootstrap.Modal(document.getElementById('editCibleModal'));
                        editCibleModal.show();
                    } else {
                        alert('Erreur lors de la récupération des données de la cible');
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });
    });

</script>

<?php include_once BASE_PATH . '/app/views/partials/_footerView.php'; ?>

<?php include_once BASE_PATH . '/app/views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h1 class="mb-4"><u>Gestion des Agents</u></h1>

    <h3>Ajouter un nouvel agent</h3>
    <form action="<?= BASE_URL ?>/admin/agents/create" method="post" class="my-4">
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
            <strong>Spécialités :</strong><br>
            <?php foreach ($specialites as $specialite): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="specialites[]" value="<?= htmlspecialchars($specialite['Nom']) ?>" id="spec-<?= htmlspecialchars($specialite['Nom']) ?>">
                    <label class="form-check-label" for="spec-<?= htmlspecialchars($specialite['Nom']) ?>">
                        <?= htmlspecialchars($specialite['Nom']) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-success">Ajouter</button>
    </form>

    <hr>

    <h3>Liste des Agents</h3>
    <?php foreach ($agents as $agent): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($agent['Nom']) . ' ' . htmlspecialchars($agent['Prenom']) . ' - ' . htmlspecialchars($agent['Nationalite']) ?> - Spécialités: <?= htmlspecialchars($agent['Specialites']) ?></h5>
                <form action="<?= BASE_URL ?>/admin/agents/delete" method="post" style="display: inline-block;">
                    <input type="hidden" name="agentId" value="<?= $agent['CodeID'] ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
                </form>
                <button type="button" class="btn btn-primary edit-agent-btn" data-agent-id="<?= $agent['CodeID'] ?>">Modifier</button>
            </div>
        </div>
    <?php endforeach; ?>
</main>
<div class="modal fade" id="editAgentModal" tabindex="-1" aria-labelledby="editAgentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAgentModalLabel">Modifier Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-agent-form" action="<?= BASE_URL ?>/admin/agents/edit" method="post">
                    <input type="hidden" name="agentId" id="edit-agent-id">
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
                    <div class="mb-3">
                        <strong>Spécialités :</strong><br>
                        <?php foreach ($specialites as $specialite): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="specialites[]" value="<?= htmlspecialchars($specialite['Nom']) ?>" id="edit-spec-<?= htmlspecialchars($specialite['Nom']) ?>">
                                <label class="form-check-label" for="edit-spec-<?= htmlspecialchars($specialite['Nom']) ?>">
                                    <?= htmlspecialchars($specialite['Nom']) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="edit-agent-form" class="btn btn-primary">Sauvegarder les modifications</button>
            </div>
        </div>
    </div>
</div>

<script>

    const BASE_URL = '<?= BASE_URL ?>';

    document.querySelectorAll('.edit-agent-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const agentId = this.dataset.agentId;
          
            fetch(`${BASE_URL}/admin/agents/details?agentId=${agentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const agent = data.data;
                        document.getElementById('edit-agent-id').value = agentId;
                        document.getElementById('edit-nom').value = agent.Nom;
                        document.getElementById('edit-prenom').value = agent.Prenom;
                        document.getElementById('edit-dateNaissance').value = agent.DateNaissance;
                        document.getElementById('edit-nationalite').value = agent.Nationalite;
                        
                        document.querySelectorAll('#edit-agent-form .form-check-input').forEach(checkbox => {
                            checkbox.checked = agent.specialites.includes(checkbox.value);
                        });

                        let editAgentModal = new bootstrap.Modal(document.getElementById('editAgentModal'));
                        editAgentModal.show();
                    } else {
                        alert('Erreur lors de la récupération des données de l\'agent');
                    }
                })
                .catch(error => console.error('Erreur:', error));
        });
    });

</script>

<?php include_once BASE_PATH . '/app/views/partials/_footerView.php'; ?>

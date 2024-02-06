<?php include_once '../views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h2>Ajouter une nouvelle mission</h2>
    <form action="/gestion_kgb/controllers/missionsController.php" method="post">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de la mission</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="pays" class="form-label">Pays</label>
            <input type="text" class="form-control" id="pays" name="pays" required>
        </div>
        <div class="mb-3">
            <label for="typeMission" class="form-label">Type de mission</label>
            <select class="form-select" id="typeMission" name="typeMission" required>
                <option disabled value="">Sélectionnez un type</option>
                <option value="Surveillance">Surveillance</option>
                <option value="Assassinat">Assassinat</option>
                <option value="Infiltration">Infiltration</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="specialite" class="form-label">Spécialité requise</label>
            <select class="form-select" id="specialite" name="specialite" required>
                <?php foreach ($specialites as $specialite): ?>
                    <option value="<?= $specialite['nom'] ?>"><?= htmlspecialchars($specialite['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="agents" class="form-label">Agents</label>
            <select multiple class="form-select" id="agents" name="agents[]" required>
                <?php foreach ($agents as $agent): ?>
                    <option value="<?= $agent['id'] ?>"><?= htmlspecialchars($agent['nom']) . ' ' . htmlspecialchars($agent['prenom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="contacts" class="form-label">Contacts</label>
            <select multiple class="form-select" id="contacts" name="contacts[]" required>
                <?php foreach ($contacts as $contact): ?>
                    <option value="<?= $contact['id'] ?>"><?= htmlspecialchars($contact['nom']) . ' ' . htmlspecialchars($contact['prenom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="cibles" class="form-label">Cibles</label>
            <select multiple class="form-select" id="cibles" name="cibles[]" required>
                <?php foreach ($cibles as $cible): ?>
                    <option value="<?= $cible['id'] ?>"><?= htmlspecialchars($cible['nom']) . ' ' . htmlspecialchars($cible['prenom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="planques" class="form-label">Planques</label>
            <select multiple class="form-select" id="planques" name="planques[]" required>
                <?php foreach ($planques as $planque): ?>
                    <option value="<?= $planque['id'] ?>"><?= htmlspecialchars($planque['adresse']) . ', ' . htmlspecialchars($planque['pays']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="statut" class="form-label">Statut</label>
            <select class="form-select" id="statut" name="statut" required>
                <option disabled value="">Sélectionnez un statut</option>
                <option value="En préparation">En préparation</option>
                <option value="En cours">En cours</option>
                <option value="Terminé">Terminé</option>
                <option value="Echec">Echec</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="dateDebut" class="form-label">Date de début</label>
            <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</main>

<?php include_once '../views/partials/_footerView.php'; ?>

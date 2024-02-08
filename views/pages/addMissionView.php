<?php include_once '../views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h2 class="mb-4">Ajouter une nouvelle mission</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
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
                        <option value="Surveillance">Surveillance</option>
                        <option value="Assassinat">Assassinat</option>
                        <option value="Infiltration">Infiltration</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="specialite" class="form-label">Spécialité requise</label>
                    <select class="form-select" id="specialite" name="specialite" required>
                        <?php foreach ($getSpecialites as $specialite): ?>
                            <option value="<?= $specialite['Nom'] ?>"><?= htmlspecialchars($specialite['Nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="agents" class="form-label">Agents</label>
                    <ul class="list-scroll">
                        <?php foreach ($getAgents as $agent): ?>
                        <li>
                            <input type="checkbox" id="agent<?= $agent['CodeID'] ?>" name="agents[]" value="<?= $agent['CodeID'] ?>">
                            <label for="agent<?= $agent['CodeID'] ?>"><?= htmlspecialchars($agent['Nom']) . ' ' . htmlspecialchars($agent['Prenom']) . ' - ' . htmlspecialchars($agent['Nationalite']) ?></label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-3">
                    <label for="contacts" class="form-label">Contacts</label>
                    <ul class="list-scroll">
                        <?php foreach ($getContacts as $contact): ?>
                        <li>
                            <input type="checkbox" id="contact<?= $contact['NomCode'] ?>" name="contacts[]" value="<?= $contact['NomCode'] ?>">
                            <label for="contact<?= $contact['NomCode'] ?>"><?= htmlspecialchars($contact['Nom']) . ' ' . htmlspecialchars($contact['Prenom']) . ' - ' . htmlspecialchars($contact['Nationalite']) ?></label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-3">
                    <label for="cibles" class="form-label">Cibles</label>
                    <ul class="list-scroll">
                        <?php foreach ($getCibles as $cible): ?>
                        <li>
                            <input type="checkbox" id="cible<?= $cible['NomCode'] ?>" name="cibles[]" value="<?= $cible['NomCode'] ?>">
                            <label for="cible<?= $cible['NomCode'] ?>"><?= htmlspecialchars($cible['Nom']) . ' ' . htmlspecialchars($cible['Prenom']) . ' - ' . htmlspecialchars($cible['Nationalite']) ?></label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-3">
                    <label for="planques" class="form-label">Planques</label>
                    <ul class="list-scroll">
                        <?php foreach ($getPlanques as $planque): ?>
                        <li>
                            <input type="checkbox" id="planque<?= $planque['Code'] ?>" name="planques[]" value="<?= $planque['Code'] ?>">
                            <label for="planque<?= $planque['Code'] ?>"><?= htmlspecialchars($planque['Adresse']) . ', ' . htmlspecialchars($planque['Pays']) ?></label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select" id="statut" name="statut" required>
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
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ajouter l'ordre de mission</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include_once '../views/partials/_footerView.php'; ?>

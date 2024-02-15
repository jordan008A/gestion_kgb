<?php include_once BASE_PATH . '/app/views/partials/_headerView.php'; ?>

<?php if (isset($_SESSION['error_messages'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= implode('<br>', $_SESSION['error_messages']); ?>
    </div>
    <?php unset($_SESSION['error_messages']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<main class="container py-4">
    <h2 class="mb-4">Ajouter une nouvelle mission</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="http://localhost/gestion_kgb/public/missions/store" method="post">
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
                        <option value="Infiltration">Reconnaissance</option>
                        <option value="Infiltration">Cyber-Sécurité</option>
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
                    <div class="row gx-2">
                        <?php foreach ($getAgents as $agent): ?>
                            <div class="col-12 col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="agent<?= $agent['CodeID'] ?>" name="agents[]" value="<?= $agent['CodeID'] ?>">
                                    <label class="form-check-label" for="agent<?= $agent['CodeID'] ?>">
                                        <?= htmlspecialchars($agent['Nom']) . ' ' . htmlspecialchars($agent['Prenom']) . ' - ' . htmlspecialchars($agent['Nationalite']) . '<br>- Spécialités: ' . htmlspecialchars($agent['Specialites']) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="contacts" class="form-label">Contacts</label>
                    <div class="row gx-2 list-scroll">
                        <?php foreach ($getContacts as $contact): ?>
                            <div class="col-12 col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="contact<?= $contact['NomCode'] ?>" name="contacts[]" value="<?= $contact['NomCode'] ?>">
                                    <label class="form-check-label" for="contact<?= $contact['NomCode'] ?>">
                                        <?= htmlspecialchars($contact['Nom']) . ' ' . htmlspecialchars($contact['Prenom']) . ' - ' . htmlspecialchars($contact['Nationalite']) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cibles" class="form-label">Cibles</label>
                    <div class="row gx-2 list-scroll">
                        <?php foreach ($getCibles as $cible): ?>
                            <div class="col-12 col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cible<?= $cible['NomCode'] ?>" name="cibles[]" value="<?= $cible['NomCode'] ?>">
                                    <label class="form-check-label" for="cible<?= $cible['NomCode'] ?>">
                                        <?= htmlspecialchars($cible['Nom']) . ' ' . htmlspecialchars($cible['Prenom']) . ' - ' . htmlspecialchars($cible['Nationalite']) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="planques" class="form-label">Planques</label>
                    <div class="row gx-2 list-scroll">
                        <?php foreach ($getPlanques as $planque): ?>
                            <div class="col-12 col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="planque<?= $planque['Code'] ?>" name="planques[]" value="<?= $planque['Code'] ?>">
                                    <label class="form-check-label" for="planque<?= $planque['Code'] ?>">
                                        <?= htmlspecialchars($planque['Adresse']) . ', ' . htmlspecialchars($planque['Pays']) ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
            </form>
        </div>
    </div>
</main>

<?php include_once BASE_PATH . '/app/views/partials/_footerView.php'; ?>

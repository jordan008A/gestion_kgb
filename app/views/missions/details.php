<?php include_once BASE_PATH . '/app/views/partials/_headerView.php'; ?>

<main class="container py-4">
    <h2>Détails de la Mission</h2>
    <p><strong>Titre:</strong> <?= htmlspecialchars($missionDetails['Titre']) ?></p>
    <p><strong>Description:</strong> <?= htmlspecialchars($missionDetails['Description']) ?></p>
    <p><strong>Pays:</strong> <?= htmlspecialchars($missionDetails['Pays']) ?></p>
    <p><strong>Type de mission:</strong> <?= htmlspecialchars($missionDetails['TypeMission']) ?></p>
    <p><strong>Statut:</strong> <?= htmlspecialchars($missionDetails['Statut']) ?></p>
    <p><strong>Spécialité requise:</strong> <?= htmlspecialchars($missionDetails['SpecialiteRequise']) ?></p>
    <p><strong>Date de début:</strong> <?= htmlspecialchars($missionDetails['DateDebut']) ?></p>
    <p><strong>Date de fin:</strong> <?= htmlspecialchars($missionDetails['DateFin'] ?? 'Non défini') ?></p>

    <h3>Agents assignés</h3>
    <ul>
    <?php foreach ($missionDetails['agents'] as $agent): ?>
        <li><?= htmlspecialchars($agent['Nom']) . ' ' . htmlspecialchars($agent['Prenom']) ?></li>
    <?php endforeach; ?>
    </ul>

    <h3>Contacts</h3>
    <ul>
    <?php foreach ($missionDetails['contacts'] as $contact): ?>
        <li><?= htmlspecialchars($contact['Nom'] . ' ' . $contact['Prenom']) ?></li>
    <?php endforeach; ?>
    </ul>

    <h3>Cibles</h3>
    <ul>
    <?php foreach ($missionDetails['cibles'] as $cible): ?>
        <li><?= htmlspecialchars($cible['Nom'] . ' ' . $cible['Prenom']) ?></li>
    <?php endforeach; ?>
    </ul>

    <h3>Planques</h3>
    <ul>
    <?php foreach ($missionDetails['planques'] as $planque): ?>
        <li><?= htmlspecialchars($planque['Adresse'] . ', ' . $planque['Pays']) ?></li>
    <?php endforeach; ?>
    </ul>

    <a href="<?= BASE_URL ?>/missions" class="btn btn-primary">Retour</a>
</main>

<?php include_once BASE_PATH . '/app/views/partials/_footerView.php'; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KGB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
    <script> const BASE_URL = '<?= BASE_URL ?>'; </script>
</head>
<body>
<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a href="<?= BASE_URL ?>/" class="navbar-brand">
            <img src="<?= BASE_URL ?>/img/logo.png" alt="Logo KGB" height="70">
        </a>
        <h1>K.G.B</h1>
        <?php if (isset($_SESSION['admin_id'])): ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="<?= BASE_URL ?>/admin/missions" class="nav-link">Missions</a></li>
                    <li class="nav-item"><a href="<?= BASE_URL ?>/admin/agents" class="nav-link">Agents</a></li>
                    <li class="nav-item"><a href="<?= BASE_URL ?>/admin/cibles" class="nav-link">Cibles</a></li>
                    <li class="nav-item"><a href="<?= BASE_URL ?>/admin/contacts" class="nav-link">Contacts</a></li>
                    <li class="nav-item"><a href="<?= BASE_URL ?>/admin/planques" class="nav-link">Planques</a></li>
                    <li class="nav-item"><a href="<?= BASE_URL ?>/admin/specialites" class="nav-link">Spécialités</a></li>
                    <li class="nav-item"><a href="<?= BASE_URL ?>/logout" class="btn btn-outline-light ms-2">Se déconnecter</a></li>
                </ul>
            </div>
        <?php else: ?>
            <a href="<?= BASE_URL ?>/login" class="btn btn-outline-light ms-auto">Se connecter</a>
        <?php endif; ?>
    </div>
</header>
<div class="container mt-2">
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error_message']; ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
</div>
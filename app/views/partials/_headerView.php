<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KGB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/gestion_kgb/public/css/style.css">
</head>
<body>
<header class="bg-dark text-white py-4 px-5 d-flex justify-content-between align-items-center">
        <img src="<?= BASE_URL ?>/img/logo.png" alt="Logo KGB" style="height: 70px;">
    <h1 class="mx-2 py-1">K.G.B</h1>
    <a href="" class="btn btn-light">Se connecter</a>
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

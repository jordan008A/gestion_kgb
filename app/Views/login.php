<?php include_once 'partials/_headerView.php'; ?>

<main class="container py-4">
    <h2>Connexion</h2>
    <form action="<?= BASE_URL ?>/login" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</main>

<?php include_once 'partials/_footerView.php'; ?>
<?php
// admin/login.php
session_start();
require __DIR__ . '/../config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        // Stocke les infos de l'admin en session
        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'username' => $admin['username'],
            'fullname' => $admin['fullname']
        ];

        // Redirection vers dashboard (avant tout HTML)
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

// Inclure le header et le reste de la page après le traitement POST
include __DIR__ . '/../includes/header.php';
?>

<!-- CSS spécifique pour la page -->
<style>
.form-section {
    max-width: 400px;
    margin: 60px auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    text-align: center;
    font-family: Arial, sans-serif;
}
.form-section h2 { margin-bottom: 25px; color: #333; }
.form-section p { color: red; margin-bottom: 12px; }
.form-section label { display: block; text-align: left; margin: 15px 0 5px; font-weight: bold; color: #555; }
.form-section input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
.form-section button.btn { width: 100%; padding: 12px; margin-top: 25px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
.form-section button.btn:hover { background-color: #45a049; }
@media (max-width:500px) { .form-section { margin: 40px 15px; padding: 20px; } }
</style>

<section class="form-section">
    <h2>Connexion administrateur</h2>

    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Nom d’utilisateur :</label>
        <input type="text" name="username" required>

        <label>Mot de passe :</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn">Se connecter</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

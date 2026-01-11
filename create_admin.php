<?php
// create_admin.php — SUPPRIMEZ ce fichier après usage pour la sécurité.

// utilise la connexion déjà présente
require __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? 'admin');
    $password = $_POST['password'] ?? 'qwerty';
    $fullname = trim($_POST['fullname'] ?? 'Administrateur');

    if ($username === '' || $password === '') {
        $msg = "Remplis username et password.";
    } else {
        // Vérifier si username existe déjà
        $stmt = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $msg = "Ce nom d'utilisateur existe déjà.";
        } else {
            // Hash du mot de passe et insertion
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admins (username, password, fullname) VALUES (?, ?, ?)");
            $stmt->execute([$username, $hash, $fullname]);
            $msg = "Admin créé avec succès : username = " . htmlspecialchars($username) . " (supprimez create_admin.php maintenant).";
        }
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Créer admin (temporaire)</title>
<style>
body{font-family:Arial,Helvetica,sans-serif;padding:20px}
form{max-width:480px;background:#fff;padding:16px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08)}
label{display:block;margin-top:10px}
input{width:100%;padding:8px;margin-top:6px;border:1px solid #ccc;border-radius:4px}
button{margin-top:12px;padding:10px 14px;background:#0077b6;color:#fff;border:none;border-radius:5px;cursor:pointer}
.notice{margin-top:12px;padding:10px;background:#f1f1f1;border-radius:6px}
</style>
</head>
<body>
<h2>Créer un administrateur (temporaire)</h2>

<form method="post" action="">
    <label>Nom d'utilisateur (login) :
        <input name="username" value="admin">
    </label>

    <label>Mot de passe :
        <input name="password" value="qwerty" type="text">
    </label>

    <label>Fullname (affichage) :
        <input name="fullname" value="Administrateur">
    </label>

    <button type="submit">Créer l'admin</button>
</form>

<?php if (!empty($msg)): ?>
    <div class="notice"><?= nl2br(htmlspecialchars($msg)) ?></div>
<?php endif; ?>

<p style="margin-top:16px;color:#a00">N'OUBLIE PAS : supprime immédiatement ce fichier (create_admin.php) après avoir créé l'admin.</p>
</body>
</html>

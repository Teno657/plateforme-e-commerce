<?php
include __DIR__ . '/config/db.php'; // connexion à la DB

session_start();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $message = "Cet email est déjà enregistré.";
    } else {
        // Hash du mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insertion dans la base
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, $passwordHash, $phone, $address]);

        $message = "Inscription réussie ! Vous pouvez vous connecter.";
        header("Location: login.php");
        exit;
    }
}
?>

<?php include __DIR__ . '/includes/header.php'; ?>

<section class="form-section">
    <h2>Inscription</h2>
    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
    <form method="post" action="">
        <label>Prénom :</label>
        <input type="text" name="firstname" required>

        <label>Nom :</label>
        <input type="text" name="lastname" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Mot de passe :</label>
        <input type="password" name="password" required>

        <label>Téléphone :</label>
        <input type="text" name="phone">

        <label>Adresse :</label>
        <textarea name="address"></textarea>

        <button type="submit" class="btn">S’inscrire</button>
    </form>
    <p>Déjà un compte ? <a href="login.php">Connectez-vous</a></p>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

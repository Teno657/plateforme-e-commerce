<?php
include __DIR__ . '/../config/db.php'; 
include __DIR__ . '/../includes/header.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Génération automatique du slug
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
    $slug .= '-' . rand(100, 999); // pour éviter doublons

    $stmt = $pdo->prepare("INSERT INTO products (name, price, slug) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $slug]);

    header("Location: products.php");
    exit();
}
?>

<section class="admin-products">
    <h2>Ajouter un produit</h2>
    <form method="POST">
        <label>Nom du produit</label>
        <input type="text" name="name" required>

        <label>Prix (FCFA)</label>
        <input type="number" name="price" required>

        <button type="submit" name="submit" class="btn">Ajouter</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$id = (int)$_GET['id'];

// Récupérer le produit
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: products.php");
    exit();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $price, $id]);

    header("Location: products.php");
    exit();
}
?>

<section class="admin-products">
    <h2>Modifier le produit</h2>
    <form method="POST">
        <label>Nom du produit</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>

        <label>Prix (FCFA)</label>
        <input type="number" name="price" value="<?= $product['price']; ?>" required>

        <button type="submit" name="submit" class="btn">Modifier</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

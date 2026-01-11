<?php
include __DIR__ . '/../config/db.php'; // <-- chemin correct vers ton db.php
include __DIR__ . '/../includes/header.php';

// Maintenant $pdo est défini et prêt à l'emploi
$query = $pdo->query("SELECT * FROM products ORDER BY id ASC");
$products = $query->fetchAll();
?>

<section class="admin-products">
    <h2>Gestion des produits</h2>
    <a href="product_add.php" class="btn">+ Ajouter un produit</a>

    <table class="cart-table">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>

        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['id']); ?></td>
                <td><?= htmlspecialchars($product['name']); ?></td>
                <td><?= number_format($product['price'], 0, ',', ' '); ?> FCFA</td>
                <td>
                    <a href="product_edit.php?id=<?= $product['id']; ?>" class="btn">Modifier</a>
                    <a href="product_delete.php?id=<?= $product['id']; ?>" class="btn" style="background:#d9534f;"
                       onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">Aucun produit disponible.</td>
            </tr>
        <?php endif; ?>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<?php
include __DIR__ . '/includes/header.php';

// Simulation : dans un vrai site, on récupère via la base de données
$products = [
    1 => ['name' => 'Chaussures de sport homme', 'price' => 15000, 'desc' => 'Chaussures confortables parfaites pour le sport et les sorties.', 'image' => 'https://via.placeholder.com/350x250?text=Chaussures+Homme'],
    2 => ['name' => 'Montre élégante femme', 'price' => 12500, 'desc' => 'Montre chic avec bracelet en cuir, idéale pour toutes les occasions.', 'image' => 'https://via.placeholder.com/350x250?text=Montre+Femme'],
    3 => ['name' => 'Casque Bluetooth', 'price' => 8900, 'desc' => 'Casque audio sans fil haute qualité, autonomie 12h.', 'image' => 'https://via.placeholder.com/350x250?text=Casque+Bluetooth']
];

$id = $_GET['id'] ?? null;
$product = $id && isset($products[$id]) ? $products[$id] : null;
?>

<?php if ($product): ?>
    <section class="product-detail">
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <div>
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p class="price"><?= number_format($product['price'], 0, ',', ' ') ?> FCFA</p>
            <p><?= htmlspecialchars($product['desc']) ?></p>
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <button type="submit" name="add_to_cart" class="btn">Ajouter au panier</button>
            </form>
        </div>
    </section>
<?php else: ?>
    <p>Produit introuvable.</p>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>

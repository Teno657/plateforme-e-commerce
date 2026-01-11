<?php
include __DIR__ . '/includes/header.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ajouter un produit
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 1;
    } else {
        $_SESSION['cart'][$product_id]++;
    }
}

// Produits simulés (dans un vrai site, on les récupère depuis la base)
$products = [
    1 => ['name' => 'Chaussures de sport homme', 'price' => 15000],
    2 => ['name' => 'Montre élégante femme', 'price' => 12500],
    3 => ['name' => 'Casque Bluetooth', 'price' => 8900]
];

// Calcul du total
$total = 0;
?>

<section class="cart">
    <h2>Votre panier</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table class="cart-table">
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $id => $qty): 
                $prod = $products[$id];
                $subtotal = $prod['price'] * $qty;
                $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($prod['name']) ?></td>
                <td><?= $qty ?></td>
                <td><?= number_format($prod['price'], 0, ',', ' ') ?> FCFA</td>
                <td><?= number_format($subtotal, 0, ',', ' ') ?> FCFA</td>
            </tr>
            <?php endforeach; ?>
        </table>

        <p class="total">Total : <strong><?= number_format($total, 0, ',', ' ') ?> FCFA</strong></p>
        <a href="checkout.php" class="btn">Passer à la commande</a>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

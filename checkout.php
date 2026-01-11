<?php
include __DIR__ . '/includes/header.php';

// Simulation panier :
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Votre panier est vide. <a href='index.php'>Retour à la boutique</a></p>";
    include __DIR__ . '/includes/footer.php';
    exit;
}

$products = [
    1 => ['name' => 'Chaussures de sport homme', 'price' => 15000],
    2 => ['name' => 'Montre élégante femme', 'price' => 12500],
    3 => ['name' => 'Casque Bluetooth', 'price' => 8900]
];

$total = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    $total += $products[$id]['price'] * $qty;
}
?>

<section class="checkout">
    <h2>Validation de commande</h2>
    <p>Merci de vérifier vos informations avant de finaliser votre achat.</p>

    <form method="post" action="checkout.php">
        <label>Nom complet :</label>
        <input type="text" name="fullname" required>

        <label>Adresse de livraison :</label>
        <input type="text" name="address" required>

        <label>Téléphone :</label>
        <input type="tel" name="phone" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <p class="total">Montant total : <strong><?= number_format($total, 0, ',', ' ') ?> FCFA</strong></p>

        <button type="submit" name="confirm" class="btn">Confirmer la commande</button>
    </form>

    <?php
    if (isset($_POST['confirm'])) {
        echo "<p class='success'> Votre commande a été enregistrée avec succès !</p>";
        $_SESSION['cart'] = []; // Vider le panier
    }
    ?>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

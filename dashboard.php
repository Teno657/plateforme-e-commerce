<?php
session_start();

// Vérifier si admin connecté
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include __DIR__ . '/../includes/header.php';
?>

<!-- CSS spécifique au dashboard -->
<style>
.dashboard {
    max-width: 800px;
    margin: 50px auto;
    padding: 30px;
    background-color: #f7f7f7;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
    text-align: center;
}

.dashboard h2 {
    color: #333;
    margin-bottom: 15px;
}

.dashboard p {
    color: #555;
    margin-bottom: 25px;
    font-size: 16px;
}

.dashboard ul {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.dashboard ul li {
    background-color: #4CAF50;
    border-radius: 8px;
    padding: 20px 25px;
    min-width: 180px;
    transition: background-color 0.2s ease-in-out, transform 0.2s;
}

.dashboard ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    display: block;
}

.dashboard ul li:hover {
    background-color: #45a049;
    transform: translateY(-3px);
}

@media (max-width: 600px) {
    .dashboard ul {
        flex-direction: column;
        gap: 15px;
    }
}
</style>

<section class="dashboard">
    <h2>Bienvenue <?= htmlspecialchars($_SESSION['admin']['fullname'] ?? $_SESSION['admin']['username']) ?></h2>
    <p>Vous êtes connecté en tant qu'administrateur.</p>

    <ul>
        <li><a href="products.php">Gérer les produits</a></li>
        <li><a href="product_add.php">Ajouter un produit</a></li>
        <li><a href="orders.php">Voir les commandes</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    </ul>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

<?php
// admin/orders.php
include __DIR__ . '/../config/db.php';
include __DIR__ . '/../includes/header.php';

// Récupère toutes les commandes
$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll();
?>

<section class="admin-orders">
    <h2>Gestion des commandes</h2>

    <table class="cart-table">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Email</th>
            <th>Total</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        <?php if (count($orders) > 0): ?>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['id']; ?></td>
                <td><?= htmlspecialchars($order['customer_name']); ?></td>
                <td><?= htmlspecialchars($order['customer_email']); ?></td>
                <td><?= number_format($order['total'], 0, ',', ' '); ?> FCFA</td>
                <td><?= htmlspecialchars($order['status']); ?></td>
                <td><?= date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                <td>
                    <a href="order_view.php?id=<?= $order['id']; ?>" class="btn">Voir</a>
                    <a href="order_edit.php?id=<?= $order['id']; ?>" class="btn">Modifier</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucune commande disponible.</td>
            </tr>
        <?php endif; ?>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>

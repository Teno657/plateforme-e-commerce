<?php
include __DIR__ . '/../config/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: products.php");
exit();
?>

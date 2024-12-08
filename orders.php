<?php
session_start();
include_once(__DIR__ . '/Classes/Db.php');
include_once(__DIR__ . '/Classes/Order.php');
include_once(__DIR__ . '/Classes/User.php');
include_once(__DIR__ . '/Classes/Product.php');

$user = User::getUserByEmail($_SESSION['email']);
$user_id = $_SESSION['user_id'];
$orders = Order::getOrdersByUserId($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <div class="orders-container">
        <h1>Your Orders</h1>
        <?php if (!empty($orders)): ?>
            <ul class="orders-list">
                <?php foreach ($orders as $order): ?>
                    <li class="order-item">
                        <h2>Order ID: <?php echo htmlspecialchars($order['ID']); ?></h2>
                        <p>Total: <?php echo htmlspecialchars($order['total']); ?></p>
                        <p>Ordered on: <?php echo htmlspecialchars($order['date']); ?></p>
                        <h3>Items:</h3>
                        <ul class="order-items-list">
                            <?php
                            $order_items = Order::getOrderItems($order['ID']);
                            foreach ($order_items as $item):
                                $product = Product::getProductById($item['product_id']);
                            ?>
                                <li class="order-item-detail">
                                    <?php echo htmlspecialchars($product['Title']); ?> - Quantity: <?php echo htmlspecialchars($item['quantity']); ?> - Price: <?php echo htmlspecialchars($item['price']); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>You have no orders.</p>
        <?php endif; ?>
    </div>
</body>
</html>
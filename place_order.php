<?php
session_start();
include_once(__DIR__ . '/Classes/Db.php');
include_once(__DIR__ . '/Classes/Cart.php');
include_once(__DIR__ . '/Classes/Order.php');
include_once(__DIR__ . '/Classes/User.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

$user = User::getUserByEmail($_SESSION['email']);
$cart_items = Cart::getCartItems();
$total_price = array_sum(array_column($cart_items, 'price'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user['coins'] >= $total_price) {
        // Place the order
        $user_id = $user['ID'];
        $order_id = Order::placeOrder($user_id, $cart_items);
        User::updateCurrency($user_id, $user['coins'] - $total_price);
        Cart::clearCart();
        header('location: orders.php');
        exit;
    } else {
        $error_message = "Insufficient funds.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <div class="order-container">
        <h1>Place Order</h1>
        <?php if (isset($error_message)): ?>
            <p><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <p>Total Price: <?php echo htmlspecialchars($total_price); ?></p>
        <form action="place_order.php" method="post">
            <button type="submit" name="place_order" class="btn btn-place-order">Confirm Order</button>
        </form>
    </div>
</body>
</html>
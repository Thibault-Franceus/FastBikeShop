<?php
class Order {
    public static function placeOrder($user_id, $basket) {
        $conn = Db::getConnection();
        $total = array_sum(array_column($basket, 'price'));
        $stmt = $conn->prepare('INSERT INTO orders (user_id, total) VALUES (:user_id, :total)');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':total', $total, PDO::PARAM_STR);
        $stmt->execute();
        $order_id = $conn->lastInsertId();

        foreach ($basket as $item) {
            $stmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
            $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
            $stmt->bindValue(':product_id', $item['id'], PDO::PARAM_INT);
            $stmt->bindValue(':quantity', $item['quantity'], PDO::PARAM_INT);
            $stmt->bindValue(':price', $item['price'], PDO::PARAM_STR);
            $stmt->execute();
        }

        return $order_id;
    }

    public static function getOrderById($order_id) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare('SELECT * FROM orders WHERE id = :order_id');
        $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getOrdersByUserId($user_id) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare('SELECT * FROM orders WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getOrderItems($order_id) {
        $conn = Db::getConnection();
        $stmt = $conn->prepare('SELECT * FROM order_items WHERE order_id = :order_id');
        $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
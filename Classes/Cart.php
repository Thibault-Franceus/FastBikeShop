<?php
class Cart {
    public static function addToCart($product_id, $product_name, $product_price, $product_size, $user_id) {
        $item = [
            'id' => $product_id,
            'title' => $product_name,
            'price' => $product_price,
            'size' => $product_size,
            'user_id' => $user_id,
            'quantity' => 1
        ];
        $_SESSION['basket'][] = $item;
    }

    public static function removeFromCart($product_id) {
        foreach ($_SESSION['basket'] as $key => $item) {
            if ($item['id'] == $product_id) {
                unset($_SESSION['basket'][$key]);
                break;
            }
        }
    }

    public static function getCartItems() {
        return isset($_SESSION['basket']) ? $_SESSION['basket'] : [];
    }

    public static function clearCart() {
        unset($_SESSION['basket']);
    }
}
?>
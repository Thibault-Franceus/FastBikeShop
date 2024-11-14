<?php
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');

    $conn = Db::getConnection();
    $stmt = $conn->query('SELECT * FROM products');
    $stmt->execute();
    $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = Product::getAllProducts();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bikeshop</title>
</head>
<body>
    <h1>webshop</h1>
    <ul>
        <?php foreach($products as $product): ?>
            <li>
                <h2><?php echo $product['Title']; ?></h2>
                <p><?php echo $product['Price']; ?></p>
            </li>
        <?php endforeach; ?>
    
</body>
</html>
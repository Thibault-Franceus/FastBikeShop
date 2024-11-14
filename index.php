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
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1>webshop</h1>
    <div class="webshop">
        <?php foreach($products as $product): ?>
        <div class="card">

            <div class="imgBox">
                <img src="https://media.trekbikes.com/image/upload/w_1200/CheckpointALR3-25-47530-A-Primary" alt="mouse corsair" class="mouse">
            </div>

            <div class="contentBox">
                <h3><?php echo $product['Title']; ?></h3>
                <h2 class="price"><?php echo $product['Price']; ?> €</h2>
                <a href="#" class="buy">Buy Now</a>
            </div>
        </div> 
        <?php endforeach; ?>


    </div>
    
</body>
</html>
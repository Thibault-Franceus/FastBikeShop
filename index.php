<?php
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');

    session_start();
    if($_SESSION['loggedin'] !== true){
    header('location: login.php');
  }

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
            <div class="card">

  <div class="imgBox">
    <img src="" alt="mouse corsair" class="mouse">
  </div>

  <div class="contentBox">
    <h3>Mouse Corsair M65</h3>
    <h2 class="price">61.<small>98</small> €</h2>
    <a href="#" class="buy">Buy Now</a>
  </div>

</div> 
        <?php endforeach; ?>
    
</body>
</html>
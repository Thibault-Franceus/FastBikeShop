<?php
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');
    include_once(__DIR__ . '/Classes/User.php');

    
    session_start();
    if($_SESSION['loggedin'] !== true){
        header('location: login.php');
    }
    
    $user = User::getUserByEmail($_SESSION['email']);

    $_SESSION['user_id'] = $user['my_row_id'];
    $_SESSION['email'] = $user['email'];
    // After successful login

    if (User::isAdmin($user['email'])) {
        header('location: admin.php');
    }

    // Get search and category filter values from the form (if any)
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : 'all';

    // Get products based on filters
    $products = Product::getFilteredProducts($search, $category);

    // Fetch categories for the dropdown
    $categories = Product::getAllCategories();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trek Bikes</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <h1>Products</h1>
    
    <div class="webshop">
        <div class="sidebar">
            <h2>Filter</h2>
            <form action="index.php" method="post">
                <label for="search">Search Products:</label>
                <input type="text" name="search" id="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
                <br>
                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option disabled selected hidden value="bla">Categories</option>
                    <option value="all">All</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['my_row_id']; ?>" <?php echo $category['my_row_id'] == $category ? 'selected' : '';?>>
                            <?php echo htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button class="btn" type="submit">Filter</button>
            </form>
        </div>

        <div class="main-content">
            <div class="products">
                <?php foreach($products as $product): ?>
                    <div class="card">
                        <div class="imgBox">
                            <img src="<?php echo $product['image_url']; ?>" alt="Product Image" class="mouse">
                        </div>
                        
                        <div class="contentBox">
                            <h3><?php echo htmlspecialchars($product['Title']); ?></h3>
                            <h2 class="price"><?php echo $product['Price']; ?> €</h2>
                             <!-- Add to Cart button (adjust this logic as needed) -->
                            <a href="details.php?products_ID=<?php echo $product['product_id']; ?>" class="buy">More info</a>
                        </div>
                    </div> 
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

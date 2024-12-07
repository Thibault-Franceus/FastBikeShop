<?php 
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');
    include_once(__DIR__ . '/Classes/User.php');

    session_start();
    //if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true){ 
        //header('location:login.php');
        //exit;
    //}

    echo admin; 

    $user = User::getUserByEmail($_SESSION['email']);

    if (!User::isAdmin($user['email'])) {
        header('location: index.php');
        exit;
    }

    $products = [];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['search'])){
            $searchTerm = $_POST['search_term'];
            $products = Product::searchProducts($searchTerm);
        } elseif (isset($_POST['delete'])) {
            Product::deleteProduct($_POST['product_id']);
        } elseif (isset($_POST['update'])) {
            Product::updateProduct($_POST['product_id'], $_POST['title'], $_POST['description'], $_POST['price'], $_POST['category_id'], $_POST['image_id'], $_POST['size_id']);
        } elseif (isset($_POST['add'])) {
            Product::addProduct($_POST['title'], $_POST['description'], $_POST['price'], $_POST['category_id'], $_POST['image_id'], $_POST['size_id']);
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
</head>
<body>
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <div class="admin-container">

        <h1>Welcome, <?php echo $user['firstname']; ?>!</h1>
        <h2>Manage products</h2>
        <h3>Add New Product</h3>
        <form action="admin.php" method="post" class="admin-form">
            <input type="text" name="title" placeholder="Product Name" required>
            <input type="text" name="description" placeholder="description" required>
        <input type="number" name="price" placeholder="Price" required>
        <input type="text" name="category_id" placeholder="category_id" required>
        <input type="text" name="image_id" placeholder="image_id" required>
        <input type="text" name="size_id" placeholder="size_id" required>
        <button type="submit" name="add" class="btn btn-add">Add Product</button>
    </form>

    <h3>Search Products</h3>
        <form action="admin.php" method="post" class="admin-form">
            <input type="text" name="search_term" placeholder="Search by Title" required>
            <button type="submit" name="search" class="btn btn-search">Search</button>
    </form>
    
    <?php if (!empty($products)): ?>
        <h3>Results</h3>
        <?php foreach ($products as $product): ?>
        <form action="admin.php" method="post" class="admin-form">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">
            <input type="text" name="title" value="<?php echo htmlspecialchars($product['Title']); ?>" required>
            <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <input type="number" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
            <input type="number" name="category_id" value="<?php echo htmlspecialchars($product['category_id']); ?>" required>
            <input type="number" name="image_id" value="<?php echo htmlspecialchars($product['image_id']); ?>" required>
            <input type="number" name="size_id" value="<?php echo htmlspecialchars($product['size_id']); ?>" required>
            <button type="submit" name="update" class="btn btn-update">Update</button>
            <button type="submit" name="delete" class="btn btn-delete">Delete</button>
        </form>
        <?php endforeach; ?>
        <?php else: ?>
            <p>No products found</p>
        <?php endif; ?>
        
    </div>
    </body>
    </html>
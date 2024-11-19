<?php
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');
    include_once(__DIR__ . '/Classes/bootstrap.php');
    
    $products = Product::getAllProducts();

    // Check if product ID exists in the URL query string
    if (!isset($_GET['products_ID'])) {
        exit("404 - Product Not Found");
    }

    // Get the product ID from the query string
    $id = $_GET['products_ID'];

    // Fetch the product details by ID
    $product = Product::getProductById($id);

    // If no product was found with the given ID, show an error
    if (!$product) {
        exit("404 - Product Not Found");
    }

  
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php include_once(__DIR__ . '/nav.inc.php'); ?>
    <main class="product-page">
        <section class="product-container">
            <!-- Product Image -->
            <div class="product-image">
                <img src="<?php echo $product['image_url']; ?>" alt="Product Image">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 class="product-title"><?php echo $product['Title']; ?></h1>
                <p class="product-description"><?php echo $product['description']; ?></p>
                <p class="product-price">€ <?php echo $product['Price']; ?></p>

                <!-- Size Selection -->
                <div class="product-size">
                    <label for="size">Choose a size:</label>
                    <select id="size" name="size">
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                        <option value="XL">Extra Large</option>
                    </select>
                </div>

                <!-- Add to Cart Button -->
                <button class="add-to-cart">Add to Cart</button>
            </div>
        </section>

        <!-- Additional Information Section -->
        <section class="additional-info">
            <h2>More About This Product</h2>
            <p>
                This is a section where you can add more detailed explanations about the product, 
                such as its materials, manufacturing process, or any special instructions for use.
            </p>
        </section>
    </main>
</body>
</html>

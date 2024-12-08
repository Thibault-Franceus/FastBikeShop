<?php
    include_once(__DIR__ . '/Classes/Db.php');
    include_once(__DIR__ . '/Classes/Product.php');
    include_once(__DIR__ . '/Classes/bootstrap.php');
    include_once(__DIR__ . '/Classes/User.php');
    include_once(__DIR__ . '/Classes/Cart.php');
    
    $products = Product::getAllProducts();

    $user = User::getUserByEmail($_SESSION['email']);

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_to_basket'])) {
            $item = [
                'id' => $product['ID'],
                'title' => $product['Title'],
                'price' => $product['Price'],
                'quantity' => 1
            ];
            $_SESSION['basket'][] = $item;
        } elseif (isset($_POST['remove_from_basket'])) {
            foreach ($_SESSION['basket'] as $key => $item) {
                if ($item['id'] == $product['ID']) {
                    unset($_SESSION['basket'][$key]);
                    break;
                }
            }
        }   
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_to_cart'])) {
            Cart::addToCart($product['ID'], $product['Title'], $product['Price'], $_POST['product_size'], $_POST['user_id']);
        } elseif (isset($_POST['remove_from_cart'])) {
            Cart::removeFromCart($product['ID']);
        }
    }


    // include the review functionss
    require_once(__DIR__ . '/Classes/Review.php');
    $reviewInstance = new Review();
    $reviews = $reviewInstance->getAllReviews($id);

  
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['Title']; ?></title>
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

    <!-- Form for Add to Cart -->
        <form action="details.php?products_ID=<?php echo $product['ID']; ?>" method="post" class="add-to-cart-form">
        <!-- Hidden fields to pass data -->
        <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['Title']); ?>">
        <input type="hidden" name="product_price" value="<?php echo $product['Price']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user['ID']; ?>"> <!-- If user is logged in -->

        <!-- Size Selection -->
        <div class="product-size">
            <label for="size">Choose a size:</label>
            <select id="size" name="product_size" class="size-dropdown">
                <option value="S">Small</option>
                <option value="M">Medium</option>
                <option value="L">Large</option>
                <option value="XL">Extra Large</option>
            </select>
        </div>

        <!-- Add to Cart Button -->
        <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
    </form>
</div>

        </section>

        <!-- Additional Information Section -->
        <section class="additional-info">
            <h2>Reviews</h2>

            <div class="review-form">
                <label for="review">Write a review:</label>
                <textarea name="review" id="review" class="review-textarea"></textarea>
                <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user['ID']; ?>">
                <div class="submit-review-btn">Submit Review</div>
            </div>

            <div class="reviews">
                <?php foreach($reviews as $review): ?>
                    <div class="review">
                        <h3><?php echo htmlspecialchars($review['firstname']); ?></h3>
                        <p><?php echo $review['comment']; ?></p>
                        <h4><?php echo $review['created_at']; ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>

        </section>
    </main>
<script>
    let reviewForm = document.querySelector('.submit-review-btn').addEventListener('click', function(){
        let review = document.querySelector('.review-textarea').value;
        let product_id = document.querySelector('input[name="product_id"]').value;
        let user_id = document.querySelector('input[name="user_id"]').value;

        let formData = new FormData();
        formData.append('comment', review);
        formData.append('product_id', product_id);
        formData.append('user_id', user_id);

        fetch('ajax/addreview.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result =>{
            let newReview = document.createElement('div');
            newReview.classList.add('review');
            newReview.innerHTML = `
                
                    <h3>${result.firstname}</h3>
                    <p>${result.comment}</p>
                    <h4>${result.created_at}</h4>
                
            `;
            document.querySelector('.reviews').appendChild(newReview);
        })
        .catch(error => 
            console.error('Error:', error));
    }); 
</script>
</body>
</html>

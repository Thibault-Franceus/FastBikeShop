<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
    <main class="product-page">
        <section class="product-container">
            <!-- Product Image -->
            <div class="product-image">
                <img src="path-to-your-image.jpg" alt="Product Image">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 class="product-title">Product Title</h1>
                <p class="product-description">This is a short description of the product that highlights its features and benefits.</p>
                <p class="product-price">€ 49.99</p>

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

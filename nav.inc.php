<nav class="navbar">
   <a class="logo" href="index.php">
    <img src="https://baloisetreklions.be/wp-content/uploads/sites/134/2022/08/trek.png" alt="">
</a> 
   <div class="nav-items">
    <div class="profile">
      <button class="dropdown-toggle"><?php echo htmlspecialchars($user['firstname']); ?></button>
      <div class="dropdown-menu profile-menu">
        <p>Your currency: <?php echo htmlspecialchars($user['coins']) ?> <span id="currency"></span></p>
        <a href="orders.php">view Orders</a>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout?</a>
      </div>
    </div>

      <div class="basket">
        <button class="dropdown-toggle">Basket</button>
        <div class="dropdown-menu basket-menu">
          <?php if (!empty($_SESSION['basket'])): ?>
            <ul>
              <?php foreach ($_SESSION['basket'] as $item): ?>
                <li>
                  <?php echo htmlspecialchars($item['title']); ?> - <?php echo $item['price']; ?>
                  <form action="details.php?products_ID=<?php echo $item['id']; ?>" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                    <button type="submit" name="remove_from_basket" class="btn btn-remove">Remove</button>
                  </form>
                </li>
              <?php endforeach; ?>
            </ul>
              <form action="place_order.php" method="post">
                  <button type="submit" name="view_basket" class="btn btn-view-basket">Place Order</button>
              </form>
          <?php else: ?>
            <p>Your basket is empty.</p>
          <?php endif; ?>

          
        </div>

      </div>

   </div>
</nav>

<script src="script.js"></script>
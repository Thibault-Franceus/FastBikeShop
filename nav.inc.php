<nav class="navbar">
   <a class="logo" href="index.php">
    <img src="https://baloisetreklions.be/wp-content/uploads/sites/134/2022/08/trek.png" alt="">
</a> 
   <div class="nav-items">
    <div class="profile">
      <button class="dropdown-toggle"><?php echo htmlspecialchars($_SESSION['email']); ?></button>
      <div class="dropdown-menu profile-menu">
        <p>Your currency: <span id="currency"></span></p>
        <a href="">Orders</a>
        <a href="logout.php">Logout?</a>
      </div>
    </div>

      <div class="basket">
        <button class="dropdown-toggle">Basket</button>
        <div class="dropdown-menu basket-menu">
          <p id="empty-basket">Basket is empty</p>
          <div id="basket-items-container"></div>
          <p>Total Price: <span id="total-price"></span></p>
          <p>Currency Left: <span id="currency-left"></span></p>
          <button id="place-order">Place order</button>
        </div>

      </div>

   </div>
</nav>

<script src="script.js"></script>
<nav class="navbar">
    <a href="index.php" class="logo">Fast</a>
    <a href="index.php">Home</a>
    <a href="mylist.php">My Cart</a>
    
    <form action="" method="get">
      <input type="text" name="search">
    </form>
    
    <a href="logout.php" class="navbar__logout">Hi <?php echo htmlspecialchars($_SESSION['firstname']);?>, you wanna logout?</a>
</nav>
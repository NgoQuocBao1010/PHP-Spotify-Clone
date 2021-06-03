<nav>
    <div class="searchContainer hide">
        <div class="searchBox">
            <input type="text" name="search" spellcheck="false" class="search" placeholder="Artists, songs...">
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>
    <div class="logo-container">
        <img src="./images/users/default.png" alt="" class="logo">
        <ul class="logo-links">
            <h3><?php echo $username; ?></h3>
            <?php if ($authenticated) : ?>
                <li><a href="./auth/logout.php">Logout</a></li>
                <?php if ($admin) : ?>
                    <li><a href="./auth/adminDashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
            <?php else : ?>
                <li><a href="./auth/login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
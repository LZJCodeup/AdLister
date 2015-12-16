<nav> 
    <div class="container">
        <ul class="nav nav-justified nav-pills">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/ads.index.php">Browse</a></li>
            <?php if ($loggedIn): ?>
                <li><a href="/auth.logout.php">Log Out</a></li>
                <li><a href="/users.show.php">Profile</a></li>
            <?php else: ?>
                <li><a href="/auth.login.php">Login</a></li>
                <li><a href="/users.create.php">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

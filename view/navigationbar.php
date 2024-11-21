<?php
session_start();
?>

<nav>
    <ul>
        <li><a href="register.php">Register</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>

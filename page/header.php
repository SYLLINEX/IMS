<?php
session_start();
?>
<div class="alert-box" id="alert-box">
    <span class="close-btn" id="alert-close">&times;</span>
    <p id="alert-msg"></p>
</div> 
<header>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"><a href="index.php" style="color: inherit; text-decoration: none;" onmouseover="this.style.backgroundColor='transparent';" onmouseout="this.style.backgroundColor='';">Item Management System</a></label>

        <!-- navigation links -->
        <ul class="nav-links">
            <?php if (!isset($_SESSION['user'])): ?>
                <li><span id="login-btn"><a href="#" id="login-button">Login</a></span></li>
            <?php else: ?>
                <li><a href="/page/displayitempage.php">View All Items</a></li>
                <li><a href="/page/additempage.php">Add Item</a></li>
                <li><a href="/page/manageitempage.php">Manage Item</a></li>
                <li><span id="logout-btn"><a href="/page/user/logout.php">Logout</a></span></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>


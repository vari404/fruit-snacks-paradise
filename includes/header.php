<?php
// header.php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fruit Snacks Paradise</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>Fruit Snacks Paradise</h1>
        <nav>
            <a href="index.php">Home</a>
            <?php if(isset($_SESSION['username'])): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="profile.php"><?php echo $_SESSION['username']; ?></a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<div class="container">

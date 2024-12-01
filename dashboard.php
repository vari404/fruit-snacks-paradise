<?php include 'includes/header.php'; ?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<h2>Dashboard</h2>
<p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
<p><a href="create_snack.php" class="button">Add a New Fruit Snack</a></p>
<p><a href="view_snacks.php" class="button">View Your Fruit Snacks</a></p>

<?php include 'includes/footer.php'; ?>

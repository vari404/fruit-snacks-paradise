<?php include 'includes/header.php'; ?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<h2>Your Profile</h2>
<p>Username: <?php echo $_SESSION['username']; ?></p>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/header.php'; ?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['id'];

// Delete image file if exists
$sql = "SELECT image FROM snacks WHERE id='$id' AND user_id='$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row){
    $old_image = $row['image'];
    if($old_image && file_exists('images/' . $old_image)){
        unlink('images/' . $old_image);
    }

    // Delete the snack record
    $sql = "DELETE FROM snacks WHERE id='$id' AND user_id='$user_id'";

    if($conn->query($sql) === TRUE){
        echo "<p style='color:green;'>Snack deleted successfully. <a href='view_snacks.php'>Back to your snacks</a>.</p>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "<p style='color:red;'>Snack not found.</p>";
}
?>

<?php include 'includes/footer.php'; ?>

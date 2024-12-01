<?php include 'includes/header.php'; ?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Fetch snacks added by the user
$sql = "SELECT * FROM snacks WHERE user_id = '$user_id'";
$result = $conn->query($sql);
?>

<h2>Your Fruit Snacks</h2>
<table>
    <tr>
        <th>Snack Name</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td>
            <?php if($row['image']): ?>
                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width:100px;">
            <?php else: ?>
                No Image
            <?php endif; ?>
        </td>
        <td>
            <a href="update_snack.php?id=<?php echo $row['id']; ?>" class="button">Edit</a>
            <a href="delete_snack.php?id=<?php echo $row['id']; ?>" class="button" onclick="return confirm('Are you sure you want to delete this snack?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'includes/footer.php'; ?>

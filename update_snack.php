<?php include 'includes/header.php'; ?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user_id = $_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"])) || empty(trim($_POST["description"]))){
        echo "<p style='color:red;'>Please fill in all fields.</p>";
    } else {
        $name = $conn->real_escape_string($_POST["name"]);
        $description = $conn->real_escape_string($_POST["description"]);

        
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if(in_array($file_ext, $allowed_ext)){
                $image_name = uniqid() . '.' . $file_ext;
                $image_path = 'images/' . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

                
                $sql = "SELECT image FROM snacks WHERE id='$id' AND user_id='$user_id'";
                $result = $conn->query($sql);
                $old_image = $result->fetch_assoc()['image'];
                if($old_image && file_exists('images/' . $old_image)){
                    unlink('images/' . $old_image);
                }

                $sql = "UPDATE snacks SET name='$name', description='$description', image='$image_name' WHERE id='$id' AND user_id='$user_id'";
            } else {
                echo "<p style='color:red;'>Invalid image file type.</p>";
            }
        } else {
            $sql = "UPDATE snacks SET name='$name', description='$description' WHERE id='$id' AND user_id='$user_id'";
        }

        if($conn->query($sql) === TRUE){
            echo "<p style='color:green;'>Snack updated successfully. <a href='view_snacks.php'>View your snacks</a>.</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    $sql = "SELECT * FROM snacks WHERE id='$id' AND user_id='$user_id'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
    } else {
        echo "<p style='color:red;'>Snack not found.</p>";
        exit();
    }
}
?>

<h2>Edit Fruit Snack</h2>
<form method="POST" action="" enctype="multipart/form-data">
    <label>Snack Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>">
    <label>Description:</label>
    <textarea name="description" id="description"><?php echo htmlspecialchars($row['description']); ?></textarea>
    <label>Image (optional):</label>
    <input type="file" name="image" accept="image/*">
    <?php if($row['image']): ?>
        <p>Current Image:</p>
        <img src="images/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" style="width:100px;">
    <?php endif; ?>
    <input type="submit" value="Update Snack">
</form>

<script>
// Client-side validation
document.querySelector('form').addEventListener('submit', function(e) {
    var name = document.getElementById('name').value.trim();
    var description = document.getElementById('description').value.trim();

    if(name === '' || description === '') {
        alert('Please fill in all fields');
        e.preventDefault();
    }
});
</script>

<?php include 'includes/footer.php'; ?>

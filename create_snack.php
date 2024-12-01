<?php include 'includes/header.php'; ?>

<?php
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["name"])) || empty(trim($_POST["description"]))){
        echo "<p style='color:red;'>Please fill in all fields.</p>";
    } else {
        $name = $conn->real_escape_string($_POST["name"]);
        $description = $conn->real_escape_string($_POST["description"]);
        $user_id = $_SESSION['id'];

        // Handle image upload
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
            $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if(in_array($file_ext, $allowed_ext)){
                $image_name = uniqid() . '.' . $file_ext;
                $image_path = 'images/' . $image_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
            } else {
                echo "<p style='color:red;'>Invalid image file type.</p>";
                $image_name = NULL;
            }
        } else {
            $image_name = NULL;
        }

        $sql = "INSERT INTO snacks (user_id, name, description, image) VALUES ('$user_id', '$name', '$description', '$image_name')";

        if($conn->query($sql) === TRUE){
            echo "<p style='color:green;'>Fruit snack added successfully. <a href='view_snacks.php'>View your snacks</a>.</p>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<h2>Add a New Fruit Snack</h2>
<form method="POST" action="" enctype="multipart/form-data">
    <label>Snack Name:</label>
    <input type="text" name="name" id="name">
    <label>Description:</label>
    <textarea name="description" id="description"></textarea>
    <label>Image (optional):</label>
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="Add Snack">
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

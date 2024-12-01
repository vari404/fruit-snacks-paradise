<?php include 'includes/header.php'; ?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Server-side validation
    if(empty(trim($_POST["username"])) || empty(trim($_POST["password"]))){
        echo "<p style='color:red;'>Please enter username and password.</p>";
    } else {
        $username = $conn->real_escape_string($_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Check if username already exists
        $checkUser = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($checkUser);

        if($result->num_rows > 0){
            echo "<p style='color:red;'>Username already taken. Please choose another one.</p>";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

            if($conn->query($sql) === TRUE){
                echo "<p style='color:green;'>Registration successful. <a href='login.php'>Login here</a>.</p>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}
?>

<h2>Register</h2>
<form method="POST" action="">
    <label>Username:</label>
    <input type="text" name="username" id="username">
    <label>Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Register">
</form>

<script>
// Client-side validation
document.querySelector('form').addEventListener('submit', function(e) {
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();

    if(username === '' || password === '') {
        alert('Please fill in all fields');
        e.preventDefault();
    }
});
</script>

<?php include 'includes/footer.php'; ?>

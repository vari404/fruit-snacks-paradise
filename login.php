<?php include 'includes/header.php'; ?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"])) || empty(trim($_POST["password"]))){
        echo "<p style='color:red;'>Please enter username and password.</p>";
    } else {
        $username = $conn->real_escape_string($_POST["username"]);
        $password = $_POST["password"];

        $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                // Password is correct
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<p style='color:red;'>Invalid password.</p>";
            }
        } else {
            echo "<p style='color:red;'>No account found with that username.</p>";
        }
    }
}
?>

<h2>Login</h2>
<form method="POST" action="">
    <label>Username:</label>
    <input type="text" name="username" id="username">
    <label>Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">
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

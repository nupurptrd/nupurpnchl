<?php
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // simple hashing for demo

    $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<p aria-live='assertive' style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label for ="username" >Username:</label>
        <input type="text" id ="username" name="username" required><br>
        <label for="password" >Password:</label>
        <input type="password" id ="password" name="password" required><br>
        <button type="button" onclick="window.location.href='../admin/dashboard.php'">Login</button>

    </form>
</body>
</html>

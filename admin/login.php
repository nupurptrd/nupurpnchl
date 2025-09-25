<?php
session_start();

// 🔒 Fixed username and password
$fixed_username = "admin";
$fixed_password = "admin123"; // plain text (not secure!)

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === $fixed_username && $password === $fixed_password) {
        $_SESSION['admin'] = $username;
        $_SESSION['role']  = "admin";  // ✅ add this
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
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
         <!-- ✅ Fixed submit button -->
        <button type="submit" name="login">Login</button>
        <button type="button" style="background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="window.location.href='../index.php'"> Go to Home</button>

    </form>
</body>
</html>

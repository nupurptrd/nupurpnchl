<?php
session_start();
include '../config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // ✅ Check if username already exists
    $check_sql = "SELECT * FROM admins WHERE username='$username'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<p style='color:red;'>This username already exists. Please choose another.</p>";
    } else {
        $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Admin registered successfully! You can now login.</p>";
        echo "<script>
                setTimeout(function(){ window.location.href='../admin/login.php'; }, 2000);
              </script>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Registration</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <h2>Admin Registration</h2>
  <form method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <button type="submit" name="register">Register</button>
    <a href="../admin/login.php">
    <button type="button">Login as Admin</button>
    </a>
  </form>
</body>
</html>

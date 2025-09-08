<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

    if ($role == "student") {
        $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    } else {
        $sql = "SELECT * FROM admins WHERE username='$email' AND password='$password'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['user'] = $email;

        if ($role == "student") {
            header("Location: index.php");
        } else {
            header("Location: admin/dashboard.php");
        }
    } else {
        echo "<p style='color:red;'>Invalid credentials</p>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Exam Portal</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <h2>Login</h2>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form action="login.php" method="POST">
  <label>Email:</label><br>
  <input type="text" name="email" required><br><br>
  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>
  <label>Login as:</label><br>
  <select name="role" required>
    <option value="student">Student</option>
    <option value="admin">Admin</option>
  </select><br><br>

  <button type="submit" name="login">Login</button>
</form>
  <?php include 'footer.php'; ?>
</body>
</html>

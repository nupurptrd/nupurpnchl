<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = md5($_POST['password']);

    // ✅ Only check in students table
    $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();

        // Store session variables
        $_SESSION['student']     = $row['id'];
        $_SESSION['name']   = $row['name'];
        $_SESSION['email']  = $row['email'];
        $_SESSION['centre'] = $row['centre'];
        $_SESSION['role']   = $row['role']; // in case you want to distinguish later

        // Redirect to student home/dashboard
        header("Location: index.php");
        exit;
    } else {
        echo "<p style='color:red;'>Invalid email or password.</p>";
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
  
  <br><br>
  <button type="submit" name="login">Login</button>
  <div class="register-prompt">
         <p>If you are new to the portal, first register yourself here: <br>
          <button type="button" onclick="window.location.href='register.php'">Register</button>
         </p>
  </div>
</form>
  <?php include 'footer.php'; ?>
</body>
</html>

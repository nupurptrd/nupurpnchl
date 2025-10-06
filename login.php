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
        echo "<p style='color:red;' aria-live='assertive'>Invalid email or password.</p>";
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
  <?php if(isset($error)) echo "<p aria-live='assertive' style='color:red;'>$error</p>"; ?>
  <form action="login.php" method="POST">
<<<<<<< HEAD
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required><br><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email" required><br><br>
  <label for="password" >Password:</label><br>
  <input type="password" id = "password" name="password" required><br><br>
  <label>Login Centre:</label><br>
  <select name="centre" required>
    <option value="Ahmedabad">Ahmedabad</option>
    <option value="Shaila">Shaila</option>
    <option value="Kapadwanj">Kapadwanj</option>
    <option value="Valsad">Valsad</option>
    <option value="Disha">Disha</option>
    <option value="Other">Other</option>
  </select>
  <label>Login as:</label><br>
  <select name="role" required>
    <option value="student">Student</option>
    <option value="admin">Admin</option>
  </select><br><br>

=======
  
  <label>Email:</label><br>
  <input type="text" name="email" required><br><br>
  <label>Password:</label><br>
  <input type="password" name="password" required><br><br>
  
  <br><br>
>>>>>>> 348612bb4e8a914b587df9062d158fcce5239504
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

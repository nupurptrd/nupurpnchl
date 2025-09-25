<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);
    $centre   = $_POST['centre'];
    $role     = "student";

    $sql = "INSERT INTO students (name, email, password, centre, role) 
            VALUES ('$name', '$email', '$password', '$centre', '$role')";

    if ($conn->query($sql) === TRUE) {
      echo "<p style='color:green;'>Student registered successfully! Redirecting to login...</p>";
      header("Refresh:2; url=login.php");  // waits 2 sec then goes
      exit;
    } else {
      echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Student Registration</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <h2>Student Registration</h2>
  <form method="post">
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <label>Login Centre:</label><br>
  <select name="centre" required>
    <option value="Ahmedabad">Ahmedabad</option>
    <option value="Shaila">Shaila</option>
    <option value="Kapadwanj">Kapadwanj</option>
    <option value="Valsad">Valsad</option>
    <option value="Disha">Disha</option>
    <option value="Other">Other</option>
  </select>
    <button type="submit" name="register">Register</button>
  </form>
</body>
</html>

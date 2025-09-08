<?php
session_start();
include 'config.php';

if (isset($_POST['register'])) {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']); // hashing
    $role     = $_POST['role'];
    $centre   = $_POST['centre'];

    if ($role == "student") {
        $sql = "INSERT INTO students (name, email, password, centre, role) VALUES ('$name', '$email', '$password','$centre', $role)";
    } else {
        $sql = "INSERT INTO admins (name, email, password, centre, role) VALUES ('$name', '$email', '$password','$centre', $role)";
        // For admins, we’ll use email/username field as "username"
    }

   if ($conn->query($sql) === TRUE) {
    // Success message + redirect
    echo "<p style='color:green;'>Registration successful! You can now login as $role.</p>";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'login.php';
            }, 2000); // redirect after 2 seconds
          </script>";
} else {
    // Error message
    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
}

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - Exam Portal</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'header.php'; ?>
  <h2>Register</h2>
  <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post">
    <label>Name:</label>
    <input type="text" name="name" required><br>
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <label>Centre:</label>
    <input type="centre" name="centre" required><br>
    <label>Register as:</label><br>
    <select name="role" required>
      <option value="student">Student</option>
      <option value="admin">Admin</option>
    </select><br><br>
    <button type="submit">Register</button> 
  </form>
  <?php include 'footer.php'; ?>
</body>
</html>
